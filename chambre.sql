SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etablissement` varchar(100) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `prix` varchar(100) NOT NULL,
  `source_image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
COMMIT;

INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Paris','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Paris','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Paris','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')

INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Bordeaux','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Bordeaux','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Bordeaux','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')

INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Brest','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Brest','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Brest','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')

INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Canne','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Canne','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Canne','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')

INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Nice','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Nice','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Nice','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')

INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Montpellier','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Montpellier','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Montpellier','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')

INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Strasbourg','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Strasbourg','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')
INSERT INTO `chambre`(`etablissement`, `titre`, `description`, `prix`, `id`, `source_image`) VALUES ('Hotel de Strasbourg','Chambre luxueuse',"Les chambres Single (18 m2) sont dotées d'un lit simple, d'une salle de bains en marbre à baignoire, et donnent sur la ville d'Estoril. Une boisson de bienvenue vous est également offerte.",'280','id','[value-6]')