<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div class="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-asn.png"/><h3>Supersite information: </h3>
<#assign x=1>
 <#list features as feature>
<#if x==1>
<b>Name:</b>  <#if feature.name.value != ""> ${feature.name.value}   
                         <#else>
                            not provided
                        </#if> 

<br/> 
<b>Further information:</b>
                <#if feature.info_url.value != "">
                       <a  target="_new"  href="${feature.info_url.value}">${feature.info_url.value}</a><a class="external"></a>
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
