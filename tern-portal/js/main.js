$(function() {
    // GLOBAL VARIABLES
    var hash = window.location.hash;
    var search_term = '';
    search_term = $('#search-box').val();
    var page = 1;
    var classFilter = $('#classSelect').val();
    var typeFilter = 'All';
    var groupFilter = 'All';
    var subjectFilter = 'All';
        
    var fortwoFilter='All';
    var forfourFilter='All';
    var forsixFilter='All';
    var resultSort = 'score desc';
    var temporal = 'All';        
    var n = '';
    var e = '';
    var s='';
    var w='';
        
        
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
        }else if(window.location.href==secure_base_url){
            window.location.href=base_url;
        }else if(window.location.href.indexOf('search')>=0){
            initSearchPage();
        }else if(window.location.href.indexOf('contact')>=0){
            initContactPage();
        }else if(window.location.href.indexOf('help')>=0){
            initHelpPage();
        }else if(window.location.href.indexOf('preview')>=0){
            initPreviewPage();
        }else if(window.location.href.indexOf('advancesrch')>=0){
            resetCoordinates();
            //loadDrawGoogleMap();  
            mapAdvanced = new MapWidget('openlayers-spatialmap');
            //add other protocols 
            mapAdvanced.addExtLayer({
                protocol: "WFS", 
                url: "supersites", 
                style: "default", 
                multiSelect: false, 
                afterSelect: updateCoordinates
            });
            mapAdvanced.addExtLayer({
                protocol: "WFS", 
                url: "aceas", 
                style: "red", 
                multiSelect: false, 
                afterSelect: updateCoordinates
            });
            // mapAdvanced.addExtLayer({protocol: "GEOJSON", url: "dummy", style: "red", multiSelect: false, afterSelect: updateCoordinates});
            //add box drawing
            mapAdvanced.addDrawLayer({
                geometry: "box", 
                allowMultiple: false, 
                afterDraw: updateCoordinates, 
                afterDrag: updateCoordinates
            });
            // enable clicking button controllers
            enableToolbarClick(mapAdvanced);
            // allow users to click "Show Coordinates" to expand div
            enableCoordsClick();
        }else {
            initHomePage();
        }
    }
    routing();    
    $(window).hashchange(function(){

        var hash = window.location.hash;
        var query = hash.substring(3, hash.length);
        var words = query.split('/');
        //clearFilter();
        $.each(words, function(){
            var string = this.split('=');
            var term = string[0];
            var value = string[1];
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
                    groupFilter=encodeURIComponent(decodeURIComponent(value));
                    break;
                case 'type':
                    typeFilter=encodeURIComponent(decodeURIComponent(value));
                    break;
                case 'subject':
                    subjectFilter=encodeURIComponent(decodeURIComponent(value));
                    break;
                case 'fortwo':
                    fortwoFilter=encodeURIComponent(decodeURIComponent(value));
                    break;
                case 'forfour':
                    forfourFilter=encodeURIComponent(decodeURIComponent(value));
                    break;
                case 'forsix':
                    forsixFilter=encodeURIComponent(decodeURIComponent(value));
                    break;
                case 'temporal':
                    temporal=value;
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
                case 'adv':
                    adv = value;
                    break;
            }
        });
        if(classFilter!=$('#classSelect').val()) {
            $('#classSelect').val(classFilter);
        }
        //console.log('term='+search_term+'page='+page+'tab='+classFilter);

        if(window.location.href.indexOf('search')>=0) {
            //console.log('yea');
          //  search_term = search_term.replace(/ or /g, " OR ");//uppercase the ORs
         //   search_term = search_term.replace(/ and /g, " AND ");//uppercase the ANDS
          //  doSearch();
        }
	
    });
    $(window).hashchange(); //do the hashchange on page load
        
        
    /*      Initialization function for '/search' urls
         *      Called by ROUTING function
         *      Call widget objects 
         */   
        
    function initSearchPage(){
        var temporalWidget = new TemporalWidget();
        temporalWidget.refreshTemporalSearch();
        enableToggleTemporal("#show-temporal-search",temporalWidget);        
    }
        
});