
-----------------------------------------------------------------------
-- autor
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "autor" CASCADE;

CREATE TABLE "autor"
(
    "id" serial NOT NULL,
    "gebdat" VARCHAR(50) NOT NULL,
    "beschreibung" VARCHAR,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- werk
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "werk" CASCADE;

CREATE TABLE "werk"
(
    "name" VARCHAR NOT NULL,
    "autor_id" INTEGER,
    "isbn" VARCHAR(24) NOT NULL,
    "release" DATE NOT NULL,
    PRIMARY KEY ("name")
);

-----------------------------------------------------------------------
-- autor_changes
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "autor_changes" CASCADE;

CREATE TABLE "autor_changes"
(
    "id" serial NOT NULL,
    "gebdat" VARCHAR(50) NOT NULL,
    "beschreibung" VARCHAR,
    "time_stamp" DATE NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- werk_changes
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "werk_changes" CASCADE;

CREATE TABLE "werk_changes"
(
    "name" VARCHAR NOT NULL,
    "autor_id" INTEGER,
    "isbn" VARCHAR(24) NOT NULL,
    "release" DATE NOT NULL,
    "time_stamp" DATE NOT NULL,
    PRIMARY KEY ("name")
);

ALTER TABLE "werk" ADD CONSTRAINT "werk_FK_1"
    FOREIGN KEY ("autor_id")
    REFERENCES "autor" ("id");

ALTER TABLE "werk_changes" ADD CONSTRAINT "werk_changes_FK_1"
    FOREIGN KEY ("autor_id")
    REFERENCES "autor" ("id");
