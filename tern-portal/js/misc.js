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



function handlerecordpopupSlide()
{

        $('.toggle-record-popup').die('click').live('click', function(){

            $(this).parent().next('div.record-slide').slideToggle();
            $(this).toggleClass('ui-icon-arrowthickstop-1-n');
            $(this).toggleClass('ui-icon-arrowthickstop-1-s');

        });
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

                handlerecordpopupSlide();
                initConnectionsBox();
                initSubjectsSEEALSO();
                initViewMap('metadatamap','.spatial_coverage_center','.coverage');

	}
        
function initViewPage(){
        $('.meta_title').click(function(){
            var div=$(this).parent().children()[1];
               if (div.className=="content collapse") 
               {
                   div.className=div.className.replace("content collapse","content expand");
                   $(this).children()[0].children[1].innerHTML="Hide";
               }
               else if(div.className=="content expand") 
               {
                    div.className=div.className.replace("content expand","content collapse");
                    $(this).children()[0].children[1].innerHTML="Show"; 
               }

        }); 
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
        

