DROP VIEW IF EXISTS katKina;
CREATE VIEW katKina AS
SELECT * FROM Restauranter AS r
WHERE r.navn LIKE '%china%' OR r.navn LIKE '%kinesisk%' OR r.navn LIKE '%kina%' OR r.navn LIKE '%chinese%';

DROP VIEW IF EXISTS katIndia;
CREATE VIEW katIndia AS
SELECT * FROM Restauranter AS r
WHERE r.navn LIKE '%korma%' OR r.navn LIKE '%masala%' OR r.navn LIKE '%india%' OR r.navn LIKE '%indisk%' OR r.navn LIKE '%hindu%' OR r.navn LIKE '%hindi%' OR r.navn LIKE '%bombay%';

DROP VIEW IF EXISTS katAsia;
CREATE VIEW katAsia AS
SELECT * FROM Restauranter AS r
WHERE r.navn LIKE '%thai%' OR r.navn LIKE '%viet%' OR r.navn LIKE '%curry%' OR r.navn LIKE '%kong%';

DROP VIEW IF EXISTS katItalia;
CREATE VIEW katItalia AS
SELECT * FROM Restauranter AS r
WHERE r.navn LIKE '%pasta%' OR r.navn LIKE '%milano%' OR r.navn LIKE '%parma%' OR r.navn LIKE '%roma%' OR r.navn LIKE '%italia%' OR r.navn LIKE '%italy%' OR r.navn LIKE '%bolognese%' OR r.navn LIKE '%pizza%' OR r.navn LIKE '%pizzeria%';

DROP VIEW IF EXISTS katBurger;
CREATE VIEW katBurger AS
SELECT * FROM Restauranter AS r
WHERE r.navn LIKE '%burger%' OR r.navn LIKE '%kebab%' OR r.navn LIKE '%mcdonalds%' OR r.navn LIKE '%max%';