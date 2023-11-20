CREATE TABLE IF NOT EXISTS `#__planets` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `asset_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `title` VARCHAR(400),
    `alias` VARCHAR(450),
    `description` MEDIUMTEXT,
    `published` TINYINT(3),
    `image` VARCHAR(1024),
    `params` MEDIUMTEXT,
    `ordering` INT(11),
    `access` TINYINT(4) UNSIGNED,
    `created_by` INT(10) UNSIGNED,
    `created` DATETIME,
    `modified` DATETIME,
    `hits` INT(10) UNSIGNED,
    `language` CHAR(7),
    `note` VARCHAR(255),
    `type` VARCHAR(255),
    PRIMARY KEY (`id`)
)
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    DEFAULT COLLATE=utf8mb4_unicode_ci;

    