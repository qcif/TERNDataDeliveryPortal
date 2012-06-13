var outerLayout,middleLayout,innerLayout, accordion;
     
function sizeCenterPane() {
    var $Container	= $('#container')
    ,	$Pane		= $('.ui-layout-center')
    ,	$Content1	= $('#search-result')
    ,   $Content2       = $('#ui-layout-facetmap')
    ,   $Content3       = $('#head-toolbar')
    ,	outerHeight = $Pane.outerHeight()
    // use a Layout utility to calc total height of padding+borders (also handles IE6)
    ,       panePadding     = outerHeight - $.layout.cssHeight($Pane, outerHeight)
    ,       $West           = $('.ui-layout-west')
    ,       $WestContent    = $('#advSearch')
    ,       outerWestHeight  = $West.outerHeight()      
    ,       paneWestPadding	= outerWestHeight - $.layout.cssHeight($West, outerWestHeight)
    ;
    var westSizeFix = 675;
    if(( $Pane.position().top + $Content1.outerHeight() + $Content2.outerHeight() + $Content3.outerHeight()   + panePadding  + 60) >  westSizeFix) { //($West.position().top + $WestContent.outerHeight() + paneWestPadding )) {
        // update the container height - *just* tall enough to accommodate #Content without scrolling
        $Container.height( $Pane.position().top + $Content1.outerHeight() + $Content2.outerHeight()  + $Content3.outerHeight() + panePadding + 60);
    }else{ 
        $Container.height(westSizeFix);
        //$Container.height( $West.position().top + $WestContent.outerHeight() + paneWestPadding );
    } 
    // now resize panes to fit new container size
    outerLayout.resizeAll();
}

function sizeHomeContent()
{
    var $Container = $('#container')
    $Container.height(430);
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
        
        spacing_open: 0
       // togglerClass:	"toggler"	// default = 'ui-layout-toggler'
    });
    $("ul.sf-menu").superfish(); 

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

    $(".collapsiblePanel .head").click(function()
    {
        $(this).next("div").slideToggle(300);
    });
    accordion = $("#accordion").accordion({
        autoHeight:false
    }).data("accordion");
    
    accordion._std_clickHandler = accordion._clickHandler;
    accordion._clickHandler = function( event, target ) {
        var clicked = $( event.currentTarget || target );
        if (! clicked.hasClass("ui-state-disabled"))
        this._std_clickHandler(event, target);
    };
    sizeCenterPane();

    /* $("#accordion h2").click(function(){
        if($("#accordion").accordion("option","active") == 1 ) {
            $("#accordion").accordion("option","active",0);
        }else if($("#accordion").accordion("option","active") == 0  ) {
            $("#accordion").accordion("option","active",1);
        }
 
    }); 
    */
}

           
