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
?>
<?php
=======
**/ 
?>
<?php
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
**/
?>
<?php
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	//$numFound = $json->{'response'}->{'numFound'};
	$realNumFound = $json->{'response'}->{'numFound'};
	$numFound = $json_tab->{'response'}->{'numFound'};
	$timeTaken = $json->{'responseHeader'}->{'QTime'};
	$timeTaken = $timeTaken / 1000;
<<<<<<< HEAD
<<<<<<< HEAD

	//print_r($json->{'responseHeader'}->{'params'});

	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	$end = $start + $row;

	$h_start = $start + 1;//human start
	$h_end = $end + 1;//human end

	if ($h_end > $numFound) $h_end = $numFound;

=======
	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	//print_r($json->{'responseHeader'}->{'params'});

	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	$end = $start + $row;

	$h_start = $start + 1;//human start
	$h_end = $end + 1;//human end

	if ($h_end > $numFound) $h_end = $numFound;
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$totalPage = ceil($numFound / $row);
	$currentPage = ceil($start / $row)+1;
?>
		<?php
			echo '<div class="toolbar clearfix">';
<<<<<<< HEAD
<<<<<<< HEAD

			echo '<div id="realNumFound" class="hide">'.($realNumFound).'</div>';



			//echo $this->input->cookie('facets');

=======
			
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			echo '<div id="realNumFound" class="hide">'.($realNumFound).'</div>';



			//echo $this->input->cookie('facets');
<<<<<<< HEAD
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$class='';
			if($this->input->cookie('facets')!=''){
				if($this->input->cookie('facets')=='yes'){
					$class='ui-icon-arrowthickstop-1-w';
				}else{
					$class='ui-icon-arrowthickstop-1-e';
				}
			}else{
				$class='ui-icon-arrowthickstop-1-w';
			}
<<<<<<< HEAD
<<<<<<< HEAD

			echo '<div class="ui-state-default ui-corner-all show-hide-facet"><span class="ui-icon '.$class.'" id="toggle-facets" title="Show/Hide Facet"></span></div>';
			//echo '<a href="JavaScript:void(0);" id="hide-facets">Expand</a><a href="JavaScript:void(0);" id="show-facets">Collapse (Show Filters)</a>';

			echo '<div class="result">';
			echo ''.number_format($realNumFound).' results ('.$timeTaken.' seconds)';
			echo '</div>';

			$this->load->view('search/pagination');

			echo '</div>';

			if($realNumFound==0){
				$this->load->view('search/no_result');
			}

			foreach($json->{'response'}->{'docs'} as $r)
			{
				$type = $r->{'type'};
				$ro_key = $r->{'key'};
				$name = $r->{'list_title'};
=======
			
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			echo '<div class="ui-state-default ui-corner-all show-hide-facet"><span class="ui-icon '.$class.'" id="toggle-facets" title="Show/Hide Facet"></span></div>';
			//echo '<a href="JavaScript:void(0);" id="hide-facets">Expand</a><a href="JavaScript:void(0);" id="show-facets">Collapse (Show Filters)</a>';

			echo '<div class="result">';
			echo ''.number_format($realNumFound).' results ('.$timeTaken.' seconds)';
			echo '</div>';

			$this->load->view('search/pagination');

			echo '</div>';

			if($realNumFound==0){
				$this->load->view('search/no_result');
			}

			foreach($json->{'response'}->{'docs'} as $r)
			{
				$type = $r->{'type'};
				$ro_key = $r->{'key'};
<<<<<<< HEAD
				$name = $r->{'listTitle'};
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$name = $r->{'list_title'};
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($name=='')$name='(no name/title)';
				$descriptions = array();if(isset($r->{'description_value'})) $descriptions = $r->{'description_value'};
				$description_type=array();if(isset($r->{'description_type'})) $description_type = $r->{'description_type'};
				$class = '';if(isset($r->{'class'})) $class = $r->{'class'};
				$type = '';if(isset($r->{'type'})) $type = strtolower($r->{'type'});
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$brief = '';$found_brief = false;
				$full = '';$found_full = false;
				foreach($description_type as $key=>$t){
					if($t=='brief' && !$found_brief) {
						$brief = $descriptions[$key];
						$found_brief = true;
					}elseif($t=='full' && !$found_full){
						$full = $descriptions[$key];
						$found_full = true;
					}
				}
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$spatial ='';$center = '';
				if(isset($r->{'spatial_coverage'})){
					$spatial = $r->{'spatial_coverage'};
					$center = $r->{'spatial_coverage_center'}[0];
				}
<<<<<<< HEAD
<<<<<<< HEAD

				$subjects='';
				if(isset($r->{'subject_value_resolved'})){
					$subjects = $r->{'subject_value_resolved'};
				}

				echo '<div class="search_item" itemscope itemType="http://schema.org/Thing">';

=======
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$subjects='';
				if(isset($r->{'subject_value_resolved'})){
					$subjects = $r->{'subject_value_resolved'};
				}

				echo '<div class="search_item" itemscope itemType="http://schema.org/Thing">';
<<<<<<< HEAD
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				//echo get_cookie('show_icons');
				echo '<p class="hide key">'.$ro_key.'</p>';
				if(get_cookie('show_icons')=='yes'){
					switch($class){
						case "collection":echo '<img itemprop="image" class="ro-icon" src="'.base_url().'img/icon/collections_32.png" title="Collection" alt="Collection"/>';break;
						case "activity":echo '<img itemprop="image" class="ro-icon" src="'.base_url().'img/icon/activities_32.png" title="Activity" alt="Activity"/>';break;
						case "service":echo '<img itemprop="image" class="ro-icon" src="'.base_url().'img/icon/services_32.png" title="Service" alt="Service"/>';break;
<<<<<<< HEAD
<<<<<<< HEAD
						case "party":
=======
						case "party": 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						case "party":
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									if($type=='person'){
										echo '<img itemprop="image" class="ro-icon" src="'.base_url().'img/icon/party_one_32.png" title="Person" alt="Person"/>';
									}elseif($type=='group'){
										echo '<img itemprop="image" class="ro-icon" src="'.base_url().'img/icon/party_multi_32.png" title="Group" alt="Group"/>';
									}
							break;
					}
				}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$theGroup = getInstitutionPage($r->{'group'});
				
				if($theGroup==$ro_key){
					$key_url = base_url().'view/group/?group='.rawurlencode($theGroup). '&groupName='.urlencode($r->{'group'});
				}			
				else if ($r->url_slug)
				{
					$key_url = base_url().$r->{'url_slug'};
				}
				else{
					$key_url =  base_url().'view/?key='.urlencode($ro_key);
				}
<<<<<<< HEAD
				//echo $key_url;
				echo '<h2 itemprop="name"><a itemprop="url" href="'.$key_url.'">'.$name.'</a></h2>';

				//echo '<pre>';

=======
				$key_url =  base_url().'view/?key='.urlencode($ro_key);
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				//echo $key_url;
				echo '<h2 itemprop="name"><a itemprop="url" href="'.$key_url.'">'.$name.'</a></h2>';

				//echo '<pre>';
<<<<<<< HEAD
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if(isset($r->{'alt_listTitle'})){
					echo '<div class="alternatives">';
					foreach($r->{'alt_listTitle'} as $listTitle){
						echo '<p class="alt_listTitle">'.$listTitle.'</p>';
					}
					echo '</div>';
				}
				//echo '</pre>';
				//echo '<h2><a href="#!/view/'.$ro_key.'">'.$name.'</a></h2>';
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				//DESCRIPTIONS';
				echo '<p itemprop="description">';
				if($found_brief){
					echo strip_tags(htmlspecialchars_decode($brief));
				}elseif($found_full){
					echo strip_tags(htmlspecialchars_decode($full));
				}
				echo '</p>';
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($spatial){
					echo '<ul class="spatial">';
						foreach($spatial as $s){
							echo '<li>'.$s.'</li>';
						}
					echo '</ul>';
					echo '<a class="spatial_center">'.$center.'</a>';
				}
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if(get_cookie('show_subjects')=='yes'){
					if($subjects){
						echo '<div class="subject-container">';
						echo '<ul class="subjects">';
						foreach($subjects as $s){
							echo '<li><a href="javascript:void(0);" class="contentSubject" id="'.$s.'">'.$s.'</a></li>';
						}
						echo '</ul>';
						echo '</div>';
					}
				}
				echo '</div>';
			}
<<<<<<< HEAD
<<<<<<< HEAD
			echo '<div class="toolbar clearfix bottom-corner">';
			if(displaySubscriptions() )
			{
				echo "<div id='subscriptions'><div class='rss_icon'></div>Subscribe to this web feed. <a href='".base_url()."search/rss/".$queryStr."&subscriptionType=rss' title='Stay informed with RSS when any updates are made to this search query.' class='tiprss'>RSS</a>/<a href='".base_url()."search/atom/".$queryStr."&subscriptionType=atom' title='Stay informed with ATOM when any updates are made to this search query.' class='tiprss'>ATOM</a></div>";
			}
=======
			
			echo '<div class="toolbar clearfix bottom-corner">';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			echo '<div class="toolbar clearfix bottom-corner">';
			if(displaySubscriptions() )
			{
				echo "<div id='subscriptions'><div class='rss_icon'></div>Subscribe to this web feed. <a href='".base_url()."search/rss/".$queryStr."&subscriptionType=rss' title='Stay informed with RSS when any updates are made to this search query.' class='tiprss'>RSS</a>/<a href='".base_url()."search/atom/".$queryStr."&subscriptionType=atom' title='Stay informed with ATOM when any updates are made to this search query.' class='tiprss'>ATOM</a></div>";
			}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$this->load->view('search/pagination');
			echo '</div>';
		?>