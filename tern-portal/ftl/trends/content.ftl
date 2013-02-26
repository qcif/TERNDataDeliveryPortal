<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div class="info_left"><img class="logo_right" src="/img/logos/logo-trends.png"/><img class="logo_right" src="/img/logos/logo-atn.png"/><h3>Plot Network information: </h3>
<#assign x=1>
 <#list features as feature>
<#if x==1>
<p>The plot is part of the study to understand vegetation genetic and morphological variation over the Adelaide Geosyncline and testing the "space as a proxy for time" concept in understanding climate change impacts on South Australian native ecosystems. </p>
<b>TERN Site ID:</b> ${feature.tern_site_id.value} 
<br/>
<b>Description:</b> <#if feature.description.value != "">
                        ${feature.description.value} 
                    <#else>
                        not provided 
                    </#if><br/>			
<b>Latitude:</b> <#if feature.latitude.value != ""> 
                        ${feature.latitude.value}&deg;S
                    <#else>
                        not provided
                    </#if> <br/>
<b>Longitude:</b><#if feature.longitude.value != "">
                        ${feature.longitude.value}&deg;E
                    <#else>
                        not provided
                    </#if> <br/>
                   <br/>
</#if>
<#assign x=x+1> 
</#list>
	</div>
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
