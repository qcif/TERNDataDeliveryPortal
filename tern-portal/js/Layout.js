var accordion;
     
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

           
