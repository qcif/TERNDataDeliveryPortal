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
        <select id="dateFrom">               
		<?php 
                    for($i=$min_year;$i<$max_year;$i++)
                    {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
		?>
        </select>
        &  
        <select id="dateTo">
		<?php 
                    for($i=$max_year;$i>$min_year;$i--)
                    {
			echo '<option value="'.$i.'">'.$i.'</option>';
                    } 
		?>
        </select>
        <a id="search_temp" class="greenGradient smallRoundedCorners">GO</a>
        </div>
    </div>
    
    <div id="min_year" class="hide"><?php echo $min_year;?></div>
    <div id="max_year" class="hide"><?php echo $max_year;?></div>
</li>

<!--
<div class="borderMe collapsiblePanel">  
    <h5 class="head">Date</h5>
    <div id="temporalFilter" class="padding5">

    <label for="show-temporal-search">Show data between</label><br/>

            <select id="dateFrom">               
		<?php 
                  //  for($i=$min_year;$i<$max_year;$i++)
                  //  {
                  //     echo '<option value="'.$i.'">'.$i.'</option>';
                  //  }
		?>
            </select>
            and  
            <select id="dateTo">
		<?php 
                    //for($i=$max_year;$i>$min_year;$i--)
                    //{
			//echo '<option value="'.$i.'">'.$i.'</option>';
                    //} 
		?>
            </select>
       <button id="search_temp" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only srchButton">Search</button>
    </div>
            <div id="min_year" class="hide"><?php //echo $min_year;?></div>
            <div id="max_year" class="hide"><?php //echo $max_year;?></div>
           
            <div class="clearfix"></div>
</div>

-->