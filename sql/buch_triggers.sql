-- Trigger-Definition fuer die Synchronisation
-- Buch (MySQL)

--autor
DLIMITER //
CREATE OR REPLACE TRIGGER insert_autor AFTER INSERT ON autor
	FOR EACH ROW BEGIN
    	INSERT INTO autor_changes (id, name, gebdat, time_stamp, action) VALUES (:NEW.id, :NEW.name, :NEW.gebdat, NOW(), "INSERT");
    END; //
DELMITER ;

DLIMITER //
CREATE OR REPLACE TRIGGER delete_autor AFTER DELETE ON autor
	FOR EACH ROW BEGIN
    	INSERT INTO autor_changes (id, name, gebdat, time_stamp, action) VALUES (:OLD.id, :OLD.name, :OLD.gebdat, NOW(), "DELETE");
    END; //
DELMITER ;

DLIMITER //
CREATE OR REPLACE TRIGGER update_autor AFTER UPDATE ON autor
	FOR EACH ROW BEGIN
    	INSERT INTO autor_changes (id, name, gebdat, time_stamp, action) VALUES (:OLD.id, :OLD.name, :OLD.gebdat, NOW(), "UPDATE");
    END; //
DELMITER ;

--verlag
CREATE OR REPLACE TRIGGER insert_verlag AFTER INSERT ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (id, name, time_stamp, action) VALUES (:NEW.id, :NEW.name, NOW(), "INSERT");
    END; //
DELMITER ;

DLIMITER //
CREATE OR REPLACE TRIGGER delete_verlag AFTER DELETE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (id, name, time_stamp, action) VALUES (:OLD.id, :OLD.name, NOW(), "DELETE");
    END; //
DELMITER ;

DLIMITER //
CREATE OR REPLACE TRIGGER update_verlag AFTER UPDATE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (id, name, time_stamp, action) VALUES (:OLD.id, :OLD.name, NOW(), "UPDATE");
    END; //
DELMITER ;

--buch
CREATE OR REPLACE TRIGGER insert_buch AFTER INSERT ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (isbn, titel, autor_id, verlag_id, time_stamp, action) VALUES (:NEW.isbn, :NEW.titel, :NEW.autor_id, :NEW.verlag_id, NOW(), "INSERT");
    END; //
DELMITER ;

DLIMITER //
CREATE OR REPLACE TRIGGER delete_buch AFTER DELETE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO verlag_changes (isbn, titel, autor_id, verlag_id, time_stamp, action) VALUES (:OLD.isbn, :OLD.titel, :OLD.autor_id, :OLD.verlag_id, NOW(), "DELETE");
    END; //
DELMITER ;

DLIMITER //
CREATE OR REPLACE TRIGGER update_buch AFTER UPDATE ON verlag
	FOR EACH ROW BEGIN
    	INSERT INTO (isbn, titel, autor_id, verlag_id, time_stamp, action) VALUES (:OLD.isbn, :OLD.titel, :OLD.autor_id, :OLD.verlag_id, NOW(), "UPDATE");
    END; //
DELMITER ;