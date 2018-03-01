DROP TABLE IF EXISTS Restauranter;
CREATE TABLE Restauranter (
	tilsynsobjektid VARCHAR(50),
	orgnummer INTEGER,
	navn VARCHAR(150),
	adrlinje1 VARCHAR(100),
	adrlinje2 VARCHAR(100),
	postnr CHAR(5),
	PRIMARY KEY (tilsynsobjektid),
	FOREIGN KEY (postnr) REFERENCES Poststed(postnr)
)Engine = INNODB;
INSERT INTO Restauranter
SELECT DISTINCT mt.tilsynsobjektid, mt.orgnummer, mt.navn, mt.adrlinje1, mt.adrlinje2, mt.postnr 
FROM matTabell as mt 
WHERE mt.postnr 