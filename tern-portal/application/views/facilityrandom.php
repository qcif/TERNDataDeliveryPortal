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
                $keys[] = $key;

                
                if($d->{'description_value'}!=null && $d->{'description_type'}!=null)
                {
                    foreach($d->{'description_type'} as $index=>$type)
                    {

                       $partners[$key]['description_value']=$d->{'description_value'}[1];
                                    
                       $partners[$key]['url']=$d->{'location'}[0];
                       $partners[$key]['displayTitle']=$d->{'displayTitle'};                         
                    }

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

<div id="fac-title"><h2><?php  echo  $partners[$fackey]['displayTitle'];?></h2>
</div>

<div id="fac-content">
        <div id="fac-random-rec" class="shadow-and-corner">

        <?php
                if ($fackey!==tddp)
                {
                    echo '<ul>';
                    for($i=0;$i<$half; $i++)
                    {
                        printRecord($recordsArr[$i]);
                    }

                    for($i=$half;$i<$count; $i++)
                    {
                        printRecord($recordsArr[$i]);
                    }

                    echo '</ul>';
                }else
                {
                    echo '<div id="carousel">';
                    echo    '<div class="clearfix">';
                    echo '<div class="prev browse left"></div>';
                    echo    '<div id="scrollable">   ';
                    echo      ' <div class="items" id="items" style="left: 0px; ">';
                    echo            '<img src="../img/auscover.png" height="102" width="194"/></a>';
                    echo            '<img src="../img/ozflux.png" height="102" width="194" /></a>';
                    echo            '<img src="../img/mspn.png" height="102" width="194"/></a>';
                    echo            '<img src="../img/ausplot.png" height="102" width="194"" /></a>';
                    echo            '<img src="../img/ltern.png" height="102" width="194"  /></a>';
                    echo            '<img src="../img/supersite.png" height="102" width="194" /></a>';
                    echo            '<img src="../img/soil.png" height="102" width="194"  /></a>';
                    echo            '<img src="../img/acef.png" height="102" width="194"  /></a>';
                    echo            '<img src="../img/aekos.png" height="102" width="194"  /></a>';
                    echo            '<img src="../img/emast.png" height="102" width="194"  /></a>';
                    echo            '<img src="../img/aceas.png" height="102" width="194"  /></a>';
                    echo      '</div>';
                    echo      '</div>';
                    echo      '<div class="next browse right"></div>';
                    echo  '</div>';
                    echo  '</div>';


                }
        ?>



        </div>

        <div class="facility-desc">
                  <?php displayDesc($fackey,$partners);?>
        </div>

</div>
<?php  if($header_footer)  $this->load->view('tpl/footer');?>