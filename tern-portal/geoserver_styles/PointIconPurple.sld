<?xml version="1.0" encoding="ISO-8859-1"?>
<StyledLayerDescriptor version="1.0.0" xmlns="http://www.opengis.net/sld" xmlns:ogc="http://www.opengis.net/ogc"
  xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:schemaLocation="http://www.opengis.net/sld http://schemas.opengis.net/sld/1.0.0/StyledLayerDescriptor.xsd">
  <NamedLayer>
    <Name>PointIconPurple</Name>
    <UserStyle>
      <Title>Default point purple</Title>
      <Abstract>  </Abstract>

      <FeatureTypeStyle>
        <!--FeatureTypeName>Feature</FeatureTypeName-->
        <Rule>
          <Title>Small</Title>
           <MinScaleDenominator>3000000</MinScaleDenominator>
           <PointSymbolizer>
     <Graphic>
        <ExternalGraphic>
          <OnlineResource xlink:type="simple" xlink:href="http://portal-dev.tern.org.au/img/map/map_marker_purple_sml.png" />
           <Format>image/png</Format>
        </ExternalGraphic>
     </Graphic>
 </PointSymbolizer>
        </Rule>
        <Rule>
          <Title>Med</Title>
           <MinScaleDenominator>500000</MinScaleDenominator>
           <MaxScaleDenominator>3000000</MaxScaleDenominator>
           <PointSymbolizer>
     <Graphic>
        <ExternalGraphic>
          <OnlineResource xlink:type="simple" xlink:href="http://portal-dev.tern.org.au/img/map/map_marker_purple_med.png" />
           <Format>image/png</Format>
        </ExternalGraphic>
     </Graphic>
 </PointSymbolizer>
        </Rule>
<Rule>
          <Title>Large</Title>
           <MaxScaleDenominator>500000</MaxScaleDenominator>
           <PointSymbolizer>
     <Graphic>
        <ExternalGraphic>
          <OnlineResource xlink:type="simple" xlink:href="http://portal-dev.tern.org.au/img/map/map_marker_purple.png" />
           <Format>image/png</Format>
        </ExternalGraphic>
     </Graphic>
 </PointSymbolizer>
        </Rule>
      </FeatureTypeStyle>
    </UserStyle>
  </NamedLayer>
</StyledLayerDescriptor>
