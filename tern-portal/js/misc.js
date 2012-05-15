/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    //background text
$('#search-box').each(function(){
 
    this.value = $(this).attr('title');
    $(this).addClass('text-background');
 
    $(this).focus(function(){
        if(this.value == $(this).attr('title')) {
            this.value = '';
            $(this).removeClass('text-background');
        }
    });
 
    $(this).blur(function(){
        if(this.value == '') {
            this.value = $(this).attr('title');
            $(this).addClass('text-background');
        }
    });
});

function handlefacetSlide()
{
            /*
	 * show-hide facet content, slide up and down
	 */
        $('.toggle-facet-field').die('click').live('click', function(){
            //console.log($(this).parent().parent().next('div.facet-content'));
            $(this).parent().parent().next('div.facet-content').slideToggle();
            //$(this).parent().children().toggle();//show all the toggle facet field in the same div
            $(this).toggleClass('ui-icon-arrowthickstop-1-n');
            $(this).toggleClass('ui-icon-arrowthickstop-1-s');
        //$(this).hide();
        });
}

function handlerecordpopupSlide()
{

        $('.toggle-record-popup').die('click').live('click', function(){

            $(this).parent().parent().next('div.record-slide').slideToggle();
            //$(this).parent().children().toggle();//show all the toggle facet field in the same div
            $(this).toggleClass('ui-icon-arrowthickstop-1-n');
            $(this).toggleClass('ui-icon-arrowthickstop-1-s');
        //$(this).hide();
        });
}