<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>  
      
<?php

        echo '<span class="titleForm">Fields Of Research (Group) </span>';
        echo '<div id="forFilter">';
     
        echo '<select id="forfourFilter">';
        echo '<option value="">All</option>';
        foreach($subject as $forTwo=>$forFourArr)
        {
             //echo '<option value="'. $forTwo.'">'.$forTwo.'</option>';
        
              foreach($forFourArr as $forFour=>$forFourVal)
             {
                   echo '<option value="'. $forFour.'">  '.$forFour.'</option>';
             }
        }
     echo '</select></div>';
?>
