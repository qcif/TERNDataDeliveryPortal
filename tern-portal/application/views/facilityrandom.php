<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$count = count($recordsArr);
$half = round($count / 2);

        $partners = array();
        $keys = array();
        
        foreach($json->{'response'}->{'docs'} as $d)
        {
                $key = $d->{'key'};
                   //print_r($d->{'key'});
                $keys[] = $key;
                foreach($d->{'description_type'} as $index=>$type){

                       $partners[$key]['description_value']=$d->{'description_value'}[1];
                        
                    
                        $partners[$key]['url']=$d->{'location'}[0];
                        $partners[$key]['displayTitle']=$d->{'displayTitle'};
                         
                }

        }


        
function printRecord($r){
     $ro_key = $r->{'key'};
            $name =  $r->{'displayTitle'};

            echo '<li>'; 
            echo '<a href="view/dataview?key='.$ro_key.'" class="record-list">'.$name.'</a>';
            
            echo '</li>';
            
            
}

function displayDesc($facid,$partners)
{

    echo '<p>'.$partners[$facid]['description_value'].'</p>';
}


?> 
    
    
<?php if($header_footer) $this->load->view('tpl/header');?>
<div id="fac-random-rec" class="shadow-and-corner" style="float:right" >

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

        <div>
                <h2><?php   $partners[$fackey]['displayTitle']          ?></h2>
                             <div id="desc">
                                 <?php
                                 displayDesc($fackey,$partners);
                                     
                                 ?>
                             </div>

        </div>


<?php  if($header_footer)  $this->load->view('tpl/footer');?>