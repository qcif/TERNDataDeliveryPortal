<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div class="info_left"><img class="logo_right" src="/img/logos/logo-trends.png"/><h3>Plot Network information: </h3>
<p>The plot is part of the study to understand vegetation genetic and morphological variation over the Adelaide Geosyncline and testing the "space as a proxy for time" concept in understanding climate change impacts on South Australian native ecosystems. </p>
<b>TERN Site ID:</b> ${features[0].tern_site_id.value} 
<br/>
<b>Description:</b> <#if features[0].description.value != "">
                        ${features[0].description.value} 
                    <#else>
                        not provided 
                    </#if><br/>			
<b>Latitude:</b> <#if features[0].latitude.value != "">
                        ${features[0].latitude.value} 
                    <#else>
                        not provided
                    </#if> <br/>
<b>Longitude:</b><#if features[0].longitude.value != "">
                        ${features[0].longitude.value} 
                    <#else>
                        not provided
                    </#if> <br/>
                   <br/>
		</div> 
		
	</div>
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
