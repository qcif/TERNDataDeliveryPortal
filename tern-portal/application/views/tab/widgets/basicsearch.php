
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
    <div>
        <input class="searchbox" id ="search-box"  type="text" name="query" />
        <button id="search_basic" class="ui-widget ui-state-default ui-corner-all ui-button-text-only">Search</button>
    </div>
    </div>
</div>

<div id="term-help-text" title="<?php echo $this->lang->line('term_helptitle');?>" class="hide" ><?php echo $this->lang->line('term_helptext');?></div>



