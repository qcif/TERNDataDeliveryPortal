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
<div id="staticContentWhite">
<h1>
TERN Data Licensing
</h1>
<p>TERN encourages the sharing of data and knowledge for the long-term benefit of the research community. Data sharing should only occur within a framework where data contributors receive appropriate recognition for their work, and where data users understand, in advance, the responsibilities placed upon them when they access and/or use another’s data.</p>
<p>For further details, please visit the <a href="http://www.tern.org.au/datalicence" target="_blank">TERN Data Licensing page</a> in the main TERN website.
<h2> TERN Licence Selector</h2>
<p><em>Note: This tool only provides for licences under Australian law.</em></p>
<hr>
<div style="width: 800px; height:auto; margin: 0 auto; vertical-align:top;">
  <div style="width: 390px; margin-right:10px; float:left;" >
    <h2>Licence features</h2>
    <form id="selectionForm" name="selectionForm">
      <p><b>Allow modifications to your work?</b></p>
      <ul class="option_list">
        <li>
          <input type="radio" name="mods" id=
              "mods_true" value="true" checked="checked" />
          <label for="mods_true">Yes</label>
        </li>
        <li>
          <input type="radio" name="mods" id=
              "mods_true_sa" value="true_sa" />
          <label for="mods_false">Yes, with share
            alike</label>
        </li>
        <li>
          <input type="radio" name="mods" id=
              "mods_false" value="false"  />
          <label for="mods_false">No</label>
        </li>
      </ul>
      <p><b>Does copyright apply to your work</b></p>
      <ul class="option_list">
        <li>
          <input type="radio" name="copy" id=
              "copy_true" value="true" />
          <label for="copy_true">Yes</label>
        </li>
        <li>
          <input type="radio" name="copy" id=
              "copy_false" value="false" />
          <label for=
              "copy_false">No</label>
        </li>
        <li>
          <input type="radio" name="copy" id=
              "copy_unsure" value="unsure" checked="checked"  />
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
      <button id="attribution_button"> Update </button>
    </p>
  </div>
  <div style=
    "width: 400px; float:right;">
    <h2>Selected licence</h2>
    <p><a id="licence-logo-link" href="http://tern.org.au/datalicence/TERN-BY/1.0/" target="_blank"><img id="licence-logo" height="60px" src="/img/licence/BY.png"/></a></p>
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
</div>
<?php $this->load->view('tpl/footer');?>
