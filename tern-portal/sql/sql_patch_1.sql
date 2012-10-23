--
-- Name: vw_minmax_date; Type: VIEW; Schema: dba; Owner: admin
--

CREATE VIEW dba.vw_minmax_date AS
     SELECT min("left"(dba.tbl_temporal_coverage_dates.value::text, 4)) AS min_year, max("left"(dba.tbl_temporal_coverage_dates.value::text, 4)) AS max_year
   FROM dba.tbl_temporal_coverage_dates
  WHERE dba.tbl_temporal_coverage_dates.value::text <> ''::text;


ALTER TABLE dba.vw_minmax_date OWNER TO admin;
 
--
-- Name: vw_minmax_date; Type: ACL; Schema: dba; Owner: admin
--

REVOKE ALL ON TABLE dba.vw_minmax_date FROM PUBLIC;
REVOKE ALL ON TABLE dba.vw_minmax_date FROM admin;
GRANT ALL ON TABLE dba.vw_minmax_date TO admin;
GRANT ALL ON TABLE dba.vw_minmax_date TO webuser;
GRANT ALL ON TABLE dba.vw_minmax_date TO dba;

--
-- Name: udf_search_parent_in_vocabs(character varying, character varying); Type: FUNCTION; Schema: dba; Owner: admin
--

CREATE FUNCTION dba.udf_search_parent_in_vocabs(_vocabulary_identifier character varying, _search_text character varying) RETURNS SETOF dba.udt_term_search_result
    LANGUAGE sql
    AS $_$SELECT t.name , t.identifier , t.vocabPath , t.vocabulary_identifier FROM  dba.tbl_terms t 
WHERE ($1 IS NULL OR t.vocabulary_identifier = $1)
AND (t.identifier = (
SELECT  t.parent_term_identifier FROM dba.tbl_terms t 
WHERE (t.vocabulary_identifier = $1)
AND upper(t.name) like upper($2))
 OR t.name LIKE upper($2)) LIMIT 1;
$_$;




