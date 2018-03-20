DELIMITER $$
CREATE PROCEDURE rettighet_sjekk(innBrukernavn VARCHAR(30))
BEGIN
DECLARE sDato DATE;
DECLARE iDag DATE;
SET iDag = NOW();
SELECT sluttDato INTO sDato
FROM Brukere
WHERE brukernavn LIKE innBrukernavn;

IF iDag > sDato THEN
UPDATE Brukere SET adminRettighet = 0 WHERE brukernavn LIKE innBrukernavn;
END IF;
END $$