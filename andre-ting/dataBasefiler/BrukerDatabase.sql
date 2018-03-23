DROP TABLE IF EXISTS BrukerDatabase;
DROP TABLE IF EXISTS Brukere;
CREATE TABLE Brukere(
	brukerID INTEGER AUTO_INCREMENT,
	brukernavn VARCHAR(30) NOT NULL,
	passord VARCHAR(300),
	telefonnummer VARCHAR(20),
	adminrettighet BOOLEAN,
    PRIMARY KEY (BrukerID)
)ENGINE=INNODB;

INSERT INTO `Brukere`(`brukernavn`, `passord`, `telefonnummer`, `adminrettighet`) VALUES ("Kim", "", "99999999", false);
INSERT INTO `Brukere`(`brukernavn`, `passord`, `telefonnummer`, `adminrettighet`) VALUES ("Patrick", "", "99999999", true);
INSERT INTO `Brukere`(`brukernavn`, `passord`, `telefonnummer`, `adminrettighet`) VALUES ("Ola", "", "99999999", true);
INSERT INTO `Brukere`(`brukernavn`, `passord`, `telefonnummer`, `adminrettighet`) VALUES ("Mathias", "", "99999999", true);
INSERT INTO `Brukere`(`brukernavn`, `passord`, `telefonnummer`, `adminrettighet`) VALUES ("Ingeborg", "", "99999999", true);