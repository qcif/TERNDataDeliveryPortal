<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$count = count($recordsArr);
$half = round($count / 2);

function printRecord($r){
     $ro_key = $r->{'key'};
            $name =  $r->{'displayTitle'};

            echo '<li>'; 
            echo '<a href="view/dataview?key='.$ro_key.'" class="record-list">'.$name.'</a>';
            
            echo '</li>';
}

?>

    
    
    
<?php if($header_footer) $this->load->view('tpl/header');?>
<div id="fac-random-rec" class="shadow-and-corner">

    <ul>
    <?php 
        for($i=0;$i<$half; $i++){
           printRecord($recordsArr[$i]);
        }
    ?>
     <?php 
        for($i=$half;$i<$count; $i++){
           printRecord($recordsArr[$i]);
        }
    ?>
    </ul>

	
</div>

<?php  if($header_footer)  $this->load->view('tpl/footer');?>