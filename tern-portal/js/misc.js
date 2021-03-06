/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        var MAX_LOGO_WIDTH = 200;
	var MAX_LOGO_HEIGHT = 200;
        
        
function testLogo(id, url){
		var img = $('#'+id)[0]; // Get my img elem
		//$('#'+id).hide();
		var pic_real_width, pic_real_height;
		$("<img/>") // Make in memory copy of image to avoid css issues
		    .attr("src", $(img).attr("src"))
		    .load(function() {
		    	resizeLogo(this, id);
		    	$('#'+id).show();
		    }).error(function(){
			  $('#'+id).hide();
			});
	}


function resizeLogo(image , id)
	{
		var maxWidth = MAX_LOGO_WIDTH; // Max width for the image
	    var maxHeight = MAX_LOGO_HEIGHT;    // Max height for the image
	    var width = image.width;    // Current image width
	    var height = image.height;  // Current image height
		if(width > maxWidth || height > maxHeight)
		{
			var hRatio = maxHeight / height;
			var wRatio = maxWidth / width;
	        if(hRatio > wRatio)
	    	{
	            h = height * wRatio;   // Set new height
	            w = width * wRatio;
	    	}
	        else
	        {
	            h = height * hRatio;   // Set new height
	            w = width * hRatio;
	    	}
	    	$('#' + id).css({height: h, width: w});
		}
	}




function initPrintViewPage(){
		//alert('init');

		$('#header').hide();
		$('.descriptions div').show();
		$('.descriptions div').height('auto');
		//$('.showall_descriptions').hide();
		$('.tipsy').hide();
                initConnectionsBox();
                initSubjectsSEEALSO();
                initViewMap('metadatamap','spatial_coverage_center','.coverage');
		window.print();
	}
        
function initDataViewPage(){

                initConnectionsBox();
                initSubjectsSEEALSO();
                initViewMap('metadatamap','.spatial_coverage_center','.coverage');

	}
        
function initViewPage(){
        $('.meta_title').click(function(){
            var div=$(this).closest('li').find('div');
               if(div.hasClass('content') && div.hasClass('collapse'))
               {
                   div.removeClass('collapse').addClass('expand');
                  $(this).find('span.right').html("Hide");
                  $(this).find('a').attr('class','hide');
                  if(div.hasClass('subjects')){
                       if($('div.subjects ul li').length > 7 && $('div.subjects').height() == 159){
                           $('.showall_subjects').show();
                       }
                  }

               }
               else if(div.hasClass('content') && div.hasClass('expand')) 
               {

                   div.removeClass('expand').addClass('collapse');
                    $(this).find('span.right').html("Show");
                     $(this).find('a').attr('class','show');
                      if(div.hasClass('subjects')){
                     $('.showall_subjects').hide();
                  }
               }

        }); 
        
        $.each($('.description'), function() {
            var desc = $(this).html();
            
             $(this).html(linkify_html(desc));
            
            
        });
        $.each($('.licensing p'), function() {
               var html = $(this).html();
               $(this).html(linkify_html(html));
        });
            	//$(brief).show();
                 $.each($('.forcode li'), function(){
                    var txt= $(this).html().toProperCase();
                    $(this).html(txt);
                });

                var  subjects = null;
                //if there is no subjetcs
		if(subjects==null){
			subjects = $('div.subjects'); 
		}
               if($('div.subjects ul li').length > 7){
                    $('div.subjects').css('height','159px');
                            
               }
		//the more button
		$('.showall_subjects').on('click', function(){
			//show all descriptions and headings
			$(this).hide();
			subjects.slideDown();
                        subjects.height('auto');                     
                        
                 });

                 if($('#metadataTitle h1').html().length > 100) $('#metadataTitle h1').css('font-size', '16px');
             
                 var metatitle=$('#metadataTitle h1').text();
                 $('#addToFavourite').click(function(){
                     var tmp;
                     var arr_cookie=new Array;

                     
                     if(getCookie('SavedRecords')!='undefined' && getCookie('SavedRecords')!=null)
                     {
                        tmp=getCookie('SavedRecords');
                        arr_cookie=tmp.split('|');
                        
                        if(arr_cookie.length<20)
                        {
                           arr_cookie.push(window.location.href+";"+metatitle);    
                        }   
                        else
                        {
                           $("#cookiewarning"). dialog({
                                resizable: false,
                                height: 140,
                                modal: true,
                                buttons: {
                                    "OK": function() { 
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });                 
                        }
                     }
                     else
                     {
                         arr_cookie.push(window.location.href+";"+metatitle);                         
                     }
                     
                     if(arr_cookie.length<20)
                     {
                        arr_cookie.clean("");
                        tmp=arr_cookie.join('|');
                        setCookie('SavedRecords',tmp,365);     
                        $('#saveRecord').show()
                        $('#addToFavourite').hide();  
                        
                     }
                     
                     
                 });
                 checkRecordinCookie( $('#saveRecord'),$('#addToFavourite'),window.location.href+";"+metatitle);
   }


function removeBracket(arr)
{
    var i,idx;
    var t=[];
    for(i=0;i<arr.length;i++)
    {
          idx=arr[i].indexOf("(");

          if(idx>-1)
          {
                  t[i]=arr[i].substring(0, idx-1);
          }else
          {
              t[i]=arr[i];
          }
          
    }
    return t;
}

function setupSeealsoBtns(){
		$('.button').button();
        $("#status").html($('#seeAlsoCurrentPage').html() + '/'+$('#seeAlsoTotalPage').html());
    }


function initMapProto(){
            
            var mapWidget = new MapWidget('spatialmap',true);
            //add box drawing
            mapWidget.addDrawLayer({
                geometry: "box", 
                allowMultiple: false, 
                afterDraw: updateCoordinates, 
                afterDrag: updateCoordinates
            });
          /* mapWidget.addExtLayer({
                url:"aus_east",
                protocol: "GEOJSON",
                afterSelect: function(e,WGS1, WGS2){return true;}
            });*/
            mapWidget.addExtLayer({
                url: "aus_east_wms",
                protocol: "WMS"
            });
            //enable clicking button controllers
            enableToolbarClick(mapWidget);
                 
            //changing coordinates on textbox should change the map appearance
            enableCoordsChange(mapWidget);  
                    

            
        }
        

Array.prototype.clean = function(deleteValue) {
  for (var i = 0; i < this.length; i++) {
    if (this[i] == deleteValue) {         
      this.splice(i, 1);
      i--;
    }
  }
  return this;
};
        
function checkRecordinCookie(saveRecord,addToFavourite,urlandtitle)
{
    var savedRecords;
    var key;
    if(getCookie('SavedRecords')!=null&&getCookie('SavedRecords')!="")
    {
        savedRecords=getCookie("SavedRecords");  
        var t=savedRecords.split('|');
        //var title=$('#metadataTitle h1').text();
        key=jQuery.inArray(urlandtitle,t);
        if(key==-1) 
        {
            
            saveRecord.hide();
            addToFavourite.show();      
        }else
        { 
            saveRecord.show();
            addToFavourite.hide();                
        }
        
    }else 
    {
        saveRecord.hide(); 
        addToFavourite.show();
    }
    
}
