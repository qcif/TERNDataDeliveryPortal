<?php $this->load->view('tpl/header');?>

        <!--style >
          .olPopup { border : 0 !important;}
          #facilities { float: left}
        table.featureInfo, table.featureInfo td, table.featureInfo th {
		border:1px solid #ddd;
		border-collapse:collapse;
		margin:0;
		padding:0;
		font-size: 90%;
		padding:.2em .1em;
	}
	table.featureInfo th {
	    padding:.2em .2em;
		font-weight:bold;
		background:#eee;
	}
	table.featureInfo td{
		background:#fff;
	}
	table.featureInfo tr.odd td{
		background:#eee;
	}
	table.featureInfo caption{
		text-align:left;
		font-size:100%;
		font-weight:bold;
		text-transform:uppercase;
		padding:.2em .2em;
	}
            </style--> 
   <nav id="facetNav">
   	 <div id="refineSearchBox" class="box">
         <h1 class="greenGradient">TERN Facilities</h1>
         <div class="content">
            <ul>
               <li>                  
                  <div id="facilities">
                  
                  </div>
               </li>               
            </ul>
         </div>
      </div>
         
   </nav>
      <section class="right">  
        <div id="spatialmap" class=""></div>
      </section>
       
   
<?php $this->load->view('tpl/footer');?>
