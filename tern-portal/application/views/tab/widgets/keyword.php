<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="advance-keyword-search" class="borderMe collapsiblePanel">  
    <h3 class="head ui-widget-header">Search Terms</h3>

    <div id="keywordsrch" class="padding5">
       
        <div id="firstsearch">
             <select name="fields[]">
                    <option value="">All Fields</option>
                    <option value="displayTitle">Title/Name</option>
                    <option value="description">Description</option>
                    <option value="subject">Keyword</option>
                </select>
            <input class="search-input short" name="keyword[]" type="text" value=""/>
                <select name="operator[]">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                    <option value="-">NOT</option>
                </select>  
        </div>
   
        <div id="secondsearch">
            <select name="fields[]">
                    <option value="">All Fields</option>
                    <option value="displayTitle">Title/Name</option>
                    <option value="description">Description</option>
                    <option value="subject">Keyword</option>
                </select>
          <input class="search-input short" name="keyword[]" type="text" value=""/>
            <select name="operator[]">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                    <option value="-">NOT</option>
                </select>  
        </div>

        <div id="thirdsearch">
            <select name="fields[]">
                    <option value="">All Fields</option>
                    <option value="displayTitle">Title/Name</option>
                    <option value="description">Description</option>
                    <option value="subject">Keyword</option>
                </select>
             <input class="search-input short" name="keyword[]" type="text" value=""/>
           
           
        </div>
    </div>

    
</div>