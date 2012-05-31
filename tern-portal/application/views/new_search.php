<?php $this->load->view('tpl/header'); ?>      
        <div id="container">
            <div id="ui-layout-center" class="ui-layout-center ">
                 <div id="ui-layout-facetmap">
                       <div id ="ui-layout-map" class="ui-layout-map">
                          <div id="result-map"></div>                                               
                     </div>
                 </div>
                <div id="search-result" class="ui-layout-search-results">Loading...</div>
            </div>

            <div class="ui-layout-west hidden">    
                <div id="accordion" class="accordion">
                    <h2 id="basicSearchH2"><a href="#">Basic Search</a></h2>
                    <?php $this->load->view('tab/widgets/basicsearch');?>               
                    <h2 id="advSearchH2"><a href="#">Advanced Search</a></h2>
                    <div class="padding5">
                     
                    <?php if($widget_keyword) { ?> 
                     <?php $this->load->view('tab/widgets/keyword');?>
                 
                    <?php } ?>
                    <?php if($widget_facilities) { ?>
                     <?php $this->load->view('tab/widgets/facility');?>
                   
                    <?php } ?>
                    <?php if($widget_temporal) { ?>
                     <?php $this->load->view('tab/widgets/temporal');?>
                     <?php }?>
                     <?php if(widget_map) { ?>
                     <?php $this->load->view('tab/widgets/mapLayers');?>
              
                    <?php }?>
                    <?php if($widget_for){  ?>
                     <?php $this->load->view('tab/widgets/researchfield');?>              
                    <?php } ?>
                      </div>
                    <h2 id="facetH2" class="hide"><a href="#">Refine</a></h2>
                    <div id="facet-frame"><div id="facet-accordion" class="accordion"></div></div>         
                 </div>
                     <?php $this->load->view('tab/widgets/buttonsearch');?>
               
           </div> 
            


        </div> 

<?php $this->load->view('tpl/footer');?>