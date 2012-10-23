<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 
 
<h4>Long Term Ecological Research Network: <br/>${features[0].name.value}</h4>
  
	<div class="feature">  		
		<div style="clear:both">
			<#if features[0].plot_leade.value != "">
			    <b>Plot leader:</b> ${features[0].plot_leade.value}  <br/>
			</#if>
			<#if features[0].year_estab.value != "">
			    <b>Established:</b> ${features[0].year_estab.value}  <br/>
			</#if>
			<#if features[0].research_q.value != "" ||  features[0].research_1.value!="" ||  features[0].research_2.value!="">
			    <b>Research Questions: </b> <br/> ${features[0].research_q.value}  <br/> ${features[0].research_1.value} <br/>  ${features[0].research_2.value} <br/> 
			</#if>
			<#if features[0].study_focu.value != "">
			    <b>Study Focus: </b> ${features[0].study_focu.value}  <br/>
			</#if>
                        <#if features[0].count.value != "">
			    <b>Number of plots: </b> ${features[0].count.value}  <br/>
			</#if>
		</div> 
		
	</div>

<#recover>
		
		 
</#attempt>
		
</@compress>
