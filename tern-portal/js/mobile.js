function drawMap(){//drawing the map on the left side

		if($('p.coverage').length > 0){//if there is a coverage

                var latlng = new google.maps.LatLng(-25.397, 133.644);
                    var myOptions2 = {
                      zoom: 4,
                      center: latlng,
                      disableDefaultUI: true,
                      panControl: true,
                      zoomControl: true,
                      mapTypeControl: true,
                      scaleControl: true,
                      streetViewControl: false,
                      overviewMapControl: false,
                      mapTypeId: google.maps.MapTypeId.HYBRID
                    };




			var myOptions = {
		      zoom: 1,disableDefaultUI: true,center:latlng,panControl: true,zoomControl: true,mapTypeControl: true,scaleControl: true,
		      streetViewControl: false,overviewMapControl: true,mapTypeId: google.maps.MapTypeId.HYBRID
		    };
		    var map2 = new google.maps.Map(document.getElementById("spatial_coverage_map"),myOptions);
		    var bounds = new google.maps.LatLngBounds();

		    //draw coverages
		    var coverages = $('p.coverage');
		    //console.log(coverages.html());
		    //console.log(coverages.text());
		    if(coverages.text().indexOf('northlimit')==-1){
				$.each(coverages, function(){
					coverage = $(this).html();
					split = coverage.split(' ');
					coords = [];
					$.each(split, function(){
						coord = stringToLatLng(this);
						coords.push(coord);
						bounds.extend(coord);
					});
					poly = new google.maps.Polygon({
					    paths: coords,
					    strokeColor: "#FF0000",
					    strokeOpacity: 0.8,
					    strokeWeight: 2,
					    fillColor: "#FF0000",
					    fillOpacity: 0.35
					});
					poly.setMap(map2);
					//console.log(poly);
				});
		    }else{
		    	//console.log(coverages);
		    	$.each(coverages, function(){
		    		coverage = $(this).html();
		    		split = coverage.split(';');

		    		$.each(split, function(){
						word = this.split('=');
						//console.log(word);
						if(jQuery.trim(word[0])=='northlimit') n=word[1];
						if(jQuery.trim(word[0])=='southlimit') s=word[1];
						if(jQuery.trim(word[0])=='eastLimit') e=word[1];
						if(jQuery.trim(word[0])=='eastlimit') e=word[1];
						if(jQuery.trim(word[0])=='westlimit') w=word[1];
					});
		    		coords = [];
		    		coords.push(new google.maps.LatLng(parseFloat(n), parseFloat(e)));
		    		coords.push(new google.maps.LatLng(parseFloat(n), parseFloat(w)));
		    		coords.push(new google.maps.LatLng(parseFloat(s), parseFloat(w)));
		    		coords.push(new google.maps.LatLng(parseFloat(s), parseFloat(e)));
		    		coords.push(new google.maps.LatLng(parseFloat(n), parseFloat(e)));

		    		$.each(coords, function(){
		    			bounds.extend(this);
		    		});

		    		poly = new google.maps.Polygon({
					    paths: coords,
					    strokeColor: "#FF0000",
					    strokeOpacity: 0.8,
					    strokeWeight: 2,
					    fillColor: "#FF0000",
					    fillOpacity: 0.35
					});

					poly.setMap(map2);
		    		//console.log(poly);
				});
		    }
			//draw centers
			var centers = $('.spatial_coverage_center');
			$.each(centers, function(){
			 var marker = new google.maps.Marker({
		            map: map2,
		            position: stringToLatLng($(this).html()),
		            draggable: false,
		            raiseOnDrag:false,
		            visible:true
		        });
			});
                        if (bounds.getNorthEast().equals(bounds.getSouthWest())) {
                                  var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.4, bounds.getNorthEast().lng() + 0.4);
                                   var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.4, bounds.getNorthEast().lng() - 0.4);
                                   bounds.extend(extendPoint1);
                                   bounds.extend(extendPoint2);
                            }
			map2.fitBounds(bounds);
                        google.maps.event.trigger(map2, 'resize');
		}
	}
	/*
	 * Convert a string of a form (x, y) to a pair of latlng
	 */
	function stringToLatLng(str){
		var word = str.split(',');
		var lat = word[1];
		var lon = word[0];
		var coord = new google.maps.LatLng(parseFloat(lat), parseFloat(lon));
		return coord;
	}


$( '#page' ).live( 'pageinit',function(event){


       
        $('#coverage').live('click',function(event){
               drawMap();
        });

});



