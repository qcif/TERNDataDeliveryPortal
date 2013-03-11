CREATE or REPLACE FUNCTION dba.tern_api_search_geom_intersect(north double precision, east double precision, south double precision, west double precision, coords text) RETURNS SETOF character varying
    LANGUAGE plpgsql
    AS $_$DECLARE
  inputpoly dba.geometry;
BEGIN
   inputpoly := dba.ST_GEOMFROMTEXT(coords ,4326);
RETURN QUERY 
      SELECT key FROM (
               SELECT distinct se.registry_object_key as key,dba.tern_coords_convert(CAST(sl.value as VARCHAR)) as geom
               FROM dba.tbl_spatial_extents se 
               INNER JOIN dba.tbl_spatial_locations sl ON sl.spatial_location_id = se.spatial_location_id
               WHERE (sl.type = 'kmlPolyCoords' OR sl.type='gmlKmlPolyCoords') AND se.bound_box &&  box ((point($1,$4)),(point($3,$2)))
      )e WHERE dba.ST_INTERSECTS(geom,inputpoly) IS TRUE 
     UNION
     SELECT key FROM (
               SELECT se.registry_object_key as key, dba.tern_box_convert(CAST(se.bound_box as VARCHAR)) as geom 
               FROM dba.tbl_spatial_extents se 
               INNER JOIN dba.tbl_spatial_locations sl ON sl.spatial_location_id = se.spatial_location_id
               WHERE sl.type = 'iso19139dcmiBox' AND se.bound_box &&  box ((point($1,$4)),(point($3,$2)))
     )f WHERE dba.ST_INTERSECTS(geom,inputpoly) IS TRUE ;  
 END;$_$;


ALTER FUNCTION dba.tern_api_search_geom_intersect(north double precision, east double precision, south double precision, west double precision, coords text) OWNER TO postgres;