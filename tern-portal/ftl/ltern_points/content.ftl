<@compress single_line=true>
<<<<<<< HEAD
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
=======
<br/><b>Plot information</b><br/>
<table class="featureInfo">  
<tr>
  <td>Plot Name</td><td>${features[0].plot_netwo.value}</td>
</tr>
<tr>
  <td>Plot leader</td><td>${features[0].plot_leade.value}</td>
</tr>
<tr>
   <td>Major Vegetation Name</td><td>${features[0].mvg_name.value}</td>
</tr>
<tr><td>Major Common Vegetation</td><td>${features[0].mvg_common.value}</td>
</tr>
<tr><td>Classname </td><td>${features[0].classname.value} </td>  
</tr>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
</table>
<br/>
		
</@compress>
