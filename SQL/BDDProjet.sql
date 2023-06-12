DROP DATABASE IF EXISTS  `outilsupervision`;

CREATE DATABASE IF NOT EXISTS `outilsupervision` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `outilsupervision`;

CREATE TABLE IF NOT EXISTS `groupement` (
  `gro_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `gro_nom` varchar(60) NOT NULL
) ENGINE = INNODB  CHARACTER SET=utf8mb4;

INSERT INTO `groupement` (`gro_id`, `gro_nom`) 
VALUES
	(1, 'Est'),
	(2, 'Nord'),
	(3, 'Centre'),
	(4,  'Sud');

CREATE TABLE IF NOT EXISTS `localisation` (
  `loc_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `loc_nom` varchar(60) NOT NULL,
  `loc_codepostal` int(11) DEFAULT NULL,
  `loc_groid` smallint(5) unsigned NOT NULL,
  FOREIGN KEY (`loc_groid`) REFERENCES `groupement` (`gro_id`)
) ENGINE = INNODB  CHARACTER SET=utf8mb4;

INSERT INTO `localisation` (`loc_id`, `loc_nom`, `loc_codepostal`, `loc_groid`) VALUES
	(1, 'Evry', 91000, 1),
	(2, 'Ballancourt', 91610, 1),
	(3, 'Corbeil-Essonnes',91100, 1),
	(4, 'Draveil', 91210, 1),
	(5, "Val d'Yerres", 91860, 1),
	(6, 'Mennecy', 91540, 1),
	(7, 'Montgeron', 91230, 1),
	(8, 'Ris-Orangis', 91130, 1),
	(9, 'Soisis-sur-Seine', 91450, 1),
	(10, 'Viry-Chatillon', 91170, 1),
	(11, 'Lisses', 91090, 1),
	(12, 'Vert-le-Grand', 91810, 1),
	(13, 'Palaiseau', 91120, 2),
	(14, 'Athis-Mons', 91200, 2),
	(15, 'Gif-sur-Yvette', 91190, 2),
	(16, 'Juvisy-sur-Orge', 91260, 2),
	(17, 'Les Ulis', 91940, 2),
	(18, 'Longjumeau', 91160, 2),
	(19, 'Massy', 91300, 2),
	(20, 'Savigny', 91600, 2),
	(21, 'Balainvilliers', 91160, 2),
	(22, 'Bievres', 91570, 2),
	(23, 'Chilly-Mazarin', 91380, 2),
	(24, 'Epinay-sur-Orge', 91360, 2),
	(25, 'Wissous', 91320, 2),
	(26, 'Arpajon', 91290, 3),
	(27, 'Bretigny-sur-Orge', 91220, 3),
	(28, 'Dourdan', 91410, 3),
	(29, 'Lardy', 91510, 3),
	(30, 'Limours', 91470, 3),
	(31, 'Montlhery', 91310, 3),
	(32, 'Saint-Cheron', 91530, 3),
	(33, 'Sainte-Genevieve-des-Bois', 91700, 3),
	(34, 'Breuillet', 91650, 3),
	(35, 'Marcoussis', 91460, 3),
	(36, 'Marolles-en-Hurepoix', 91630, 3),
	(37, 'Etampes', 91150, 4),
	(38, 'Angerville', 91670, 4),
	(39, 'Chalo-Saint-Mars', 91780, 4),
	(40, 'Cerny La Ferte-Alais', 91780, 4),
	(41, 'Etrechy', 91580, 4),
	(42, 'Maisse', 91720, 4),
	(43, 'Milly-la-Foret', 91490, 4),
	(44, 'Mondeville', 91590, 4),
	(45, 'Saclas', 91690, 4),
	(46, "Val d'Ecole", 91840, 4),
	(47, 'Boissy-le-Cutte', 91590,4),
	(48, 'Boutigny-sur-Essonne', 91820, 4),
	(49, 'Mereville', 91660, 4),
	(50, 'Puiselet-le-Marais', 91150, 4),
	(51, 'Pussay', 91740, 4);

	CREATE TABLE IF NOT EXISTS `typeequipement` (
	`typ_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`typ_nom` varchar(20) NOT NULL
	) ENGINE = INNODB  CHARACTER SET=utf8mb4;


	INSERT INTO `typeequipement` (`typ_id`, `typ_nom`) VALUES
		(4, 'Espion BIP'),
		(2, 'Imprimante'),
		(5, 'Onduleur'),
		(1, 'PBX'),
		(3, 'Programmateur BIP');
	
-- Listage de la structure de la table outilsupervision. equipement
CREATE TABLE IF NOT EXISTS `equipement` (
  `equ_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `equ_adresseip` varchar(30) NOT NULL UNIQUE,
  `equ_modele` varchar(30) NOT NULL,
  `equ_typeid` smallint(5) unsigned NOT NULL,
  `equ_locid` smallint(5) unsigned NOT NULL,
  FOREIGN KEY (`equ_typeid`) REFERENCES `typeequipement` (`typ_id`) ON DELETE CASCADE,
  FOREIGN KEY (`equ_locid`) REFERENCES `localisation` (`loc_id`) ON DELETE CASCADE
) ENGINE = INNODB  CHARACTER SET=utf8mb4;


INSERT INTO `equipement` (`equ_id`, `equ_adresseip`, `equ_modele`, `equ_typeid`, `equ_locid`) VALUES
	(1, '192.168.1.1', 'Orchid PBX 308+', 1, 7),
	(2, '192.168.1.10', 'Canon Pixma TS5350', 2, 34),
	(3, '192.168.1.82', 'de710\r\n', 4, 13),
	(4, '192.168.1.45', 'ACH 5kvAh', 5, 51),
	(15, '192.168.1.7', 'Yeastar TG100', 1, 9),
	(16, '192.168.1.15', 'HP DeskJet 2723e', 2, 4),
	(17, '192.168.1.86', 'de710\r\n', 4, 23),
	(18, '192.168.1.95', 'VI 1500VA STL', 5, 45);


CREATE TABLE IF NOT EXISTS `profil` (
  `pro_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pro_nom` varchar(30) DEFAULT NULL,
  `pro_passe` varchar(255) NOT NULL,
  `pro_droit` smallint(5) unsigned NOT NULL
) ENGINE = INNODB  CHARACTER SET=utf8mb4;


INSERT INTO `profil` (`pro_id`, `pro_nom`, `pro_passe`, `pro_droit`) VALUES
	(1, 'Bonsoir', '$2y$10$KmVY8aLhx3tIYI0TUfhjWeg.K4gD1sLs/lchG/NhQXD/NROQwlaHm', 1),
	(2, 'test', '$2y$10$dZPHl5YOS2wnVzOJE.5eROH7O.9f.L00oOEK6iyqRM7Rb5nahoOcW', 1),
	(3, 'Supervis', '$2y$10$cIA/NRJBIDdD.8dsUIuTUuLXn80lfbEiVcpC5XcJ8yuhUjXHTdoYa', 2),
	(4, 'Lucas', '$2y$10$1MOfTUT6nLVKokDDX9AMq.s9ScQAK/9KLA/ivYoMfYf5y2J8rYfKa', 2),
	(5, 'Test2', '$2y$10$yVzuCPIMo2E3bBv9AZ7MguDAKuul0D2QZFkGHQXTFQrF/CRlu3IWO', 2);

CREATE TABLE IF NOT EXISTS `intervenir` (
  `int_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `int_typeequid` smallint(5) unsigned NOT NULL,
  `int_proid` smallint(5) unsigned NOT NULL,
  FOREIGN KEY (`int_proid`) REFERENCES `profil` (`pro_id`),
  FOREIGN KEY (`int_typeequid`) REFERENCES `typeequipement` (`typ_id`)
) ENGINE = INNODB  CHARACTER SET=utf8mb4;


