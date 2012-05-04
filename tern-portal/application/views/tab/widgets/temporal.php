<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<span class="titleForm">Temporal</span>
<div id="temporalFilter"><img src="<?php echo base_url();?>/img/no.png" id="show-temporal-search" title="toggle to enable/disable temporal search"/> 
    <label for="show-temporal-search">Show data between

            <select id="dateFrom">
                
		<?php 
                    for($i=$min_year;$i<$max_year;$i++)
                    {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
		?>
            </select>
            AND 
            <select id="dateTo">
		<?php 
                    for($i=$max_year;$i>$min_year;$i--)
                    {
			echo '<option value="'.$i.'">'.$i.'</option>';
                    }
		?>
            </select></label></div>
            <div id="min_year" class="hide"><?php echo $min_year;?></div>
            <div id="max_year" class="hide"><?php echo $max_year;?></div>
            <div id="date-slider" style="display:none"></div>
            <div class="clearfix"></div>
