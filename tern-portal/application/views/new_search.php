<?php $this->load->view('tpl/header'); ?>      
<div id="page_name" class="hide">Search</div>
<!--div id="loading" class="hide" ><p><img src="/img/ajax-loader.gif" alt="Please wait.." /> Please wait.. </p></div-->
<div id="dialog-searchterm" title="Confirm search" class="hide">There are special characters entered. Do you want to continue?</div>
<div id="dialog-confirm-all" title="Confirm search" class="hide">No search term was entered. Do you want to see ALL records?</div>
<div id="dialog-noresult" title="No results" class="hide">No results were found matching your search terms.</div> 
 

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
