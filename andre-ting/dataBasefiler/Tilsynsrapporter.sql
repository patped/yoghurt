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
	karakter4 TINYINT,
	PRIMARY KEY (tilsynid),
	FOREIGN KEY (tilsynsobjektid) REFERENCES Restauranter(tilsynsobjektid)
)Engine = INNODB;