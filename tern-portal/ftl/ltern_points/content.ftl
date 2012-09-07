<@compress single_line=true>
<br/><b>Points info</b><br/>
<table class="featureInfo">
  
  <tr>
  <th >Plot Leader</th>
  <th >M Vegetation </th>
  <th>Common Vegetation </th>
  </tr>

<#assign odd = false>
<#list features as feature>
  <#if odd>
    <tr class="odd">
  <#else>
    <tr>
  </#if>
  <#assign odd = !odd>
    <td>${feature.plot_leade.value}</td>
    <td>${feature.mvg_name.value}</td>
    <td>${feature.mvg_common.value}</td>
  </tr>
</#list>
</table>
<br/>
		
</@compress>
