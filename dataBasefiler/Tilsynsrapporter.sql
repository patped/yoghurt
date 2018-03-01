DROP TABLE IF EXISTS Tilsynsrapporter;
CREATE TABLE Tilsynsrapporter (
	tilsynsobjektid VARCHAR(50),
	tilsynid VARCHAR(50),
	sakref VARCHAR(15),
	status BOOLEAN,
	dato INTEGER,
	total_karakter TINYINT,
	tilsynsbesoektype BOOLEAN,
	tema1_no CHAR(20),
	karakter1 TINYINT,
	tema2_no CHAR(18),
	karakter2 TINYINT,
	tema3_no VARCHAR(40),
	karakter3 TINYINT,
	tema4_no VARCHAR(30),
	karakter4 TINYINT,
	PRIMARY KEY (tilsynid),
	FOREIGN KEY (tilsynsobjektid) REFERENCES Restauranter(tilsynsobjektid)
)Engine = INNODB;
INSERT INTO Tilsynsrapporter
SELECT m.tilsynsobjektid, m.tilsynid, m.sakref, m.status, m.dato, m.total_karakter, m.tilsynsbesoektype, m.tema1_no, m.karakter1, m.tema2_no, m.karakter2, m.tema3_no, m.karakter3, m.tema4_no, m.karakter4 
FROM matTabell as m;