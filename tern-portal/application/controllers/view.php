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
		
		if(isset($_GET['key'])){
			$key = ($_GET['key']);
			//echo $key;
			$this->load->model('RegistryObjects', 'ro');
                        $content =  $this->ro->get($key);
                        $data['key']= $key;
                        $data['content'] = $this->transform($content, 'rifcs2View.xsl',urlencode($key));
                        
			$query = $this->ro->get_min_year();
                        $row = $query->row();

                //$data['min_date'] = $row;

                        $data['min_year'] = $row->min_year;
                        $data['max_year'] = $row->max_year;
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
			//header("Content-Type: text/html; charset=UTF-8", true);
			$this->load->view('xml-view', $data);
		}else{
			show_404('page');
		}				
	}

	public function viewitem($key){
		redirect('view/?key='.$key);
	}
	
	public function printview(){
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		
		if(isset($_GET['key'])){
			$key = $_GET['key'];
			$this->load->model('RegistryObjects', 'ro');
	       	$content = $this->ro->get($key);
	       	$data['key']= $key;  	
			$data['content'] = $this->transform($content, 'rifcs2View.xsl',$key);	
			
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
			
			$this->load->view('print-view', $data);
		}else{
			show_404('page');
		}
		
	}


	private function transform($registryObjectsXML, $xslt,$key){
		$qtestxsl = new DomDocument();
		$registryObjects = new DomDocument();
		$registryObjects->loadXML($registryObjectsXML);
            //    print_r($registryObjectsXML);
		$qtestxsl->load('_xsl/'.$xslt);
		$proc = new XSLTProcessor();
		$proc->importStyleSheet($qtestxsl);
		$proc->setParameter('','base_url',base_url());
		$orca_view = $this->config->item('orca_view');
		$proc->setParameter('','orca_view',$orca_view);
		$proc->setParameter('','key',$key);
		$transformResult = $proc->transformToXML($registryObjects);	
		return $transformResult;
	}
}
?>