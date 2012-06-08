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
                       $partners[$key]['alt_name']=$d->{'alt_name'};  
                    }

                }
        }


        
function printRecord($r){
     $ro_key = $r->{'key'};
            $name =  $r->{'displayTitle'};

            echo '<li class="random-record-list">'; 
            echo '<a href="view/dataview?key='.$ro_key.'" class="record-list">'.$name.'</a>';            
            echo '</li>';
            
            
}

function displayDesc($facid,$partners)
{
    
    echo '<div class="facility-about">'.$partners[$facid]['description_value'].'</div>';
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

                    echo anchor('search#!/q=*:*/p=1/tab=collection/group='.$partners[$fackey]['displayTitle'].'/adv=1','<b>View all '.$partners[$fackey]['alt_name'].' records</b>');
                    echo '</ul>';
                }else
                {
                    echo '<div id="carousel">';
                    echo    '<div class="clearfix">';
                    echo '<div class="prev browse left"></div>';
                    echo    '<div id="scrollable">   ';
                    echo      ' <div class="items" id="items" style="left: 0px; ">';
                    echo            '<img id="http://www.tern.org.au/AusCover-pg17728.html" src="../img/auscover.png" height="102" width="194"/>';
                    echo            '<img id="http://www.tern.org.au/OzFlux-pg17729.html" src="../img/ozflux.png" height="102" width="194" />';
                   // echo            '<img id="http://www.tern.org.au/Multi-Scale-Plot-Network-pg17730.html" src="../img/mspn.png" height="102" width="194"/>';
                    echo            '<img id="http://www.tern.org.au/AusPlots-pg17871.html" src="../img/ausplot.png" height="102" width="194"" />';
                   // echo            '<img id="http://www.tern.org.au/Long-Term-Ecological-Research-Network-pg17872.html" src="../img/ltern.png" height="102" width="194"  />';
                    echo            '<img id="http://www.tern.org.au/Australian-Supersite-Network-pg17873.html" src="../img/supersite.png" height="102" width="194" />';
                   // echo            '<img id="http://www.tern.org.au/Soil-and-Landscape-Grid-of-Australia-pg17731.html" src="../img/soil.png" height="102" width="194"  /><';
                  //  echo            '<img id="http://www.tern.org.au/Australian-Coastal-Ecosystems-pg17732.html" src="../img/acef.png" height="102" width="194"  />';
                    echo            '<img id="http://www.tern.org.au/Eco-informatics-pg17733.html" src="../img/aekos.png" height="102" width="194"  />';
                  //  echo            '<img id="http://www.tern.org.au/Ecosystem-Modelling-and-Scaling-Infrastructure-pg17734.html" src="../img/emast.png" height="102" width="194"  />';
                    echo            '<img id="http://www.tern.org.au/Australian-Centre-for-Ecological-Analysis-and-Synthesis-pg17735.html" src="../img/aceas.png" height="102" width="194"  />';
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