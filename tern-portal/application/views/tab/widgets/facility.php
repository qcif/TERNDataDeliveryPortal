<?php

        echo '<p><b><label>Research Institution (or Facilities)</label></b></p>';

        echo '<div>';
     
        echo '<select id="fac"  multiple="multiple" style="width:15em;height:15em">';

        foreach( $json->docs as $d)
        {
        
            echo '<option value="'.$d.'">'.$d.'</option>';
                   
       }
		
	echo '</select></div>';

?>
