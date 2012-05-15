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