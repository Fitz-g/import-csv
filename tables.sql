-- Adminer 4.6.3 PostgreSQL dump

DROP TABLE IF EXISTS "data";
DROP SEQUENCE IF EXISTS data_id_seq;
CREATE SEQUENCE data_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."data" (
    "id" integer DEFAULT nextval('data_id_seq') NOT NULL,
    "id_transaction" character varying(100) NOT NULL,
    "site_id" character varying(10) NOT NULL,
    "payment_result" character varying(100) NOT NULL,
    "operator_id" character varying(255) NOT NULL,
    "payment_date" date NOT NULL,
    "payment_hour" time without time zone NOT NULL,
    "file_id" bigint NOT NULL
) WITH (oids = false);


DROP TABLE IF EXISTS "files";
DROP SEQUENCE IF EXISTS files_id_seq;
CREATE SEQUENCE files_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."files" (
    "id" integer DEFAULT nextval('files_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "rows_number" bigint NOT NULL
) WITH (oids = false);


-- 2020-01-28 17:18:42.967269+00
