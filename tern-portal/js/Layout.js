var outerLayout,middleLayout,innerLayout;
      
function sizeCenterPane() {
    var $Container	= $('#container')
    ,	$Pane		= $('.ui-layout-center')
    ,	$Content1	= $('#search-result')
    ,   $Content2       = $('#ui-layout-facetmap')
    ,	outerHeight = $Pane.outerHeight()
    // use a Layout utility to calc total height of padding+borders (also handles IE6)
    ,       panePadding     = outerHeight - $.layout.cssHeight($Pane, outerHeight)
    ,       $West           = $('.ui-layout-west')
    ,       $WestContent    = $('#accordion')
    ,       outerWestHeight  = $West.outerHeight()      
    ,       paneWestPadding	= outerWestHeight - $.layout.cssHeight($West, outerWestHeight)
    ;
    if(( $Pane.position().top + $Content1.outerHeight() + $Content2.outerHeight() + panePadding  ) > ( $West.position().top + $WestContent.outerHeight() + paneWestPadding )) {
        // update the container height - *just* tall enough to accommodate #Content without scrolling
        $Container.height( $Pane.position().top + $Content1.outerHeight() + $Content2.outerHeight() + panePadding );
    }else{
        $Container.height( $West.position().top + $WestContent.outerHeight() + paneWestPadding + 220  );
    }
    // now resize panes to fit new container size
    outerLayout.resizeAll();
}

function setupOuterLayout(){
    /*                              LAYOUT
    *              Set outer container to div#container
    */
    // first set a 'fixed height' on the container so it does not collapse...
    var $Container = $('#container')
    $Container.height( $(window).height() - $Container.offset().top );

    // OUTER LAYOUT
    outerLayout = $('#container').layout({
        west__size: 300,
        resizable : false,
        closable: false,
        east__size:300,
        spacing_open: 0
       // togglerClass:	"toggler"	// default = 'ui-layout-toggler'
    });
    
}
function setupNestedLayout(mapResize){
    /*                              LAYOUT
    *              Set outer container to div#container
    */

    // first set a 'fixed height' on the container so it does not collapse...
  
    var $Content = $('#ui-layout-center')
    $Content.height( $(window).height() - $Content.offset().top );
    
 /*
    middleLayout = $('#ui-layout-center').layout({ 
        center__paneSelector:	"#search-result" 
        ,	
        north__paneSelector:	"#ui-layout-facetmap" 
        ,	
        north__size:            300
        , 
        north__resizable : true 
        , 
        north__spacing_closed:    30
        , 
        north__togglerLength_closed: 80
        , 
        togglerClass:	"middletoggler"	// default = 'ui-layout-toggler'
        , 
        livePaneResizing: true
        ,
        north__onresize: function(){
            innerLayout.resizeAll();
            mapResize();
        }
    }); 
    
  
    innerLayout = $('#ui-layout-facetmap').layout({ 
        center__paneSelector:	"#ui-layout-map" 
        ,	
        
        togglerClass:	"innertoggler"	// default = 'ui-layout-toggler'
        ,
        resizable: false
        ,
        west__onclose: function(){
            innerLayout.resizeAll();
            mapResize(); 
        }
    });  
    */
    // now RESIZE the container to be a perfect fit
     sizeCenterPane();
    $(".collapsiblePanel .head").click(function()
    {
        $(this).next("div").slideToggle(300);
    });
    $("#accordion").accordion({
        autoHeight:false
    });

    /* $("#accordion h2").click(function(){
        if($("#accordion").accordion("option","active") == 1 ) {
            $("#accordion").accordion("option","active",0);
        }else if($("#accordion").accordion("option","active") == 0  ) {
            $("#accordion").accordion("option","active",1);
        }
 
    }); 
    */
}

           
