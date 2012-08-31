<div class="borderMe collapsiblePanel">  
    <h3 class="head ui-widget-header">Facilities</h3>
    <div id="groupFilter" class="padding5">
    <?php
            for($i=0;$i< sizeof($facilities)-1; $i=$i+2)
            {

                echo '<div class="checkitem"><input type="checkbox"  value="'. $facilities[$i].'" id="group' . $i . '"/><label for="group' . $i . '">'.$facilities[$i].'</label></div>';

            }
        ?>
    </div>
</div>

