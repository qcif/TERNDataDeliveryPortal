var accordion;
    
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
  
    // now RESIZE the container to be a perfect fit

    $(".collapsiblePanel .head").live("click",function()
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
    //sizeCenterPane();

}

           
