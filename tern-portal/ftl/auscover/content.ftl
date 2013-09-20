<@compress single_line=true>

<#setting number_format="0.###">
<#attempt>

<div class="info_left"><img class="logo_right" src="http://demo/img/logos/logo-auscover.png"/><h3>Field validation site information:</h3>
<#assign x=1>
 <#list features as feature>
<#if x==1>
<b>Name:</b>    
                        <#if feature.name.value !="">
                                ${feature.name.value}
                                <#else>
                                   not provided
                        </#if>
<br/>
<div class="justifyme">
<b>Site description:</b>
                        <#if feature.description.value !="">
                                ${feature.description.value}
                                <#else>
                                   not provided
                        </#if>

</div>
                        <#if feature.image_url.value !="">
                                <div class="center"><img src="${feature.image_url.value}"/></div>

                        </#if>
</#if>
    <#assign x=x+1>
    </#list>
</div>

<div style="clear:both"></div>
<#recover>

</#attempt>

</@compress>
