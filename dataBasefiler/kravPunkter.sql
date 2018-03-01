DROP TABLE IF EXISTS kravpunkter;
create table kravpunkter (
	tilsynid varchar(50),
	dato int,
	ordingsverdi varchar(150),
	kravpunktnavn_no varchar (160),
	karakter tinyint,
	tekst_no varchar(160)
);