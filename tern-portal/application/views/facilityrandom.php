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

                      // $partners[$key]['displayTitle']=$d->{'displayTitle'};                         
                        $partners[$key]['display_title']=$d->{'display_title'};                         

                       $partners[$key]['alt_name']=$d->{'alt_name'};  
                       $partners[$key]['query_name']=$d->{'query_name'};  
                       $partners[$key]['url']=$d->{'description_value'}[0]; 
                    }

                }
        }


        
function printRecord($r, $class){
     $ro_key = $r->{'key'};
     $date = $r->{'date_modified'};
     
     $date_t = new DateTime($date);
     $date_t->setTimeZone(new DateTimeZone("Australia/Brisbane"));
     $date = $date_t->format('d-m-Y');
     if($class!="") $class = "class=\"" . $class. "\"";
     if ($r->url_slug)
	{
            $key_url = base_url().$r->{'url_slug'};
	}
        else{
            $key_url = base_url() . 'view?key=' . urlencode($ro_key);
        }   
           // $name =  $r->{'displayTitle'}; //commented 8.1
            $name =  $r->{'display_title'}; //added 8.1

 
            echo '<li ' .$class . '>'; 
            echo    '<a href="'. $key_url .'" target="_new" >';
            echo    '<span class="date">'.$date.' - </span>';
            echo    $name;
            echo    '</a>';
            echo '</li>';
            
            
}




?> 
    
    
<?php if($header_footer) $this->load->view('tpl/header');?>



       
        <?php 
                if ($fackey!==tddp)
                {                    
                    echo '<div id="datasetsIncluded">';   
                    echo    '<h1>'.$partners[$fackey]['display_title'].'</h1>';
                    echo        '<p class="facility-text">';                    
                    echo            $partners[$fackey]['description_value'];
                    echo        '</p>';
                    if($half>0)
                    {    
                        echo        '<div class="viewAll">';
                        echo            '<a href="'.base_url().'search#!/q=*:*/p=1/tab=collection/group='.$partners[$fackey]['query_name'].'/num=10">View '.$partners[$fackey]['display_title'].' records</a>';
                        echo        '</div>';
                    }
                    echo '</div>';       


                }else
               {
                    echo '<div id="datasetsIncluded">';
                    echo     '<h1>Datasets Included</h1>';
                    echo    '<ul>';
                                if($topics && $topics->{'docs'}){	
                                    foreach($topics->{'docs'} as $d)
                                    {
                                        echo '<li>';
                                        echo    '<a href="'.$d->{'query_url'}.'">';
                                        echo          '<img alt="'.$d->{'title'}.'" src="'.$d->{'img_url'}.'"/>';
                                        echo          '<span>'.$d->{'title'}.'</span>';
                                        echo    '</a>';
                                        echo '</li>';
                                    }	
                                }     
                  echo     '</ul>';
                  echo    '</div>';

               }
 
                
                    echo '<div id="recentlyReleased">';
                    echo '<h1>Recently Released</h1>';
                    
                    if($half>0)
                    {                        
                        echo '<ul>';

                            for($i=0;$i<$half; $i++)
                            {
                               if($i==$half-1){
                                    printRecord($recordsArr[$i],"last-child");
                                }else{
                                    printRecord($recordsArr[$i],"");
                                }
                            }
                        echo '</ul>';

                        echo '<ul>';
                            for($i=$half;$i<$count; $i++)
                            {
                                 if($i==$count-1){
                                    printRecord($recordsArr[$i],"last-child");
                                }else{
                                    printRecord($recordsArr[$i],"");
                                }
                            }
                        echo '</ul>';
                    }else
                    {
                        echo '<ul>';
                        echo '<li>';
                        echo 'Coming soon';
                        echo '</li>';
                        echo '</ul>';
                    }
                    
                    echo '</div>';  
        ?>


<?php  if($header_footer)  $this->load->view('tpl/footer');?>