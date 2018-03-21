DELIMITER $$
DROP PROCEDURE IF EXISTS rettighet_sjekk $$
CREATE PROCEDURE rettighet_sjekk(IN innBrukernavn VARCHAR(30), OUT returnadmin INT)
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
SELECT adminRettighet INTO returnadmin FROM Brukere WHERE brukernavn LIKE innBrukernavn;
END $$