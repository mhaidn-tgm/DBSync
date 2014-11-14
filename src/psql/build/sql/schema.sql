
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

ALTER TABLE "werk" ADD CONSTRAINT "werk_FK_1"
    FOREIGN KEY ("autor_id")
    REFERENCES "autor" ("id");
