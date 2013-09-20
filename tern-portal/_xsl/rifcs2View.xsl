<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ro="http://ands.org.au/standards/rif-cs/registryObjects" xmlns:extRif="http://ands.org.au/standards/rif-cs/extendedRegistryObjects" exclude-result-prefixes="ro" xmlns:custom="http://youdomain.ext/custom">
    <xsl:output method="html" encoding="UTF-8" indent="no" omit-xml-declaration="yes"/>
   <xsl:include href ="ISODateFormat.xsl" /> 
 
<xsl:strip-space elements="*"/>
    <xsl:param name="dataSource" select="//ro:originatingSource"/>
    <xsl:param name="dateCreated"/>
    <xsl:param name="date_pub"/> 
    <xsl:param name="date_modified"/>
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
                <xsl:when test="string-length(/extRif:extendedMetadata/extRif:displayTitle)>30">
                <xsl:value-of select="substring(/extRif:extendedMetadata/extRif:displayTitle,0,30)"/>...
                </xsl:when>
                <xsl:otherwise>
                <xsl:value-of select="/extRif:extendedMetadata/extRif:displayTitle"/>
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
      <!--	<div id="item-view-inner" class="clearfix" itemscope="" itemType="http://schema.org/Thing">-->
	<section id="left" class="left">       
  
  <!--Title -->
    <xsl:choose>
        <xsl:when test="../extRif:extendedMetadata/extRif:displayTitle!=''">
            <xsl:apply-templates select="../extRif:extendedMetadata/extRif:displayTitle"/>            
        </xsl:when>
        <xsl:otherwise>
            <div id="metadataTitle">
                <h1 itemprop="name"><xsl:value-of select="../ro:key"/></h1>
                <xsl:for-each select="//ro:existenceDates">
                    <xsl:if test="./ro:startDate"><xsl:value-of select="./ro:startDate"/></xsl:if>
                        <xsl:if test="./ro:endDate"><xsl:value-of select="./ro:endDate"/></xsl:if><br/>
                </xsl:for-each>
            </div>          
        </xsl:otherwise>
   </xsl:choose> 
   
   <div id="metadataContent">
       <div class="left">
           <!-- Author -->
            <xsl:choose>
                <xsl:when test="ro:relatedObject/ro:relation[@type='author']">
                <p class="authorName">Author name: <xsl:apply-templates select="ro:relatedObject/ro:relation[@type='author']"/></p>  
                </xsl:when>             
            </xsl:choose>
            
            <!--Organisation -->
            <xsl:if test="ro:relatedObject/extRif:relatedObjectType='group'">
                <h2>Organisation</h2><p><xsl:apply-templates select="ro:relatedObject/extRif:relatedObjectType"/></p>   
            </xsl:if>

            <!--Description -->
            <xsl:if test="ro:description">
                    <h2>Description</h2>
				<xsl:apply-templates select="extRif:description[@type= 'brief']" mode="content"/>
				<xsl:apply-templates select="extRif:description[@type= 'full']" mode="content"/>
				<xsl:apply-templates select="extRif:description[@type= 'significanceStatement']" mode="content"/>		
				<xsl:apply-templates select="extRif:description[@type= 'notes']" mode="content"/>	
				<xsl:apply-templates select="extRif:description[not(@type =  'notes' or @type =  'significanceStatement' or @type =  'full' or @type =  'brief' or @type =  'logo' or @type =  'rights' or @type =  'accessRights')]" mode="content"/>															
            </xsl:if>
            
            <!--Temporal coverage-->
            <xsl:choose>
                        <xsl:when test="ro:coverage/ro:temporal/ro:date">
                            <h2>Temporal coverage</h2>
                            <p>
                                <xsl:apply-templates select="ro:coverage/ro:temporal/ro:date"/>
                            </p>
                        </xsl:when>
                        <xsl:when test="ro:location[@dateFrom!=''] | ro:location[@dateTo!='']">
                            <h2>Temporal coverage</h2>
                            <p>    
                                <xsl:apply-templates select="ro:location[@dateFrom!=''] | ro:location[@dateTo!='']"/>
                            </p>    
                        </xsl:when>
                        <xsl:when test="ro:coverage/ro:temporal/ro:text">
                            <h2>Temporal coverage</h2>
                            <p>
                                <xsl:apply-templates select="ro:coverage/ro:temporal/ro:text"/>
                            </p>
                        </xsl:when>  
                        <xsl:otherwise>
                           <h2>Temporal coverage</h2>
                           <p>
                            Not provided
                            </p>
                        </xsl:otherwise>
            </xsl:choose>            
            <!--Dates-->
            <h2>Dates</h2>
            <ul class="datesList">          
            
               <xsl:if test="../extRif:extendedMetadata/extRif:registryDateModified">
                <li>
                    <h3>Date modified</h3>
                    <p>
                                                       
                        
                        <xsl:value-of select="$date_modified"/>
                    </p>  
                </li>
               </xsl:if>
            </ul>       
       </div>
       <div class="right">
            <!--Citation and Identifier -->        
                <xsl:choose>
                    <xsl:when test="ro:citationInfo or ro:identifier[not(@type = 'local')]"> 
                        <h2>Citation and identifier</h2>   
                        <p>
                            <xsl:choose>
                                <xsl:when test="ro:citationInfo/ro:citationMetadata">
                                    <b>How to cite this collection:</b><br />
                                    <xsl:apply-templates select="ro:citationInfo/ro:citationMetadata"/>
                                </xsl:when>
                                <xsl:when test="ro:citationInfo/ro:fullCitation">
                                    <b>How to cite this collection:</b><br />
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
                            <xsl:if test="ro:identifier[not(@type = 'local')]"> 
                                <b>Identifier</b>          	
                                <p> 	
                                    <xsl:apply-templates select="ro:identifier[@type='doi']" mode = "doi"/>
                                    <xsl:apply-templates select="ro:identifier[@type='ark']" mode = "ark"/>    	
                                    <xsl:apply-templates select="ro:identifier[@type='AU-ANL:PEAU']" mode = "nla"/>  
                                    <xsl:apply-templates select="ro:identifier[@type='handle']" mode = "handle"/>   
                                    <xsl:apply-templates select="ro:identifier[@type='purl']" mode = "purl"/>
                                    <xsl:apply-templates select="ro:identifier[@type='uri']" mode = "uri"/> 
                                    <xsl:apply-templates select="ro:identifier[not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri' or @type='local')]" mode="other"/>											   	
                                </p>
                            </xsl:if>
                        </p>       
                    </xsl:when>
                </xsl:choose> 
                <!--Rights and Licencing-->
                  <div class="licensing">
                   <xsl:choose>
                    <xsl:when test="extRif:rights or ro:rights or extRif:rights[@type='licence']">  
                       <h2>Rights and Licensing</h2>            
                            <xsl:apply-templates select="extRif:rights[@type='licence']"/>
                            <xsl:apply-templates select="extRif:rights[@type!='licence']"/>     
                   
                </xsl:when>
                    <xsl:otherwise>
                    <h2>Rights and Licensing</h2>            
                    Not provided
                    </xsl:otherwise>
                 </xsl:choose>
                 </div>
            <!--Data quality infomation -->   
<!--    Hide for demo only        
            <xsl:choose>
                <xsl:when test="ro:relatedInfo[@type='dataQualityInformation']">
                    <h2>Data quality information</h2>            
                    <xsl:apply-templates select="ro:relatedInfo[@type='dataQualityInformation']"/>
                </xsl:when>
                <xsl:otherwise>
                    <h2>Data quality information</h2>            
                    <p>Not provided</p>
                </xsl:otherwise>
            </xsl:choose>
-->
            <!--Data Type -->
            <xsl:variable name="vLower" select="'abcdefghijklmnopqrstuvwxyz'"/>
            <xsl:variable name="vUpper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'"/>
            <xsl:choose>
                <xsl:when test="//ro:collection">   
                    <h2>Data type</h2>                     
                        <xsl:value-of select="concat(translate(substring(./@type,1,1),$vLower,$vUpper),
                                                     substring(./@type,2),
                                                     substring(' ',1 div not(position()=last()))
                                                     )"
                        />  
                </xsl:when>
                <xsl:when test="//ro:party">   
                    <h2>Data type</h2>            
                        <xsl:value-of select="concat(translate(substring(./@type,1,1),$vLower,$vUpper),
                                                     substring(./@type,2),
                                                     substring(' ',1 div not(position()=last()))
                                                     )"
                        />                         
                </xsl:when>
                <xsl:when test="//ro:activity">   
                    <h2>Data type</h2>            
                        <xsl:value-of select="concat(translate(substring(./@type,1,1),$vLower,$vUpper),
                                                     substring(./@type,2),
                                                     substring(' ',1 div not(position()=last()))
                                                     )"
                        />                         
                </xsl:when>
                <xsl:when test="//ro:service">   
                    <h2>Data type</h2>            
                        <xsl:value-of select="concat(translate(substring(./@type,1,1),$vLower,$vUpper),
                                                     substring(./@type,2),
                                                     substring(' ',1 div not(position()=last()))
                                                     )"
                        />                         
                </xsl:when>            
                <xsl:otherwise>
                    <h2>Data type</h2>            
                    <p>Not provided</p>
                </xsl:otherwise>
            </xsl:choose>        

            <!-- Access Data-->            
            <xsl:choose>
	       <xsl:when test="ro:location/ro:address/ro:electronic/@type='url' 
		or ro:rights or ro:location/ro:address/ro:electronic/@type='email'  or ro:location/ro:address/ro:physical">	
                    <xsl:choose>
  		 	<xsl:when test="ro:location/ro:address/ro:electronic/@type='url'">
                                <h2>Access data</h2>  
                                    <p>This data can be accessed from the following websites</p>
                                    <ul style="padding-left:3px">
                                        <p><xsl:apply-templates select="ro:location/ro:address/ro:electronic"/></p>	
                                    </ul>

                         </xsl:when>
                         <xsl:otherwise>
                                <h2>Access data</h2>  
                                    <p>Not provided</p>
                         </xsl:otherwise>
                    </xsl:choose>                
              </xsl:when>	
            <xsl:otherwise>
                <h2>Access data</h2>  
                    <p>Not provided</p>     
            </xsl:otherwise>            
          </xsl:choose>          
        </div>
        
        <ul class="moreInformation">
            <!--Spatial Coverage-->
            <xsl:choose>
                <xsl:when test="ro:coverage/extRif:spatial or ro:location/extRif:spatial">
                    <li class="noprint">  
                        <h2 class="meta_title">
                            <a class="hide" id="spatial">
                                <span class="left">Spatial coverage</span>
                                <span class="right">Hide</span>
                            </a>
                        </h2>
                        <div class="content expand">
                            <xsl:variable name="needMap">
                                <xsl:for-each select="ro:coverage/extRif:spatial">
                                    <xsl:if test="not(./@type) or (./@type!='text' and ./@type!='dcmiPoint')">
                                        <xsl:text>yes</xsl:text>
                                    </xsl:if>
                                </xsl:for-each>
                                <xsl:for-each select="ro:location/extRif:spatial">
                                    <xsl:if test="not(./@type) or (./@type!='text' and ./@type!='dcmiPoint')">
                                        <xsl:text>yes</xsl:text>
                                    </xsl:if>
                                </xsl:for-each>
                            </xsl:variable>

                            <xsl:if test="ro:coverage/extRif:spatial/extRif:coords | ro:location/extRif:spatial/extRif:coords">
                                <xsl:apply-templates select="ro:coverage/extRif:spatial/extRif:coords | ro:location/extRif:spatial/extRif:coords"/>
                                <xsl:if test="$needMap!=''">
                                    <div id="metadatamap"></div>
                                </xsl:if>
                            </xsl:if>

                            <xsl:if test="ro:coverage/extRif:spatial/extRif:center | ro:location/extRif:spatial/extRif:center">
                                <xsl:apply-templates select="ro:coverage/extRif:spatial/extRif:center | ro:location/extRif:spatial/extRif:center"/>
                            </xsl:if>

                            <xsl:for-each select="ro:coverage/extRif:spatial[@type!='iso19139dcmiBox' and @type!='gmlKmlPolyCoords' and @type!='kmlPolyCoords']">
                                    <p class="coverage_text"><xsl:value-of select="./@type"/>: <xsl:value-of select="."/></p>
                            </xsl:for-each>
                        </div>
                    </li> 
                </xsl:when>
           
            </xsl:choose>
            <!--Additional Information-->
          <li>
              <h2 class="meta_title" id="additional">
                    <a class="show">
                        <span class="left">Additional information</span>
                        <span class="right">Show</span>
                    </a>
              </h2>                         	        
              <div class="content collapse" id="connectionsRightBox">
                    <div id="connectionsInfoBox"></div>
                        <div id="connections" class="padding5">
				<img>
				<xsl:attribute name="src"><xsl:value-of select="$base_url"/><xsl:text>/img/ajax-loader.gif</xsl:text></xsl:attribute>
				<xsl:attribute name="class">loading-icon</xsl:attribute>
				<xsl:attribute name="alt">Loading…</xsl:attribute>
				</img>
			</div>                       
              </div>
          </li>
          <!--Subject-->
          <xsl:choose>
                <xsl:when test="ro:subject"> 
                    <li>
                        <h2 class="meta_title">
                            <a class="show">
                                    <span class="left">Subjects</span>
                                    <span class="right">Show</span>
                            </a>
                        </h2>
                        <div class="content collapse subjects" >
                                <xsl:if test="ro:subject/@type='anzsrc-for'">
                                    <h3>ANZSRC - FOR</h3>
                                        <ul  class="forcode">
                                        <xsl:for-each select="ro:subject">      
                                            <xsl:sort select="./@type"/>
                                            <xsl:if test="@type='anzsrc-for'">
                                                <xsl:apply-templates select="."/>
                                            </xsl:if>
                                        </xsl:for-each>
                                        </ul>
                                </xsl:if>
                                <xsl:if test="ro:subject/@type='anzsrc-seo'">
                                    <h3>ANZSRC - SEO</h3>
                                        <ul  class="forcode">
                                        <xsl:for-each select="ro:subject">      
                                            <xsl:sort select="./@type"/>
                                            <xsl:if test="@type='anzsrc-seo'">
                                                <xsl:apply-templates select="."/>
                                            </xsl:if>
                                        </xsl:for-each>
                                        </ul>
                                </xsl:if>
                               <xsl:if test="ro:subject/@type='anzsrc-toa'">
                                    <h3>ANZSRC - TOA</h3>
                                        <ul  class="forcode">
                                        <xsl:for-each select="ro:subject">      
                                            <xsl:sort select="./@type"/>
                                            <xsl:if test="@type='anzsrc-toa'">
                                                <xsl:apply-templates select="."/>
                                            </xsl:if>
                                        </xsl:for-each>
                                        </ul>
                               </xsl:if>
                               <xsl:if test="ro:subject/@type='gcmd'">
                                    <h3>GCMD</h3>
                                        <ul  class="forcode">
                                        <xsl:for-each select="ro:subject">      
                                            <xsl:sort select="./@type"/>
                                            <xsl:if test="@type='gcmd'">
                                                <xsl:apply-templates select="."/>
                                            </xsl:if>
                                        </xsl:for-each>
                                        </ul>
                               </xsl:if>     
                            <xsl:if test="ro:subject/@type='local'">
                                    <h3>Local</h3>
                                        <ul>
                                            <xsl:for-each select="ro:subject">      
                                                <xsl:sort select="./@type"/>
                                                <xsl:if test="@type='local'"> 
                                                    <xsl:apply-templates select="."/>
                                                </xsl:if>
                                            </xsl:for-each>
                                        </ul>
                            </xsl:if>                                                         
<!--                            
                            <xsl:if test="ro:subject/@type='anzsrc-for' or ro:subject/@type='anzsrc-seo' or ro:subject/@type='anzsrc-toa'">
                                    <h3>ANZSRC</h3>
                                        <ul  class="forcode">
                                        <xsl:for-each select="ro:subject">      
                                            <xsl:sort select="./@type"/>
                                            <xsl:if test="@type='anzsrc-for' or @type='anzsrc-seo' or @type='anzsrc-toa'">
                                                <xsl:apply-templates select="."/>
                                            </xsl:if>
                                        </xsl:for-each>
                                        </ul>
                            </xsl:if>

                            <xsl:if test="ro:subject[not(@type = 'anzsrc-for' or  @type = 'anzsrc-seo' or  @type = 'anzsrc-toa')]">
                                    <h3>Keywords</h3>
                                        <ul>
                                            <xsl:for-each select="ro:subject">      
                                                <xsl:sort select="./@type"/>
                                                <xsl:if test="@type!='anzsrc-for'and @type!='anzsrc-seo' and @type!='anzsrc-toa'">
                                                    <xsl:apply-templates select="."/>
                                                </xsl:if>
                                            </xsl:for-each>
                                        </ul>
                            </xsl:if>
-->                                     
                        </div>
                        <a href="javascript:void(0);" class="showall_subjects collapse">More...</a>      
                    </li> 
                </xsl:when> 
                <xsl:otherwise>
                    <li>
                        <h2 class="meta_title">
                            <a class="show">
                                    <span class="left">Subjects</span>
                                    <span class="right">Show</span>
                            </a>
                        </h2>     
                    </li>
                    <div class="content collapse">
                        <p>Not provided</p>
                    </div>
                </xsl:otherwise>
           </xsl:choose> 
           <!--Related Datasets-->
           <xsl:if test="$objectClass='Collection'">
               <li>
                   <h2 class="meta_title" id="related">
                       <a class="show">
                            <span class="left">Related datasets</span>
                            <span class="right">Show</span>
                        </a>
                   </h2>
                    <div id="seeAlsoRightBox" class="content collapse">
                        <div id="infoBox"></div>
                        <div id="seeAlso" >
                            <img>
                            <xsl:attribute name="src"><xsl:value-of select="$base_url"/><xsl:text>/img/ajax-loader.gif</xsl:text></xsl:attribute>
                            <xsl:attribute name="class">loading-icon</xsl:attribute>
                            <xsl:attribute name="alt">Loading…</xsl:attribute>
                            </img>
                        </div>
                    </div>                   
               </li>
            </xsl:if>
        </ul>
   </div>
   </section>
   <aside>
       <!--Access data-->
       <div class="box">
            <xsl:choose>
	       <xsl:when test="ro:location/ro:address/ro:electronic/@type='url' 
		or ro:rights or ro:location/ro:address/ro:electronic/@type='email'  or ro:location/ro:address/ro:physical">	
                    <xsl:choose>
  		 	<xsl:when test="ro:location/ro:address/ro:electronic/@type='url'">
                                <h1 class="greenGradient">Access data</h1>  
                                <div class="content">
                                    <ul style="padding-left:3px">
                                       <xsl:apply-templates select="ro:location/ro:address/ro:electronic"/>
                                    </ul>
                                </div>
                         </xsl:when>
                         <xsl:otherwise>
                                <h1 class="greenGradient">Access data</h1>  
                                <div class="content">
                                    <p>Not provided</p>
                                </div>
                         </xsl:otherwise>
                    </xsl:choose>                
              </xsl:when>	
            <xsl:otherwise>
                <h1 class="greenGradient">Access data</h1>  
                <div class="content">
                    <p>Not provided</p>
                </div>       
            </xsl:otherwise>            
          </xsl:choose>           
       </div>       
       <!--Contact Details-->
       <div class="box">
            <xsl:choose>
            <xsl:when test="ro:location/ro:address/ro:electronic/@type='email' or ro:location/ro:address/ro:physical">
                       <h1 class="greenGradient">Contacts</h1>
                       <div class="content">
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
                      <h1 class="greenGradient">Contacts</h1>
                      <div class="content">Not provided</div>       
           </xsl:otherwise>
        </xsl:choose>
       </div>
   </aside>
       
</xsl:template>

<!--  the following templates will format the view page content -->

 <xsl:template match="ro:relatedObject/ro:relation[@type='author']">
    <xsl:value-of select="../extRif:relatedObjectListTitle"/>&#160; 
</xsl:template>

 <xsl:template match="ro:relatedObject/extRif:relatedObjectType">
     <xsl:if test=".='group'">
        <xsl:value-of select="../extRif:relatedObjectListTitle"/>      
     </xsl:if>
    
</xsl:template>

    <!--<xsl:template match="ro:displayTitle">   -->
    <xsl:template match="extRif:extendedMetadata/extRif:displayTitle">   

        <div id="metadataTitle">
            <span>METADATA</span>
            <h1><xsl:value-of select="."/></h1>  
                <xsl:for-each select="//ro:existenceDates">
                    <xsl:if test="./ro:startDate"><xsl:value-of select="./ro:startDate"/></xsl:if> - <xsl:if test="./ro:endDate"><xsl:value-of select="./ro:endDate"/></xsl:if><br/>
                </xsl:for-each>
             <ul>
                
                <li>
                <a class="orangeGradient smallRoundedCorners" href="javascript:void(0);" id="addToFavourite">Add to Favourites</a>
                </li>
                <li>
                <a class="greyGradient smallRoundedCorners disabled" href="javascript:void(0);" id="saveRecord">Saved</a>
                </li>
                
                <li>
                <a class="greenGradient smallRoundedCorners" href="javascript:window.print();">Print</a>
                </li>
             </ul>    
        </div>			
    </xsl:template>
    
    <xsl:template match="extRif:displayLogo">   
        <div>
            <img id="party_logo" style="max-width:130px;">
            <xsl:attribute name="src"><xsl:value-of select="."/></xsl:attribute>
            <xsl:attribute name="alt">Party logo</xsl:attribute>
        </img>
	</div>    
    </xsl:template>     

    <!--<xsl:template match="ro:name[@type='alternative']/ro:displayTitle">   -->
    <xsl:template match="ro:name[@type='alternative']/ro:displayTitle">
        <p class="alt_displayTitle"><xsl:value-of select="."/></p>
    </xsl:template> 
  

   <xsl:template match="ro:title">
        <xsl:value-of select="."/><br />    
    </xsl:template>

    <xsl:template match="extRif:extendedMetadata/extRif:registryDateHarvested">   
        <xsl:value-of select="."/><br /> 			
    </xsl:template>
    
    <xsl:template match="extRif:extendedMetadata/extRif:registryDateModified">   
        <xsl:value-of select="."/><br /> 			
    </xsl:template>

    <xsl:template match="ro:relatedInfo/ro:notes">
        <xsl:value-of select="."/><br />    
    </xsl:template> 
    
   <xsl:template match="ro:coverage/extRif:spatial/extRif:coords">
      <xsl:if test="not(./@type) or (./@type!= 'text' and ./@type!= 'dcmiPoint')">
        <p class="coverage hide" name="{@type}"><xsl:value-of select="."/></p>
      </xsl:if>
    </xsl:template>
     <xsl:template match="ro:location/extRif:spatial/extRif:coords">
      <xsl:if test="not(./@type) or (./@type!= 'text' and ./@type!= 'dcmiPoint')">
        <p class="coverage hide" name="{@type}"><xsl:value-of select="."/></p>
      </xsl:if>
    </xsl:template>
    <xsl:template match="extRif:center">
        <p class="spatial_coverage_center hide"><xsl:value-of select="."/></p>
    </xsl:template>
    
    <xsl:template match="ro:date">
        <xsl:if test="./@type = 'dateFrom'">
            From 
        </xsl:if>
        <xsl:if test="./@type = 'dateTo'">
            To
        </xsl:if>
             <xsl:choose>
                <xsl:when test='string-length(.)=10'>
                       <xsl:variable name="dateResult">
                           <xsl:call-template name="format-date">
                               <xsl:with-param name="date"><xsl:value-of select="."/></xsl:with-param>
                                <xsl:with-param name="format" select="'d-n-Y'"/> 
                            </xsl:call-template>
                      </xsl:variable> 
                      <xsl:value-of select="$dateResult"/>
                 </xsl:when>
                 <xsl:when test='string-length(.)>10'>
                     <xsl:variable name="dateResult">
                        <xsl:call-template name="format-date">
                               <xsl:with-param name="date"><xsl:value-of select="substring(.,1,10)"/></xsl:with-param>
                                <xsl:with-param name="format" select="'d-n-Y'"/> 
                        </xsl:call-template>                      
                      </xsl:variable> 
                      <xsl:value-of select="$dateResult"/>&#160;
                      <xsl:value-of select="substring(.,12)"/>
                 </xsl:when>
                  <xsl:when test='string-length(.)=0'>
                       <xsl:variable name="dateResult">
                         [not provided]
                        </xsl:variable> 
                      <xsl:value-of select="$dateResult"/>
                 </xsl:when>                
                 <xsl:otherwise>
                    <xsl:value-of select="."/>

                 </xsl:otherwise>
             </xsl:choose>
        
       
    </xsl:template> 
   <xsl:template match="ro:location[@dateFrom!=''] | ro:location[@dateTo!='']">
        <xsl:if test="./@dateFrom != ''">
            From <xsl:value-of select="./@dateFrom"/>
        </xsl:if> 
        <xsl:if test="./@dateTo != ''">
            To <xsl:value-of select="./@dateTo"/>
        </xsl:if>
     
    </xsl:template>  

    <xsl:template match="ro:subject">            
            <li class="subjectFilter" id="{@extRif:resolvedValue}"><xsl:value-of select="@extRif:resolvedValue"/></li>
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
 	<xsl:apply-templates select="./ro:identifier[not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri' or @type = 'local' )]" mode="other"/>			            	
                         
        <xsl:if test="./ro:notes">
             <xsl:apply-templates select="./ro:notes"/>
        </xsl:if>
        </p>        
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
            </a> 	<br />
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
                <xsl:value-of select="./ro:identifier/@type"/> <xsl:value-of select="."/><br />   			
                </xsl:otherwise>          		
        </xsl:choose>
    </xsl:variable>   	  
    <xsl:if test="string-length(substring-after(.,'10.'))>0">		
                <a>
                <xsl:attribute name="href"><xsl:text>http://dx.doi.org/</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
                <xsl:attribute name="title"><xsl:text>Resolve this DOI</xsl:text></xsl:attribute>    				
                <xsl:value-of select="."/>
                </a> 		 <br />
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
   <xsl:choose>
   <xsl:when test="./@type='arc' or ./@type='abn' or ./@type='isil'">
 		<xsl:value-of select="translate(./@type,'abcdefghijklmnopqrstuvwxyz','ABCDEFGHIJKLMNOPQRSTUVWXYZ')"/>: <xsl:value-of select="."/>  
   </xsl:when>
   
   <xsl:otherwise>
	<xsl:value-of select="./@type"/>: <xsl:value-of select="."/>
	</xsl:otherwise>
	</xsl:choose>
	<br />
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
                
                <xsl:variable name="linkurl">
                    <xsl:value-of select="."/>
                </xsl:variable>
                <xsl:variable name="apos">'</xsl:variable>
                <xsl:variable name="l">
                    <xsl:value-of select="."/>
                </xsl:variable>
			<li><a><xsl:attribute name="href"><xsl:value-of select="."/></xsl:attribute><xsl:attribute name="class">download external noprint</xsl:attribute><xsl:attribute name="target">_blank</xsl:attribute><xsl:value-of select="concat(substring($l,1,45),'....')"/></a><a><xsl:attribute name="href"></xsl:attribute><xsl:attribute name="class">collapse print</xsl:attribute><xsl:attribute name="target">_blank</xsl:attribute><xsl:value-of select="."/></a></li>
                  
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
	
	<xsl:template match="extRif:rights[@type!='licence']">
           <p><xsl:value-of select="." disable-output-escaping="yes"/>
                <xsl:if test="./@rightsUri"><p>
                <a target="_blank">
                    <xsl:attribute name="href"><xsl:value-of select="./@rightsUri"/></xsl:attribute><xsl:value-of select="./@rightsUri"/></a></p>
                </xsl:if>
           </p>			
	</xsl:template>
        
	<xsl:template match="extRif:rights[@type='licence']">
            <p>
                <xsl:if test="string-length(substring-after(./@licence_type,'CC-'))>0">
                    <img id="licence_logo" style="width:130px;">
                        <xsl:attribute name="src"><xsl:value-of select="$base_url"/>
                        <xsl:text>/img/</xsl:text>
                        <xsl:value-of select="./@licence_type"/>
                        <xsl:text>.png</xsl:text></xsl:attribute>
                        <xsl:attribute name="alt"><xsl:value-of select="./@licence_type"/></xsl:attribute>
                    </img>
               </xsl:if>
                <xsl:if test="string-length(substring-after(./@licence_type,'CC-'))=0">	
                    <xsl:if test="./@licence_type='Unknown/Other' and .=''"><p>Unknown</p></xsl:if>
                    <xsl:if test="./@licence_type!='Unknown/Other'"><p><xsl:value-of select="./@licence_type"/></p></xsl:if>
                </xsl:if>
                <xsl:if test="."><p><xsl:value-of select="."/></p></xsl:if>
                    <xsl:if test="./@rightsUri"><p>
                    <a target="_blank">
                    <xsl:attribute name="href"><xsl:value-of select="./@rightsUri"/></xsl:attribute><xsl:value-of select="./@rightsUri"/></a></p>
                </xsl:if>	
                    </p>	
    </xsl:template>


<xsl:template match="extRif:description" mode="content">
          <div class="description"><xsl:value-of select="." disable-output-escaping="yes"/></div>   
</xsl:template>	
	
	<xsl:template match="ro:location/ro:address/ro:electronic/@type">		
		<xsl:if test=".='email'">	
	  		<a> <xsl:attribute name="href">mailto:<xsl:value-of select=".."/></xsl:attribute><xsl:value-of select=".."/></a><br />
		</xsl:if>				
	</xsl:template>  
	      
</xsl:stylesheet>
  