<?xml version="1.0" encoding="UTF-8"?>
<sld:StyledLayerDescriptor xmlns="http://www.opengis.net/sld" xmlns:sld="http://www.opengis.net/sld" xmlns:ogc="http://www.opengis.net/ogc" xmlns:gml="http://www.opengis.net/gml" version="1.0.0">
 <sld:NamedLayer>
   <sld:Name>PolyHighlight</sld:Name>
   <sld:UserStyle>
     <sld:Name>PolyHighlight</sld:Name>
     <sld:Title>Default white polygon style</sld:Title>
     <sld:Abstract>A style that just draws out a solid white interior with a black1px outline</sld:Abstract>
     <sld:FeatureTypeStyle>
       <sld:Name>name</sld:Name>
       <sld:Rule>
         <sld:Title>Polygon</sld:Title>
         <sld:PolygonSymbolizer>
           <sld:Fill>
             <sld:CssParameter name="fill">#FFFFFF</sld:CssParameter>
             <sld:CssParameter name="fill-opacity">0.6</sld:CssParameter>
           </sld:Fill>
           <sld:Stroke>
             <sld:CssParameter name="stroke">#AAAAAA</sld:CssParameter>
             <sld:CssParameter name="stroke-opacity">1</sld:CssParameter>
           </sld:Stroke>
         </sld:PolygonSymbolizer>
       </sld:Rule>
     </sld:FeatureTypeStyle>
   </sld:UserStyle>
 </sld:NamedLayer>
</sld:StyledLayerDescriptor>