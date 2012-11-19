<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 

<div id="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-ozflux.jpg"/><h3>Flux Station details: </h3>
<b>Site name:</b> ${features[0].name.value}
<br/>
<b>Location:</b> ${features[0].location.value}
<br/>
<b>Landcover:</b> ${features[0].landcover.value}
<br/>
<b>Temperature range:</b> ${features[0].temp_range.value}
<br/>
<b>Annual Rainfall:</b> ${features[0].ann_rainfall.value}
<br/>
<b>Group:</b> ${features[0].group.value}
<br/>
<b>Status:</b> ${features[0].status.value}
<br/>
<b>Further details:</b><#if features[0].site_url.value != "">
                            <a class="external" target="_new" href="${features[0].site_url.value}">${features[0].site_url.value}</a>
                    <#else>
                        not provided
                    </#if>
</div>	 
 
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
