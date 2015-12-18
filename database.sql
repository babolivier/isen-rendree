-- MySQL dump 10.13  Distrib 5.6.26, for Linux (x86_64)
--
-- Host: localhost    Database: rentree
-- ------------------------------------------------------
-- Server version	5.6.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nom_fils` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom_fils` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ddn_fils` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tel_mobile` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `courriel` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data`
--

LOCK TABLES `data` WRITE;
/*!40000 ALTER TABLE `data` DISABLE KEYS */;
INSERT INTO `data` VALUES (3,'contact@brendanabolivier.com','Abolivier','Brendan','08/08/1995','0658853799','christian.abolivier@gmail.com','2015-11-23 16:39:37','0.0.0.0'),(4,'contact@brendanabolivier.com','Michaud','Paul','07/08/1995','0658853799','christian.abolivier@gmail.com','2015-11-23 17:10:06','0.0.0.0');
/*!40000 ALTER TABLE `data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rang` int(11) NOT NULL,
  `promo` varchar(20) DEFAULT NULL,
  `libelle` varchar(256) NOT NULL,
  `fichier` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `document_ibfk_1` (`promo`),
  CONSTRAINT `document_ibfk_1` FOREIGN KEY (`promo`) REFERENCES `promo` (`id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (1,5,'CSI_A3','Intégration','A12/CIR1B_CIR1R_CSI1_Courrier-integration-1.pdf'),(2,5,'CIR_RENNES_A1','Intégration','A12/CIR1B_CIR1R_CSI1_Courrier-integration-1.pdf'),(3,5,'CSI_A1','Intégration','A12/CIR1B_CIR1R_CSI1_Courrier-integration-1.pdf'),(4,5,NULL,'Offre banque BNP','BNP_Flyer_Rentree_2015.pdf'),(5,6,NULL,'Offre banque CMB','CMB_Flyers_Rentree_2015.pdf'),(6,7,NULL,'Offre banque Société Générale','SOCIETE GENERALE_Flyer_Rentree_2015.pdf'),(7,3,'CSI_A1','Annonce ordinateur portable','A12/courrierAnnoncePortable-2015-CSI-CIPA.pdf'),(8,3,'CSI_A3','Annonce ordinateur portable','A345/courrierAnnoncePortable-2015-CSI-CIPA.pdf'),(9,2,'CIPA_A3','Annonce ordinateur portable','A345/courrierAnnoncePortable-2015-CSI-CIPA.pdf'),(10,4,'CSI_A1','Dossier ordinateur portable','A12/acquisitionPortable-2015-CSI-CIPA.pdf'),(11,4,'CSI_A3','Dossier ordinateur portable','A345/acquisitionPortable-2015-CSI-CIPA.pdf'),(12,3,'CIPA_A3','Dossier ordinateur portable','A345/acquisitionPortable-2015-CSI-CIPA.pdf'),(13,1,'CIPA_A3','Calendrier CIPA3','A345/CIPA3Calendrier1516.pdf'),(14,1,'CIPA_A4','Calendrier CIPA4','A345/CIPA4Calendrier1516.pdf'),(15,1,'CIPA_A5','Calendrier CIPA5','A345/CIPA5Calendrier1516.pdf'),(16,1,'CSI_A3','Calendrier CSI3','A345/CSI3Calendrier1516.pdf'),(17,1,'CIR_A3_NONALT','Calendrier CIR3 non alternant','A345/CIR3nonAlternantCalendrier1516.pdf'),(18,3,'CIR_A3_NONALT','Annonce ordinateur portable','A345/courrierAnnoncePortable-2015-CSI-CIPA.pdf'),(19,4,'CIR_A3_NONALT','Dossier ordinateur portable','A345/acquisitionPortable-2015-CSI-CIPA.pdf'),(20,1,'CIR_A3_ALT','Calendrier CIR3 alternant','A345/CIR3AlternantCalendrier1516.pdf'),(21,3,'CIR_A3_ALT','Annonce ordinateur portable','A345/courrierAnnoncePortable-2015-CSI-CIPA.pdf'),(22,4,'CIR_A3_ALT','Dossier ordinateur portable','A345/acquisitionPortable-2015-CSI-CIPA.pdf'),(23,1,'M_A4','Calendrier M1','A345/M1Calendrier1516.pdf'),(24,3,'M_A4','Annonce ordinateur portable','A345/courrierAnnoncePortable-2015-CSI-CIPA.pdf'),(25,4,'M_A4','Dossier ordinateur portable','A345/acquisitionPortable-2015-CSI-CIPA.pdf'),(26,3,'CIR_BREST_A1','Annonce ordinateur portable','A12/courrierAnnonce2015CIR1.pdf'),(27,4,'CIR_BREST_A1','Contrat de mise à disposition ordinateur portable','A12/contratMiseDisposition2015CIR1.pdf'),(28,3,'CIR_RENNES_A1','Annonce ordinateur portable','A12/courrierAnnonce2015CIR1.pdf'),(29,4,'CIR_RENNES_A1','Contrat de mise à disposition ordinateur portable','A12/contratMiseDisposition2015CIR1.pdf'),(30,1,'CSI_A1','Calendrier Classes Préparatoires','A12/CSI1_CSI2calendrier2015.2016.pdf'),(31,1,'CSI_A2','Calendrier Classes Préparatoires','A12/CSI1_CSI2calendrier2015.2016.pdf'),(32,2,'CSI_A1','Informations pratiques','A12/CSI1_CSI2infospratiques.pdf'),(33,2,'CSI_A2','Informations pratiques','A12/CSI1_CSI2infospratiques.pdf'),(34,1,'CIR_BREST_A1','Calendrier CIR','A12/CIR1_CIR2calendrier2015.2016.pdf'),(35,2,'CIR_BREST_A1','Informations pratiques','A12/CIR1_CIR2infospratiques.pdf'),(36,1,'CIR_RENNES_A1','Calendrier CIR','A12/CIR1_CIR2calendrier2015.2016.pdf'),(37,2,'CIR_RENNES_A1','Informations pratiques','A12/CIR1_CIR2infospratiques.pdf'),(38,1,'CIR_BREST_A2','Calendrier CIR','A12/CIR1_CIR2calendrier2015.2016.pdf'),(39,2,'CIR_BREST_A2','Informations pratiques','A12/CIR1_CIR2infospratiques.pdf'),(40,1,'CIR_RENNES_A2','Calendrier CIR','A12/CIR1_CIR2calendrier2015.2016.pdf'),(41,2,'CIR_RENNES_A2','Informations pratiques','A12/CIR1_CIR2infospratiques.pdf'),(42,1,'BTSPREPA_A1','Calendrier BTS PREPA','A12/BTS1_BTS2Brestcalendrier2015.2016.pdf'),(43,1,'BTSPREPA_A2','Calendrier BTS PREPA','A12/BTS1_BTS2Brestcalendrier2015.2016.pdf'),(44,2,NULL,'Sécurité Sociale étudiante mode d\'emploi','mode_emploi_secu_sociale_15-16.pdf'),(46,1,'M_A5_ALT','Calendrier M2 alternant','A345/M2AlternantCalendrier1516.pdf'),(47,1,'M_A5_NONALT','Calendrier M2 non alternant','A345/M2nonAlternantCalendrier1516.pdf'),(48,1,NULL,'Dates des rentrées à l\'ISEN','Calendriersrentree1516.pdf'),(49,2,'CSI_A3','Informations pratiques','A345/rentreepratiqueinge1516.pdf'),(50,2,'CIR_A3_NONALT','Informations pratiques','A345/rentreepratiqueinge1516.pdf'),(51,2,'CIR_A3_ALT','Informations pratiques','A345/rentreepratiqueinge1516.pdf'),(52,2,'M_A4','Informations pratiques','A345/rentreepratiqueinge1516.pdf'),(53,2,'M_A5_ALT','Informations pratiques','A345/rentreepratiqueinge1516.pdf'),(54,2,'M_A5_NONALT','Informations pratiques','A345/rentreepratiqueinge1516.pdf'),(55,3,NULL,'LMDE','LMDE.pdf'),(71,45,'BTSPREPA_A1','sfgs','A12/konstantin-500.jpg');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo` (
  `id_promo` varchar(20) NOT NULL DEFAULT '',
  `libelle` varchar(256) NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo`
--

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
INSERT INTO `promo` VALUES ('BTSPREPA_A1','1ʳᵉ année, BTS Prépa'),('BTSPREPA_A2','2&#x1D49; année, BTS Prépa'),('CIPA_A3','3&#x1D49; année, Cycle Ingénieur Par l\'Apprentissage'),('CIPA_A4','4&#x1D49; année, Cycle Ingénieur Par l\'Apprentissage'),('CIPA_A5','5&#x1D49; année, Cycle Ingénieur Par l\'Apprentissage'),('CIR_A3_ALT','3&#x1D49; année, Cycle Informatique et Réseaux (alternant)'),('CIR_A3_NONALT','3&#x1D49; année, Cycle Informatique et Réseaux (non alternant)'),('CIR_BREST_A1','1&#x02B3;&#x1D49; année, Cycle Informatique et Réseaux (Brest)'),('CIR_BREST_A2','2&#x1D49; année, Cycle Informatique et Réseaux (Brest)'),('CIR_RENNES_A1','1&#x02B3;&#x1D49; année, Cycle Informatique et Réseaux (Rennes)'),('CIR_RENNES_A2','2&#x1D49; année, Cycle Informatique et Réseaux (Rennes)'),('CSI_A1','1&#x02B3;&#x1D49; année, Cycle Sciences de l\'Ingénieur'),('CSI_A2','2&#x1D49; année, Cycle Sciences de l\'Ingénieur'),('CSI_A3','3&#x1D49; année, Cycle Sciences de l\'Ingénieur'),('M_A4','4&#x1D49; année, Majeure - M1'),('M_A5_ALT','5&#x1D49; année, Majeure - M2 (alternant)'),('M_A5_NONALT','5&#x1D49; année, Majeure - M2 (non alternant)'),('TEST_A4','Test année 5');
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-18 21:26:10
