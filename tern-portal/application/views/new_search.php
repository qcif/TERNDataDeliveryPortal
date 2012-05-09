<?php $this->load->view('tpl/header'); ?>      
        <div id="container">

            <div id="center" class="ui-layout-center hidden">
                <div class="ui-layout-map hidden"><div id="result-map"></div></div>
                <div id="search-result" class="ui-layout-search-results hidden"></div>
            </div>
            

            <div class="ui-layout-west hidden">    
                <div id="accordion" class="accordion">
                    <h3><a href="#">Basic Search</a></h3>
                    <?php $this->load->view('tab/widgets/basicsearch');?>               
                    <h3><a href="#">Advanced Search</a></h3>
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
                 </div>
                     <?php $this->load->view('tab/widgets/buttonsearch');?>
               
           </div> 
            


        </div> 

<?php $this->load->view('tpl/footer');?>