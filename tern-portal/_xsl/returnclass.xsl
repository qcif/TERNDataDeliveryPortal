<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" exclude-result-prefixes="ro">
	<xsl:output method="xml" encoding="UTF-8" indent="yes" omit-xml-declaration="yes"/>
	<xsl:param name="dataSource"/>
	<xsl:param name="dateCreated"/>
	<xsl:param name="base_url"/>
	<xsl:variable name="objectClass" >
		<xsl:choose>
			<xsl:when test="//ro:collection">Collection</xsl:when>
			<xsl:when test="//ro:activity">Activity</xsl:when>
			<xsl:when test="//ro:party">Party</xsl:when>
			<xsl:when test="//ro:service">Service</xsl:when>			
		</xsl:choose>
		
	</xsl:variable>	
	<xsl:template match="ro:registryObjects">
		<xsl:value-of select="$objectClass"/>
	</xsl:template>
</xsl:stylesheet>
