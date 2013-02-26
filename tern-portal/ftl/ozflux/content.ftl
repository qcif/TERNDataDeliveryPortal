<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 

<div class="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-ozflux.jpg"/><h3>Flux Station details: </h3>
<#assign x=1>
 <#list features as feature>
<#if x==1>
<b>Site name:</b>  <#if feature.name.value != ""> ${feature.name.value}   
                         <#else>
                            not provided
                        </#if> 

<br/>
<b>Location:</b> <#if feature.location.value != ""> ${feature.location.value}   
                         <#else>
                            not provided
                        </#if> 

<br/>
<b>Landcover:</b> <#if feature.landcover.value != ""> ${feature.landcover.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Temperature range:</b> <#if feature.temp_range.value != ""> ${feature.temp_range.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Annual Rainfall:</b> <#if feature.ann_rainfall.value != ""> ${feature.ann_rainfall.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Group:</b> <#if feature.group.value != ""> ${feature.group.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Status:</b> <#if feature.status.value != ""> ${feature.status.value}   
                         <#else>
                            not provided
                        </#if> 
<br/>
<b>Further details:</b><#if feature.site_url.value != "">
                            <a class="external" target="_new" href="${feature.site_url.value}">${feature.site_url.value}</a>
                    <#else>
                        not provided
                    </#if>
</#if>
<#assign x=x+1>
</#list>
</div>	 
 
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
