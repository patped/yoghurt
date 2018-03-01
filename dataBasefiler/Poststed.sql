DROP TABLE IF EXISTS Poststed;
CREATE TABLE Poststed (
	postnr CHAR(5),
	poststed VARCHAR(50),
	PRIMARY KEY (postnr)
)Engine = INNODB;
INSERT IGNORE INTO Poststed 
SELECT DISTINCT mt.postnr, mt.poststed
FROM matTabell as mt WHERE mt.poststed LIKE '%%'; -- Mister 13 dublikater. FUNKER IKKE UTEN IGNORE