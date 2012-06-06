<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" exclude-result-prefixes="ro" xmlns:custom="http://youdomain.ext/custom"  >
    <xsl:include   href ="url_encode.xsl" />
    <xsl:output method="html" encoding="UTF-8" indent="no" omit-xml-declaration="yes"/>
    <xsl:strip-space elements="*"/>


<xsl:param name="connection">No connection</xsl:param>

    <xsl:param name="dataSource" select="//ro:originatingSource"/>
    <xsl:param name="dateCreated"/>
    <xsl:param name="base_url" select="'http://devl.ands.org.au/workareas/lizrda/view/'"/>
    <xsl:param name="orca_view"/>
    <xsl:param name="key"/>

    <xsl:variable name="objectClass" >
        <xsl:choose>
            <xsl:when test="//ro:collection">Collection</xsl:when>
            <xsl:when test="//ro:activity">Activity</xsl:when>
            <xsl:when test="//ro:party">Party</xsl:when>
            <xsl:when test="//ro:service">Service</xsl:when>
        </xsl:choose>
    </xsl:variable>
    <xsl:variable name="objectClassLabel" >
        <xsl:choose>
            <xsl:when test="//ro:collection">Research Data</xsl:when>
            <xsl:when test="//ro:activity">Projects</xsl:when>
            <xsl:when test="//ro:party">People</xsl:when>
            <xsl:when test="//ro:service">Research Systems</xsl:when>
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

    <xsl:template match="ro:registryObject">
        <!--  We will first set up the breadcrumb menu for the page -->
        <span id="originating_source" class="hide"><xsl:value-of select="$dataSource"/></span>

		<xsl:variable name="group">
		<xsl:choose>
		<xsl:when test="string-length(./@group)>30">
		<xsl:value-of select="substring(./@group,0,30)"/>...
		</xsl:when>
		<xsl:otherwise>
		<xsl:value-of select="./@group"/>
		</xsl:otherwise>
		</xsl:choose>
		</xsl:variable>

		<xsl:variable name="theTitle">
		<xsl:choose>
		<xsl:when test="string-length(//ro:displayTitle)>30">
		<xsl:value-of select="substring(//ro:displayTitle,0,30)"/>...
		</xsl:when>
		<xsl:otherwise>
		<xsl:value-of select="//ro:displayTitle"/>
		</xsl:otherwise>
		</xsl:choose>
		</xsl:variable>
    	<div id="top" class="top-corner">
    	<meta property="og:description" content="description" />
		</div>

		<!--  the following hidden elements dfine content to be used in further ajax calls -->
        <div id="group_value" class="hide"><xsl:value-of select="@group"/></div>
        <div id="datasource_key" class="hide"><xsl:value-of select="@originatingSource"/></div>
        <div id="key_value" class="hide"></div>
         <div id="class" class="hide"><xsl:value-of select="$objectClass"/></div>
        <span id="key" class="hide"><xsl:value-of select="ro:key"/></span>

        <xsl:apply-templates select="ro:collection | ro:activity | ro:party | ro:service"/>

    </xsl:template>

    <xsl:template match="ro:collection | ro:activity | ro:party | ro:service">
      	<div id="item-view-inner" class="clearfix" data-role="content">

		<div id="left">
 		<xsl:choose>
	        <xsl:when test="ro:displayTitle!=''">
	        	<xsl:apply-templates select="ro:displayTitle"/>
	        </xsl:when>
	         <xsl:otherwise>
	                <div id="displaytitle"><h1><xsl:value-of select="../ro:key"/></h1></div>
	        </xsl:otherwise>
        </xsl:choose>
        <div class="clearfix"></div>

        <xsl:apply-templates select="ro:displayLogo"/>

        <xsl:if test="ro:displayLogo = ''">
            <div class="clearfix"></div>


        <xsl:apply-templates select="ro:name[@type='alternative']/ro:displayTitle"/>

        <div class="clearfix"></div>
        </xsl:if>
        <xsl:if test="ro:description">
            <div class="descriptions" style="position:relative;clear:both;" data-role="collapsible" data-collapsed="false">
                     <h4>Description</h4>
				<xsl:apply-templates select="ro:description[@type= 'brief']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'full']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'significanceStatement']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'notes']" mode="content"/>
				<xsl:apply-templates select="ro:description[not(@type =  'notes' or @type =  'significanceStatement' or @type =  'full' or @type =  'brief' or @type =  'logo' or @type =  'rights' or @type =  'accessRights')]" mode="content"/>

            </div>
        </xsl:if>

        <a href="javascript:void(0);" class="showall_descriptions hide">More...</a>

     
        <xsl:if test="ro:relatedInfo">
            <div data-role="collapsible">
        <p><h3>More Information</h3> </p>
            <xsl:apply-templates select="ro:relatedInfo"/>
              </div>
         </xsl:if>

        <xsl:if test="ro:coverage or ro:location/ro:spatial">
            <xsl:variable name="coverageLabel">
            <xsl:choose>
            <xsl:when test="ro:coverage/ro:spatial and ro:location/ro:spatial">
            <xsl:text>Coverage And Location</xsl:text>
            </xsl:when>
            <xsl:when test="ro:location/ro:spatial">
            <xsl:text>Location</xsl:text>
            </xsl:when>
             <xsl:when test="ro:coverage/ro:spatial">
            <xsl:text>Coverage</xsl:text>
            </xsl:when>
             <xsl:when test="ro:coverage/ro:temporal/ro:date">
            <xsl:text>Coverage</xsl:text>
            </xsl:when>

            </xsl:choose>
            </xsl:variable>
            <xsl:if test="$coverageLabel != ''">
            <div data-role="collapsible" id="coverage">
            <h3><xsl:value-of select="$coverageLabel"/></h3>

            <xsl:if test="ro:coverage/ro:spatial | ro:location/ro:spatial">
                <xsl:apply-templates select="ro:coverage/ro:spatial | ro:location/ro:spatial"/>
                <div id="spatial_coverage_map"></div>
            </xsl:if>

            <xsl:if test="ro:coverage/ro:center | ro:location/ro:center">
                <xsl:apply-templates select="ro:coverage/ro:center | ro:location/ro:center"/>
            </xsl:if>

            <xsl:if test="ro:coverage/ro:temporal/ro:date">
                <p><b>Time Period</b></p>
                <xsl:apply-templates select="ro:coverage/ro:temporal/ro:date"/>
                
            </xsl:if>
            
           </div> </xsl:if>
        </xsl:if>



        <xsl:if test="ro:subject">
              <div style="position:relative;clear:both" data-role="collapsible">
            <p><h4>Subjects </h4>
            <xsl:if test="ro:subject/@type='anzsrc-for' or ro:subject/@type='anzsrc-seo' or ro:subject/@type='anzsrc-toa'">
                <p>ANZSRC</p>
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
                <p>Keywords</p>
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
                <div id="citation" style="position:relative;clear:both;" data-role="collapsible">
                <xsl:choose>
                    <xsl:when test="ro:citationInfo/ro:citationMetadata">
                        <h3>How to Cite this Collection</h3>
                        <xsl:apply-templates select="ro:citationInfo/ro:citationMetadata"/>
                    </xsl:when>
                    <xsl:when test="ro:citationInfo/ro:fullCitation">
                        <h3>How to Cite this Collection</h3>
                        <xsl:apply-templates select="ro:citationInfo/ro:fullCitation"/>
                    </xsl:when>
                    <xsl:otherwise >
                    <!-- If we have found an empty citation element build the openURL using the object display title -->
                        <span class="Z3988">
                        <xsl:attribute name="title">
                        <xsl:text>ctx_ver=Z39.88-2004</xsl:text>
                        <xsl:text>&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc</xsl:text>
                        <xsl:text>&amp;rfr_id=info%3Asid%2FTERN</xsl:text>
                        <xsl:text>&amp;rft.title=</xsl:text><xsl:value-of select="//ro:displayTitle"/>
                        <xsl:text>&amp;rft.description=</xsl:text><xsl:value-of select="//ro:displayTitle"/>
                        </xsl:attribute>
                        </span><span class="Z3988"></span>
                    </xsl:otherwise>
                </xsl:choose>
                </div>
            </xsl:when>

         </xsl:choose>


        <!--div style="position:relative;clear:both;" class="no_print">
          	<p>	<a>
          		<xsl:attribute name="href"><xsl:value-of select="$orca_view"/>?key=<xsl:value-of select="$key"/></xsl:attribute>
          		View the complete record in the ANDS Collections Registry
          		</a>
          	</p>
        </div-->

        </div>

        <!--  we will now transform the rights handside stuff -->
  		<div id="right">
	       <xsl:if test="ro:location/ro:address/ro:electronic/@type='url'
		or ro:description/@type='rights' or ro:description/@type='accessRights'
		or ro:location/ro:address/ro:electronic/@type='email'  or ro:location/ro:address/ro:physical">
		<div class="right-box">

			<div class="limitHeight300">
		 	

	 		 <xsl:if test="ro:description/@type='rights' or ro:description/@type='accessRights'">
				<div data-role="collapsible">	<h3>Rights</h3>
			

			<xsl:apply-templates select="ro:description[@type = 'accessRights' or @type = 'rights']" mode="right"/>
                                </div>
                        </xsl:if>
		 	<xsl:if test="ro:location/ro:address/ro:electronic/@type='email' or ro:location/ro:address/ro:physical">
                            <div data-role="collapsible">
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
                                  </div>
	 		</xsl:if>

			</div>
		</div>
		</xsl:if>

<!-- 	<div id="connections-box"><img>
			<xsl:attribute name="src"><xsl:value-of select="$base_url"/><xsl:text>/img/ajax-loader.gif</xsl:text></xsl:attribute>
			<xsl:attribute name="class">loading-icon</xsl:attribute></img></div> 	 -->
                        <div data-role="navbar" class="clearfix">
                            <ul>
                               <!--li><a><xsl:attribute name="class">ui-btn-active</xsl:attribute><xsl:attribute name="href">/m/</xsl:attribute>Send to Email</a></li-->

                           <xsl:if test="ro:location/ro:address/ro:electronic/@type='url'">
				<xsl:apply-templates select="ro:location/ro:address/ro:electronic"/>
	 		</xsl:if>
                            </ul>
                         </div>
			<!-- NEW CONNECTION -->
			<div class="right-box" id="connectionsRightBox" data-role="collapsible">
			<div id="connectionsInfoBox" class="hide" ></div>
			<h2>Connections</h2>
			<div id="connections">
				<xsl:value-of select="$connection" disable-output-escaping="yes"  />
			</div>
			</div>




		 	<!--xsl:if test="$objectClass='Collection'">
				<div class="right-box" id="seeAlsoRightBox" data-role="collapsible">
				<div id="infoBox" class="hide" ></div>
				<h2>Suggested Links</h2>
				<div id="seeAlso">
					nothing here yet
				</div>
				</div>
			</xsl:if>
 
		 	<xsl:if test="$objectClass='Party'">
				<div class="right-box" id="seeAlso-Identifier" data-role="collapsible">
				<div id="infoBox" class="hide" ></div>
				<h2>Suggested Links</h2>
				<div id="seeAlso-IdentifierBox">
					nothing here yet
				</div>
				</div>
			</xsl:if-->
                     

		</div>
       </div>

    </xsl:template>


<!--  the following templates will format the view page content -->
    <xsl:template match="ro:displayTitle">
        <div id="displaytitle">
        	<h3><xsl:value-of select="."/></h3>
		</div>
    </xsl:template>

    <xsl:template match="ro:displayLogo">
        <div class="rif_logo" ><img id="party_logo" style="max-width:200px;">
        <xsl:attribute name="src"><xsl:value-of select="."/></xsl:attribute>
        </img>
		</div>
    </xsl:template>

    <xsl:template match="ro:name[@type='alternative']/ro:displayTitle">
        <p class="alt_displayTitle"><xsl:value-of select="."/></p>
    </xsl:template>

    <xsl:template match="ro:identifier">
    	<p>
    		<xsl:attribute name="name"><xsl:value-of select="./@type"/></xsl:attribute>
			<xsl:value-of select="."/>
		</p>
    </xsl:template>

    <xsl:template match="ro:title">
        <xsl:value-of select="."/><br />
    </xsl:template>

    <xsl:template match="ro:relatedInfo/ro:notes">
        <xsl:value-of select="."/><br />
    </xsl:template>

    <xsl:template match="ro:spatial">
        <p class="coverage hide"><xsl:value-of select="."/></p>
    </xsl:template>

    <xsl:template match="ro:center">
        <p class="spatial_coverage_center hide"><xsl:value-of select="."/></p>
    </xsl:template>

    <xsl:template match="ro:date">
        <xsl:if test="./@type = 'dateFrom'">
            From
        </xsl:if>
        <xsl:if test="./@type = 'dateTo'">
            To
        </xsl:if>
        <xsl:value-of select="."/>
    </xsl:template>

    <xsl:template match="ro:subject">
        <xsl:variable name="url">
     
        <hex>
	<xsl:call-template name="url-encode">
          <xsl:with-param name="str" select="."/>
        </xsl:call-template>
        </hex>
	</xsl:variable>

          <xsl:if test="./@type='anzsrc-for'">
            <li><a  class="forfourFilter" id="{.}"><xsl:attribute name="href">/m/search?forfourFilter=<xsl:value-of select="."/></xsl:attribute><xsl:value-of select="."/></a></li>
        </xsl:if>
        <xsl:if test="./@type='anzsrc-seo' or ./@type='anzsrc-toa'">
            <li><a  class="forfourFilter" id="{.}"><xsl:attribute name="href">/m/search?subject=<xsl:value-of select="."/></xsl:attribute><xsl:value-of select="."/></a></li>
        </xsl:if>
        <xsl:if test="./@type != 'anzsrc-for' and ./@type != 'anzsrc-seo' and ./@type!='anzsrc-toa'">
            <li><a  class="forfourFilter" id="{.}"><xsl:attribute name="href">/m/search?subject=<xsl:value-of select="."/></xsl:attribute><xsl:value-of select="."/></a></li>
        </xsl:if>  
    </xsl:template>

   <xsl:template match="ro:relatedInfo">
        <p>
            <xsl:choose>
            	<xsl:when test="./ro:title">
            		<xsl:choose>
            			<xsl:when test="./ro:identifier/@type='url' or ./ro:identifier/@type='uri' or ./ro:identifier/@type='purl'">
                   				<a><xsl:attribute name="href"><xsl:value-of select="./ro:identifier"/></xsl:attribute><xsl:value-of select="./ro:title"/></a><br />
            			</xsl:when>
            			<xsl:otherwise>
                              <xsl:value-of select="./ro:title"/> <br />
                    		<xsl:value-of select="./ro:identifier/@type"/>: <xsl:value-of select="./ro:identifier"/><br />
            			</xsl:otherwise>
            		</xsl:choose>
            	</xsl:when>
            	<xsl:otherwise>
            		<xsl:choose>
             			<xsl:when test="./ro:identifier/@type='url' or ./ro:identifier/@type='uri' or ./ro:identifier/@type='purl'">
                   				<a><xsl:attribute name="href"><xsl:value-of select="./ro:identifier"/></xsl:attribute><xsl:value-of select="./ro:identifier"/></a><br />
            			</xsl:when>
            			<xsl:otherwise>
                    		<xsl:value-of select="./ro:identifier/@type"/>: <xsl:value-of select="./ro:identifier"/><br />
            			</xsl:otherwise>
            		</xsl:choose>
           	 	</xsl:otherwise>
           	 </xsl:choose>


            <xsl:if test="./ro:notes">
                    <xsl:apply-templates select="./ro:notes"/>
            </xsl:if>
        </p>
    </xsl:template>


    <xsl:template match="ro:citationInfo/ro:fullCitation">
        <p><xsl:value-of select="."/></p>
        <span class="Z3988">
        <xsl:attribute name="title">
        <xsl:text>ctx_ver=Z39.88-2004</xsl:text>
        <xsl:text>&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc</xsl:text>
        <xsl:text>&amp;rfr_id=info%3Asid%2FTERN</xsl:text>
        <xsl:text>&amp;rft.title=</xsl:text><xsl:value-of select="//ro:displayTitle"/>
        <xsl:text>&amp;rft.description=</xsl:text><xsl:value-of select="."/>
        </xsl:attribute>
        </span>
                <span class="Z3988">
        </span>
    </xsl:template>

    <xsl:template match="ro:citationInfo/ro:citationMetadata">
     <p>
        <xsl:if test="./ro:contributor">
            <xsl:apply-templates select="ro:contributor"/>
        </xsl:if>
        <xsl:if test="./ro:date">
        (
            <xsl:apply-templates select="//ro:citationMetadata/ro:date"/>
        )
        </xsl:if>
        <xsl:if test="./ro:title != ''">
            <xsl:text> </xsl:text>
            <xsl:value-of select="./ro:title"/>.
        </xsl:if>
        <xsl:if test="./ro:edition != ''">
            <xsl:text> </xsl:text>
            <xsl:value-of select="./ro:edition"/>.
        </xsl:if>
        <xsl:if test="./ro:placePublished != ''">
            <xsl:text> </xsl:text>
            <xsl:value-of select="./ro:placePublished"/>.
        </xsl:if>
        <xsl:if test="./ro:url != ''">
            <xsl:text> </xsl:text>
            <xsl:value-of select="./ro:url"/>
        </xsl:if>
        <xsl:if test="./ro:context != ''">
            <xsl:text> </xsl:text>
            , <xsl:value-of select="./ro:context"/>
        </xsl:if>
        <xsl:if test="./ro:identifier != ''">
            <xsl:text> </xsl:text>
            , <xsl:value-of select="./ro:identifier"/>.
        </xsl:if>
     	</p>
     	<span class="Z3988">
        	<xsl:attribute name="title">
        	<xsl:text>ctx_ver=Z39.88-2004</xsl:text>
        	<xsl:text>&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc</xsl:text>
        	<xsl:text>&amp;rfr_id=info%3Asid%2FTERN</xsl:text>
        	<xsl:text>&amp;rft.contributor=</xsl:text><xsl:apply-templates select="ro:contributor"/>
        	<xsl:text>&amp;rft.title=</xsl:text><xsl:value-of select="./ro:title"/>
        	<xsl:text>&amp;rft.place=</xsl:text><xsl:value-of select="./ro:placePublished"/>
        	<xsl:text>&amp;rft_id=</xsl:text><xsl:value-of select="./ro:url"/>
        	<xsl:text>&amp;rft.edition=</xsl:text><xsl:value-of select="./ro:edition"/>.
        	<xsl:text>&amp;rft.description=</xsl:text><xsl:value-of select="./ro:context"/>
        	</xsl:attribute>
    	</span>
    	<span class="Z3988">
    	</span>
    </xsl:template>

    <xsl:template match="ro:contributor">
        <xsl:if test="./ro:namePart/@type='family'">
            <xsl:value-of select="./ro:namePart[@type='family']"/>,
        </xsl:if>
        <xsl:if test="./ro:namePart/@type='given'">
            <xsl:value-of select="./ro:namePart[@type='given']"/>.
        </xsl:if>
                <xsl:if test="./ro:namePart/@type='initial' and not(./ro:namePart/@type='given')">
            <xsl:value-of select="./ro:namePart[@type='initial']"/>.
        </xsl:if>
    </xsl:template>

    <xsl:template match="//ro:citationInfo/ro:citationMetadata/ro:date">
        <xsl:if test="position()>1">
            <xsl:text>,</xsl:text>
        </xsl:if>
        <xsl:value-of select="."/>
    </xsl:template>

	<xsl:template match="ro:location/ro:address/ro:electronic">
		<xsl:if test="./@type='url'">
		<xsl:variable name="url">

		<xsl:choose>
		<xsl:when test="string-length(.)>30">
		<xsl:value-of select="substring(.,0,30)"/>...
		</xsl:when>
		<xsl:otherwise>
		<xsl:value-of select="."/>
		</xsl:otherwise>
		</xsl:choose>
		</xsl:variable>
			<li><a ><xsl:attribute name="class">ui-btn-active</xsl:attribute><xsl:attribute name="href"><xsl:value-of select="."/></xsl:attribute><xsl:attribute name="target">_blank</xsl:attribute>Go to Source</a></li>
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

	<xsl:template match="ro:description" mode="right">
			<p class="rights"><xsl:value-of select="."/></p>
	</xsl:template>

	<xsl:template match="ro:description" mode="content">
       
        <div><xsl:attribute name="class"><xsl:value-of select="@type"/></xsl:attribute>
           <p><xsl:value-of select="."/></p>
        </div>
	</xsl:template>



	<xsl:template match="ro:location/ro:address/ro:electronic/@type">
		<xsl:if test=".='email'">
	  		<xsl:value-of select=".."/><br />
		</xsl:if>
	</xsl:template>

</xsl:stylesheet>
