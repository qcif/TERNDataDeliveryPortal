<?php

        echo '<p><b><label>Research Institution (or Facilities)</label></b></p>';

        echo '<div id="groupFilter">';
     
        echo '';

        for($i=0;$i< sizeof($facilities)-1; $i=$i+2)
        {
        
            echo '<input type="checkbox"  value="'. $facilities[$i].'">'.$facilities[$i].'</input><br/>';
                   
        }
      
	echo '</div>';

?>
