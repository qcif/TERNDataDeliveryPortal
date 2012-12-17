<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div class="info_left"><img class="logo_right" src="/img/logos/logo-atn.jpg"/><img class="logo_right" src="/img/logos/logo-ausplots.png"/><h3>Plot Network information: </h3> 
<b>TERN Plot ID:</b> ${features[0].tern_plot_id.value} 
<br/>
<b>Location:</b> <#if features[0].location.value != "">
                        ${features[0].location.value} 
                    <#else>
                        not provided 
                    </#if><br/>		
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
