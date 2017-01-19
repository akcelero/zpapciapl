DELIMITER //


USE zpapciapl ;
DROP TRIGGER IF EXISTS usun;
CREATE TRIGGER usun
BEFORE DELETE
	ON workers FOR EACH ROW
BEGIN 
declare blad varchar(300);
UPDATE workIn set active = '0' where idWorker=OLD.id; 
DELETE from travels where idWorker = OLD.id;
IF EXISTS (SELECT * FROM bossOf where idBoss = OLD.id)
THEN
	set blad = 'To jest boss';
	signal SQLSTATE '45000' set MESSAGE_TEXT = blad;
END IF;

DELETE from bossOf where idWorker = OLD.id;

END //
DELIMITER ;
