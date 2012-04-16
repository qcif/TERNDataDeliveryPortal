<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<p><b><label>Search options</label></b></p>
<div id="advance-keyword-search">  
    <div id="keywordsrch">
        <!--div id="condition">
            <input type="radio" name="conditionselect" value="any" />Match any of the conditions
            <input type="radio" name="conditionselect" value="all" />Match all of the conditions
        </div-->
        <p>
        <div id="firstsearch">
             <select id="operator1">
                    <option value="and">All Fields</option>
                    <option value="or">Title/Name</option>
                    <option value="not">Description</option>
                
                </select>
            <input class="search-input short" id="first-keyword1" type="text" value=""/>
                <select id="operator1">
                    <option value="and">AND</option>
                    <option value="or">OR</option>
                    <option value="not">NOT</option>
                </select>
          
        </div>
        <p>
        <div id="secondsearch">
            <select id="operator1">
                    <option value="and">All Fields</option>
                    <option value="or">Title/Name</option>
                    <option value="not">Description</option>
           
                </select>
          <input class="search-input short" id="first-keyword2" type="text" value=""/>
            <select id="operator2">
                    <option value="and">AND</option>
                    <option value="or">OR</option>
                      <option value="not">NOT</option>
            </select>
           
        </div>
        <p>
        <div id="thirdsearch">
            <select id="operator1">
                    <option value="and">All Fields</option>
                    <option value="or">Title/Name</option>
                    <option value="not">Description</option>
                     <option value="not">Description</option>
                </select>
             <input class="search-input short" id="first-keyword3" type="text" value=""/>
            <select id="operator3">
                    <option value="and">AND</option>
                    <option value="or">OR</option>
                     <option value="not">NOT</option>
            </select>
           
        </div>
    </div>

    
</div>