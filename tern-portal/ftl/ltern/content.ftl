<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
<div id="info_left"><img class="logo_right" src="http://portal.tern.org.au/img/logos/logo-ltern.png"/><h3>Plot Network information: </h3>
<b>Name:</b> ${features[0].name.value}
<br/>
<b>Leader:</b> <#if features[0].plot_leade.value != "">
                        ${features[0].plot_leade.value} 
                    <#else>
                        not provided
                    </#if><br/>			
<b>Established:</b> <#if features[0].year_estab.value != "">
                        ${features[0].year_estab.value} 
                    <#else>
                        not provided
                    </#if> <br/>
<b>Description:</b>
                        not provided
                   <br/>
<b>Study Focus: </b> <#if features[0].study_focu.value != "">
                        ${features[0].study_focu.value} 
                     <#else>
                        not provided
                    </#if> <br/>
 <b>Number of plots: </b>  <#if features[0].count.value != "">
			    ${features[0].count.value}
                        <#else>
                            not provided
                        </#if> <br/>
<b>Some of the Research Questions: </b> <#if features[0].research_q.value != "" ||  features[0].research_1.value!="" ||  features[0].research_2.value!=""> <br/>
			    ${features[0].research_q.value}  <br/> ${features[0].research_1.value} <br/>  ${features[0].research_2.value} 
                        <#else>
                            not provided
			</#if>
<br/> 			
		</div> 
		
	</div>
<div style="clear:both"></div>
<#recover>
		
		 
</#attempt>
		
</@compress>
