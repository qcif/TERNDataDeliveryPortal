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
-- Name: indexer_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE indexer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;




GRANT ALL ON public.indexer_id_seq TO webuser;
--
-- Name: index_scheduler; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE index_scheduler (
    batch_id integer DEFAULT nextval('indexer_id_seq'::regclass) NOT NULL,
    start_timestamp timestamp without time zone,
    end_timestamp timestamp without time zone,
    end_run integer DEFAULT 0 NOT NULL,
    run_timestamp timestamp without time zone,
    under_process integer DEFAULT 0 NOT NULL,
    run_schedule timestamp without time zone DEFAULT timezone('UTC'::text, now()) NOT NULL,
    l_id character varying,
    rec_start integer DEFAULT 0 NOT NULL,
    cat integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.index_scheduler OWNER TO admin;

--
-- Name: COLUMN index_scheduler.start_timestamp; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.start_timestamp IS 'First record to be processed';


--
-- Name: COLUMN index_scheduler.end_timestamp; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.end_timestamp IS 'Last record done by batch ';


--
-- Name: COLUMN index_scheduler.end_run; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.end_run IS 'Has it finished running?';


--
-- Name: COLUMN index_scheduler.run_timestamp; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.run_timestamp IS 'Picked up by process ';


--
-- Name: COLUMN index_scheduler.under_process; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.under_process IS 'Is being processed?';


--
-- Name: COLUMN index_scheduler.run_schedule; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.run_schedule IS 'Scheduled to run on..';


--
-- Name: COLUMN index_scheduler.l_id; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.l_id IS 'Layer to intersect on (refer to regions.l_id)';


--
-- Name: COLUMN index_scheduler.rec_start; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.rec_start IS 'offset record number';


--
-- Name: COLUMN index_scheduler.cat; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN index_scheduler.cat IS '0 = ad hoc run, 1 = new record check ';


--
-- Name: index_scheduler_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY index_scheduler
    ADD CONSTRAINT index_scheduler_pkey PRIMARY KEY (batch_id);


--
-- Name: index_scheduler; Type: ACL; Schema: public; Owner: admin
--

REVOKE ALL ON TABLE index_scheduler FROM PUBLIC;
REVOKE ALL ON TABLE index_scheduler FROM admin;
GRANT ALL ON TABLE index_scheduler TO admin;
GRANT ALL ON TABLE index_scheduler TO webuser;


--
-- PostgreSQL database dump complete
--

