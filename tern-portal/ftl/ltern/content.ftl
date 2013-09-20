<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div class="info_left"><img class="logo_right" src="http://demo/img/logos/logo-ltern.png"/><h3>Plot Network information: </h3>
<#assign x=1>
 <#list features as feature>
<#if x==1>
<b>Name:</b> ${feature.name.value}
<br/>
<b>Leader:</b>         <#if feature.plot_leade.value != "">
                            ${feature.plot_leade.value} 
                        <#else>
                            not provided
                        </#if>
			
<b>Established:</b> <#if feature.year_estab.value != "">
                        ${feature.year_estab.value} 
                    <#else>
                        not provided
                    </#if> <br/>
<b>Description:</b>
                        not provided
                   <br/>
<b>Study Focus: </b> <#if feature.study_focu.value != "">
                        ${feature.study_focu.value} 
                     <#else>
                        not provided
                    </#if> <br/>
 <b>Number of plots: </b>  <#if feature.count.value != "">
			    ${feature.count.value}
                        <#else>
                            not provided
                        </#if> <br/>
<b>Some of the Research Questions: </b> <#if feature.research_q.value != "" ||  feature.research_1.value!="" ||  feature.research_2.value!=""> <br/>
			    ${feature.research_q.value}  <br/> ${feature.research_1.value} <br/>  ${feature.research_2.value} 
                        <#else>
                            not provided
			</#if>
<br/> 	
</#if>		
<#assign x=x+1>
</#list>	
	</div>
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
