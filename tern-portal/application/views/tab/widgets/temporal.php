<li>
    <div class="content expand collapsiblePanel">      
        <h2>
            <a class="hide" >Dates</a>
        </h2>
        <div>
        <p>
            Show temporal data
            <strong>between</strong>
            :
        </p>
        <select id="dateFrom" class="facetDropDown">               
		<?php 
                    for($i=$min_year;$i<$max_year;$i++)
                    {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
		?> 
        </select>
        &  
        <select id="dateTo" class="facetDropDown">
		<?php 
                    for($i=$max_year;$i>$min_year;$i--)
                    {
			echo '<option value="'.$i.'">'.$i.'</option>';
                    } 
		?>
        </select>
        <a href="javascript:void(0);" id="search_temp" class="greenGradient smallRoundedCorners">GO</a>
        </div>
    </div>
    
    <div id="min_year" class="hide"><?php echo $min_year;?></div>
    <div id="max_year" class="hide"><?php echo $max_year;?></div>
</li>

