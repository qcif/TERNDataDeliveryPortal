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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
require '../dois_orcainit.php';

$client = '';
$client_id = '';
$client_name = '';
$ip_address = '';
$client_contact_name = '';
$client_contact_email = '';
$client_domain_list = '';
<<<<<<< HEAD
=======
require '../../dois/dois_orcainit.php';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

// Page processing
// -----------------------------------------------------------------------------

$errorMessages = '';

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
$app_id = (isset($_GET['app_id']) ? $_GET['app_id'] : getPostedValue('app_id'));

if($app_id!=''){
	$action = 'Edit';
	
	$client = getDoisClient($app_id);
	$client_id = $client['client_id'];
	$client_name = $client['client_name'];
	$ip_address = $client['ip_address'];
	$client_contact_name = $client['client_contact_name'];
	$client_contact_email = $client['client_contact_email'];	
	
	$client_domains = getDoisClientDomains($client['client_id']);
	$client_domain_list = '';
	if($client_domains)
	{
		foreach($client_domains as $domain)
		{
			 $client_domain_list .= ",".$domain['client_domain'];
		}
	}
	$client_domain_list = trim($client_domain_list,",");
	$datacite_prefix = $client['datacite_prefix'];

}else{
	$action = 'Add';
}


if ( strtoupper(getPostedValue('verb')) == "ADD" || strtoupper(getPostedValue('verb')) == "EDIT")
<<<<<<< HEAD
{
	if(strtoupper(getPostedValue('verb')) == "ADD") $action = "Add";
	if(strtoupper(getPostedValue('verb')) == "EDIT") $action = "Edit";

	$client_name = getPostedValue('client_name');
	$ip_address = getPostedValue('ip_address');
	$client_contact_name = getPostedValue('client_contact_name');
	$client_contact_email = getPostedValue('client_contact_email');	
	$client_domain_list = getPostedValue('client_domain_list');
	$datacite_prefix = getPostedvalue('datacite_prefix');
	
=======
if ( strtoupper(getPostedValue('verb')) == "ADD" )
{
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
{
	if(strtoupper(getPostedValue('verb')) == "ADD") $action = "Add";
	if(strtoupper(getPostedValue('verb')) == "EDIT") $action = "Edit";

	$client_name = getPostedValue('client_name');
	$ip_address = getPostedValue('ip_address');
	$client_contact_name = getPostedValue('client_contact_name');
	$client_contact_email = getPostedValue('client_contact_email');	
	$client_domain_list = getPostedValue('client_domain_list');
	$datacite_prefix = getPostedvalue('datacite_prefix');
	
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( getPostedValue('client_name') == '' )
	{ 
		$errorMessages .= "Client name is a mandatory field.<br />";
		
	} 

	if( getPostedValue('ip_address') == '' )
	{ 
		$errorMessages .= "Client Ip is a mandatory field.<br />";
		
	}else{
		
		$iprange = explode(",",getPostedValue('ip_address'));

<<<<<<< HEAD
<<<<<<< HEAD
		if(isset($iprange[1]))
=======
		if($iprange[1])
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		if(isset($iprange[1]))
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		{
			if(!doisValidIp($iprange[0]))
			{
				$errorMessages .= "Client Ip ".$iprange[0]."is a not a valid ip address.<br />";
			}	
			if(!doisValidIp($iprange[1]))
			{
				$errorMessages .= "Client Ip ".$iprange[1]."is a not a valid ip address.<br />";			
			}		
		}
		else{
			if(!doisValidIp(getPostedValue('ip_address')))
			{
				$errorMessages .= "Client Ip is a not a valid ip address.<br />";
			}
		}
	} 

	
	if( trim(getPostedValue('client_contact_name')) == '' )
	{ 
		$errorMessages .= "Contact name is a mandatory field.<br />";
	}

	if( trim(getPostedValue('client_contact_email')) == '' )
	{ 
		$errorMessages .= "Contact email is a mandatory field.<br />";
	}else {
		if(!doisValidEmail(getPostedValue('client_contact_email')))
		{
			$errorMessages .= "Client email is a not a valid email address.<br />";
		}
		
	}
	
	
	if( trim(getPostedValue('client_domain_list')) == '' )
	{ 
		$errorMessages .= "Domain list is a mandatory field.<br />";
	}else{		
		$domains = explode(",",trim(getPostedValue('client_domain_list'),","));
		foreach($domains as $client_domain){
			if(trim($client_domain)){
				if(!doisValidDomain(trim($client_domain)))
				{
					$errorMessages .= "<em>".$client_domain."</em> in domain list is not a valid domain.<br />";	
				}
			}
		}

	}
	
	if( trim(getPostedValue('datacite_prefix')) == '' )
	{ 
		$errorMessages .= "You must select a DOI prefix.<br />";
	}
	
	if( trim(getPostedValue('app_id')) == '' )
	{ 
		$app_id = sha1(getPostedValue('ip_address').getPostedValue('client_name'));
	}
	elseif( strlen(getPostedValue('app_id')) != 0 && 
	    strlen(getPostedValue('app_id')) != 40 )
	{ 
		$errorMessages .= "Application Id should either be empty or a 40-character string.<br />";
	}else{
		$app_id = getPostedValue('app_id');
	}	
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( !$errorMessages )
	{
		//if no error message we want to add this client as a trusted client to mint dois
		//we need to insert them into the database
<<<<<<< HEAD
<<<<<<< HEAD
	
		if($action == "Add")
		{
			$client = addDoisClient(getPostedValue('client_name'),getPostedValue('client_contact_name'),getPostedValue('client_contact_email'),getPostedValue('ip_address'),getPostedValue('datacite_prefix'),$app_id);	
		}elseif($action == "Edit"){

			$client_id = getPostedValue('client_id');
			deleteClientDomainList($client_id);
			$client = updateDoisClient(getPostedValue('client_name'),getPostedValue('client_contact_name'),getPostedValue('client_contact_email'),getPostedValue('ip_address'),getPostedValue('datacite_prefix'),$app_id,$client_id);	
		}
	
		$client_info = getDoisClient($app_id);
		//We now need to insert the domains to be registered with this client into the db	
		$client_id = $client_info['client_id'];
=======
		$client = addDoisClient(getPostedValue('client_name'),getPostedValue('client_contact_name'),getPostedValue('client_contact_email'),getPostedValue('ip_address'),getPostedValue('datacite_prefix'),$app_id);	
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	
		if($action == "Add")
		{
			$client = addDoisClient(getPostedValue('client_name'),getPostedValue('client_contact_name'),getPostedValue('client_contact_email'),getPostedValue('ip_address'),getPostedValue('datacite_prefix'),$app_id);	
		}elseif($action == "Edit"){

			$client_id = getPostedValue('client_id');
			deleteClientDomainList($client_id);
			$client = updateDoisClient(getPostedValue('client_name'),getPostedValue('client_contact_name'),getPostedValue('client_contact_email'),getPostedValue('ip_address'),getPostedValue('datacite_prefix'),$app_id,$client_id);	
		}
	
		$client_info = getDoisClient($app_id);
		//We now need to insert the domains to be registered with this client into the db	
<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$client_id = $client_info['client_id'];
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		foreach($domains as $client_domain){
		
			if(trim($client_domain)!=''){
				addDoisClientDomain($client_id,trim($client_domain));
			}			
<<<<<<< HEAD
<<<<<<< HEAD

		}	
		//we now need to create/update this datacentre in datacite		

		if($client_id<10) $client_id = "-".$client_id;
		$datacite_symbol = gDOIS_DATACENTRE_NAME_PREFIX.".".gDOIS_DATACENTRE_NAME_MIDDLE.$client_id;
		$addToDataCite = doisAddDatacentre($datacite_symbol,getPostedValue('client_name'),getPostedValue('client_contact_name'),getPostedValue('client_contact_email'),getPostedValue('datacite_prefix'),$domains);
=======
			
		}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		}	
		//we now need to create/update this datacentre in datacite		

		if($client_id<10) $client_id = "-".$client_id;
		$datacite_symbol = gDOIS_DATACENTRE_NAME_PREFIX.".".gDOIS_DATACENTRE_NAME_MIDDLE.$client_id;
		$addToDataCite = doisAddDatacentre($datacite_symbol,getPostedValue('client_name'),getPostedValue('client_contact_name'),getPostedValue('client_contact_email'),getPostedValue('datacite_prefix'),$domains);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		responseRedirect('list_trusted_dois_client.php?newAppId='.$app_id);
	}
}

// -----------------------------------------------------------------------------
// Begin the XHTML response. Any redirects must occur before this point.
require '../../_includes/header.php';
// BEGIN: Page Content
// =============================================================================

<<<<<<< HEAD
<<<<<<< HEAD


=======
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
?>
<script type="text/javascript" src="<?php print eAPP_ROOT ?>orca/_javascript/orca_dhtml.js"></script>
<form id="add_trusted_dois_client" action="add_trusted_dois_client.php" method="post">
<table class="formTable" summary="List Trusted PIDS Clients">
	<thead>
		<tr>
			<td>&nbsp;</td>
<<<<<<< HEAD
<<<<<<< HEAD
			<td><?php echo $action;?> Trusted DOI Client</td>
=======
			<td>Add Trusted DOI Client</td>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			<td><?php echo $action;?> Trusted DOI Client</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		</tr>
	</thead>	
	<?php if( $errorMessages ) { ?>
	<tbody>
		<tr>
			<td></td>
			<td class="errorText"><?php print($errorMessages); ?></td>
		</tr>
	</tbody>
	<?php } ?>
	<tbody class="formFields">
			<tr>
			<td>* Name:</td>
<<<<<<< HEAD
<<<<<<< HEAD
			<td><input type="text" name="client_name" id="client_name" size="40" maxlength="64" value="<?php printSafe($client_name) ?>" /> 
=======
			<td><input type="text" name="client_name" id="client_name" size="40" maxlength="64" value="<?php printSafe(getPostedValue('client_name')) ?>" /> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			<td><input type="text" name="client_name" id="client_name" size="40" maxlength="64" value="<?php printSafe($client_name) ?>" /> 
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			    
			</td>
		</tr>
		<tr>
			<td>* IP Address:</td>
<<<<<<< HEAD
<<<<<<< HEAD
			<td><input type="text" name="ip_address" id="ip_address" size="40" maxlength="64" value="<?php printSafe($ip_address) ?>" /> 
=======
			<td><input type="text" name="ip_address" id="ip_address" size="40" maxlength="64" value="<?php printSafe(getPostedValue('ip_address')) ?>" /> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			<td><input type="text" name="ip_address" id="ip_address" size="40" maxlength="64" value="<?php printSafe($ip_address) ?>" /> 
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			    <span class="formNotes">(To supply a range of IP addesses, separate the 2 addresses with a comma)</span>
			</td>
		</tr>
		<tr>
			<td>* Contact Name:</td>
<<<<<<< HEAD
<<<<<<< HEAD
			<td><input type="text" name="client_contact_name" id="client_contact_name" size="40" maxlength="255" value="<?php printSafe($client_contact_name) ?>" /></td>
		</tr>
		<tr>
			<td>* Contact Email:</td>
			<td><input type="text" name="client_contact_email" id="client_contact_email" size="40" maxlength="255" value="<?php printSafe($client_contact_email) ?>" /></td>
		</tr>		
		<tr>
			<td>* Domain List :</td>
			<td><input type="text" name="client_domain_list" id="client_domain_list" size="40" maxlength="255" value="<?php printSafe($client_domain_list) ?>" />
=======
			<td><input type="text" name="client_contact_name" id="client_contact_name" size="40" maxlength="255" value="<?php printSafe(getPostedValue('client_contact_name')) ?>" /></td>
=======
			<td><input type="text" name="client_contact_name" id="client_contact_name" size="40" maxlength="255" value="<?php printSafe($client_contact_name) ?>" /></td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		</tr>
		<tr>
			<td>* Contact Email:</td>
			<td><input type="text" name="client_contact_email" id="client_contact_email" size="40" maxlength="255" value="<?php printSafe($client_contact_email) ?>" /></td>
		</tr>		
		<tr>
			<td>* Domain List :</td>
<<<<<<< HEAD
			<td><input type="text" name="client_domain_list" id="client_domain_list" size="40" maxlength="255" value="<?php printSafe(getPostedValue('client_domain_list')) ?>" />
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			<td><input type="text" name="client_domain_list" id="client_domain_list" size="40" maxlength="255" value="<?php printSafe($client_domain_list) ?>" />
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<span class="formNotes">(Comma delimited list)</span></td>
		</tr>
		<tr>
			<td>* DOI Prefix :</td>
			<td><select name="datacite_prefix" id="datacite_prefix" >
			<option value="">Select</option>
		<?php 
<<<<<<< HEAD
<<<<<<< HEAD

		foreach($gDOIS_PREFIX_TYPES as $prefix)
		{
			echo "<option value=".$prefix;
			if($prefix == $datacite_prefix) echo " selected"; 
			echo ">".$prefix."</option>";		
		}	
		?>		
						</td>
		</tr>	
		<?php 
		if($action=="Edit")
		{
		?>
		<tr>
			<td>* App Id :</td>
			<td><input type="text" name="app_id" id="existing_app_id" size="50" maxlength="40" value="<?php printSafe((isset($_GET['app_id']) ? $_GET['app_id'] : getPostedValue('app_id'))) ?>" />	
			<input type="hidden" name="client_id" id="client_id" size="50" maxlength="40" value="<?php printSafe($client_id) ?>" />
			</td>
		</tr>		
		<?php 
		}
		?>
				 <?php 
		global $gDOIS_PREFIX_TYPES
		
		?>
=======
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		foreach($gDOIS_PREFIX_TYPES as $prefix)
		{
			echo "<option value=".$prefix;
			if($prefix == $datacite_prefix) echo " selected"; 
			echo ">".$prefix."</option>";		
		}	
		?>		
						</td>
		</tr>	
		<?php 
		if($action=="Edit")
		{
		?>
		<tr>
			<td>* App Id :</td>
			<td><input type="text" name="app_id" id="existing_app_id" size="50" maxlength="40" value="<?php printSafe((isset($_GET['app_id']) ? $_GET['app_id'] : getPostedValue('app_id'))) ?>" />	
			<input type="hidden" name="client_id" id="client_id" size="50" maxlength="40" value="<?php printSafe($client_id) ?>" />
			</td>
		</tr>		
		<?php 
		}
		?>
				 <?php 
		global $gDOIS_PREFIX_TYPES
		
		?>
<<<<<<< HEAD
	<!--	<tr>
			<td>Application ID:</td>
			<td><input type="text" name="app_id" id="existing_app_id" size="40" maxlength="40" value="<?php printSafe((isset($_GET['appId']) ? $_GET['appId'] : getPostedValue('app_id'))) ?>" /></td>
		</tr>  -->
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	</tbody>
	<tbody>
		<tr>
			<td></td>
<<<<<<< HEAD
<<<<<<< HEAD
			<td><input type="submit" name="verb" value="<?php echo $action;?>" onclick="wcPleaseWait(true, 'Processing...')" />&nbsp;&nbsp;</td>
=======
			<td><input type="submit" name="verb" value="Add" onclick="wcPleaseWait(true, 'Processing...')" />&nbsp;&nbsp;</td>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			<td><input type="submit" name="verb" value="<?php echo $action;?>" onclick="wcPleaseWait(true, 'Processing...')" />&nbsp;&nbsp;</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		</tr>
		<tr>
			<td></td>
			<td class="formNotes">
				Fields marked * are mandatory.<br />
			</td>
		</tr>
	</tbody>
</table>
</form>
<?php
// =============================================================================
// END: Page Content
// Complete the XHTML response.
require '../../_includes/footer.php';
require '../../_includes/finish.php';
?>
