DROP TABLE IF EXISTS Poststed;
CREATE TABLE Poststed (
	postnr CHAR(5),
	poststed VARCHAR(50),
	PRIMARY KEY (postnr)
)Engine = INNODB;