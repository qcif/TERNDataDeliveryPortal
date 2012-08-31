<?xml version="1.0" encoding="UTF-8"?>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
<!DOCTYPE xsl:stylesheet [
<!ENTITY nbsp "&#xa0;">
]>
<xsl:stylesheet xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" exclude-result-prefixes="ro">
    <xsl:output indent="yes" />
=======
<xsl:stylesheet xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" exclude-result-prefixes="ro">
    <xsl:output indent="yes" method="xml"/>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
    <xsl:strip-space elements="*"/>
<xsl:template match="/">
    <xsl:apply-templates/>
</xsl:template>   
    
 <xsl:template match="ro:registryObjects">
     <add>
    <xsl:apply-templates/>
     </add>
 </xsl:template> 
    
    <xsl:template match="ro:registryObject">
        <doc>
            <xsl:apply-templates select="ro:key"/>
            <xsl:apply-templates select="ro:status"/>
            <xsl:apply-templates select="ro:reverseLinks"/>           
            <xsl:apply-templates select="ro:originatingSource"/>
            <xsl:apply-templates select="ro:dataSourceKey"/>            
            <xsl:element name="field">
                <xsl:attribute name="name">group</xsl:attribute>
                <xsl:value-of select="@group"/>
            </xsl:element>  
            <xsl:apply-templates select="ro:collection | ro:party | ro:activity | ro:service"/>

        </doc>
    </xsl:template> 
   
    <xsl:template match="ro:key">
        <xsl:element name="field">
            <xsl:attribute name="name">key</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:status">
        <xsl:element name="field">
            <xsl:attribute name="name">status</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:reverseLinks">
        <xsl:element name="field">
            <xsl:attribute name="name">reverseLinks</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:originatingSource">
        <xsl:element name="field">
            <xsl:attribute name="name">originating_source</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
     <xsl:template match="ro:dataSourceKey">
        <xsl:element name="field">
            <xsl:attribute name="name">data_source_key</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>   
    
    
    <xsl:template match="ro:displayTitle">
        <xsl:element name="field">
            <xsl:attribute name="name">displayTitle</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:listTitle">
        <xsl:element name="field">
            <xsl:attribute name="name">listTitle</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
   
    <xsl:template match="ro:collection | ro:party | ro:activity | ro:service">
        <xsl:element name="field">
            <xsl:attribute name="name">class</xsl:attribute>
            <xsl:value-of select="local-name()"/>
        </xsl:element>  
        <xsl:element name="field">
            <xsl:attribute name="name">type</xsl:attribute>
            <xsl:value-of select="@type"/>
        </xsl:element>  
        <xsl:element name="field">
            <xsl:attribute name="name">date_modified</xsl:attribute>
            <xsl:value-of select="@dateModified"/>
        </xsl:element>  
        <xsl:apply-templates select="ro:identifier" mode="value"/>
        <xsl:apply-templates select="ro:identifier" mode="type"/>
        <xsl:apply-templates select="ro:name"/>
        
        <xsl:apply-templates select="ro:subject" mode="value"/>
        <xsl:apply-templates select="ro:subject" mode="type"/>
<<<<<<< HEAD
        
=======
        <xsl:apply-templates select="ro:subject[@type='anzsrc-for']" mode="code"/>

>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
        <xsl:apply-templates select="ro:description" mode="value"/>
        <xsl:apply-templates select="ro:description" mode="type"/>
        
        <xsl:apply-templates select="ro:displayTitle"/>
        <xsl:apply-templates select="ro:listTitle"/>
        
        <xsl:apply-templates select="ro:location"/>
        <xsl:apply-templates select="ro:coverage"/>
<<<<<<< HEAD
        
=======
         
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
        <xsl:apply-templates select="ro:relatedObject"/>
        <xsl:apply-templates select="ro:relatedInfo"/>
    </xsl:template>
    
    <xsl:template match="ro:location">
        <xsl:element name="field">
            <xsl:attribute name="name">location</xsl:attribute>
            <xsl:apply-templates/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:relatedInfo">
    <xsl:element name="field">
        <xsl:attribute name="name">relatedInfo</xsl:attribute>
        <xsl:apply-templates/>
    </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:relatedInfo/*">
            <xsl:value-of select="."/><xsl:text> </xsl:text>
    </xsl:template>
    
    
    <xsl:template match="ro:relatedObject">

            <xsl:apply-templates/>
       
    </xsl:template>
    
    <xsl:template match="ro:relatedObject/*[not(local-name() = 'relation')]">
        <xsl:element name="field">
            <xsl:attribute name="name">relatedObject_<xsl:value-of select="local-name()"/></xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:relatedObject/ro:relation">
    <xsl:element name="field">
        <xsl:attribute name="name">relatedObject_<xsl:value-of select="local-name()"/></xsl:attribute>
        <xsl:value-of select="@type"/>
    </xsl:element>  
    <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="ro:relatedObject/ro:relation/ro:description">
    <xsl:element name="field">
        <xsl:attribute name="name">relatedObject_relation_<xsl:value-of select="local-name()"/></xsl:attribute>
        <xsl:value-of select="."/>
    </xsl:element>  
    </xsl:template>
    
    <!--temporal>
        <date type="dateFrom" dateFormat="W3CDTF">1986-09-01</date>
        <date type="dateTo" dateFormat="W3CDTF">1991-01-01</date>
    </temporal-->
    
    <xsl:template match="ro:coverage/ro:temporal/ro:date[@type = 'dateFrom'] | ro:coverage/ro:temporal/ro:date[@type = 'dateTo']">
        <xsl:variable name="dateString"><xsl:value-of select="."/></xsl:variable>
        <xsl:variable name="dateValue">
            <xsl:choose>
                <xsl:when test="contains($dateString ,'-')">
                    <xsl:value-of select="substring-before($dateString ,'-')"/>
                </xsl:when>
                <xsl:when test="contains($dateString ,'/')">
                    <xsl:value-of select="substring-before($dateString ,'/')"/>
                </xsl:when>
                <xsl:when test="contains($dateString ,'T')">
                    <xsl:value-of select="substring-before($dateString ,'T')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="."/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:if test="number($dateValue) != 'NaN' and $dateValue != ''">
	        <xsl:element name="field">
	            <xsl:attribute name="name"><xsl:value-of select="@type"/></xsl:attribute>
	            <xsl:value-of select="$dateValue"/>           
<<<<<<< HEAD
	        </xsl:element>     
        </xsl:if>   
    </xsl:template>
=======
	        </xsl:element>
        </xsl:if>  
    </xsl:template> 

  <!--xsl:template match="ro:coverage/ro:temporal">

        <xsl:if test="ro:date != ''">
	        <xsl:element name="field">
	            <xsl:attribute name="name">minDate</xsl:attribute>
	            <xsl:value-of select="ro:date[1]"/>
	        </xsl:element>
                 <xsl:element name="field">
	            <xsl:attribute name="name">maxDate</xsl:attribute>
	            <xsl:value-of select="ro:date[last()]"/>
	        </xsl:element>
        </xsl:if>
        <xsl:for-each select="ro:date">
            <xsl:variable name="dateString"><xsl:value-of select="."/></xsl:variable>
        <xsl:variable name="dateValue">
            <xsl:choose>
                <xsl:when test="contains($dateString ,'-')">
                    <xsl:value-of select="substring-before($dateString ,'-')"/>
                </xsl:when>
                <xsl:when test="contains($dateString ,'/')">
                    <xsl:value-of select="substring-before($dateString ,'/')"/>
                </xsl:when>
                <xsl:when test="contains($dateString ,'T')">
                    <xsl:value-of select="substring-before($dateString ,'T')"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="."/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:if test="$dateValue != ''">
	        <xsl:element name="field">
	            <xsl:attribute name="name"><xsl:value-of select="@type"/></xsl:attribute>
	            <xsl:value-of select="$dateValue"/>
	        </xsl:element>

        </xsl:if>
        </xsl:for-each>

    </xsl:template>-->
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
    
    <xsl:template match="ro:address | ro:electronic | ro:physical | ro:coverage | ro:temporal">
            <xsl:apply-templates/>
    </xsl:template>
    
    <xsl:template match="ro:electronic/ro:value | ro:addressPart | ro:location/ro:spatial[@type = 'text']">
            <xsl:value-of select="."/><xsl:text> </xsl:text>
    </xsl:template>
    
    <xsl:template match="ro:identifier" mode="value">
        <xsl:element name="field">
            <xsl:attribute name="name">identifier_value</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:identifier" mode="type">
        <xsl:element name="field">
            <xsl:attribute name="name">identifier_type</xsl:attribute>
            <xsl:value-of select="@type"/>
        </xsl:element>       
    </xsl:template>
    
    
    <xsl:template match="ro:name">
		<xsl:apply-templates/>     
    </xsl:template>
    
    <xsl:template match="ro:name/ro:listTitle">
        <xsl:element name="field">
            <xsl:attribute name="name">alt_listTitle</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:name/ro:displayTitle">
        <xsl:element name="field">
            <xsl:attribute name="name">alt_displayTitle</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:subject" mode="value">
<<<<<<< HEAD
        <xsl:element name="field">
            <xsl:attribute name="name">subject_value</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:subject" mode="type">
=======
        <xsl:if test="./@type!='anzsrc-for'">
            <xsl:element name="field">
                <xsl:attribute name="name">subject_value</xsl:attribute>
                <xsl:value-of select="."/>
            </xsl:element>       
        </xsl:if>
        
    </xsl:template>
    
    <xsl:template match="ro:subject" mode="type">
        <xsl:if test="@type!='anzsrc-for'">
            <xsl:element name="field">
                <xsl:attribute name="name">subject_type</xsl:attribute>
                <xsl:value-of select="@type"/>
            </xsl:element>
        </xsl:if>
    </xsl:template>

<!--
    <xsl:template match="ro:subject[@type='anzsrc-for']" mode="code">
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
        <xsl:element name="field">
            <xsl:attribute name="name">subject_type</xsl:attribute>
            <xsl:value-of select="@type"/>
        </xsl:element>
    </xsl:template>
<<<<<<< HEAD
    
=======
-->
<!--Added for FOR -->
    <xsl:template match="ro:subject[@type='anzsrc-for']" mode="code">
        <xsl:choose>
            <xsl:when test="@code!=''">
        <xsl:variable name="codelength" select="string-length(@code)"/>
        
        <xsl:variable name="fullcode">
            <xsl:choose>
                <xsl:when test="$codelength=2">
                    <xsl:value-of select="concat(@code,'0000')"/>
                </xsl:when>
                <xsl:when test="$codelength=4">
                    <xsl:value-of select="concat(@code,'00')"/>
                </xsl:when>
                <xsl:when test="$codelength=6">
                    <xsl:value-of select="@code"/>
                </xsl:when>                
               
            </xsl:choose>
        </xsl:variable>
        
        <xsl:variable name="forcode_six"><xsl:value-of select="$fullcode"/></xsl:variable>
        <xsl:variable name="forcode_four_tmp" select="substring($forcode_six,1,4)" />
        <xsl:variable name="forcode_two_tmp" select="substring($forcode_six,1,2)" />
        
        <xsl:variable name="forcode_four" select="concat($forcode_four_tmp,'00')" />
        <xsl:variable name="forcode_two" select="concat($forcode_two_tmp,'0000')" />
        
        <!--code-->
        <xsl:element name="field">
            <xsl:attribute name="name">for_code_six</xsl:attribute>
            <xsl:value-of select="$forcode_six"/>
        </xsl:element>
        
        <xsl:element name="field">
            <xsl:attribute name="name">for_code_four</xsl:attribute>
            <xsl:value-of select="$forcode_four"/>
        </xsl:element>
        
        <xsl:element name="field">
            <xsl:attribute name="name">for_code_two</xsl:attribute>
            <xsl:value-of select="$forcode_two"/>
        </xsl:element>
        
        <!--string value-->
        <xsl:element name="field">
            <xsl:attribute name="name">for_value_six</xsl:attribute>
            <xsl:value-of select="$forcode_six"/>
        </xsl:element>
        
        <xsl:element name="field">
            <xsl:attribute name="name">for_value_four</xsl:attribute>
            <xsl:value-of select="$forcode_four"/>
        </xsl:element>
        
        <xsl:element name="field">
            <xsl:attribute name="name">for_value_two</xsl:attribute>
            <xsl:value-of select="$forcode_two"/>
        </xsl:element>
            </xsl:when>
        </xsl:choose>

        
    </xsl:template>
<!-- end -->

>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
    <xsl:template match="ro:description" mode="value">
        <xsl:element name="field">
            <xsl:attribute name="name">description_value</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>       
    </xsl:template>
    
    <xsl:template match="ro:description" mode="type">
        <xsl:element name="field">
            <xsl:attribute name="name">description_type</xsl:attribute>
            <xsl:value-of select="@type"/>
        </xsl:element>
    </xsl:template>
    <!-- ignore list -->
    <xsl:template match="ro:location/ro:spatial | ro:coverage/ro:spatial">
        <xsl:element name="field">
            <xsl:attribute name="name">spatial_coverage</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>
    </xsl:template>
    
    <xsl:template match="ro:location/ro:center | ro:coverage/ro:center">
        <xsl:element name="field">
            <xsl:attribute name="name">spatial_coverage_center</xsl:attribute>
            <xsl:value-of select="."/>
        </xsl:element>
    </xsl:template>
   
    <xsl:template match="ro:date"/>
   		
   
</xsl:stylesheet>

