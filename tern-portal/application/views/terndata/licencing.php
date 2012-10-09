    <?php
    ?>
    <?php $this->load->view('tpl/header');?>
<style type="text/css">
.option_list {
	list-style: none;
	display: table;
}
.option_list li {
	display: table-cell;
	width: 100px;
}
</style>
<h1> TERN Licence Selector</h1>
<p><em>Note: This tool only provides for licences under Australian law.</em></p>
<hr>
<div style="width: 800px; height:auto; overflow:auto;vertical-align:top;">
  <div style="width: 50%; float:left;" >
    <h2>Licence features</h2>
    <form id="selectionForm" name="selectionForm">
      <p><b>Allow modifications to your work?</b></p>
      <ul class="option_list">
        <li>
          <input type="radio" name="mods" id=
              "mods_true" value="true" checked="checked" data-dojo-props=
              "onClick:function(){toggleND(true)}" />
          <label for="mods_true">Yes</label>
        </li>
        <li>
          <input type="radio" name="mods" id=
              "mods_true_sa" value="true_sa" data-dojo-props=
              "onClick:function(){toggleND('true_sa')}" />
          <label for="mods_false">Yes, with share
            alike</label>
        </li>
        <li>
          <input type="radio" name="mods" id=
              "mods_false" value="false" data-dojo-props=
              "onClick:function(){toggleND(false)}" />
          <label for="mods_false">No</label>
        </li>
      </ul>
      <p><b>Does copyright apply to your work</b></p>
      <ul class="option_list">
        <li>
          <input type="radio" name="copy" id=
              "copy_true" value="true" data-dojo-props=
              "onClick:function(){toggleCopyright(true)}" />
          <label for="copy_true">Yes</label>
        </li>
        <li>
          <input type="radio" name="copy" id=
              "copy_false" value="false" data-dojo-props=
              "onClick:function(){toggleCopyright(false)}" />
          <label for=
              "copy_false">No</label>
        </li>
        <li>
          <input type="radio" name="copy" id=
              "copy_unsure" value="unsure" checked="checked" data-dojo-props=
              "onClick:function(){toggleCopyright(false)}" />
          <label for=
              "copy_unsure">Unsure</label>
        </li>
      </ul>
    </form>
    <hr>
    <h2>Attribution</h2>
    <p>You can add attribution information here:</p>
    <table>
      <tr>
        <th style="text-align: left"><label for="title">Title:</label></th>
        <td><input id="title" placeholder=
                "What is the title of the work?" size='40'/></td>
      </tr>
      <tr>
        <th style="text-align: left"><label for="creators">Creators:</label></th>
        <td><input id="creators" 
                placeHolder='Who created the work?' size='40'/></td>
      </tr>
      <tr>
        <th style="text-align: left"><label for="link">URL:</label></th>
        <td><input id="link" placeHolder='Where is the work available from?' size='40'/></td>
      </tr>
    </table>
    <p style="text-align: center;">
      <button id="attribution_button">
        	 Update </button>
    </p>
  </div>
  <div style=
    "width: 50%; float:right;">
    <h2>Selected licence</h2>
    <p><a id="licence-logo-link" href="http://tern.org.au/datalicence/TERN-BY/1.0/" target="_blank"><img id="licence-logo" height="60px" src="img/BY.png"/></a></p>
    <div id="licence-statement"></div>
    <br>
    <p style="text-align: left;">You can use this code in your webpage:</p>
    <textarea readonly id="licence-copy" style="width: 100%;" rows="6">
    	
    </textarea>
    <div id="licence-cca" style="text-align: left;">
      <hr/>
      <p>You may also wish to use a <a href="http://creativecommons.org.au" target="_blank">Creative Commons licence</a>. <!--The <a href="http://creativecommons.org/choose/" target="_blank">Creative Commons licence tool</a> may assist you.--></p>
    </div>
  </div>
</div>
<hr>
<script type="text/javascript">
    var licence_nc = false;
    var licence_sa = false;
    var licence_nd = false;
    var licence_copyright = false;

    
    function toggleND(value) {
        if (value === true) {
            licence_nd = false;
            licence_sa = false;
        } else if (value === 'true_sa') {
            licence_nd = false;
            licence_sa = true;
        } else {
            licence_nd = true;
            licence_sa = false;
        }
        prepareLicenceStatementAndIcon();
    }
    
    function toggleCopyright(value) {
        if (value === true) {
            //dojo.style($('#licence-cca'),"display", "block");
			$("#licence-cca").show();
            licence_copyright = true;
        } else {
            //$('#licence-cca').css("display","none");
			$("#licence-cca").hide();
            licence_copyright = false;
        }
    }
    
    function prepareLicenceStatementAndIcon() {
        var title = "This work";
        var creators = "";
		var link_work = "";
        var tern_licence = "TERN Attribution";
        var statement = "";
        var icon_file = "img/BY";
        var link = "";
        var licence_link = "http://tern.org.au/datalicence/TERN-BY";
        
        if ($('#title').val() !== '') {
            title = $("#title").val();
        }
        
        if ($('#creators').val() !== '') {
            creators = "by " + $("#creators").val();
        }
		
		if ($('#link').val() !== '') {
            title = "<a target='_blank' href='" + $("#link").val() + "'>" + title + "</a>";
        }
        
        if (licence_nd) {
            tern_licence = tern_licence + "-No Derivatives";
            link = link + "-ND";
        }
        
        if (licence_sa) {
            tern_licence = tern_licence + "-Share Alike";
            link = link + "-SA";
        }
        
        licence_link = licence_link + link + "/1.0/";
        statement = title + " " + creators + " is licensed under a <br/><a target='_blank' href='" + licence_link + "'>" + tern_licence + " licence</a>." ;
        $("#licence-statement").html(statement);
        
        icon_file = icon_file + link + ".png";
        $("#licence-logo").attr("src",icon_file);
        $("#licence-logo-link").attr("href", licence_link);
		
		$("#licence-copy").val("<a href='" + licence_link + "'>"
			+ "<img height='60px' src='" + icon_file + "'/></a><br>" 
			+ statement);
    }
    
    function resetForm() {
        $('#licence-cca').hide();
        prepareLicenceStatementAndIcon();
    }
  </script>
  <script type="text/javascript">
	$(document).ready(function(){
		$("#attribution_button").click(function(){prepareLicenceStatementAndIcon()});
		$("#mods_true").click(function(){toggleND(true)});
		$("#mods_true_sa").click(function(){toggleND('true_sa')});
		$("#mods_false").click(function(){toggleND(false)});
		$("#copy_true").click(function(){toggleCopyright(true)});
		$("#copy_false").click(function(){toggleCopyright(false)});
		$("#copy_unsure").click(function(){toggleCopyright(false)});
	});
</script>
<?php $this->load->view('tpl/footer');?>