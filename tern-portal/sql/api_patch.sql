CREATE TYPE dba.udt_search_result_tern AS (
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
	display_title character varying,
        description_value character varying(4000)
);
ALTER TYPE dba.udt_search_result_tern OWNER TO dba;


CREATE VIEW dba.vw_registry_search_tern AS
SELECT ro.registry_object_key, ro.originating_source, ro.data_source_key, ro.data_source_title, ro.object_group, ro.created_when, ro.created_who, ro.registry_object_class, ro.type, i.value AS identifier_value, i.type AS identifier_type, ro.status, ro.record_owner, ro.list_title, ro.display_title,d.value as description_value
   FROM dba.vw_registry_objects ro
   LEFT JOIN dba.tbl_identifiers i ON ro.registry_object_key::text = i.registry_object_key::text
   LEFT JOIN dba.tbl_descriptions d ON ro.registry_object_key::text = d.registry_object_key::text;
ALTER TABLE dba.vw_registry_search_tern OWNER TO dba;

REVOKE ALL ON TABLE dba.vw_registry_search_tern FROM PUBLIC;
REVOKE ALL ON TABLE dba.vw_registry_search_tern FROM dba;
GRANT ALL ON TABLE dba.vw_registry_search_tern TO dba;
GRANT SELECT ON TABLE dba.vw_registry_search_tern TO webuser;

CREATE FUNCTION dba.udf_search_registry_tern(_search_string character varying, _classes character varying, _data_source_key character varying, _object_group character varying, _created_before_equals timestamp with time zone, _created_after_equals timestamp with time zone, _count integer,_status character, _record_owner character varying) RETURNS SETOF dba.udt_search_result_tern
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
  display_title,
  description_value
 FROM dba.vw_registry_search_tern
 WHERE ( $2 ~* registry_object_class OR $2 = '' )
   AND ( data_source_key = $3 OR $3 IS NULL )
   AND ( object_group = $4 OR $4 IS NULL )
   AND ( registry_object_key ~* $1
        OR $1 = '' OR originating_source~* $1 OR data_source_key~* $1 OR data_source_title~* $1 OR object_group~* $1 OR created_who~* $1 OR registry_object_class~* $1 OR type~* $1 OR identifier_value~* $1 OR identifier_type~* $1 OR status~* $1 OR record_owner~* $1 OR list_title~* $1 OR display_title~* $1 OR description_value~* $1
   )
   AND ( status = $8 OR $8 IS NULL )
   AND ( record_owner = $9 OR $9 IS NULL )
 ORDER BY registry_object_key ASC
) 
AS distinct_matches
WHERE ( created_when <= $5 OR $5 IS NULL )
  AND ( created_when >= $6 OR $6 IS NULL )

ORDER BY created_when DESC
LIMIT $7
OFFSET 0
;
$_$;

ALTER FUNCTION dba.udf_search_registry_tern(_search_string character varying, _classes character varying, _data_source_key character varying, _object_group character varying, _created_before_equals timestamp with time zone, _created_after_equals timestamp with time zone, _count integer, _status character, _record_owner character varying) OWNER TO dba;



