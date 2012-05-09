var myLayout,middleLayout,innerLayout;
      
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
    if(( $Pane.position().top + $Content.outerHeight() + panePadding ) > ( $West.position().top + $WestContent.outerHeight() + paneWestPadding )) {
        // update the container height - *just* tall enough to accommodate #Content without scrolling
        $Container.height( $Pane.position().top + $Content.outerHeight() + panePadding );
    }else{
        console.log( $West.position().top + $WestContent.outerHeight() + paneWestPadding + 100);
        $Container.height( $West.position().top + $WestContent.outerHeight() + paneWestPadding );
    }
    // now resize panes to fit new container size
    myLayout.resizeAll();
}

function setupNestedLayout(){
    /*                              LAYOUT
    *              Set outer container to div#container
    *              Set inner container to div#content 
    */

    // first set a 'fixed height' on the container so it does not collapse...
    var $Container = $('#container')
    $Container.height( $(window).height() - $Container.offset().top );

    // OUTER LAYOUT
    myLayout = $('#container').layout({
        west__size: 300, 
        north__spacing_open: 0
        , west__spacing_closed: 30
        , west__togglerLength_closed: 80
        , togglerClass:	"toggler"	// default = 'ui-layout-toggler'
    });
    
    
    var $Content = $('#search-result')
    $Content.height( $(window).height() - $Content.offset().top );
    

        middleLayout = $('#center').layout({ 
        center__paneSelector:	".ui-layout-search-results" 
        ,	
        north__paneSelector:	".ui-layout-map" 
        ,	
        north__size:                             300
        , north__spacing_closed:    30
        , north__togglerLength_closed: 80
        , togglerClass:	"middletoggler"	// default = 'ui-layout-toggler'
    }); 
    
    // now RESIZE the container to be a perfect fit
    sizeCenterPane();

   $(".collapsiblePanel .head").click(function()
    {
     $(this).next("div").slideToggle(300);
     });
   $("#accordion").accordion({autoHeight:false});
}

function layoutInner()
{       
        if(typeof innerLayout != 'undefined') innerLayout.destroy();
        innerLayout = $('#search-result').layout({ 
        center__paneSelector:	".ui-layout-results" 
        ,	
        west__paneSelector:		".ui-layout-facet" 
        ,	
        west__size:				300 
        , west__spacing_closed: 30
        , west__togglerLength_closed: 80
        , togglerClass:	"innertoggler"	// default = 'ui-layout-toggler'
    }); 
}
           
