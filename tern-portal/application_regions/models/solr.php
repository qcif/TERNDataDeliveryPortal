<?php

/**
  Copyright 2011 The Australian National University
  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

  http://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
 * **************************************************************************
 *
 * */
?>
<?php

class Solr extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        require_once(APPPATH . 'libraries/Solr/Service.php');       
        $this->solr = new Apache_Solr_Service( $this->config->item('solr_host'),$this->config->item('solr_port'), $this->config->item('solr_instance') );
        
    } 

    public function getRecords($start_timestamp = '*', $end_timestamp = 'NOW', $rec_start = 0, $rows = 100)
    {
        if(!$start_timestamp ) $start_timestamp = '*';
        if(!$end_timestamp) $end_timestamp = 'NOW';
    
        if ( !$this->solr->ping() ) {
            log_message('error', 'Could not connect to SOLR' );
            
            exit;
        }
  

        $offset = $rec_start;
        $query = 'timestamp:[' . $start_timestamp . ' TO ' . $end_timestamp . '] ';
        $fq = '+class:(collection)+spatial_coverage:*';
        $additionalParameters = array(
            'sort' => 'timestamp asc',         
            'fq' =>$fq
        );
 
        try
        {
            $response = $this->solr->search($query, $offset, $rows, $additionalParameters);
            if ($response->getHttpStatus() == 200)
            {
        
                if ($response->response->numFound > 0)
                {
                    log_message('info',"Number of records searched:" . $response->response->numFound);
                    return($response->response);
                    
                }
                else
                {
                    return '';
                }
            }
            else
            {
                return $response->getHttpStatusMessage();
            }
        }
        catch (Exception $e)
        {
            
            log_message('error', $e->getMessage() );
        }
    } 
    
    public function getNewRecords($start_timestamp = '*', $end_timestamp = 'NOW', $rec_start = 0, $rows = 100)
    {
        if(!$start_timestamp ) $start_timestamp = '*';
        if(!$end_timestamp) $end_timestamp = 'NOW';
    
        if ( !$this->solr->ping() ) {
            log_message('error', 'Could not connect to SOLR' );
            
            exit;
        }
  
  
        $offset = $rec_start;
        $query = 'timestamp:[' . $start_timestamp . ' TO ' . $end_timestamp . '] AND -tern_region:[* TO *]';
        $fq = '+class:(collection)+spatial_coverage:*'; 
        $additionalParameters = array(
            'sort' => 'timestamp asc',         
            'fq' =>$fq
        );
      
        try
        {
            $response = $this->solr->search($query, $offset, $rows, $additionalParameters);
            if ($response->getHttpStatus() == 200)
            {
                
                if ($response->response->numFound > 0)
                {
                    log_message ('info',"Number of records searched:" . $response->response->numFound);
                }
                else
                {
                   log_message('info',"Empty results from SOLR");
                 
                }
                  return($response->response);
            }
            else
            {
                return $response->getHttpStatusMessage();
            }
        }
        catch (Exception $e)
        {
            
            log_message('error', $e->getMessage() );
        }
    } 
    public function addRegion2SolrDoc($doc, $index_id_arr){
          
        if(count($index_id_arr)>0){
            foreach($index_id_arr as $index_id ){
                $doc->addField('tern_region', $index_id);
            }
        }
        return $doc;
        
    } 
    
    public function removeRegionSolrDoc($doc, $l_id=null){
        $region_arr = $doc->getField('tern_region');
     
        if(count($region_arr["value"])>1){
            if($l_id){
                $result = preg_grep('/^' . $l_id .'/' ,$region_arr["value"]);
                $removed_arr = array_diff($region_arr["value"],$result); 
                sort($removed_arr);
                
            }else{
                $removed_arr = null;
            }
            
            if(!$removed_arr || count($removed_arr)==0){
                unset($doc->tern_region);
            }else{
                $doc->setField('tern_region',$removed_arr);
            }
            
        }else if (count($region_arr["value"])==1){
            // if only one results, make it an array
            if(preg_match('/^'.$l_id . '/', $region_arr["value"]) >0){
                unset($doc->tern_region);
            }
            
        }

        return $doc;
    }
    
    public function addDocuments($docs){
     //
        // Load the documents into the index
        // 
        try {
            $this->solr->addDocuments($docs);
            $this->solr->commit();            $this->solr->optimize();
            return '';
        }
        catch ( Exception $e ) {
            log_message('error', $e->getMessage());
            return $e->getMessage();
        }
        

    }
}

?>