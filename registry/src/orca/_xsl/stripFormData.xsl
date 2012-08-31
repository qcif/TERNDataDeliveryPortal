<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
<<<<<<< HEAD
<<<<<<< HEAD
xmlns:extRif="http://ands.org.au/standards/rif-cs/extendedRegistryObjects"
	xmlns:rif="http://ands.org.au/standards/rif-cs/registryObjects"
version="1.0">
	<xsl:output indent="yes"/>
	<xsl:strip-space elements="*"/>
=======
	xmlns:rif="http://ands.org.au/standards/rif-cs/registryObjects" version="1.0">
	<xsl:output indent="yes"/>
	<!--xsl:strip-space elements="*"/-->
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
xmlns:extRif="http://ands.org.au/standards/rif-cs/extendedRegistryObjects"
	xmlns:rif="http://ands.org.au/standards/rif-cs/registryObjects"
version="1.0">
	<xsl:output indent="yes"/>
	<xsl:strip-space elements="*"/>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	<!-- copy all other nodes and attributes -->
	
	<xsl:template match="/">
		<xsl:apply-templates/>
	</xsl:template>
	
	<xsl:template match="@* | node()">
		<xsl:copy>
			<xsl:apply-templates select="@* | node()"/>
		</xsl:copy>
	</xsl:template>
	
<<<<<<< HEAD
<<<<<<< HEAD
<xsl:template match="@tab_id | @field_id | @roclass | @lang[. = '']"/>

<xsl:template match="extRif:* | @extRif:*"/>
=======
 <xsl:template match="@tab_id | @field_id | @roclass | @lang[. = '']"/>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
<xsl:template match="@tab_id | @field_id | @roclass | @lang[. = '']"/>

<xsl:template match="extRif:* | @extRif:*"/>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

		
</xsl:stylesheet>
