/*!999999\- enable the sandbox mode */
-- MariaDB dump 10.19-11.4.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: snowtricks
-- ------------------------------------------------------
-- Server version	11.4.2-MariaDB-ubu2404-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES
(1,'Grabs','2024-08-17 14:38:22','Grabs'),
(2,'Rotation','2024-08-17 14:38:37','Rotation'),
(3,'Rotation désaxée','2024-08-17 14:38:45','Rotation-desaxee'),
(4,'Flips','2024-08-17 14:38:52','Flips'),
(5,'Slides','2024-08-17 14:39:03','Slides'),
(6,'One foot tricks','2024-08-17 14:39:10','One-foot-tricks'),
(7,'Old school','2024-08-17 14:39:17','Old-school');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tricks_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526C3B153154` (`tricks_id`),
  CONSTRAINT `FK_9474526C3B153154` FOREIGN KEY (`tricks_id`) REFERENCES `tricks` (`id`),
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES
(1,1,8,'2024-08-17 15:49:48','2024-08-17 15:49:48','Sacré niveau pour faire celui là'),
(2,2,8,'2024-08-17 15:51:09','2024-08-17 16:03:18','En effet ce n\'est pas une figure facile :) .');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES
('DoctrineMigrations\\Version20240510115109','2024-08-17 14:30:31',49),
('DoctrineMigrations\\Version20240510115746','2024-08-17 14:30:31',19),
('DoctrineMigrations\\Version20240510163227','2024-08-17 14:30:31',53),
('DoctrineMigrations\\Version20240517085721','2024-08-17 14:30:31',138),
('DoctrineMigrations\\Version20240530212556','2024-08-17 14:30:31',54),
('DoctrineMigrations\\Version20240531181852','2024-08-17 14:30:31',23),
('DoctrineMigrations\\Version20240607130006','2024-08-17 14:30:31',62),
('DoctrineMigrations\\Version20240607130300','2024-08-17 14:30:31',142),
('DoctrineMigrations\\Version20240621132111','2024-08-17 14:30:32',116),
('DoctrineMigrations\\Version20240627071731','2024-08-17 14:30:32',102),
('DoctrineMigrations\\Version20240719150912','2024-08-17 14:30:32',42),
('DoctrineMigrations\\Version20240720190653','2024-08-17 14:30:32',51),
('DoctrineMigrations\\Version20240720233154','2024-08-17 14:30:32',74);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tricks_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `filename` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `header` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_16DB4F893B153154` (`tricks_id`),
  CONSTRAINT `FK_16DB4F893B153154` FOREIGN KEY (`tricks_id`) REFERENCES `tricks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `picture`
--

LOCK TABLES `picture` WRITE;
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` VALUES
(2,2,'2024-08-17 14:48:14','How-To-Nose-Tail-Grab-66c09c0eae423.webp','2024-08-17 14:48:14',1),
(3,3,'2024-08-17 14:57:47','friedl-fs-360-0-66c09e4b663ef.jpg','2024-08-17 14:57:47',1),
(4,3,'2024-08-17 14:57:47','how-to-frontside-360-snowboard-800-66c09e4b66522.jpg','2024-08-17 14:57:47',0),
(5,4,'2024-08-17 15:04:17','Whitelines-94-b-s-360-tail-66c09fd14eb8e.jpg','2024-08-17 15:04:17',1),
(6,5,'2024-08-17 15:08:38','frontflipknuckle-620x413-66c0a0d64efd9.jpg','2024-08-17 15:08:38',0),
(7,6,'2024-08-17 15:18:39','images-66c0a32f619ba.jpg','2024-08-17 15:18:39',1),
(8,7,'2024-08-17 15:24:51','Screen-Shot-2015-09-23-at-2-40-14-PM-large-66c0a4a31430e.webp','2024-08-17 15:24:51',0),
(9,10,'2024-08-17 15:43:58','PUSH-Rodeo-5-66c0a91e5178b.jpg','2024-08-17 15:43:58',1),
(10,10,'2024-08-17 15:43:58','Whitelines-94-backside-rodeo-540-melon-66c0a91e51862.jpg','2024-08-17 15:43:58',0);
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_request`
--

LOCK TABLES `reset_password_request` WRITE;
/*!40000 ALTER TABLE `reset_password_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_password_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tricks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `content` text NOT NULL,
  `summary` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E1D902C1A76ED395` (`user_id`),
  KEY `IDX_E1D902C112469DE2` (`category_id`),
  CONSTRAINT `FK_E1D902C112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_E1D902C1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tricks`
--

LOCK TABLES `tricks` WRITE;
/*!40000 ALTER TABLE `tricks` DISABLE KEYS */;
INSERT INTO `tricks` VALUES
(2,1,1,'Tail grab','2024-08-17 14:48:14','2024-08-17 14:48:14','<h3>Les Grabs</h3><p>Les Grabs sont la colonne vertébrale des figures de snowboard. Stylé et classe, c\'est en attrapant la planche en plein vol, à une ou deux mains, que le freestyle est né.<br /><br /><strong>Le</strong> <strong>Tail</strong> - Attrape le talon de ta planche avec ta main arrière (juste à l\'extrémité, pas sur les côtés).</p>','<h3>Les Grabs</h3><p>Les Grabs sont la colonne vertébrale des figures de snowboard. Stylé et classe, c\'est en attrapant la planche en plein vol, à une ou deux mains, que le freestyle est né.<br /><br /><strong>Le</strong> <strong>Tail</strong> - Attra','Tail-grab'),
(3,1,2,'Frontside 360','2024-08-17 14:56:14','2024-08-17 15:39:26','<h2>Faire un frontside 360 en snowboard</h2><p> </p><p>Le snowboard permet de réaliser des sauts spectaculaires. La discipline continue à séduire de nouveaux adeptes. <strong>Une observation pointue et une pratique régulière</strong> facilitent la progression du débutant. Une bonne préparation en amont des mouvements à effectuer constitue aussi une bonne approche. Le frontside 360 figure parmi les figures de base. Comment réussir ce trick ? <strong>Le timing et la position du corps</strong> jouent un rôle essentiel. La réception en aveugle requiert un excellent contrôle. Suivez le guide.</p><h2><strong>Frontside 360, les principes de base</strong></h2><p>Un 360 équivaut à un tour complet. Le sens de rotation diffère selon les rider. Les regular tourneront à gauche tandis que les goofy s’élanceront vers leur droite. Apparemment simple, ce trick requiert une bonne maîtrise.</p><p>Il est mieux de <strong>progresser par étape</strong>. Après un saut simple, on continue par un 120°, puis un 270°. Ces objectifs intermédiaires serviront à mieux appréhender les sensations et les réactions de la planche. Ils renforceront la confiance et permettent d’éviter les blessures. Des séances d’exercice sur le trampoline favoriseront l’acquisition des bases. On peut aussi <strong>répéter les mouvements de rotation</strong> au sol.</p><h2><strong>Une préparation similaire à tous les sauts</strong></h2><p>L’approche est identique à celle des autres sauts : <strong>fléchir les jambes, orienter les épaules dans le même sens que la planche et se focaliser sur l’extrémité du kicker</strong>. Il est important de régler sa vitesse de manière à ne pas arriver trop vite. Cependant, il ne faut pas trop ralentir non plus. L’impulsion sera insuffisante si la vitesse est trop lente. Par ailleurs, il est primordial de ne pas commencer la rotation avant que la board a quitté le sol.</p><h2><strong>L’intégralité du corps donne l’impulsion nécessaire</strong></h2><p>Comme tous les sauts, la première impulsion vient des pieds. Avant de sauter, il est recommandé de <strong>transférer votre poids vers vos talons</strong>. Si vous êtes sur un kicker, un appui des deux pieds garantira un meilleur résultat. En revanche, sur les petits 3.6 situés en bordure des pistes, réaliser une ollie est indispensable.</p><p>Ensuite, les épaules et la tête amorceront la rotation. L’amplitude du mouvement variera en fonction de la taille du saut. <strong>Mettre le menton au même niveau que les épaules</strong> contribuera à un meilleur équilibre. Détail important : accompagner la planche du regard favorisera la concentration.</p><h2><strong>Garder l’équilibre et se faire plaisir</strong></h2><p>Regrouper les jambes renforce l’équilibre durant le saut. Maintenir les bras ouverts permet de mieux contrôler la vitesse. <strong>Plusieurs options sont également possibles</strong> : les habitués préfèrent grabber, un tweak ajoutera plus de style et réduit la vitesse. Lâcher la planche fournit une nouvelle impulsion et augmente le rythme.</p><h2><strong>Comment préparer la réception ?</strong></h2><p>Le rider apercevra sa zone d’atterrissage après la moitié du tour. Étendre les jambes vers le bas posera la board sur le sol. Ensuite, se regrouper favorise <strong>une réception en douceur</strong>. Il faut aussi mettre l’épaule dans l’axe de la planche. Bref, l’ensemble du corps préparera la manœuvre. Chaque saut est unique, une préparation méticuleuse de la réception reste indispensable, même pour les experts.</p><h2><strong>Regarder vers le bas améliore la réception</strong></h2><p><strong>Garder les yeux rivés sur les pieds</strong> est nécessaire pendant la réception. Lever les yeux et regarder la suite du parcours est dangereux. Les épaules ne resteront plus dans l’axe de la planche. Cet écart augmente les risques de déséquilibre. <strong>Utiliser les deux pieds améliore la réception</strong>. Vous relevez seulement la tête quand vous êtes sûr de votre stabilité.</p><h2><strong>Réussir des sauts plus compliqués</strong></h2><p>La hauteur variera en fonction de l’intensité de l’impulsion. Plus elle sera forte, plus le rider montera plus haut. Les mouvements des bras assurent l’équilibre et permettent de <strong>décliner le trick en plusieurs versions</strong>. Le grab consiste à tenir la planche avec les mains. Selon le niveau de maitrise, il est possible de serrer l’extrémité avant, arrière ou les côtés.</p><h2><strong>Persévérer, la clé de la réussite</strong></h2><p>La première tentative n’est pas toujours la bonne. Même les plus grands freestylers sont tombés au cours de leur apprentissage. Les spécialistes le confirment, les chutes favorisent la progression. <strong>Savoir tirer les enseignements de ses échecs</strong> est un état d’esprit indispensable. L’approche, l’impulsion et la réception s’amélioreront au fur et à mesure des essais et des corrections. Regarder, analyser et s’inspirer des autres accélèrent l’évolution.</p>','<h2>Faire un frontside 360 en snowboard</h2><p> </p><p>Le snowboard permet de réaliser des sauts spectaculaires. La discipline continue à séduire de nouveaux adeptes. <strong>Une observation pointue et une pratique régulière</strong> facilitent la p','Frontside-360'),
(4,1,2,'backside 360 tail','2024-08-17 15:04:17','2024-08-17 15:04:17','<h2><strong>Comment faire un 360 Backside Tail en Snowboard</strong></h2><p>Le 360 backside tail est une figure qui combine un <strong>360 backside</strong> (rotation de 360 degrés en tournant dans le sens inverse de la pente pour un goofy ou dans le sens des aiguilles d\'une montre pour un regular) avec un <strong>grab tail</strong> (attraper la partie arrière de ta planche avec ta main arrière). Voici les étapes pour y parvenir :</p><h4>1. <strong>Préparation et Approche :</strong></h4><ul><li>Avant de tenter ce trick, assure-toi de maîtriser le 360 backside et le grab tail séparément.</li><li>Aborde le kicker (le tremplin) avec une bonne vitesse et légèrement en backside (bord des talons) pour te préparer à la rotation.</li></ul><h4>2. <strong>Impulsion et Début de la Rotation :</strong></h4><ul><li>À l’approche du kicker, fléchis légèrement les genoux pour charger ton impulsion.</li><li>Une fois sur la lèvre du kicker, lance ton 360 backside en tournant les épaules et les hanches. Le mouvement des épaules est crucial pour amorcer la rotation.</li></ul><h4>3. <strong>Grab du Tail :</strong></h4><ul><li>Pendant que tu commences à tourner, ramène la planche vers toi en pliant les jambes. Utilise ta main arrière pour attraper le tail (l\'arrière de la planche).</li><li>Garde bien ton regard sur l’horizon pour maintenir ta rotation fluide.</li></ul><h4>4. <strong>Maintien de la Position et Contrôle de la Rotation :</strong></h4><ul><li>Pendant la rotation, essaie de rester compact en maintenant le grab pour un style propre.</li><li>Contrôle la vitesse de rotation en ajustant la position de ton corps : si tu es trop rapide, ouvre légèrement ton corps, si tu es trop lent, reste compact.</li></ul><h4>5. <strong>Atterrissage :</strong></h4><ul><li>Relâche le grab et prépare-toi à atterrir en regardant dans la direction où tu veux aller.</li><li>Absorbe l’impact avec les jambes et atterris en douceur sur la carre des orteils ou à plat selon la pente de la réception.</li></ul><h4>6. <strong>Sortie du Trick :</strong></h4><ul><li>Continue ta glisse en stabilisant ta position après l’atterrissage. Félicitations, tu viens de réaliser un 360 backside tail !</li></ul>','<h2><strong>Comment faire un 360 Backside Tail en Snowboard</strong></h2><p>Le 360 backside tail est une figure qui combine un <strong>360 backside</strong> (rotation de 360 degrés en tournant dans le sens inverse de la pente pour un goofy ou dans le sen','backside-360-tail'),
(5,1,4,'Frontflip','2024-08-17 15:08:38','2024-08-17 15:08:38','<p>Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.<br /><br />Il est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation.<br /><br />Les flips agrémentés d\'une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées.<br /><br />Néanmoins, en dépit de la difficulté technique relative d\'une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks.</p>','<p>Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.<br /><br />Il est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation.<br /><br />Les flips a','Frontflip'),
(6,1,5,'Slide','2024-08-17 15:18:39','2024-08-17 15:18:39','<h3>Comment faire un Slide (50-50) en Snowboard</h3><p>Le 50-50 est l\'un des slides les plus simples et constitue la base des figures en snowpark. Il s\'agit simplement de glisser droit sur un rail ou une box avec les deux pieds parallèles à la direction de l\'obstacle. Voici comment y parvenir :</p><h4>1. <strong>Préparation et Approche :</strong></h4><ul><li>Avant de tenter le slide, assure-toi d\'avoir une bonne maîtrise de ton snowboard, notamment en équilibre sur les carres.</li><li>Aborde le rail ou la box avec une trajectoire bien droite. Tes genoux doivent être légèrement fléchis et ton regard fixé sur le début de l\'obstacle.</li></ul><h4>2. <strong>Impulsion et Entrée sur le Rail :</strong></h4><ul><li>À l’approche de l’obstacle, assure-toi que ta planche est bien à plat pour éviter que les carres ne se prennent dans le rail.</li><li>Effectue un léger saut pour monter sur le rail ou la box, en gardant ta planche parallèle à l\'obstacle. Les épaules doivent rester alignées avec la planche.</li></ul><h4>3. <strong>Position sur le Rail :</strong></h4><ul><li>Une fois sur le rail, garde ton poids bien centré et réparti de manière égale sur les deux pieds. Essaie de rester le plus stable possible, avec les genoux fléchis pour absorber les irrégularités du rail.</li><li>Fixe ton regard vers l\'avant, sur la sortie du rail, pour maintenir l\'équilibre.</li></ul><h4>4. <strong>Maintien du Slide et Contrôle :</strong></h4><ul><li>Pendant que tu glisses, veille à ce que ta planche reste à plat. Évite de te pencher trop en avant ou en arrière pour ne pas perdre l’équilibre.</li><li>Reste détendu et laisse ton corps suivre naturellement la trajectoire du rail.</li></ul><h4>5. <strong>Sortie du Trick :</strong></h4><ul><li>À l’approche de la fin du rail, prépare-toi à un atterrissage doux. Garde ta planche à plat jusqu\'à ce que tu quittes l\'obstacle.</li><li>Atterris en fléchissant légèrement les genoux pour absorber l\'impact et continue ta descente.</li></ul>','<h3>Comment faire un Slide (50-50) en Snowboard</h3><p>Le 50-50 est l\'un des slides les plus simples et constitue la base des figures en snowpark. Il s\'agit simplement de glisser droit sur un rail ou une box avec les deux pieds parallèles à la direction','Slide'),
(7,1,6,'One footer','2024-08-17 15:24:51','2024-08-17 15:24:51','<h3>Comment faire un One Footer en Snowboard</h3><p>Le one footer est un trick technique qui demande de l’équilibre et du contrôle. Il est souvent réalisé sur des kickers ou des boxes, avec un pied détaché (généralement le pied avant reste attaché). Voici les étapes pour réussir ce trick :</p><h4>1. <strong>Préparation et Détachement :</strong></h4><ul><li>Avant de tenter ce trick, familiarise-toi avec le fait de rider avec un pied détaché, par exemple en sortant du télésiège.</li><li>Pour le one footer, détache ton pied arrière et place-le sur la planche, généralement à côté du stomp pad (la partie texturée située entre les fixations).</li></ul><h4>2. <strong>Approche :</strong></h4><ul><li>Aborde le kicker ou l\'obstacle avec le pied avant bien attaché et le pied arrière libre. Reste bien en équilibre, car ton pied arrière n’est plus fixé pour stabiliser ta glisse.</li><li>Garde ton regard droit devant, avec une bonne flexion des genoux pour rester stable.</li></ul><h4>3. <strong>Impulsion et Trick :</strong></h4><ul><li>Arrivé à la lèvre du kicker, donne une impulsion en utilisant principalement ton pied avant.</li><li>Pendant que tu es en l\'air, soulève ton pied arrière pour effectuer le trick souhaité, que ce soit un grab, un tweak, ou simplement un ollie stylé.</li></ul><h4>4. <strong>Contrôle en L’air :</strong></h4><ul><li>Pendant le vol, garde le pied arrière bien en ligne avec la planche pour rester stable. Les mouvements brusques avec le pied arrière peuvent te déséquilibrer.</li></ul><h4>5. <strong>Atterrissage :</strong></h4><ul><li>Prépare-toi à atterrir en réajustant ton pied arrière sur la planche, près du stomp pad. Ton pied avant doit rester bien en ligne pour absorber l’impact.</li><li>Atterris en fléchissant les genoux pour absorber la réception et reprendre de la vitesse sans perdre l’équilibre.</li></ul><h4>6. <strong>Sortie du Trick :</strong></h4><ul><li>Après l’atterrissage, replace ton pied arrière dans une position stable et continue ta descente. Une fois à l’arrêt, tu pourras rattacher ton pied arrière pour la suite de ta session.</li></ul>','<h3>Comment faire un One Footer en Snowboard</h3><p>Le one footer est un trick technique qui demande de l’équilibre et du contrôle. Il est souvent réalisé sur des kickers ou des boxes, avec un pied détaché (généralement le pied avant reste attac','One-footer'),
(8,1,2,'Backside Double Cork 1080','2024-08-17 15:28:30','2024-08-17 15:28:30','<h3>Comment faire un Backside Double Cork 1080 en Snowboard</h3><p>Le backside double cork 1080 est une figure complexe qui nécessite une solide maîtrise des rotations en snowboard et une très bonne lecture de l’espace aérien. Voici les étapes pour réussir ce trick :</p><h4>1. <strong>Préparation et Prérequis :</strong></h4><ul><li>Avant de tenter ce trick, tu dois être à l’aise avec les rotations simples (360, 540, 720) ainsi qu’avec le backside 1080. Maîtriser les corks simples (comme un backside cork 720) est également essentiel.</li><li>Choisis un kicker assez grand qui te donne suffisamment de temps en l’air pour exécuter deux rotations inversées (corks) tout en complétant 1080 degrés.</li></ul><h4>2. <strong>Approche :</strong></h4><ul><li>Aborde le kicker avec une légère prise de carre backside (talons) pour initier la rotation en backside. Ta position doit être stable, avec les genoux fléchis et le regard vers l’horizon.</li><li>Prends suffisamment de vitesse pour que ton amplitude en l’air soit suffisante pour effectuer le double cork.</li></ul><h4>3. <strong>Impulsion et Lancement de la Rotation :</strong></h4><ul><li>Au moment où tu arrives à la lèvre du kicker, pousse fort avec tes jambes pour générer de l’élévation.</li><li>Lance ta rotation en tournant tes épaules vers l’arrière (dans le sens backside) et en abaissant ton épaule avant. C’est ce mouvement qui déclenche le premier cork (rotation inversée).</li></ul><h4>4. <strong>Première Rotation Cork :</strong></h4><ul><li>En l’air, laisse ton corps se pencher légèrement en arrière pendant que tu commences à tourner. C’est cette inclinaison qui crée l’effet \"cork\", où tu n’es plus complètement horizontal, mais légèrement inversé.</li><li>Pendant la première rotation (720 degrés), garde ton regard sur l’horizon pour anticiper la suite du mouvement.</li></ul><h4>5. <strong>Deuxième Rotation Cork :</strong></h4><ul><li>Une fois que tu as complété la première rotation cork, utilise l\'élan de ton corps pour plonger dans la deuxième cork. Ici, tu penches encore plus ton corps pour donner une dynamique inversée supplémentaire.</li><li>Pendant cette rotation, tu complètes les 1080 degrés en alignant tes épaules et tes hanches.</li></ul><h4>6. <strong>Préparation à l’Atterrissage :</strong></h4><ul><li>En terminant la deuxième cork, commence à redresser ton corps pour stabiliser ton atterrissage. Garde les yeux fixés sur la réception.</li><li>Réajuste ta planche pour atterrir bien à plat ou légèrement sur la carre des orteils.</li></ul><h4>7. <strong>Atterrissage :</strong></h4><ul><li>Absorbe l’impact avec les genoux fléchis pour éviter de perdre l’équilibre. Le positionnement de ton corps doit être centré pour garantir un atterrissage propre.</li><li>Enchaîne rapidement en reprenant ta glisse avec fluidité.</li></ul>','<h3>Comment faire un Backside Double Cork 1080 en Snowboard</h3><p>Le backside double cork 1080 est une figure complexe qui nécessite une solide maîtrise des rotations en snowboard et une très bonne lecture de l’espace aérien. Voici les étapes pour','Backside-Double-Cork-1080'),
(9,1,2,'Cab 720','2024-08-17 15:42:10','2024-08-17 15:42:10','<h3>1. <strong>Cab 720 (Switch Frontside 720)</strong></h3><p>Le Cab 720, aussi appelé switch frontside 720, est une rotation de 720 degrés (deux tours complets) effectuée en partant en switch. C’est une figure technique qui combine la maîtrise des rotations et la glisse en switch.</p><h4>Comment le réaliser :</h4><ol><li><strong>Approche en Switch :</strong><ul><li>Aborde le kicker en position switch (le pied opposé à ton pied habituel devant). Adopte une légère prise de carre frontside (orteils) pour préparer la rotation.</li><li>Garde ton corps compact et tes épaules alignées pour maintenir l’équilibre.</li></ul></li><li><strong>Impulsion et Lancement du Spin :</strong><ul><li>Juste avant de quitter la lèvre du kicker, engage un mouvement des épaules dans le sens de la rotation frontside (pour un goofy, c’est dans le sens inverse des aiguilles d’une montre).</li><li>Fléchis les genoux pour une bonne impulsion et déclenche la rotation avec un mouvement dynamique des épaules et des hanches.</li></ul></li><li><strong>Contrôle de la Rotation :</strong><ul><li>En l’air, garde ton corps compact pour effectuer les deux tours. Utilise un grab, comme un mute (main avant sur la carre des orteils entre les fixations), pour stabiliser la rotation.</li><li>Concentre-toi sur le timing pour ne pas trop ouvrir ou fermer ta rotation.</li></ul></li><li><strong>Préparation à l’Atterrissage :</strong><ul><li>Au moment où tu approches la fin des 720 degrés, commence à ouvrir tes épaules pour aligner ton corps avec la réception.</li><li>Prépare-toi à atterrir en position normale (non-switch).</li></ul></li><li><strong>Atterrissage :</strong><ul><li>Atterris bien fléchi, avec les genoux prêts à absorber l’impact. Stabilise ta glisse et continue ta descente.</li></ul></li></ol>','<h3>1. <strong>Cab 720 (Switch Frontside 720)</strong></h3><p>Le Cab 720, aussi appelé switch frontside 720, est une rotation de 720 degrés (deux tours complets) effectuée en partant en switch. C’est une figure technique qui combine la maîtrise des ','Cab-720'),
(10,1,3,'Backside Rodeo 540','2024-08-17 15:43:58','2024-08-17 15:43:58','<p>Le backside rodeo 540 est une rotation inversée combinée avec un spin de 540 degrés. C’est un mix entre un backflip et un spin backside, très fluide et stylé en l’air.</p><h4>Comment le réaliser :</h4><ol><li><strong>Approche :</strong><ul><li>Aborde le kicker avec une légère prise de carre backside (talons). Ton regard doit être dirigé vers l’horizon pour bien amorcer la rotation.</li></ul></li><li><strong>Impulsion et Début du Rodeo :</strong><ul><li>Au moment de l’impulsion, lance tes épaules vers l’arrière et penche légèrement ton corps pour initier le backflip. En même temps, tourne les épaules pour commencer le spin de 540 degrés.</li><li>Le mouvement doit être fluide, comme si tu faisais un backflip tout en tournant latéralement.</li></ul></li><li><strong>Rotation Inversée (Rodeo) :</strong><ul><li>Pendant le rodeo, garde ton regard sur l’atterrissage à travers ta rotation. Ton corps est incliné dans une rotation inversée tout en effectuant les 540 degrés.</li></ul></li><li><strong>Préparation à l’Atterrissage :</strong><ul><li>En complétant les 540 degrés, redresse ton corps pour te préparer à une réception propre. Garde un contrôle ferme sur la rotation pour ne pas atterrir trop en arrière ou en avant.</li></ul></li><li><strong>Atterrissage :</strong><ul><li>Atterris avec les genoux bien fléchis pour absorber l’impact. Continue ta glisse avec fluidité.</li></ul></li></ol>','<p>Le backside rodeo 540 est une rotation inversée combinée avec un spin de 540 degrés. C’est un mix entre un backflip et un spin backside, très fluide et stylé en l’air.</p><h4>Comment le réaliser :</h4><ol><li><strong>Approche :</strong><ul><l','Backside-Rodeo-540'),
(11,1,4,'Double backflip','2024-08-17 15:45:15','2024-08-17 15:45:15','<h3><strong>Double Backflip</strong></h3><p>Le double backflip est un trick spectaculaire qui consiste à réaliser deux flips arrière en l’air. C’est une figure exigeante qui demande de l’amplitude et un bon timing.</p><h4>Comment le réaliser :</h4><ol><li><strong>Approche :</strong><ul><li>Aborde un kicker avec beaucoup de vitesse pour garantir une hauteur suffisante. Ton corps doit être bien compact avec les genoux légèrement fléchis.</li></ul></li><li><strong>Impulsion et Lancement du Premier Flip :</strong><ul><li>À la lèvre du kicker, donne une forte impulsion en lançant tes épaules et ta tête en arrière pour initier le backflip. Utilise principalement la force de tes jambes pour générer l’élévation.</li></ul></li><li><strong>Transition vers le Deuxième Flip :</strong><ul><li>Après le premier flip, garde ton corps compact et utilise l’élan pour lancer le second flip. Le timing est crucial pour enchaîner proprement les deux rotations.</li></ul></li><li><strong>Contrôle en L’air :</strong><ul><li>Pendant le second flip, essaie de garder ton regard sur la réception pour te repérer. Garde les genoux fléchis et ramène la planche sous toi pour stabiliser l’atterrissage.</li></ul></li><li><strong>Atterrissage :</strong><ul><li>Prépare-toi à atterrir en fléchissant les genoux pour absorber l’impact. Garde ton corps bien centré pour éviter de basculer en avant ou en arrière.</li></ul></li></ol>','<h3><strong>Double Backflip</strong></h3><p>Le double backflip est un trick spectaculaire qui consiste à réaliser deux flips arrière en l’air. C’est une figure exigeante qui demande de l’amplitude et un bon timing.</p><h4>Comment le réaliser :</','Double-backflip');
/*!40000 ALTER TABLE `tricks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'lbreton','[\"ROLE_ADMIN\"]','$2y$13$Qs/mxnLqZfaEVlVsBrOx9uOQkRp/DNebMq7Zvlb80bZ9LRf8i9AsK','bretonludovic40@gmail.com',1),
(2,'test','[\"ROLE_USER\"]','$2y$13$bGvtfzWS/5GaSZnHVHpYpeCiSxp1XtxIOMlCZ8UaSPLYGQ40Pp0ma','test@hotmail.fr',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tricks_id` int(11) DEFAULT NULL,
  `video_host` varchar(255) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `embed_url` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2C3B153154` (`tricks_id`),
  CONSTRAINT `FK_7CC7DA2C3B153154` FOREIGN KEY (`tricks_id`) REFERENCES `tricks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES
(1,2,'youtube','YAElDqyD-3I','https://www.youtube.com/embed/YAElDqyD-3I'),
(2,3,'youtube','9T5AWWDxYM4','https://www.youtube.com/embed/9T5AWWDxYM4'),
(3,4,'youtube','YmVBqyjFReU','https://www.youtube.com/embed/YmVBqyjFReU'),
(4,5,'youtube','gMfmjr-kuOg','https://www.youtube.com/embed/gMfmjr-kuOg'),
(5,7,'youtube','MUB_YhSiK_o','https://www.youtube.com/embed/MUB_YhSiK_o'),
(6,10,'youtube','aHFlwDYdoIQ','https://www.youtube.com/embed/aHFlwDYdoIQ');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2024-08-17 15:01:37
