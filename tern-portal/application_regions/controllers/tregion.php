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
**/ 
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tregion extends CI_Controller {

    protected $last_run = 0;
    protected $new_start_timestamp = '';
    
    function __construct()
    {
        if (isset($_SERVER['REMOTE_ADDR']) && (($_SERVER['REMOTE_ADDR'] != '127.0.0.1') && ($_SERVER['REMOTE_ADDR' != 'localhost']) && $_SERVER['RREMOTE_ADDR'] != $_SERVER['SERVER_ADDR'])) die( 'Permission denied');
    
        parent::__construct();
        $this->load->model('Scheduler');   
        
    }
    
   
    public function index()
    {    
        $default = array('id');
        $params = $this->uri->uri_to_assoc(3, $default);
        
        extract($params);
        
        
   	ob_end_clean();
        header("Connection: close\r\n");
        header("Content-Encoding: none\r\n");
        ob_start();
        echo ('OK');
        $size = ob_get_length();
        header("Content-Length: $size");
        ob_end_flush();     
        flush();          
        ob_end_clean();
       
        if($schedules = $this->Scheduler->getOrder(0,$id)){ 
            
            $json = $this->load->file('../api/regions.json',TRUE);
            $rcf = json_decode($json,TRUE);
            
            foreach($schedules as $schedule){
                if($rcf['layers'] != '' && count($rcf['layers']) > 0 ){
                    foreach($rcf['layers'] as $layer){
                        if($schedule->l_id == ''){
                           $valid_schedule = 1; 
                        }
                        elseif($layer['l_id'] == $schedule->l_id ){
                            $valid_schedule = 1;                            
                        }
                    }
                   if($valid_schedule == 1){
                      $this->Scheduler->setUnderProcess($schedule->batch_id);
                    }
                }
                
                if($valid_schedule == 1){          
                    // take records from solr
                   $this->processRecords($schedule);
                   $this->Scheduler->setFinishProcess($schedule->batch_id,$this->new_start_timestamp,$this->last_run, $this->rec_start);
                }          

            }
          
        }
    }
    
    public function newRecords()
    {
        ob_end_clean();
        header("Connection: close\r\n");
        header("Content-Encoding: none\r\n");
        ob_start();
        echo ('OK');
        $size = ob_get_length();
        header("Content-Length: $size");
        ob_end_flush();     // Strange behaviour, will not work
        flush();            // Unless both are called !
        ob_end_clean();
        if($schedules = $this->Scheduler->getOrder(1)){ 
            $json = $this->load->file('../api/regions.json',TRUE);
            $rcf = json_decode($json,TRUE);
            
            foreach($schedules as $schedule){
                if($rcf['layers'] != '' && count($rcf['layers']) > 0 ){
                    foreach($rcf['layers'] as $layer){
                        if($schedule->l_id == ''){
                           $valid_schedule = 1; 
                        }
                        elseif($layer['l_id'] == $schedule->l_id ){
                            $valid_schedule = 1;                            
                        }
                    }
                   if($valid_schedule == 1){
                      $this->Scheduler->setUnderProcess($schedule->batch_id);
                    }
                }
                
                if($valid_schedule == 1){          
                    // take records from solr
                   $this->processNewRecords($schedule);
                   $this->Scheduler->setNotUnderProcess($schedule->batch_id); // turn off under process flag, finishing
                }          

            }
          
        }
  
    }
    
    
    
    private function processNewRecords($schedule){
        $this->load->model('Solr');
        $this->load->model('Regions');
        
        if($schedule->start_timestamp && $schedule->start_timestamp != '') { 
            
            $start_timestamp = $schedule->start_timestamp;
            $start_timestamp = strftime("%Y-%m-%dT%H:%M:%SZ",strtotime($start_timestamp));                                 
          
        }else{
            $start_timestamp= null;
        }
        if($schedule->end_timestamp && $schedule->end_timestamp !='' ) {
            $end_timestamp = $schedule->end_timestamp; 
            $end_timestamp = strftime("%Y-%m-%dT%H:%M:%SZ",strtotime($end_timestamp));  
            
        }else{
            $end_timestamp= null;
        } 
        $rec_start = $schedule->rec_start;
        $doc_c = 0;
        do{   
           
            $rec_start = ($rec_start + $doc_c);
            log_message("INFO","Record start at index: " . $rec_start);
            $response = $this->Solr->getNewRecords($start_timestamp,$end_timestamp,$rec_start);
            log_message("INFO","Records retrieved: " . $response->numFound);
            if($response != '' && !empty($response)){
                    $resultDocs = array();
                    $doc_c = 0;
                    if($response->docs[0]) $start_timestamp = $response->docs[0]->timestamp;
                    if($schedule->l_id && $schedule->l_id!= "") $layer_id = $schedule->l_id;
                    foreach($response->docs as $doc){
                        $doc_c++;
                        //get spatial coverage                    
                        $spatial_coverages = $doc->spatial_coverage;
                        if($layer_id)  $doc = $this->Solr->removeRegionSolrDoc($doc,$layer_id);  // remove region information before processing 
                        else $doc = $this->Solr->removeRegionSolrDoc($doc);

                        if(is_array($spatial_coverages)){  
                            $index_id_arr= array();
                            for($i=0;$i<count($spatial_coverages);$i++){
                                if(checkValidCoords($spatial_coverages[$i])){
                                        $index_id_arr = array_unique(array_merge($index_id_arr,getRegionIndexId($this->doIntersect($spatial_coverages[$i],$layer_id))));                             
                                        sort($index_id_arr);   
                                }
                            }
                        }else{
                            if(checkValidCoords($spatial_coverages)){
                                $index_id_arr = getRegionIndexId($this->doIntersect($spatial_coverages,$layer_id));
                            }
                        }    

                        if(count($index_id_arr)>0) $resultDocs[] = $this->Solr->addRegion2SolrDoc($doc, $index_id_arr); 

                    }

                    // if there are things to index
                    if(count($resultDocs)>0){ //do indexing
                   
                        if($this->Solr->addDocuments($resultDocs) == '') { // successful indexing
                            //get last document's timestamp
                            log_message("INFO", $schedule->batch_id . ": No of records processed " . $doc_c);
                            if($response->numFound > ($rec_start + $doc_c)) { //there are more records to get                                
                                log_message("INFO", $schedule->batch_id . ": More records to get..");
                                //$this->new_start_timestamp = $response->docs[($doc_c-1)]->timestamp; 
                                $this->new_start_timestamp = $start_timestamp;
                                $this->last_run = 0;   
                                $this->rec_start = ($rec_start + $doc_c);
                                $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,0);
                                
                            }else{ // no more records to get
                                log_message("INFO", $schedule->batch_id . ": End of records.");
                                $this->new_start_timestamp = $start_timestamp;
                                $this->last_run = 1;
                                $this->rec_start = ($rec_start + $doc_c);                                
                                $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,0);
                            }
                            
                        }else{ // there is an error in indexing
                            log_message("error",$schedule->batch_id . ": Error in indexing, number of records " . $doc_c);
                            $this->rec_start = ($rec_start - $doc_c);
                            $this->last_run = 0;
                            $this->cancel = 1;
                            $this->new_start_timestamp = $start_timestamp;
                        }
                    }else{
                        //nothing to index 
                             
                         if($response->numFound > ($rec_start + $doc_c)) {
                             log_message("INFO",$schedule->batch_id .": Nothing to index here" );
                             //$this->new_start_timestamp = $response->docs[($doc_c-1)]->timestamp; 
                             $this->new_start_timestamp = $start_timestamp;
                             $this->last_run = 0;
                             $this->rec_start = ($rec_start + $doc_c);
                             $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,0);
                         }else{ // nothing to index and no more to get from server
                             log_message("INFO",$schedule->batch_id .": Nothing to index here. End of records" );
                             
                             $this->new_start_timestamp = $start_timestamp;
                             $this->last_run = 1;
                             $this->rec_start = ($rec_start + $doc_c);   
                             $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,0);
                         }
                    }
                }else{
                    // there is an error in getting records from SOLR           
                    log_message("ERROR",$schedule->batch_id .": Unable to get to SOLR. Canceling..." );
                    $this->rec_start = ($rec_start - $doc_c);
                    $this->cancel = 1;
                    $this->last_run = 0;
                    $this->new_start_timestamp = $start_timestamp;
                }
                ob_end_flush();
                flush();
        }while($this->last_run == 0 && $this->cancel != 1);
    }
    
    
    
    private function processRecords($schedule){
        $this->load->model('Solr');
        $this->load->model('Regions');
        
        if($schedule->start_timestamp && $schedule->start_timestamp != '') { 
            
            $start_timestamp = $schedule->start_timestamp;
            $start_timestamp = strftime("%Y-%m-%dT%H:%M:%SZ",strtotime($start_timestamp));                                 
          
        }else{
            $start_timestamp= null;
        }
        if($schedule->end_timestamp && $schedule->end_timestamp !='' ) {
            $end_timestamp = $schedule->end_timestamp; 
            $end_timestamp = strftime("%Y-%m-%dT%H:%M:%SZ",strtotime($end_timestamp));  
            
        }else{
            $end_timestamp= null;
        } 
        $rec_start = $schedule->rec_start;
        $doc_c = 0;
        do{   
           
            $rec_start = ($rec_start + $doc_c);
            log_message("INFO","Record start at index: " . $rec_start);
            $response = $this->Solr->getRecords($start_timestamp,$end_timestamp,$rec_start);
            
            if($response != '' && !empty($response)){
                    $resultDocs = array();
                    $doc_c = 0;
                    if($response->docs[0]) $start_timestamp = $response->docs[0]->timestamp;
                    if($schedule->l_id && $schedule->l_id!= "") $layer_id = $schedule->l_id;
                    foreach($response->docs as $doc){
                        $doc_c++;
                        //get spatial coverage                    
                        $spatial_coverages = $doc->spatial_coverage;
                        if($layer_id)  $doc = $this->Solr->removeRegionSolrDoc($doc,$layer_id);  // remove region information before processing 
                        else $doc = $this->Solr->removeRegionSolrDoc($doc);

                        if(is_array($spatial_coverages)){  
                            $index_id_arr= array();
                            for($i=0;$i<count($spatial_coverages);$i++){
                                if(checkValidCoords($spatial_coverages[$i])){
                                        $index_id_arr = array_unique(array_merge($index_id_arr,getRegionIndexId($this->doIntersect($spatial_coverages[$i],$layer_id))));                             
                                        sort($index_id_arr);   
                                }
                            }
                        }else{
                            if(checkValidCoords($spatial_coverages)){
                                $index_id_arr = getRegionIndexId($this->doIntersect($spatial_coverages,$layer_id));
                            }
                        }    

                        if(count($index_id_arr)>0) $resultDocs[] = $this->Solr->addRegion2SolrDoc($doc, $index_id_arr); 

                    }

                    // if there are things to index
                    if(count($resultDocs)>0){ //do indexing
                   
                        if($this->Solr->addDocuments($resultDocs) == '') { // successful indexing
                            //get last document's timestamp
                            log_message("INFO", $schedule->batch_id . ": No of records processed " . $doc_c);
                            if($response->numFound > ($rec_start + $doc_c)) { //there are more records to get                                
                                log_message("INFO", $schedule->batch_id . ": More records to get..");
                                //$this->new_start_timestamp = $response->docs[($doc_c-1)]->timestamp; 
                                $this->new_start_timestamp = $start_timestamp;
                                $this->last_run = 0;   
                                $this->rec_start = ($rec_start + $doc_c);
                                $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,$this->rec_start);
                                
                            }else{ // no more records to get
                                log_message("INFO", $schedule->batch_id . ": End of records.");
                                $this->new_start_timestamp = $start_timestamp;
                                $this->last_run = 1;
                                $this->rec_start = ($rec_start + $doc_c);                                
                                $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,$this->rec_start);
                            }
                            
                        }else{ // there is an error in indexing
                            log_message("error",$schedule->batch_id . ": Error in indexing, number of records " . $doc_c);
                            $this->rec_start = ($rec_start - $doc_c);
                            $this->last_run = 0;
                            $this->cancel = 1;
                            $this->new_start_timestamp = $start_timestamp;
                        }
                    }else{
                        //nothing to index 
                             
                         if($response->numFound > ($rec_start + $doc_c)) {
                             log_message("INFO",$schedule->batch_id .": Nothing to index here" );
                             //$this->new_start_timestamp = $response->docs[($doc_c-1)]->timestamp; 
                             $this->new_start_timestamp = $start_timestamp;
                             $this->last_run = 0;
                             $this->rec_start = ($rec_start + $doc_c);
                             $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,$this->rec_start);
                         }else{ // nothing to index and no more to get from server
                             log_message("INFO",$schedule->batch_id .": Nothing to index here. End of records" );
                             
                             $this->new_start_timestamp = $start_timestamp;
                             $this->last_run = 1;
                             $this->rec_start = ($rec_start + $doc_c);   
                             $this->Scheduler->updateProcess($schedule->batch_id,$start_timestamp,$this->rec_start);
                         }
                    }
                }else{
                    // there is an error in getting records from SOLR           
                    log_message("ERROR",$schedule->batch_id .": Unable to get to SOLR. Canceling..." );
                    $this->rec_start = ($rec_start - $doc_c);
                    $this->cancel = 1;
                    $this->last_run = 0;
                    $this->new_start_timestamp = $start_timestamp;
                }
                ob_end_flush();
                flush();
        }while($this->last_run == 0 && $this->cancel != 1);
    }
    
    
    private function doIntersect($coords,$layer_id){
         
      
            $spatial_arr = explode(" ", $coords);
            if(count($spatial_arr) == 1) { 

                $longlat = explode(",", $spatial_arr[0]);
                
                $index_id_arr = $this->Regions->intersect($longlat[0],$longlat[1],$layer_id);

            }else if(count($spatial_arr) > 1){
                foreach ($spatial_arr as $key => $value){
                    $spatial_arr[$key]  = str_replace(",", " ", $value);
                }
                $poly = implode(", ", $spatial_arr);

                $index_id_arr = $this->Regions->intersectPoly($poly,$layer_id);
             
            }
            return $index_id_arr;
    }
    
    
}
