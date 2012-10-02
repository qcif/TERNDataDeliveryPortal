<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" 
    exclude-result-prefixes="ro" xmlns:custom="http://youdomain.ext/custom">
    <xsl:output method="html" encoding="UTF-8" indent="no" omit-xml-declaration="yes"/>

 <xsl:strip-space elements="*"/>
    <xsl:param name="dataSource" select="//ro:originatingSource"/>
    <xsl:param name="dateCreated"/>
    <xsl:param name="date_pub"/> 
    <xsl:param name="date_mod"/>
   <xsl:param name="base_url"/>  
    
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
                <xsl:when test="string-length(/ro:collection/ro:name/ro:namePart)>30">
                    <xsl:value-of select="substring(/ro:collection/ro:name/ro:namePart,0,30)"/>...
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="/ro:collection/ro:name/ro:namePart"/>
                </xsl:otherwise>
                </xsl:choose>
            </xsl:variable>	
		<!--  the following hidden elements dfine content to be used in further ajax calls --> 
        <div id="group_value" class="hide"><xsl:value-of select="@group"/></div>
        <div id="datasource_key" class="hide"><xsl:value-of select="@originatingSource"/></div>
        <div id="key_value" class="hide"></div>
        <div id="page_name" class="hide">View</div>
         <div id="class" class="hide"><xsl:value-of select="$objectClass"/></div>       
        <span id="key" class="hide"><xsl:value-of select="ro:key"/></span>
    
        <xsl:apply-templates select="ro:collection | ro:activity | ro:party | ro:service"/>
    
    </xsl:template>

    <xsl:template match="ro:collection | ro:activity | ro:service">
      	<div id="item-view-inner" class="clearfix" itemscope="" itemType="http://schema.org/Thing">
	<div id="left">           
 <!--Title--> 
        <xsl:choose>
            <xsl:when test="ro:displayTitle!=''">
            <xsl:apply-templates select="ro:displayTitle"/>
            </xsl:when>
            <xsl:when test="ro:name[@type = 'primary']">
            <xsl:apply-templates select="ro:name[@type = 'primary']"/>
            <xsl:apply-templates select="ro:name[@type = 'alternative']"/>
            </xsl:when>
            <xsl:when test="ro:name">
            <xsl:apply-templates select="ro:name[@type != 'alternative']"/>
            <xsl:apply-templates select="ro:name[@type = 'alternative']"/>
            </xsl:when>
        </xsl:choose> 

	    <xsl:apply-templates select="ro:description[@type = 'logo']"/>

            <div class="clearfix"></div>
        
        <xsl:apply-templates select="ro:name[@type='alternative']/ro:displayTitle"/>

<!-- Author -->
<xsl:choose>
    <xsl:when test="ro:relatedObject/ro:relation[@type='author']">
       <h2>Author</h2><xsl:apply-templates select="ro:relatedObject/ro:relation[@type='author']"/>   
    </xsl:when>
    <xsl:otherwise>
       <h2>Author</h2>Not provided 
    </xsl:otherwise>
</xsl:choose>

<!--Organisation -->
    <xsl:if test="ro:relatedObject/ro:relation[@type='distributor']">
       <h2>Organisation</h2><xsl:apply-templates select="ro:relatedObject/ro:relation[@type='distributor']"/>   
    </xsl:if>

<!--Description -->
        <xsl:if test="ro:description">
            <div class="descriptions" style="position:relative;clear:both;" itemprop="descriptions">
                <h2>Description</h2>
				<xsl:apply-templates select="ro:description[@type= 'brief']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'full']" mode="content"/>
				<xsl:apply-templates select="ro:description[@type= 'significanceStatement']" mode="content"/>		
				<xsl:apply-templates select="ro:description[@type= 'notes']" mode="content"/>	
				<xsl:apply-templates select="ro:description[not(@type =  'notes' or @type =  'significanceStatement' or @type =  'full' or @type =  'brief' or @type =  'logo' or @type =  'rights' or @type =  'accessRights')]" mode="content"/>											
				
            </div>
        </xsl:if>


              <div style="position:relative;clear:both" class="subjects" > 
                    <h2>Dates</h2>
              </div>
              <div>
                  <table cellspacing="0" border="0">
                      <col width="200"/>
                      <tr>
                          <td><h3>Temporal Coverage</h3></td>
                          <xsl:if test="../ro:collection[@dateModified]">
                            <td><h3>Date modified</h3></td>
                          </xsl:if>
                      </tr>
                      <tr>
                          <td>
                               <xsl:choose>
                                    <xsl:when test="ro:coverage/ro:temporal/ro:date">
                                        <xsl:apply-templates select="ro:coverage/ro:temporal/ro:date"/>
                                    </xsl:when>
                                    <xsl:when test="ro:location[@dateFrom!=''] | ro:location[@dateTo!='']">
                                       <xsl:apply-templates select="ro:location[@dateFrom!=''] | ro:location[@dateTo!='']"/>
                                    </xsl:when>
                                    <xsl:when test="ro:coverage/ro:temporal/ro:text">
                                        <xsl:apply-templates select="ro:coverage/ro:temporal/ro:text"/>
                                    </xsl:when>  
                                    <xsl:otherwise>
                                        Not provided
                                    </xsl:otherwise>
                                </xsl:choose>
                          </td>

                          <xsl:if test="../ro:collection[@dateModified]">
                          <td>
                               <xsl:value-of select="./@dateModified"/> 
                          </td>
                         </xsl:if>
                      </tr> 
                  </table>
              </div>

        <xsl:choose>
<!--Rights and licencing-->
            <xsl:when test="ro:rights/ro:accessrights or ro:rights/ro:licence or ro:rights/ro:rightsStatement or ro:rights/ro:accessRights or ro:description[@type='rights'] or ro:rights or ro:description[@type='licence']">  
 
                <h2>Rights and Licenceing</h2>         
                <xsl:apply-templates select="ro:rights/ro:accessrights | ro:rights/ro:licence | ro:rights/ro:rightsStatement | ro:rights/ro:accessRights | ro:description[@type='rights'] | ro:rights | ro:description[@type='licence']"/>

            </xsl:when>
            <xsl:otherwise>
                <h2>Rights and Licences</h2>            
                   not provided
            </xsl:otherwise>
  
        </xsl:choose>
        
   <!--Data quality infomation -->          
        <xsl:choose>

            <xsl:when test="ro:relatedInfo[@type='dataQualityInformation']">  
 
                <h2>Data quality information</h2>            
                    <xsl:apply-templates select="ro:relatedInfo[@type='dataQualityInformation']"/>
  
            </xsl:when>
            <xsl:otherwise>
                <h2>Data quality information</h2>            
                   not provided
            </xsl:otherwise>
  
        </xsl:choose>
 
 <!--Data Type -->
        <xsl:choose>

            <xsl:when test="//ro:collection">   
                <h2>Data Type</h2>            
                    <xsl:value-of select="./@type"/>  
            </xsl:when>
            <xsl:when test="//ro:party">   
                <h2>Data Type</h2>            
                    <xsl:value-of select="./@type"/>  
            </xsl:when>
            <xsl:when test="//ro:activity">   
                <h2>Data Type</h2>            
                    <xsl:value-of select="./@type"/>  
            </xsl:when>
            <xsl:when test="//ro:service">   
                <h2>Data Type</h2>            
                    <xsl:value-of select="./@type"/>  
            </xsl:when>            
            <xsl:otherwise>
                <h2>Data Type</h2>            
                   Not provided
            </xsl:otherwise>
  
        </xsl:choose>        
  
  <!-- Access Data-->            
        <h2>Access Data</h2>
        This data can be accessed from the following websites
        <xsl:if test="ro:location/ro:address/ro:electronic">
        <p><xsl:apply-templates select="ro:location/ro:address/ro:electronic"/></p>              
        </xsl:if>
<!--Spatial Coverage -->
<xsl:choose>
    <xsl:when test="ro:coverage or ro:location/ro:spatial">
        <div class="right-box">  

 <h2>Spatial Coverage</h2>
            <xsl:variable name="needMap">
                <xsl:for-each select="ro:coverage/ro:spatial">
                <xsl:if test="not(./@type) or (./@type!='text' and ./@type!='dcmiPoint')">
                      <xsl:text>yes</xsl:text>
               </xsl:if>
               </xsl:for-each>

              <xsl:for-each select="ro:location/ro:spatial">
              <xsl:if test="not(./@type) or (./@type!='text' and ./@type!='dcmiPoint')">
                      <xsl:text>yes</xsl:text>
               </xsl:if>
               </xsl:for-each>
         </xsl:variable>
        
            <xsl:if test="ro:coverage/ro:spatial | ro:location/ro:spatial">
              <xsl:apply-templates select="ro:coverage/ro:spatial | ro:location/ro:spatial"/>
              <xsl:if test="$needMap!=''">
                    <div id="spatial_coverage_map"></div>
              </xsl:if>
            </xsl:if>
                    
            <xsl:if test="ro:coverage/ro:center ">
                <xsl:apply-templates select="ro:coverage/ro:center "/>
            </xsl:if>
            
            <xsl:for-each select="ro:coverage/ro:spatial[@type!='iso19139dcmiBox' and @type!='gmlKmlPolyCoords' and @type!='kmlPolyCoords']">
      <p class="coverage_text"><xsl:value-of select="./@type"/>: <xsl:value-of select="."/></p>
       </xsl:for-each>

  </div> 
</xsl:when>
<xsl:otherwise>
  <div class="right-box"><h2>Spatial Coverage</h2></div>
  Not provided
</xsl:otherwise>
</xsl:choose>



<!--Citation and Identifier -->        
  <xsl:choose>
            <xsl:when test="ro:citationInfo or ro:identifier[not(@type = 'local')]">
  <div class="right-box">  
                    <h2>Citation and identifier</h2>    
              
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
                        <xsl:text>&amp;rft.title=</xsl:text><xsl:value-of select="//ro:display_title"/>
                        <xsl:text>&amp;rft.description=</xsl:text><xsl:value-of select="//ro:display_title"/>

                        </xsl:attribute>
                        </span><span class="Z3988"></span>      
                    </xsl:otherwise>                        
                </xsl:choose>   
                </div>

        <xsl:if test="ro:identifier[not(@type = 'local')]">
           
                <div style="position:relative;clear:both;">
                    <b>Identifier</b>
                </div>     
           	<div id="identifiers" class="padding5">  
                    <p> 	
                    <xsl:apply-templates select="ro:identifier[@type='doi']" mode = "doi"/>
                    <xsl:apply-templates select="ro:identifier[@type='ark']" mode = "ark"/>    	
                    <xsl:apply-templates select="ro:identifier[@type='AU-ANL:PEAU']" mode = "nla"/>  
                    <xsl:apply-templates select="ro:identifier[@type='handle']" mode = "handle"/>   
                    <xsl:apply-templates select="ro:identifier[@type='purl']" mode = "purl"/>
                    <xsl:apply-templates select="ro:identifier[@type='uri']" mode = "uri"/> 
                    <xsl:apply-templates select="ro:identifier[not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri' or @type='local')]" mode="other"/>											   	
                    </p>
	       </div>  

        </xsl:if>
 </div>         
 </xsl:when>

  </xsl:choose>          
   
   
   
 <xsl:choose>
 <xsl:when test="ro:subject"> 
    <div class="right-box">            
              <div style="position:relative;clear:both" class="subjects" >
                <h2>Subjects</h2>

              </div>  
 
            <xsl:if test="ro:subject/@type='anzsrc-for' or ro:subject/@type='anzsrc-seo' or ro:subject/@type='anzsrc-toa'">

                <div class="padding5"><b>ANZSRC</b></div>
                <ul class="subjects">
                <xsl:for-each select="ro:subject">      
                    <xsl:sort select="./@type"/>
                    <xsl:if test="@type='anzsrc-for' or @type='anzsrc-seo' or @type='anzsrc-toa'">
                        <xsl:apply-templates select="."/>
                    </xsl:if>
                </xsl:for-each>
                </ul>
            </xsl:if>
                
                <xsl:if test="ro:subject[not(@type = 'anzsrc-for' or  @type = 'anzsrc-seo' or  @type = 'anzsrc-toa')]">
                   <div   class="padding5"><b>Keywords</b></div>
                    <ul class="subjects">
                        <xsl:for-each select="ro:subject">      
                            <xsl:sort select="./@type"/>
                            <xsl:if test="@type!='anzsrc-for'and @type!='anzsrc-seo' and @type!='anzsrc-toa'">
                                <xsl:apply-templates select="."/>
                            </xsl:if>
                        </xsl:for-each>
                    </ul>
                </xsl:if> 
              
 
               <a href="javascript:void(0);" class="showall_subjects hide">More...</a>
     
    </div>  
</xsl:when> 
<xsl:otherwise>
    <div class="right-box">            
              <div style="position:relative;clear:both" class="subjects" >
                    <h2>Subjects</h2>
                    Not provided
              </div>  
    
    </div>      
</xsl:otherwise>
</xsl:choose>           
                    
	        
        <div class="right-box" id="connectionsRightBox">
		<div id="connectionsInfoBox"></div>
			<h2>Additional Information</h2>                        
			<div id="connections" class="padding5">
				<img>
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/><xsl:text>/img/ajax-loader.gif</xsl:text></xsl:attribute>
				<xsl:attribute name="class">loading-icon</xsl:attribute>
				<xsl:attribute name="alt">Loading…</xsl:attribute>
				</img>
			</div>
                       
	</div>	
			
								
        <xsl:if test="$objectClass='Collection'">
                <div class="right-box" id="seeAlsoRightBox">
                <div id="infoBox" class="hide"></div>
                <h2>Related datasets</h2>
                <div id="seeAlso"  class="padding5">
                        <img>
                        <xsl:attribute name="src"><xsl:value-of select="$base_url"/><xsl:text>/img/ajax-loader.gif</xsl:text></xsl:attribute>
                        <xsl:attribute name="class">loading-icon</xsl:attribute>
                        <xsl:attribute name="alt">Loading…</xsl:attribute>
                        </img>
                </div>
                </div>
        </xsl:if>

        <xsl:if test="$objectClass='Party'">
                <div class="right-box" id="seeAlso-Identifier">
                <div id="infoBox" class="hide"></div>
                <h2>Related datasets</h2>
                <div id="seeAlso-IdentifierBox"  class="padding5">
                        <img>
                        <xsl:attribute name="src"><xsl:value-of select="$base_url"/><xsl:text>/img/ajax-loader.gif</xsl:text></xsl:attribute>
                        <xsl:attribute name="class">loading-icon</xsl:attribute>
                        <xsl:attribute name="alt">Loading…</xsl:attribute>
                        </img>
                </div>
                </div>
        </xsl:if>                   
   
   </div>
    
        <!--  we will now transform the rights handside stuff -->
  	<div id="right">
             <div class="right-box">
                <a href="javascript:window.print()">Print This Page</a>
            </div>
            <xsl:choose>
	       <xsl:when test="ro:location/ro:address/ro:electronic/@type='url' 
		or ro:rights or ro:location/ro:address/ro:electronic/@type='email'  or ro:location/ro:address/ro:physical">	
                    <xsl:choose>
  		 	<xsl:when test="ro:location/ro:address/ro:electronic/@type='url'">
                                    <div class="right-box">
                                        <h2>Access Data</h2>    
                                        <ul style="padding-left:3px">
                                        <p><xsl:apply-templates select="ro:location/ro:address/ro:electronic"/></p>	
                                        </ul>

                                    </div>
                         </xsl:when>
                         <xsl:otherwise>
                                    <div class="right-box">
                                        <h2>Access Data</h2>    
                                            Not provided
                                    </div>
                         </xsl:otherwise>
                    </xsl:choose>
                   
	    </xsl:when>	
            <xsl:otherwise>
                   <div class="right-box">
                    <h2>Access Data</h2>    
                    Not provided
                </div>        
            </xsl:otherwise>
            
            </xsl:choose>             	
            
                         
<!--Contact details --> 
  
          <xsl:choose>
            <xsl:when test="ro:location/ro:address/ro:electronic/@type='email' or ro:location/ro:address/ro:physical">
                <div class="right-box">
                        <h2>Contacts</h2>

                        <xsl:if test="ro:location/ro:address/ro:electronic/@type='email'">
                                <p style="margin-top:1px;margin-bottom:1px;margin-left:3px"><xsl:apply-templates select="ro:location/ro:address/ro:electronic/@type"/></p>	
                        </xsl:if>
                        <xsl:if test="ro:location/ro:address/ro:physical/@type='telephoneNumber'">
                                <p style="margin-top:1px;margin-bottom:1px;margin-left:3px"><xsl:apply-templates select="ro:location/ro:address/ro:physical"/></p>	
                        </xsl:if>				
                        <xsl:if test="ro:location/ro:address/ro:physical">
                                <p style="margin-top:1px;margin-bottom:1px;margin-left:3px"><xsl:apply-templates select="ro:location/ro:address/ro:physical"/></p>	
                        </xsl:if>

               </div>
             </xsl:when>

             <xsl:otherwise>
                 <div class="right-box">
                        <h2>Contacts</h2>
                        Not provided
               </div>
             </xsl:otherwise>
        </xsl:choose>
	</div>
  </div>              				
        
</xsl:template>

<!--  the following templates will format the view page content -->

    <xsl:template match="ro:displayTitle">
        <div id="displaytitle">
         <h1><xsl:value-of select="."/></h1>
            <div class="clearfix"></div>
         </div>
    </xsl:template>
    
    <xsl:template match="ro:relatedObject">
    <xsl:if test="ro:key != ''">
     <li>
        <xsl:variable name="url" select="concat($orca_view, 'services/getRegistryObjectsSOLR.php?task=getTitle&amp;relatedKey=',ro:key)"/>
         <xsl:variable name="draftTitle" select="document($url)/draft/title"/>
         <xsl:variable name="recordTitle" select="document($url)/record"/>
         <xsl:variable name="relation">
         <xsl:for-each select="ro:relation/@type">
    <xsl:choose>	
    <xsl:when test="position()=1">	
    <xsl:value-of select="."/>
    </xsl:when>
    <xsl:otherwise>
    , <xsl:value-of select="."/>
    </xsl:otherwise>
    </xsl:choose>
         </xsl:for-each>
         </xsl:variable>
          <xsl:variable name="relDescription" >
            <xsl:if test="ro:relation/ro:description!=''">
            <xsl:value-of select= "ro:relation/ro:description"/>
            </xsl:if>
          </xsl:variable>
    <xsl:choose>
    <xsl:when test="$draftTitle != ''">
    <xsl:variable name="ds" select="document($url)/draft/ds"/>	
    <a href="{$base_url}preview/?key={ro:key}&amp;ds={$ds}" title="{$relation}" class="tipme">
    <xsl:value-of select="$draftTitle"/>
    </a>
    </xsl:when>

    <xsl:when test="$recordTitle != ''">
    <a href="{$base_url}view/?key={ro:key}" title="{$relation}" class="tipme">
    <xsl:value-of select="$recordTitle"/>
    </a>
    </xsl:when>

    <xsl:otherwise>
    <xsl:value-of select="ro:key"/>
    </xsl:otherwise>
    </xsl:choose>	
    <xsl:if test="$relDescription != '' ">
    <xsl:if test="string-length($relDescription)&lt;64">
    <br /><span class='faded'><xsl:value-of select="$relDescription"/></span>
    </xsl:if>
    </xsl:if>	
</li>
</xsl:if>
    </xsl:template>
      
    
    <xsl:template match="ro:name[@type != 'alternative']">
            <div id="displaytitle">
                <h1>
                    <xsl:choose>
                    <xsl:when test="$objectClass = 'Party'">
                    <xsl:apply-templates select="ro:namePart[@type = 'title']"/>	
                    <xsl:apply-templates select="ro:namePart[@type = 'given']"/>	
                    <xsl:apply-templates select="ro:namePart[@type = 'initial']"/>	
                    <xsl:apply-templates select="ro:namePart[@type = 'family']"/>	
                    <xsl:apply-templates select="ro:namePart[@type = 'suffix']"/>
                    <xsl:apply-templates select="ro:namePart[@type != 'title' and @type != 'given' and @type != 'initial' and @type != 'family' and @type != 'suffix']"/>	
                    </xsl:when>
                    <xsl:otherwise>
                    <xsl:apply-templates select="ro:namePart"/>
                    </xsl:otherwise>
                    </xsl:choose>
                </h1>

                </div>

<div class="clearfix"/>

    </xsl:template>
    
    
    
    <xsl:template match="ro:name[@type = 'alternative']">
     <p class="alt_displayTitle">
      <xsl:choose>
            <xsl:when test="$objectClass = 'Party'">
            <xsl:apply-templates select="ro:namePart[@type = 'title']"/>	
            <xsl:apply-templates select="ro:namePart[@type = 'given']"/>	
            <xsl:apply-templates select="ro:namePart[@type = 'initial']"/>	
            <xsl:apply-templates select="ro:namePart[@type = 'family']"/>	
            <xsl:apply-templates select="ro:namePart[@type = 'suffix']"/>
            <xsl:apply-templates select="ro:namePart[@type != 'title' and @type != 'given' and @type != 'initial' and @type != 'family' and @type != 'suffix']"/>	
            </xsl:when>
            <xsl:otherwise>
            <xsl:apply-templates select="ro:namePart"/>
            </xsl:otherwise>
      </xsl:choose>
     </p>
    </xsl:template>
    
    <xsl:template match="ro:namePart">
      <xsl:text> </xsl:text><xsl:value-of select="."/>
    </xsl:template>
    
    <xsl:template match="ro:description[@type = 'logo']">
        <div id="displaylogo"><img id="party_logo" style="max-width:130px;">
            <xsl:attribute name="src"><xsl:value-of select="."/></xsl:attribute>
            </img>
        </div>
    </xsl:template>
  
  <xsl:template match="ro:identifier" mode="ark">
ARK:
       <xsl:variable name="theidentifier">
     <xsl:choose>	
     <xsl:when test="string-length(substring-after(.,'http://'))>0">
     <xsl:value-of select="(substring-after(.,'http://'))"/>
     </xsl:when>	

     <xsl:otherwise>
<xsl:value-of select="."/>
     </xsl:otherwise>	
     </xsl:choose>
  </xsl:variable>
  <xsl:if test="string-length(substring-after(.,'/ark:/'))>0">
     <a>
     <xsl:attribute name="href"><xsl:text>http://</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
     <xsl:attribute name="title"><xsl:text>Resolve this ARK identifier</xsl:text></xsl:attribute>
     <xsl:value-of select="."/>
     </a>
     </xsl:if>
     <xsl:if test="string-length(substring-after(.,'/ark:/'))&lt;1">
     <xsl:value-of select="."/>
     </xsl:if>
     <br />	
    </xsl:template>
 <xsl:template match="ro:identifier" mode="nla">
 NLA:
        <xsl:variable name="theidentifier">
     <xsl:choose>	
     <xsl:when test="string-length(substring-after(.,'nla.gov.au/'))>0">
     <xsl:value-of select="substring-after(.,'nla.gov.au/')"/>
     </xsl:when>	
     <xsl:otherwise>
     <xsl:value-of select="."/>
     </xsl:otherwise>	
     </xsl:choose>
  </xsl:variable>
  <xsl:if test="string-length(substring-after(.,'nla.party'))>0">	
     <a>
     <xsl:attribute name="href"><xsl:text>http://nla.gov.au/</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
     <xsl:attribute name="title"><xsl:text>View the record for this party in Trove</xsl:text></xsl:attribute>
     <xsl:value-of select="."/>
     </a> <br />
   </xsl:if>
   <xsl:if test="string-length(substring-after(.,'nla.party'))&lt;1">	

     <xsl:value-of select="."/>
     <br />
   </xsl:if>
 </xsl:template>
 <xsl:template match="ro:identifier" mode="doi">
DOI:
         <xsl:variable name="theidentifier">
     <xsl:choose>	
     <xsl:when test="string-length(substring-after(.,'doi.org/'))>0">
     <xsl:value-of select="substring-after(.,'doi.org/')"/>
     </xsl:when>	
     <xsl:otherwise>
     <xsl:value-of select="."/>
     </xsl:otherwise>	
     </xsl:choose>
  </xsl:variable>
   <xsl:if test="string-length(substring-after(.,'10.'))>0">	
       <a>
     <xsl:attribute name="href"><xsl:text>http://dx.doi.org/</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
     <xsl:attribute name="title"><xsl:text>Resolve this DOI</xsl:text></xsl:attribute>
     <xsl:value-of select="."/>
     </a> <br />
   </xsl:if>
   <xsl:if test="string-length(substring-after(.,'10.'))&lt;1">	
   
     <xsl:value-of select="."/>
     <br />
   </xsl:if>

    
 </xsl:template>
 <xsl:template match="ro:identifier" mode="handle">
Handle:
       <xsl:variable name="theidentifier">
     <xsl:choose>
      <xsl:when test="string-length(substring-after(.,'hdl:'))>0">
     <xsl:text>http://hdl.handle.net/</xsl:text><xsl:value-of select="substring-after(.,'hdl:')"/>
     </xsl:when>
       <xsl:when test="string-length(substring-after(.,'hdl.handle.net/'))>0">
     <xsl:text>http://hdl.handle.net/</xsl:text><xsl:value-of select="substring-after(.,'hdl.handle.net/')"/>
     </xsl:when>
     <xsl:when test="string-length(substring-after(.,'http:'))>0">
     <xsl:text></xsl:text><xsl:value-of select="."/>
     </xsl:when>
     <xsl:otherwise>
     <xsl:text>http://hdl.handle.net/</xsl:text><xsl:value-of select="."/>
     </xsl:otherwise>	
     </xsl:choose>
  </xsl:variable>
    
     <a>
     <xsl:attribute name="href"> <xsl:value-of select="$theidentifier"/></xsl:attribute>
     <xsl:attribute name="title"><xsl:text>Resolve this handle</xsl:text></xsl:attribute>
     <xsl:value-of select="."/>
     </a>
     <br />
 </xsl:template>
 <xsl:template match="ro:identifier" mode="purl">
  PURL:
    <xsl:variable name="theidentifier">
    <xsl:choose>	
     <xsl:when test="string-length(substring-after(.,'purl.org/'))>0">
     <xsl:value-of select="substring-after(.,'purl.org/')"/>
     </xsl:when>	
     <xsl:otherwise>
     <xsl:value-of select="."/>
     </xsl:otherwise>	
    </xsl:choose>
  </xsl:variable>
    <a>
    <xsl:attribute name="href"><xsl:text>http://purl.org/</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
    <xsl:attribute name="title"><xsl:text>Resolve this purl identifier</xsl:text></xsl:attribute>
    <xsl:value-of select="."/>
    </a>
     <br />
  </xsl:template>
  <xsl:template match="ro:identifier" mode="uri">
  URI:
   <xsl:variable name="theidentifier">
    <xsl:choose>	
     <xsl:when test="string-length(substring-after(.,'http'))>0">
     <xsl:value-of select="."/>
     </xsl:when>	
     <xsl:otherwise>
     http://<xsl:value-of select="."/>
     </xsl:otherwise>	
    </xsl:choose>
  </xsl:variable>
    <a>
    <xsl:attribute name="href"><xsl:value-of select="$theidentifier"/></xsl:attribute>
    <xsl:attribute name="title"><xsl:text>Resolve this uri</xsl:text></xsl:attribute>
    <xsl:value-of select="."/>
    </a>
    <br />
  </xsl:template>
 <xsl:template match="ro:identifier" mode="other">
   <!-- <xsl:attribute name="name"><xsl:value-of select="./@type"/></xsl:attribute> -->
   <xsl:choose>
   <xsl:when test="./@type='arc' or ./@type='abn' or ./@type='isil'">
  <xsl:value-of select="translate(./@type,'abcdefghijklmnopqrstuvwxyz','ABCDEFGHIJKLMNOPQRSTUVWXYZ')"/>: <xsl:value-of select="."/>
   </xsl:when>
    <xsl:when test="./@type='local'">
  Local: <xsl:value-of select="."/>
   </xsl:when>
   <xsl:otherwise>
<xsl:value-of select="./@type"/>: <xsl:value-of select="."/>
</xsl:otherwise>
</xsl:choose>
<br />
  </xsl:template>

    <xsl:template match="ro:title">
        <xsl:value-of select="."/><br />
    </xsl:template>

    <xsl:template match="ro:relatedInfo/ro:notes">
        <xsl:value-of select="."/><br />
    </xsl:template>
    
    <xsl:template match="ro:spatial">
      <xsl:if test="not(./@type) or (./@type!= 'text' and ./@type!= 'dcmiPoint')">
       <p class="coverage" name="{@type}"><xsl:value-of select="."/></p>
      </xsl:if>
      <xsl:if test="./@type= 'text' or ./@type= 'dcmiPoint'">
      <p class="coverage_text"><xsl:value-of select="./@type"/>: <xsl:value-of select="."/></p>
      </xsl:if>
    </xsl:template>
    
    <xsl:template match="ro:center">
        <p class="spatial_coverage_center"><xsl:value-of select="."/></p>
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
    <xsl:template match="ro:text">
     
        <xsl:value-of select="."/>
    </xsl:template>
    <xsl:template match="ro:subject">
        <xsl:if test="./@type='anzsrc-for' or ./@type='anzsrc-seo' or ./@type='anzsrc-toa'">
        <!-- xsl:variable name="subject" select="."/>
<xsl:variable name="url" select="concat($orca_home, '/services/getRegistryObjectsSOLR.php?subject=',$subject, '&amp;vocab=',@type)"/>
<xsl:variable name="resolvedName" select="document($url)/subject"/-->
<li><a href="javascript:void(0);" class="{@type}" id="{.}"><xsl:value-of select="."/></a></li>
        </xsl:if>
        <xsl:if test="./@type != 'anzsrc-for' and ./@type != 'anzsrc-seo' and ./@type!='anzsrc-toa'">
            <li><a href="javascript:void(0);" id="{.}"><xsl:value-of select="."/></a></li>
        </xsl:if>
    </xsl:template>
 
 <xsl:template match="ro:relatedInfo[@type='dataQualityInformation']">
    <xsl:value-of select="./ro:notes"/><br /> 
 </xsl:template>

    <xsl:template match="ro:relatedInfo">
        <p>
            
            <xsl:if test="./ro:title">
                <xsl:value-of select="./ro:title"/><br />
            </xsl:if>
            <xsl:apply-templates select="./ro:identifier[@type='doi']" mode = "doi"/>
            <xsl:apply-templates select="./ro:identifier[@type='ark']" mode = "ark"/>
            <xsl:apply-templates select="./ro:identifier[@type='AU-ANL:PEAU']" mode = "nla"/>
            <xsl:apply-templates select="./ro:identifier[@type='handle']" mode = "handle"/>
            <xsl:apply-templates select="./ro:identifier[@type='purl']" mode = "purl"/>
            <xsl:apply-templates select="./ro:identifier[@type='uri']" mode = "uri"/>
            <xsl:apply-templates select="./ro:identifier[not(@type = 'doi' or @type = 'ark' or @type = 'AU-ANL:PEAU' or @type = 'handle' or @type = 'purl' or @type = 'uri')]" mode="other"/>	
            
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
                <xsl:text>&amp;rfr_id=info%3Asid%2FANDS</xsl:text>
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
            <xsl:if test="./ro:publisher != ''">
                <xsl:text> </xsl:text>
                <xsl:value-of select="./ro:publisher"/>.
            </xsl:if>
            <xsl:if test="./ro:url != ''">
                <xsl:text> </xsl:text>
                <xsl:value-of select="./ro:url"/>
            </xsl:if>
            <xsl:if test="./ro:context != ''">
                <xsl:text> </xsl:text>
                , <xsl:value-of select="./ro:context"/>
            </xsl:if>
            <xsl:if test="./ro:identifier != ''">,
                <xsl:apply-templates select="./ro:identifier[@type = 'doi']" mode="doi"/>	
                <xsl:apply-templates select="./ro:identifier[@type = 'uri']" mode="uri"/>	
                <xsl:apply-templates select="./ro:identifier[@type = 'URL']" mode="uri"/>	
                <xsl:apply-templates select="./ro:identifier[@type = 'url']" mode="uri"/>	
                <xsl:apply-templates select="./ro:identifier[@type = 'purl']" mode="purl"/>	
                <xsl:apply-templates select="./ro:identifier[@type = 'handle']" mode="handle"/>	
                <xsl:apply-templates select="./ro:identifier[@type = 'AU-ANL:PEAU']" mode="nla"/>
                <xsl:apply-templates select="./ro:identifier[@type = 'ark']" mode="ark"/>
                <xsl:apply-templates select="./ro:identifier[@type != 'doi' and @type != 'uri' and @type != 'URL' and @type != 'url' and @type != 'purl' and @type != 'handle' and @type != 'AU-ANL:PEAU' and @type != 'ark']" mode="other"/>	
            </xsl:if>
        </p>
        <span class="Z3988">
            <xsl:attribute name="title">
                <xsl:text>ctx_ver=Z39.88-2004</xsl:text>
                <xsl:text>&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc</xsl:text>
                <xsl:text>&amp;rfr_id=info%3Asid%2FANDS</xsl:text>
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
            <a><xsl:attribute name="href"><xsl:value-of select="."/></xsl:attribute><xsl:attribute name="target">_blank</xsl:attribute><xsl:value-of select="$url"/></a><br />
        </xsl:if>	
    </xsl:template>
    
    <xsl:template match="ro:location/ro:address/ro:physical">
        <p>
            <xsl:choose>
                <xsl:when test = "./ro:addressPart or ./ro:addressPart!=''">
                    <xsl:apply-templates select="./ro:addressPart[@type='fullname']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='organizationname']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='buildingorpropertyname']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='flatorunitnumber']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='floororlevelnumber']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='lotnumber']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='housenumber']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='streetname']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='postaldeliverynumberprefix']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='postaldeliverynumbervalue']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='postaldeliverynumbersuffix']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='addressline']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='suburborplaceorlocality']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='stateorterritory']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='postcode']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='country']"/>	
                    <xsl:apply-templates select="./ro:addressPart[@type='locationdescriptor']"/>
                    <xsl:apply-templates select="./ro:addressPart[@type='deliverypointidentifier']"/>	
                    <xsl:apply-templates select="./ro:addressPart[not(@type='organizationname' or @type='fullname' or @type='buildingorpropertyname' or @type='flatorunitnumber' or @type='floororlevelnumber' or @type='lotnumber' or @type='housenumber' or @type='streetname' or @type='postaldeliverynumberprefix' or @type='postaldeliverynumbervalue' or @type='postaldeliverynumbersuffix' or @type='addressline' or @type='suburborplaceorlocality' or @type='stateorterritory' or @type='country' or @type='locationdescriptor' or @type='deliverypointidentifier' or @type='postcode')]"/>	
                    <!--xsl:apply-templates select="./ro:addressPart[not(@type='addressLine') or @type!='deliveryPointIdentifier' or @type='locationDescriptor' or @type='country' or @type='stateOrTerritory' or @type='suburbOrPlaceOrLocality' or @type='suburbOrPlaceOrLocality' or @type='addressLine' or @type='postalDeliveryNumberSuffix])"/-->
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="." disable-output-escaping="yes"/><br />	
                </xsl:otherwise>
            </xsl:choose>	
        </p>
    </xsl:template>	
    
    <xsl:template match="ro:addressPart">	
        <xsl:value-of select="." disable-output-escaping="yes"/><br />
    </xsl:template>
    
    
    <xsl:template match="ro:description" mode="content">
        <p>
            <div><xsl:attribute name="class"><xsl:value-of select="@type"/></xsl:attribute>
                <p><xsl:value-of select="." disable-output-escaping="yes"/></p>
            </div>
        </p>
    </xsl:template>
    
    
    
    <xsl:template match="ro:location/ro:address/ro:electronic/@type">	
        <xsl:if test=".='email'">	
            <xsl:value-of select=".."/><br />
        </xsl:if>	
    </xsl:template>
    <xsl:template match="ro:existenceDates">
        <p><xsl:if test="./ro:startDate"><xsl:value-of select="./ro:startDate"/></xsl:if> - <xsl:if test="./ro:endDate"><xsl:value-of select="./ro:endDate"/></xsl:if></p>	
    </xsl:template>	
  
  

    <xsl:template match="ro:relatedObject/ro:relation[@type='author']">
        <xsl:value-of select="../ro:key"/>
    </xsl:template>
    
    <xsl:template match="ro:relatedObject/ro:relation[@type='distributor']">
        <xsl:value-of select="../ro:key"/>
    </xsl:template>
   
    <xsl:template match="ro:rights/ro:accessrights | ro:rights/ro:licence | ro:rights/ro:rightsStatement | ro:rights/ro:accessRights | ro:description[@type='rights'] | ro:rights | ro:description[@type='licence']">
       
            <xsl:value-of select="."/>

    </xsl:template> 
    <xsl:template match="ro:party">
        <xsl:if test="ro:name[@type='primary']">
            <h2>Name:</h2> <xsl:value-of select="./ro:name/ro:namePart" />   
        </xsl:if>
        <xsl:if test="ro:location/ro:address/ro:electronic[@type='email']">
            <h2>Email:</h2> <xsl:value-of select="./ro:location/ro:address/ro:electronic/ro:value" />   
        </xsl:if>
        <xsl:if test="ro:location/ro:address/ro:physical">
            <h2>Address:</h2> <xsl:value-of select="./ro:location/ro:address/ro:physical/ro:addressPart[@type='locationDescriptor']" />
            <h2>Country:</h2><xsl:value-of select="./ro:location/ro:address/ro:physical/ro:addressPart[@type='country']"/>
        </xsl:if>   
        <xsl:if test="ro:relatedObject">
            <h2>Related datasets:</h2><ul><xsl:apply-templates select="ro:relatedObject"/></ul>          
        </xsl:if> 
        
    </xsl:template>
    <xsl:template match="ro:relatedObject">
        <li>
         <xsl:value-of select="./ro:key" />
        </li>
    </xsl:template>       
     
</xsl:stylesheet>
  