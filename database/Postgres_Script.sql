--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3
-- Dumped by pg_dump version 10.3

-- Started on 2018-04-25 03:10:35

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner:
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2850 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- TOC entry 211 (class 1255 OID 24665)
-- Name: alumno_curso_before_insert(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.alumno_curso_before_insert() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  DECLARE
  BEGIN

   NEW.promedio:=(new.n1 + new.n2 + new.n3 + new.n4) /4 ;

   RETURN NEW;
  END;
$$;


ALTER FUNCTION public.alumno_curso_before_insert() OWNER TO postgres;

--
-- TOC entry 214 (class 1255 OID 24676)
-- Name: usuarios_before_insert(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.usuarios_before_insert() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  DECLARE
  BEGIN
   new.password=md5(new.clave);

   RETURN NEW;
  END;
$$;


ALTER FUNCTION public.usuarios_before_insert() OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = true;

--
-- TOC entry 196 (class 1259 OID 24607)
-- Name: alumno_curso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumno_curso (
    id_alumno integer NOT NULL,
    id_curso integer NOT NULL,
    n1 double precision DEFAULT 0.0000000000000000 NOT NULL,
    n2 double precision DEFAULT 0.0000000000000000 NOT NULL,
    n3 double precision DEFAULT 0.0000000000000000 NOT NULL,
    n4 double precision DEFAULT 0.0000000000000000 NOT NULL,
    promedio double precision DEFAULT 0.0000000000000000 NOT NULL,
    notificado smallint DEFAULT '0'::smallint NOT NULL
);


ALTER TABLE public.alumno_curso OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 24621)
-- Name: alumnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumnos (
    id_alumno integer NOT NULL,
    paterno character varying(30) NOT NULL,
    materno character varying(30) NOT NULL,
    nombre character varying(30) NOT NULL,
    dni character varying(8) NOT NULL,
    cumple date,
    correo character varying(50)
);


ALTER TABLE public.alumnos OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 24619)
-- Name: alumnos_id_alumno_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.alumnos_id_alumno_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.alumnos_id_alumno_seq OWNER TO postgres;

--
-- TOC entry 2851 (class 0 OID 0)
-- Dependencies: 197
-- Name: alumnos_id_alumno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.alumnos_id_alumno_seq OWNED BY public.alumnos.id_alumno;


--
-- TOC entry 200 (class 1259 OID 24631)
-- Name: cursos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cursos (
    id_curso integer NOT NULL,
    curso_nombre character varying(50) NOT NULL
);


ALTER TABLE public.cursos OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 24629)
-- Name: cursos_id_curso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cursos_id_curso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cursos_id_curso_seq OWNER TO postgres;

--
-- TOC entry 2852 (class 0 OID 0)
-- Dependencies: 199
-- Name: cursos_id_curso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cursos_id_curso_seq OWNED BY public.cursos.id_curso;


--
-- TOC entry 202 (class 1259 OID 24640)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    login character varying(20) NOT NULL,
    clave character varying(20) NOT NULL,
    password character varying(50) NOT NULL
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 24638)
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_usuario_seq OWNER TO postgres;

--
-- TOC entry 2853 (class 0 OID 0)
-- Dependencies: 201
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;


--
-- TOC entry 203 (class 1259 OID 24678)
-- Name: vAlumnosReporte; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public."vAlumnosReporte" AS
 SELECT a.id_alumno,
    concat_ws(' '::text, a.paterno, a.materno, a.nombre) AS alumno,
    b.id_curso,
    c.curso_nombre,
    b.n1,
    b.n2,
    b.n3,
    b.n4,
    b.promedio,
    b.notificado
   FROM ((public.alumnos a
     LEFT JOIN public.alumno_curso b ON ((a.id_alumno = b.id_alumno)))
     LEFT JOIN public.cursos c ON ((b.id_curso = c.id_curso)))
  ORDER BY a.paterno, a.materno, a.nombre;


ALTER TABLE public."vAlumnosReporte" OWNER TO postgres;

--
-- TOC entry 2698 (class 2604 OID 24624)
-- Name: alumnos id_alumno; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnos ALTER COLUMN id_alumno SET DEFAULT nextval('public.alumnos_id_alumno_seq'::regclass);


--
-- TOC entry 2699 (class 2604 OID 24634)
-- Name: cursos id_curso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cursos ALTER COLUMN id_curso SET DEFAULT nextval('public.cursos_id_curso_seq'::regclass);


--
-- TOC entry 2700 (class 2604 OID 24643)
-- Name: usuarios id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);


--
-- TOC entry 2836 (class 0 OID 24607)
-- Dependencies: 196
-- Data for Name: alumno_curso; Type: TABLE DATA; Schema: public; Owner: postgres
--


--
-- TOC entry 2838 (class 0 OID 24621)
-- Dependencies: 198
-- Data for Name: alumnos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.alumnos (id_alumno, paterno, materno, nombre, dni, cumple, correo) FROM stdin;
1	ALMEYDA	LÉVANO	PERCY	12345678	1975-11-07	palmeyda@php.uni
2	AGREDA	ZAPATA	CÉSAR	12345671	1976-12-08	cagreda@php.uni
3	ACEDO	ROJAS	EVA	12345672	2018-02-24	eacedo@php.uni
4	ACEVEDO	SANCHEZ	INÉS	12345673	1980-02-24	iacevedo@php.uni
5	ACERO	TORRES	KATHERINE	12345674	1983-08-25	kacero@php.uni
6	CARRERA	PEÑA	LUIS	12345675	1975-03-29	lcarrera@php.uni
7	CABRERA	QUIROZ	MARTIN	12345676	2004-06-13	mcabrera@php.uni
8	CASPORERA	POZO	CARMEN	12345677	1986-02-27	ccasporera@php.uni
\.


--
-- TOC entry 2840 (class 0 OID 24631)
-- Dependencies: 200
-- Data for Name: cursos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cursos (id_curso, curso_nombre) FROM stdin;
1	PHP1 - BASICO
2	PHP2 - INTERMEDIO
3	PHP3 - AVANZADO
\.


--
-- TOC entry 2842 (class 0 OID 24640)
-- Dependencies: 202
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id_usuario, login, clave, password) FROM stdin;
1	admin	admin	21232f297a57a5a743894a0e4a801fc3
2	alumno	123456	e10adc3949ba59abbe56e057f20f883e
\.


--
-- TOC entry 2854 (class 0 OID 0)
-- Dependencies: 197
-- Name: alumnos_id_alumno_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.alumnos_id_alumno_seq', 40, true);


--
-- TOC entry 2855 (class 0 OID 0)
-- Dependencies: 199
-- Name: cursos_id_curso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cursos_id_curso_seq', 4, false);


--
-- TOC entry 2856 (class 0 OID 0)
-- Dependencies: 201
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 3, false);


--
-- TOC entry 2703 (class 2606 OID 24617)
-- Name: alumno_curso alumno_curso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno_curso
    ADD CONSTRAINT alumno_curso_pkey PRIMARY KEY (id_alumno, id_curso);


--
-- TOC entry 2706 (class 2606 OID 24627)
-- Name: alumnos alumnos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnos
    ADD CONSTRAINT alumnos_pkey PRIMARY KEY (id_alumno);


--
-- TOC entry 2708 (class 2606 OID 24637)
-- Name: cursos cursos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cursos
    ADD CONSTRAINT cursos_pkey PRIMARY KEY (id_curso);


--
-- TOC entry 2711 (class 2606 OID 24646)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- TOC entry 2701 (class 1259 OID 24618)
-- Name: alumno_curso_id_curso_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX alumno_curso_id_curso_idx ON public.alumno_curso USING btree (id_curso);


--
-- TOC entry 2704 (class 1259 OID 24628)
-- Name: alumnos_dni_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX alumnos_dni_idx ON public.alumnos USING btree (dni);


--
-- TOC entry 2709 (class 1259 OID 24647)
-- Name: usuarios_login_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX usuarios_login_idx ON public.usuarios USING btree (login);


--
-- TOC entry 2712 (class 2620 OID 24666)
-- Name: alumno_curso alumno_curso_before_insert; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER alumno_curso_before_insert BEFORE INSERT OR UPDATE ON public.alumno_curso FOR EACH ROW EXECUTE PROCEDURE public.alumno_curso_before_insert();


--
-- TOC entry 2713 (class 2620 OID 24677)
-- Name: usuarios usuarios_before_insert; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER usuarios_before_insert BEFORE INSERT OR UPDATE ON public.usuarios FOR EACH ROW EXECUTE PROCEDURE public.usuarios_before_insert();


-- Completed on 2018-04-25 03:10:35

--
-- PostgreSQL database dump complete
--
