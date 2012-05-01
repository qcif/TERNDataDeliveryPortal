CREATE TYPE udt_search_result_tern AS (
	registry_object_key character varying,
	originating_source character varying,
	data_source_key character varying,
	data_source_title character varying,
	object_group character varying,
	created_when timestamp with time zone,
	created_who character varying,
	registry_object_class character varying,
	type character varying,
	identifier_value character varying,
	identifier_type character varying,
	status character(20),
	record_owner character varying,
	list_title character varying,
	display_title character varying
);
ALTER TYPE dba.udt_search_result_tern OWNER TO dba;



CREATE FUNCTION udf_search_registry_tern(_search_string character varying, _classes character varying, _data_source_key character varying, _object_group character varying, _created_before_equals timestamp with time zone, _created_after_equals timestamp with time zone, _status character, _record_owner character varying) RETURNS SETOF udt_search_result_tern
    LANGUAGE sql
    AS $_$ 

SELECT *
 
FROM
(
 SELECT DISTINCT ON (registry_object_key)
  registry_object_key,
  originating_source,
  data_source_key,
  data_source_title,
  object_group,
  created_when,
  created_who,
  registry_object_class,
  type,
  identifier_value,
  identifier_type,
  status,
  record_owner,
  list_title,
  display_title
 FROM dba.vw_registry_search_tern
 WHERE ( $2 ~* registry_object_class OR $2 = '' )
   AND ( data_source_key = $3 OR $3 IS NULL )
   AND ( object_group = $4 OR $4 IS NULL )
   AND ( registry_object_key ~* ('^'||$1)
        OR $1 = '' OR originating_source~* ('^'||$1)OR data_source_key~* ('^'||$1)OR data_source_title~* ('^'||$1)OR object_group~* ('^'||$1)OR created_who~* ('^'||$1)OR registry_object_class~* ('^'||$1)OR type~* ('^'||$1)OR identifier_value~* ('^'||$1)OR identifier_type~* ('^'||$1)OR status~* ('^'||$1)OR record_owner~* ('^'||$1)OR list_title~* ('^'||$1)OR display_title~* ('^'||$1)
   )
   AND ( status = $7 OR $7 IS NULL )
   AND ( record_owner = $8 OR $8 IS NULL )
 ORDER BY registry_object_key ASC
) 
AS distinct_matches
WHERE ( created_when <= $5 OR $5 IS NULL )
  AND ( created_when >= $6 OR $6 IS NULL )
ORDER BY created_when DESC
;
$_$;

ALTER FUNCTION dba.udf_search_registry_tern(_search_string character varying, _classes character varying, _data_source_key character varying, _object_group character varying, _created_before_equals timestamp with time zone, _created_after_equals timestamp with time zone, _status character, _record_owner character varying) OWNER TO dba;



CREATE VIEW vw_registry_search_tern AS
SELECT ro.registry_object_key, ro.originating_source, ro.data_source_key, ro.data_source_title, ro.object_group, ro.created_when, ro.created_who, ro.registry_object_class, ro.type, i.value AS identifier_value, i.type AS identifier_type, ro.status, ro.record_owner, ro.list_title, ro.display_title
   FROM vw_registry_objects ro
   LEFT JOIN tbl_identifiers i ON ro.registry_object_key::text = i.registry_object_key::text;
ALTER TABLE dba.vw_registry_search_tern OWNER TO dba;

REVOKE ALL ON TABLE vw_registry_search_tern FROM PUBLIC;
REVOKE ALL ON TABLE vw_registry_search_tern FROM dba;
GRANT ALL ON TABLE vw_registry_search_tern TO dba;
GRANT SELECT ON TABLE vw_registry_search_tern TO webuser;