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
                initViewMap('spatial_coverage_map','spatial_coverage_center','.coverage');
		window.print();
	}
        
        	function initDataViewPage(){

                handlerecordpopupSlide();
                initConnectionsBox();
                initSubjectsSEEALSO();
                initViewMap('spatial_coverage_map','.spatial_coverage_center','.coverage');

	}
        
        function initViewPage(){

		//hide all descriptions and headings
		//$('.descriptions div, .descriptions h3').hide();
		brief = null;
		//if there is a brief, brief is the first brief
		$('.descriptions div').each(function(){
			if (brief==null){
				if($(this).hasClass('brief')) {
					brief = this;
				}
			}
		});
		//if there is no brief, brief will be the first full
		if(brief==null){
			$('.descriptions div').each(function(){
				if(brief==null){
					if($(this).hasClass('full')) {
						brief = this;
					}
				}
			});
		}
		//if there is no brief or full, grab the first description
		if(brief==null){
			brief = $('.descriptions div')[0];
		}

		//limit to 10 lines, each line height is 17px;
		if($(brief).height() > 169){
			//$(brief).css('height','169px').css('overflow','hidden');
			//$('.showall_descriptions').show();
		}
		//if there are more than 1 description, show the more button
		if($('.descriptions div').length > 1){
			//$('.showall_descriptions').show();
		}
		//the more button
		$('.showall_descriptions').live('click', function(){
			//show all descriptions and headings
			//$(this).hide();
			//$('.descriptions div, .descriptions h3').slideDown();
			//$('.descriptions div').css('height','auto');
		});
		//$(brief).show();

                subjects = null;
                //if there is no subjetcs
		if(subjects==null){
			subjects = $('div.subjects');
		}
                
		//limit to 10 lines, each line height is 17px;
		if(subjects.height() > 155){
			subjects.css('height','155px').css('overflow','hidden');
			$('.showall_subjects').show();
		}
		//if there are more than 1 description, show the more button
		if($('ul.subjects').length > 4){
			$('.showall_subjects').show();
		}
		//the more button
		$('.showall_subjects').live('click', function(){
			//show all descriptions and headings
			$(this).hide();
			subjects.slideDown();
                        subjects.height('auto');
                     
                    
		});
		$(subjects).show();
                
		var key = $('#key').html();
		var itemClass = $('#class').text();
		//console.log(key);

		initConnectionsBox();//setup the connections Box

		if(itemClass=='Collection') {
			initSubjectsSEEALSO();
		}else if(itemClass=='Party') {
			initIdentifiersSEEALSO();
		}


		//ARCS RIGHTS ELEMENTS fix
		$('.rights').each(function(){
			var content = $(this).html();
			var img = '';
			if(content.indexOf('https://df.arcs.org.au/ARCS/projects/PICCLOUD')>0){
				var s = content.split('http');
				url = 'http'+s[1];
				var img = '<a href="'+url+'"><img src="http://polarcommons.org/images/PIC_print_small.png"/></a>';
				$(this).html(img);
			}
		});



        $('.ui-widget-overlay').live("click", function() {
        	$("#infoBox").dialog("close");
        });


        if($('#party_logo').length>0){//logo fix
        	var party_logo_url = $('#party_logo').attr('src');
        	testLogo('party_logo', party_logo_url);
        }
        return false;
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

