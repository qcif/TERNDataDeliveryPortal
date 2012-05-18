var outerLayout,middleLayout,innerLayout;
      
function sizeCenterPane () {
    var $Container	= $('#container')
    ,	$Pane		= $('.ui-layout-center')
    ,	$Content	= $('#search-result')
    ,	outerHeight = $Pane.outerHeight()
    // use a Layout utility to calc total height of padding+borders (also handles IE6)
    ,	panePadding	= outerHeight - $.layout.cssHeight($Pane, outerHeight)
    ,       $West           = $('.ui-layout-west')
    ,       $WestContent    = $('#accordion')
    ,       outerWestHeight  = $West.outerHeight()      
    ,       paneWestPadding	= outerWestHeight - $.layout.cssHeight($West, outerWestHeight)
    ;
    if(( $Pane.position().top + $Content.outerHeight() + panePadding + 300 ) > ( $West.position().top + $WestContent.outerHeight() + paneWestPadding )) {
        // update the container height - *just* tall enough to accommodate #Content without scrolling
        $Container.height( $Pane.position().top + $Content.outerHeight() + panePadding + 300 );
    }else{
        $Container.height( $West.position().top + $WestContent.outerHeight() + paneWestPadding + 220  );
    }
    // now resize panes to fit new container size
    outerLayout.resizeAll();
}

function setupNestedLayout(mapResize){
    /*                              LAYOUT
    *              Set outer container to div#container
    *              Set inner container to div#content 
    */

    // first set a 'fixed height' on the container so it does not collapse...
    var $Container = $('#container')
    $Container.height( $(window).height() - $Container.offset().top );

    // OUTER LAYOUT
    outerLayout = $('#container').layout({
        west__size: 300,
        west__resizable : false
        , 
        west__spacing_closed: 30
        , 
        west__togglerLength_closed: 80
        , 
        togglerClass:	"toggler"	// default = 'ui-layout-toggler'
    });
    
    var $Content = $('#ui-layout-center')
    $Content.height( $(window).height() - $Content.offset().top );
    

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
        west__paneSelector:	"#ui-layout-facet" 
        ,	
        west__size:				300 
        , 
        west__spacing_closed: 30
        , 
        west__togglerLength_closed: 80
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

    // now RESIZE the container to be a perfect fit
     sizeCenterPane();
    $(".collapsiblePanel .head").click(function()
    {
        $(this).next("div").slideToggle(300);
    });
    $("#accordion").accordion({
        autoHeight:false
    });
    $("#accordion h3").click(function(){
        if($("#accordion").accordion("option","active") ) {
            $("#accordion").accordion("option","active",0);
        }else{
            $("#accordion").accordion("option","active",1);
        }
 
    });
}

           
