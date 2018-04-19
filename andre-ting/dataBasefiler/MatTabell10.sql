drop table if exists MattilsynetBase;
create table MattilsynetBase(
	tilsynsobjektid VARCHAR(50),
	orgnummer INTEGER,
	navn VARCHAR(150),
	adrlinje1 VARCHAR(100),
	adrlinje2 VARCHAR(100),
	postnr CHAR(5),
	poststed VARCHAR(50),
	tilsynid VARCHAR(50),
	sakref VARCHAR(15),
	status BOOLEAN,
	dato INTEGER,
	total_karakter TINYINT,
	tilsynsbesoektype BOOLEAN,
	tema1_no CHAR(20),
	tema1_nn CHAR(18),
	karakter1 TINYINT,
	tema2_no CHAR(18),
	tema2_nn CHAR(18),
	karakter2 TINYINT,
	tema3_no VARCHAR(40),
	tema3_nn VARCHAR(40),
	karakter3 TINYINT,
	tema4_no VARCHAR(30),
	tema4_nn VARCHAR(30),
	karakter4 TINYINT
)Engine = INNODB;
INSERT INTO MattilsynetBase
select *  
from matTabell
where postnr between 3000 and 4000;

-------------------------------------------------- Lager karvpunkter: 

CREATE TABLE Kravpunkter2(
	tilsynid varchar(50),
	dato int,
	ordingsverdi varchar(150),
	kravpunktnavn_no varchar (160),
	kravpunktnavn_nn varchar (160),
	karakter tinyint,
	tekst_no varchar(160),
	tekst_nn varchar(160)--,
	--PRIMARY KEY (tilsynid, ordingsverdi)--,
	--FOREIGN KEY (tilsynid) REFERENCES Tilsynsrapporter(tilsynid)
)ENGINE = INNODB;

INSERT INTO Kravpunkter2 
SELECT * 
FROM Kravpunkter 
WHERE Kravpunkter.tilsynid IN (SELECT m.tilsynid from MattilsynetBase as m WHERE Kravpunkter.tilsynid = m.tilsynid)
