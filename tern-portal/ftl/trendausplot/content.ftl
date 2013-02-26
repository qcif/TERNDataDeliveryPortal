<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div class="info_left"><img class="logo_right" src="/img/logos/logo-atn.png"/><img class="logo_right" src="/img/logos/logo-ausplots.png"/><h3>Plot Network information: </h3> 
<#assign x=1>
 <#list features as feature>
<#if x==1>
<b>TERN Plot ID:</b> ${feature.tern_plot_id.value} 
<br/>
<b>Location:</b> <#if feature.location.value != "">
                        ${feature.location.value} 
                    <#else>
                        not provided 
                    </#if><br/>		
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
<img width="300" height="300" src="/img/transect-ausplot/${feature.tern_plot_id.value}.JPG"/>
                   <br/>
</#if>
		<#assign x=x+1>
		</#list>
	</div>
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
