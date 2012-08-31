<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : rifcsParty2View.xsl.xsl
    Created on : 1 February 2012, 4:11 PM
    Author     : wahyuni
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" exclude-result-prefixes="ro" xmlns:custom="http://youdomain.ext/custom">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
   <xsl:template match="ro:party">
      	<div id="item-view-inner" class="clearfix">

		<div id="party_box">
 		<xsl:choose>
<<<<<<< HEAD
                    <!--
	        <xsl:when test="ro:displayTitle!=''">
	        	<xsl:apply-templates select="ro:displayTitle"/>
                       -->
                       	        <xsl:when test="ro:display_title!=''">
	        	<xsl:apply-templates select="ro:display_title"/>
=======
	        <xsl:when test="ro:displayTitle!=''">
	        	<xsl:apply-templates select="ro:displayTitle"/>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	        </xsl:when>
	         <xsl:otherwise>
	                <div id="displayname" ><h1><xsl:value-of select="../ro:key"/></h1></div>
	        </xsl:otherwise>
        </xsl:choose>
        <!-- clear:both explicit for IE-->
        <div class="clearfix" style="clear:both"></div>

        <xsl:apply-templates select="ro:displayLogo"/>

        <div class="personal_details"><h2>Personal details</h2>
       
<<<<<<< HEAD
        <!--<xsl:apply-templates select="ro:name[@type='alternative']/ro:displayTitle"/>-->
        <xsl:apply-templates select="ro:name[@type='alternative']/ro:display_title"/>
=======
        <xsl:apply-templates select="ro:name[@type='alternative']/ro:displayTitle"/>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794

       
        <xsl:if test="ro:description">
            <div class="descriptions" style="position:relative;clear:both;">
				<xsl:apply-templates select="ro:description[@type= 'brief']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'full']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'significanceStatement']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'notes']" mode="content"/>
				<xsl:apply-templates select="ro:description[not(@type =  'notes' or @type =  'significanceStatement' or @type =  'full' or @type =  'brief' or @type =  'logo' or @type =  'rights' or @type =  'accessRights')]" mode="content"/>

            </div>
        </xsl:if>

        <a href="javascript:void(0);" class="showall_descriptions hide">More...</a>

      
                        <xsl:if test="ro:location/ro:address/ro:electronic/@type='email' or ro:location/ro:address/ro:physical">
		 		<xsl:if test="ro:location/ro:address/ro:electronic/@type='email'">
					<p><xsl:apply-templates select="ro:location/ro:address/ro:electronic/@type"/></p>
				</xsl:if>
			 	
		 		<xsl:if test="ro:location/ro:address/ro:physical">
					<p><xsl:apply-templates select="ro:location/ro:address/ro:physical"/></p>
				</xsl:if>
	 		</xsl:if>
  
<<<<<<< HEAD
        <!--<xsl:if test="ro:relatedInfo">-->
        <xsl:if test="ro:related_info">
        <p><b>More Information:</b> </p>
            <!--<xsl:apply-templates select="ro:relatedInfo"/>-->
            <xsl:apply-templates select="ro:related_info"/>
=======
        <xsl:if test="ro:relatedInfo">
        <p><b>More Information:</b> </p>
            <xsl:apply-templates select="ro:relatedInfo"/>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
         </xsl:if>

        <xsl:if test="ro:coverage or ro:location/ro:spatial">
            <xsl:variable name="coverageLabel">
            <xsl:choose>
            <xsl:when test="ro:coverage/ro:spatial and ro:location/ro:spatial">
            <xsl:text>Coverage And Location:</xsl:text>
            </xsl:when>
            <xsl:when test="ro:location/ro:spatial">
            <xsl:text>Location:</xsl:text>
            </xsl:when>
             <xsl:when test="ro:coverage/ro:spatial">
            <xsl:text>Coverage:</xsl:text>
            </xsl:when>

            </xsl:choose>
            </xsl:variable>
            <p><b><xsl:value-of select="$coverageLabel"/></b></p>

            <xsl:if test="ro:coverage/ro:spatial | ro:location/ro:spatial">
                <xsl:apply-templates select="ro:coverage/ro:spatial | ro:location/ro:spatial"/>
                <div id="spatial_coverage_map"></div>
            </xsl:if>

            <xsl:if test="ro:coverage/ro:center | ro:location/ro:center">
                <xsl:apply-templates select="ro:coverage/ro:center | ro:location/ro:center"/>
            </xsl:if>

            <xsl:if test="ro:coverage/ro:temporal/ro:date">
                <p>Time Period:<br />
                <xsl:apply-templates select="ro:coverage/ro:temporal/ro:date"/>
                </p>
            </xsl:if>
        </xsl:if>



        <xsl:if test="ro:subject">
              <div style="position:relative;clear:both">
            <p><b>Subjects:</b>
            <xsl:if test="ro:subject/@type='anzsrc-for' or ro:subject/@type='anzsrc-seo' or ro:subject/@type='anzsrc-toa'">
                <ul class="subjects">
                <xsl:for-each select="ro:subject">
                    <xsl:sort select="./@type"/>
                    <xsl:if test="@type='anzsrc-for'or @type='anzsrc-seo' or @type='anzsrc-toa'">
                        <xsl:apply-templates select="."/>
                    </xsl:if>
                </xsl:for-each>
                </ul>
            </xsl:if>

            <xsl:if test="ro:subject/@type!='anzsrc-for' and ro:subject/@type!='anzsrc-seo' and ro:subject/@type!='anzsrc-toa'">
          
                <ul class="subjects">
                <xsl:for-each select="ro:subject">
                    <xsl:sort select="./@type"/>
                    <xsl:if test="@type!='anzsrc-for'and @type!='anzsrc-seo' and @type!='anzsrc-toa'">
                        <xsl:apply-templates select="."/>
                    </xsl:if>
                </xsl:for-each>
                </ul>
            </xsl:if>
             </p>
             </div>
        </xsl:if>
        <xsl:choose>
            <xsl:when test="ro:citationInfo">
                <div id="citation" style="position:relative;clear:both;">
                <xsl:choose>
                    <xsl:when test="ro:citationInfo/ro:citationMetadata">
                        <b>How to Cite this Collection:</b><br />
                        <xsl:apply-templates select="ro:citationInfo/ro:citationMetadata"/>
                    </xsl:when>
                    <xsl:when test="ro:citationInfo/ro:fullCitation">
                        <b>How to Cite this Collection:</b><br />
                        <xsl:apply-templates select="ro:citationInfo/ro:fullCitation"/>
                    </xsl:when>
                    <xsl:otherwise >
                    <!-- If we have found an empty citation element build the openURL using the object display title -->
                        <span class="Z3988">
                        <xsl:attribute name="title">
                        <xsl:text>ctx_ver=Z39.88-2004</xsl:text>
                        <xsl:text>&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc</xsl:text>
                        <xsl:text>&amp;rfr_id=info%3Asid%2FTERN</xsl:text>
<<<<<<< HEAD
                        <!--
                        <xsl:text>&amp;rft.title=</xsl:text><xsl:value-of select="//ro:displayTitle"/>
                        <xsl:text>&amp;rft.description=</xsl:text><xsl:value-of select="//ro:displayTitle"/>
                        -->
                        <xsl:text>&amp;rft.title=</xsl:text><xsl:value-of select="//ro:display_title"/>
                        <xsl:text>&amp;rft.description=</xsl:text><xsl:value-of select="//ro:display_title"/>
=======
                        <xsl:text>&amp;rft.title=</xsl:text><xsl:value-of select="//ro:displayTitle"/>
                        <xsl:text>&amp;rft.description=</xsl:text><xsl:value-of select="//ro:displayTitle"/>
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
                        </xsl:attribute>
                        </span><span class="Z3988"></span>
                    </xsl:otherwise>
                </xsl:choose>
                </div>
            </xsl:when>

         </xsl:choose>


        </div>
            <div class="research_data">
                <div id="connectionsRightBox">
			<div id="connectionsInfoBox"></div>
			<h2>Connections</h2>  
			<div id="connections">
				<img>
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/><xsl:text>/img/ajax-loader.gif</xsl:text></xsl:attribute>
				<xsl:attribute name="class">loading-icon</xsl:attribute>
				</img>
		</div>
		</div>
            </div>
        </div>

 
       </div>

    </xsl:template>


</xsl:stylesheet>
