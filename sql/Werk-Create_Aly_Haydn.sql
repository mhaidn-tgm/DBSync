CREATE TABLE Autor (
 id INT NOT NULL,
 GebDat DATE,
 Beschreibung CHAR(10)
);

ALTER TABLE Autor ADD CONSTRAINT PK_Autor PRIMARY KEY (id);


CREATE TABLE Werk (
 name VARCHAR(50) NOT NULL,
 id INT NOT NULL,
 release DATE,
 verlag VARCHAR(50),
 SSID CHAR(10)
);

ALTER TABLE Werk ADD CONSTRAINT PK_Werk PRIMARY KEY (name,id);


ALTER TABLE Werk ADD CONSTRAINT FK_Werk_0 FOREIGN KEY (id) REFERENCES Autor (id);


