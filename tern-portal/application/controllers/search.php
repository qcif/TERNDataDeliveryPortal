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

 * *******************************************************************************
  $Date: 2011-09-06 11:35:57 +1000 (Tue, 06 Sep 2011) $
  $Revision: 1 $
 * **************************************************************************
 *
 * */
?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller
{

    public function index()
    {
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        if (isset($_GET['q']))
        {
            $q = $_GET['q'];
            redirect(base_url() . 'search/#!/q=' . $q);
        }
        else
        {
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
                $this->lang->load('tooltipMap');
                $this->lang->load('helpMap'); 
                $data['widget_map'] = 1;
                $data['widget_map_drawtoolbar'] = 1;
      
                $this->load->model('Solr');
                $data['json'] = $this->Solr->getTERNPartners();

                $data['title'] = "Search TERN Data Discovery Portal";
                //get Keyword
                $data['widget_keyword'] = 1;
            
                            
            $this->load->view('new_search', $data);
        }
    }

    public function bwredirect()
    {//backward redirection with list.php
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $class = 'All';
        $group = 'All';
        if (isset($_GET['class']))
            $class = $_GET['class'];
        if (isset($_GET['group']))
            $group = $_GET['group'];
        $this->browse($group, $class);
    }

    public function browse($group = 'All', $class='All')
    {//yeah, just redirect the browsing to the search page for now
        if ($class != 'All')
            $class = strtolower($class);
        redirect(base_url() . 'search#!/p=1/tab=' . $class . '/group=' . urldecode($group));
    }

    public function updateStatistic()
    {//update the statistics
        $query = $this->input->post('q');
        $class = $this->input->post('classFilter');
        $group = $this->input->post('groupFilter');
        $subject = $this->input->post('subjectFilter');
        $this->load->model('Registryobjects', 'ro');
        $this->ro->updateStatistic($query, $class, $group, $subject);
    }

    public function service_front()
    {//front    end for orca search service
        $this->load->view('service_front');
    }

    public function service()
    {//orca search service

        $this->load->model('solr');
        $query = $this->input->post('query');
        $class = $this->input->post('class');
        $group = $this->input->post('group');
        $subject = $this->input->post('subject');
        $page = $this->input->post('page');
        $status = $this->input->post('status');
        $source_key = $this->input->post('source_key');
        

        $sort="score desc";
        
        $extended_query = '';
        if ($source_key != 'undefined')
        {
            if ($source_key != 'All')
                $extended_query = '+data_source_key:("' . $source_key . '")';
        }
        if ($status == 'undefined')
        {
            $status = 'All';
        }

       // $data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $class, $group, 'All', $subject, $status);
        $data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $class, $group, 'All', $subject, 'All','All','All', 'PUBLISHED',$sort, 'All');
        $this->load->view('search/service', $data);
    }

    public function seeAlso($type="count", $seeAlsoType='subjects')
    {//for rda see also
        $this->load->model('solr');
        $query = $this->input->post('q');
        $class = $this->input->post('classFilter');
        $group = $this->input->post('groupFilter');
        $subject = $this->input->post('subjectFilter');
        $page = $this->input->post('page');
        $extended = $this->input->post('extended');
        $excluded_key = $this->input->post('excluded_key');

        $fortwo = "All";
        $forfour ="All";
        $forsix = "All";
        
        $sort="score desc";
        $extended_query = $extended . '-key:("' . escapeSolrValue($excluded_key) . '")';
        //$extended_query='';
        //$extended_query .=constructFilterQuery('subject_value', $subject).'^100';

        $data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $class, $group, 'All', $subject, $fortwo,$forfour,$forsix, 'PUBLISHED',$sort, 'All');
 
        $data['numfound'] = $data['json']->{'response'}->{'numFound'};
        $data['seeAlsoType'] = $seeAlsoType;

        if ($type == 'count')
        {
            $this->load->view('search/seeAlso', $data);
        }
        elseif ($type == 'content')
        {
            $this->load->view('search/seeAlsoInfoBox', $data);
        }
    }

    public function seeAlsoOLD()
    {
        echo 'testing';
    }

    function getSeeAlsoParty($key)
    {
        $relation_types = array('custodian', 'isManagedBy', 'isManagerOf');
        $relatedObjectsKeys = $this->getRelatedObjects($key, $relation_types);
        foreach ($relatedObjectsKeys->{'response'}->{'docs'} as $index => $r)
        {
            $relation_types2 = array('custodian', 'isManagedBy');
            echo '<pre>';
            print_r($relation =

                    //$this->getRelatedObjects($r->{'relatedObject_key'}[$index],
                            $this->getRelatedObjects($r->{'related_object_key'}[$index],

                            $relation_types2));
            echo '</pre>';
        }
    }

    function getRelationship($key, $relatedKey)
    {
        $related[] = $relatedKey;
        $typeArray = array(
            "Describes" => "Described by",
            "Associated with" => "Associated with",
            "Aggregated by" => "Collector of",
            "Has member" => "Member of",
            "Produces" => "Output of",
            "Includes" => "Includes",
            "Undertaken by" => "Undertaken by",
            "Collector of" => "Aggregated by",
            "Described by" => "Describes",
            "Funded by" => "Funds",
            "Funds" => "Funded by",
            "Located in" => "Location for",
            "Location for" => "Located in",
            "Managed by" => "Manages",
            "Manages" => "Managed by",
            "Member of" => "Has member",
            "Output of" => "Produces",
            "Owned by" => "Owner of",
            "Owned Of" => "Owned by",
            "Participant in" => "Part of",
            "Part of" => "Participant in",
            "Supported by" => "Supports",
            "Supports" => "Supported by"
        );
        $this->load->model('solr');
        $object = $this->solr->getObjects($related, null, null, null);
        if (isset($object->{'response'}->{'docs'}[0]))
        {

            //$keyList = $object->{'response'}->{'docs'}[0]->{'relatedObject_key'};
            $keyList = $object->{'response'}->{'docs'}[0]->{'related_object_key'};
            //$relationshipList = $object->{'response'}->{'docs'}[0]->{'relatedObject_relation'};
            $relationshipList = $object->{'response'}->{'docs'}[0]->{'related_object_relation'};


            for ($i = 0; $i < count($keyList); $i++)
            {
                if ($keyList[$i] == $key)
                    $relationship = $relationshipList[$i];
            }

            if (array_key_exists($relationship, $typeArray))
            {
                return $typeArray[$relationship];
            }
            else
            {
                return $relationship;
            }
        }
    }

    public function connections($type="count", $class=null, $types=null)
    {//for rda connections
        $this->load->model('solr');
        $query = $this->input->post('q');
        $classArray = array('collection', 'service', 'activity');
        $typeArray = array('person', 'group');
        $page = $this->input->post('page');
        if (!$page)$page = null;
        
        $key = $this->input->post('key');
        $keyArray[] = $key;
        $data['json'] = $this->solr->getObjects($keyArray, $class, $types, null);
  
        $data['externalKeys'] = '';
        $reverseLinks = $data['json']->{'response'}->{'docs'}[0]->{'reverseLinks'};
        $dataSourceKey = $data['json']->{'response'}->{'docs'}[0]->{'data_source_key'};
        $data['thisClass'] = $data['json']->{'response'}->{'docs'}[0]->{'class'};
        $data['externalKeys'] = '';
        if (!$types and !$class)
        {
            foreach ($classArray as $class)
            {
                $data[$class]['json'][0] = $this->solr->getRelated($key, $class, $types);
                $relatedKeys = array();
                 
                foreach ($data[$class]['json'][0]->{'response'}->{'docs'} as $r)
                {

                    //$relatedNum = count($r->{'relatedObject_key'});
                    $relatedNum = count($r->{'related_object_key'});


                    $relatedKeys = '';
                    $relationship = '';
                    for ($i = 0; $i < $relatedNum; $i++)
                    {

                        //if ($r->{'relatedObject_relatedObjectClass'}[$i] == $class)
                        if ($r->{'related_object_class'}[$i] == $class)
                        {
                            //$relatedKeys[] = $r->{'relatedObject_key'}[$i];
                            $relatedKeys[] = $r->{'related_object_key'}[$i];
                            //$data[$class]['relationship'][] = $r->{'relatedObject_relation'}[$i];
                            $data[$class]['relationship'][] = $r->{'related_object_relation'}[$i];

                        }
                    }
                }
                if ($reverseLinks != "NONE")
                {

                    $data[$class]['json'][1] = $this->solr->getConnections($key, $class, $types, $relatedKeys, $reverseLinks, $dataSourceKey);
                    $data[$class]["extrnal"] = $this->solr->getConnections($key, $class, $types, $relatedKeys, 'EXT', $dataSourceKey);

                    if ($data[$class]["extrnal"]->{'response'}->{'numFound'} > 0)
                    {

                        foreach ($data[$class]["extrnal"]->{'response'}->{'docs'} as $r)
                        {
                            $extrnalNum = count($r->{'key'});
                            for ($i = 0; $i < $extrnalNum; $i++)
                            {
                                if ($r->{'class'} == $class)
                                {
                                    $data['externalKeys'][] = $r->{'key'};
                                }
                            }
                        }
                    }

                    foreach ($data[$class]['json'][1]->{'response'}->{'docs'} as $r)
                    {
                        $connectedNum = count($r->{'key'});
                        for ($i = 0; $i < $connectedNum; $i++)
                        {
                            if ($r->{'class'} == $class)
                            {
                                $relatedKeys[] = $r->{'key'};
                                $data[$class]['relationship'][] = $this->getRelationship($key, $r->{'key'});
                            }
                        }
                    }
                }
                $data[$class]['json'] = $this->solr->getObjects($relatedKeys, $class, $types, $page = null);
                $data[$class]['numfound'] = $data[$class]['json']->{'response'}->{'numFound'};
            }
            foreach ($typeArray as $types)
            {
                $relatedKeys = '';
                $data[$types]['json'][0] = $this->solr->getRelated($key, 'party', $types);
                $relatedKeys = array();
                foreach ($data[$types]['json'][0]->{'response'}->{'docs'} as $r)
                {

                    //$relatedNum = count($r->{'relatedObject_key'});
                    $relatedNum = count($r->{'related_object_key'});
                    $relatedKeys = '';
                    for ($i = 0; $i < $relatedNum; $i++)
                    {
                        //if ($r->{'relatedObject_relatedObjectType'}[$i] == $types)
                        if ($r->{'related_object_type'}[$i] == $types)
                        {
                            //$relatedKeys[] = $r->{'relatedObject_key'}[$i];
                            $relatedKeys[] = $r->{'related_object_key'}[$i];
                            //$data[$types]['relationship'][] = $r->{'relatedObject_relation'}[$i];
                            $data[$types]['relationship'][] = $r->{'related_object_relation'}[$i];

                        }
                    }
                }
                if ($reverseLinks != "NONE")
                {
                    $data[$types]['json'][1] = $this->solr->getConnections($key, 'party', $types, $relatedKeys, $reverseLinks, $dataSourceKey);
                    $data[$class]["extrnal"] = $this->solr->getConnections($key, $class, $types, $relatedKeys, 'EXT', $dataSourceKey);
                    if ($data[$class]["extrnal"]->{'response'}->{'numFound'} > 0)
                    {

                        foreach ($data[$class]["extrnal"]->{'response'}->{'docs'} as $r)
                        {
                            $extrnalNum = count($r->{'key'});
                            for ($i = 0; $i < $extrnalNum; $i++)
                            {
                                if ($r->{'type'} == $types)
                                {
                                    $data['externalKeys'][] = $r->{'key'};
                                }
                            }
                        }
                    }

                    foreach ($data[$types]['json'][1]->{'response'}->{'docs'} as $r)
                    {
                        $connectedNum = count($r->{'key'});
                        for ($i = 0; $i < $connectedNum; $i++)
                        {
                            if ($r->{'type'} == $types)
                            {
                                $relatedKeys[] = $r->{'key'};
                                $data[$types]['relationship'][] = $this->getRelationship($key, $r->{'key'});
                            }
                        }
                    }
                }

                $data[$types]['json'] = $this->solr->getObjects($relatedKeys, 'party', $types, $page = null);
                $data[$types]['numfound'] = $data[$types]['json']->{'response'}->{'numFound'};
            }
        }
        else
        {
            $relatedKeys = '';
            if ($types = 'undefined'
                )$types = null;
            $data['json'] = $this->solr->getRelated($key, $class, $types);
            $relatedKeys = array();
            foreach ($data['json']->{'response'}->{'docs'} as $r)
            {

                //$relatedNum = count($r->{'relatedObject_key'});
                $relatedNum = count($r->{'related_object_key'});
                $relatedKeys = '';
                for ($i = 0; $i < $relatedNum; $i++)
                {
                   // if ($r->{'relatedObject_relatedObjectClass'}[$i] == $class)
                     if ($r->{'related_object_class'}[$i] == $class)
                    {
                        //$relatedKeys[] = $r->{'relatedObject_key'}[$i];
                        $relatedKeys[] = $r->{'related_object_key'}[$i];

                    }
                }
            }
            if ($reverseLinks != "NONE")
            {
                $data['json'] = $this->solr->getConnections($key, $class, $types, $relatedKeys, $reverseLinks, $dataSourceKey);
                $data["extrnal"] = $this->solr->getConnections($key, $class, $types, $relatedKeys, 'EXT', $dataSourceKey);
                if ($data["extrnal"]->{'response'}->{'numFound'} > 0)
                {
                    foreach ($data["extrnal"]->{'response'}->{'docs'} as $r)
                    {
                        $extrnalNum = count($r->{'key'});
                        for ($i = 0; $i < $extrnalNum; $i++)
                        {
                            if ($r->{'class'} == $class)
                            {
                                $data['externalKeys'][] = $r->{'key'};
                            }
                        }
                    }
                }
                foreach ($data['json']->{'response'}->{'docs'} as $r)
                {
                    $connectedNum = count($r->{'key'});
                    for ($i = 0; $i < $connectedNum; $i++)
                    {
                        if ($r->{'class'} == $class)
                        {
                            $relatedKeys[] = $r->{'key'};
                        }
                    }
                }
            }

            $data['json'] = $this->solr->getObjects($relatedKeys, $class, $types, $page);
            $data['numfound'] = $data['json']->{'response'}->{'numFound'};
        }
        if ($type == 'count')
        {
            $this->load->view('search/connections', $data);
        }
        elseif ($type == 'content')
        {
            $this->load->view('search/connectionsInfoBox', $data);
        }
    }

    public function getRelatedObjects($key, $relation_types)
    {
        $this->load->model('solr');
        $relatedObject_keys = $this->solr->getRelatedKeys($key, $relation_types);
        return $relatedObject_keys;
    }

    public function filter()
    {//AJAX CALL, VERY IMPORTANT, this thing is called on every search
        $this->benchmark->mark('search_start');
        $q = $this->input->post('q');
        $q = trim($q); //remove spaces

        if (($q == '') || ($q == 'Search ecosystem data'))
            $q = "*:*";
      
        //echo $q;
        //Filtering if there is any
        $classFilter = $this->input->post('classFilter');
        $typeFilter = urldecode($this->input->post('typeFilter'));
        $groupFilter = urldecode($this->input->post('groupFilter'));
        $subjectFilter = urldecode($this->input->post('subjectFilter'));
       
        $fortwoFilter = urldecode($this->input->post('fortwoFilter'));
        $forfourFilter = urldecode($this->input->post('forfourFilter'));
        $forsixFilter = urldecode($this->input->post('forsixFilter'));
        $ternRegionFilter = urldecode($this->input->post('ternRegionFilter'));
        $page = $this->input->post('page');
        $spatial_included_ids = $this->input->post('spatial_included_ids');
        $temporal = $this->input->post('temporal');
        $alltab = $this->input->post('alltab');
        $sort = $this->input->post('sort');
         
        $num=$this->input->post('num');
     
       
        
        $query = $q;
        $extended_query = '';
        
        //echo '+spatial:('.$spatial_included_ids.')';

        if ($spatial_included_ids != '')
        {
            $extended_query .= $spatial_included_ids;
        }
        if ($temporal != 'All' && $temporal !='')
        {
            $temporal_array = explode('-', $temporal);
            //$extended_query .='+dateFrom:[' . $temporal_array[0] . ' TO *]+dateTo:[* TO ' . $temporal_array[1] . ']';

             //$extended_query .='+dateFrom:[* TO '. $temporal_array[1].']+dateTo:['.$temporal_array[0] . ' TO *]';
              $extended_query .='+date_from:[* TO '. $temporal_array[1].']+date_to:['.$temporal_array[0] . ' TO *]';

        }

        //echo $query;

        /* Search Part */

        $this->load->model('solr');

//        $data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $classFilter, $groupFilter, $typeFilter, $subjectFilter, $fortwoFilter, $forfourFilter,$forsixFilter,'PUBLISHED',$sort, $adv, $ternRegionFilter);

        $data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $classFilter, $groupFilter, $typeFilter, $subjectFilter, $fortwoFilter, $forfourFilter,$forsixFilter,'PUBLISHED',$sort, $ternRegionFilter,$num);

        if ($classFilter == 'collection')
        {
            // $data['result_spatial']= $this->solr->search($query, $extended_query, 'json', $page, $classFilter, $groupFilter, $typeFilter, $subjectFilter,'PUBLISHED');
        }
        
        /*         * getting the tabbing right* */
        $query_tab = $q;

//        $data['json_tab'] = $this->solr->search($query, $extended_query, 'json', $page, 'All', $groupFilter, $typeFilter, $subjectFilter,$fortwoFilter, $forfourFilter,$forsixFilter,'PUBLISHED',$sort, $adv, $ternRegionFilter); //just for the tabbing mechanism (getting the numbers right)

        $data['json_tab'] = $this->solr->search($query, $extended_query, 'json', $page, 'All', $groupFilter, $typeFilter, $subjectFilter,$fortwoFilter, $forfourFilter,$forsixFilter,'PUBLISHED',$sort, $ternRegionFilter,$num); //just for the tabbing mechanism (getting the numbers right)

        /* just that! and json_tab is used in tab view */

        /*         * getting the facet right* */
        //$query_tab = $q;
        //$data['json_facet']=$this->solr->search($query, $page, $classFilter);//just for the tabbing mechanism (getting the numbers right)

        /* Passing Variables down to the view */
        if ($q == '*:*')
            $q = 'All Records';
        $data['query'] = $q;
        $data['classFilter'] = $classFilter;
        $data['typeFilter'] = $typeFilter;
        $data['groupFilter'] = $groupFilter;
        $data['subjectFilter'] = $subjectFilter;
        $data['subjectCodeFilter'] = $subjectCodeFilter;
        $data['fortwoFilter'] = $fortwoFilter;
        $data['forfourFilter'] = $forfourFilter;
        $data['forsixFilter'] = $forsixFilter;
        $data['ternRegionFilter'] = $ternRegionFilter;            
        $data['page'] = $page;
        $data['alltab'] = $alltab;
        $data['spatial_included_ids'] = $spatial_included_ids;
        $data['temporal'] = $temporal;
 
        // get Regions  File
         $regions = json_decode(file_get_contents( REGIONS_CONFIG_PATH, TRUE));
         $regions = $regions->layers;
         for($i=0;$i<count($regions);$i++){                  
              $regionsName[$regions[$i]->l_id] =  json_decode(file_get_contents('http://' . REGIONS_URL . '/r/getList/' . $regions[$i]->l_id));  
              $regionsName[$regions[$i]->l_id]['l_name'] = $regions[$i]->l_name;
              
         }
             
         $data["regionsName"] = $regionsName;

                    //get Temporal 
        $this->load->model('Registryobjects');
        $query = $this->Registryobjects->get_min_year();
        if($query) $row = $query->row();              
        $data['min_year'] = $row->min_year;
        $data['max_year'] = $row->max_year;
        $data['widget_temporal'] = 1;
                
        $this->benchmark->mark('search_end');
        //echo $this->benchmark->elapsed_time('search_start', 'search_end');

        $this->load->view('search/search_result', $data); //load the view
    }

    function jfindSubject()
    {
        $q = $this->input->post('q');
        $q = trim($q); //remove spaces

        if (($q == '') || ($q == 'Search ecosystem data')) // find uncategorized FOR subjects
            $q = "*";
   
        //Filtering if there is any
        $classFilter = 'collection';
        $typeFilter = urldecode($this->input->post('typeFilter'));
        $groupFilter = urldecode($this->input->post('groupFilter'));
        $subjectFilter = urldecode($this->input->post('subjectFilter'));
         $page = $this->input->post('page');
        $spatial_included_ids = $this->input->post('spatial_included_ids');
        $temporal = $this->input->post('temporal');
        $column = $this->input->post('column');
         $output = $this->input->post('output');
        $query = $q;
        $extended_query = '';

        //echo '+spatial:('.$spatial_included_ids.')';
        
        if ($spatial_included_ids != '')
        {
            $extended_query .= $spatial_included_ids;
        }
        if ($temporal != 'All')
        {
            $temporal_array = explode('-', $temporal);

            //$extended_query .='+dateFrom:[* TO '. $temporal_array[1].']+dateTo:['.$temporal_array[0] . ' TO *]';
            $extended_query .='+date_from:[* TO '. $temporal_array[1].']+date_to:['.$temporal_array[0] . ' TO *]';

        }

        /* Search Part */


        $this->load->model('solr');
        $data['json'] = $this->solr->subjectSearch($query, $extended_query, 'json', $page, $classFilter, $groupFilter, $typeFilter, $subjectFilter, 'PUBLISHED', 10000,$column);

      
        /* getting the tabbing right* */
        $query_tab = $q;
        $data['json_tab'] = $data['json'];
        $this->solr->subjectSearch($query, $extended_query, 'json', $page, 'All', $groupFilter, $typeFilter, $subjectFilter, 'PUBLISHED', 10,$column); //just for the tabbing mechanism (getting the numbers right)
        /* just that! and json_tab is used in tab view */

        /*         * getting the facet right* */
        //$query_tab = $q;
        //$data['json_facet']=$this->solr->search($query, $page, $classFilter);//just for the tabbing mechanism (getting the numbers right)

        /* Passing Variables down to the view */
        if ($q == '*:*')
            $q = 'All Records';
        $data['query'] = $q;
        $data['classFilter'] = $classFilter;
        $data['typeFilter'] = $typeFilter;
        $data['groupFilter'] = $groupFilter;
        $data['subjectFilter'] = $subjectFilter;
        $data['page'] = $page;
        $data['spatial_included_ids'] = $spatial_included_ids;
        $data['temporal'] = $temporal;

       print json_encode($data['json']);
         
         

          
    }
 function getListByKeys()
    {
        $q = $this->input->post('q');
        $q = trim($q); //remove spaces

        //echo $q;
        //Filtering if there is any
        $classFilter = 'collection';
        $keyList = $this->input->post('keyList');
        $page = $this->input->post('page');
        $keyList = explode("^",$keyList);
        if(count($keyList) > 0 ){
            if($q == "") $query = "(key:(";
                else
                    $query .= " AND (key:(";
                $separator = "";
             foreach($keyList as $key){
                 $query .= $separator . '"'.$key . '"';
                 $separator = " || ";
             }
            $query .="))";
        }
        /* Search Part */


        $this->load->model('solr');
       // $data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $classFilter, 'All', 'All','All', 'PUBLISHED');
        $data['json'] = $this->solr->getObjects($keyList,null,null,$page);
      
        /* Passing Variables down to the view */
        $data['numfound'] = $data['json']->{'response'}->{'numFound'};
        $data['seeAlsoType'] = $seeAlsoType;
        $data['query'] = $q;
       
        $data['page'] = $page;
        //print_r($query. json_encode($data['json']));
        $this->load->view('search/seeAlsoInfoBox',$data);
         

          
    }
    public function jfilter()
    {//AJAX CALL, VERY IMPORTANT, this thing is called on every search
        $this->benchmark->mark('search_start');
        $q = $this->input->post('q');
        $q = trim($q); //remove spaces

        if (($q == '') || ($q == 'Search ecosystem data'))
            $q = "*:*";
        //echo $q;
        //Filtering if there is any
        $classFilter = $this->input->post('classFilter');
        $typeFilter = urldecode($this->input->post('typeFilter'));
        $groupFilter = urldecode($this->input->post('groupFilter'));
        $subjectFilter = urldecode($this->input->post('subjectFilter'));
        $subjectCode = urldecode($this->input->post('subjectCode'));

        $page = $this->input->post('page');
        $spatial_included_ids = $this->input->post('spatial_included_ids');
        $temporal = $this->input->post('temporal');

        $query = $q;
        $extended_query = '';

        //echo '+spatial:('.$spatial_included_ids.')';

        if ($spatial_included_ids != '')
        {
            $extended_query .= $spatial_included_ids;
        }
        if ($temporal != 'All')
        {
            $temporal_array = explode('-', $temporal);

            //$extended_query .='+dateFrom:[* TO '. $temporal_array[1].']+dateTo:['.$temporal_array[0] . ' TO *]';
            $extended_query .='+date_from:[* TO '. $temporal_array[1].']+date_to:['.$temporal_array[0] . ' TO *]';

       }



        /* Search Part */


        $this->load->model('solr');
        $data['json'] = $this->solr->search($query, $extended_query, 'json', $page, $classFilter, $groupFilter, $typeFilter, $subjectFilter, 'PUBLISHED', $subjectCode);

        print json_encode($data['json']);

        /*         * getting the tabbing right* */
        $query_tab = $q;
        $data['json_tab'] = $data['json'];
        $this->solr->search($query, $extended_query, 'json', $page, 'All', $groupFilter, $typeFilter, $subjectFilter, 'PUBLISHED', $subjectCode); //just for the tabbing mechanism (getting the numbers right)
        /* just that! and json_tab is used in tab view */

        /*         * getting the facet right* */
        //$query_tab = $q;
        //$data['json_facet']=$this->solr->search($query, $page, $classFilter);//just for the tabbing mechanism (getting the numbers right)

        /* Passing Variables down to the view */
        if ($q == '*:*')
            $q = 'All Records';
        $data['query'] = $q;
        $data['classFilter'] = $classFilter;
        $data['typeFilter'] = $typeFilter;
        $data['groupFilter'] = $groupFilter;
        $data['subjectFilter'] = $subjectFilter;
        $data['page'] = $page;
        $data['spatial_included_ids'] = $spatial_included_ids;
        $data['temporal'] = $temporal;



        $this->benchmark->mark('search_end');
        //echo $this->benchmark->elapsed_time('search_start', 'search_end');
    }

    public function spatial()
    {//AJAX CALL
        $north = $this->input->post('north');
        $south = $this->input->post('south');
        $east = $this->input->post('east');
        $west = $this->input->post('west');

        $this->load->model('registryobjects');
        $data['registryObjects'] = $this->registryobjects->spatial($north, $east, $south, $west);

        $this->load->view('search/listIDs', $data);
    }

}
