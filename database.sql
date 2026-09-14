CREATE DATABASE IF NOT EXISTS `dbBat` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dbBat`;

CREATE TABLE IF NOT EXISTS `BATEAU` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(100) NOT NULL,
    `longueur` DECIMAL(10,2) NOT NULL,
    `largeur` DECIMAL(10,2) NOT NULL,
    `vitesse` DECIMAL(10,2) NOT NULL,
    `image` VARCHAR(255) NOT NULL DEFAULT '',
    `poidsMax` DECIMAL(10,2) NOT NULL DEFAULT 0,
    `type` CHAR(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `EQUIPEMENT` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `lib` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `POSSEDER` (
    `idBat` INT NOT NULL,
    `idEquip` INT NOT NULL,
    PRIMARY KEY (`idBat`, `idEquip`),
    CONSTRAINT `fk_posseder_bateau` FOREIGN KEY (`idBat`) REFERENCES `BATEAU` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_posseder_equipement` FOREIGN KEY (`idEquip`) REFERENCES `EQUIPEMENT` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `BATEAU` (`id`, `nom`, `longueur`, `largeur`, `vitesse`, `image`, `poidsMax`, `type`) VALUES
(1, 'Luce isle', 37.20, 8.60, 26.00, 'images/bateauvoyageur/bateau-1.jpg', 0, 'v'),
(2, 'Al\' xi', 28.50, 7.20, 22.00, 'images/bateauvoyageur/bateau-2.jpg', 0, 'v')
ON DUPLICATE KEY UPDATE `nom` = VALUES(`nom`), `image` = VALUES(`image`);

INSERT INTO `EQUIPEMENT` (`id`, `lib`) VALUES
(1, 'Acces handicape'),
(2, 'Bar'),
(3, 'Pont promenade'),
(4, 'Salon video')
ON DUPLICATE KEY UPDATE `lib` = VALUES(`lib`);

INSERT IGNORE INTO `POSSEDER` (`idBat`, `idEquip`) VALUES
(1, 1), (1, 2), (1, 3), (1, 4),
(2, 1), (2, 2), (2, 4);
