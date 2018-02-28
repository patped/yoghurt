DROP TABLE IF EXISTS kravpunkter;
create table kravpunkter (
	tilsynid varchar(50),
	dato SMALLINT,
	ordingsverdi varchar(150),
	kravpunktnavn_no varchar (160),
	karakter smallint,
	tekst_no varchar(160)
);