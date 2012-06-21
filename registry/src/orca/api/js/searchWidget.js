function iecheck() {
  if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer" && window.attachEvent) {
    var rslt = navigator.appVersion.match(/MSIE (\d+\.\d+)/, '');
    var iever = (rslt != null && Number(rslt[1]) >= 5.5 && Number(rslt[1]) <= 7 );
  }
  return iever;
}


TERNData = new function() {
  var BASE_URL = 'http://demo/admin/orca/api/';
  var STYLESHEET = BASE_URL + "css/api.css"
  var CONTENT_URL = BASE_URL + 'js/list_result.js';
  var ROOT = 'tern_magic_data';
  var JQUERY_URL = BASE_URL + 'js/jquery.js';
  var _args={};


  function requestStylesheet(stylesheet_url) {
    stylesheet = document.createElement("link");
    stylesheet.rel = "stylesheet";
    stylesheet.type = "text/css";
    stylesheet.href = stylesheet_url;
    stylesheet.media = "all";
    document.lastChild.firstChild.appendChild(stylesheet);
  }

  function requestContent() {
   
    var script = document.createElement('script');
    script.src = CONTENT_URL;
    

    document.getElementsByTagName('head')[0].appendChild(script);
  }
  

	this.init = function(Args) {
           _args = Args;
           
           this.getTerm=function(){
               return _args;
           }
	  this.serverResponse = function(data) {
	   // if (!data) return;
	    var div = document.getElementById(ROOT);
	    var item = "";

            if(data.length>0)
            {
                for (var i = 0; i < data.length; i++) 
                {

                    item=item+"<li><a href=\""+data[i].link+"\">"+data[i].title+"</a></li>"
	      
                }
                div.innerHTML = "<h2 class=\"widgetHeader\">Records found in TERN Data Discovery Portal:</h2><ul> " +item+"</ul>";  // assign new HTML into #ROOT

            }else
            {
                div.innerHTML = "<h2 class=\"widgetHeader\">No matching records found in TERN Data Discovery Portal:<//h2>";  // assign new HTML into #ROOT  
            }
                div.style.display = 'block'; // make element visible
                div.style.visibility = 'visible'; // make element visible
	  }
	
	  requestStylesheet(STYLESHEET);
	  document.write("<div id='" + ROOT + "' style='display: none'></div>");
	  requestContent();
	  var no_script = document.getElementById('no_script');
	  if (no_script) {no_script.style.display = 'none';}
	}
}
