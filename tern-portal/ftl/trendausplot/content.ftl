<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div class="info_left"><img class="logo_right" src="/img/logos/logo-atn.png"/><img class="logo_right" src="/img/logos/logo-ausplots.png"/><h3>Plot Network information: </h3> 
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
                        ${features[0].latitude.value}&deg;S
                    <#else>
                        not provided
                    </#if> <br/>
<b>Longitude:</b><#if features[0].longitude.value != "">
                        ${features[0].longitude.value}&deg;E
                    <#else>
                        not provided
                    </#if> <br/>
<img width="300" height="300" src="/img/transect-ausplot/${features[0].tern_plot_id.value}.JPG"/>
                   <br/>
		</div> 
		
	</div>
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
