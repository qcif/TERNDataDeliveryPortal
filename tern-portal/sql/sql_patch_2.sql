--
-- Name: udf_search_parent_in_vocabs(character varying, character varying); Type: FUNCTION; Schema: dba; Owner: admin
--

CREATE FUNCTION udf_search_parent_in_vocabs(_vocabulary_identifier character varying, _search_text character varying) RETURNS SETOF udt_term_search_result
    LANGUAGE sql
    AS $_$SELECT t.name , t.identifier , t.vocabPath , t.vocabulary_identifier FROM  dba.tbl_terms t 
WHERE ($1 IS NULL OR t.vocabulary_identifier = $1)
AND (t.identifier = (
SELECT  t.parent_term_identifier FROM dba.tbl_terms t 
WHERE (t.vocabulary_identifier = $1)
AND upper(t.name) like upper($2))
 OR t.name LIKE upper($2)) LIMIT 1;
$_$;

