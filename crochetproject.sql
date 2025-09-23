-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 23, 2025 at 11:10 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crochetproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `uid` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `pattern` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `yarn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `hook` decimal(10,0) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `start` date DEFAULT NULL,
  `finish` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Userid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`uid`, `id`, `name`, `pattern`, `yarn`, `hook`, `description`, `image`, `start`, `finish`) VALUES
(37, 98, 'Kulacstartó', 'https://www.acrochetedsimplicity.com/crochet-water-bottle-holder-pattern/', '103', 3, '', '/project/uploads/68cd42e14e580_crochet-water-bottle-holder-pattern-2_medium2.jpg,/project/uploads/68cd42e14e769_crochet-water-bottle-holder-pattern-featured_medium2.jpg,/project/uploads/68cd42e14e8bb_IMG_8320_medium2.jpeg', '2025-09-08', '2025-09-12'),
(37, 99, 'Rókás kulcstartó', 'https://www.etsy.com/listing/906400220/crochet-pattern-fox-keychain-ornament?ref=shop_home_active_7&amp;amp;crt=1', '85', 5, 'Ez a minta nagyon gyorsan elkészült és könnyen érthető volt. A róka kulcstartó pedig olyan aranyos lett!', '/project/uploads/68cd443c4ac00_acp_medium2.jpg,/project/uploads/68cd443c4adcd_acp2_medium2.jpg,/project/uploads/68cd443c4af5f_acp3_medium2.jpg', '2025-09-23', '2025-09-23'),
(37, 100, 'Csillagtakaró', 'https://bettymcknit.com/patterns/6daystarblanket/', '78', 6, 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. ', '', '2025-07-09', NULL),
(37, 101, 'Hatszögű kardigán', 'https://www.youtube.com/watch?v=EBKYLkmOaHE', '75', 4, '', '/project/uploads/68cd5bfc60d86_20220313_075857-01_medium2.jpeg', '2025-09-01', '2025-09-30'),
(37, 102, 'Téli sapka', 'https://brianakdesigns.com/snowy-puff-crochet-hat-pattern/', '163', 4, 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', '/project/uploads/68cd5c724cd56_IMG_2166_medium2.JPG,/project/uploads/68cd5c724e2e5_IMG_2318_medium2.JPG', '2025-07-14', '2025-08-31'),
(38, 103, 'Edényfogó', 'https://www.bevscountrycottage.com/kitchen-potholders.html', '146', 4, 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id ', '/project/uploads/68cd611b36488_2025-potholder_-_1_medium2.jpeg,/project/uploads/68cd611b37f18_2025-potholder_-_2_medium2.jpeg', '2025-09-08', '2025-09-11'),
(38, 104, 'Szőnyeg', 'https://stitchesnscraps.com/free-pattern-linen-stitch-scrap-rug/', '45', 3, 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', '/project/uploads/68cd61d5aeab4_IMG_2202_medium2.jpeg,/project/uploads/68cd61d5aedf7_IMG_2203_medium2.jpeg,/project/uploads/68cd61d5aefd7_IMG_2204.jpeg,/project/uploads/68cd61d5af168_IMG_2205_medium2.jpeg', '2025-09-22', '2025-10-05'),
(38, 105, 'Bevásárló szatyor', 'https://kamecrochet.com/2019/07/19/sakura-market-bag/', '167', 4, '', '', '2025-09-08', NULL),
(38, 106, 'Lufi kutya', 'https://www.ravelry.com/patterns/library/balloon-dog-9', '64', 6, 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', '/project/uploads/68cd62c81db1d_20220825_125448_medium2.jpg,/project/uploads/68cd62c81dd16_20220825_125458_medium2.jpg', '2025-09-08', '2025-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `regdatetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `rights` int DEFAULT '101',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `mail`, `pass`, `regdatetime`, `rights`) VALUES
(11, 'ignac.szilvia', 'ignac.szilvia@outlook.com', '$2y$10$uV2HP5zWYTdn/3zecWaDPekGtxDKsXNSdnxYZdwaMlKfzKSOuvFYe', '2025-08-19 14:22:11', 103),
(37, 'ignacszilvia', 'ignac.szilvia@gmail.com', '$2y$10$/RDBWJEN1Ts4HUaGKqMK2.EpEC5Rt.PkycHXcxaghJs2hs4Azzxjm', '2025-09-19 12:48:23', 101),
(38, 'horgolas', 'horgol@gmail.com', '$2y$10$WtYZCAw0M0ivOyNmX8q3W.AKeTPsx8sV6rAIHU11lphodKO3HrnSK', '2025-09-19 12:49:25', 101),
(39, '12345678', '1234@1234.hu', '$2y$10$PVvyJ0IzUs5RN8hUg079Ue8CUsM.2yxXRuJ1OX8h6ruUyKJ8fgjti', '2025-09-19 12:52:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `yarns`
--

DROP TABLE IF EXISTS `yarns`;
CREATE TABLE IF NOT EXISTS `yarns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand` set('Drops','Alize','DMC','Kartopu','Nako','Wolans','Yarnart','Himalaya','Schachenmayr','Scheepjes','Lana Grossa','Vlna-Hep','Gründl','Red Heart','Malabrigo','Lion Brand','Bernat','Adriafil','Berroco','Blue Sky Fibers','Caron','Cascade','Debbie Bliss','Deramores','Dream in Color','Ella Rae','Hayfield','Hoooked','James C. Brett','Juniper Moon Farm','King Cole','Knit Collage','Koigu','Lang Yarns','Lopi','McIntosh','MillaMia','Noro','Paintbox','Patons','Plymouth','Sirdar','Snuggly',' Stylecraft','Tahki','The Yarn Collective','Trendsetter','Universal','Valley','Viking Of Norway','West Yorkshire Spinners','Willow and Lark','Wool and the Gang','Yarn and Colors','Hobbii Yarn','Yarnspirations','KnitPicks','Darn Good Yarn','We Are Knitters','Gorgeous Alpacas','Papillon','Gombolyda','Urth','FibraNatura') CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `variety` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `yarns`
--

INSERT INTO `yarns` (`id`, `brand`, `variety`) VALUES
(1, 'Drops', 'Air'),
(2, 'Drops', 'Alaska'),
(3, 'Drops', 'Alpaca'),
(4, 'Drops', 'Andes'),
(5, 'Drops', 'Baby Merino'),
(6, 'Drops', 'Belle'),
(7, 'Drops', 'Big Merino'),
(8, 'Drops', 'Cotton Light'),
(9, 'Drops', 'Cotton Merino'),
(10, 'Drops', 'Daisy'),
(11, 'Drops', 'Fabel'),
(12, 'Drops', 'Fiesta'),
(13, 'Drops', 'Flora'),
(14, 'Drops', 'Glitter'),
(15, 'Drops', 'Karisma'),
(16, 'Drops', 'Lima'),
(17, 'Drops', 'Melody'),
(18, 'Drops', 'Muskat'),
(19, 'Drops', 'Nepal'),
(20, 'Drops', 'Nord'),
(21, 'Drops', 'Paris'),
(22, 'Drops', 'Polaris'),
(23, 'Drops', 'Puna'),
(24, 'Drops', 'Safran'),
(25, 'Drops', 'Sky'),
(26, 'Drops', 'Snow'),
(27, 'Drops', 'Soft Tweed'),
(28, 'Alize', 'Cotton Gold'),
(29, 'Alize', 'Puffy'),
(30, 'Alize', 'Velluto'),
(31, 'Alize', 'Diva'),
(33, 'Alize', 'Baby Best'),
(34, 'DMC', 'Happy Cotton'),
(35, 'DMC', 'ECO Vita'),
(36, 'DMC', 'Happy Acrylic'),
(37, 'DMC', 'Wolly'),
(38, 'DMC', 'Petra'),
(39, 'DMC', 'Denim'),
(40, 'DMC', 'Natura'),
(41, 'Kartopu', 'Organica'),
(42, 'Kartopu', 'Yumurcak'),
(43, 'Kartopu', 'Lotus'),
(44, 'Kartopu', 'Baby Natural'),
(45, 'Kartopu', 'Bambu Sakura'),
(46, 'Kartopu', 'Melange Wool'),
(47, 'Kartopu', 'Super Chunky'),
(48, 'Nako', 'Angorella'),
(49, 'Nako', 'Bonbon Cuore'),
(50, 'Nako', 'Bonbon DK 50'),
(51, 'Nako', 'Cotonella'),
(52, 'Nako', 'Doga Dostu'),
(53, 'Nako', 'Elit Baby'),
(54, 'Nako', 'Elit Baby Mini Batik'),
(55, 'Nako', 'Estiva Sily'),
(56, 'Nako', 'Hercai'),
(57, 'Nako', 'Mohair Delicate Bulky'),
(58, 'Nako', 'Mohair Delicate Colorflow'),
(59, 'Nako', 'Ombre'),
(60, 'Nako', 'Saten'),
(61, 'Nako', 'Spaghetti'),
(62, 'Nako', 'Superlambs 25'),
(63, 'Nako', 'Vals'),
(64, 'Wolans', 'Bunny Baby'),
(65, 'Wolans', 'Bunny Shine'),
(66, 'Wolans', 'Fox'),
(67, 'Yarnart', 'Dolce'),
(68, 'Yarnart', 'Flowers'),
(69, 'Yarnart', 'Jeans'),
(70, 'Himalaya', 'Arya'),
(71, 'Himalaya', 'Bikini'),
(72, 'Himalaya', 'Everyday'),
(73, 'Himalaya', 'Everyday Batik'),
(74, 'Himalaya', 'Everyday New Tweed'),
(75, 'Himalaya', 'Everyday Worsted'),
(76, 'Himalaya', 'Kuzucuk'),
(77, 'Himalaya', 'Rozetti Destina'),
(78, 'Himalaya', 'Rozetti Puzzle Comfort'),
(79, 'Himalaya', 'Velvet'),
(80, 'Himalaya', ' Verda'),
(81, 'Himalaya', 'Fibra Natura Bamboo Jazz'),
(82, 'Schachenmayr', 'Catania Grande'),
(83, 'Schachenmayr', 'Catania Originals'),
(84, 'Schachenmayr', 'Bravo Color Originals'),
(85, 'Schachenmayr', 'Bravo Originals'),
(86, 'Schachenmayr', 'Bravo Quick and Easy'),
(87, 'Schachenmayr', 'Bravo Softy'),
(88, 'Schachenmayr', 'Merino Extrafine'),
(89, 'Schachenmayr', 'Mohair Dream'),
(90, 'Schachenmayr', 'Regia Premium Bamboo '),
(91, 'Schachenmayr', 'Regia tweed'),
(92, 'Schachenmayr', 'Soft and Easy'),
(93, 'Schachenmayr', 'Soft and Easy Color '),
(94, 'Schachenmayr', 'Tahiti'),
(95, 'Scheepjes', 'Catona'),
(96, 'Scheepjes', 'Whirl'),
(97, 'Scheepjes', 'Whirlette'),
(98, 'Scheepjes', 'Woolly Whirl'),
(99, 'Scheepjes', 'Cotton8'),
(100, 'Scheepjes', 'Metropolis'),
(101, 'Scheepjes', 'Maxi Sweet Treat'),
(102, 'Scheepjes', 'Comfy'),
(103, 'Scheepjes', 'Sunkissed'),
(104, 'Scheepjes', 'Ricorumi'),
(105, 'Scheepjes', 'Glow Up'),
(106, 'Scheepjes', 'Organicon'),
(107, 'Scheepjes', 'Candy Floss'),
(108, 'Scheepjes', 'Mohair Rhythm'),
(109, 'Scheepjes', 'Arcadia'),
(110, 'Lana Grossa', 'Gomitolo Intenso'),
(111, 'Lana Grossa', 'Gomitolo Fumo'),
(112, 'Lana Grossa', 'Lucciola'),
(113, 'Lana Grossa', 'Orsetto'),
(114, 'Lana Grossa', 'Winter Softness'),
(115, 'Lana Grossa', 'Basta Mista'),
(116, 'Lana Grossa', 'Alpaca Air II.'),
(117, 'Lana Grossa', 'Gigante'),
(118, 'Lana Grossa', 'Cassata'),
(119, 'Lana Grossa', 'Landlust Sockenwolle Melange'),
(120, 'Lana Grossa', 'Lana Grossa Mille II.'),
(121, 'Lana Grossa', 'Cool Merino Big'),
(122, 'Lana Grossa', 'Farfalla'),
(123, 'Vlna-Hep', 'Camilla'),
(124, 'Vlna-Hep', 'Floxy'),
(125, 'Vlna-Hep', 'Happy Baby'),
(126, 'Vlna-Hep', 'Jeans'),
(127, 'Vlna-Hep', 'Mohair de Luxe'),
(128, 'Vlna-Hep', 'Moonlight'),
(129, 'Vlna-Hep', 'Nevada Color'),
(130, 'Vlna-Hep', 'Start'),
(131, 'Vlna-Hep', 'Twist'),
(132, 'Vlna-Hep', 'Waltz'),
(133, 'Gründl', 'Funny UNI'),
(134, 'Gründl', 'Arktis'),
(135, 'Gründl', 'Cotton Quick'),
(136, 'Gründl', 'Lisa Premium Uni'),
(137, 'Gründl', 'Big Lisa Premium'),
(138, 'Gründl', 'Lolly Pop'),
(139, 'Gründl', 'Mohana'),
(140, 'Gründl', 'Big Mamma Uni'),
(141, 'Gründl', 'Nordic Chunky'),
(143, 'Red Heart', 'Lavinia'),
(144, 'Red Heart', 'Lisa Lurex'),
(145, 'Red Heart', 'Stella'),
(146, 'Red Heart', 'Bella'),
(147, 'Red Heart', 'Lisa Big'),
(148, 'Red Heart', 'Melange'),
(149, 'Red Heart', 'Soft Baby Steps'),
(150, 'Red Heart', 'Soft'),
(151, 'Red Heart', 'Calista'),
(152, 'Malabrigo', 'Rasta'),
(153, 'Malabrigo', 'Mecha'),
(154, 'Malabrigo', 'Sock'),
(155, 'Malabrigo', 'Lace'),
(156, 'Malabrigo', 'Silkpaca'),
(157, 'Malabrigo', 'Worsted'),
(158, 'Malabrigo', 'Rios'),
(160, 'Drops', 'Bomull-Lin'),
(163, 'Lion Brand', 'Cotton Hemp'),
(166, 'Bernat', 'Blanket'),
(167, 'Paintbox', 'Cotton DK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
