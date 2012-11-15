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

class Home extends CI_Controller {

	/* This loads the home page of the portal*/
	public function index(){

                $this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();

                $this->load->model('Registryobjects');
                $query = $this->Registryobjects->get_min_year();
                if($query) $row = $query->row();
 
                //$data['min_date'] = $row;

                $data['min_year'] = $row->min_year;
                $data['max_year'] = $row->max_year;
		
                $this->load->model('Solr');
                $data['json'] = $this->Solr->getTERNPartners();
                
                $data['topics']=$this->Solr->getTopics();

		$data['home'] = 1;
		$data['tabs'] = 1;


                $data['recordsArr'] = $this->handleRandomTab(10,'tddp');
		$this->load->view('home_page', $data);
	}
	
	/* Get random records from the facilities*/
        public function getrdmrecord()
        {
             
           if(isset($_GET['fac']))
                $fac=$_GET['fac'];
            else
                $fac="tddp";

            $this->load->model('Solr');
            $data['json'] = $this->Solr->getTERNPartners();
            $data['topics']=$this->Solr->getTopics();
            $data['recordsArr'] = $this->handleRandomTab(10,$fac);

            $data['fackey']=$fac;

            $this->load->view('facilityrandom',$data);
        }
		
	/* This is a hidden page, to test map widget capabilities*/
        public function mapproto(){
                $data['widget_map'] = 1;
              
                 // get Regions  File
                $regions = json_decode(file_get_contents('http://' . HOST.  '/api/regions.json', TRUE));
                $regions = $regions->layers;
                 for($i=0;$i<count($regions);$i++){                  
                    $regions[$i]->features =  json_decode(file_get_contents('http://' . REGIONS_URL . '/r/getList/' . $regions[$i]->l_id));                     
                 }
                 $data["regions"] = $regions;
                $this->load->view('content/mapproto',$data);
        }
		
	/* This leads to the research infrastructure page map*/
	public function infrastructure(){
                $data['widget_map'] = 1; // flag so the MapWidget.js is included in the footer
                $data['infrastructure_map'] = 1; // flag so the infrastructure javascript is loaded
                $this->load->view('content/infrastructure',$data);
        }

        
		/* page not found view for 404 */ 
		public function notfound(){
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
			$data['message']='Page not found!';
					$this->load->model('Solr');
					$data['json'] = $this->Solr->getTERNPartners();

					$this->load->view('layout',$data);
		}
		/* Static page area*/
		public function accessdata(){
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
			$this->load->view('terndata/accessdata', $data);
		}
			
                public function submitdata(){
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
			$this->load->view('terndata/submitdata', $data);
		}
			
		public function licensing(){
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
			$data['load_license_js'] = 1;
			$this->load->view('terndata/licensing', $data);
					
		}
		public function terms(){
			$this->load->library('user_agent');
			$data['user_agent']=$this->agent->browser();
			$this->load->view('terndata/terms', $data);
		}
		
        
    
        /*get 10 random records*/
        private function handleRandomTab($num,$fac){

            $this->load->model('Solr','Solr');

            $randomRJson = $this->Solr->getRandomRecords($num,$fac);
            
            $recordsArr = $randomRJson->{'response'}->{'docs'};
            return $recordsArr;
            
        }    


    
        }
