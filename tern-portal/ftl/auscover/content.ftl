<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 

<div id="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-auscover.png"/><h3>AusCover information: </h3>
Name: ${features[0].name.value}
<br/>
${features[0].description.value}
</div>	  

<div style="clear:both"></div>
<#recover>
		 
</#attempt>
		
</@compress>
