<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 

<div id="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-auscover.png"/><h3>Field validation site information:</h3>
<b>Name:</b> ${features[0].name.value}
<br/>
<b>Site description:</b> ${features[0].description.value}

<#if features[0].image_url.value != ""> 
            <img src="${features[0].image_url.value}"/>
</#if>
</div>	   

<div style="clear:both"></div>
<#recover>
		 
</#attempt>
		
</@compress>
