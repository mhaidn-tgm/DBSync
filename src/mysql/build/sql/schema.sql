
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- autor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `autor`;

CREATE TABLE `autor`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `gebdat` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- verlag
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `verlag`;

CREATE TABLE `verlag`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- buch
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `buch`;

CREATE TABLE `buch`
(
    `isbn` VARCHAR(24) NOT NULL,
    `titel` VARCHAR(50) NOT NULL,
    `autor_id` INTEGER,
    `verlag_id` INTEGER,
    PRIMARY KEY (`isbn`),
    INDEX `buch_FI_1` (`autor_id`),
    INDEX `buch_FI_2` (`verlag_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- autor_changes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `autor_changes`;

CREATE TABLE `autor_changes`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `gebdat` DATE NOT NULL,
    `time_stamp` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- verlag_changes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `verlag_changes`;

CREATE TABLE `verlag_changes`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `time_stamp` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- buch_changes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `buch_changes`;

CREATE TABLE `buch_changes`
(
    `isbn` VARCHAR(24) NOT NULL,
    `titel` VARCHAR(50) NOT NULL,
    `autor_id` INTEGER,
    `verlag_id` INTEGER,
    `time_stamp` DATE NOT NULL,
    PRIMARY KEY (`isbn`),
    INDEX `buch_changes_FI_1` (`autor_id`),
    INDEX `buch_changes_FI_2` (`verlag_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
