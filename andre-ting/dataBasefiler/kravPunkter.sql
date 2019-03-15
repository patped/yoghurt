DROP TABLE IF EXISTS Kravpunkter;
create table Kravpunkter (
	tilsynid varchar(50),
	dato int,
	ordingsverdi varchar(150),
	kravpunktnavn_no varchar (160),
	kravpunktnavn_nn varchar (160),
	karakter tinyint,
	tekst_no varchar(160),
	tekst_nn varchar(160),
	PRIMARY KEY (tilsynid, ordingsverdi),
	FOREIGN KEY (tilsynid) REFERENCES Tilsynsrapporter(tilsynid)
)ENGINE = INNODB;