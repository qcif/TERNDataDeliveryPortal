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


	public function index(){

                 $this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
            
                if ($this->agent->is_mobile()){
                
                   if($this->input->get('theme') == 'web'){
                        
                        $cookie = array(
                            'name'   => 'theme',
                            'value'  => 'web',
                            'expire' => '500',
                            'domain' => '.tern.org.au',
                            'secure' => TRUE
                        );
                    }elseif($this->input->cookie('theme') == '' ) {

                        redirect('m');
                    }



                }
                $this->load->model('Registryobjects');
                $query = $this->Registryobjects->get_min_year();
                if($query) $row = $query->row();
 
                //$data['min_date'] = $row;

                $data['min_year'] = $row->min_year;
                $data['max_year'] = $row->max_year;
		$this->load->model('Solr');
		//$data['json'] = $this->Solr->getNCRISPartners();
		$data['home'] = 1;
		$data['tabs'] = 1;
		//echo $data['user_agent'];

                $data['tab-slider-id']="date-slider";
                $data['adv-slider-id']="date-slider-adv";
                
		$this->handleFORTab($data['subject']);
              
                $this->handleDataTypeTab($data['dataTypeLvl1'],$data['dataTypeLvl2']);
      

		$this->load->view('home_page', $data);
	}
	
        public function advancesrch(){
                //get Temporal 
                $this->load->model('Registryobjects');
                $query = $this->Registryobjects->get_min_year();
                if($query) $row = $query->row();              
                $data['min_year'] = $row->min_year;
                $data['max_year'] = $row->max_year;
                $data['widget_temporal'] = 1;
                
                //get Group
                $this->load->model('Solr');
                $queryFacilities = $this->Solr->getFacilities();
                $data['facilities'] = $queryFacilities->{'facet_counts'}->{'facet_fields'}->{'group'};
                $data['widget_facilities'] = 1;
                
                //get Subject
                include APPPATH . '/views/tab/forstat.php';
                $data['widget_for'] = 1;
                $data['subject'] = $subject;
              
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
                
                //get Map widget

                $data['widget_map'] = 1;
                $data['widget_map_drawtoolbar'] = 1;
                $data['widget_map_coords'] = 1;
                
                //get Keyword
                $data['widget_keyword'] = 1;
                
                
		$this->load->view('content/advancesrch', $data);
	}
        
	public function about(){
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
		$this->load->view('content/about', $data);
	}
	
	public function disclaimer(){
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
		$this->load->view('content/disclaimer', $data);
	}
	
	public function help(){
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
		$this->load->view('content/help', $data);
	}
	
	public function contact(){
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
		$this->load->view('content/contact_form', $data);
	}
	
	public function send(){
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$content = $this->input->post('content');
		
		$this->load->library('email');

		$this->email->from($email, $name);
		$this->email->to('services@tern.org.au');
		
		$this->email->subject('Contact Us');
		$this->email->message($content);	
		
		$this->email->send();
		
		echo '<b>Thank you for your response. Your message has been delivered successfully</b>';
	}

	public function homepage(){
		$this->load->model('Solr');
             
                $data['json'] = $this->Solr->getNCRISPartners();

		$this->load->view('home_page', $data);
	}
	
	public function notfound(){
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
		$data['message']='Whoops! Page not found!';
		$this->load->view('layout',$data);
	}



        /*get statistics for FOR tab, get the names for the parent two digit FOR code and the four digit FOR code*/
        private function handleFORTab(&$subject){
            $this->load->model('Registryobjects','ro');
            include APPPATH . '/views/tab/forstat.php';            
        }
        

        /*get data type stats, find the parent name and put in respective arrays */
       private function handleDataTypeTab(&$dataTypeLvl1,&$dataTypeLvl2){
            $this->load->model('Registryobjects','ro');
            include APPPATH . 'views/tab/datatypestat.php';
            $dataTypeLvl1 = array();
            $dataTypeLvl2 = array();

            if(count($datatype)>0) { ksort($datatype);


            foreach($datatype as $key=>$value){
                $parentQ = $this->ro->getParentTerms('TERN',$key);
                 if($parentQ) $row = $parentQ->row();
                 if($row->name!='') {
                    array_push($dataTypeLvl1, array('name' => $row->name));
                    $dataTypeLvl2[$row->name][$key] = array('name' => $key, 'stat' => $value);
                    }
            }
              }
            if(count($dataTypeLvl2)>1) ksort($dataTypeLvl2);
        }

    
        }
