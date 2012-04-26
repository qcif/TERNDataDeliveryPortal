<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>  
<div >        
<?php

        echo '<p><b><label>Fields Of Research (Group) </label></b></p>';

     
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
     echo '</select>';
?>
</div>