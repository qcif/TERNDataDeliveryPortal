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

********************************************************************************
$Date: 2011-09-06 11:35:57 +1000 (Tue, 06 Sep 2011) $
$Revision: 1 $
***************************************************************************
*
**/ 
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {


	public function index()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);
           	$key = null;
		if(isset($_GET['key'])){
			$key = ($_GET['key']);		
		} 
		elseif (count($params) > 0) 
		{
			$key = rawurldecode($params[0]);
		} 
		
		// XXX: TODO: If slug != record's expected slug, we should redirect
		if (!is_null($key))
		{

			redirect(base_url().getSlugForRecordByKey($key));
		
		}else{
			show_404('page');
		} 	
           
	}

	public function view_by_hash($params)
	{
            
		// XXX: TODO: If slug != record's expected slug, we should redirect
		if (is_array($params) && count($params) >= 1)
		{
			$hash = $params[0];
			
			$this->load->model('RegistryObjects', 'ro');
			$this->load->model('solr');
	       
			$content = $this->ro->getByHash($hash);
			//print_r($content);
			if (!$content)
			{
				// Temporary hack to turn hash back into key XXX: Use HASH for comms with SOLR
				$query = $this->db->select("registry_object_key")->get_where("dba.tbl_registry_objects", array("key_hash" => $hash));
				if ($query->num_rows() == 0) 
				{
					 show_404('page');
				}
				else
				{
					$query = $query->row();
					$key = $query->registry_object_key;
				}
				$content = $this->ro->get($key);		
			}


			$obj = $this->solr->getByHash($hash);
                        $numFound = $obj->{'response'}->{'numFound'};
			$doc = ($obj->{'response'}->{'docs'}[0]);
			
			$key = $doc->{'key'};
			$data['key'] = $key;
			$group = $doc->{'group'};
                        $data['content'] = $this->transform($content, 'rifcs2View.xsl',urlencode($key));	
		
                        $data['title'] = $doc->{'display_title'};
			
			if(isset($doc->{'description_value'}[0]))$data['description']=htmlentities($doc->{'description_value'}[0]);
			$data['doc'] = $doc;
			
			
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
                        $data['widget_map'] = true;
                      
			if($numFound>0){
				$this->load->view('dataview', $data);
			}else show_404('page');
		}
		else 
		{
			show_404('page');

		}
	
	}
        
	public function viewitem($key){
		redirect('view/?key='.$key);
	}
	
	
        
	private function transform($registryObjectsXML, $xslt,$key){
             
                $qtestxsl = new DomDocument();
                $registryObjects = new DomDocument();   
		$registryObjects->loadXML(trim($registryObjectsXML));  
		$qtestxsl->load('_xsl/'.$xslt);
		$proc = new XSLTProcessor();
		$proc->importStyleSheet($qtestxsl);
		$proc->setParameter('','base_url',base_url());
                $orca_view = view_url();
		$proc->setParameter('','orca_view',$orca_view);
		$proc->setParameter('','key',$key);     
                $transformResult = $proc->transformToXML($registryObjects);	
		return $transformResult;
	}


}
?>