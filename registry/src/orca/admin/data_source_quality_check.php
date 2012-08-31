<?php
/*
Copyright 2009 The Australian National University
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*******************************************************************************/
// Include required files and initialisation.
require '../../_includes/init.php';
require '../orca_init.php';
// Page processing
// -----------------------------------------------------------------------------


$dataSourceKey = getQueryValue('dataSourceKey');
$itemurl = getQueryValue('item-url');

if($dataSourceKey != '' && $itemurl != '')
<<<<<<< HEAD
<<<<<<< HEAD
{

	$transformResult = runQualityResultsforDataSource($dataSourceKey,$itemurl);
	print($transformResult);
=======
{	

	$transformResult = runQualityResultsforDataSource($dataSourceKey,$itemurl);
	print($transformResult);	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
{

	$transformResult = runQualityResultsforDataSource($dataSourceKey,$itemurl);
	print($transformResult);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}
else
{
// Execute the search.
$rawResults = getDataSources(null, null);
$searchResults = array();

// Check the record owners.
if( $rawResults )
{
	foreach( $rawResults as $dataSource )
	{
		if( (userIsDataSourceRecordOwner($dataSource['record_owner']) || userIsORCA_ADMIN()) )
		{
			$searchResults[count($searchResults)] = $dataSource;
			//echo count($searchResults)."<br />";
<<<<<<< HEAD
<<<<<<< HEAD
		}
=======
		}		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
}

// -----------------------------------------------------------------------------
// Begin the XHTML response. Any redirects must occur before this point.
<<<<<<< HEAD
<<<<<<< HEAD
importApplicationStylesheet(eAPP_ROOT.'orca/_styles/data_source_report.css');
=======
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
importApplicationStylesheet(eAPP_ROOT.'orca/_styles/data_source_report.css');
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
require '../../_includes/header.php';
// BEGIN: Page Content
// =============================================================================

if( !$searchResults )
{
	print("<p>No Data sources were returned.</p>\n");
}
else
{
?>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


<?php
//CHOSEN Javascript library for choosing data sources
echo '<link rel="stylesheet" href="'. eAPP_ROOT.'orca/_javascript/chosen/chosen.css" />
		<script src="'. eAPP_ROOT.'orca/_javascript/chosen/chosen.jquery.js" type="text/javascript"></script>';
?>
<<<<<<< HEAD
<script type="text/javascript" src="<?php print eAPP_ROOT ?>orca/_javascript/orca_dhtml.js"></script>



<h1>Data Source Quality Check</h1>
<p><a href="http://www.ands.org.au/partner/data-source-quality-check.html" target="_blank">About the Data Source Quality Check tool</a></p>
=======
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
<script type="text/javascript" src="<?php print eAPP_ROOT ?>orca/_javascript/orca_dhtml.js"></script>



<h1>Data Source Quality Check</h1>
<<<<<<< HEAD
<p><a href="http://www.ands.org.au/partner/data-source-quality-check.html">Limitations</a> of the Data Quality Check</p>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
<p><a href="http://www.ands.org.au/partner/data-source-quality-check.html" target="_blank">About the Data Source Quality Check tool</a></p>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
<h3>Data Sources</h3>
<div>
<select name="data_source_key" id="data_source_key">
<?php
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Present the results.
	for( $i=0; $i < count($searchResults); $i++ )
	{
		$dataSourceKey = $searchResults[$i]['data_source_key'];
		$dataSourceTitle = $searchResults[$i]['title'];
<<<<<<< HEAD
<<<<<<< HEAD
		print("<option value=\"".urlencode($dataSourceKey)."\">".esc($dataSourceTitle)."</option>\n");
=======
		$numRegistryObjects = getRegistryObjectCount($dataSourceKey);		
		print("<option value=\"".urlencode($dataSourceKey)."\">".esc($dataSourceTitle)."(".esc($numRegistryObjects).")</option>\n");
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		print("<option value=\"".urlencode($dataSourceKey)."\">".esc($dataSourceTitle)."</option>\n");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}

print("</select>\n");
}// end if search results
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
?>
<span id="printableReportContainer" class="right"></span>


<?php
<<<<<<< HEAD
print("<input type=\"button\" width=\"23px\" value=\"Check for Quality\" onclick=\"javascript:runQualityCheck();\">\n");
print("<input type=\"hidden\" id=\"quality_report_url\" value=\"".esc(eAPP_ROOT)."orca/admin/data_source_report.php?type=quality\"/>\n");
print("<div id=\"qualityCheckresult\">&nbsp;</div>\n");
print("</div>");


=======
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
print("<input type=\"button\" width=\"23px\" value=\"Check for Quality\" onclick=\"javascript:runQualityCheck();\">\n");
print("<input type=\"hidden\" id=\"quality_report_url\" value=\"".esc(eAPP_ROOT)."orca/admin/data_source_report.php?type=quality\"/>\n");
print("<div id=\"qualityCheckresult\">&nbsp;</div>\n");
print("</div>");

<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f



// =============================================================================
// END: Page Content
// Complete the XHTML response.
require '../../_includes/footer.php';
}
require '../../_includes/finish.php';
?>