--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: regions; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE regions (
    l_id character varying(10) NOT NULL,
    r_name character varying(50) NOT NULL,
    the_geom geometry(MultiPolygon,4326),
    r_id integer DEFAULT nextval('regions_r_id_seq'::regclass) NOT NULL
);


ALTER TABLE public.regions OWNER TO admin;

--
-- Name: r_id_pk; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY regions
    ADD CONSTRAINT r_id_pk PRIMARY KEY (r_id);


--
-- Name: l_id_idx; Type: INDEX; Schema: public; Owner: admin; Tablespace: 
--

CREATE INDEX l_id_idx ON regions USING btree (l_id);


--
-- Name: regions; Type: ACL; Schema: public; Owner: admin
--

REVOKE ALL ON TABLE regions FROM PUBLIC;
REVOKE ALL ON TABLE regions FROM admin;
GRANT ALL ON TABLE regions TO admin;
GRANT SELECT,INSERT,UPDATE ON TABLE regions TO webuser;


--
-- PostgreSQL database dump complete
--

