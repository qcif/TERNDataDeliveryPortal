<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>TERN Data Portal</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
        <link href="<?php echo base_url(); ?>css/mobile.css" type="text/css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
	
        <script type="text/javascript">
            $( '#page' ).live( 'pageinit',function(event){

                var $_GET = {};

                document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
                    function decode(s) {
                        return decodeURIComponent(s.split("+").join(" "));
                    }

                    $_GET[decode(arguments[1])] = decode(arguments[2]);
                });
                if($_GET['q']!=''){
                    $("#search-basic").val($_GET['q']);
                }
                $("#search").validate({
                    submitHandler: function(form) {
        
                        if ($('#search-basic').val() != ''){
                            form.submit();
                        }else{
                            alert('What are you looking for?');
                            return false;
                        }
                    }
                });
            });
        </script>
    </head>
    <body data-content-theme="d">

        <div data-role="page" id="page" data-theme="d" data-content-theme="d">
            <div class="clearfix" id="header" >


             <div id="logo"  >
                <a href="<?php echo base_url(); ?>m/"><img src="<?php echo site_url('img/logo.png'); ?>" width="100" id="tern-logo" alt="TERN Data Portal"/></a><br/>
                <h4>TERN Data Discovery Portal (Test Version)</h4>
            </div>

            <div  id="searchbox" data-theme="b"  data-role="header" >
                <form action="/m/search" id="search" method="get" >
                    <label for="search-basic" class="ui-hidden-accessible">Search Input:</label>
                    <input type="search" name="q" id="search-basic" value=""  placeholder="Search ecosystem data, researchers"   data-theme="c"  />
                    <input type="hidden" name="class" value="All"/>
                </form>
            </div>
            </div><!-- /content -->