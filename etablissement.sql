SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `source_image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
COMMIT;

INSERT INTO `etablissement`(`nom`, `adresse`, `ville`, `description`, `source_image`, `id`) VALUES ('Hotel de Paris','3 Rue de la Tremoil','Paris','Magnifique hotel en plein coeur de Paris','[value-5]','[value-6]')

INSERT INTO `etablissement`(`nom`, `adresse`, `ville`, `description`, `source_image`, `id`) VALUES ('Hotel de Montpellier','36 Boulevard Amiral','Montpellier','Magnifique hotel en plein coeur de Paris','[value-5]','[value-6]')

INSERT INTO `etablissement`(`nom`, `adresse`, `ville`, `description`, `source_image`, `id`) VALUES ('Hotel de Bordeaux','25 Rue De La Gravaud','Bordeaux','Magnifique hotel en plein coeur de Paris','[value-5]','[value-6]')

INSERT INTO `etablissement`(`nom`, `adresse`, `ville`, `description`, `source_image`, `id`) VALUES ('Hotel de Brest','62 place de la Madel','Brest','Magnifique hotel en plein coeur de Paris','[value-5]','[value-6]')

INSERT INTO `etablissement`(`nom`, `adresse`, `ville`, `description`, `source_image`, `id`) VALUES ('Hotel de Canne','68 Rue Jean Vilar','Canne','Magnifique hotel en plein coeur de Paris','[value-5]','[value-6]')

INSERT INTO `etablissement`(`nom`, `adresse`, `ville`, `description`, `source_image`, `id`) VALUES ('Hotel de Nice','97 Rue du Limas','Nice','Magnifique hotel en plein coeur de Paris','[value-5]','[value-6]')

INSERT INTO `etablissement`(`nom`, `adresse`, `ville`, `description`, `source_image`, `id`) VALUES ('Hotel de Strasbourg','83 Rue des Dunes','Strasbourg','Magnifique hotel en plein coeur de Paris','[value-5]','[value-6]')