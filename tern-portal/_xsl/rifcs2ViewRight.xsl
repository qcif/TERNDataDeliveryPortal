<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" exclude-result-prefixes="ro">
	<xsl:output method="html" encoding="UTF-8" indent="yes" omit-xml-declaration="yes"/>
	<xsl:param name="dataSource"/>
	<xsl:param name="dateCreated"/>
	<xsl:param name="base_url" select="'http://devl.ands.org.au/workareas/minh/rda/view/'"/>	
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
	<xsl:variable name="viewPath"></xsl:variable>	
	<xsl:template match="ro:registryObject">		

		<xsl:apply-templates select="ro:collection | ro:activity | ro:party | ro:service"/>
		
	</xsl:template>

	<xsl:template match="ro:collection | ro:activity | ro:party | ro:service">

		<xsl:if test="ro:location/ro:address/ro:electronic/@type='url' 
		or ro:description/@type='rights' or ro:description/@type='accessRights' 
		or ro:location/ro:address/ro:electronic/@type='email'  or ro:location/ro:address/ro:physical">		
	
		<div class="right-box">
			<h2>Access</h2>
			<div class="limitHeight300">
		 	<xsl:if test="ro:location/ro:address/ro:electronic/@type='url'">
				<p><xsl:apply-templates select="ro:location/ro:address/ro:electronic"/></p>	
	 		</xsl:if>
	 		
	 		<xsl:if test="ro:description/@type='rights' or ro:description/@type='accessRights'">
					<h3>Rights</h3>	
			</xsl:if>
				
			<xsl:for-each select="ro:description">		
				<xsl:sort select="@type"/>
					<xsl:apply-templates select="."/>	
			</xsl:for-each>	
			
		 	<xsl:if test="ro:location/ro:address/ro:electronic/@type='email' or ro:location/ro:address/ro:physical">
		 		<h3>Contacts</h3>
		 		<xsl:if test="ro:location/ro:address/ro:electronic/@type='email'">
					<p><xsl:apply-templates select="ro:location/ro:address/ro:electronic/@type"/></p>	
				</xsl:if>
			 	<xsl:if test="ro:location/ro:address/ro:physical/@type='telephoneNumber'">
					<p><xsl:apply-templates select="ro:location/ro:address/ro:physical"/></p>	
				</xsl:if>				
		 		<xsl:if test="ro:location/ro:address/ro:physical">
					<p><xsl:apply-templates select="ro:location/ro:address/ro:physical"/></p>	
				</xsl:if>				
	 		</xsl:if>			
			                        
			</div>
		</div>					
		</xsl:if>
			
	</xsl:template>
	
	<xsl:template match="ro:location/ro:address/ro:electronic">

		<xsl:if test="./@type='url'">
		<xsl:variable name="prefix">	
		<xsl:if test="not(starts-with(.,'http'))">
		  <xsl:text>http://</xsl:text>
		</xsl:if>
		</xsl:variable>	
			<a><xsl:attribute name="href"><xsl:value-of select="$prefix"/><xsl:value-of select="."/></xsl:attribute><xsl:attribute name="target">_blank</xsl:attribute><xsl:value-of select="substring(.,0,30)"/>...</a><br />
		</xsl:if>
		
	</xsl:template>
	
	<xsl:template match="ro:location/ro:address/ro:physical">
		<p>
			<xsl:choose>
				<xsl:when test = "./ro:addressPart or ./ro:addressPart!=''">
					<xsl:for-each select="./ro:addressPart">	
						<xsl:value-of select="."/><br />	
					</xsl:for-each>	
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="."/><br />			
				</xsl:otherwise>
			</xsl:choose>	
		</p>
	</xsl:template>	

	
	<xsl:template match="ro:description">
	
		<xsl:if test="./@type = 'accessRights' or ./@type = 'rights'">
			<p class="rights"><xsl:value-of select="."/></p>
		</xsl:if>	
		
	</xsl:template>
	
	<xsl:template match="ro:location/ro:address/ro:electronic/@type">
		
	<xsl:if test=".='email'">	
	  	<xsl:value-of select=".."/><br />
	</xsl:if>	
			
	</xsl:template>
		
</xsl:stylesheet>
