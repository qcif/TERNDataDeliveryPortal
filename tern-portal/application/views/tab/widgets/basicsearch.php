<li id="advancedSearch">
    <div class="expand collapsiblePanel">
    <h2>
        <a id ="adv_bool" class="show" href="javascript:void(0);">Advanced Boolean Search</a>
  
    </h2>
    <div class="content expand" id="adv_bool_operator" style="display:none">
           <input id="advancedBooleanSearch_1" type="radio" checked="checked" value="AND" name="advancedBooleanSearch">
            Include (AND)
        </label>
        <br>
        <label>
            <input id="advancedBooleanSearch_2" type="radio" value="OR" name="advancedBooleanSearch">
            Expand (OR)
        </label>
        <br>
        <label>
            <input id="advancedBooleanSearch_3" type="radio" value="NOT" name="advancedBooleanSearch">
        Exclude (NOT)
        </label>
       <div id="term-help-text" title="<?php echo $this->lang->line('term_helptitle');?>" class="hide" ><?php echo $this->lang->line('term_helptext');?></div>
    </div>   
    </div>
</li>

<li>
    <input id="refineSearchTextField" name="query" type="text" title="Search ecosystem data" placeholder="Search ecosystem data">
    <a id="refineSearchBtn" href="javascript:void(0);"></a>
</li>






