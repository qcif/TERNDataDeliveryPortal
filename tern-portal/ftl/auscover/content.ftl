<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 

<div class="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-auscover.png"/><h3>Field validation site information:</h3>
<b>Name:</b> <#if features[0].name.value != ""> ${features[0].name.value}   
                         <#else>
                            not provided
                        </#if> 

<br/>
<div class="justifyme">
<b>Site description:</b>  <#if features[0].description.value != ""> ${features[0].description.value}   
                         <#else>
                            not provided
                        </#if> 
</div>
<#if features[0].image_url.value != ""> 
            <img src="${features[0].image_url.value}"/>
</#if>
</div>	   

<div style="clear:both"></div>
<#recover>
		 
</#attempt>
		
</@compress>
