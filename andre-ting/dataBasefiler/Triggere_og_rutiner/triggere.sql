CREATE TRIGGER Brukere_dato BEFORE INSERT ON Brukere
FOR EACH ROW 
SET NEW.startDato = NOW();

CREATE TRIGGER Brukere_slutt_dato BEFORE INSERT ON Brukere
FOR EACH ROW 
SET NEW.sluttDato = NOW() + INTERVAL 30 DAY;

DELIMITER $$
DROP TRIGGER IF EXISTS brukernavnValidering $$
CREATE TRIGGER brukernavnValidering BEFORE INSERT ON Brukere
FOR EACH ROW
BEGIN
IF CHAR_LENGTH(NEW.brukernavn) < 5 THEN
	SIGNAL SQLSTATE '10000' 
    SET MESSAGE_TEXT = 'Brukernavn må inneholde minst 5 tegn';
    ELSEIF NEW.brukernavn REGEXP '[0-9]' = 0 THEN
    SIGNAL SQLSTATE '20000' 
    SET MESSAGE_TEXT = 'Brukernavn må inneholde minst 1 tall';
END IF;
END $$