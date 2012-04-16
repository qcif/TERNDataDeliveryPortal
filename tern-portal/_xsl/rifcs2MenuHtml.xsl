<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" exclude-result-prefixes="ro">
	<xsl:output method="html" encoding="UTF-8" indent="yes" omit-xml-declaration="yes"/>
	<xsl:param name="dataSource"/>
	<xsl:param name="dateCreated"/>
	<xsl:param name="base_url"/>
	<xsl:variable name="objectClass" >
		<xsl:choose>
			<xsl:when test="//ro:collection">collection</xsl:when>
			<xsl:when test="//ro:activity">activity</xsl:when>
			<xsl:when test="//ro:party">party</xsl:when>
			<xsl:when test="//ro:service">service</xsl:when>			
		</xsl:choose>
		
	</xsl:variable>	
	<xsl:template match="ro:registryObjects">
	<div id="top">
			<ul id="breadcrumb">
				<li><a href="{$base_url}">Home</a></li>
				<li><a href="{$base_url}search/browse/{ro:registryObject/@group}"><xsl:value-of select="ro:registryObject/@group"/></a></li>
				<li><a href="{$base_url}search/browse/{ro:registryObject/@group}/{$objectClass}"><xsl:value-of select="$objectClass"/></a></li>
				<li><xsl:value-of select="//ro:displayTitle"/></li>
			</ul>
			</div>				
	</xsl:template>
</xsl:stylesheet>
