
function urldecode(str) {
    return decodeURIComponent((str+'').replace(/\+/g, '%20'));
}

function trimwords(theString, numWords) {
    
    if(theString!=null)
    {
            expString = theString.split(/\s+/,numWords);
            theNewString=expString.join(" ");
            return theNewString;
    }else
    {
            return '';
    }
    
}

function searchStringInArray (needle, stringArray) {
    for (var j=0; j<stringArray.length; j++) {
        if (stringArray[j].match(needle)) return j;
    }
    return -1;
}

$(function() {
    $(":checkbox").attr("autocomplete", "off");
    
    // GLOBAL VARIABLES
    var hash = window.location.hash;
    var search_term = '';
    var page = 1;
    var classFilter = 'collection';
    var typeFilter = 'All';
    var groupFilter = 'All';
    var subjectFilter = 'All';
    var fortwoFilter='All';
    var mapSearch = 0;
    var forfourFilter='All';
    var forsixFilter='All';
    var ternRegionFilter = 'All';
    var resultSort = 'score desc';
    var temporal = 'All';        
    var n = '';
    var e = '';
    var s='';
    var w='';
    var mapResult;
    var param_q;
    var spatial_included_ids = '';
    var num=10;
    
    // ROUTING 
    function routing(){
        if(window.location.href.indexOf('https://')==0){
            var thisurl = window.location.href;
            thisurl = thisurl.replace('https://','http://');
            window.location.href=thisurl;
        }

        if(window.location.href.indexOf('/view')>=0){
            initViewPage();
            if(window.location.href.indexOf('printview')>=0) initPrintViewPage();
            if(window.location.href.indexOf('dataview')>=0) initDataViewPage();
        }else if(window.location.href==secure_base_url){
            window.location.href=base_url;
        }else if(window.location.href.indexOf('search')>=0){
            initSearchPage();
   
        }else if(window.location.href.indexOf('preview')>=0){
            initPreviewPage();
        }else if(window.location.href.indexOf('mapproto')>=0){
            initMapProto();        
        }else {
            initHomePage();
        }
    }
    
    $(window).hashchange(function(){

        var hash = window.location.hash;
        var query = hash.substring(3, hash.length);
        var words = query.split('/');
        
        param_q = searchStringInArray("q",words);
        
        $.each(words, function(){
            var string = this.split('=');
            var term = string[0];
            var value = urldecode(string[1]);
            switch(term){
                case 'q':
                    search_term=value;
                    break;
                case 'p':
                    page=value;
                    break;
                case 'tab':
                    classFilter=value;
                    break;
                case 'group':
                    groupFilter=value;
                    break;
                case 'type':
                    typeFilter=value;
                    break;
                case 'subject':
                    subjectFilter=value;
                    break;
                case 'fortwo':
                    fortwoFilter=value;
                    break;
                case 'forfour':
                    forfourFilter=value;
                    break;
                case 'forsix':
                    forsixFilter=value;
                    break;
                case 'temporal':
                    temporal=value;
                    break;
                case 'ternRegion':
                    ternRegionFilter = value;
                   
                    break;
                case 'n':
                    n=value;
                    break;
                case 'e':
                    e=value;
                    break;
                case 's':
                    s=value;
                    break;
                case 'w':
                    w=value;
                    break;
                case 'alltab':
                    alltab=value;
                    break;
                case 'mapSearch':
                    mapSearch = value;
                    break;
            }
        });
        if(classFilter!=$('#classSelect').val()) {
            $('#classSelect').val(classFilter);
        }
     
         if(param_q > -1 || mapSearch==1){
                search_term = search_term.replace(/ or /g, " OR ");//uppercase the ORs
                search_term = search_term.replace(/ and /g, " AND ");//uppercase the ANDS
                
                $("#loading").show();                             
    
                if(getCookie("selection")!=null)
                {                   
                    num=getCookie("selection");
                }
        
                if(window.location.href.indexOf('/n')>=0&&window.location.href.indexOf('/s')>=0&&window.location.href.indexOf('/w')>=0&&window.location.href.indexOf('/e')>=0)
                { 
                        doSpatialSearch();
                }else{
                        doNormalSearch();
                }
         }
            
    });
   
    $(window).hashchange(); //do the hashchange on page load
    routing(); 
       
    $('.typeFilter, .groupFilter, .subjectFilter,.fortwoFilter, .forfourFilter, .forsixFilter, .ternRegionFilter').live('click', function(event){
        if(event.type=='click'){
            page = 1;
            if($(this).hasClass('typeFilter')){
                typeFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));
            }else if($(this).hasClass('groupFilter')){
                groupFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));
            }else if($(this).hasClass('subjectFilter')){
                subjectFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));
                               
            }else if($(this).hasClass('fortwoFilter')){
                fortwoFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));               
                               
            }else if($(this).hasClass('forfourFilter')){
                forfourFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));               
                               
            }else if($(this).hasClass('forsixFilter')){
                forsixFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));               
                               

            }else if($(this).hasClass('ternRegionFilter')){
                ternRegionFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));               
                               

            }         
            
        }
    }); 
     
    /*
	 * Clearing filters/facets
	 */
    $('.clearFilter').live('click', function(e){
        if($(this).hasClass('clearType')){
            typeFilter = 'All';
        }else if($(this).hasClass('clearGroup')){
            var arrgroupFilter=groupFilter.split(";");
            
            if(arrgroupFilter.length>1)
            {
                var idx=jQuery.inArray($(this).attr('id'),arrgroupFilter);
                //var idx=arrgroupFilter.indexOf($(this).attr('id'));
                arrgroupFilter.splice(idx,1);
                groupFilter=arrgroupFilter.join(";");
            }else if(arrgroupFilter.length==1)
            {
                groupFilter='All';
            }else{ }

            
        }else if($(this).hasClass('clearSubjects')){
            subjectFilter = 'All';
        }else if($(this).hasClass('clearFortwo')){
            fortwoFilter = 'All';
        }else if($(this).hasClass('clearForfour')){
            forfourFilter = 'All';
        }else if($(this).hasClass('clearForsix')){
            forsixFilter = 'All';
        }else if($(this).hasClass('clearTemporal')){
            temporal = 'All';
        }else if($(this).hasClass('clearTernRegion')){
            ternRegionFilter = 'All';
       }else if($(this).hasClass('clearSpatial')){
            n = '';
            e = '';
            w = '';
            s = '';
            spatial_included_ids = '';
        }
        changeHashTo(formatSearch(search_term,1,classFilter));
    });
        
        
    /*PAGINATION*/
    $('#next').live('click', function(){
        var current_page = parseInt(page);
        var next_page =  current_page + 1;
        changeHashTo(formatSearch(search_term, next_page, classFilter));
        page = next_page;
    });

    $('#prev').live('click', function(){
        var current_page = parseInt(page);
        var next_page =  current_page - 1;
        var term = '#'+search_term+'/p'+next_page;
        changeHashTo(formatSearch(search_term, next_page, classFilter));
        page = next_page;
    });

    $('.gotoPage').live('click', function(){
        var id = $(this).attr('id');
        var term = '#'+search_term+'/p'+id;
        changeHashTo(formatSearch(search_term, id, classFilter));
        page = id;
    });
        
    /*Change the Hash Value on the URL*/
    function changeHashTo(location){
        if(window.location.href.indexOf("view") || (window.location.href.indexOf("browse"))){
            window.location.href = base_url+location;
        }else {
            window.location.hash = location;
        }
    }
   
    /*Create Hash URL from search terms and filters*/
    function formatSearch(term, page, classFilter,numToDisplay){
        
        if(typeof numToDisplay === 'undefined')
        {
            numToDisplay=num;
        }
           
        if(term=='') term ='*:*';
        var res = 'search#!/q='+term+'/p='+page;
        res+='/tab='+classFilter;
        if(typeFilter!='All') res+='/type='+(typeFilter);
        if(groupFilter!='All') res+='/group='+(groupFilter);
        if(subjectFilter!='All') res+='/subject='+(subjectFilter);
        if(temporal!='All') res+='/temporal='+(temporal);
        if(fortwoFilter!='All') res+='/fortwo='+(fortwoFilter);
        if(forfourFilter!='All') res+='/forfour='+(forfourFilter);
        if(forsixFilter!='All') res+='/forsix='+(forsixFilter);
        if(ternRegionFilter!='All') res+='/ternRegion='+(ternRegionFilter);
        if(n!=''){
            res+='/n='+n+'/e='+e+'/s='+s+'/w='+w;
        }
        res+= '/num='+(numToDisplay); //local variable to pass in number of records
        
        
        //alert(res);
        return res;

    }
    
    /*      Show No Results on the result set div */
    function showNoResult(msg){
        if(msg == 1){
            $("#no-result div h3").html("No matching records were found");
        }
       
        $("#ui-layout-facetmap").hide();
        $("#head-toolbar").hide();
        $("#no-result").show();
        $("#search-result").html('');
        //sizeCenterPane();
        $('#no-result div').css({
              position: 'absolute',
              'left' : '50%',
              'margin-left': -($('#no-result div').outerWidth())/2,
              'top': '50%',
              'margin-top': -($('#no-result div').outerHeight())/2
        });
        $("#search-result").hide();
    }
    
    function hideNoResult(){
        $("#no-result").hide();
         $("#search-result").show();
         $("#ui-layout-facetmap").show();
         $("#head-toolbar").show();

    }
  
   
    /*      Populate Search fields
    *      
    *      
    */
    function populateSearchFields(temporalWidget, search_term){ 
        
        /* removed because adv is not used anymore Yi please delete when you're done
        if(adv == 1){
            if(param_q > -1 && search_term != '*:*') {
                var word = search_term.split(' ');

                $('input[name^="keyword"]').each(function(index){
                    $(this).val('');           
                });

                //getting operators
                var ors = [];
                $.each(word, function(index){
                    if(this.toString()=='OR' || this.toString() == "AND" || this.toString() == "-"){
                        if(ors.length < 2) ors.push(index);				
                    }
                });
                ors.push(word.length);
                var start = -1;
                $.each(ors,function(index,value){
                    if(value < word.length)  $('select[name^="operator"]').eq(index).val(word[value]);
                    var keywords = word.slice((start+1),value);
                    //fulltext:searchterm
                    $.each(keywords,function(i,v){
                        var fieldNterm = v.split(':');
                        //fulltext, searchterm
                        $.each(fieldNterm,function(fieldNtermIndex,fieldNtermValue){

                            if(this.toString()=='fulltext' || this.toString() == "displayTitle" || this.toString() == "description" || this.toString() == "subject"){ //not changed need to check
                            

                                $('select[name^="fields"]').eq(index).val(fieldNtermValue);
                            }else{
                                $('input[name^="keyword"]').eq(index).val(fieldNtermValue);
                            }                            
                        });
                    });
                    start = value;
                });
            }else{
               $("#accordion").accordion("activate",1);
            }
            
            var group;
            if(groupFilter !="All"){
                group = groupFilter.split(';');
                $.each(group,function(i,v){
                    $('input[id^="group"][value="' + urldecode(v) + '"]').attr('checked',true);
                });            
            }
 
            if(n!='') {
                populateCoordinates(n,w,s,e);
            } 

            if(forfourFilter != "All"){

                $('select[id="forfourFilter"]').val(urldecode(forfourFilter));
            }
            if(temporal!= 'All'){
                temporalWidget.doTemporalSearch = true;
                temporalWidget.refreshTemporalSearch();
            }
        }else{ // it's just basic search
        */
            if(param_q > -1 && search_term != '*:*' && search_term !="Search ecosystem data") {
               
                $('input[id="search-box"]').val(search_term);
            }
      
    }
   
   function initMap(){

        var mapWidget = new MapWidget('spatialmap',true);
        resetCoordinates();
        mapWidget.addDataLayer(true,"default",true);      

        mapWidget.addDrawLayer({
            geometry: "box", 
            allowMultiple: false, 
            afterDraw: updateCoordinates
        });

        enableToolbarClick(mapWidget);
      
        //changing coordinates on textbox should change the map appearance
        enableCoordsChange(mapWidget);  

        $("#latlong").bind('click',function() {
                $("#coords").toggle(); 
        });
        $("#mapHelpText").dialog({autoOpen:false});
         $("#mapViewSelector a").button();
          $("#mapHelp a").click(function(){
             $("#mapHelpText").dialog('open');
             return false;
         }).button();
        
        $("#mapViewSelector a").bind('click',function(element){
            mapWidget.setBaseLayer($(this).attr("id")); 
        });
        $("#map-toolbar .tooltip").tipsy();
        
        return mapWidget;
    }

     function initPlaceName(elementId,mapWidget){
         var placename = document.getElementById(elementId);
         var options = {
            componentRestrictions: {country: 'au'}
        };
        var autocomplete = new google.maps.places.Autocomplete(placename,options);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                var viewportPlace = place.geometry.viewport;
                var viewportSW = viewportPlace.getSouthWest();
                var viewportNE = viewportPlace.getNorthEast(); 
                var newBounds = new OpenLayers.Bounds(viewportSW.lng(), viewportSW.lat(), viewportNE.lng(), viewportNE.lat())
                newBounds.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));   
                mapWidget.map.zoomToExtent(newBounds);
            } else {
                var location = place.geometry.location;
                var lonlat = new OpenLayers.LonLat(location.lng(),location.lat());
                lonlat.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));
                mapWidget.map.setCenter(lonlat,11,false,false);
                
            }     
            });

     }
  
    /*      Initialization function for '/search' urls
    *      Called by ROUTING function
    *      Call widget objects 
    */   
      
    function initSearchPage(){
         /*       Resize Map callback */
        
        var resizeMap = function(){
             if(typeof mapResult !== 'undefined') mapResult.map.updateSize();
          }
        //setupOuterLayout();
        setupNestedLayout(resizeMap);  
                
         $("#facetH2").addClass("ui-state-disabled");
        var temporalWidget = new TemporalWidget();
        temporalWidget.temporal = temporal;
        temporalWidget.refreshTemporalSearch();
        enableToggleTemporal("#show-temporal-search",temporalWidget);   
        
        resetCoordinates();
         
        populateSearchFields(temporalWidget,search_term);
        
        if(param_q == -1){
             // show default facet here
             // don't show results
        }
      
        
        mapResult = initMap();
        initPlaceName('geocode',mapResult);
        
        $("input[value='Update']").bind('click',function(){
      //  var geometry = mapWidget.getFeatureCoordinates();
         //update spatial coordinates from textboxes
                var nl=document.getElementById("spatial-north");
                var sl=document.getElementById("spatial-south");
                var el=document.getElementById("spatial-east");
                var wl=document.getElementById("spatial-west");
                   
                n=nl.value;
                s=sl.value;
                e=el.value;
                w=wl.value;  
                changeHashTo(formatSearch(search_term, 1, classFilter));
               /* spatial_included_ids=''; 
                if(n!=''){
                      doSpatialSearch();
                }*/
          });
      
        //Reset Button 
        $('#search_reset').click(function(){
            resetAllFields(temporalWidget);
        }).button();
        
        // If user presses enter in the inputs, submit the form
        $('#search-panel input').keypress(function(e) {
            if(e.which == 13) {
             
                        $('#search_basic').trigger('click');
              
            }
        });
        
         autocomplete('#search-box');
         autocomplete('input[name^=keyword]');
         // please delete these  button click actions
         // when you're done Yi
        /*
        * Big search button
        */
        $('#search_basic').click(function(){
            resetAllSearchVals();
            search_term = $('#search-box').val();
          
            changeHashTo(formatSearch(search_term, 1, classFilter,num));
        }).button();     
        
        //Submit button 
       $("#search_advanced").click(function(){
        //Reset search term
       resetAllSearchVals();
            //check which panel is active 0 is basic, 1 is advanced
          //  if($( "#accordion" ).accordion( "option", "active" ) == 1 ){  // handle advanced search 
                
                //Advanced search widgets                 
                temporal = temporalWidget.getTemporalValues();
                               
                //update spatial coordinates from textboxes
                var nl=document.getElementById("spatial-north");
                var sl=document.getElementById("spatial-south");
                var el=document.getElementById("spatial-east");
                var wl=document.getElementById("spatial-west");
                   
                n=nl.value;
                s=sl.value;
                e=el.value;
                w=wl.value;  
                spatial_included_ids='';
                           
                //FOR filtering 
                if( document.getElementById("forfourFilter") != null && $('#forfourFilter').val()!='')  forfourFilter = $('#forfourFilter').val();
                //Group filtering
                if( document.getElementById("groupFilter") != null ) {
                    var first = true;
                    $('#groupFilter :checked').each(function(){
                        if(first) {
                            groupFilter = $(this).val();
                            first=false;
                        }
                        else groupFilter +=  ";" + $(this).val();
                    });                  
                }   
 	$("#fortree").treeview({ 
		persist: "location",
		collapsed: true,
		unique: true
	});               
/*                
                //Keywords 
                if( $('[name^=fields]').length>0){
                    first = true;
                    var field = '';
                    $("input[name^=keyword]").each(function(index){
                        if($.trim($(this).val())!='') {
                            switch($("[name^=fields]").get(index).value){
                                case 'displayTitle':

                                   // field = 'displayTitle';
                                    field = 'display_title';//added 8.1

                                    break;
                                case 'description':
                                    field = 'description_value';
                                    break;
                                case 'subject':

                                    //field = 'subject_value' ;
                                    field = 'subject_value_resolved' ;

                                    break;
                                default:
                                    field='fulltext';
                                    break;
                            }
                            if(first){
                                search_term = field;
                            }else{
                                if($("[name^=operator]").get(index-1) ){
                                    var operator = $("[name^=operator]").get(index-1).value;
                                    search_term += operator
                                    search_term += ' ';
                                }                            
                                search_term += field;
                            }
                            search_term += ':';
                            search_term += $.trim($(this).val()) + ' ';
                            first = false;                             
                        }
                    }
                    );
                    search_term = $.trim(search_term);
                               
                }
*/                
                page = 1;

           /* }else{
                resetAllSearchVals();
                search_term = $('#search-box').val();
             
            }   		
	    */

            changeHashTo(formatSearch(search_term, 1, classFilter));

            //  }
            
        }).button();    
        
         
           
    }
    
    function doSpatialSearch()
    {
	
        $.ajax({
                    type:"POST",
                    url: base_url+"/search/spatial/",
                    data:"north="+n+"&south="+s+"&east="+e+"&west="+w,

                    success:function(msg)
                    {
                        spatial_included_ids = msg;

                        doNormalSearch();
                        $("#loading").hide();
                    },
                    error:function(msg)
                    {
                        $("#loading").hide();
                    }
  		});
    }
        
    /* Reset all search values */
    function resetAllSearchVals(){
        search_term = '';
        page = 1;
        classFilter = 'collection';
        typeFilter = 'All';
        groupFilter = 'All';
        subjectFilter = 'All';
        fortwoFilter='All';
        forfourFilter='All';
        forsixFilter='All';
        resultSort = 'score desc';
        temporal = 'All';        
        n = '';
        e = '';
        s='';
        w='';
        spatial_included_ids='';        
    }
    /* Reset all fields in the search pane*/
    function resetAllFields(temporalWidget){
        $('[name^=fields]').val('');
        $('[name^=keyword]').val('');
        $('[name^=keyword]').val('');
        $('[name^=operator]').val('');
        $('#groupFilter :checked').each(function(){
            $(this).removeAttr('checked');
        }); 
        $('#forfourFilter').val('');
        temporalWidget.doTemporalSearch = false;
        temporalWidget.refreshTemporalSearch();
         
        if($('#spatial-north').val() != '') {
            $("#box").trigger('click');
            $('#coords').hide();
        }
        
    }
    
    function handleResults(msg,mapWidget){         
        var divs = $(msg).filter(function(){return $(this).is('div')});
        if($(msg).find('div#realNumFound').html() !== "0")
        {
            divs.each(function() {
                if($(this).attr('id') == 'facet-content')  {
                    $('#facet-accordion').html($(this).html());               
                }
                else if($(this).attr('id') == 'search-results-content' && mapSearch == 0) {        
                    $('#search-result').html($(this).html());
                }
                else if($(this).attr('id') == 'head-toolbar-content' && mapSearch == 0){
                    $('#head-toolbar').html($(this).html());
                }
            });         

              
            hideNoResult();
            $('#facetH2').removeClass('ui-state-disabled');  
           /* if(typeof mapWidget == 'undefined'){
                mapResult = new MapWidget('result-map',true);
                mapResult.addDataLayer(true,"default",true);
                mapWidget= mapResult;
            }*/
            $("#accordion").accordion("activate",2);
       
            if(typeof mapWidget !== 'undefined') {
                mapWidget.map.updateSize();
                mapWidget.removeAllFeatures();
                if(mapSearch == 0){
                  mapWidget.addVectortoDataLayer(".spatial_center",true);
                }
                mapWidget.deactivateAllControls();
            }
            $('.clearFilter').each(function(){
                $(this).append('<img class="clearFilterImg" src="'+base_url+'/img/delete.png"/>');
            });
            
            //record popup dialog
            $('#record-popup').dialog({

                autoOpen: false,
                height: 600,
                width: 980,
                resizable: true,            
                modal: true
            });

            $('.record-list').die('click').click( function(){     
                handleRecordPopup($(this));
            });

            $(".search_item p").each(function(index){
                if($(this).height() > 43){
                    $(this).css('height','43px').css('overflow','hidden');
                    var readMore = $("<span class='read-more'>Read more</span>");
                    $(this).parent().append(readMore);
                }else{
                    $(this).css('height','43px');
                }
            });
            $('.read-more').die('click').live("click",function() {
                if($(this).text() == 'Read more'){
                    $(this).siblings('p').css('height','auto');
                    $(this).text('Read less');
                }else{
                    $(this).siblings('p').css('height','43px'); 
                    $(this).text('Read more');
                }

                return false;
            });

            //LIMIT 5
            $("ul.more").each(function() {
                $("li:gt(5)", this).hide();
                $("li:nth-child(6)", this).after("<a href='#' class=\"more\">More...</a>");
            });
            $("a.more").live("click", function() {
                //console.log($(this).parent());
                $(this).parent().children().slideDown();
                $(this).remove();
                return false;
            });


            if($('#realNumFound').html() !='0'){//only update statistic when there is a result
                //update search statistics
                $.ajax({
                    type:"POST",
                    url: base_url+"/search/updateStatistic/",

                    data:"q="+search_term+"&classFilter="+classFilter+"&typeFilter="+typeFilter+"&groupFilter="+groupFilter+"&subjectFilter="+subjectFilter+"&page="+page+"&spatial_included_ids="+spatial_included_ids+"&temporal="+temporal+"&alltab=1" + "&ternRegionFilter=" + ternRegionFilter,
                    success:function(msg){},
                    error:function(msg){}
                });
            }
            $("#facet-region").accordion("destroy").accordion({
                header: 'h6', 
                autoHeight: false
            });
            /*$("#facet-accordion").accordion("destroy").accordion({
                header: 'h6', 
                autoHeight: false
            });*/
        }
        else{
            showNoResult(1); 
            $('#facetH2').addClass('ui-state-disabled'); 
           // sizeCenterPane();
        }
           
    } 
 
    function doNormalSearch(){        
        $.ajax({
            type:"POST",
            url: base_url+"/search/filter/",

//            data:"q="+search_term+"&classFilter="+classFilter+"&typeFilter="+typeFilter+"&groupFilter="+groupFilter+"&subjectFilter="+subjectFilter+"&fortwoFilter="+fortwoFilter+"&forfourFilter="+forfourFilter+"&forsixFilter="+forsixFilter+"&page="+page+"&spatial_included_ids="+spatial_included_ids+"&temporal="+temporal+"&alltab=1&sort="+ resultSort +"&adv="+adv + "&ternRegionFilter=" + ternRegionFilter,

            data:"q="+search_term+"&classFilter="+classFilter+"&typeFilter="+typeFilter+"&groupFilter="+groupFilter+"&subjectFilter="+subjectFilter+"&fortwoFilter="+fortwoFilter+"&forfourFilter="+forfourFilter+"&forsixFilter="+forsixFilter+"&page="+page+"&spatial_included_ids="+spatial_included_ids+"&temporal="+temporal+"&alltab=1&sort="+ resultSort + "&ternRegionFilter=" + ternRegionFilter+"&num="+num,

        
            success: function(msg,textStatus){
                handleResults(msg,mapResult);
                
$("tr[id=re-hide]").hide();

    $("table").click(function(event) {
        event.stopPropagation();
        var $target = $(event.target);
        if ( $target.closest("td").attr("id")=="desc" ) {
            $target.closest("tr").slideUp();

        } else if($target.closest("td").attr("id")!="metabutton") { 
            $target.closest("tr").next().slideToggle();           
        } else if ($target.attr("class")!="viewmeta")
        {
            $target.closest("tr").slideToggle();  
        }
    }); 
 
        $('.viewmeta').click(function(){
                var url=$(this).attr("id");
                handleViewMeta(url);

        }); 
    
                 $("#loading").hide();
                 
                 var opt=document.getElementById('viewrecord');
                 for(var i=0;i<opt.options.length;i++)
                 {
                     if(opt.options[i].text===num.toString())
                     {                         
                         opt.selectedIndex=i;
                         break;
                     }
                 }
             }
            ,
            error:function(msg){
                console.log('error');
                 $("#loading").hide();
            }
        });
    }
        

    /*

    * Execute the functions only available in home page
    */
    function initHomePage(){
        setupOuterLayout();

        $('.hp-icons img').hover(function(){
            id = $(this).attr('id');

            $('.hp-icon-content').hide();
            $('#hp-content-'+id).show();
            //console.log('#hp-content-'+id);
            $('.hp-icons img').removeClass('active');
            $(this).addClass('active');
        });
        $('#clearSearch').hide();

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
        
         /*
        * Big search button
        */
        $('#search-button').click(function(){
            page = 1;
            search_term = $('#search-box').val();

            if(search_term=='')search_term='*:*';
            
                  
           if(getCookie("selection")!=null)
           {
              num=getCookie("selection");

           }
            changeHashTo(formatSearch(search_term, 1, classFilter,num));

        });     
         
         /*
	 * On type, update the search term
	 * On Press Enter, change hash value and thus do search based on search term
	 * Initial search on collection
	 */
        $('#search-box').keypress(function(e){
            if(e.which==13){//press enter
                page = 1;
                resetFilter();
                search_term = $('#search-box').val();
                if(search_term=='')search_term='*:*';
                $('.ui-autocomplete').hide();
                changeHashTo(formatSearch(search_term, 1, classFilter));
            }
        });
        
        autocomplete('#search-box');
        
        $('.fl').live('click', function(event){
            var facname=$(this).attr("id");
            $('.flSelect').attr('class','fl');

            $(this).attr('class','flSelect');
            handleRandom(facname);    

         }); 
    
        handleRandom('tddp');
        sizeHomeContent();
    }

    function resetFilter(){
    subjectFilter = 'All';
    classFilter= 'collection';
    groupFilter= 'All';
}
        
    function initPreviewPage(){
    $("ul.sf-menu").superfish();
	       initConnectionsBox()		
	       initSubjectsSEEALSO()		
	        $('#view-in-orca').remove();		
			
	        $('.anzsrc-for, .anzsrc-seo, .anzsrc-toa').each(function(){		
	                var unresolved = $(this).attr('id');		
	                var subjectClass = $(this).attr('class');		
	                var item = $(this);		
	                //console.log(subjectClass);		
	                $.ajax({		
	                        type:"GET",		
	                        url: service_url+"?subject="+unresolved+"&vocab="+subjectClass,		
	                                success:function(msg){		
	                                        //console.log(msg);		
	                                        item.text(msg);		
	                                },		
	                                error:function(msg){}		
	                });		
	        });		
	        initViewMap('spatial_coverage_map','.spatial_coverage_center','.coverage');		
			
	   }		
	
      
    $('#viewrecord').live('change',function(){
     
     
     var selected=$(this).find(":selected").val();
     switch(selected)
     {
         case "10":
                 num=10;
                 setCookie('selection',10,365);
                 break;
         case "25":
                 num=25;
                 setCookie('selection',25,365);             
             break;
         case "50":
                 num=50;
                 setCookie('selection',50,365);             
             break;
         case "100":
                 num=100;
                 setCookie('selection',100,365);             
             break;
         default:
                 num=10;
                 setCookie('selection',10,365);
          
     }         
           
     doNormalSearch();   
     changeHashTo(formatSearch(search_term, 1, classFilter,num));    
     
 });
 
});
   


    function autocomplete(id){
       
    /*
    * Auto complete for main search boxtrus
    * Use getDictionaryTerms for search terms
    * Use getDictionaryTermsOLD for solr dictionary
    * */

    $( id ).autocomplete( {
            global: false,
            source: base_url+"view_part/getDictionaryTerms/",
            minLength: 2,
            delimiter:/(,|;)\s*/,
            select: function( event, ui ) {
                    $(id).val = ui.item.value;

            }
    })
   

}

    function handleViewMeta(link){           
            window.open(link,'_blank');
            window.focus();
     
} 

    function initConnectionsBox(){

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //NEW CONNECTIONS


    var key_value=$('#key').text();

    $.ajax({
        type:"POST",
        url: base_url+"search/connections/count",

        //data:"q=relatedObject_key:"+key_value+"&key="+key_value,
        data:"q=related_object_key:"+key_value+"&key="+key_value,

        success:function(msg){
            //alert(msg);
            $("#connections").html(msg);
            $('ul.connection_list li a').tipsy({
                live:true, 
                gravity:'s'
            });
            if(parseInt($('#connections-realnumfound').html())==0){
                $('#connectionsRightBox').hide();
            }

        },
        error:function(msg){}
    });
    var connectionsPage = 1;

    $('.connections_NumFound').live('click', function(){
        var types = $(this).attr("type_id");
        var classes = $(this).attr("class_id");
        if(!classes) var classes = 'party';

        $.ajax({
            type:"POST",
            url: base_url+"search/connections/content/"+classes+"/"+types,

            //data:"q=relatedObject_key:"+key_value+"&key="+key_value+"&page="+connectionsPage,
            data:"q=related_object_key:"+key_value+"&key="+key_value+"&page="+connectionsPage,

            success:function(msg){
                //console.log("success" + msg);
                $("#connectionsInfoBox").html(msg);

                $(".accordion-seealso").accordion({
                    autoHeight:false, 
                    collapsible:true,
                    active:false
                });
                $("#connectionsInfoBox").dialog({
                    modal: true,
                    minWidth:700,
                    position:'center',
                    draggable:'false',
                    resizable:false,
                    title:"Connections",
                    buttons: {
                        '<': function() {
                            if(connectionsPage > 1){
                                connectionsPage = connectionsPage - 1;
                                $('.accordion-seealso').html('Loading...');
                                getConnectionsAjax(classes,types, connectionsPage, key_value)
                            }
                        },
                        '>': function() {
                            if(connectionsPage < parseInt($('#connectionsTotalPage').html())){
                                connectionsPage = connectionsPage + 1;
                                $('.accordion-seealso').html('Loading...');
                                getConnectionsAjax(classes,types, connectionsPage, key_value)
                            }
                        }
                    },
                    open: function(){
                        $(".ui-dialog-buttonset").append("<span id='status'></span>");
                        setupConnectionsBtns();
                        return false;
                    }
                });

                return false;
            },
            error:function(msg){
            //console.log("error" + msg);
            }
        });
        return false;
    });
}
        
    function initSubjectsSEEALSO(){
    //SEE ALSO FOR SUBJECTS
    var group_value = encodeURIComponent($('#group_value').html());
    //console.log(group_value);
    var key_value = $('#key').html();
    var subjectSearchstr = '';
    $('.subjectFilter').each(function(){
        //console.log($(this).attr('id'));
        //subjectSearchstr += $(this).attr('id')+';';
        subjectSearchstr += $(this).html()+';';
    });
    
var arr=subjectSearchstr.split(";");
var tmp =arr.slice(0,11);
var t=removeBracket(tmp)

 subjectSearchstr=t.join(";");

    //subjectSearchstr = subjectSearchstr.substring(0,subjectSearchstr.length -1 );
  //  console.log(subjectSearchstr);
    subjectSearchstr = encodeURIComponent(subjectSearchstr);

    $.ajax({
        type:"POST",
        url: base_url+"search/seeAlso/count/subjects",
        data:"q=*:*&classFilter=collection&typeFilter=All&groupFilter=All&subjectFilter="+subjectSearchstr+"&page=1&spatial_included_ids=&temporal=All&excluded_key="+key_value,
        success:function(msg){
            $("#seeAlso").html(msg);
           // console.log(msg);
            if(parseInt($('#seealso-realnumfound').html())==0){
                $('#seeAlsoRightBox').hide();
            }
        },
        error:function(msg){
        //console.log("error" + msg);
        }
    });
    var seeAlsoPage = 1;
    $('#seeAlso_subjectNumFound').die('click').live('click', function(){
        $.ajax({
            type:"POST",
            url: base_url+"search/seeAlso/content/subjects",
            data:"q=*:*&classFilter=collection&typeFilter=All&groupFilter=All&subjectFilter="+subjectSearchstr+"&page="+seeAlsoPage+"&spatial_included_ids=&temporal=All&excluded_key="+key_value,
            success:function(msg){
                //console.log("success" + msg);
                $("#infoBox").html(msg);

                $(".accordion-seealso").accordion({
                    autoHeight:false, 
                    collapsible:true,
                    active:false
                });
                //var seeAlso_display = $('#seeAlsoCurrentPage').html() + '/'+$('#seeAlsoTotalPage').html();

                $("#infoBox").dialog({
                    modal: true,
                    minWidth:700,
                    position:'center',
                    draggable:false,
                    resizable:false,
                    title:"Suggested Links",
                    buttons: {
                        '<': function() {
                            if(seeAlsoPage > 1){
                                seeAlsoPage = seeAlsoPage - 1;
                                $('.accordion-seealso').html('Loading...');
                                getSeeAlsoAjax(group_value, subjectSearchstr, seeAlsoPage, key_value)
                            }
                        },
                        '>': function() {
                            if(seeAlsoPage < parseInt($('#seeAlsoTotalPage').html())){
                                seeAlsoPage = seeAlsoPage + 1;
                                $('.accordion-seealso').html('Loading...');
                                getSeeAlsoAjax(group_value, subjectSearchstr, seeAlsoPage, key_value)
                            }
                        }
                    },
                    open: function(){
                        $(".ui-dialog-buttonset").append("<span id='status'></span>");
                        setupSeealsoBtns();
                        return false;
                    }
                }).height('auto');

                //$('#infoBox').dialog().prepend('<div id="something-here" style="border:1px solid black;height:400px;width:400px;"></div>');
                //$('#infoBox').overlay();

                return false;
            },
            error:function(msg){
            //console.log("error" + msg);
            }
        });
        return false;
    });

}

    function getSeeAlsoAjax(group_value, subjectSearchstr, seeAlsoPage, key_value){
		 $.ajax({
             type:"POST",
             url: base_url+"search/seeAlso/content",data:"q=*:*&classFilter=collection&typeFilter=All&groupFilter=All&subjectFilter="+subjectSearchstr+"&page="+seeAlsoPage+"&spatial_included_ids=&temporal=All&excluded_key="+key_value,
                     success:function(msg){
                             $(".accordion-seealso").html(msg);
                             $(".accordion-seealso").accordion({autoHeight:false, collapsible:true,active:false});
                             setupSeealsoBtns();
                     },
                     error:function(msg){}
             });
	}

    function initIdentifiersSEEALSO(){
		var key_value=$('#key').text();
		//SEE ALSO FOR IDENTIFIERS
        var identifiers = [];
        $.each($('#identifiers p'), function(){//find in every identifiers
        	identifiers.push($(this).html());
        });

        $.each($('.descriptions p'), function(){//find in every descriptions that contains the identifier some where for NLA parties
        	if($(this).html().indexOf('nla.party-') > 0){
        		var foundit = $(this).html();
        		var words = foundit.split(' ');
        		$.each(words, function(i, word){
        			if(word.indexOf('nla.party-')>=0){
        				identifiers.push(word);
        			}
        		});
        	}
        });

        $.each($('.descriptions p'), function(){//find in every descriptions that contains the identifier some where NHMRC and ARC
        	if($(this).html().indexOf('http://purl.org/au') > 0){
        		var foundit = $(this).html();
        		var words = foundit.split(' ');
        		$.each(words, function(i, word){
        			if(word.indexOf('http://purl.org/au')>=0){
        				identifiers.push(word);
        			}
        		});
        	}
        });

        //console.log(identifiers);
        if (identifiers.length > 0){
	        var identifierSearchString = '+fulltext:(';
	        var first = true;
	        $(identifiers).each(function(){
	        	if(first){
	        		identifierSearchString +='"'+this+'"';
	        		first = false;
	        	}else{
	        		identifierSearchString += ' OR "'+this+'"';
	        	}
	        });
	        identifierSearchString +=')';
	        //console.log(identifierSearchString);
	        identifierSearchString = encodeURIComponent(identifierSearchString);

	        var relatedClass = $('#class').html();

	        $.ajax({
	            type:"POST",
	            url: base_url+"search/seeAlso/count/identifiers"+relatedClass,
	            data:"q=*:*&classFilter=party;activity&typeFilter=All&groupFilter=All&subjectFilter=All&page=1&spatial_included_ids=&temporal=All&excluded_key="+key_value+'&extended='+identifierSearchString,
	                    success:function(msg){
	                            $("#seeAlso-IdentifierBox").html(msg);
	                            if(parseInt($('#seealso-realnumfound').html())==0){
	                            	$('#seeAlso-Identifier').hide();
	                            }
	                    },
	                    error:function(msg){
	                            //console.log("error" + msg);
	                    }
	        });
	        var seeAlsoPage = 1;
	        $('#seeAlso_identifierNumFound').live('click', function(){
		        $.ajax({
	                type:"POST",
	                url: base_url+"search/seeAlso/content/identifiers",
	                data:"q=*:*&classFilter=party;activity&typeFilter=All&groupFilter=All&subjectFilter=All&page=1&spatial_included_ids=&temporal=All&excluded_key="+key_value+'&extended='+identifierSearchString,
	                    success:function(msg){
	                            $("#infoBox").html(msg);
	                            $(".accordion").accordion({autoHeight:false, collapsible:true,active:false});
	                            $("#infoBox").dialog({
	                                    modal: true, minWidth:700,maxHeight:300,draggable:false,resizable:false,
	                            		title:"Suggested Links",
	                                    buttons: {
	                                        '<': function() {
	                                                if(seeAlsoPage > 1){
	                                                        seeAlsoPage = seeAlsoPage - 1;
	                                                        $('.accordion-seealso').html('Loading...');
	                                                        getSeeAlsoAjax(group_value, subjectSearchstr, seeAlsoPage, key_value)
	                                                }
	                                        },
	                                        '>': function() {
	                                                if(seeAlsoPage < parseInt($('#seeAlsoTotalPage').html())){
	                                                        seeAlsoPage = seeAlsoPage + 1;
	                                                        $('.accordion-seealso').html('Loading...');
	                                                        getSeeAlsoAjax(group_value, subjectSearchstr, seeAlsoPage, key_value)
	                                                }
	                                        }
	                                    },
	                                    open: function(){
	                                        $(".ui-dialog-buttonset").append("<span id='status'></span>");
	                                        setupSeealsoBtns();
	                                    }
	                            }).height('auto');
	                    },
	                    error:function(msg){
	                            //console.log("error" + msg);
	                    }
		         });
	        });
        }else{
        	$('#seeAlso-Identifier').hide();
        }
	}

    function setupConnectionsBtns(){
		$(".accordion").accordion({autoHeight:false, collapsible:true,active:false});
		$('.button').button();
        $("#status").html($('#connectionsCurrentPage').html() + '/'+$('#connectionsTotalPage').html());
    }
    
    function initViewMap(mapId, centerSelector,coverageSelector){
    var mapView = new MapWidget(mapId,true);
     mapView.addDataLayer(false,"transparent");
     mapView.addVectortoDataLayer(centerSelector,false);
     mapView.addVectortoDataLayer(coverageSelector,false);
	}
   
    function handleRandom(facname)
    {
          $.ajax({
        type:"POST",
        url:base_url+"home/getrdmrecord?fac="+facname,
                    
                    
        success:function(msg){
          $("#random").html(msg);
          
         // if(facname=="tddp")
         // {
          // document.getElementById('tddp').attr('class','flSelect');

         //   $(this).attr('class','flSelect');
            
           //       handleRollover();
         // }

        },
        error:function(msg){
            console.log("error");
        }
        })
        
        
    }
 

 function getCookie(c_name)
 {
    var i,x,y,ARRcookies=document.cookie.split(";");
    for (i=0;i<ARRcookies.length;i++)
    {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
    
        if (x==c_name)
        {
            return unescape(y);
        }
    }
 }

function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    
    document.cookie=c_name + "=" + c_value;
}

 
/*    
    function handleRollover()
    {
      $("#scrollable").scrollable({circular: true}).autoscroll(2000);
			var api = $("#scrollable").data("scrollable");
			api.seekTo(0);
			api.onSeek(function() {
				var currentImageIndex = this.getIndex()+2;
				var prev = this.getIndex() + 1;
				var next = this.getIndex() + 3;
				currentKey = $("#items img:nth-child(" + currentImageIndex + ")").attr('alt');
				//$('#items img').removeClass('current-scroll');
				$("#items img:nth-child(" + currentImageIndex + ")").addClass('current-scroll');
				//currentDescription = $('div[name="'+currentKey+'"]').html();
				//$('#display-here').html(currentDescription);
				//$('#display-here a').tipsy({live:true, gravity:'w'});
			});
			$("#items img").click(function(){

                                // alert($(this).attr("id"));                                
                                window.open($(this).attr("id"));
                                window.focus();
			});

			$("#display-here").mouseenter(function() {
		  api.pause();
		}).mouseleave(function() {
		  api.play();
		});
    }

*/
