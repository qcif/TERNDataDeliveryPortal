<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 

<div class="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-ozflux.jpg"/><h3>Flux Station details: </h3>
<b>Site name:</b>  <#if features[0].name.value != ""> ${features[0].name.value}   
                         <#else>
                            not provided
                        </#if> 

<br/>
<b>Location:</b> <#if features[0].location.value != ""> ${features[0].location.value}   
                         <#else>
                            not provided
                        </#if> 

<br/>
<b>Landcover:</b> <#if features[0].landcover.value != ""> ${features[0].landcover.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Temperature range:</b> <#if features[0].temp_range.value != ""> ${features[0].temp_range.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Annual Rainfall:</b> <#if features[0].ann_rainfall.value != ""> ${features[0].ann_rainfall.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Group:</b> <#if features[0].group.value != ""> ${features[0].group.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Status:</b> <#if features[0].status.value != ""> ${features[0].status.value}   
                         <#else>
                            not provided
                        </#if> 
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
