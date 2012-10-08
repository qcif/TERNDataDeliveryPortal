<li id="advancedSearch">
    <h2>
        <a id ="adv_bool" class="hide" href="javascript:void(0);">Advanced Boolean Search</a>
  
    </h2>
    <div class="content expand" id="adv_bool_operator" style="display:none">
         <a id="term-help" class="helpBtn " ></a><label>
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
       
    </div>    
</li>

<li>
    <input id="refineSearchTextField" name="query" type="text" placeholder="Search ecosystem data">
    <a id="refineSearchBtn"></a>
</li>

<!--
<div class="collapsiblePanel">
    <h5 class="head">Search term:<div id="term-help"><a  class="tooltip" >?</a></div></h5>
    <div>
    <div>
         <a href="javascript:void(0);" id="adv_bool">Advanced Search</a>

         <div id="adv_bool_operator" style="display:none">

             <input type="radio" name="boolean_operator" value="AND" />Include (AND)<br />
             <input type="radio" name="boolean_operator" value="OR" checked="true"/>Expand (OR)<br />
             <input type="radio" name="boolean_operator" value="NOT" />Exclude (NOT)<br />
         </div>

    </div>
    <div id="basic-search">
        <input class="searchbox" id ="search-box"  type="text" name="query" />
        <button id="search_basic" class="ui-widget ui-state-default ui-corner-all ui-button-text-only">Search</button>
    </div>
    </div>
</div>
-->
<div id="term-help-text" title="<?php echo $this->lang->line('term_helptitle');?>" class="hide" ><?php echo $this->lang->line('term_helptext');?></div>



