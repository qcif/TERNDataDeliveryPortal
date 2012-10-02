
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
                
                if(getCookie("sorting")!=null)
                {
                    resultSort=getCookie("sorting");
                }

                if(window.location.href.indexOf('/n')>=0&&window.location.href.indexOf('/s')>=0&&window.location.href.indexOf('/w')>=0&&window.location.href.indexOf('/e')>=0)
                { 
                        
                        doSpatialSearch();
                }else{
                        if(mapSearch != 1)$('#facetH2 a').html('Refine Search'); else $('#facetH2 a').html('Search');
                        doNormalSearch();
                }
         }
            
    });
   
    $(window).hashchange(); //do the hashchange on page load
    routing(); 
       
    $('.typeFilter, .groupFilter, .subjectFilter,.fortwoFilter, .forfourFilter, .forsixFilter, .ternRegionFilter').live('click', function(event){
        if(event.type=='click'){
            page = 1;
            mapSearch = 0;
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
            //fortwoFilter = 'All';
            var arrtwo=fortwoFilter.split(";");
            arrtwo=arrtwo.clean("");
            if(arrtwo.length>1)
            {
                fortwoFilter=fortwoFilter+";";
                fortwoFilter=fortwoFilter.replace($(this).attr("id")+";","");
            }else
            {
                fortwoFilter = 'All';
            }
            
        }else if($(this).hasClass('clearForfour')){
            var arrfour=forfourFilter.split(";");
            arrfour=arrfour.clean("");
            if(arrfour.length>1)
            {
                forfourFilter=forfourFilter+";";
                forfourFilter=forfourFilter.replace($(this).attr("id")+";","");
            }else
            {
                forfourFilter = 'All';
            }
            //forfourFilter = 'All';
        }else if($(this).hasClass('clearForsix')){
            forsixFilter = 'All';
        }else if($(this).hasClass('clearTemporal')){
            temporal = 'All';
        }else if($(this).hasClass('clearTernRegion')){
            ternRegionFilter = 'All';
            mapResult.switchLayer('none');
       }else if($(this).hasClass('clearSpatial')){
            n = '';
            e = '';
            w = '';
            s = '';
            spatial_included_ids = '';
            resetCoordinates(); 
            $("#coords input").trigger('change');
        }else if($(this).hasClass('clearTerm'))
        {
            //search_term=encodeURIComponent(search_term);;
            if(search_term.search("AND")==-1 && search_term.search("NOT")==-1 && search_term.search("OR")==-1 )
            {
                search_term='*:*';    
            }else
            {
                var str="";
                if($.trim($(this).attr('id')).search("AND")==-1 && $.trim($(this).attr('id')).search("NOT")==-1 &&$.trim($(this).attr('id')).search("OR")==-1)
                {
                    var r=decodeURIComponent($.trim($(this).attr('id'))); 
                    r=r.replace(/\(/g,"");
                    r=r.replace(/\)/g,"");
                    r=r.replace(/\+/g," ");
                    r=r.replace(/\\/g,"");
                    str=search_term.replace(r, "");     

                    str=str.replace(/\(/g,"");
                    str=str.replace(/\)/g,"");
                    
                    if($.trim(str).substring(0, 2)=="AN" ||$.trim(str).substring(0, 2)=="NO")
                    {
                        str=str.substring(5);
                    }
                    if($.trim(str).substring(0, 2)=="OR")
                    {
                        str=str.substring(4);
                    }
                }else
                {
                    var s=decodeURIComponent($.trim($(this).attr('id')));
                    s=s.replace(/\+/g," ");
                    s=s.replace(/\\/g,"");
                    s=s.replace(/\(/g,"");
                    s=s.replace(/\)/g,"");
                    str=search_term.replace(s, ""); 
                }         

                  search_term=$.trim(str)
            }
            
        }
        if($("#current-search ul li").length == 1) mapSearch = 1;
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
        
            populateCoordinates(n,w,s,e);
            $("#coords input").trigger('change');
            if(param_q > -1 && search_term != '*:*' && search_term !="Search ecosystem data") {
               
                $('input[id="search-box"]').val(search_term);
            }
      
    }
   
   function initMap(){

        var mapWidget = new MapWidget('spatial-map',true);
        resetCoordinates();
        mapWidget.addDataLayer(true,"default",true);      

        mapWidget.addDrawLayer({
            geometry: "box", 
            allowMultiple: false, 
            afterDraw: updateCoordinates
        });
        
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
        });
             
        enableToolbarClick(mapWidget);
        enableCoordsClick();
        //changing coordinates on textbox should change the map appearance
        enableCoordsChange(mapWidget);  
     
         
        $("#map-help-text").dialog({autoOpen:false});
         $("#map-view-selector a").button();
          $("#map-help a").click(function(){
             $("#map-help-text").dialog('open');
             return false;
         }).button();
        
        $("#map-view-selector a").bind('click',function(element){
            mapWidget.setBaseLayer($(this).attr("id")); 
        });
        $("#map-toolbar .tooltip").tipsy({gravity: 'e'});
        
        $("#map-hide").bind('click', function(){
            $("#spatial-map").toggle(300);
        });
            
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
                mapSearch = 0;
                changeHashTo(formatSearch(search_term, 1, classFilter));             
          });
        


        //Reset Button 
        $('#search_reset').click(function(){
            resetAllFields(temporalWidget);
        }).button();
        

        
         $('#search-panel input').keypress(function(e) {
            if(e.which == 13) {
             
                        $('#search_basic').trigger('click');
              
            }
        });
        
         autocomplete('#search-box');
         autocomplete('input[name^=keyword]');
      
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
        mapSearch=0;
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
        //console.log(msg);
        var divs = $(msg).filter(function(){return $(this).is('div')});

            divs.each(function() {
                if($(this).attr('id') == 'facet-content')  {
                    $('#facet-accordion').html($(this).html());               
                }
                if($(msg).find('div#realNumFound').html() !== "0")
                 {
                     if($(this).attr('id') == 'search-results-content' && mapSearch == 0) {        
                        $('#search-result').html($(this).html());
                         $("#search-result").show();
                    }
                    else if($(this).attr('id') == 'head-toolbar-content' && mapSearch == 0){
                     
                        $('#middle-toolbar').html($(this).html());
                        $('#bottom-toolbar').html($(this).html());
                        $('#middle-toolbar').show();
                        $('#bottom-toolbar').show();
                        $(this).find('div#sorting_selection').empty();
                        
                        $('#head-toolbar').html($(this).html());
                        $('#head-toolbar').show(); 

                    }
                 }
            });     
            if(mapSearch == 1){
                $("#search-result").hide();
                $('#head-toolbar').hide();
                $('#middle-toolbar').hide();
                $('#bottom-toolbar').hide();
            }
 
            if(typeof mapWidget !== 'undefined') {
                mapWidget.map.updateSize();
                mapWidget.removeAllFeatures();
                if(mapSearch == 0 && $(msg).find('div#realNumFound').html() !== "0"){
                  mapWidget.addVectortoDataLayer(".spatial_center",true);
                  if(ternRegionFilter != 'All'){
                      mapWidget.setHighlightLayer(ternRegionFilter.split(":").pop());
                  }
                }
                mapWidget.deactivateAllControls();
            }
       
           
            $('.clearFilter').each(function(){
                $(this).append('<img class="clearFilterImg" src="'+base_url+'/img/delete.png"/>');
            });
            
           
            $("#fortree").treeview({
		animated: "fast",
		collapsed: true,
		unique: false,
		persist: "cookie",
		toggle: function() {
			//window.console && console.log("%o was toggled", this);
		}
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
                $("li:gt(4)", this).hide();
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
           
            
        var temporalWidget = new TemporalWidget();
        temporalWidget.temporal = temporal;

        //enableToggleTemporal("#show-temporal-search",temporalWidget);   
        temporalWidget.doTemporalSearch=true;
        temporalWidget.refreshTemporalSearch();
 
 //help contents
        //term
        $("#term-help-text").dialog({autoOpen:false});

          $("#term-help a").click(function(){
             $("#term-help-text").dialog('open');
             return false;
         }).button();
         
         //facility
        $("#facility-help-text").dialog({autoOpen:false});

          $("#facility-help a").click(function(){
             $("#facility-help-text").dialog('open');
             return false;
         }).button();         
         
         //for
        $("#for-help-text").dialog({autoOpen:false});

          $("#for-help a").click(function(){
             $("#for-help-text").dialog('open');
             return false;
         }).button();   
         //region
        $("#region-help-text").dialog({autoOpen:false});

          $("#region-help a").click(function(){
             $("#region-help-text").dialog('open');
             return false;
         }).button();          
//=========================         
        $('#adv_bool').click(function(){
             if(document.getElementById("adv_bool_operator").style.display=='none')
                document.getElementById("adv_bool_operator").style.display='block';
            else
                document.getElementById("adv_bool_operator").style.display='none';
        });
           // If user presses enter in the inputs, submit the form
        $('#search-box').keypress(function(e) {
            if(e.which == 13) {             
                        $('#search_basic').trigger('click');
              
            }
        });
        
         autocomplete('#search-box');
         
        $('#search_basic').click(function(){
            var special_char=/^[A-Za-z0-9 ]{3,20}$/;
            
            if(!special_char.test($('#search-box').val()))
            {
                $("#dialog-searchterm"). dialog({
                    resizable: false,
                    height: 140,
                    modal: true,
                    buttons: {
                         "OK": function() { 
                                        if(search_term==""||search_term=="Search ecosystem data" ||search_term=="*:*")
                                        {
                                            search_term = "("+$('#search-box').val()+")";       
                                        }else
                                        {
                                            var rb=document.getElementsByName('boolean_operator');
               
                                            for(var i=rb.length-1;i>-1;i--)
                                            {
                                                if(rb[i].checked && search_term!=$('#search-box').val())
                                                    search_term="("+search_term+") "+rb[i].value+" "+$('#search-box').val();
                                            }
               
                                        }
                                            mapSearch = 0;

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
                   if(search_term==""||search_term=="Search ecosystem data" ||search_term=="*:*")
                {
                    search_term = "("+$('#search-box').val()+")";       
                }else
                {
                    var rb=document.getElementsByName('boolean_operator');

                    for(var i=rb.length-1;i>-1;i--)
                    {
                        if(rb[i].checked && search_term!=$('#search-box').val())
                            search_term="("+search_term+") "+rb[i].value+" "+$('#search-box').val();
                    }

                }
                    mapSearch = 0;

               changeHashTo(formatSearch(encodeURIComponent(search_term), 1, classFilter,num));  
            }


        }).button();   
        
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
            mapWidget.switchLayer(regionid);
        });

        
           if($(msg).find('div#realNumFound').html() == "0")
             {
                    showNoResult(1); 
   
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
                 $('#clearall').click(function()
                {
                    resetFilter();
                    mapSearch=1;
                    changeHashTo(formatSearch(search_term, 1, classFilter,num));

                });                
                $("tr[id=re-hide]").hide();

                    $("#search-result table").click(function(event) {
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
                        for(var i=0;i<opt[s].options.length;i++)
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
               // console.log(msg);
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

           // if(search_term=='')search_term='*:*';
            
             if(search_term==''||search_term=='Search ecosystem data')     
             {
                $("#dialog-confirm"). dialog({
                    resizable: false,
                    height: 140,
                    modal: true,
                    buttons: {
                         "OK": function() { 
                               search_term='*:*';
                                if(getCookie("selection")!=null)
                                {
                                   num=getCookie("selection");
                                }
                                if(getCookie("sorting")!=null)
                                {
                                   resultSort=getCookie("sorting");
                                }
                                changeHashTo(formatSearch(search_term, 1, classFilter,num));  
                          },
                          "Cancel": function(){
                                $( this ).dialog( "close" );
                          }
                    }
                });
                        
             }else{
                  if(getCookie("selection")!=null)
                                {
                                        num=getCookie("selection");
                                }
                                if(getCookie("sorting")!=null)
                                {
                                        resultSort=getCookie("sorting");
                                }
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
        
        $('.fl').live('click', function(event){
            var facname=$(this).attr("id");
            $('.flSelect').attr('class','fl');

            $(this).attr('class','flSelect');
            handleRandom(facname);    

         }); 
    
   $('#map-search-button').live('click',function(){
       changeHashTo("search#!/mapSearch=1");
   });
       handleRandom();
       handleRollover();
        sizeHomeContent();
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
        $("#coords input").trigger('change');
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
 
     $('#sort_record').live('change',function(){
     
      $("#loading").show();
     var selected=$(this).find(":selected").val();
     switch(selected)
     {
         case "score":
                 resultSort="score desc";
                 setCookie('sorting',resultSort,365);
                 break;
         case "timestamp":
                 resultSort="timestamp desc";
                 setCookie('sorting',resultSort,365);             
             break;
         default:
                 resultSort="score desc";
                 setCookie('sorting',resultSort,365);
          
     }         
           
     doNormalSearch();  
      $("#loading").hide();
     changeHashTo(formatSearch(search_term, 1, classFilter,num));    
     
 });
 
});
   
function checkSelection()
{
    
}

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
    
    function initViewMap(mapId, centerSelector,coverageSelector){
    var mapView = new MapWidget(mapId,true);
     mapView.addDataLayer(false,"transparent");
     mapView.addVectortoDataLayer(centerSelector,false);
     mapView.addVectortoDataLayer(coverageSelector,false);
	}
   
    function handleRandom()
    {
          $.ajax({
        type:"POST",
        //url:base_url+"home/getrdmrecord?fac="+facname,
         url:base_url+"home/getrdmrecord",
                    
                    
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
    
    document.cookie=c_name + "=" + c_value;
}

 
    
    function handleRollover()
    {
      //$("#scrollable").scrollable({circular: true}).autoscroll(2000);
      $("#scrollable").scrollable({circular: true});
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


