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

$realNumFound = $json->{'response'}->{'numFound'};
$numFound = $json_tab->{'response'}->{'numFound'};
$timeTaken = $json->{'responseHeader'}->{'QTime'};
$timeTaken = $timeTaken / 1000;

//print_r($json->{'responseHeader'}->{'params'});

$row = $json->{'responseHeader'}->{'params'}->{'rows'};
$start = $json->{'responseHeader'}->{'params'}->{'start'};
$end = $start + $row;

$h_start = $start + 1; //human start
$h_end = $end + 1; //human end

if ($h_end > $numFound)
    $h_end = $numFound;

$totalPage = ceil($numFound / $row);
$currentPage = ceil($start / $row) + 1;
?>
<?php

if ($realNumFound == 0)
{
    $this->load->view('search/no_result');
}

$c = 1; //record counter 1- 10
echo '<table style="border:1px solid black;">';
echo '<thead>';
echo '<tr><th>Map ref</th><th>Title</th><th>Date published</th></tr>';
echo '</thead>';
foreach ($json->{'response'}->{'docs'} as $r)
{
    //var_dump($r->{'description_value'});
    $type = $r->{'type'};
    $ro_key = $r->{'key'};

    //$name = $r->{'listTitle'};
    $name = $r->{'list_title'};

    $descriptions = array();
    if (isset($r->{'description_value'}))
        $descriptions = $r->{'description_value'};
    $date_pub = array();
    if (isset($r->{'timestamp'})){
        $date_pub = $r->{'timestamp'};
        $date_pubf = new DateTime($date_pub);
        $date_pubf->setTimeZone(new DateTimeZone("Australia/Brisbane"));
        $date_pub = $date_pubf->format('d-m-Y');
    }
    $description_type = array();
    if (isset($r->{'description_type'}))
        $description_type = $r->{'description_type'};
    $class = '';
    if (isset($r->{'class'}))
        $class = $r->{'class'};
    $type = '';
    if (isset($r->{'type'}))
        $type = strtolower($r->{'type'});

    $brief = '';
    $found_brief = false;
    $full = '';
    $found_full = false;
    foreach ($description_type as $key => $t)
    {
        if ($t == 'brief' && !$found_brief)
        {
            $brief = $descriptions[$key];
            $found_brief = true;
        }
        elseif ($t == 'full' && !$found_full)
        {
            $full = $descriptions[$key];
            $found_full = true;
        }
    }

    $spatial = '';
    $center = '';
    if (isset($r->{'spatial_coverage'}))
    {
        $spatial = $r->{'spatial_coverage'};
        $center = $r->{'spatial_coverage_center'}[0];
    }

    $subjects = '';

    //		if(isset($r->{'subject_value'})){
    //			$subjects = $r->{'subject_value'};
    //		}
    if (isset($r->{'subject_value_resolved'}))
    {
        $subjects = $r->{'subject_value_resolved'};
    }

    $key_url = base_url() . 'view/dataview?key=' . urlencode($ro_key);
    echo '<tbody>';
    echo '<tr><td><h2 class="h2color mapMarker">' . $c . '</h2></td><td><p><h2 class="h2color">' . $name . '</h></p></td><td><p>' . $date_pub . '</p></td>';
    echo '<tr id="re-hide" style="border:0"><td id="emptycell"><p></p></td>
            <td id="desc">
                <p>';
    if (isset($r->{'alt_list_title'}))
    {
        echo '<div class="alternatives">';
        //foreach($r->{'alt_listTitle'} as $listTitle){
        foreach ($r->{'alt_list_title'} as $listTitle)
        {

            echo '<p class="alt_listTitle">' . $listTitle . '</p>';
        }
        echo '</div>';
    }
    //DESCRIPTIONS';
    if ($found_brief || $found_full)
    {
        echo '<p>';
        if ($found_brief)
        {
            echo ($brief);
        }
        elseif ($found_full)
        {
            echo ($full);
        }
        echo '</p> ';
    }

    if ($spatial)
    {

        echo '<ul class="spatial">';
        foreach ($spatial as $s)
        {
            echo '<li>' . $s . '</li>';
        }
        echo '</ul>';
        echo '<a class="spatial_center">' . $center . '</a>';
        echo '<a class="key hide">' . $ro_key . '</a>';
    }

    if (get_cookie('show_subjects') == 'yes')
    {
        if ($subjects)
        {
            echo '<div class="subject-container">';
            echo '<ul class="subjects">';
            foreach ($subjects as $s)
            {
                echo '<li><a href="javascript:void(0);" class="contentSubject" id="' . $s . '">' . $s . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
    echo '</p>
            </td>
            <td id="metabutton"><button type="button" class="viewmeta" id="' . $key_url . '">View Metadata</button></td>
         </tr>';

    echo '</tbody>';



    /*
      echo '<div class="search_item">';

      $key_url =  base_url().'view/?key='.urlencode($ro_key);

      echo '<h2 class="h2color"><span class="count">'. $c . '. </span><a  id="'.$ro_key.'" class="record-list">'.$name.'</a></h2>';

      //if(isset($r->{'alt_listTitle'})){
      if(isset($r->{'alt_list_title'})){
      echo '<div class="alternatives">';
      //foreach($r->{'alt_listTitle'} as $listTitle){
      foreach($r->{'alt_list_title'} as $listTitle){

      echo '<p class="alt_listTitle">'.$listTitle.'</p>';
      }
      echo '</div>';
      }

      //DESCRIPTIONS';
      if($found_brief || $found_full){
      echo '<p>';
      if($found_brief){
      echo ($brief);
      }elseif($found_full){
      echo ($full);

      }
      echo '</p> ';
      }

      if($spatial){

      echo '<ul class="spatial">';
      foreach($spatial as $s){
      echo '<li>'.$s.'</li>';
      }
      echo '</ul>';
      echo '<a class="spatial_center">'.$center.'</a>';
      echo '<a class="key hide">'.$ro_key.'</a>';
      }

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
     */
    $c++;
}
echo '</table>';

echo '<div class="toolbar clearfix bottom-corner">';
$this->load->view('search/pagination');

echo '</div>';
echo '<div id="infoBox"></div>';
?>