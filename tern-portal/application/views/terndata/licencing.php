    <?php
    ?>
    <?php $this->load->view('tpl/header');?>
<head>
    <!-- Copyright (c) 2012, University of Queensland All rights reserved.
    Redistribution and use in source and binary forms, with or without modification,
    are permitted provided that the following conditions are met: Redistributions
    of source code must retain the above copyright notice, this list of conditions
    and the following disclaimer. Redistributions in binary form must reproduce
    the above copyright notice, this list of conditions and the following disclaimer
    in the documentation and/or other materials provided with the distribution.
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
    IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
    THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
    PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS
    BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
    CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
    GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
    HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
    LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
    OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
    SUCH DAMAGE. -->
    <link rel="stylesheet" href=
      "http://ajax.googleapis.com/ajax/libs/dojo/1.8/dijit/themes/claro/claro.css" media="screen"
      type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.8/dojo/dojo.js" data-dojo-config=
      "async: true, parseOnLoad: true" type="text/javascript">
    </script>
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
                dojo.style(dojo.byId('licence-cca'),"display", "block");
                licence_copyright = true;
            } else {
                dojo.style(dojo.byId('licence-cca'),"display","none");
                licence_copyright = false;
            }
        }
        
        function prepareLicenceStatementAndIcon() {
            var title = "This work";
            var creators = "";
            var link_work = "";
            var tern_licence = "TERN Attribution";
            var statement = "";
            var icon_file = "/img/licence/BY";
            var link = "";
            var licence_link = "http://tern.org.au/datalicence/TERN-BY";
            
            if (dojo.byId('title').value !== '') {
                title = dojo.byId('title').value;
            }
            
            if (dojo.byId('creators').value !== '') {
                creators = "by " + dojo.byId('creators').value;
            }
            
            if (dojo.byId('link').value !== '') {
                title = "<a target='_blank' href='" + dojo.byId('link').value + "'>" + title + "</a>";
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
            dojo.byId('licence-statement').innerHTML = statement;
            
            icon_file = icon_file + link + ".png";
            dojo.byId('licence-logo').src = icon_file;
            dojo.byId('licence-logo-link').href = licence_link;
            
            dojo.byId('licence-copy').value = "<a href='" + licence_link + "'>"
                + "<img height='60px' src='" + icon_file + "'/></a><br>" 
                + statement;
        }
        
        function resetForm() {
            dojo.style(dojo.byId('licence-cca'),"display","none");
            prepareLicenceStatementAndIcon();
        }
      </script>
    <script type="text/javascript">
            require(["dijit/form/Button", "dijit/form/TextBox","dijit/form/RadioButton", "dijit/form/Textarea",
                     "dijit/layout/TabContainer", "dijit/layout/ContentPane", "dijit/layout/BorderContainer",
                     "dojo/dom", "dojo/parser","dojo/domReady!"], function (dom) {
                            resetForm();
                            dojo.style(dojo.body(), "visibility", "visible");
                        });
      </script>
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
</head>
<body class="claro" style="visibility: hidden;">
    <div id="staticContentWhite">
        <h1 class="margin10">Data Licensing</h1>
        <p>TERN encourages the sharing of data and knowledge for the long-term benefit of the research community. Data sharing should only occur within a framework where data contributors receive appropriate recognition for their work, and where data users understand, in advance, the responsibilities placed upon them when they access and/or use another’s data.</p>
        
        <p>For further information, please visit the <a href="http://www.tern.org.au/datalicence" target="_blank">TERN Data Licensing</a> page.</p>
        
        <div data-dojo-type="dijit.layout.BorderContainer" data-dojo-props="design:'headline'" style=
      "width: 800px; height: 600px;">
      <div data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'top'">
        <h1>TERN Licence Selector</h1>
      </div>
      <div data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'center'">
        <div data-dojo-type="dijit.layout.TabContainer" style="width: 100%; height: 100%;">
          <div data-dojo-type="dijit.layout.ContentPane" style="width: 100%; height: 100%;" title="Licence Features">
            <form id="selectionForm" name="selectionForm">
              <p><b>Allow modifications to your work?</b></p>
              <ul class="option_list">
                <li>
                  <input type="radio" data-dojo-type="dijit.form.RadioButton" name="mods" id=
                  "mods_true" value="true" checked="checked" data-dojo-props=
                  "onClick:function(){toggleND(true)}" />
                  <label for="mods_true">Yes</label>
                </li>
                <li>
                  <input type="radio" data-dojo-type="dijit.form.RadioButton" name="mods" id=
                  "mods_true_sa" value="true_sa" data-dojo-props=
                  "onClick:function(){toggleND('true_sa')}" />
                  <label for="mods_false">Yes, with share
                    alike</label>
                </li>
                <li>
                  <input type="radio" data-dojo-type="dijit.form.RadioButton" name="mods" id=
                  "mods_false" value="false" data-dojo-props=
                  "onClick:function(){toggleND(false)}" />
                  <label for="mods_false">No</label>
                </li>
              </ul>
              <p><b>Does copyright apply to your work</b></p>
              <ul class="option_list">
                <li>
                  <input type="radio" data-dojo-type="dijit.form.RadioButton" name="copy" id=
                  "copy_true" value="true" data-dojo-props=
                  "onClick:function(){toggleCopyright(true)}" />
                  <label for="copy_true">Yes</label>
                </li>
                <li>
                  <input type="radio" data-dojo-type="dijit.form.RadioButton" name="copy" id=
                  "copy_false" value="false" data-dojo-props=
                  "onClick:function(){toggleCopyright(false)}" />
                  <label for=
                  "copy_false">No</label>
                </li>
                <li>
                  <input type="radio" data-dojo-type="dijit.form.RadioButton" name="copy" id=
                  "copy_unsure" value="unsure" checked="checked" data-dojo-props=
                  "onClick:function(){toggleCopyright(false)}" />
                  <label for=
                  "copy_unsure">Unsure</label>
                </li>
              </ul>
            </form>
          </div>
          <div data-dojo-type="dijit.layout.ContentPane" title="Attribution">
            <p>You can add attribution information here:</p>
            <table>
              <tr>
                <th style="text-align: left"><label for="title">Title:</label></th>
                <td><input id="title" data-dojo-type="dijit.form.TextBox" data-dojo-props=
                    "placeHolder:'What is the title of the work?'" /></td>
              </tr>
              <tr>
                <th style="text-align: left"><label for="creators">Creators:</label></th>
                <td><input id="creators" data-dojo-type="dijit.form.TextBox" data-dojo-props=
                    "placeHolder:'Who created the work?'" /></td>
              </tr>
              <tr>
                <th style="text-align: left"><label for="link">URL:</label></th>
                <td><input id="link" data-dojo-type="dijit.form.TextBox" data-dojo-props=
                    "placeHolder:'Where is the work available from?'" /></td>
              </tr>
            </table>
            <p style="text-align: center;">
              <button id="attribution_button" data-dojo-type="dijit.form.Button"
                 data-dojo-props="
                onClick:function(){ prepareLicenceStatementAndIcon(); }"> Update </button>
            </p>
          </div>
        </div>
      </div>
      <div data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'right'" style=
        "width: 50%; height: 100%; text-align: center;">
        <h2>Selected licence</h2>
        <p><a id="licence-logo-link" href="http://tern.org.au/datalicence/TERN-BY/1.0/" target="_blank"><img id="licence-logo" height="60px" src="img/BY.png"/></a></p>
        <div id="licence-statement"></div>
        <br>
        <p style="text-align: left;">You can use this code in your webpage:</p>
        <textarea data-dojo-type="dijit.form.Textarea" readonly id="licence-copy" style="width: 90%;">
            
        </textarea>
        <div id="licence-cca" style="text-align: left;">
          <hr/>
          <p>You may also wish to use a <a href="http://creativecommons.org.au" target="_blank">Creative Commons licence</a>. <!--The <a href="http://creativecommons.org/choose/" target="_blank">Creative Commons licence tool</a> may assist you.--></p>
        </div>
      </div>
      <div data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'bottom'"> <em>Note: This tool only provides for licences under Australian law.</em><br/>
        For further information regarding TERN's approach to data licensing, please visit the <a href="http://www.tern.org.au/datalicence" target="_blank">TERN Website</a> </div>
    </div>
    
</div>
<?php $this->load->view('tpl/footer');?>