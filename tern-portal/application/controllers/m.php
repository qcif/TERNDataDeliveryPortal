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

class M extends CI_Controller {

	public function index(){

      
		$this->load->model('solr');
		//$data['json'] = $this->Solr->getNCRISPartners();
                $data['json']=$this->solr->getStat('index','collection');
	
		$this->load->view('mobile/home', $data);
	}
	
	public function search(){//AJAX CALL, VERY IMPORTANT, this thing is called on every search
                $this->benchmark->mark('search_start');
		$q = $this->input->get('q');
		$q = trim($q); //remove spaces

		if($q=='') $q="*:*";

                $page = $this->input->get('p');
                if($page=='') $page=1;
                $groupFilter = urldecode($this->input->get('group'));
                if($groupFilter=='') $groupFilter='All';
                $classFilter = $this->input->get('class');
                if($classFilter=='') $classFilter='All';
		$typeFilter = urldecode($this->input->get('type'));
		if($typeFilter=='') $typeFilter='All';
		$subjectFilter = urldecode($this->input->get('subject'));
                if($subjectFilter=='') $subjectFilter='All';
                
                $fortwoFilter = urldecode($this->input->get('fortwoFilter'));
                 if($fortwoFilter=='') $fortwoFilter='All';
                 $forfourFilter = urldecode($this->input->get('forfourFilter'));
                 if($forfourFilter=='') $forfourFilter='All';
                 $forsixFilter = urldecode($this->input->get('forsixFilter'));
                if($forsixFilter=='') $forsixFilter='All';
		/*
		$spatial_included_ids = $this->input->post('spatial_included_ids');
		$temporal = $this->input->post('temporal');
                $alltab = $this->input->post('alltab');
                */

		$query = $q;
		$extended_query = '';

		//echo '+spatial:('.$spatial_included_ids.')';
                /*
		if($spatial_included_ids!='') {
			$extended_query .= $spatial_included_ids;
		}
		if($temporal!='All'){
			$temporal_array = explode('-', $temporal);
			$extended_query .='+dateFrom:['.$temporal_array[0].' TO *]+dateTo:[* TO '.$temporal_array[1].']';
		}
                */
		//echo $query;

		/*Search Part*/

		$this->load->model('solr');
		$data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $classFilter, $groupFilter, $typeFilter, $subjectFilter, $fortwoFilter, $forfourFilter,$forsixFilter,'PUBLISHED');
        
             
		//print_r($data['json']);

		/**getting the tabbing right**/
		$data['json_tab'] = $data['json'];
                //$this->solr->search($query, $extended_query, 'json', $page, 'All', $groupFilter, $typeFilter, $subjectFilter,'PUBLISHED');//just for the tabbing mechanism (getting the numbers right)
		/*just that! and json_tab is used in tab view*/

		/**getting the facet right**/
		//$query_tab = $q;
		//$data['json_facet']=$this->solr->search($query, $page, $classFilter);//just for the tabbing mechanism (getting the numbers right)

		/*Passing Variables down to the view*/
		if($q=='*:*') $q = 'All Records';
		$data['query']=$q;
		$data['classFilter']=$classFilter;
		$data['typeFilter']=$typeFilter;
		$data['groupFilter']=$groupFilter;
		$data['subjectFilter']=$subjectFilter;
		$data['page']=$page;/*
                $data['alltab'] = $alltab;
		$data['spatial_included_ids']=$spatial_included_ids;
		$data['temporal']=$temporal;
*/


		$this->benchmark->mark('search_end');
		//echo $this->benchmark->elapsed_time('search_start', 'search_end');

		$this->load->view('mobile/search_result', $data);//load the view
	}

	public function view(){
                parse_str($_SERVER['QUERY_STRING'], $_GET);

		if(isset($_GET['key'])){
			$key = ($_GET['key']);
			//echo $key;
			$this->load->model('RegistryObjects', 'ro');
                        $content = htmlspecialchars_decode($this->ro->get($key));
                        $data['key']= $key;
                        $this->load->model('Solr', 'solr');

                        //$connection = $this->load->view('mobile/connections', $this->connections("count",null,null,"relatedObject_key:".$key,null,$key),true);
                        
                        $connection = $this->load->view('mobile/connections', $this->connections("count",null,null,"related_object_key:".$key,null,$key),true); 


                        $data['content'] = $this->transform($content, 'rifcs2ViewMobile.xsl',urlencode($key),$connection);
			//$data['content'] = $content;
                    
			$this->load->view('mobile/view', $data);
		}else{
			show_404('page');
		}
        }
        private function transform($registryObjectsXML, $xslt,$key,$connection=null){
		$qtestxsl = new DomDocument();
		$registryObjects = new DomDocument();
		$registryObjects->loadXML($registryObjectsXML);
		$qtestxsl->load('_xsl/'.$xslt);
		$proc = new XSLTProcessor();
		$proc->importStyleSheet($qtestxsl);
                $proc->setParameter('','connection',$connection);
              
		$proc->setParameter('','base_url',base_url());
		$orca_view = $this->config->item('orca_view');
		$proc->setParameter('','orca_view',$orca_view);
		$proc->setParameter('','key',$key);
		$transformResult = $proc->transformToXML($registryObjects);
		return $transformResult;
	}
	public function notfound(){
		$this->load->library('user_agent');
		$data['user_agent']=$this->agent->browser();
		$data['message']='Page not found!';
		$this->load->view('layout',$data);
	}

	function getRelationship($key,$relatedKey)
	{

		$this->load->model('solr');
		$object = $this->solr->getObjects($related,null,null,null);
		if(isset($object->{'response'}->{'docs'}[0])){

		//$keyList = $object->{'response'}->{'docs'}[0]->{'relatedObject_key'};
                $keyList = $object->{'response'}->{'docs'}[0]->{'related_object_key'};
		//$relationshipList = $object->{'response'}->{'docs'}[0]->{'relatedObject_relation'};
                $relationshipList = $object->{'response'}->{'docs'}[0]->{'related_object_relation'};


                return getRelationship($keyList, $relationshipList);
                }
	}

 function connections($type="count",$class=null,$types=null, $query=null,$page=null,$key=null){//for rda connections

     $this->load->model('solr');
        $classArray = array('collection','service','activity');
        $typeArray = array('person', 'group');
        if(!$page)$page=null;
       	$keyArray[] = $key;
        $data['json'] =$this->solr->getObjects($keyArray,$class,$types,null);
		$data['externalKeys']  ='';
        $reverseLinks = $data['json']->{'response'}->{'docs'}[0]->{'reverseLinks'};
        $dataSourceKey = $data['json']->{'response'}->{'docs'}[0]->{'data_source_key'};
        $data['thisClass'] = $data['json']->{'response'}->{'docs'}[0]->{'class'};
		$data['externalKeys'] = '';
        if(!$types and !$class)
        {
        	foreach($classArray as $class)
        	{
        		$data[$class]['json'][0] =$this->solr->getRelated($key,$class,$types);
         		$relatedKeys = array();
        		foreach($data[$class]['json'][0]->{'response'}->{'docs'} as $r)
        		{

        			//$relatedNum = count($r->{'relatedObject_key'});

                                $relatedNum = count($r->{'related_object_key'});
        			
                                $relatedKeys = '';
        			$relationship = '';
        			for($i = 0; $i<$relatedNum;$i++)
        			{
        				//if($r->{'relatedObject_relatedObjectClass'}[$i]==$class)
                                          if($r->{'related_object_class'}[$i]==$class)
        				{
        					//$relatedKeys[] = $r->{'relatedObject_key'}[$i];
                                                $relatedKeys[] = $r->{'related_object_key'}[$i];
        					//$data[$class]['relationship'][] = $r->{'relatedObject_relation'}[$i];
                                                $data[$class]['relationship'][] = $r->{'related_object_relation'}[$i];

        				}
        			}
        		}
        		if($reverseLinks!="NONE"){

        			$data[$class]['json'][1] =$this->solr->getConnections($key,$class,$types,$relatedKeys,$reverseLinks,$dataSourceKey);
        			$data[$class]["extrnal"] =$this->solr->getConnections($key,$class,$types,$relatedKeys,'EXT',$dataSourceKey);

					if($data[$class]["extrnal"]->{'response'}->{'numFound'}>0)
					{

        				foreach($data[$class]["extrnal"]->{'response'}->{'docs'} as $r)
        				{
        					$extrnalNum = count($r->{'key'});
        					for($i = 0; $i<$extrnalNum;$i++)
        					{
        						if($r->{'class'}==$class)
        						{
        							$data['externalKeys'][] = $r->{'key'};
        						}
        					}
        				}
					}

      				foreach($data[$class]['json'][1]->{'response'}->{'docs'} as $r)
        			{
        				$connectedNum = count($r->{'key'});
        				for($i = 0; $i<$connectedNum;$i++)
        				{
        					if($r->{'class'}==$class)
        					{
        						$relatedKeys[] = $r->{'key'};
        						$data[$class]['relationship'][] = $this->getRelationship($key,$r->{'key'});
        					}
        				}
        			}
        		}
  				$data[$class]['json'] = $this->solr->getObjects($relatedKeys,$class,$types,$page=null);
  				$data[$class]['numfound'] = $data[$class]['json']->{'response'}->{'numFound'};
        	}
            foreach($typeArray as $types)
        	{
        		$relatedKeys = '';
        		$data[$types]['json'][0]=$this->solr->getRelated($key,'party',$types);
        		$relatedKeys = array();
        		foreach($data[$types]['json'][0]->{'response'}->{'docs'} as $r)
        		{

        			//$relatedNum = count($r->{'relatedObject_key'});
                                $relatedNum = count($r->{'related_object_key'});
        			$relatedKeys = '';
        			for($i = 0; $i<$relatedNum;$i++)
        			{
        				//if($r->{'relatedObject_relatedObjectType'}[$i]==$types)
                                    if($r->{'related_object_type'}[$i]==$types)
        				{
        					//$relatedKeys[] = $r->{'relatedObject_key'}[$i];
                                            $relatedKeys[] = $r->{'related_object_key'}[$i];
        					//$data[$types]['relationship'][] = $r->{'relatedObject_relation'}[$i];
                                            $data[$types]['relationship'][] = $r->{'related_object_relation'}[$i];

         				}
        			}
        		}
        		if($reverseLinks!="NONE"){
            		$data[$types]['json'][1] =$this->solr->getConnections($key,'party',$types,$relatedKeys,$reverseLinks,$dataSourceKey);
        			$data[$class]["extrnal"] =$this->solr->getConnections($key,$class,$types,$relatedKeys,'EXT',$dataSourceKey);
					if($data[$class]["extrnal"]->{'response'}->{'numFound'}>0)
					{

        				foreach($data[$class]["extrnal"]->{'response'}->{'docs'} as $r)
        				{
        					$extrnalNum = count($r->{'key'});
        					for($i = 0; $i<$extrnalNum;$i++)
        					{
        						if($r->{'type'}==$types)
        						{
        							$data['externalKeys'][] = $r->{'key'};
        						}
        					}
        				}
					}

        			foreach($data[$types]['json'][1]->{'response'}->{'docs'} as $r)
        			{
        				$connectedNum = count($r->{'key'});
        				for($i = 0; $i<$connectedNum;$i++)
        				{
         					if($r->{'type'}==$types)
        					{
        						$relatedKeys[] = $r->{'key'};
        						$data[$types]['relationship'][] = $this->getRelationship($key,$r->{'key'});
        					}
        				}
        			}
        		}

       			$data[$types]['json'] = $this->solr->getObjects($relatedKeys,'party',$types,$page=null);
       			$data[$types]['numfound'] = $data[$types]['json']->{'response'}->{'numFound'};
        	}
        }else{
        	$relatedKeys = '';
			if($types='undefined')$types = null;
         	$data['json'] =$this->solr->getRelated($key,$class,$types);
        	$relatedKeys = array();
        	foreach($data['json']->{'response'}->{'docs'} as $r)
        	{

        		//$relatedNum = count($r->{'relatedObject_key'});
                    $relatedNum = count($r->{'related_object_key'});
        		$relatedKeys = '';
        		for($i = 0; $i<$relatedNum;$i++)
        		{
        			//if($r->{'relatedObject_relatedObjectClass'}[$i]==$class)
                                if($r->{'related_object_class'}[$i]==$class)
        			{
        				//$relatedKeys[] = $r->{'relatedObject_key'}[$i];
                                        $relatedKeys[] = $r->{'related_object_key'}[$i];

         			}
        		}
        	}
        	if($reverseLinks!="NONE")
        	{
           		$data['json'] =$this->solr->getConnections($key,$class,$types,$relatedKeys,$reverseLinks,$dataSourceKey);
         		$data["extrnal"] =$this->solr->getConnections($key,$class,$types,$relatedKeys,'EXT',$dataSourceKey);
				if($data["extrnal"]->{'response'}->{'numFound'}>0)
				{
        			foreach($data["extrnal"]->{'response'}->{'docs'} as $r)
        			{
        				$extrnalNum = count($r->{'key'});
        				for($i = 0; $i<$extrnalNum;$i++)
        				{
        					if($r->{'class'}==$class)
        					{
        						$data['externalKeys'][] = $r->{'key'};
        					}
        				}
        			}
				}
      			foreach($data['json']->{'response'}->{'docs'} as $r)
        		{
        			$connectedNum = count($r->{'key'});
        			for($i = 0; $i<$connectedNum;$i++)
        			{
        				if($r->{'class'}==$class)
        				{
        					$relatedKeys[] = $r->{'key'};
         				}
        			}
        		}
        	}

       		$data['json'] = $this->solr->getObjects($relatedKeys,$class,$types,$page);
       		$data['numfound'] = $data['json']->{'response'}->{'numFound'};

        }
          return $data;
	}


}