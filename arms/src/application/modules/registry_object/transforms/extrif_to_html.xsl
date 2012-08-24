<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:extRif="http://ands.org.au/standards/rif-cs/extendedRegistryObjects"
	exclude-result-prefixes="extRif">
	<xsl:output method="xml" encoding="UTF-8" indent="yes" omit-xml-declaration="yes"/>
	<xsl:param name="dataSource"/>
	<xsl:param name="dateCreated"/>
	<xsl:template match="registryObjects">
			<xsl:apply-templates select="registryObject"/>
	</xsl:template>

	<xsl:template match="registryObject">
		<table class="recordTable" summary="Preview of Draft Registry Object">
			<tbody class="recordFields">
				<tr>
					<td>Type: </td>
					<td style="">
						<xsl:apply-templates select="collection/@type | activity/@type | party/@type  | service/@type"/>
					</td>
				</tr>

				<tr>
					<td>Key: </td>
					<td>
						<xsl:apply-templates select="key"/>
					</td>
				</tr>

				<tr>
					<td>Source: </td>
					<td>
						<xsl:value-of select="$dataSource"/>
					</td>
				</tr>

				<tr>
					<td>Originating Source: </td>
					<td>
						<xsl:apply-templates select="originatingSource"/>
					</td>
				</tr>
			
				<tr>
					<td>Group: </td>
					<td>
						<xsl:apply-templates select="@group"/>
					</td>
				</tr>	
			
				<xsl:apply-templates select="collection | activity | party | service"/>
				
				
				<tr>
					<td>Created When:</td>
					<td>
						<xsl:value-of select="$dateCreated"/>
					</td>
				</tr>
				
		
			</tbody>
		</table>
	</xsl:template>

	<xsl:template match="@group">
		<xsl:value-of select="."/>
	</xsl:template>
	
	<xsl:template match="collection/@type | activity/@type | party/@type  | service/@type">
		<xsl:value-of select="."/>
	</xsl:template>
	
	<xsl:template match="key">
		<xsl:value-of select="."/>
	</xsl:template>
	
	<!-- xsl:template match="relatedObject/key">
		<tr>
			<td class="attribute">
				<xsl:value-of select="local-name()"/><xsl:text>: </xsl:text>
			</td>
			<td class="value">
				<xsl:value-of select="."/>
			</td>
		</tr>
	</xsl:template-->
	
	<xsl:template match="relatedObject/key">
		<tr>
			<td class="attribute">
				<xsl:value-of select="name()"/><xsl:text>: </xsl:text></td>
			<td class="valueAttribute resolvable_key">
				<xsl:value-of select="."/>
			</td>
		</tr>
	</xsl:template>
	
	<xsl:template match="originatingSource">
		<xsl:value-of select="."/>
	</xsl:template>


	<xsl:template match="collection | activity | party | service">

		<xsl:if test="name">
			<tr>
				<td>Names:</td>
				<td>
					<table class="subtable">
					<xsl:apply-templates select="name"/>
					</table>
				</td>
			</tr>
		</xsl:if>

		<xsl:if test="identifier">
			<tr>
				<td>Identifiers:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="identifier"/>
					</table>
				</td>
			</tr>
		</xsl:if>
		
		<xsl:if test="location">
			<tr>
				<td>Location:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="location"/>
					</table>
				</td>
			</tr>
		</xsl:if>
		
		<xsl:if test="coverage">
			<tr>
				<td>Coverage:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="coverage"/>
					</table>
				</td>
			</tr>
		</xsl:if>
		
		
		<xsl:if test="relatedObject">
			<tr>
				<td>Related Objects:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="relatedObject"/>
					</table>
				</td>
			</tr>
		</xsl:if>
		
		
		<xsl:if test="subject">
			<tr>
				<td>Subjects:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="subject"/>
					</table>
				</td>
			</tr>
		</xsl:if>
			
		<xsl:choose>
			<xsl:when test="description">
				<tr>
					<td>Description:</td>
					<td><!--  div name="errors_description" class="fieldError"/-->
						<table class="subtable">
							<xsl:apply-templates select="description"/>
						</table>
					</td>
				</tr>
			</xsl:when>
	 	</xsl:choose>
	 	
	 	<xsl:choose>
			<xsl:when test="existenceDates">
				<tr>
					<td>Existence Dates:</td>
					<td>
						<table class="subtable">
							<xsl:apply-templates select="existenceDates"/>
						</table>
					</td>
				</tr>
			</xsl:when>
	 	</xsl:choose>
	 	
	 	<xsl:if test="citationInfo">
			<tr>
				<td>Citation:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="citationInfo"/>
					</table>
				</td>
			</tr>
		</xsl:if>
	 	
	 	<xsl:if test="relatedInfo">
			<tr>
				<td>Related Info:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="relatedInfo"/>
					</table>
				</td>
			</tr>
		</xsl:if>	
		
		 <xsl:if test="rights">
			<tr>
				<td>Rights:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="rights"/>
					</table>
				</td>
			</tr>
		</xsl:if>
		
	 	<xsl:if test="accessPolicy">
			<tr>
				<td>Access Policy:</td>
				<td>
					<table class="subtable">
						<xsl:apply-templates select="accessPolicy"/>
					</table>
				</td>
			</tr>
		</xsl:if>
	 	
	</xsl:template>
	
	<!-- xsl:template match="citationMetadata/identifier">
		
		
		<tr>	
			<td class="attribute">
				<xsl:value-of select="local-name()"/>:
			</td>
			<td>
				<table class="subtable1">
		
					<tr>	
						<td class="attribute">
							Type<xsl:text>: </xsl:text>
						</td>
						<td class="valueAttribute">
							<xsl:value-of select="@type" />
						</td>
					</tr>
					<tr>	
						<td class="attribute">
							Value<xsl:text>: </xsl:text>
						</td>
						<td>
					    	<xsl:apply-templates select="current()[@type='doi']" mode = "doi"/>
					     	<xsl:apply-templates select="current()[@type='ark']" mode = "ark"/>    	
					      	<xsl:apply-templates select="current()[@type='AU-ANL:PEAU']" mode = "nla"/>  
					      	<xsl:apply-templates select="current()[@type='handle']" mode = "handle"/>   
					      	<xsl:apply-templates select="current()[@type='purl']" mode = "purl"/>
					     	<xsl:apply-templates select="current()[@type='uri']" mode = "uri"/> 
							<xsl:if test="not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri')">
								<xsl:value-of select="." />
							</xsl:if>
					  		<xsl:apply-templates select="current()[not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri')]" mode="other"/>
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
	</xsl:template-->
	
	<xsl:template match="citationMetadata/identifier">
		
		
		<tr>	
			<td class="attribute">
				<xsl:value-of select="local-name()"/>:
			</td>
			<td>
				<table class="subtable1">
		
					<tr>	
						<td class="attribute">
							Type<xsl:text>: </xsl:text>
						</td>
						<td class="valueAttribute">
							<xsl:value-of select="@type" />
						</td>
					</tr>
					<tr>	
						<td class="attribute">
							Value<xsl:text>: </xsl:text>
						</td>
						<td>
					    	<xsl:apply-templates select="current()[@type='doi']" mode = "doi"/>
					     	<xsl:apply-templates select="current()[@type='ark']" mode = "ark"/>    	
					      	<xsl:apply-templates select="current()[@type='AU-ANL:PEAU']" mode = "nla"/>  
					      	<xsl:apply-templates select="current()[@type='handle']" mode = "handle"/>   
					      	<xsl:apply-templates select="current()[@type='purl']" mode = "purl"/>
					     	<xsl:apply-templates select="current()[@type='uri']" mode = "uri"/> 
							<xsl:if test="not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri')">
								<xsl:value-of select="." />
							</xsl:if>
					  		<!--<xsl:apply-templates select="current()[not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri')]" mode="other"/>-->
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
	</xsl:template>
	
		
	
    <xsl:template match="relatedInfo/identifier">
		
		<tr>	
			<td class="attribute">
				<xsl:value-of select="local-name()"/>:
			</td>
			<td>
				<table class="subtable1">
		
					<tr>	
						<td class="attribute">
							Type<xsl:text>: </xsl:text>
						</td>
						<td class="valueAttribute">
							<xsl:value-of select="@type" />
						</td>
					</tr>
					<tr>	
						<td class="attribute">
							Value<xsl:text>: </xsl:text>
						</td>
						<td>
					    	<xsl:apply-templates select="current()[@type='doi']" mode = "doi"/>
					     	<xsl:apply-templates select="current()[@type='ark']" mode = "ark"/>    	
					      	<xsl:apply-templates select="current()[@type='AU-ANL:PEAU']" mode = "nla"/>  
					      	<xsl:apply-templates select="current()[@type='handle']" mode = "handle"/>   
					      	<xsl:apply-templates select="current()[@type='purl']" mode = "purl"/>
					     	<xsl:apply-templates select="current()[@type='uri']" mode = "uri"/> 
							<xsl:if test="not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri')">
								<xsl:value-of select="." />
							</xsl:if>
					  		<!--<xsl:apply-templates select="current()[not(@type =  'doi' or @type =  'ark' or @type =  'AU-ANL:PEAU' or @type =  'handle' or @type =  'purl' or @type =  'uri')]" mode="other"/>-->
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
	           
    </xsl:template>
	
	
    <xsl:template match="relatedInfo">
		<tr>	
			<td class="attribute">
				Type<xsl:text>: </xsl:text>
			</td>
			<td class="valueAttribute">
				<xsl:value-of select="@type" />
			</td>
		</tr>
		<tr>	
			<td colspan="2">
				<table class="subtable1">
		
					<xsl:if test="./title">
			         	<xsl:apply-templates select="title"/>
					</xsl:if>
			
					<xsl:apply-templates select="identifier"/>
					
					<xsl:if test="./notes">
			         	<xsl:apply-templates select="notes"/>
					</xsl:if>
				</table>
			</td>
		</tr>
	           
     </xsl:template>
	
	  <xsl:template match="identifier" mode="ark">
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
						<xsl:attribute name="target"><xsl:text>_blank</xsl:text></xsl:attribute>
	    				<xsl:attribute name="href"><xsl:text>http://</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
	    				<xsl:attribute name="title"><xsl:text>Resolve this ARK identifier</xsl:text></xsl:attribute>    				
	    				<xsl:value-of select="."/>
	    				</a>
	    				</xsl:if>
	    				<xsl:if test="string-length(substring-after(.,'/ark:/'))&lt;1">
	    					<xsl:value-of select="."/>
	    				</xsl:if> 
	</xsl:template>
	 <xsl:template match="identifier" mode="nla">
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
						<xsl:attribute name="target"><xsl:text>_blank</xsl:text></xsl:attribute>
	    				<xsl:attribute name="href"><xsl:text>http://nla.gov.au/</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
	    				<xsl:attribute name="title"><xsl:text>View the record for this party in Trove</xsl:text></xsl:attribute>    				
	    				<xsl:value-of select="."/>
	    				</a> 	<br />
	  				</xsl:if> 
	  					<xsl:if test="string-length(substring-after(.,'nla.party'))&lt;1">		
   				
	    				<xsl:value-of select="."/>
	  				</xsl:if> 
	 </xsl:template>
	 <xsl:template match="identifier" mode="doi">   					
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
						<xsl:attribute name="target"><xsl:text>_blank</xsl:text></xsl:attribute>
	    				<xsl:attribute name="href"><xsl:text>http://dx.doi.org/</xsl:text> <xsl:value-of select="$theidentifier"/></xsl:attribute>
	    				<xsl:attribute name="title"><xsl:text>Resolve this DOI</xsl:text></xsl:attribute>    				
	    				<xsl:value-of select="."/>
	    				</a> 		 <br />
	  				</xsl:if> 
	  					<xsl:if test="string-length(substring-after(.,'10.'))&lt;1">		
   				
	    				<xsl:value-of select="."/>
	  				</xsl:if> 					 			

    			
	 </xsl:template>
	 <xsl:template match="identifier" mode="handle">      			
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
						<xsl:attribute name="target"><xsl:text>_blank</xsl:text></xsl:attribute>
	    				<xsl:attribute name="href"> <xsl:value-of select="$theidentifier"/></xsl:attribute>
	    				<xsl:attribute name="title"><xsl:text>Resolve this handle</xsl:text></xsl:attribute>    				
	    				<xsl:value-of select="."/>
	    				</a> 	 
	 </xsl:template>
	 <xsl:template match="identifier" mode="purl">     			
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
	 </xsl:template>
	 
	 <xsl:template match="identifier | relation/url" mode="uri">     			
	   <xsl:variable name="theidentifier">    			
	    <xsl:choose>				
	    	<xsl:when test="string-length(substring-after(.,'http'))>0"><xsl:value-of select="."/></xsl:when>		     	
	    	<xsl:otherwise>http://<xsl:value-of select="."/></xsl:otherwise>		
	    </xsl:choose>
	 	</xsl:variable>   	        			
	    <a>
		<xsl:attribute name="target"><xsl:text>_blank</xsl:text></xsl:attribute>			
	    <xsl:attribute name="href"><xsl:value-of select="$theidentifier"/></xsl:attribute>
	    <xsl:attribute name="title"><xsl:text>Resolve this uri</xsl:text></xsl:attribute>    				
	    <xsl:value-of select="."/>  
	    </a>   		 
	</xsl:template> 
	
    <xsl:template match="identifier" mode="other">     		
		
		<tr>	
			<td class="attribute">
				Type:
			</td>
			<td class="valueAttribute">	
				<xsl:value-of select="./@type"/>
			</td>
		</tr>
		<tr>	
			<td class="attribute">
				Value:
			</td>
			<td class="">	
				<xsl:value-of select="."/>
			</td>
		</tr>
		
     </xsl:template>  
	
	

	<xsl:template match="relation/description">
		<tr>	
			<td class="attribute">
				<xsl:value-of select="local-name()"/><xsl:text>: </xsl:text>
			</td>
			<td>
				<table class="subtable1">
					<xsl:apply-templates select="@* | node()"/>
				</table>
			</td>
		</tr>
	</xsl:template>
	
	<xsl:template match="relation/url">
		<tr>	
			<td class="attribute">
				<xsl:value-of select="local-name()"/><xsl:text>: </xsl:text>
			</td>
			<td>
				<xsl:apply-templates select="." mode="uri"/>
			</td>
		</tr>
	</xsl:template>
	


	<xsl:template match="name/namePart">
		<tr>	
			<td class="attribute">
			<xsl:choose>
			<xsl:when test="following-sibling::namePart">
			<xsl:text>Name Parts:</xsl:text>
			</xsl:when>
			<xsl:when test="preceding-sibling::namePart"/>
			<xsl:otherwise>
			<xsl:text>Name Part:</xsl:text>
			</xsl:otherwise>
			</xsl:choose>
			</td>
			<td>
				<table class="subtable1">
					<xsl:apply-templates select="@* | node()"/>
				</table>
			</td>
		</tr>
	</xsl:template>
	
	<xsl:template match="text()">
		<xsl:if test="not(following-sibling::node()) and not(preceding-sibling::node())">
		<tr>
			<td class="attribute">Value: </td>
			<td class="value">
				<xsl:value-of select="."/>
			</td>
		</tr>
		</xsl:if>
	</xsl:template>


	<xsl:template match="value/text()">
		<tr>
			<td class="value">
				<xsl:value-of select="."/>
			</td>
		</tr>
	</xsl:template>


	<xsl:template match="node()">
		<tr>
			<xsl:if test="(not(contains('-name-relatedObject-description-subject-rights-', concat('-',local-name(),'-'))))">	
				<td class="attribute">
					<xsl:value-of select="local-name()"/><xsl:text>: </xsl:text>
				</td>
			</xsl:if>
			<td>
				<table class="subtable1">
					<xsl:apply-templates select="@* | node()"/>
				</table>
			</td>
		</tr>
	</xsl:template>

	<xsl:template match="@*">
		<tr>
			<td class="attribute">
				<xsl:value-of select="name()"/><xsl:text>: </xsl:text></td>
			<td class="valueAttribute">
				<xsl:value-of select="."/>
			</td>
		</tr>
	</xsl:template>
	
		
	<xsl:template match="@field_id | @tab_id | @lang"/>


</xsl:stylesheet>