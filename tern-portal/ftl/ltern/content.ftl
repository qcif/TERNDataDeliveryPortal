<@compress single_line=true>

<#setting number_format="0.###">
<#attempt> 

<h4>${features[0].name.value}</h4>

	<div class="feature">  		
		<div style="clear:both">
			<#if features[0].plot_leade.value != "">
			    <b>Lead by:</b> ${features[0].plot_leade.value}  <br/>
			</#if>
			<#if features[0].year_estab.value != "">
<<<<<<< HEAD
			    <b>Established on:</b> ${features[0].year_estab.value}  <br/>
=======
			    <b>Established:</b> ${features[0].year_estab.value}  <br/>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
			</#if>
			<#if features[0].research_q.value != "" ||  features[0].research_1.value!="" ||  features[0].research_2.value!="">
			    <b>Research Questions: </b> <br/> ${features[0].research_q.value}  <br/> ${features[0].research_1.value} <br/>  ${features[0].research_2.value} <br/> 
			</#if>
			<#if features[0].study_focu.value != "">
			    <b>Study Focus: </b> ${features[0].study_focu.value}  <br/>
			</#if>
		</div>
		
	</div>
<#recover>
		
		 
</#attempt>
		
</@compress>
