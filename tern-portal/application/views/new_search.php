<?php $this->load->view('tpl/header'); ?>      
<div id="page_name" class="hide">Search</div>
<!--div id="loading" class="hide" ><p><img src="/img/ajax-loader.gif" alt="Please wait.." /> Please wait.. </p></div-->
<div id="dialog-searchterm" title="Confirm search" class="hide">There are special characters entered. Do you want to continue?</div>
<div id="dialog-noresult" title="No results" class="hide">No results were found matching your search terms.</div> 
<!--
<div id="container" class="ui-corner-all clearfix">
     <div id="page_name" class="hide">Search</div>
     <div id="loading"  ><p><img src="/img/ajax-loader.gif" alt="Please wait.." /> Please wait.. </p></div>
            <div id="search-panel" class="">    
                <div id="accordion" class="accordion">
                     
                  
                    <h2 id="facetH2"><a href="#">Search</a></h2>
                    <div id="facet-frame" ><div id="facet-accordion" class="accordion"></div></div>         
                 </div>
            </div> 
            <div id="result-panel" class="ui-layout-center ">

        
                 <?php //$this->load->view('tab/widgets/spatial');?>
                  <div id ="middle-toolbar" class="clearfix"></div>
                <div id="search-result" class="ui-layout-search-results"></div>
                <div id ="bottom-toolbar"></div>
            
            </div>
        </div> 
<div id="dialog-searchterm" title="Confirm search" class="hide">There are special characters entered. Do you want to continue?</div>
-->

<div class="wrapper">
    <nav id="facetNav"><div id="refineSearchBox" class="box"><a class="helpBtn" id="facet-help"></a><h1 class="greenGradient">Search</h1><div class="content">
                <ul>     </ul></div><div id="facet-help-text" title="Refine Search Help"></div></div>
    </nav>
    <section class="right" id="result-panel">
        <?php $this->load->view('tab/widgets/spatial');?>
        <nav id="middle-toolbar" class="resultsNav"></nav>
        <div id="search-result"></div>
        <nav id ="bottom-toolbar" class="resultsNav"></nav>
    </section>
    <?php $this->load->view('tpl/footer');?>
</div>
