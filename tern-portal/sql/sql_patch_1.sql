--
-- Name: vw_minmax_date; Type: VIEW; Schema: dba; Owner: admin
--

CREATE VIEW dba.vw_minmax_date AS
    SELECT min("left"((dba.tbl_temporal_coverage_dates.value)::text, 4)) AS min_year, max("left"((dba.tbl_temporal_coverage_dates.value)::text, 4)) AS max_year FROM dba.tbl_temporal_coverage_dates;


ALTER TABLE dba.vw_minmax_date OWNER TO admin;

--
-- Name: vw_minmax_date; Type: ACL; Schema: dba; Owner: admin
--

REVOKE ALL ON TABLE dba.vw_minmax_date FROM PUBLIC;
REVOKE ALL ON TABLE dba.vw_minmax_date FROM admin;
GRANT ALL ON TABLE dba.vw_minmax_date TO admin;
GRANT ALL ON TABLE dba.vw_minmax_date TO webuser;
GRANT ALL ON TABLE dba.vw_minmax_date TO dba;

