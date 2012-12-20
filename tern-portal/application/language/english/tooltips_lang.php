<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
$lang['term_helptitle']="Advance boolean search help";
$lang['term_helptext']="<h2>Advance boolean search </h2><p>
                            Use AND, OR and NOT to refine your search results.
                        </p>
                        <p>
                            To narrow a search use the <b>AND</b> operator
                            e.g.  Vegetation AND Fire locates records that must include both terms.
                        </p>
                        <p>
                            To widen a search use the <b>OR</b> operator 
                            e.g. Vegetation OR Fire locates records that can either include the term Vegetation or the term Fire or both terms.
                        </p>
                        <p>
                            To remove terms from a search use the <b>NOT</b> operator 
                            e.g. Vegetation NOT Fire locates records that include the term vegetation but not any records that include the term Fire. 
                        </p>
                        <p>
                            Terms within quotes are treated as a phrase
                            e.g.”Kangaroo Island” AND Fire locates records that include the term fire within a record containing the phrase Kangaroo Island. 

                        </p>
                        <p>
                            To remove a search term, delete the term from the <i>Current Search</i> box.
                        </p>
                    ";


$lang['facility_helptitle']="Facility facet help";
$lang['facility_helptext'] ="<h2>Facility </h2><p>
                                Each TERN Facility works in one or more ecosystem science domains.   Use the checkboxes next to each Facility to restrict your search to records produced by that facility.  More than one facility may be selected.  The number next to each facility name represents the number of records available which match your search parameters. 
                             </p>
                             <p>
                                To remove a facility restriction, delete the parameter from the <i>Current Search</i> box.
                             </p>
                    ";

$lang['for_helptitle']="Field of Research help";
$lang['for_helptext'] ="<h2>Field of Research </h2><p>
                            Fields of Research (FoR) have been selected using the <a href=\"http://www.abs.gov.au/ausstats/abs@.nsf/mf/1297.0\">Australian and New Zealand Standard Research Classification (ANZSRC)</a>
                        </p>
                        <p>
                            Fields of Research (FoR) codes assigned to the current result set are displayed in a hierarchical tree structure.   Top level or primary fields are displayed initially, those with a secondary field change colour on hover.  Click on a primary field to display the secondary level fields.   
                        </p>
                        <p>
                            Use the checkboxes to limit your search to one or more FoRs, update the search using the Go button.  
                        </p>
                        <p>
                            The number next to each field relates to the number of matches within the displayed result set, records may have one or more FoR assigned.
                        </p>
                        <p>
                            To remove a FoR restriction, delete the parameter from the <i>Current Search</i> box.
                        </p>
                        
                    ";

$lang['region_helptitle']="Region  facet help";
$lang['region_helptext'] ="<h2>Region</h2><p>
                                Select a <b>Region Type</b> from the drop-down list to display region names.  Boundaries for the chosen type will appear on the map – the map is not interactive.  
                           </p>
                           <p>
                                Select a region name from the list displayed to restrict search results to those records with a spatial coverage intersecting with the selected region. The map displayed will load at the Australian continental scale with the selected region displayed as a grey boundary; pins will be visible for matching records in the result set
                           </p>
                           <p>
                               Only one region can be searched at any one time. Records without spatial coverage data will not be displayed in this result set.  
                           </p>
                           <p>
                                To remove a Region, delete the parameter from the <i>Current Search</i> box.                           
                           </p>
";

$lang['licensing_helptitle']="Attribution help";
$lang['licensing_helptext'] ="
<h2>Title</h2><p>
This is the title of the data set, data collection, paper or other item to be licensed.</p>
<h2>Attribute name</h2><p>
This may be the author(s), investigator(s) or organisation(s) who should receive attribution for the work.
</p>
<h2>URL</h2><p>
This creates a link to the item the subject of the licence. It may be a link to a document or to a website. 
</p>

";
?>

