<?php

        echo '<span class="titleForm">Research Institution (or Facilities)</span>';

        echo '<div id="groupFilter">';
     
        echo '';

        for($i=0;$i< sizeof($facilities)-1; $i=$i+2)
        {
        
            echo '<div class="checkitem"><input type="checkbox"  value="'. $facilities[$i].'" id="group' . $i . '"><label for="group' . $i . '">'.$facilities[$i].'</label></input></div>';
                   
        }
      
	echo '</div>';

?>
