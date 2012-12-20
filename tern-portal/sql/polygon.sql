

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA dba;


CREATE OR REPLACE function dba.tern_geom_type(geomstr varchar) returns text as $$
DECLARE
 x varchar[];
 length int;
BEGIN
  geomstr :=trim(both ' ,' from geomstr);
  x := string_to_array(trim(both ' ,' from geomstr), ' ');
  length := array_length(x,1);
  geomstr := translate(geomstr,' ,',', ');
  IF length = 1 THEN 
	RETURN 'POINT(' || geomstr || ')';
  ELSIF length = 2 THEN
    RETURN 'LINESTRING('  || geomstr || ')';
  ELSIF length > 2 AND x[1] = x[length] THEN
    RETURN 'POLYGON(('  || geomstr || '))';
  ELSIF length > 2 AND x[1] <> x[length] THEN
    RETURN 'LINESTRING('  || geomstr || ')';
  ELSE 
    RETURN '';
  END IF;
END
$$
language 'plpgsql';

  

CREATE OR REPLACE function dba.tern_box_convert(boxstr varchar) returns dba.geometry as $$
DECLARE
 x varchar[];
 poly varchar;
 length int;
 temp dba.geometry; 
BEGIN
  boxstr := translate(boxstr ,')( ','');
  x := string_to_array(trim(both ' ,' from boxstr ), ',');
  length := array_length(x,1);
  IF length = 4 THEN 
   BEGIN
	poly:= 'POLYGON((' || x[2] || ' ' || x[1] || ',' || x[2] || ' ' || x[3] || ',' || x[4] || ' ' || x[3] || ',' || x[4] || ' ' || x[1] || ',' || x[2] || ' ' || x[1] || '))';
       temp:=ST_GEOMFROMTEXT(poly,4326);
    RETURN temp;
   EXCEPTION WHEN OTHERS THEN
     RETURN NULL;
    END;
  ELSE 
    RETURN NULL;
  END IF;
 
END
$$
language 'plpgsql';

  
CREATE OR REPLACE function dba.tern_coords_convert(coords varchar) returns dba.geometry as $$
DECLARE
  geomstr TEXT;
  temp dba.geometry;
BEGIN
  geomstr := dba.tern_geom_type(coords);
  
  BEGIN
     temp:=ST_GEOMFROMTEXT(geomstr,4326);
    RETURN temp;
   EXCEPTION WHEN OTHERS THEN
     RETURN NULL;
    END;
  
END
$$
language 'plpgsql';



CREATE OR REPLACE FUNCTION dba.tern_search_geom_intersect(north DOUBLE PRECISION,east DOUBLE PRECISION,south DOUBLE PRECISION,west DOUBLE PRECISION, coords TEXT) returns setof varchar as   $_$
DECLARE
  inputpoly dba.geometry;
BEGIN
   inputpoly := dba.ST_GEOMFROMTEXT('POLYGON((' || coords || '))',4326);
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
 END;
 
 $_$
LANGUAGE plpgsql;

