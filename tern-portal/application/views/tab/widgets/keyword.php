<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<p><b><label>Keywords</label></b></p>
<div id="advance-keyword-search">  
    <div id="keywordsrch">
        <!--div id="condition">
            <input type="radio" name="conditionselect" value="any" />Match any of the conditions
            <input type="radio" name="conditionselect" value="all" />Match all of the conditions
        </div-->
        <p>
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
        <p>
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
        <p>
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