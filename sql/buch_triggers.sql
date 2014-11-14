-- Trigger-Definition fuer die Synchronisation
-- Buch (MySQL)

--autor
DELIMITER //
--DROP TRIGGER insert_autor;
CREATE TRIGGER insert_autor AFTER INSERT ON autor
	FOR EACH ROW BEGIN
    	INSERT INTO autor_changes (id, name, gebdat, time_stamp, action) VALUES (NEW.id, NEW.name, NEW.gebdat, NOW(), "INSERT");
    END; //
DELIMITER ;

DELIMITER //
----DROP TRIGGER delete_autor;
CREATE TRIGGER delete_autor AFTER DELETE ON autor
	FOR EACH ROW BEGIN
    	INSERT INTO autor_changes (id, name, gebdat, time_stamp, action) VALUES (OLD.id, OLD.name, OLD.gebdat, NOW(), "DELETE");
    END; //
DELIMITER ;

DELIMITER //
--DROP TRIGGER update_autor;
CREATE TRIGGER update_autor AFTER UPDATE ON autor
	FOR EACH ROW BEGIN
    	INSERT INTO autor_changes (id, name, gebdat, time_stamp, action) VALUES (NEW.id, NEW.name, NEW.gebdat, NOW(), "UPDATE");
    END; //
DELIMITER ;

--verlag
DELIMITER //
--DROP TRIGGER insert_verlag;
CREATE TRIGGER insert_verlag AFTER INSERT ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (id, name, time_stamp, action) VALUES (NEW.id, NEW.name, NOW(), "INSERT");
    END; //
DELIMITER ;

DELIMITER //
--DROP TRIGGER delete_verlag;
CREATE TRIGGER delete_verlag AFTER DELETE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (id, name, time_stamp, action) VALUES (OLD.id, OLD.name, NOW(), "DELETE");
    END; //
DELIMITER ;

DELIMITER //
--DROP TRIGGER update_verlag;
CREATE TRIGGER update_verlag AFTER UPDATE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (id, name, time_stamp, action) VALUES (NEW.id, NEW.name, NOW(), "UPDATE");
    END; //
DELIMITER ;

--buch
DELIMITER //
--DROP TRIGGER insert_buch;
CREATE TRIGGER insert_buch AFTER INSERT ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (isbn, titel, autor_id, verlag_id, time_stamp, action) VALUES (NEW.isbn, NEW.titel, NEW.autor_id, NEW.verlag_id, NOW(), "INSERT");
    END; //
DELIMITER ;

DELIMITER //
--DROP TRIGGER delete_buch;
CREATE TRIGGER delete_buch AFTER DELETE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (isbn, titel, autor_id, verlag_id, time_stamp, action) VALUES (OLD.isbn, OLD.titel, OLD.autor_id, OLD.verlag_id, NOW(), "DELETE");
    END; //
DELIMITER ;

DELIMITER //
--DROP TRIGGER update_buch;
CREATE TRIGGER update_buch AFTER UPDATE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (isbn, titel, autor_id, verlag_id, time_stamp, action) VALUES (NEW.isbn, NEW.titel, NEW.autor_id, NEW.verlag_id, NOW(), "UPDATE");
    END; //
DELIMITER ;