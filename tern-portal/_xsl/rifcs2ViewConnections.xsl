<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" exclude-result-prefixes="ro">
	<xsl:output method="html" encoding="UTF-8" indent="yes" omit-xml-declaration="yes"/>
	<xsl:param name="dataSource"/>
	<xsl:param name="dateCreated"/>
	<xsl:param name="base_url" select="'http://devl.ands.org.au/workareas/rda/view/?key='"/>	
	<xsl:strip-space elements="*"/>
	<xsl:variable name="objectClass" >
		<xsl:choose>
			<xsl:when test="//ro:collection">Collection</xsl:when>
			<xsl:when test="//ro:activity">Activity</xsl:when>
			<xsl:when test="//ro:party">Party</xsl:when>
			<xsl:when test="//ro:service">Service</xsl:when>			
		</xsl:choose>		
	</xsl:variable>	
	<xsl:variable name="objectClassPlural" >
		<xsl:choose>
			<xsl:when test="//ro:collection">Collections</xsl:when>
			<xsl:when test="//ro:activity">Activities</xsl:when>		
			<xsl:when test="//ro:service">Services</xsl:when>			
		</xsl:choose>		
	</xsl:variable>	
	<xsl:variable name="objectClassType" >
		<xsl:choose>
			<xsl:when test="//ro:collection">collections</xsl:when>
			<xsl:when test="//ro:activity">activities</xsl:when>
			<xsl:when test="//ro:party/@type='group'">party_multi</xsl:when>
			<xsl:when test="//ro:party/@type='person'">party_one</xsl:when>			
			<xsl:when test="//ro:service">services</xsl:when>			
		</xsl:choose>		
	</xsl:variable>		   	
	<xsl:variable name="viewPath"></xsl:variable>	
	<xsl:template match="ro:registryObject">		

		<xsl:apply-templates select="ro:collection | ro:activity | ro:party | ro:service"/>
		
	</xsl:template>

	<xsl:template match="ro:collection | ro:activity | ro:party | ro:service">
		
		<xsl:if test="ro:relatedObject/ro:relatedObjectClass!=''">
		<div class="right-box">
			<div id="infoBox" class="hide"></div>
			<h2>Connections</h2>
			<div class="limitHeight300">
			
			<xsl:if test="ro:relatedObject/ro:relatedObjectClass = 'Collection' and $objectClass != 'Collection'">
			<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:text>collections_16.png</xsl:text></xsl:attribute>
				</img>Collections</h3>	
			<ul id="c-collections">				
			<xsl:for-each select="ro:relatedObject[ro:relatedObjectClass='Collection']">		
				<!--  xsl:if test="ro:relatedObjectClass != $objectClass and ro:relatedObjectClass='Collection' "-->
				   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>                
			</xsl:for-each>	
			</ul>

			</xsl:if>				
			<xsl:if test="ro:relatedObject/ro:relatedObjectClass = 'Party' and $objectClass != 'Party'">
				<xsl:if test="ro:relatedObject/ro:relatedObjectType = 'person'">
					<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:text>party_one_16.png</xsl:text></xsl:attribute>
				</img>Researchers</h3>
					<ul id="c-researchers">
					<xsl:for-each select="ro:relatedObject[ro:relatedObjectType='person']">		
				   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>		
					</xsl:for-each>
					</ul>		
				</xsl:if>
				
				<xsl:if test="ro:relatedObject/ro:relatedObjectType = 'group'">
					<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:text>party_multi_16.png</xsl:text></xsl:attribute>
				</img>Research Groups</h3>
					<ul id="c-researchGroups">
					<xsl:for-each select="ro:relatedObject[ro:relatedObjectType='group']">		
				   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>		
					</xsl:for-each>	
					</ul>
				</xsl:if>								
			</xsl:if>	
						
			<xsl:if test="ro:relatedObject/ro:relatedObjectClass = 'Activity' and $objectClass != 'Activity'">
			<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:text>activities_16.png</xsl:text></xsl:attribute>
				</img>Activities</h3>			
			<ul id="c-activities">			
			<xsl:for-each select="ro:relatedObject[ro:relatedObjectClass='Activity']">		
				   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>		
			</xsl:for-each>
			</ul>
			</xsl:if>
					
			<xsl:if test="ro:relatedObject/ro:relatedObjectClass = 'Service'  and $objectClass != 'Service'">
			<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:text>services_16.png</xsl:text></xsl:attribute>
				</img>Services</h3>			
			<ul id="c-services">			
			<xsl:for-each select="ro:relatedObject[ro:relatedObjectClass='Service']">		
				   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>		
			</xsl:for-each>						
			</ul>
			</xsl:if>
						
			<xsl:if test="ro:relatedObject/ro:relatedObjectClass = $objectClass and $objectClass != 'Party'">
			<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:value-of select="$objectClassType"/>
				<xsl:text>_16.png</xsl:text></xsl:attribute>
				</img><xsl:value-of select="$objectClassPlural"/></h3>
			<ul id="c-services">
			<xsl:for-each select="ro:relatedObject[$objectClass]">		
				   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>	
			</xsl:for-each>
			</ul>		
			</xsl:if>
			
			<xsl:if test="ro:relatedObject/ro:relatedObjectClass = $objectClass and $objectClass = 'Party'">
				<xsl:if test="ro:relatedObject/ro:relatedObjectType = 'person'">
					<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:text>party_one_16.png</xsl:text></xsl:attribute>
				</img>Researchers</h3>
					<ul id="c-researchers">
					<xsl:for-each select="ro:relatedObject[ro:relatedObjectType='person']">		
				   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>
					</xsl:for-each>	
					</ul>	
				</xsl:if>
				
				<xsl:if test="ro:relatedObject/ro:relatedObjectType = 'group'">
					<h3><img  class="icon-heading-connections">
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/>
				<xsl:text>/img/icon/</xsl:text>
				<xsl:text>multi_one_16.png</xsl:text></xsl:attribute>
				</img>Research Groups</h3>
					<ul id="c-researchGroups">
					<xsl:for-each select="ro:relatedObject[ro:relatedObjectType='group' ]">		
			   <xsl:variable name="position" select="position()"/>
				   <xsl:if test="$position &lt; 8">
					<xsl:apply-templates select="."></xsl:apply-templates>								
				</xsl:if>	
					</xsl:for-each>
					</ul>								
				</xsl:if>			
			</xsl:if>	
		      
			</div>		
		</div>
		
	</xsl:if>
		

	</xsl:template>
		
	<xsl:template match="ro:relatedObject">

		<li>
		<xsl:choose>
			<xsl:when test="./@type='external'">
				<a>
				<xsl:attribute name="href"><xsl:value-of select="$base_url"/><xsl:text>view/?key=</xsl:text><xsl:value-of select="./ro:key"/></xsl:attribute>		
				<xsl:attribute name="title"><xsl:value-of select="./ro:relation/@type"/><xsl:text> - Automatic link</xsl:text></xsl:attribute>
				<xsl:choose>
					<xsl:when test="./ro:relatedObjectDisplayTitle!=''">
						<xsl:value-of select="ro:relatedObjectDisplayTitle"/>
					</xsl:when>
					<xsl:otherwise>
						<xsl:value-of select="./ro:key"/>
					</xsl:otherwise>	
				</xsl:choose>	
				</a>
			<br />
			<span class='faded'>(Automatic link)</span>						
			</xsl:when>
			<xsl:otherwise>
				<a>
				<xsl:attribute name="href"><xsl:value-of select="$base_url"/><xsl:text>view/?key=</xsl:text><xsl:value-of select="./ro:key"/></xsl:attribute>		
				<xsl:attribute name="title"><xsl:value-of select="./ro:relation/@type"/></xsl:attribute>
				<xsl:choose>
					<xsl:when test="./ro:relatedObjectDisplayTitle!=''">
						<xsl:value-of select="ro:relatedObjectDisplayTitle"/>
					</xsl:when>
					<xsl:otherwise>
						<xsl:value-of select="./ro:key"/>
					</xsl:otherwise>	
				</xsl:choose>
				</a>
			</xsl:otherwise>					
		</xsl:choose>				
		</li>	
					
		<xsl:if test="./ro:relatedObjectLogo">
			<div><img id="party_logo"  style="max-width:130px;max-height:63px;"><xsl:attribute name="src"><xsl:value-of select="./ro:relatedObjectLogo"/></xsl:attribute></img></div>
		</xsl:if>	

	</xsl:template>
	
</xsl:stylesheet>
