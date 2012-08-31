<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
	$realNumFound = $json->{'response'}->{'numFound'};
	$timeTaken = $json->{'responseHeader'}->{'QTime'};
	$timeTaken = $timeTaken / 1000;

	//print_r($json->{'responseHeader'}->{'params'});

	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	$end = $start + $row;

	$h_start = $start + 1;//human start
	$h_end = $end + 1;//human end

	//if ($h_end > $numFound) $h_end = $numFound;
        if ($row == 0 ) $row=1;
	$totalPage = ceil($realNumFound / $row);
	$currentPage = ceil($start / $row)+1;
?>
<?php $this->load->view('mobile/tpl/header');?>
<div data-role="content">

        <div >
   <?php
        if($realNumFound==0){
		echo "0 result found. Please try another search term";
	}else{
          $c=1;//record counter 1- 10
			foreach($json->{'response'}->{'docs'} as $r)
			{
				//var_dump($r->{'description_value'});
				$type = $r->{'type'};
				$ro_key = $r->{'key'};
<<<<<<< HEAD
				//$name = $r->{'listTitle'};
                                $name = $r->{'list_title'};
=======
				$name = $r->{'listTitle'};
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
				$descriptions = array();if(isset($r->{'description_value'})) $descriptions = $r->{'description_value'};
				$description_type=array();if(isset($r->{'description_type'})) $description_type = $r->{'description_type'};
				$class = '';if(isset($r->{'class'})) $class = $r->{'class'};
				$type = '';if(isset($r->{'type'})) $type = strtolower($r->{'type'});

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
/*
				$spatial ='';$center = '';
				if(isset($r->{'spatial_coverage'})){
					$spatial = $r->{'spatial_coverage'};
					$center = $r->{'spatial_coverage_center'}[0];
				}
*/
				$subjects='';
<<<<<<< HEAD
				//if(isset($r->{'subject_value'})){
			//		$subjects = $r->{'subject_value'};
		//		}
                                  if(isset($r->{'subject_value_resolved'})){
					$subjects = $r->{'subject_value_resolved'};
				}
=======
				if(isset($r->{'subject_value'})){
					$subjects = $r->{'subject_value'};
				}

>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
				echo '<div class="search_item">';

				$key_url =  base_url().'m/view/?key='.urlencode($ro_key);
				echo '<h4><span class="count">'. $c . '. </span><a href="'.$key_url.'" data-ajax="false">'.$name.'</a></h4>';

				//echo '<pre>';

<<<<<<< HEAD
//				if(isset($r->{'alt_listTitle'})){
                                if(isset($r->{'alt_list_title'})){
					echo '<div class="alternatives">';
					//foreach($r->{'alt_listTitle'} as $listTitle){
                                        foreach($r->{'alt_list_title'} as $listTitle){                                            
=======
				if(isset($r->{'alt_listTitle'})){
					echo '<div class="alternatives">';
					foreach($r->{'alt_listTitle'} as $listTitle){
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
						echo '<p class="alt_listTitle">'.$listTitle.'</p>';
					}
					echo '</div>';
				}
				//echo '</pre>';
				//echo '<h2><a href="#!/view/'.$ro_key.'">'.$name.'</a></h2>';

				//DESCRIPTIONS';
                                if($found_brief || $found_full){
                                    echo '<p>';
                                    if($found_brief){
                                            echo showBrief($brief, $this->config->item('desc_words')) . "...";
                                    }elseif($found_full){
                                            echo showBrief($full,  $this->config->item('desc_words')) . "...";
                                              
                                    }
                                	echo '</p> ';
                                }
                              /*
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
                              */
                              
				echo '</div>';
                                $c++;
			}
        }

   ?>
        </div>


        <div>
          <?php  $this->load->view('mobile/facet'); ?>


        </div>
   
</div>

<?php $this->load->view('mobile/tpl/footer');?>