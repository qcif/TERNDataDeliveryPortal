var num;
var resultSort;
 //capitalize first letter
  String.prototype.toProperCase = function () {
       return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
  };

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

    var temporal = 'All';        
    var n = '';
    var e = '';
    var s='';
    var w='';
    var mapResult;
    var param_q;
    var spatial_included_ids = '';

    var clearAll = 0; 
    
    // ROUTING 
    function routing(){
        if(window.location.href.indexOf('https://')==0){
            var thisurl = window.location.href;
            thisurl = thisurl.replace('https://','http://');
            window.location.href=thisurl;
        }
        if($("#page_name").text() == 'View') {
            initViewPage();
            initDataViewPage();

        }else if($("#page_name").text() == 'Search'){
            initSearchPage();   
        }else if($("#page_name").text() == 'Preview'){
            initPreviewPage();
        }else if($("#page_name").text() == 'Home'){
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
                case 'clearAll' :
                    clearAll = value;
            }
        });
        if(classFilter!=$('#classSelect').val()) {
            $('#classSelect').val(classFilter);
        }
    
         if(param_q > -1 || mapSearch==1){
                search_term = search_term.replace(/ or /g, " OR ");//uppercase the ORs
                search_term = search_term.replace(/ and /g, " AND ");//uppercase the ANDS
                
                checkCookie();
                // $("#loading").show();                             
                  
                if(window.location.href.indexOf('/n')>=0&&window.location.href.indexOf('/s')>=0&&window.location.href.indexOf('/w')>=0&&window.location.href.indexOf('/e')>=0)
                { 
                        
                        doSpatialSearch();
                }else{
                        if(mapSearch != 1 && clearAll != 1)$('#refineSearchBox h1.greenGradient').html('Refine Search'); else $('#refineSearchBox h1.greenGradient').html('Search');
                        
                        doNormalSearch();
                        //updateTable(); 
                }
         }
            
    });
   
    $(window).hashchange(); //do the hashchange on page load
    routing(); 
       
    $('.typeFilter, .groupFilter, .fortwoFilter, .forfourFilter, .forsixFilter, .ternRegionFilter').live('click', function(event){
        if(event.type=='click'){
            page = 1;
            mapSearch = 0;
            clearAll = 0;
            if($(this).hasClass('typeFilter')){
                typeFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));
            }else if($(this).hasClass('groupFilter')){
                //groupFilter = encodeURIComponent($(this).attr('id'));
                //changeHashTo(formatSearch(search_term, 1, classFilter));
            }else if($(this).hasClass('subjectFilter')){
                subjectFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));
                               
            }else if($(this).hasClass('fortwoFilter')){
                fortwoFilter = encodeURIComponent($(this).attr('id'));
                var len=$(this).parent().parent().children("ul").children("li").children("span").children("input").length;
                
                   if($(this).attr("checked")=="checked")
                   {
                        for(var j=0;j<len;j++)
                        {
                            $(this).parent().parent().children("ul").children("li").children("span").children("input")[j].checked=true;

                        }
                    }else
                    {
                        for(var j=0;j<len;j++)
                        {
                            $(this).parent().parent().children("ul").children("li").children("span").children("input")[j].checked=false;

                        }
                    }                

                //changeHashTo(formatSearch(search_term, 1, classFilter));               
                               
            }else if($(this).hasClass('forfourFilter'))
            {
                forfourFilter = encodeURIComponent($(this).attr('id'));
                if($(this).attr("checked")!="checked")
                {
                    $(this).parent().parent().parent().parent().children("span").children("input")[0].checked=false;
                }else
                {
                    var flag=true;
                    var arrli=$(this).parent().parent().parent().parent().children("ul").children("li");
                    
                    for(var s=0;s<arrli.length;s++)
                    {
                         if(arrli[s].children[0].children[0].checked!=true)
                         {
                              flag=false;
                         }                         
                    }
                    if(flag==true)
                        $(this).parent().parent().parent().parent().children("span").children("input")[0].checked=true;
                }
                
               // if(flag=="1")$(this).parent().parent().parent().parent().children("span").children("input").checked=true;
                
               // changeHashTo(formatSearch(search_term, 1, classFilter));               
                               
            }else if($(this).hasClass('forsixFilter')){
                forsixFilter = encodeURIComponent($(this).attr('id'));
                //changeHashTo(formatSearch(search_term, 1, classFilter));               
                               

            }else if($(this).hasClass('ternRegionFilter')){
                ternRegionFilter = encodeURIComponent($(this).attr('id'));
                changeHashTo(formatSearch(search_term, 1, classFilter));               
                               

            }         
            
        }
    }); 
    
var p=1;
        $('#myFav').click(function(){
          $.ajax({
                    type:"POST",
                    url: base_url+"search/mySavedRecords?page="+p,

                    success:function(msg)
                    {
                         $("#divFav").html(msg);
                         $("#divFav").dialog({
                            modal: true,
                            minWidth:400,
                            position:'center',
                            draggable:'false',
                            resizable:false,
                            title:"My Favourite Records (maximum 20)",

                            open: function(){
                            $(".ui-dialog-buttonset").append("<span id='status'></span>");

                            //setupCookiesBtns();
                            return false;
                            }
                    
                        });
                            
                     $('.removeCookie').on('click','a.remove', function(e){
                        
                            var r=this.parentNode.getAttribute('id');
                            var tmp=getCookie("SavedRecords");
                            var a=new Array;
                            
                            a=tmp.split("|");
                            a.splice($.inArray(r, a),1);
                            a.clean("");
                            var s=a.join("|");
                            setCookie("SavedRecords",s,365); 
                            
                            if($("#page_name").text()=='View')
                            {
                                checkRecordinCookie( $('#saveRecord'),$('#addToFavourite'),window.location.href+";"+$('#metadataTitle h1').text());
                            }
                            doAjaxFavCookie();  
                            
                            if($("#page_name").text()=='Search')
                            {
                                doNormalSearch();        
                            }
                            //updateTable();
                            
                        
                        });
                        
                         $('#clearFav').on('click', function(e){
                        
                            deleteCookie("SavedRecords");
                            
                            if($("#page_name").text()=='View')
                            {
                                checkRecordinCookie( $('#saveRecord'),$('#addToFavourite'),window.location.href+";"+$('#metadataTitle h1').text());
                            }
                            doAjaxFavCookie();  
                            
                            if($("#page_name").text()=='Search')
                            {
                                doNormalSearch();        
                            }
                         // updateTable();
                            
                        
                        });
                return false;
            },
            error:function(msg){ 
            //console.log("error" + msg);
            }
        });
        return false;
        });        
        
 $('#mySaved').click(function(){
          $.ajax({
                    type:"POST",
                    url: base_url+"search/mySavedSearches",

                    success:function(msg)
                    {
                      
                         $("#divSaved").html(msg);
                        
                         $("#divSaved").dialog({
                            modal: true,
                            minWidth:400,
                            position:'center',
                            draggable:'false',
                            resizable:false,
                            title:"My Saved Searches (maximum 20)",

                    open: function(){
                        $(".ui-dialog-buttonset").append("<span id='status'></span>");
                       
                        $('.removeCookie').on('click','a.remove', function(e){
                            var r=this.parentNode.getAttribute('id');
                            var tmp=getCookie("SavedSearch");
                            var a=new Array;
                            
                            a=tmp.split("|");
                            a.splice($.inArray(r, a),1);
                            a.clean("");
                            var s=a.join("|");
                            setCookie("SavedSearch",s,365); 
                            doAjaxSearchCookie();
                        
                        });
                        
                        $('#clearSearch').on('click', function(e){

                           deleteCookie("SavedSearch");
                            doAjaxSearchCookie();
                        
                        });
                        //setupCookiesBtns();
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
        if(clearAll != 0){
            res+='/clearAll=' + clearAll;
        }
        res+= '/num='+(numToDisplay); //local variable to pass in number of records
        
        return res;

    }
    
    /*      Show No Results on the result set div */
    function showNoResult(msg){
        $("#head-toolbar").hide();
        $("#middle-toolbar").hide();
        $("#bottom-toolbar").hide();
        $("#search-result").html('');
        $("#dialog-noresult").dialog();
        $("#search-result").hide();
    }
    
  
  
   
    /*      Populate Search fields
    *      
    *      
    */
    function populateSearchFields(temporalWidget, search_term){ 
        
            populateCoordinates(n,w,s,e);
            $("#coordsOverlay input").trigger('change');
            if(param_q > -1 && search_term != '*:*' && search_term !="Search ecosystem data") {
               
                //$('input[id="search-box"]').val(search_term);
               $('input[id="refineSearchTextField"]').val(search_term); 
            }
      
    }
   
   /* create map in search page
    */
   
   function initMap(){

        var mapWidget = new MapWidget('spatialmap',true);
        resetCoordinates();
        mapWidget.addDataLayer(true,"default",true);      // data layer is the metadata markers layer

        mapWidget.addDrawLayer({
            geometry: "box", 
            allowMultiple: false, 
            afterDraw: updateCoordinates
        });
        
        // load regions list for drop down 
        $.getJSON('/api/regions.json',function(data){
            $.each(data.layers,function(key,val){
                   var visibility = false;
                    mapWidget.addExtLayer({
                        url: val.geo_url,
                        protocol: "WMS",
                        geoLayer: val.geo_name,
                        layerName: val.l_id,
                        visibility: visibility
                    });
            }); 
            //functionality to click on the region to search
            mapWidget.registerClickRegions(data.layers,showInfo);     
        });
       
        enableToolbarClick(mapWidget);
        enableCoordsClick();
        //changing coordinates in textbox should change the map appearance
        enableCoordsChange(mapWidget);  
     
        //map help contents
        $("#map-help-text").dialog({autoOpen:false, height: 500});
        $("#map-help").click(function(){
             $("#map-help-text").dialog('open');
             return false;
         });
        
        //map change base layer type
        $("#map-view-selector a").bind('click',function(element){
            mapWidget.setBaseLayer($(this).attr("id")); 
        });
       
        // collapse the map
        $("#map-toolbar").on('click', "a.hide", function(){
            $("#spatialmap").hide();
            $(this).attr('class','show');
            $(this).html('Show');
            $("#map-toolbar li:not(.heading)").hide();
            $("#map-toolbar").css("height", "37px");
        });
         
         // show the map
        $("#map-toolbar").on("click", "a.show", function()
        {
            $("#spatialmap").show();            
            $(this).attr('class','hide');
            $(this).html('Hide');
            $("#map-toolbar li:not(.heading)").show();
            $("#map-toolbar").css("height", "67px");
        });
        
      
        return mapWidget;
    }

     // zoom to a typed place name functionality
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
       // setupNestedLayout(resizeMap);  

         $("#facetH2").addClass("ui-state-disabled");
        var temporalWidget = new TemporalWidget();
        temporalWidget.temporal = temporal;
        temporalWidget.refreshTemporalSearch();
        //enableToggleTemporal("#show-temporal-search",temporalWidget);   
        temporalWidget.doTemporalSearch=true;
        resetCoordinates();
         
        
        if(param_q == -1){
             // show default facet here
             // don't show results
        }
              
        mapResult = initMap();
        populateSearchFields(temporalWidget,search_term);
      
        initPlaceName('geocode',mapResult);
        
        $(".mapGoBtn").bind('click',function(){
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
                mapSearch = 0;
                clearAll = 0;                
                spatial_included_ids = '';
                $("#coordsOverlay").hide();
                 $("#coordsOverlay input").trigger('change');
                changeHashTo(formatSearch(search_term, 1, classFilter));             
          });
        
        
         $('#search-panel input').keypress(function(e) {
            if(e.which == 13) {
             
                        $('#refineSearchBtn').trigger('click');
              
            }
        });
  
        
       
        
         autocomplete('#refineSearchTextField');
         autocomplete('input[name^=keyword]');
      
    }
    
    //searches to SOLR using coordinates
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
                        //updateTable(); 
                       // $("#loading").hide();
                    },
                    error:function(msg)
                    {
                       // $("#loading").hide();
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
        mapSearch=0;
        spatial_included_ids='';        
    }
  
    // process and show metadata search results
    function handleResults(msg,mapWidget){    
        //console.log(msg);
        var divs = $(msg).filter(function(){return $(this).is('div')});
           $('#facetNav #currentSearchBox').remove();
            divs.each(function() {
                // copy facet boxes
                if($(this).attr('id') == 'facet-content')  {
                    if(mapSearch == 1 || clearAll == 1){
                         //$('#facet-accordion').html('');
                         $('#refineSearchBox .content ul').html('');
                        var thisdiv = $(this);
                        if(clearAll ==1 ){
                            var textbox = thisdiv.find("#refineSearchTextField").parent().clone();
                            textbox.appendTo("#refineSearchBox .content ul");
                        }
                        var facetdivs = thisdiv.find("#facet-region").parent().clone();

                        facetdivs.appendTo('#refineSearchBox .content ul'); 
                     
                    }else{
                        $('#refineSearchBox .content ul').html($(this).html());               
                    }
                   
                }
                else if($(this).attr('id') == 'currentSearchBox' &&  clearAll !=1 && mapSearch != 1 ){ // display current search box
                    $('#facetNav').prepend($("<p>").append($(this).clone()).html());
                }               
                else if($(this).attr('id') == 'head-toolbar-content' && mapSearch == 0 &&clearAll == 0){ // copy pagination bars 
                     
                        $('#middle-toolbar').html($(this).html());
                        $('#bottom-toolbar').html($(this).html());
                }
             
                if($(msg).find('div#realNumFound').html() !== "0")
                 {
                     if($(this).attr('id') == 'search-results-content' && mapSearch == 0  && clearAll == 0) { //display metadata table       
                        $('#search-result').html($(this).html());
                        $("#search-result").show();
                    }
                    
                    else if($(this).attr('id') == 'head-toolbar-content' && mapSearch == 0  && clearAll == 0){ // display toolbars if there are results
                     
                        $('#middle-toolbar').show();
                        $('#bottom-toolbar').show();
                        $(this).find('div#sorting_selection').empty();
                        
                    }
                    $('#facetNav #refineSearchBox').show();
                 }else{
                      $('#facetNav #refineSearchBox').hide();
                 }
            });     
            if(mapSearch == 1 || clearAll == 1){ 
                $("#search-result").hide();
                $('#head-toolbar').hide();
                $('#middle-toolbar').hide();
                $('#bottom-toolbar').hide();
                $('#del').trigger('click');
                
            }

            //background text
            $('#refineSearchTextField').each(function(){

                this.value = $(this).attr('title');
                $(this).addClass('text-background');

                $(this).focus(function(){
                        if($(this).val() == $(this).attr('title')){
                            $(this).val("");
                            $(this).removeAttr("placeholder");                    
                            $(this).removeClass('text-background');
                        } 
                });

                $(this).blur(function(){ 
                    if(this.value == '') {
                        this.value = $(this).attr('title');
                        $(this).addClass('text-background');
                        $(this).attr('placeholder',$(this).attr('title'));
                    }
                });
            });

            // if the map is initialised 
            if(typeof mapWidget !== 'undefined') {
                mapWidget.map.updateSize();
                mapWidget.removeAllFeatures();
                if(mapSearch == 0 && clearAll == 0 && $(msg).find('div#realNumFound').html() !== "0"){
                 if(ternRegionFilter != 'All'){
                      mapWidget.switchLayer('none'); //don't display regions overlay
                      mapWidget.setHighlightLayer(ternRegionFilter.split(":").pop(),{style_name: 'polygon'}); // if the user chose a region search, highlight the region on map 
                    
                  }
                  // display markers of metadata on map
                  mapWidget.addVectortoDataLayer(".spatial_center",true);
                 
                }
                mapWidget.deactivateAllControls();
            }         
 
           // enable removing a parameter
            $('.clearFilter').each(function(){
                       $(this).append('<a class="remove" />');
            });
             
                /*
                * Clearing filters/facets
                */
            $('.clearFilter').on('click','a', function(e){
                if($(this).parent().hasClass('clearType')){
                    typeFilter = 'All';
                }else if($(this).parent().hasClass('clearGroup')){
                    var arrgroupFilter=groupFilter.split(";");

                    if(arrgroupFilter.length>1)
                    {
                        var idx=jQuery.inArray($(this).parent().attr('id'),arrgroupFilter);
                        //var idx=arrgroupFilter.indexOf($(this).attr('id'));
                        arrgroupFilter.splice(idx,1);
                        groupFilter=arrgroupFilter.join(";");
                    }else if(arrgroupFilter.length==1)
                    {
                        groupFilter='All';
                    }
                }else if($(this).parent().hasClass('clearSubjects')){
                    subjectFilter = 'All';
                }else if($(this).parent().hasClass('clearFortwo')){
                    //fortwoFilter = 'All';
                    var arrtwo=fortwoFilter.split(";");
                    arrtwo=arrtwo.clean("");
                    if(arrtwo.length>1)
                    {
                        fortwoFilter=fortwoFilter+";";
                        fortwoFilter=fortwoFilter.replace($(this).parent().attr("id")+";","");
                    }else
                    {
                        fortwoFilter = 'All';
                    }

                }else if($(this).parent().hasClass('clearForfour')){
                    var arrfour=forfourFilter.split(";");
                    arrfour=arrfour.clean("");
                    if(arrfour.length>1)
                    {
                        forfourFilter=forfourFilter+";";
                        forfourFilter=forfourFilter.replace($(this).parent().attr("id")+";","");
                    }else
                    {
                        forfourFilter = 'All';
                    }
                    //forfourFilter = 'All';
                }else if($(this).parent().hasClass('clearForsix')){
                    forsixFilter = 'All';
                }else if($(this).parent().hasClass('clearTemporal')){
                    temporal = 'All';
                }else if($(this).parent().hasClass('clearTernRegion')){
                    ternRegionFilter = 'All';
                    mapResult.switchLayer('none');
            }else if($(this).parent().hasClass('clearSpatial')){
                    n = '';
                    e = '';
                    w = '';
                    s = '';
                    spatial_included_ids = '';
                    resetCoordinates(); 
                    $("#coordsOverlay input").trigger('change');
                }else if($(this).parent().hasClass('clearTerm'))
                {
                    //search_term=encodeURIComponent(search_term);;
                    if(search_term.search("AND")==-1 && search_term.search("NOT")==-1 && search_term.search("OR")==-1 )
                    {
                        search_term='*:*';    
                    }else
                    {
                        var str="";
                        if($.trim($(this).parent().attr('id')).search("AND")==-1 && $.trim($(this).parent().attr('id')).search("NOT")==-1 &&$.trim($(this).parent().attr('id')).search("OR")==-1)
                        {
                            var r=decodeURIComponent($.trim($(this).parent().attr('id'))); 
                            r=r.replace(/\(/g,"");
                            r=r.replace(/\)/g,"");
                            r=r.replace(/\+/g," ");
                            r=r.replace(/\\/g,"");
                            str=search_term.replace(r, "");     

                            str=str.replace(/\(/g,"");
                            str=str.replace(/\)/g,"");

                            if($.trim(str).substring(0, 2)=="AN" ||$.trim(str).substring(0, 2)=="NO")
                            {
                                str=$.trim(str).substring(4);
                            }
                            if($.trim(str).substring(0, 2)=="OR")
                            {
                                str=$.trim(str).substring(3);
                            }
                        }else
                        {
                            var s=decodeURIComponent($.trim($(this).parent().attr('id')));
                            s=s.replace(/\+/g," ");
                            s=s.replace(/\\/g,"");
                            s=s.replace(/\(/g,"");
                            s=s.replace(/\)/g,"");

                            if((s.split("\"").length-1)==1)
                            {
                                s=s.replace(/\"/g,"");                    
                            }
                            str=search_term.replace(s, ""); 

                            str=str.replace(/\(/g,"");
                            str=str.replace(/\)/g,"");
                        }         

                        search_term=$.trim(str)            
                    }

                }
                if($("#currentSearchBox .content ul li").length == 1) clearAll = 1;
                changeHashTo(formatSearch(search_term,1,classFilter));
            });

           $("#fortree").treeview({
		animated: "fast",
		collapsed: true,
		unique: false,
		//persist: "cookie",
		toggle: function() {
			//window.console && console.log("%o was toggled", this);
		}
            });
        

            $("#metadesc p").each(function(index){
                if($(this).height() > 48){
                    $(this).css('height','48px').css('overflow','hidden');
                    var readMore = $("<a class=\"read-more\" target=\"_blank\" href=\"" + $(this).closest("tr").find("#metabutton a.viewmeta").attr("href") + "\"> Read more</a>");
                    $(this).parent().append(readMore);
                }else{
                    $(this).css('height','48px');
                }
            });
             $('.read-more').on("click",function(event) {
                event.stopPropagation();
            });

            //LIMIT 5
            $("ul.more").each(function() {
                $("li:gt(4)", this).hide();
                $("li:nth-child(6)", this).after("<a href='#' class=\"more\">More...</a>");
            });
            $("a.more").click(function() {
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
           
            
        var temporalWidget = new TemporalWidget();
        temporalWidget.temporal = temporal;

        temporalWidget.doTemporalSearch=true;
        temporalWidget.refreshTemporalSearch();
 
 
        //search help contents
    
      $("#facet-help-text").dialog({autoOpen:false, height: 400, width: 500, zIndex: 3999});
          $("#facet-help").click(function(){
              $("#facet-help-text").html('');
              
              if($("#term-help-text").html()){
                 $("#facet-help-text").append($("#term-help-text").html());
              }
              if($("#region-help-text").html()){
                 $("#facet-help-text").append($("#region-help-text").html());
              }
               if($("#for-help-text").html()){
                  $("#facet-help-text").append($("#for-help-text").html());
              }
              if($("#facility-help-text").html()){
                 $("#facet-help-text").append($("#facility-help-text").html());
              }
              
              
             $("#facet-help-text").dialog('open');
             return false;
         });
         
       
        $.each($('#fortree span'), function(){
             var txt= $(this).html().toProperCase();
             $(this).html( txt);
        });
              
         // If user presses enter in the inputs, submit the form
        $('#refineSearchTextField').keypress(function(e) {
            if(e.which == 13) {             
                        $('#refineSearchBtn').trigger('click');
              
            }
        });
        
         autocomplete('#refineSearchTextField');
         
        $('#refineSearchBtn').click(function(){
            var special_char=/^[a-z0-9 ]+$/i;

            if(!special_char.test($('#refineSearchTextField').val()))
            {
                $("#dialog-searchterm"). dialog({
                    resizable: false,
                    height: 140,
                    modal: true,
                    buttons: {
                         "OK": function() { 
                                        if(search_term==""||search_term=="Search ecosystem data" ||search_term=="*:*")
                                        {
                                            search_term = "("+$('#refineSearchTextField').val()+")";       
                                        }else
                                        {
                                            var rb=document.getElementsByName('advancedBooleanSearch');
               
                                            for(var i=rb.length-1;i>-1;i--)
                                            {
                                                if(rb[i].checked && search_term!=$('#refineSearchTextField').val())
                                                    search_term="("+search_term+") "+rb[i].value+" "+$('#refineSearchTextField').val();
                                            }
               
                                        }
                                            mapSearch = 0;
                                            clearAll = 0;
                                            changeHashTo(formatSearch(encodeURIComponent(search_term), 1, classFilter,num));
                                            $( this ).dialog( "close" );

                          },
                          "Cancel": function(){
                                $( this ).dialog( "close" );
                          }
                    }
                });
            }else
            {
                if($('#refineSearchTextField').val()=="Search ecosystem data" ||$('#refineSearchTextField').val()==""||$('#refineSearchTextField').val()==null)
                {
                   $("#dialog-confirm-all"). dialog({
                        resizable: false,
                        height: 140,
                        modal: true,
                        buttons: {
                            "OK": function() { 
                                search_term='*:*';
                                checkCookie();
                                    $(this).dialog("close");
                                    mapSearch = 0;
                                    clearAll = 0;
                                    changeHashTo(formatSearch(search_term, 1, classFilter,num));  
                                    
                            },
                            "Cancel": function(){
                                    $( this ).dialog( "close" );
                            }
                        }
                    });
                }else
                {
                      if(search_term==""||search_term=="Search ecosystem data" ||search_term=="*:*")
                      {
                            search_term = "("+$('#refineSearchTextField').val()+")";       
                      }else
                      {
                            var rb=document.getElementsByName('advancedBooleanSearch');

                            for(var i=rb.length-1;i>-1;i--)
                            {
                                if(rb[i].checked && search_term!=$('#refineSearchTextField').val())
                                    search_term="("+search_term+") "+rb[i].value+" "+$('#refineSearchTextField').val();
                            }

                       }
                  mapSearch = 0;
                  clearAll = 0;
                  changeHashTo(formatSearch(encodeURIComponent(search_term), 1, classFilter,num));                         
                  }

            }


        });   
        
        $('#forbutton').click(function(){
            //FOR filtering 
                if( document.getElementById("fortree") != null)  
                {
                    var two_first = true;
                    var four_first = true;
                    $('#fortree :checked').each(function(){
                        if($(this).attr("class")=="fortwoFilter")
                        {
                            if(two_first) 
                            {
                                fortwoFilter = $(this).val();
                                two_first=false;
                            }
                            else fortwoFilter +=  ";" + $(this).val();
                        }else
                        {
                            if(four_first) 
                            {
                                forfourFilter = $(this).val();
                                four_first=false;
                            }
                            else forfourFilter +=  ";" + $(this).val();   
                        }

                    }); 
                }
            mapSearch = 0;  
            changeHashTo(formatSearch(search_term, 1, classFilter,num));

        }); 
        
        $('#facbutton').click(function(){           
              
                //Group filtering
                //if( document.getElementById("groupFilter") != null ) {
                    var first = true;
                    $('#group-facet :checked').each(function(){
                        if(first) {
                            groupFilter = $(this).val();
                            first=false;
                        }
                        else groupFilter +=  ";" + $(this).val();
                    });                  
                //}   
            mapSearch = 0;    
            changeHashTo(formatSearch(search_term, 1, classFilter,num));

        }); 
       
        $('#search_temp').click(function(){     
              temporal = temporalWidget.getTemporalValues();   
              mapSearch = 0;
            changeHashTo(formatSearch(search_term, 1, classFilter,num));

        });
       
     
        $("#region-select").change( function() {
            var regionid = $(this).val();
            $('#visible-region').html($('#' + regionid ).html());
            mapWidget.switchLayer(regionid, {turn_data_off : true});
        });
            
        /*   Uncomment for highlight region on hover on the regions list
         *
        $("#visible-region").on("mouseenter","a", function(){
                mapWidget.setHighlightLayer($(this).attr("id").split(":").pop(),'PolyHighlight');
       });
        $("#visible-region").on("mouseleave","a", function(){
                mapWidget.removeHighlightFeatures(); 
       });
       */
      
       if($(msg).find('div#realNumFound').html() == "0")
       {
                    showNoResult(1); 
       }
       $(".collapsiblePanel").on("click",".hide", function()
        {
            $(this).parent().next("div").slideToggle(300);
            $(this).attr('class','show')
        });
        $(".collapsiblePanel").on('click','.show',function()
        {
            $(this).parent().next("div").slideToggle(300);
            $(this).attr('class','hide')
        });
        
        
        if($("#fortree li").size()<1)
        {
            $("#forfacet").hide();
        }else
        {
              $("#forfacet").show();   
        }
        
        if($("#group-facet li").size()<1)
        {
            $("#facfacet").hide();
        }else
        {
              $("#facfacet").show();   
        } 
      

        $('.viewrecord').change(function(){

            var selected=$(this).find(":selected").val();
            var lbl=document.getElementById("showing");
            switch(selected)
            {
                case "10":
                        num=10;
                        lbl.innerHTML='10';
                        setCookie('selection',10,365);
                        break;
                case "25":
                        num=25;
                        lbl.innerHTML='25';
                        setCookie('selection',25,365);             
                    break;
                case "50":
                        num=50;
                        lbl.innerHTML='50';
                        setCookie('selection',50,365);             
                    break;
                case "100":
                        num=100;
                        lbl.innerHTML='100';
                        setCookie('selection',100,365);             
                    break;
                default:
                        num=10;
                        setCookie('selection',10,365);

            }         

            doNormalSearch();   
            changeHashTo(formatSearch(search_term, 1, classFilter,num));  
           // updateTable(); 

        });

        
         
            $('.sort_record').on('change',function(){

            // $("#loading").show();
            var selected=$(this).find(":selected").val();
            switch(selected)
            {
                case "score":
                        resultSort="score desc";
                        setCookie('sorting',resultSort,365);
                        break;
                case "date_modified":
                        resultSort="date_modified desc";
                        setCookie('sorting',resultSort,365);             
                    break;
                default:
                        resultSort="score desc";
                        setCookie('sorting',resultSort,365);

            }         

            doNormalSearch();  
            // $("#loading").hide();
            changeHashTo(formatSearch(search_term, 1, classFilter,num));    

        });

            $('.viewmeta').on('click',function(){
                $(this).data("clicked",true);
            });
            $('.tblFav').on('click',function(){
                     var tmp;
                     var arr_cookie=new Array;
                     //var t=this.parentNode.parentNode.parentNode.cells[1].firstChild.firstChild.innerHTML;
                     var t=$(this).closest("tr").find(".recordTitle").text();
                     //var url=this.parentNode.children[2].getAttribute('href');
                     var url=$(this).closest("tr").find(".viewmeta").attr("href");

                     $(this).data("clicked",true);
                     if(getCookie('SavedRecords')!=null)
                     {
                        tmp=getCookie('SavedRecords');
                        arr_cookie=tmp.split('|');
                        

                            if($.inArray(url+";"+t,arr_cookie)==-1 && arr_cookie.length<20)
                            {
                                arr_cookie.push(url+";"+t);  
                                
                                arr_cookie.clean("");
                                tmp=arr_cookie.join('|');
                                setCookie('SavedRecords',tmp,365);    
                                $(this).removeClass('orangeGradient').addClass('greyGradient');
                                $(this).addClass('disabled');
                                $(this).html("Saved");
                            }        
                            else if(arr_cookie.length>=20)
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
                            } else{}                  
                     }
                     else
                     {
                         arr_cookie.push(url+";"+t);
                         
                         arr_cookie.clean("");
                         tmp=arr_cookie.join('|');
                         setCookie('SavedRecords',tmp,365);    
                         $(this).removeClass('orangeGradient').addClass('greyGradient');
                         $(this).addClass('disabled');
                         $(this).html("Saved");
                     }
   


                     
                 });
                 
             $('#saveSearchBtn').click(function(){
                 $("#saveSearchPrompt"). dialog({
                    resizable: false,
                    height: 140,
                    modal: true,
                    buttons: {
                         "OK": function() { 
                             var t;
                             var ss_cookie=new Array;
                             if(getCookie('SavedSearch')!=null)
                             {
                                t=getCookie('SavedSearch');
                                ss_cookie=t.split('|');
                               
                               if(ss_cookie.length<20)
                               {
                                    if($.inArray(window.location.href+";"+$('#searchname').val(), ss_cookie)==-1)
                                    {
                                        ss_cookie.push(window.location.href+";"+$('#searchname').val());
                                        ss_cookie.clean("");
                                        t=ss_cookie.join('|');
                                        setCookie('SavedSearch',t,365);   
                                    }  
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
                                ss_cookie.push(window.location.href+";"+$('#searchname').val()); 
                                ss_cookie.clean("");
                                t=ss_cookie.join('|');
                                setCookie('SavedSearch',t,365);   
                             }                            
                             $( this ).dialog( "close" );
                          },
                          "Cancel": function(){
                                $( this ).dialog( "close" );
                          }
                    }
                });
             });    
        
    } 
 
    function doNormalSearch(){     
        $.ajax({
            type:"POST", 
            url: base_url+"/search/filter/",

//            data:"q="+search_term+"&classFilter="+classFilter+"&typeFilter="+typeFilter+"&groupFilter="+groupFilter+"&subjectFilter="+subjectFilter+"&fortwoFilter="+fortwoFilter+"&forfourFilter="+forfourFilter+"&forsixFilter="+forsixFilter+"&page="+page+"&spatial_included_ids="+spatial_included_ids+"&temporal="+temporal+"&alltab=1&sort="+ resultSort +"&adv="+adv + "&ternRegionFilter=" + ternRegionFilter,

            data:"q="+search_term+"&classFilter="+classFilter+"&typeFilter="+typeFilter+"&groupFilter="+groupFilter+"&subjectFilter="+subjectFilter+"&fortwoFilter="+fortwoFilter+"&forfourFilter="+forfourFilter+"&forsixFilter="+forsixFilter+"&page="+page+"&spatial_included_ids="+spatial_included_ids+"&temporal="+temporal+"&alltab=1&sort="+ resultSort + "&ternRegionFilter=" + ternRegionFilter+"&num="+num+"&mapsearch="+mapSearch,

        
            success: function(msg,textStatus){
                handleResults(msg,mapResult);
                
                 $('#clearSearchBtn').click(function()
                {
                     resetFilter();
                     clearAll = 1;
                    changeHashTo(formatSearch(search_term, 1, classFilter,num));
                    //$("#current-search").empty();
                  
                });                
                
                $("div[id=metadesc]").hide();
                $("div[id=metabutton]").hide();
                   $("#searchResults tr").click(function(event) {
                        event.stopPropagation(); 

                            if($("#metabutton a").not(".viewmeta"))
                            {                              
                            
                                $(this).find("#metabutton").toggle();
                                $(this).find("#metadesc").toggle();
                                if($(this).find(".actionsColumn .show").length > 0){
                                    $(this).find(".actionsColumn").children('a').attr("class","hide");                            
                                }
                                else if($(this).find(".actionsColumn .hide").length > 0){
                                    $(this).find(".actionsColumn").children('a').attr("class","show");                            
                                } 
                            }
                        

                    }); 
 
                 //updateTable();
                 
                 var opt=document.getElementsByName('select-view-record');
                 if(opt.length>0){
                     for(var s=0;s<opt.length;s++)
                     {
                        for(var i=0;i<opt[s].options.length;i++)
                        {
                            if(opt[s].options[i].text===num.toString())
                            {                         
                                opt[s].selectedIndex=i;
                                break;
                            }
                        }     
                     }

                 }
                 
                 //sorting
                 var sel_sort=document.getElementsByName('select-sorting');
                 if(sel_sort.length>0){
                     for(var s=0;s<sel_sort.length;s++)
                     {
                        for(var i=0;i<sel_sort[s].options.length;i++)
                        {
                            if(sel_sort[s].options[i].value===resultSort.split(" ")[0].toString())
                            {                         
                                sel_sort[s].selectedIndex=i;
                                break;
                            }
                        }     
                     }

                 }
                 
                 //$('div#middle-select-num')
                 
                 if (document.getElementById('group-facet')==null ||document.getElementById('group-facet').childNodes.length<1)
                     $("#fac-facet").hide();
                 
                 if (document.getElementById('fortree')==null ||document.getElementById('fortree').childNodes.length<1 )
                     $("#for-facet").hide();

             }
            ,
            error:function(msg){
                console.log(msg);
               //  $("#loading").hide();
            }
        });
    }
        

    /*

    * Execute the functions only available in home page
    */
    function initHomePage(){
  
        $('#clearSearch').hide();

        //background text
        $('#search-box').each(function(){

            this.value = $(this).attr('title');
            $(this).addClass('text-background');

            $(this).focus(function(){
                    if($(this).val() == $(this).attr('title')){
                        $(this).val("");
                        $(this).removeAttr("placeholder");                    
                        $(this).removeClass('text-background');
                    }
            });

            $(this).blur(function(){ 
                if(this.value == '') {
                    this.value = $(this).attr('title');
                    $(this).addClass('text-background');
                    $(this).attr('placeholder',$(this).attr('title'));
                }
            });
        });
        
         /*
        * Big search button
        */
        $('#searchBtn').click(function(){
            page = 1;
            search_term = $('#search-box').val();

             
             if(search_term==''||search_term=='Search ecosystem data')     
             {
                $("#dialog-confirm"). dialog({
                    resizable: false,
                    height: 140,
                    modal: true,
                    buttons: {
                         "OK": function() { 
                               search_term='*:*';
                               checkCookie();
                               
                                changeHashTo(formatSearch(search_term, 1, classFilter,num));  
                          },
                          "Cancel": function(){
                                $( this ).dialog( "close" );
                          }
                    }
                });
                        
             }else{
                 checkCookie();
                 changeHashTo(formatSearch(search_term, 1, classFilter,num));   
             }
           

        });     
         
         /*
	 * On type, update the search term
	 * On Press Enter, change hash value and thus do search based on search term
	 * Initial search on collection
	 */
        $('#search-box').keypress(function(e){
            if(e.which==13){//press enter
                page = 1;
                //resetFilter();
                search_term = $('#search-box').val();
                if(search_term=='')search_term='*:*';
                $('.ui-autocomplete').hide();
                changeHashTo(formatSearch(search_term, 1, classFilter));
            }
        });
        
        autocomplete('#search-box');
        $('#mapSearchBtn').on('click',function(){
            changeHashTo("search#!/mapSearch=1");
        });

       handleRandom('tddp');
       
        $("#carouselContainer").carousel('#carouselprev','#carouselnext'); 
        
        var intervalId=window.setInterval(slide,2000);
        $('#carouselprev, #carouselnext').click(
           function(event){
              if(event.originalEvent)
              {
                window.clearInterval(intervalId);
              }
           }
       );
        $("#carouselContainer img").click(function(){
               var facname=$(this).attr("id");
               handleRandom(facname);
 	});
        
    }

    function slide(){
        $('#carouselnext').click();
    }
    function resetFilter(){
        subjectFilter = 'All';
        classFilter= 'collection';
        groupFilter= 'All';
        fortwoFilter='All';
        forfourFilter='All';
        search_term='*:*';
        temporal='All';
        ternRegionFilter = 'All';

        n = '';
        e = '';
        s='';
        w='';
        spatial_included_ids = '';
        mapResult.switchLayer('none');
        resetCoordinates();        
        $("#coordsOverlay input").trigger('change');     
        page = 1;
        mapSearch=0;
        
    }
        
    function initPreviewPage(){
        initViewPage();
        initDataViewPage();

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
	        initViewMap('metadatamap','.spatial_coverage_center','.coverage');		
    }			
 

        function doAjaxFavCookie()
        {
                    $.ajax({
                            type:"POST",
                            url: base_url+"search/mySavedRecords?page="+1,

                            success:function(msg)
                            {
                                $("#divFav").html(msg);

                                $("#divFav").dialog({
                                    modal: true,
                                    minWidth:400,
                                    position:'center',
                                    draggable:'false',
                                    resizable:false,
                                    title:"My Favourite Records (maximum 20)",

                                    open: function(){
                                    $(".ui-dialog-buttonset").append("<span id='status'></span>");

                                    return false;
                                    }
                                });
                            $('.removeCookie').on('click','a.remove', function(e){
                                    var r=this.parentNode.getAttribute("id").value
                                    var tmp=getCookie("SavedRecords");
                                    var a=new Array;

                                    a=tmp.split("|");
                                    a.splice($.inArray(r, a),1);
                                    a.clean("");
                                    var s=a.join("|");
                                    setCookie("SavedRecords",s,365); 

                                    if($("#page_name").text()=='View')
                                    {
                                        checkRecordinCookie( $('#saveRecord'),$('#addToFavourite'),window.location.href+";"+$('#metadataTitle h1').text());
                                    }

                                    //updateTable();
                                    doAjaxFavCookie();
                                    //updateTable();

                                });

                                $('#clearFav').on('click', function(e){

                                    deleteCookie("SavedRecords");

                                    if($("#page_name").text()=='View')
                                    {
                                        checkRecordinCookie( $('#saveRecord'),$('#addToFavourite'),window.location.href+";"+$('#metadataTitle h1').text());
                                    }
                                    doAjaxFavCookie();  

                                    if($("#page_name").text()=='Search')
                                    {
                                        doNormalSearch();        
                                    }
                                    //updateTable();

                                });                        
                        return false;
                    },
                    error:function(msg){
                    console.log("error" + msg);
                    }
                });
                return false;
        }

        function doAjaxSearchCookie()
        {
                    $.ajax({
                            type:"POST",
                            url: base_url+"search/mySavedSearches",

                            success:function(msg)
                            {
                                $("#divSaved").html(msg);

                                $("#divSaved").dialog({
                                    modal: true,
                                    minWidth:400,
                                    position:'center',
                                    draggable:'false',
                                    resizable:false,
                                    title:"My Saved Searches",

                                    open: function(){
                                    $(".ui-dialog-buttonset").append("<span id='status'></span>");

                                    return false;
                                    }
                                });
                            $('.removeCookie').on('click','a.remove', function(e){
                                    var r=this.parentNode.getAttribute('id');
                                    var tmp=getCookie("SavedSearch");
                                    var a=new Array;

                                    a=tmp.split("|");
                                    a.splice($.inArray(r, a),1);
                                    a.clean("");
                                    var s=a.join("|");
                                    setCookie("SavedSearch",s,365); 
                                    doAjaxSearchCookie();


                                });
                                $('#clearSearch').on('click', function(e){

                                deleteCookie("SavedSearch");
                                    doAjaxSearchCookie();

                                });                        
                        return false;
                    },
                    error:function(msg){
                    console.log("error" + msg);
                    }
                });
                return false;
        }

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


function initConnectionsBox(){

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

    $('.connections_NumFound').on('click', function(){
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
        subjectSearchstr += $(this).attr('id')+';';
       
    });
    
    var arr=subjectSearchstr.split(";");
    var tmp =arr.slice(0,11);
    var t=removeBracket(tmp)

    subjectSearchstr=t.join(";");

    subjectSearchstr = encodeURIComponent(subjectSearchstr);

    $.ajax({
        type:"POST",
        url: base_url+"search/seeAlso/count/subjects",
        data:"q=*:*&classFilter=collection&typeFilter=All&groupFilter=All&subjectFilter="+subjectSearchstr+"&page=1&spatial_included_ids=&temporal=All&excluded_key="+key_value,
        success:function(msg){
            $("#seeAlso").html(msg);
           // console.log(msg);
            if(parseInt($('#seealso-realnumfound').html())==0){
                $('#seeAlsoRightBox').parent().hide();
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
                $.each($('.subjects li'), function(){
                    var txt= $(this).html().toProperCase();
                    $(this).html(txt);
                });
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
                    zIndex: 9999,
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
    
        function setupCookiesBtns(){
		$(".accordion").accordion({autoHeight:false, collapsible:true,active:false});
		$('.button').button();
        $("#status").html($('#cookiesCurrentPage').html() + '/'+$('#cookiesTotalPage').html());
    }
    
    function initViewMap(mapId, centerSelector,coverageSelector){
            var mapView = new MapWidget(mapId,true);
            mapView.addDataLayer(false,"transparent");
            mapView.addVectortoDataLayer(centerSelector,false);
            mapView.addVectortoDataLayer(coverageSelector,false);
   }
   

    function setupCookiesBtns(){
            $(".accordion").accordion({autoHeight:false, collapsible:true,active:false});
            $('.button').button();
    $("#status").html($('#cookiesCurrentPage').html() + '/'+$('#cookiesTotalPage').html());
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
        $("#homeContent").html(msg);


    },
    error:function(msg){
        //console.log("error");
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
    
    document.cookie=c_name + "=" + c_value+";path=/";
}

 
function checkCookie()
{
    
    if(getCookie("selection")!=null)
    {                   
        num=getCookie("selection");
    }else
    {
        num=10;
        setCookie("selection",10,365);      
    }

    if(getCookie("sorting")!=null)
    {
        resultSort=getCookie("sorting");
    }
    else
    {
        resultSort="score desc";
        setCookie("sorting",resultSort,365);
    } 
    
}



window.setInterval(function updateTable() 
{
        $("#searchResults tr").each(function(){
        if(this.parentElement.nodeName!="THEAD")
        { 
        checkRecordinCookie($(this).find(".tblsaveRecord"),
                          $(this).find(".tblFav"),
                            $(this).find(".viewmeta").attr("href")+";"+$(this).find(".recordTitle").text());         
        } 


    });
},5000)


function deleteCookie(c_name) {
    document.cookie = encodeURIComponent(c_name) + "=deleted; expires=" + new Date(0).toUTCString();
}
