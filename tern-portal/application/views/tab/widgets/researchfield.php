<div class="borderMe collapsiblePanel borderBottomMe">  
    <h3 class="head ui-widget-header">Fields Of Research</h3>
    
 <?php 
        echo '<div id="forFilter" class="padding5">';
     
        echo '<select id="forfourFilter">';
        echo '<option value="">All</option>';
        foreach($subject as $forTwo=>$forFourArr)
        {
             //echo '<option value="'. $forTwo.'">'.$forTwo.'</option>';
            if(is_array($forFourArr))
              foreach($forFourArr as $forFour=>$forFourVal)
             {
                   echo '<option value="'. $forFour.'">  '.$forFour.'</option>';
             }
        }
     echo '</select></div>';
?>
</div>