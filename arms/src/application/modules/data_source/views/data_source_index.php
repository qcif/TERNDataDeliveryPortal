<?php 

/**
 * Core Data Source Template File
 * 
 * 
 * @author Minh Duc Nguyen <minh.nguyen@ands.org.au>
 * @see ands/datasource/_data_source
 * @package ands/datasource
 * 
 */
?>
<?php $this->load->view('header');?>
<div class="container" id="main-content">
<section id="browse-datasources" class="hide">
	<div class="page-header">
        <h1><?php echo $title;?><small><?php echo $small_title;?></small></h1>
    </div>

    <!-- Toolbar -->
    <div class="row-fluid" id="mmr_toolbar">
    	<div class="span4">
    		<span class="dropdown" id="switch_menu">
    		<a class="btn dropdown-toggle" data-toggle="dropdown" data-target="#switch_menu" href="#switch_menu">Switch View <span class="caret"></span></a>
			  <ul class="dropdown-menu" id="switch_view">
			    <li><a href="javascript:;" name="thumbnails"><i class="icon-th"></i> Thumbnails View</a></li>
			    <li><a href="javascript:;" name="lists"><i class="icon-th-list"></i> List View</a></li>
			  </ul>
			</span>
		</div>
		<div class="span4"></div>
    	<div class="span4">
    		<select data-placeholder="Choose a Datasource to View" tabindex="1" class="chzn-select" id="datasource-chooser">
				<option value=""></option>
				<?php
					foreach($dataSources as $ds){
						echo '<option value="'.$ds['id'].'">'.$ds['title'].'</option>';
					}
				?>
			</select>
    	</div>
    </div>


    <!-- List of items will be displayed here, in this ul -->

	<ul class="thumbnails" id="items"></ul>


	<!-- Load More Link -->
	<div class="row-fluid">
		<div class="span12">
			<div class="well"><a href="javascript:;" id="load_more" page="1">Show More...</a></div>
		</div>
	</div>

</section>

<section id="view-datasource" class="hide">Loading...</section>
<section id="edit-datasource" class="hide">Loading...</section>

</div>
<!-- end of main content container -->

<section id="datasource-templates">
<!-- mustache template for list of items-->
<div class="hide" id="items-template">
	{{#items}}
		<li class="span3">
		  	<div class="item" data_source_id="{{id}}">
		  		<div class="item-info"></div>
		  		<div class="item-snippet">
			  		<h3>{{title}}</h3>
			  		{{#counts}}
				  		{{#status}}
				  			{{status}} : {{count}}
				  		{{/status}}
			  		{{/counts}}
			  	</div>
		  		<div class="btn-group item-control">
		  			<button class="btn view"><i class="icon-eye-open"></i></button>
			  		<button class="btn edit"><i class="icon-edit"></i></button>
			  		<button class="btn delete"><i class="icon-trash"></i></button>
				</div>
		  	</div>
		  </li>
	{{/items}}
</div>

<!-- mustache template for data source view single-->
<div class="hide" id="data-source-view-template">
<?php
	$data_source_view_fields = array(
		'key' => 'Key',
		'title' => 'Title',
		'record_owner' => 'Record Owner',
		'contact_name' => 'Contact Name',
		'contact_email' => 'Contact Email',
		'notes' => 'Notes',
		'created_when' => 'Created When',
		'created_who' => 'Created Who'
	);
?>

	{{#item}}
<div class="container">
<div class="row">

	
	<div class="span8">
		<div class="box">
		<div class="box-header">
	        <h1>{{title}}<small><a href="javascript:;" class="close return-to-browse">&times;</a></small></h1>
	    </div>
	    <div class="row-fluid">
	    	
	 		<div class="well">
				<div class="btn-group" data_source_id="{{data_source_id}}">
			  		<button class="btn edit"><i class="icon-edit"></i> Edit Data Source</button>
			  		<button class="btn history"><i class="icon-hdd"></i> View History</button>
			  		<button class="btn deleteRecord"><i class="icon-trash"></i> Delete Record</button>
				</div>
			</div>
	 
	    	

	    	<div class="">

			<h3>Account Administration Information</h3>
			<dl class="dl-horizontal">
				<?php 
				foreach($data_source_view_fields as $key=>$name){
					echo '{{#'.$key.'}}';
					echo '<dt>'.$name.'</dt>';
					echo '<dd>{{'.$key.'}}</dd>';
					echo '{{/'.$key.'}}';
				}
				?>
		 	</dl>
		 	<h3>Records Management Settings</h3>
		 	<dl class="dl-horizontal">
				<dt>Reverse Links</dt>
				<dd>1<br/>2</dd>

				{{#create_primary_relationships}}
				<dt>Create Primary Relationships</dt>
				<dd>{{create_primary_relationships}}</dd>
				{{/create_primary_relationships}}

				{{#push_to_nla}}
				<dt>Push To NLA</dt>
				<dd>{{push_to_nla}}</dd>
				{{/push_to_nla}}

				{{#auto_publish}}
				<dt>Auto Publish</dt>
				<dd>{{auto_publish}}</dd>
				{{/auto_publish}}

				{{#qa_flag}}
				<dt>Quality Assessment Required</dt>
				<dd>{{qa_flag}}</dd>
				{{/qa_flag}}

				{{#assessement_notification_email}}
				<dt>Assessment Notification Email</dt>
				<dd>{{assessement_notification_email}}</dd>
				{{/assessement_notification_email}}

		 	</dl>
		 	<h3>Harvester Settings</h3>
		 	<dl class="dl-horizontal">
		 		{{#uri}}
				<dt>URI</dt>
				<dd>{{uri}}</dd>
				{{/uri}}

				{{#provider_type}}
				<dt>Provider Type</dt>
				<dd>{{provider_type}}</dd>
				{{/provider_type}}

				{{#harvest_method}}
				<dt>Harvest Method</dt>
				<dd>{{harvest_method}}</dd>
				{{/harvest_method}}

				{{#harvest_date}}
				<dt>Harvest Date</dt>
				<dd>{{harvest_date}}</dd>
				{{/harvest_date}}

				{{#oai_set}}
				<dt>OAI-PMH Set</dt>
				<dd>{{oai_set}}</dd>
				{{/oai_set}}
		 	</dl>
		 	<h3>Activity Log</h3>
		 	<div class="well">Loading ...</div>
		 	</div>
	    </div>
		</div>
	</div>

	<div class="span4">
		<div class="box">
			<div class="box-header"><h3>Data Source Status Summary</h3></div>
			<div class="box-content">
				<ul class="ro-list">
					{{#statuscounts}}
				  		{{#status}}
				  			<li class="status_{{status}}">{{status}} : {{count}}</li>
				  		{{/status}}
			  		{{/statuscounts}}
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="box-header"><h3>Data Source Quality Summary</h3></div>
			<div class="box-content">
				<ul class="ro-list">
					{{#qlcounts}}
				  		{{#level}}
				  			<li class="ql_{{level}}">Quality Level {{level}} : {{count}}</li>
				  		{{/level}}
			  		{{/qlcounts}}
				</ul>
			</div>
		</div>
	</div>

</div>
</div>
	{{/item}}
</div>

<!-- mustache template for data source edit single-->
<div class="hide" id="data-source-edit-template">
{{#item}}
	<div class="box">
	<div class="box-header">
	    <h1>Edit: {{title}}<small><a href="javascript:;" class="close return-to-browse">&times;</a></small></h1>
	</div>
	<div class="">
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#admin" data-toggle="tab">Account Administration Information</a></li>
		  <li><a href="#records" data-toggle="tab">Records Management Settings</a></li>
		  <li><a href="#harvester" data-toggle="tab">Harvester Settings</a></li>
		</ul>

		<form class="form-horizontal" id="edit-form">
			<div class="tab-content">
				<div id="admin" class="tab-pane active">
					<fieldset>
						<legend>Account Administration Information</legend>
						<div class="control-group">
							<label class="control-label">Key</label>
							<div class="controls">
								{{key}}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="title">Title</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="title" value="{{title}}">
								<p class="help-inline"><small>Help</small></p>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="record_owner">Record Owner</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="record_owner" value="{{record_owner}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="contact_name">Contact Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="contact_name" value="{{contact_name}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="contact_email">Contact Email</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="contact_email" value="{{contact_email}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="notes">Notes</label>
							<div class="controls">
								<textarea class="input-xlarge" id="notes">{{notes}}</textarea>
							</div>
						</div>
						
					</fieldset>
				</div>
				<div id="records" class="tab-pane">
					<fieldset>
						<legend>Records Management Settings</legend>
						<div class="control-group">
							<label class="control-label">Reverse Links</label>
							<div class="controls">
								<p class="help-inline">
								<div class="normal-toggle-button">
    								<input type="checkbox" for="allow_reverse_internal_links">
								</div>
								<input type="text" class="input-small hide" id="allow_reverse_internal_links" value="{{allow_reverse_internal_links}}">
								<p class="help-inline">Allow reverse internal Links</p>
								</p>

								<p class="help-inline">
								<div class="normal-toggle-button">
    								<input type="checkbox" for="allow_reverse_external_links">
								</div>
								<input type="text" class="input-small hide" id="allow_reverse_external_links" value="{{allow_reverse_external_links}}">
								<p class="help-inline">Allow reverse external Links</p>
								</p>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Create Primary Relationships</label>
							<div class="controls">
								<p class="help-inline">
								<div class="normal-toggle-button">
    								<input type="checkbox" for="create_primary_relationships">
								</div>
								<input type="text" class="input-small hide" id="create_primary_relationships" value="{{create_primary_relationships}}">
								</p>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Party Records to NLA</label>
							<div class="controls">
								<p class="help-inline">
								<div class="normal-toggle-button">
    								<input type="checkbox" for="push_to_nla">
								</div>
								<input type="text" class="input-small hide" id="push_to_nla" value="{{push_to_nla}}">
								</p>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Auto Publish Records</label>
							<div class="controls">
								<p class="help-inline">
								<div class="normal-toggle-button">
    								<input type="checkbox" for="auto_publish">
								</div>
								<input type="text" class="input-small hide" id="auto_publish" value="{{auto_publish}}">
								</p>								
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Quality Assessment Required</label>
							<div class="controls">
								<p class="help-inline">
								<div class="normal-toggle-button">
    								<input type="checkbox" for="qa_flag">
								</div>
								<input type="text" class="input-small hide" id="qa_flag" value="{{qa_flag}}">
								</p>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="assessement_notification_email">Assessment Notification Email</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="assessement_notification_email" value="{{assessement_notification_email}}">
							</div>
						</div>
					</fieldset>
				</div>
				<div id="harvester" class="tab-pane">
					<fieldset>
						<legend>Harvester Settings</legend>
						<div class="control-group">
							<label class="control-label" for="uri">URI</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="uri" value="{{uri}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="provider_type">Provider Type</label>
							<div class="controls">
								<select data-placeholder="Choose a Provider Type" tabindex="1" class="chzn-select input-xlarge" for="provider_type">
									<option value=""></option>
									<option value="RIF">RIF</option>
									<option value="OAI_RIF">RIF OAI-PMH</option>
								</select>
								<input type="text" class="input-small hide" id="provider_type" value="{{provider_type}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="harvest_method">Harvest Method</label>
							<div class="controls">
								<select data-placeholder="Choose a Harvest Method" tabindex="1" class="chzn-select input-xlarge" for="harvest_method">
									<option value="DIRECT">DIRECT</option>
									<option value="GET">Harvester DIRECT</option>
									<option value="RIF">Harvester OAI-PMH</option>
								</select>
								<input type="text" class="input-small hide" id="harvest_method" value="{{harvest_method}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="oai_set">OAI Set</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="oai_set" value="{{oai_set}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="advanced_harvest_mode">Advanced Harvest Mode</label>
							<div class="controls">
								<select data-placeholder="Choose an Advanced Harvest Mode" tabindex="1" class="chzn-select input-xlarge" for="advanced_harvest_mode">
									<option value="STANDARD">Standard Mode</option>
									<option value="INCREMENTAL">Incremental Mode</option>
									<option value="REFRESH">Full Refresh Mode</option>
								</select>
								<input type="text" class="input-small hide" id="advanced_harvest_mode" value="{{advanced_harvest_mode}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="harvest_date">Harvest Date</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="harvest_date" value="{{harvest_date}}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="harvest_date">Harvest Frequency</label>
							<div class="controls">
								<select data-placeholder="Choose a Harvest Frequency" tabindex="1" class="chzn-select input-xlarge" for="harvest_method">
									<option value=""></option>
									<option value="daily">daily</option>
									<option value="weekly">weekly</option>
									<option value="fortnightly">fortnightly</option>
									<option value="monthly">monthly</option>
								</select>
								<input type="text" class="input-small hide" id="harvest_date" value="{{harvest_frequency}}">
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<button class="btn" id="save-edit-form" data-loading-text="Saving..." >Save</button>
			<div class="modal hide" id="myModal">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">×</button>
			    <h3>Alert</h3>
			  </div>
			  <div class="modal-body"></div>
			  <div class="modal-footer">
			    
			  </div>
			</div>
		</form>

		
	</div>
</div>
{{/item}}
</div>
</section>


<?php $this->load->view('footer');?>