-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Aug 30. 09:08
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `crochetproject`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projects`
--

CREATE TABLE `projects` (
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pattern` varchar(1000) DEFAULT NULL,
  `yarn` varchar(255) DEFAULT NULL,
  `hook` decimal(10,0) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `finish` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `projects`
--

INSERT INTO `projects` (`uid`, `id`, `name`, `pattern`, `yarn`, `hook`, `description`, `image`, `start`, `finish`) VALUES
(4, 95, 'Amigurumi', 'https://amigurumink.hu/', '110', 6, '', '/project/uploads/68b056ab58937_crochet-dinosaur-free-amigurumi-pattern-1-3734250398.jpg,/project/uploads/68b06c4122f23_Cute-Crochet-Duck-Amigurumi-Free-Pattern11-1046517853.jpg', '2025-08-09', NULL),
(4, 96, 'Amigurumi', 'https://amigurumink.hu/', '134', 6, 'fsdfdsfdsf', '/project/uploads/68b075576f20d_crochet-dinosaur-free-amigurumi-pattern-1-3734250398.jpg,/project/uploads/68b075577116f_Cute-Crochet-Duck-Amigurumi-Free-Pattern11-1046517853.jpg', '2025-08-13', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `regdatetime` datetime DEFAULT current_timestamp(),
  `rights` int(11) DEFAULT 101
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`uid`, `username`, `mail`, `pass`, `regdatetime`, `rights`) VALUES
(4, '12345678', '1234@1234.hu', '$2y$10$6hWCaZD.zfz03SKtFkDdaOQ8S/I22TAYaE1OwpYwLHnrfIxQlJ9u6', '2025-08-14 14:55:24', 101),
(11, 'ignacszilvia', 'ignac.szilvia@outlook.com', '$2y$10$jVe/78YmQ0tXLFAn.4k1U.L.oa.gMsmwQ4IyDPeWIjzvyIK30DF7q', '2025-08-19 14:22:11', 103),
(34, 'ignac.szilvia', 'ignac.szilvia@gmail.com', '$2y$10$yQtUnY7k5zC5yTyBp/bRNONNmxYpA8vIJZLBY/YF3Vrullh8YTAOu', '2025-08-27 10:56:32', 101);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `yarns`
--

CREATE TABLE `yarns` (
  `id` int(11) NOT NULL,
  `brand` set('Drops','Alize','DMC','Kartopu','Nako','Wolans','Yarnart','Himalaya','Schachenmayr','Scheepjes','Lana Grossa','Vlna-Hep','Gründl','Red Heart','Malabrigo') DEFAULT NULL,
  `variety` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `yarns`
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
(32, 'Alize', 'Softy'),
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
(158, 'Malabrigo', 'Rios');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Userid` (`uid`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- A tábla indexei `yarns`
--
ALTER TABLE `yarns`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT a táblához `yarns`
--
ALTER TABLE `yarns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
