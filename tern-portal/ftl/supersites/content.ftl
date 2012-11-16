<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div id="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-asn.png"/><h3>Supersite information: </h3>
<b>Name:</b> ${features[0].name.value}
<br/> 
<b>Further information:</b>
                <#if features[0].info_url.value != "">
                       <a class="external"  href="${features[0].info_url.value}">${features[0].info_url.value}</a>
                <#else>
                        not provided
                </#if>
</div>	 
 
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
