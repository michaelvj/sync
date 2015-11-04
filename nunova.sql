-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 04 nov 2015 om 09:50
-- Serverversie: 5.5.37
-- PHP-Versie: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nunova`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Nieuws'),
(2, 'Oproepen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Beheerder', '{"user":true,"news":true,"workshop":true}'),
(2, 'Leraar', '{"user":{"show":true,"create":{"Leerling":true},"update":{"Leerling":true}},"news":true,"workshop":true}'),
(3, 'Leerling', '{"news":{"create":true},"user":{"update":{"Leerling":true}}}');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden uitgevoerd voor tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_03_25_192544_create_user_table', 1),
('2014_03_25_202324_create_group_table', 1),
('2014_03_27_132710_create_categories_table', 1),
('2014_03_27_133003_create_news_table', 1),
('2014_03_27_193342_create_workshops_table', 1),
('2014_03_27_193711_create_signups_table', 1),
('2014_08_25_104537_add_featured_image', 2),
('2014_08_27_144756_add_screen_toggle', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `shows_at` datetime NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_featured` tinyint(1) NOT NULL,
  `featured_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured_visible` tinyint(1) NOT NULL DEFAULT '0',
  `is_screen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `news_user_id_foreign` (`user_id`),
  KEY `news_category_id_foreign` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Gegevens worden uitgevoerd voor tabel `news`
--

INSERT INTO `news` (`id`, `user_id`, `category_id`, `title`, `text`, `shows_at`, `expires_at`, `created_at`, `updated_at`, `is_featured`, `featured_image`, `featured_visible`, `is_screen`) VALUES
(2, 11, 1, 'SYNC', 'Binnen de opleiding AO (Applicatie Ontwikkeling) aan de ICT Academie van het Nova College maken leerlingen prachtige applicaties. <br /><br />Zo is er gewerkt aan <b>SYNC</b>, een applicatie waarop studenten het laatste opleiding- en vak gerelateerde nieuws kunnen bekijken en een overzicht van workshops kunnen zien waarop op ze zich via een QR-code op kunnen inschrijven. <br /><br />Het innovatieve ontwikkelteam is constant bezig met het bedenken en maken van extra features die er voor zorgen dat <b>SYNC</b> perfect aansluit op de belevingswereld van de doelgroep. Zo laat de applicatie meteen even zien wat voor weer het is, zodat de studenten het oogcontact met hun scherm niet hoeven te verbreken om naar buiten te kijken. Er is zelfs aan een "<i>Holliday-counter</i>" gewerkt om onnodig multitasking (SYNC/Agenda/telefoon/horloge) te voorkomen.<br /><br />Zoals je kunt zien is <b>SYNC</b> op dit moment live. De app is nog wel in <b>Open Beta</b>, wat betekend dat er nog wordt gewerkt om eventuele bugs op te lossen, en <i>"nice to have"</i> features to te voegen. <br /><br />Heb je ideeën voor verbetering van <b>SYNC</b>? Stuur dan een mailtje aan sboelsma@novacollege.nl.  <br /><br /><br /><br /><br />', '2014-05-15 13:47:00', NULL, '2014-05-15 11:47:58', '2015-01-12 12:54:42', 0, 'Il3r7uC7t0.png', 1, 0),
(3, 11, 2, 'Programmeur gezocht', 'Voor het ontwikkelen van een <b>secure login API </b>zijn we op zoek naar een gestructureerde programmeur met verstand van beveiliging.<br /><br />Lijkt dit je een interessante of uitdagende klus, neem dan contact op met <b>Wouter van Hezel</b>.', '2014-05-19 13:38:00', NULL, '2014-05-19 11:38:03', '2015-01-08 10:35:57', 0, 'Il3r7uC7t0.png', 1, 1),
(11, 14, 1, 'Appel van 7 ton', '<b>Een van de weinige resterende exemplaren van de eerste serie Apple-computers is woensdag in New York geveild voor 905.000 dollar (715.000 euro).</b><br /><br />De identiteit van de koper is niet bekendgemaakt.<br /><br />Apple-medeoprichter Steve Wozniak bouwde de eerste 50 Apple-1''s in de zomer van 1976 in de garage van de latere Apple-topman Steve Jobs in Los Altos in de Amerikaanse staat Californië.De eerste Apple-computers, die voor een revolutie in het computergebruik thuis zorgden, werden verkocht voor 666,66 dollar.<br /><br /><i>Bron: nu.nl</i>', '2014-10-23 10:17:00', '2014-10-30 10:18:00', '2014-10-23 08:19:20', '2015-01-12 07:47:29', 0, 'Il3r7uC7t0.png', 1, 0),
(12, 14, 1, 'Oprichter Android verlaat Google', '<b>Andy Rubin, de oprichter van Android en jarenlang de directeur van de mobiele afdeling van Google, verlaat het bedrijf. <br /><br /></b>Rubin nam in maart 2013 al afscheid van zijn rol als hoofd van de mobiele divisie van Google en leidde de afgelopen anderhalf jaar de nieuwe robotafdeling bij de zoekgigant.<br /><b><br /></b>De Android-oprichter vertrekt bij Google om een incubator voor startups die hardware ontwikkelen op te richten. Of Google daarbij betrokken is en hoe de incubator gaat heten, is onduidelijk.<br /><b><br /></b><i>Door: NU.nl/Colin van Hoek </i><b><br /></b>', '2014-10-31 10:11:40', '2014-11-07 10:10:00', '2014-10-31 09:11:40', '2015-01-12 07:47:29', 0, 'Il3r7uC7t0.png', 1, 0),
(13, 14, 2, 'Assessment bekabeling', 'Bereid je op tijd voor op het examen-bekabeling.<br />Maak een afspraak met het servicepunt Beverwijk.<br />Bekijk hier alvast de oefen film.<br /><br /><a href="http://youtube.com/mrandyict">http://youtube.com/mrandyict</a><br />', '2014-11-25 13:34:00', '2014-11-26 13:34:00', '2014-11-25 12:35:46', '2014-12-01 07:42:49', 0, 'Il3r7uC7t0.png', 1, 0),
(16, 14, 1, 'Nieuwe roosters', 'De nieuwe roosters zijn na de vakantie in werking maar nog niet op magister verwerkt.', '2015-01-07 11:00:00', '2015-01-15 16:00:00', '2015-01-07 10:05:15', '2015-01-12 07:47:29', 0, 'Il3r7uC7t0.png', 0, 0),
(18, 14, 1, 'Microsoft informeert niet meer over veiligheidsupdates ', 'Microsoft stopt met het geven van informatie over veiligheidsupdates. Betalende gebruikers zullen nog wel worden voorzien van informatie.Dat meldt het bedrijf in een <a href="http://blogs.technet.com/b/msrc/archive/2015/01/07/evolving-advance-notification-service-ans-in-2015.aspx">blog</a>. Microsoft meldde tot nu toe elke maand welke beveiligslekken het had gedicht in de laatste beveiligingsupdates. Daar is volgens Microsoft geen behoefte meer aan. Hoewel grote bedrijven en premium-klanten nog wel interesse hebben in gedetailleerde informatie over de beveiligingsupdates, maken ''normale'' klanten nog maar weinig gebruik van de dienst. Ook premiumgebruikers krijgen de informatie niet meer automatisch, maar kunnen wel aangeven dat ze de informatie willen ontvangen. ', '2015-01-09 14:00:00', '2015-01-22 16:07:00', '2015-01-09 13:09:21', '2015-01-12 13:10:03', 1, 'Il3r7uC7t0.png', 1, 1),
(20, 14, 1, 'Nieuwe workshops', 'Heeft u nieuwe workshops voor de ICT afdeling stuur ze dan naar <a href="http://hotmail.com/">www.servicedeskbeverwijk@hotmail.com</a>', '2015-01-14 11:03:00', '2015-01-16 11:03:00', '2015-01-14 10:06:18', '2015-01-19 10:06:18', 0, 'Il3r7uC7t0.png', 1, 1),
(22, 14, 1, 'SYNC is weer online!!', 'Eindelijk is het zover, SYNC is weer online!!!<br />Vanaf vandaag houden we je weer op de hoogte over allerlei nieuws, oproepen en workshops.<br /><br />Met vriendelijke groet, Team SYNC', '2015-06-03 12:37:43', '2015-06-20 12:45:00', '2015-06-03 10:37:43', '2015-09-28 09:34:53', 1, 'Il3r7uC7t0.png', 1, 1),
(23, 14, 2, 'PWN Smart Solutions Hack-a-thon 23, 24, 25 september, schrijf je (student/leerling) in!', '<b>Op woensdag 23 t/m vrijdag 25 september wordt er in samenwerking met\nPWN</b>, de 3D Makers Zone en onderwijsinstellingen een Smart Solutions hack-a-thon\ngeorganiseerd. Gedurende 3 dagen gaan leerlingen/studenten in\nmultidisciplinaire teams samen met experts van PWN het vak van (of een\nonderdeel daarvan) de PWN monteur opnieuw uitvinden. Met behulp van slimme\ntechnologie zoals 3D printen. Met een mooie beloning voor het team met de\nbeste, slimste, creatiefste oplossing!<br /><a href="http://www.3dmakerszone.com/pwnhackathon.php">http://www.3dmakerszone.com/pwnhackathon.php</a><br /><br /><br /><br /><br /><br />', '2015-06-17 14:20:00', '2015-09-20 14:21:00', '2015-06-17 12:21:48', '2015-06-17 12:21:48', 1, 'Il3r7uC7t0.png', 1, 0),
(24, 14, 1, 'Nieuw lab van TU Eindhoven gaat werken aan wifi met 1Tbit/s', '<b>De TU/e heeft een onderzoekslab geopend, waar onderzoekers onder meer gaan werken aan wifi-standaard die snelheden moet bieden van 1Tbit/s. Ook gaat het lab werken aan kleine sensors, die hun stroom moeten halen uit draadloze signalen. </b><br /><br />Het doel is om de wifi-standaard die signalen met 1Tbit/s kan doorgeven in 2020 ontwikkeld te hebben, schrijft de TU/e. Momenteel is de snelste wifi-standaard 802.11ac, die snelheden kan behalen tot 1,3Gbit/s. De nieuwe standaard moet dus snelheden bieden die 750 keer hoger liggen.', '2015-08-27 15:06:00', '2015-09-03 15:06:00', '2015-08-27 13:13:15', '2015-08-27 13:13:15', 0, 'Il3r7uC7t0.png', 1, 1),
(25, 14, 1, 'Chinees bedrijf werkt aan ARM-serverchip met 64 cores', '<b>Het Chinese bedrijf Phytium Technology werkt aan een processor met 64 ARM-cores en geheugen- en cache-controllers op een enkele </b><i><b>die</b></i><b>. De processor is bedoeld voor enterprise-servers en cloud computing.<br /><br /></b>Phytium is in 2012 opgericht en voornemens de grootste cpu- en asic-leverancier van China te worden, blijkt uit de presentatie die het bedrijf gaf op de Hot Chips-conferentie in het Amerikaanse Cupertino. De Mars-chip van Phytium is bedoeld voor toepassingen die veel rekenkracht, geheugen en bandbreedte vergen. Daarnaast werkt het bedrijf nog aan Earth, een minder high-endprocessor waarover nog weinig bekend is en die voor schaalbare toepassingen bedoeld is.<b><br /></b>', '2015-08-27 15:08:00', '2015-09-03 15:08:00', '2015-08-27 13:15:10', '2015-08-27 13:15:10', 0, 'Il3r7uC7t0.png', 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `signups`
--

CREATE TABLE IF NOT EXISTS `signups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workshop_id` int(10) unsigned NOT NULL,
  `student_number` int(11) NOT NULL,
  `firstname` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=84 ;

--
-- Gegevens worden uitgevoerd voor tabel `signups`
--

INSERT INTO `signups` (`id`, `workshop_id`, `student_number`, `firstname`, `lastname`, `email`) VALUES
(1, 1, 125333, 'Mark', 'Vels', 'mvels333@cursist.novacollege.nl'),
(2, 2, 73448, 'Jeffrey', 'Jacobs', 'Nova@jefio.nl'),
(3, 3, 86128, 'Hilbert', 'Greveling', 'hilbertgreveling@live.nl'),
(4, 3, 86127, 'Erwin', 'Hendriks', 'erwtje_hendriks@hotmail.com'),
(5, 3, 103858, 'Michael', 'vanJelgerhuis', 'michael_ajax1995@hotmail.com'),
(8, 11, 131614, 'Jasper', 'Zandbergen', 'ZandbergenJasper@gmail.com'),
(9, 11, 123709, 'Erik', 'Steltenpool', 'erikstelt@gmail.com'),
(10, 11, 131741, 'Wessel', 'Bos', 'wescar245@gmail.com'),
(11, 11, 1274871, 'Jim', 'Ebbelaar', 'jim.ebbelaar@gmail.com'),
(12, 11, 130907, 'Joris', 'Ebbelaar', 'joris-ebbelaar@hotmail.nl'),
(13, 11, 121757, 'Mathieu', 'Posthumus', 'MathieuPosthumus@hotmail.com'),
(14, 8, 124871, 'Jim', 'Ebbelaar', 'jim.ebbelaar@gmail.com'),
(15, 8, 130907, 'Joris', 'Ebbelaar', 'joris-ebbelaar@hotmail.nl'),
(16, 11, 114524, 'Carlo', 'Bos', 'cbos524@cursist.novacollege.nl'),
(17, 11, 126309, 'Ogulcan', 'Yüksel', 'Ogulcan-Yuksel24@live.nl'),
(18, 8, 121757, 'Mathieu', 'Posthumus', 'MathieuPosthumus@hotmail.com'),
(19, 8, 126309, 'Ogulcan', 'Yuksel', 'Ogulcan-Yuksel24@live.nl'),
(20, 11, 120388, 'Mark', 'Akkermans', 'markakkermans@outlook.com'),
(21, 8, 123709, 'Erik', 'Steltenpool', 'erikstelt@gmail.com'),
(22, 8, 131741, 'Wessel', 'Bos', 'wescar245@gmail.com'),
(23, 8, 113053, 'Roy', 'Dijkstra', 'roy.dijkstra@live.nl'),
(24, 8, 111697, 'Sander', 'Oostenbrink', 'sander-oostenbrink@hotmail.com'),
(25, 8, 116731, 'David', 'Muskee', 'davidencko64@gmail.com'),
(26, 8, 103858, 'Michael', 'vanJelgerhuis', 'michaelvanjelgerhuis@gmail.com'),
(27, 8, 119678, 'Maverick', 'Pol', 'maver100@gmail.com'),
(28, 8, 102681, 'Roel', 'Meijns', 'roelmeijns123@hotmail.com'),
(29, 11, 126358, 'Joey', 'Zegers', 'joey_zegers@hotmail.nl'),
(30, 8, 111363, 'Jimmy', 'Eng', 'jimbo95@live.nl'),
(31, 8, 111285, 'Joost', 'Loots', 'joost.loots@ziggo.nl'),
(32, 8, 126358, 'Joey', 'Zegers', 'joey_zegers@hotmail.nl'),
(33, 11, 88833, 'Jeffrey', 'Meyer', 'meyer.jeffrey@hotmail.nl'),
(34, 11, 73448, 'Jeffrey', 'Jacobs', 'novacollege@jefio.nl'),
(35, 11, 111285, 'Joost', 'Loots', 'joost.loots@ziggo.nl'),
(36, 8, 53704, 'Sabri', 'Catak', 'Catak1988@gmail.com'),
(37, 11, 103858, 'Michael', 'vanJelgerhuis', 'michaelvanjelgerhuis@gmail.com'),
(38, 8, 73448, 'Jeffrey', 'Jacobs', 'novacollege@jefio.nl'),
(39, 8, 90702, 'Bryan', 'Duijneveld', 'bryanduijneveld@hotmail.com'),
(40, 8, 112467, 'Davy', 'Visser', 'dv.visser@hotmail.com'),
(41, 11, 123708, 'ivan', 'Egmond', 'ivanvanegmond@hotmail.com'),
(42, 8, 88833, 'Jeffrey', 'Meyer', 'meyer.jeffrey@hotmail.nl'),
(43, 12, 131614, 'Jasper', 'Zandbergen', 'ZandbergenJasper@gmail.com'),
(44, 13, 124871, 'Jim', 'Ebbelaar', 'jim.ebbelaar@gmail.com'),
(45, 13, 126358, 'Joey', 'Zegers', 'joey_zegers@hotmail.nl'),
(46, 13, 121757, 'Mathieu', 'Posthumus', 'mathieuposthumus@hotmail.com'),
(47, 14, 111947, 'Jeremy', 'van den Herik', 'test@test.nl'),
(48, 14, 119678, 'Maverick', 'Pol', 'maver100@gmail.com'),
(49, 14, 113053, 'Roy', 'Dijkstra', 'roy.dijkstra@live.nl'),
(50, 14, 114524, 'Carlo', 'Bos', 'cbos524@cursist.novacollege.nl'),
(51, 13, 114524, 'Carlo', 'Bos', 'cbos524@cursist.novacollege.nl'),
(52, 13, 73448, 'Jeffrey', 'Jacobs', 'pray2win@jefio.nl'),
(53, 14, 112467, 'Davy', 'Visser', 'dv.visser@hotmail.com'),
(54, 14, 121232, 'Ruud', 'Schrijver', 'ruudschrijver@hotmail.com'),
(55, 14, 104757, 'Anu', 'Toussaint', 'anudie@hotmail.com'),
(56, 14, 103858, 'Michael', 'vanJelgerhuis', 'michaelvanjelgerhuis@gmail.com'),
(57, 14, 111697, 'Sander', 'oostenbrink', 'sander-oostenbrink@hotmail.com'),
(58, 13, 131614, 'Jasper', 'Zandbergen', 'ZandbergenJasper@gmail.com'),
(59, 14, 131614, 'Jasper', 'Zandbergen', 'ZandbergenJasper@gmail.com'),
(60, 13, 131741, 'Wessel', 'Bos', 'wescar245@gmail.com'),
(61, 14, 124871, 'Jim', 'Ebbelaar', 'jim.ebbelaar@gmail.com'),
(62, 13, 53704, 'sabri', 'CATAK', 'CATAK1988@GMAIL.COM'),
(63, 14, 123709, 'Erik', 'Steltenpool', 'erikstelt@gmail.com'),
(64, 13, 123709, 'Erik', 'Steltenpool', 'erikstelt@gmail.com'),
(65, 14, 121757, 'Mathieu', 'Posthumus', 'MathieuPosthumus@hotmail.com'),
(66, 14, 126309, 'Ogulcan', 'Yuksel', 'Ogulcan-Yuksel24@live.nl'),
(67, 14, 126358, 'Joey', 'Zegers', 'joey_zegers@hotmail.nl'),
(68, 13, 129524, 'Daan', 'Arend', 'school@omniadicta.net'),
(69, 14, 131741, 'Wessel', 'Bos', 'wescar245@gmail.com'),
(70, 14, 53704, 'sabri', 'catak', 'Catak1988@gmail.com'),
(71, 14, 120177, 'Jesse', 'Folkertsma', 'jfokkur@gmail.com'),
(72, 14, 111285, 'Joost', 'Loots', 'Joost.loots@ziggo.nl'),
(73, 13, 130907, 'Joris', 'Ebbelaar', 'joris-ebbelaar@hotmail.nl'),
(74, 14, 130907, 'joris', 'ebbelaar', 'joris-ebbelaar@hotmail.nl'),
(75, 15, 131741, 'Wessel', 'Bos', 'wescar245@gmail.com'),
(76, 15, 131614, 'Jasper', 'Zandbergen', 'ZandbergenJasper@gmail.com'),
(77, 17, 119678, 'Maverick', 'Pol', 'maver100@gmail.com'),
(78, 19, 53704, 'SABRI', 'CATAK', 'catak1988@gmail.com'),
(79, 20, 53704, 'Sabri', 'Catak', 'catak1988@gmail.com'),
(80, 22, 57628, 'Rene', 'Jong', 'rcpjong@gmail.com'),
(81, 20, 57628, 'Rene', 'Jong', 'rcpjong@gmail.com'),
(82, 22, 4, 'a', 'r', 'arekveld@novacollege.nl'),
(83, 30, 69194, 'Elfin', 'Wulp', 'ewulp194@novacollege.nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_group_id_foreign` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `deleted_at`, `group_id`, `remember_token`, `reset_password`) VALUES
(1, 'bla', 'bla', 'bla', '', '2014-09-11 07:24:49', 1, '', ''),
(2, 'Tom', 'Hooijenga', 'tomhooijenga@gmail.com', '$2a$10$I6JS3IF2ZHEcvcybT.kcT.ddY4lEJ5tXxbZrRWtoPweB72NH5.7Uq', NULL, 1, NULL, NULL),
(11, 'Sander', 'Boelsma', 'sboelsma@me.com', '$2a$10$VXmrgznxUsjhGLi6exErYOHMQZzt7Vd3Ua29Ayt9YcwmD7VrpH7dO', NULL, 1, 'FXg94QKQ9pybp7AmjaTtZjtAcz8s9xHVAidR3eHBrqGuvdVGlnAP3jQu6qYu', NULL),
(13, 'Test', 'Test', 'test@test.nl', '$2a$10$BAQ8LB3Yi5.HOl9EMv1eceid8CpAQJggtvixARb6/lwDA0gqkfIbK', '2014-09-17 09:11:22', 1, NULL, NULL),
(14, 'Contentmanager', 'Sync', 'sync@studiesoft.com', '$2a$10$BAQ8LB3Yi5.HOl9EMv1eceid8CpAQJggtvixARb6/lwDA0gqkfIbK', NULL, 2, 'IT1uR5T5wmRHdnklolrLDK9DuviW6B1DiK5mUkKVS3e5OMwFiZh7w3tHMxeR', NULL),
(15, 'test', 'account', 'sander@studiesoft.com', '$2y$10$tQ/xhj4fETArn4bsvB7fCe4jtOhZmMEx/Or3aE1Voz71cG.Hjalz2', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `workshops`
--

CREATE TABLE IF NOT EXISTS `workshops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `shows_at` datetime NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_featured` tinyint(1) NOT NULL,
  `begins_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ends_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `max_signups` int(11) NOT NULL,
  `teacher_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured_visible` tinyint(1) NOT NULL DEFAULT '0',
  `is_screen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `workshops_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Gegevens worden uitgevoerd voor tabel `workshops`
--

INSERT INTO `workshops` (`id`, `user_id`, `title`, `text`, `shows_at`, `expires_at`, `created_at`, `updated_at`, `is_featured`, `begins_at`, `ends_at`, `max_signups`, `teacher_name`, `teacher_email`, `location`, `featured_image`, `featured_visible`, `is_screen`) VALUES
(24, 14, 'Laptop reparatie', '<b>21-01 </b>Andy zal aan de hand van een defecte laptop\ndemonstreren hoe je op een veilige manier laptopreparaties uitvoert.\nAansluitend is de mogelijkheid om zelf aan de gang te gaan met laptopgereedschap,\nlijmpistool, epoxyhars, soldeerbout etc. Deze workshop is op 2015-01-21 12:45', '2015-01-15 13:00:00', '2015-01-21 12:40:00', '2015-01-15 12:06:01', '2015-01-21 14:20:29', 1, '2015-01-15 12:03:00', '2015-01-21 11:40:00', 20, 'Andy Rekveld', 'arekveld@novacollege.nl', 'Service Desk', 'Il3r7uC7t0.png', 1, 0),
(25, 14, 'Tek Tok  maker movement. (film plus discussie)', '<b>28 - 01</b> Apparaten zoals 3D printers en lasersnijders stellen\nmensen in staat om zelf dingen te maken. Er is een hele “ makermovement” aan\nhet ontstaan met labs waar mensen van alle apparaten gebruik kunnen maken. Deze workshop is op 2015-01-28 12:45', '2015-01-15 13:00:00', '2015-01-28 12:40:00', '2015-01-15 12:08:11', '2015-03-10 10:26:44', 1, '2015-01-15 12:00:00', '2015-01-28 11:40:00', 20, 'Paul Jurriens', 'pjurriens@novacollege.nl', 'Service Desk', 'Il3r7uC7t0.png', 1, 0),
(26, 14, 'Voorbereiding  open dag', '<b>04-02</b> Het lokaal en de\ninformatietafel klaarmaken voor de bezoekers van de open dag. Deze workshop is op 2015-02-04 12:45', '2015-01-15 13:00:00', '2015-02-04 12:40:00', '2015-01-15 12:10:17', '2015-03-10 11:08:01', 1, '2015-01-15 12:07:00', '2015-02-04 11:40:00', 20, 'Paul & Andy', 'pjurriens@novacollege.nl', 'Service Desk', 'Il3r7uC7t0.png', 1, 0),
(27, 14, 'IP (beveiligings) camera’s installeren.', '<b>11-02</b> IP camera’s worden steeds meer gebruikt om huizen te\nbeveiligen of om te volgen wat er in een nestkast gebeurt. Hoe krijg je\ncamerabeelden op je tablet of telefoon? Deze workshop wordt gehouden op 2015-02-11 12:45', '2015-01-15 13:00:00', '2015-02-11 12:40:00', '2015-01-15 12:11:27', '2015-03-10 10:26:44', 1, '2015-01-15 12:00:00', '2015-02-11 11:40:00', 20, 'Paul & Andy', 'arekveld@novacollege.nl', 'Service Desk', 'Il3r7uC7t0.png', 1, 0),
(28, 14, ' LB:  verkiezingen provinciale staten', '11/03 Voortaan worden de leden van de provinciale staten tegelijkertijd met de verkiesbare leden van het algemeen bestuur van de waterschappen gekozen. De leden van de provinciale staten worden eenmaal in de 4 jaar rechtstreeks gekozen. De laatste verkiezingen voor de provinciale staten vonden plaats op 2 maart 2011. De volgende verkiezingen zijn op 18 maart 2015.', '2015-01-15 13:00:00', '2015-03-12 11:19:00', '2015-03-10 10:26:24', '2015-03-16 08:24:52', 1, '2015-03-11 11:45:00', '2015-03-12 14:00:00', 20, 'Paul Jurriens', 'pjurriens@novacollege.nl', 'Service Desk', 'Il3r7uC7t0.png', 1, 0),
(29, 14, 'Sylicon Valley: Alexander Klupping', '18/03 In de eerste aflevering vertelt Alexander over de bijzondere ontstaansgeschiedenis van Silicon Valley. Hij bezoekt historische plekken in het gebied zoals de prestigieuze Stanford University, de HP Garage (ook wel de kraamkamer van Silicon Valley genoemd) en de legendarische Homebrew Computer Club, waar beroemde Apple-pioniers als Steve Wozniak en Steve Jobs in de jaren ’70 en ’80 als hobbyisten ideeën uitwisselden. Alexander spreekt ook de oude hoogleraar van Google-oprichters Larry Page en Sergey Brin, die hen stimuleerde het idee van een mogelijke zoekmachine voor het internet verder uit te werken.', '2015-01-15 13:00:00', '2015-03-19 11:25:00', '2015-03-10 10:29:32', '2015-03-19 09:35:18', 1, '2015-03-18 10:45:00', '2015-03-18 14:00:00', 20, 'Paul & Andy', 'pjurriens@novacollege.nl', 'Servicepunt', 'Il3r7uC7t0.png', 1, 0),
(30, 14, 'Glasvezel', '25/03 In deze workshop zal Andy de theorie\nachter glasvezel bekabeling uitleggen.\n\nMet demonstratiemateriaal van Cofely\nen Conning kan je zelf alle aansluitingen en typen kabel bekijken.atacommunicatie.<br />', '2015-01-15 13:00:00', '2015-03-26 15:00:00', '2015-03-10 10:31:40', '2015-03-10 14:01:08', 1, '2015-03-25 10:45:00', '2015-03-25 14:00:00', 20, 'Andy Rekveld', 'arekveld@novacollege.nl', 'Servicepunt', 'Il3r7uC7t0.png', 1, 1),
(31, 14, 'Stageverslag', '1-04. Verslag van de stage in Spanje door Adam, Rory en Roy', '2015-01-15 13:00:00', '2015-04-02 09:22:00', '2015-03-16 08:30:44', '2015-03-16 10:22:07', 1, '2015-04-01 10:45:00', '2015-04-01 13:00:00', 20, 'Adam, Rory en Roy', 'pjurriens@novacollege.nl', 'Servicepunt', 'Il3r7uC7t0.png', 1, 1),
(32, 14, 'Microsoft IT Academy', '08-4. Microsoft certificering,\n\nMicrosoft IT Academy,\n\nMicrosoft Virtual Academy.', '2015-01-15 13:00:00', '2015-04-09 09:28:00', '2015-03-16 08:32:27', '2015-03-19 09:35:18', 1, '2015-04-08 10:45:00', '2015-04-08 13:00:00', 20, 'Paul Jurriens', 'pjurriens@novacollege.nl', 'Servicepunt', 'Il3r7uC7t0.png', 1, 1);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
