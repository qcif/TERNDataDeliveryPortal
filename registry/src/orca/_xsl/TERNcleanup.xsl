<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : TERNcleanup.xsl
    Created on : 19 January 2012, 11:30 AM
    Author     : wahyuni
    Description:
        Purpose of transformation is cleaning up TERN facilities data, stripping unneeded records
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rif="http://ands.org.au/standards/rif-cs/registryObjects" xmlns:oai="http://www.openarchives.org/OAI/2.0/" exclude-result-prefixes="oai xsi" version="1.0">
    <xsl:output indent="yes"/>
    <xsl:strip-space elements="*"/>

    <!-- TODO customize transformation rules
         syntax recommendation http://www.w3.org/TR/xslt
    -->
    <xsl:template match="rif:registryObject[@group='Monash University']">
        <xsl:choose>
            <xsl:when test="rif:collection">
                <xsl:choose>
                    <xsl:when test="rif:originatingSource = 'http://ozflux.its.monash.edu.au'">
                        <xsl:copy>
                            <xsl:apply-templates select="@*|node()"/>
                        </xsl:copy>
                    </xsl:when>
                </xsl:choose>
            </xsl:when>
            <xsl:otherwise>
                <xsl:copy>
                    <xsl:apply-templates select="@*|node()"/>
                </xsl:copy>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>



    <!--xsl:template match="rif:registryObject[@group='Terrestrial Ecosystem Research Network']">

                <xsl:copy>
                    <xsl:apply-templates select="@*|node()"/>
                </xsl:copy>

    </xsl:template-->

<xsl:template match="rif:registryObject/@group">
        <xsl:choose>
            <xsl:when test=". = 'Monash University'">
                <xsl:attribute name="group">
                <xsl:value-of select="'OzFlux'"/>
                </xsl:attribute>
            </xsl:when>
             <!--xsl:when test=". = 'Terrestrial Ecosystem Research Network'">
                   <xsl:choose>
                 <xsl:when test="contains('aekos',rif:key)">
                    <xsl:attribute name="group">
                    <xsl:value-of select="'EcoInformatics'"/>
                </xsl:attribute>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:attribute name="group">
                    <xsl:value-of select="."/>
                    </xsl:attribute>
                </xsl:otherwise>
                </xsl:choose>
            </xsl:when-->

            <xsl:otherwise>
                <xsl:attribute name="group">
                <xsl:value-of select="."/>
                </xsl:attribute>
            </xsl:otherwise>
        </xsl:choose>

    </xsl:template>


</xsl:stylesheet>
