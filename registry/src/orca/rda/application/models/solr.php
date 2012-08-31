<?php
<<<<<<< HEAD
<<<<<<< HEAD
/**
=======
/** 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
/**
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
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
***************************************************************************
*
<<<<<<< HEAD
<<<<<<< HEAD
**/
=======
**/ 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
**/
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
?>
<?php
	class Solr extends CI_Model {

<<<<<<< HEAD
<<<<<<< HEAD

=======
  
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    function __construct()
    {
        parent::__construct();
    }
<<<<<<< HEAD
<<<<<<< HEAD

	function search($query, $extended_query, $write_type='json', $page, $classFilter ='All', $groupFilter ='All', $typeFilter ='All', $subjectFilter = 'All', $licenceFilter='All', $status='All', $sort='score desc')
    {
        $q=$query;

		$q=rawurlencode($q);$q=str_replace("%5C%22","\"", $q);//silly encoding
		$start = 0;$row = 10;
		if($page!=1) $start = ($page - 1) * $row;

=======
    
	function search($query, $extended_query, $write_type='json', $page, $classFilter ='All', $groupFilter ='All', $typeFilter ='All', $subjectFilter = 'All', $status='All', $sort='score desc')
=======

	function search($query, $extended_query, $write_type='json', $page, $classFilter ='All', $groupFilter ='All', $typeFilter ='All', $subjectFilter = 'All', $licenceFilter='All', $status='All', $sort='score desc')
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    {
        $q=$query;

		$q=rawurlencode($q);$q=str_replace("%5C%22","\"", $q);//silly encoding
		$start = 0;$row = 10;
		if($page!=1) $start = ($page - 1) * $row;
<<<<<<< HEAD
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$solr_url = $this->config->item('solr_url');

    	$filter_query = '';
    	if($classFilter!='All') $filter_query .= constructFilterQuery('class', $classFilter);
    	if($typeFilter!='All') $filter_query .= constructFilterQuery('type', $typeFilter);
    	if($groupFilter!='All') $filter_query .= constructFilterQuery('group', $groupFilter);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

    	if($subjectFilter!='All') {
    		// treat http://-style subject searches as URI searches
    		//if (strpos("http://", ($subjectFilter)) !== FALSE)
    		if (substr(rawurldecode($subjectFilter), 0, 7) === 'http://'){
    			$filter_query .= '(+subject_vocab_uri:("'.rawurldecode($subjectFilter).'") OR +broader_subject_vocab_uri:("'.rawurldecode($subjectFilter).'"))';
    		}
    		else{
    			$filter_query .= constructFilterQuery('subject_value_resolved', $subjectFilter);
    		}
    	}

    	// Fix: if there is no subject to match against (i.e. blank subject) suitably random string will prevent any matches
    	if($subjectFilter == '') $filter_query .= constructFilterQuery('subject_value_resolved', "nr3kl90u3asd");
    	if($licenceFilter!='All') $filter_query .= constructFilterQuery('licence_group', $licenceFilter);
<<<<<<< HEAD
    	if($status!='All') $filter_query .= constructFilterQuery('status', $status);


		$q = urldecode($q);
		// Workaround for ! in last char of query resulting in error (XXX: possibly everything should be quoted??)
		if (strpos($q,"!") !== FALSE)
		{
			$q = '"'.$q.'"';
		}

		//if($q!='*:*')$q = escapeSolrValue($q);

		//$r = '(fulltext:('.$q.') OR key:('.$q.')^50 OR displayTitle:('.$q.')^50 OR listTitle:('.$q.')^50 OR description_value:('.$q.')^5 OR subject_value:('.$q.')^10 OR name_part:('.$q.')^30)';
		//$q .= $r . ' OR (fulltext:('.$q.') -data_source_key:("AU_RESEARCH_GRANTS"))^3000 OR (fulltext:('.$q.') -data_source_key:("nhmrc.gov.au"))^3000';
		if ($q == "*:*")
		{
			$sort = "search_base_score desc";
		}
		$q = '(fulltext:('.$q.') OR key:('.$q.')^50 OR display_title:('.$q.')^50 OR list_title:('.$q.')^50 OR description_value:('.$q.')^5 OR subject_value_resolved:('.$q.')^10 OR ((fulltext:('.$q.') -data_source_key:("AU_RESEARCH_GRANTS"))^3000 OR (fulltext:('.$q.') -data_source_key:("nhmrc.gov.au"))^3000))';


		//$q .= $r;
		//OR (fulltext:('.$q.') -data_source_key:("AU_RESEARCH_GRANTS"))^3000 OR (fulltext:('.$q.') -data_source_key:("nhmrc.gov.au"))^3000

		$q.=($extended_query);

		if($sort!='score desc') $filter_query.='&sort='.$sort;
		$q.=$filter_query;
=======
    	if($subjectFilter!='All') $filter_query .= constructFilterQuery('subject_value', $subjectFilter);
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    	if($status!='All') $filter_query .= constructFilterQuery('status', $status);


		$q = urldecode($q);
		// Workaround for ! in last char of query resulting in error (XXX: possibly everything should be quoted??)
		if (strpos($q,"!") !== FALSE)
		{
			$q = '"'.$q.'"';
		}

		//if($q!='*:*')$q = escapeSolrValue($q);

		//$r = '(fulltext:('.$q.') OR key:('.$q.')^50 OR displayTitle:('.$q.')^50 OR listTitle:('.$q.')^50 OR description_value:('.$q.')^5 OR subject_value:('.$q.')^10 OR name_part:('.$q.')^30)';
		//$q .= $r . ' OR (fulltext:('.$q.') -data_source_key:("AU_RESEARCH_GRANTS"))^3000 OR (fulltext:('.$q.') -data_source_key:("nhmrc.gov.au"))^3000';
		if ($q == "*:*")
		{
			$sort = "search_base_score desc";
		}
		$q = '(fulltext:('.$q.') OR key:('.$q.')^50 OR display_title:('.$q.')^50 OR list_title:('.$q.')^50 OR description_value:('.$q.')^5 OR subject_value_resolved:('.$q.')^10 OR ((fulltext:('.$q.') -data_source_key:("AU_RESEARCH_GRANTS"))^3000 OR (fulltext:('.$q.') -data_source_key:("nhmrc.gov.au"))^3000))';


		//$q .= $r;
		//OR (fulltext:('.$q.') -data_source_key:("AU_RESEARCH_GRANTS"))^3000 OR (fulltext:('.$q.') -data_source_key:("nhmrc.gov.au"))^3000

		$q.=($extended_query);

		if($sort!='score desc') $filter_query.='&sort='.$sort;
		$q.=$filter_query;
<<<<<<< HEAD
		
		$q.=($extended_query);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		//echo $filter_query;
		//$filter_query .=$extended_query;//for spatial and temporal
		//$q .=$extended_query;//extended for spatial
		$fields = array(
			'q'=>$q,'version'=>'2.2','start'=>$start,'rows'=>$row, 'wt'=>$write_type,
			'fl'=>'*,score'
		);
		//if($filter_query!='') $fields['fq']=urlencode($filter_query);
		//print_r($fields);
<<<<<<< HEAD
<<<<<<< HEAD

		$facet = '&facet=true&facet.field=type&facet.field=class&facet.field=group&facet.field=subject_value_resolved&facet.field=licence_group&facet.field=subject_vocab_uri&f.subject_value_resolved.facet.mincount=1&facet.sort=count';

=======
		
		$facet = '&facet=true&facet.field=type&facet.field=class&facet.field=group&facet.field=subject_value&f.subject_value.facet.mincount=1&facet.sort=count';
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		$facet = '&facet=true&facet.field=type&facet.field=class&facet.field=group&facet.field=subject_value_resolved&facet.field=licence_group&facet.field=subject_vocab_uri&f.subject_value_resolved.facet.mincount=1&facet.sort=count';

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		/*prep*/
		$fields_string='';
    	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }//build the string
    	rtrim($fields_string,'&');
    	$fields_string .= $facet;//add the facet bits
<<<<<<< HEAD
<<<<<<< HEAD

    	//$fields_string = urldecode($fields_string);

    	//echo $fields_string.'<hr/>';


=======
    	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    	//$fields_string = urldecode($fields_string);

    	//echo $fields_string.'<hr/>';
<<<<<<< HEAD
		
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    	$ch = curl_init();
    	//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$solr_url.'select');//post to SOLR
		curl_setopt($ch,CURLOPT_POST,count($fields));//number of POST var
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);//post the field strings
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//return to variable
    	$content = curl_exec($ch);//execute the curl
<<<<<<< HEAD
<<<<<<< HEAD

    	//echo 'json received+<pre>'.$content.'</pre>';
		curl_close($ch);//close the curl

=======
    	
    	//echo 'json received+<pre>'.$content.'</pre>';
		curl_close($ch);//close the curl
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

    	//echo 'json received+<pre>'.$content.'</pre>';
		curl_close($ch);//close the curl

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if($write_type=='json'){
			$json = json_decode($content);
			return $json;
		}elseif($write_type=='xml'){
			return $content;
		}
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

    //WORK IN PROGRESS
    public function constructQuery($params){

    	//constructing filter query
    	$filter_query = '';

    	if($params['search_term']=='') $params['search_term']='*:*';

    	if($params['classFilter']!='All') $filter_query .= constructFilterQuery('class', rawurldecode($params['classFilter']));
    	if($params['typeFilter']!='All') $filter_query .= constructFilterQuery('type', rawurldecode($params['typeFilter']));
    	if($params['groupFilter']!='All') $filter_query .= constructFilterQuery('group', rawurldecode($params['groupFilter']));
    	if($params['subjectFilter']!='All') {
    		// treat http://-style subject searches as URI searches
    		if (substr(rawurldecode($params['subjectFilter']), 0, 7) === 'http://'){
    			$filter_query .= '(+subject_vocab_uri:("'.rawurldecode($params['subjectFilter']).'") OR +broader_subject_vocab_uri:("'.rawurldecode($params['subjectFilter']).'"))';
    		}
    		else{
    			$filter_query .= constructFilterQuery('subject_value_resolved', $params['subjectFilter']);
    		}
    	}
    	// Fix: if there is no subject to match against (i.e. blank subject) suitably random string will prevent any matches
    	if($params['subjectFilter'] == '') $filter_query .= constructFilterQuery('subject_value_resolved', "nr3kl90u3asd");
    	if($params['licenceFilter']!='All') $filter_query .= constructFilterQuery('licence_group', rawurldecode($params['licenceFilter']));

    	//constructing query
    	$rankings = array(//will be positive
    		'fulltext' => 1,
    		'key' => 50,
    		'display_title' => 50,
    		'list_title' => 50,
    		'description_value' => 5,
    		'subject_value_resolved' => 10,
    	);

    	$suppressed = array(//will be negative
			'data_source_key:("AU_RESEARCH_GRANTS")' => 3000,
			'data_source_key:("nhmrc.gov.au")' => 3000 
    	);
	
		$ranking = '(';
		foreach($rankings as $s=>$rank){
			$ranking .= $s.':('.$params['search_term'].')^'.$rank;

			if($s != 'subject_value_resolved') $ranking .=' OR ';
		}
		$ranking .=')';
		//var_dump($params);
		//echo $ranking.' '.$filter_query.' +status:PUBLISHED';
		return $ranking.' '.$filter_query.' +status:PUBLISHED';
    	
    }

    //WORK IN PROGRESS
    public function RDA($search_term, $params, $page){
    	
    	$facetFields = array('type', 'class', 'group', 'subject_value_resolved', 'licence_group', 'subject_vocab_uri');
    	$facet = '&facet=true';
    	foreach($facetFields as $f){
    		$facet .='&facet.field='.$f;
    	}

		//will be positive
    	$rankings = array(
    		'fulltext' => 1,
    		'key' => 50,
    		'display_title' => 50,
    		'list_title' => 50,
    		'description_value' => 5,
    		'subject_value_resolved' => 10,
    	);

    	//will be negative
    	$suppressed = array(
			'data_source_key:("AU_RESEARCH_GRANTS")' => 3000,
			'data_source_key:("nhmrc.gov.au")' => 3000 
    	);

    	$start = 0;$row = 10;//defaults
		if($page!=1) $start = ($page - 1) * $row;

		echo $q;
    }

    function getSubjectFacet($subject_category, $params){
    	//default categories
    	$categories = $this->config->item('subjects_categories');
    	$set = $categories[$subject_category]['list'];

    	//add the restrictions on these subjects
    	$restrictions = '';
    	foreach($set as $s){
    		$restrictions .= "type = '$s' ";
    		if($s!=end($set)) $restrictions .= ' OR ';
    	}
    	//echo $restrictions;

		$azTree = array();
		$azTree['0-9']=array('totalDB'=>0, 'subjects'=>array(), 'totalSOLR'=>0);
		foreach(range('A', 'Z') as $i){$azTree[$i]=array('totalDB'=>0, 'subjects'=>array(), 'totalSOLR'=>0);}
		

    	$this->load->database();
    	$query = 'select distinct(value), count(value) from dba.tbl_subjects where '.$restrictions.' group by value';
    	//echo $query;
		$all_subjects = $this->db->query($query);


		foreach($all_subjects->result() as $s){
			if($s->value!=""){
				if(ctype_alnum($s->value[0])){
					$first = strtoupper($s->value[0]);
					if(is_numeric($first)){$first='0-9';}
					$azTree[$first]['totalDB']++;
					array_push($azTree[$first]['subjects'], $s->value);
				}
			}
		}
		
		$hasAny = false;
		foreach($azTree as $alpha=>$array){
			$totalSOLR = $this->getSOLRCountForSubjects($params, $azTree[$alpha]['subjects']);
			$azTree[$alpha]['totalSOLR'] = $totalSOLR;
			if($totalSOLR>0) $hasAny = true;
			//echo $alpha.'>'.$azTree[$alpha]['totalDB'].'>'.$azTree[$alpha]['totalSOLR'].'<br/>';
			if(!is_numeric($azTree[$alpha]['totalSOLR'])){
				var_dump($azTree[$alpha]['totalSOLR']);
			}
		}
		//var_dump($azTree);

		//formatting the tree
		$bigTree = '';
    	$bigTree .='<div id="vocab-browser">';
			$bigTree .='<ul>';
				$bigTree .='<li id="rootNode">';
				$bigTree .='<a href="#">'.$categories[$subject_category]['display'].'</a>';
				$bigTree .='<ul>';
		    	foreach($azTree as $alpha=>$array){
		    		if($array['totalSOLR']>0){
		    			$bigTree.='<li class=""><a href="javascript:;" startsWith="'.$alpha.'">'.$alpha.' ('.$array['totalSOLR'].')</a>';
		    			$bigTree.='<ul><li><a class="jstree-loading">Loading</a><li></ul>';
		    			$bigTree.='</li>';
		    		}
		    	}
		    	if(!$hasAny) $bigTree .='<li><a class="disabled-link">No related subjects</a></li>';
		    	$bigTree.='</ul>';
		    	$bigTree.='</li>';
	    	$bigTree.='</ul>';
    	$bigTree.='</div>';
    	return $bigTree;
    }


    function getSOLRCountForSubjects($params, $subject_list){
    	if(sizeof($subject_list)>0){
    		$filter_query = ' AND (';
	    	foreach($subject_list as $s){
	    		$filter_query .= '+subject_value_resolved:("'.escapeSolrValue($s).'")';
	    		if($s!=end($subject_list)) $filter_query .= ' OR ';
	    	}
	    	$filter_query .= ')';
		}else return 0;
    	
		$q = $params.$filter_query;
		$fields = array(
			'q'=>$q,'version'=>'2.2','start'=>'0','indent'=>'on', 'wt'=>'json', 'fl'=>'key', 'rows'=>'1'
		);
		//echo $q.'<hr/>';
		$json = $this->fireSearch($fields, '');
		if($json){
			return $json->{'response'}->{'numFound'};
		}else return $json;
    }

    public function getSubjectFacetTree($params, $subject_category, $startsWith){
    	$params = $this->constructQuery($params);
    	$categories = $this->config->item('subjects_categories');
    	$set = $categories[$subject_category]['list'];

    	//add the restrictions on these subjects
    	$restrictions = '';
    	foreach($set as $s){
    		$restrictions .= "type = '$s' ";
    		if($s!=end($set)) $restrictions .= ' OR ';
    	}

    	//get all subjects in this set that starts with startswith
    	$this->load->database();
    	if($startsWith!='0-9'){
    		$query = "select distinct(value), count(value) from dba.tbl_subjects where (value LIKE '".$startsWith."%' or value LIKE '".strtolower($startsWith)."%') and (".$restrictions.") group by value";
    	}else{
    		$startsWith='';
    		foreach(range(0,9) as $i){
    			$startsWith .= "value LIKE '".$i."%' ";
    			if($i!=9) $startsWith.=" OR ";
    		}
    		$query = "select distinct(value), count(value) from dba.tbl_subjects where (".$startsWith.") and (".$restrictions.") group by value";
    	}
    	//echo $query;
		$all_subjects = $this->db->query($query);

		$subjects = array();
		foreach($all_subjects->result() as $s){
			$subjects[$s->value]=0;
		}
		
		
		foreach($subjects as $key=>$count){
			$solrCount = $this->getSOLRCountForSubjects($params, array($key));
			$subjects[$key]=$solrCount;
		}
		arsort($subjects);
		//var_dump($subjects);
		$r='';
		$limit = 15;$showMore=true;
		foreach($subjects as $key=>$count){
			if($count>0){
				if($limit<0){
					$r.='<li class="hide"><a href="javascript:;" id="'.$key.'" class="subjectFilter">'.$key.' ('.$count.')</a></li>';
				}else if($limit > 0){
					$r.='<li><a href="javascript:;" id="'.$key.'" class="subjectFilter">'.$key.' ('.$count.')</a></li>';
					$limit--;
				}else if($limit==0){
					if($showMore){
						$r.='<li><a href="javascript:;" class="show_more_list" current="15" per="15">Show More...</a></li>';
						$showMore=false;
					}
					$limit--;
				}
			}
		}
		return $r;
		

		/*$filter_query = '(';
    	foreach($subjects as $s){
    		$filter_query .= '+subject_value_resolved:("'.$s.'")';
    		if($s!=end($subjects)) $filter_query .= ' OR ';
    	}
    	$filter_query .= ')';
		$q = $filter_query;
		$fields = array(
			'q'=>$q,'version'=>'2.2','start'=>'0','indent'=>'on', 'wt'=>'json', 'fl'=>'key', 'rows'=>'1'
		);
		$facet = '&facet=true&facet.field=subject_value_resolved&facet.mincount=1';
		//echo $q.'<hr/>';
		$json = $this->fireSearch($fields, $facet);

		$facets = ($json->{'facet_counts'}->{'facet_fields'}->{'subject_value_resolved'});

		$r = '';
		for($i=0;$i<sizeof($facets);$i=$i+2){
			$r.='<li><a href="javascript:;" id="'.$facets[$i].'" class="subjectFilter">'.$facets[$i].' ('.$facets[$i+1].')</a></li>';
		}
		return $r;*/
		//var_dump($json->{'facet_counts'}->{'facet_fields'}->{'subject_value_resolved'});


    	/*$q = $params.$restrictions;
		$fields = array(
			'q'=>$q,'version'=>'2.2','start'=>'0','indent'=>'on', 'wt'=>'json', 'fl'=>'key', 'rows'=>1
		);
		//$facet = '&facet=true&facet.field=subject_value_resolved&facet.limit=-1';

		//echo $q;

		$facet = '&facet=true&facet.field=subject_value_resolved&facet.prefix='.$startsWith.'&facet.mincount=1&facet.limit=50';
		$json = $this->fireSearch($fields, $facet);
		$facets = ($json->{'facet_counts'}->{'facet_fields'}->{'subject_value_resolved'});

		$r = '';
		for($i=0;$i<sizeof($facets);$i=$i+2){
			$r.='<li><a href="javascript:;" id="'.$facets[$i].'" class="subjectFilter">'.$facets[$i].' ('.$facets[$i+1].')</a></li>';
		}
		return $r;*/
    }

    function getSubjectFacet_old($subject_category, $params){
    	//default categories
    	$categories = $this->config->item('subjects_categories');
    	$set = $categories[$subject_category];
    	//$q = $this->constructQuery($params);

    	//add the restrictions on these subjects
    	$restrictions = ' AND (';
    	foreach($set as $s){
    		$restrictions .= 'subject_type:("'.$s.'")';
    		if($s!=end($set)) $restrictions .= ' OR ';
    	}
    	$restrictions .=')';

		$q = $params.$restrictions;
		$fields = array(
			'q'=>$q,'version'=>'2.2','start'=>'0','indent'=>'on', 'wt'=>'json', 'fl'=>'key', 'rows'=>1
		);
		//$facet = '&facet=true&facet.field=subject_value_resolved&facet.limit=-1';

		//echo $q;

		$facet = '&facet=true';
		foreach (range('A', 'z') as $i){
			if(ctype_alnum($i)){
				$facet.='&facet.query=subject_value_resolved:('.$i.'*) '.$restrictions;
			}
		}
		//echo $facet;
		$json = $this->fireSearch($fields, $facet);

		$azTree = array();
		foreach(range('A', 'Z') as $i){$azTree[$i] = 0;}

		foreach($json->{'facet_counts'}->{'facet_queries'} as $key=>$num){
			$letter = $key[24];
			$letter = strtoupper($letter);
			$azTree[$letter] += $num;
		}
		//var_dump($azTree);

		//formatting the tree
		$bigTree = '';
    	$bigTree .='<div id="vocab-browser">';
			$bigTree .='<ul>';
				$bigTree .='<li id="rootNode">';
				$bigTree .='<a href="#">'.$subject_category.'</a>';
				$bigTree .='<ul>';
		    	foreach($azTree as $alpha=>$num){
		    		if($num!=0){
		    			$bigTree.='<li class=""><a href="javascript:;" startsWith="'.$alpha.'">'.$alpha.' ('.$num.')</a>';
		    			$bigTree.='<ul><li><a class="jstree-loading">Loading</a><li></ul>';
		    			$bigTree.='</li>';
		    		}
		    	}
		    	$bigTree.='</ul>';
		    	$bigTree.='</li>';
	    	$bigTree.='</ul>';
    	$bigTree.='</div>';
    	return $bigTree;
    }



    public function getSubjectFacetTree_old($params, $subject_category, $startsWith){
    	$params = $this->constructQuery($params);
    	$categories = $this->config->item('subjects_categories');
    	$set = $categories[$subject_category];

    	//add the restrictions on these subjects
    	$restrictions = ' AND (';
    	foreach($set as $s){
    		$restrictions .= 'subject_type:("'.$s.'")';
    		if($s!=end($set)) $restrictions .= ' OR ';
    	}
    	$restrictions .=')';

    	$q = $params.$restrictions;
		$fields = array(
			'q'=>$q,'version'=>'2.2','start'=>'0','indent'=>'on', 'wt'=>'json', 'fl'=>'key', 'rows'=>1
		);
		//$facet = '&facet=true&facet.field=subject_value_resolved&facet.limit=-1';

		//echo $q;

		$facet = '&facet=true&facet.field=subject_value_resolved&facet.prefix='.$startsWith.'&facet.mincount=1&facet.limit=50';
		$json = $this->fireSearch($fields, $facet);
		$facets = ($json->{'facet_counts'}->{'facet_fields'}->{'subject_value_resolved'});

		$r = '';
		for($i=0;$i<sizeof($facets);$i=$i+2){
			$r.='<li><a href="javascript:;" id="'.$facets[$i].'" class="subjectFilter">'.$facets[$i].' ('.$facets[$i+1].')</a></li>';
		}
		return $r;
    }


    public function getRelated($key, $class, $type){
<<<<<<< HEAD
    	$fields = array(
			'q'=>'key:"'.escapeSolrValue($key).'"','version'=>'2.2','start'=>'0','indent'=>'on', 'wt'=>'json'
		);
		$filter_query = '+related_object_class:("'.$class.'")';
		if($type) $filter_query = '+related_object_type:("'.$type.'")';
		$fields['fq']=$filter_query;
		$json = $this->fireSearch($fields, '');
		return $json;
    }


    public function getRelatedKeys($key, $relationType=array()){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'related_object_key'
		);
		$filter_query = '+key:("'.$key.'")+related_object_relation:(';
=======
   
 
    public function getRelated($key, $class, $type){	
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    	$fields = array(
			'q'=>'key:"'.escapeSolrValue($key).'"','version'=>'2.2','start'=>'0','indent'=>'on', 'wt'=>'json'
		);
		$filter_query = '+related_object_class:("'.$class.'")';
		if($type) $filter_query = '+related_object_type:("'.$type.'")';
		$fields['fq']=$filter_query;
		$json = $this->fireSearch($fields, '');
		return $json;
    }


    public function getRelatedKeys($key, $relationType=array()){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'related_object_key'
		);
<<<<<<< HEAD
		$filter_query = '+key:("'.$key.'")+relatedObject_relation:(';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$filter_query = '+key:("'.$key.'")+related_object_relation:(';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$first = true;
		foreach($relationType as $re){
			if($first){
				$filter_query .= $re;
				$first = false;
			}else $filter_query .= ' OR '.$re;
		}
		$filter_query .=')';
		$fields['fq']=$filter_query;
		//echo $filter_query;
		$json = $this->fireSearch($fields, '');
		return $json;
    }
<<<<<<< HEAD
<<<<<<< HEAD

	public function getConnections($key, $class, $type, $exclude,$reverseLinks,$dataSourceKey){

		$excludeKeys = '';

		if(count($exclude)>0)
		{

			$excludes = array_keys($exclude);
			//return $exclude;
=======
    
	public function getConnections($key, $class, $type, $exclude,$reverseLinks,$dataSourceKey){	
		//echo $key."<br />";
=======

	public function getConnections($key, $class, $type, $exclude,$reverseLinks,$dataSourceKey){

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$excludeKeys = '';

		if(count($exclude)>0)
		{

			$excludes = array_keys($exclude);
<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			//return $exclude;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$excludeKeys = '(';

			for($i=0;$i<count($exclude);$i++)
			{
				$excludeKeys .= '"'.$exclude[$i].'" OR ';
			}
			$excludeKeys = trim($excludeKeys,'OR ');
			$excludeKeys .= ")";
<<<<<<< HEAD
<<<<<<< HEAD
		}elseif(implode($exclude)!=''){
			$excludeKeys = '(';
			$excludeKeys .= '"'.implode($exclude).'"';
			$excludeKeys .= ")";

		}
    	$fields = array(
			'q'=>'related_object_key:"'.$key.'"','version'=>'2.2','rows'=>'200000','start'=>'0','indent'=>'on', 'wt'=>'json','fl'=>'key,class,type,data_source_key'
		);
		$filter_query = '+class:("'.$class.'") +status:(PUBLISHED)';
		if($type) $filter_query = '+type:("'.$type.'")';
		if($reverseLinks=="INT")$filter_query .= '+data_source_key:("'.$dataSourceKey.'")';
		if($reverseLinks=="EXT")$filter_query .= '-data_source_key:("'.$dataSourceKey.'")';

		if($excludeKeys!='')$filter_query .= '-key: '.escapeSolrValue($excludeKeys).' -key: '.escapeSolrValue($key);
=======
		}else{
=======
		}elseif(implode($exclude)!=''){
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$excludeKeys = '(';
			$excludeKeys .= '"'.implode($exclude).'"';
			$excludeKeys .= ")";

		}
    	$fields = array(
			'q'=>'related_object_key:"'.$key.'"','version'=>'2.2','rows'=>'200000','start'=>'0','indent'=>'on', 'wt'=>'json','fl'=>'key,class,type,data_source_key'
		);
		$filter_query = '+class:("'.$class.'") +status:(PUBLISHED)';
		if($type) $filter_query = '+type:("'.$type.'")';
		if($reverseLinks=="INT")$filter_query .= '+data_source_key:("'.$dataSourceKey.'")';
<<<<<<< HEAD
		if($reverseLinks=="EXT")$filter_query .= '-data_source_key:("'.$dataSourceKey.'")';		
		if($excludeKeys)$filter_query .= '-key: '.escapeSolrValue($excludeKeys);  
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		if($reverseLinks=="EXT")$filter_query .= '-data_source_key:("'.$dataSourceKey.'")';

		if($excludeKeys!='')$filter_query .= '-key: '.escapeSolrValue($excludeKeys).' -key: '.escapeSolrValue($key);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

		$fields['fq']=$filter_query;
		$json = $this->fireSearch($fields, '');

		return $json;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    }

	public function getObjects($keys, $class, $type, $page){
	//	if (count($keys)>1){	echo count($keys)," is the count of the getObjects keys<br />";		}
		//print_r($keys);
		//echo "<br />++++++++++++++++++++++++++<br/>";
		//}
<<<<<<< HEAD
		if($page!=null){
			$start = 0;
			$rows = 10;
			if($page!=1) $start = (($page - 1) * $rows) + 0;
		}else{
			$start = 0;
			$rows = 2000;
		}

		$getkeys = '(';
		if(count($keys)>0)
 		{
 		for($i=0;$i<count($keys);$i++)
=======
    } 
    
	public function getObjects($keys, $class, $type, $page){	
		//echo $keys[0];
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if($page!=null){
			$start = 0;
			$rows = 10;
			if($page!=1) $start = (($page - 1) * $rows) + 0;
		}else{
			$start = 0;
			$rows = 2000;
		}

		$getkeys = '(';
		if(count($keys)>0)
 		{
<<<<<<< HEAD
			for($i=0;$i<count($keys);$i++)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
 		for($i=0;$i<count($keys);$i++)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			{
				$getkeys .= '"'.escapeSolrValue($keys[$i]).'" OR ';
			}
		}else{
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$getkeys .= '"'.$keys.'"';
		}
		$getkeys = trim($getkeys,'OR ');
		$getkeys .= ")";
<<<<<<< HEAD
<<<<<<< HEAD
//if(count($keys)>2 ){echo $getkeys;}
=======

>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
//if(count($keys)>2 ){echo $getkeys;}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    	$fields = array(
			'q'=>'key:'.$getkeys.' +status:(PUBLISHED)','version'=>'2.2','rows'=>$rows,'start'=>$start,'indent'=>'on', 'wt'=>'json'
		);

		$json = $this->fireSearch($fields, '');
<<<<<<< HEAD
<<<<<<< HEAD
	//	if(count($keys)>3){print_r($json);}
		return $json;
    }

	public function getByKey($key){
		return $this->getRegistryObjectSOLR($key, '*', 'json');
	}

	public function getByHash($hash){
		return $this->getRegistryObjectSOLRByHash($hash, '*', 'json');
	}



    public function getNCRISPartners(){
    	$fields = array(
			'q'=>'group:NCRIS','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'description_value, description_type, key, display_title, location'
=======
=======
	//	if(count($keys)>3){print_r($json);}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		return $json;
    }

	public function getByKey($key){
		return $this->getRegistryObjectSOLR($key, '*', 'json');
	}

	public function getByHash($hash){
		return $this->getRegistryObjectSOLRByHash($hash, '*', 'json');
	}



    public function getNCRISPartners(){
    	$fields = array(
			'q'=>'group:NCRIS','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
<<<<<<< HEAD
			'fl'=>'description_value, description_type, key, displayTitle, location'
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			'fl'=>'description_value, description_type, key, display_title, location'
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		);
		$json = $this->fireSearch($fields, '');
		return $json;
    }
<<<<<<< HEAD
<<<<<<< HEAD


=======
    
       
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    function seeAlso($key, $type){
    	$result = null;
    	switch($type){
    		case "subject":$result = $this->seeAlsoSubject($key);break;
    	}
    	return $result;
    }
<<<<<<< HEAD
<<<<<<< HEAD

=======
    
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    private function seeAlsoSubject($key){
    	//get only the subjects of the registry object
    	$ro = $this->getRegistryObjectSOLR($key, 'subject_value subject_type', 'json');
    	//loop through the subjects and construct the filter query
    	return $ro;
    }
<<<<<<< HEAD
<<<<<<< HEAD


=======
    
    
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    /*
     * Takes a key and returns the registry Object searched through SOLR
     * key is the registryObject key
     * flag is what to be returned, * for all fields
     * wt is the write type, accepted xml and json
     */
    private function getRegistryObjectSOLR($key, $flag, $wt){
    	$fields = array(
			'q'=>'key:"'.urlencode($key).'"','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>$wt,
			'fl'=>$flag, 'q.alt'=>'*:*'
		);
		$result = $this->fireSearch($fields, '');//no facet
		return $result;
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    /*
     * Takes a hash and returns the registry Object searched through SOLR
     * hash is the registryObject hash
     * flag is what to be returned, * for all fields
     * wt is the write type, accepted xml and json
     */
    private function getRegistryObjectSOLRByHash($hash, $flag, $wt){
    	$fields = array(
			'q'=>'key_hash:"'.urlencode($hash).'"','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>$wt,
			'fl'=>$flag, 'q.alt'=>'*:*'
		);
		$result = $this->fireSearch($fields, '');//no facet
		return $result;
    }


<<<<<<< HEAD
=======
    
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    /*
     * Returns the statistics with all facets
     */
    function getStat($sort, $type=''){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'key', 'q.alt'=>'*:*','fq'=>'status:PUBLISHED'
		);
		if($type=='collection') $fields['fq'].='+class:collection';
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$facet = 'facet=true&facet.field=type&facet.field=class&facet.field=group&facet.field=subject_value_resolved&facet.sort=index&facet.mincount=0&facet.limit=-1';
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
	 function getContent($sort,$group,$key){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'key', 'q.alt'=>'*:*','fq'=>'status:PUBLISHED'
		);
		$fields['fq'].='+group:("'.$group.'") -key:("'.$key.'")';
		$facet = 'facet=true&facet.field=class&facet.field=subject_value_resolved';
		$json = $this->fireSearch($fields, $facet);
		//echo $json;
		return $json;
    }
	function getSubjects($sort,$group){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'key', 'q.alt'=>'*:*','fq'=>'status:PUBLISHED'
		);
		$fields['fq'].='+group:("'.$group.'")';
		$facet = 'facet=true&facet.field=class&facet.field=subject_value_resolved&facet.mincount=1';
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
		function getCannedContent($sort,$group,$key){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'1','indent'=>'on', 'wt'=>'json',
			'fl'=>'key', 'q.alt'=>'*:*','fq'=>'status:PUBLISHED'
		);
		$fields['fq'].='+group:("'.$group.'") -key:("'.$key.'")';
		$facet = 'facet=true&facet.field=class&facet.field=type&facet.field=subject_value_resolved&facet.mincount=1&facet.limit=-1&facet.sort=count';
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
	 function getCollection($sort, $type='',$group){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'5','indent'=>'on', 'wt'=>'json',
			'fl'=>'key,display_title', 'q.alt'=>'*:*','fq'=>'status:PUBLISHED', 'sort'=>'date_modified desc'
		);
		$fields['fq'].='+class:'.$type.'+group:("'.$group.'")';
		$facet = 'facet=false';
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
	function getGroups($sort, $group, $key){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'key,display_title', 'q.alt'=>'*:*','fq'=>'status:PUBLISHED', 'sort'=>'date_modified desc'
		);
		$fields['fq'].='+class:party+group:("'.$group.'")+type:group -key:("'.$key.'")';
		$facet = 'facet=false';
<<<<<<< HEAD
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
=======
		$facet = 'facet=true&facet.field=type&facet.field=class&facet.field=group&facet.field=subject_value&facet.sort=index&facet.mincount=1';
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
    
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	function getDictionary($sort){
    	$fields = array(
			'q'=>'*:*','version'=>'2.2','start'=>'0','rows'=>'100','indent'=>'on', 'wt'=>'json',
			'fl'=>'key', 'q.alt'=>'*:*'
		);
		$facet = '&facet=true&facet.field=description_value&facet.limit=10000';
		$json = $this->fireSearch($fields, $facet);
		return $json;
    }
    /*
     * Fire a search, given an array of fields and a string of facets
     */
<<<<<<< HEAD
<<<<<<< HEAD
	function fireSearch($fields, $facet){
		/*prep*/
		$fields_string='';
		//foreach($fields as $key=>$value) { $fields_string .= $key.'='.str_replace("+","%2B",$value).'&'; }//build the string
		foreach($fields as $key=>$value) {
			$fields_string .= $key.'='.$value.'&';
		}//build the string
    	$fields_string .= $facet;//add the facet bits
    	$fields_string = rtrim($fields_string,'&');

	//echo $fields_string."....<br />";

=======
	private function fireSearch($fields, $facet){
=======
	function fireSearch($fields, $facet){
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		/*prep*/
		$fields_string='';
		//foreach($fields as $key=>$value) { $fields_string .= $key.'='.str_replace("+","%2B",$value).'&'; }//build the string
		foreach($fields as $key=>$value) {
			$fields_string .= $key.'='.$value.'&';
		}//build the string
    	$fields_string .= $facet;//add the facet bits
    	$fields_string = rtrim($fields_string,'&');

	//echo $fields_string."....<br />";
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    	$ch = curl_init();
    	$solr_url = $this->config->item('solr_url');
    	//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$solr_url.'select');//post to SOLR
		curl_setopt($ch,CURLOPT_POST,count($fields));//number of POST var
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);//post the field strings
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//return to variable
    	$content = curl_exec($ch);//execute the curl
<<<<<<< HEAD
<<<<<<< HEAD

    	//echo 'json received+<pre>'.$content.'</pre>';
		curl_close($ch);//close the curl



		$json = json_decode($content);
		if($json){
			return $json;
		}else{
			echo 'ERROR:'.$content.'<br/> QUERY: '.$fields_string;
		}
		//echo  "*********".$content;
=======
    	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
    	//echo 'json received+<pre>'.$content.'</pre>';
		curl_close($ch);//close the curl



		$json = json_decode($content);
<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		if($json){
			return $json;
		}else{
			echo 'ERROR:'.$content.'<br/> QUERY: '.$fields_string;
		}
		//echo  "*********".$content;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		return $json;
    }
}
?>
