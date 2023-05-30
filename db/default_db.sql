-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: Mar 29, 2023 at 03:52 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinyou`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eid` int NOT NULL,
  `gid` int NOT NULL COMMENT 'FK auf Group',
  `mid` int NOT NULL COMMENT 'FK auf Movie',
  `owner` int NOT NULL COMMENT 'FK auf user id',
  `date` datetime NOT NULL,
  `price` float NOT NULL,
  `cinemare` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eid`, `gid`, `mid`, `owner`, `date`, `price`, `cinemare`, `create_at`, `updated_at`) VALUES
(1, 2, 804150, 1, '1970-01-01 00:00:00', 19.99, 'Helsinki', '2023-03-29 15:20:34', '2023-03-29 15:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `mid` int NOT NULL,
  `title` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `overview` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `poster_path` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `release_date` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vote_average` float DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mid`, `title`, `overview`, `poster_path`, `release_date`, `vote_average`, `create_at`, `updated_at`) VALUES
(76600, 'Avatar: The Way of Water', 'Spielt mehr als ein Jahrzehnt nach den Ereignissen des ersten Films und erzählt die Geschichte der Familie Sully (Jake, Neytiri und ihre Kinder), die Probleme, die sie verfolgen, die Mühen, die sie auf sich nehmen, um einander zu beschützen, die Kämpfe, die sie führen, um am Leben zu bleiben, und die Tragödien, die sie ertragen.', '/bb1J2UjJQ8GfutD5L4ktprw5wBS.jpg', '2022-12-14', 7.7, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(296271, 'The Devil Conspiracy', '', '/2lUYbD2C3XSuwqMUbDVDQuz9mqz.jpg', '2023-01-13', 6.4, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(315162, 'Der gestiefelte Kater: Der letzte Wunsch', 'Auch ein Kater kann ein unangenehmes Erwachen haben. Nach unzähligen riskanten Reisen und achtlosen Abenteuern muss der gestiefelte Kater entsetzt feststellen, dass seine Leidenschaft für Gefahren letztlich ihren Preis hatte – in seiner Abenteuerlust hat er bereits acht seiner neun Leben verbraucht. Um für die dringend nötige neue Vitalität zu sorgen, begibt sich der charmante Schnurrhaargauner auf den langen Weg in den Schwarzen Wald, um dort den mythischen Wunschstern zu finden.', '/kav9SgYBGE7ikJXO5ktlEILJYPI.jpg', '2022-12-07', 8.3, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(324552, 'John Wick: Kapitel 2', 'Nur noch das Auto zurückholen, dann will sich John Wick zurück in den Ruhestand verabschieden. Doch nachdem der Ex-Auftragskiller sein geliebtes Gefährt wieder und sich mit Abram geeinigt hat, dem Bruder seiner Nemesis Viggo Tarasov geht es für Wick erst richtig los. Wicks ehemaliger Kollege Santino steht vor der Tür und gibt ihm eine mit Blut besiegelte Münze. Wie der Einzelkämpfer weiß, steht das Geldstück für ein Versprechen, das Wick einst gab – das Versprechen von Hilfe als Gegenleistung für einen alten Gefallen. Und auch wenn der Killer seine Ruhe haben will, kann er schließlich nicht anders, als seine Zusicherung einzulösen, denn andernfalls droht ihm der Tod. Wick geht nach Rom, wo Santinos Schwester Gianna in die Riege der einflussreichsten Gangsterbosse kommen will...', '/7JvUTRGuuS6G15OVRCe7AKduTYP.jpg', '2017-02-08', 7.3, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(505642, 'Black Panther: Wakanda Forever', 'Der König ist tot! König T\'Challa, der als Black Panther auch Mitglied der Avengers-Heldentruppe war, stirbt an einer unbekannten Krankheit und ganz Wakanda ist in Trauer. Die Weltgemeinschaft sieht ihre Chance gekommen, um das vermeintlich geschwächte Königreich endlich zu Zugeständnissen bei der Lieferung des mächtigen Minerals Vibranium zu bewegen - und scheut dabei auch vor bewaffneten Überfällen nicht zurück. Doch Königin Ramonda bleibt standhaft und weist die Staatsoberhäupter in ihre Schranken. Wakanda wird auch ohne König T\'Challa und den Black Panther weiter existieren und nicht vor anderen Nationen buckeln. Zur selben Zeit haben die USA mithilfe der erst 19 Jahre alten MIT-Studentin Riri Williams ein Gerät zur Aufspürung von Vibranium entwickelt und werden auch auf dem Grund des Meeres fündig. Angeführt von König Namor, bereitet sich das unter dem Meer lebende Volk der Talokanil aus dem Königreich Talokan darauf vor, einen Krieg mit den Landbewohnern zu beginnen.', '/vo9QISNKYtDN40VKfQkPxbMOO9j.jpg', '2022-11-09', 7.3, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(594767, 'Shazam! Fury of the Gods', 'Billy Batson ist ein Teenager der etwas besonderen Art. Wenn er das Zauberwort „Shazam!“ sagt, verwandelt er sich in den Superhelden Shazam und wird zu seinem erwachsenen Alter-Ego. Doch nicht nur er hat ungewöhnliche Superkräfte, auch seine Pflegefamilie-Geschwister Freddy, Mary, Pedro, Eugene und Darla, von denen jeder andere Kräfte mitbringt, sind mit von der Partie. Als sie im Laufe der Zeit lernen, mit diesen Kräften umzugehen, folgt eine unheilvolle Konfrontation mit den Titanen-Töchtern Hespera, Kalypso und deren jüngerer Schwester, die im Auftrag des Titans Atlas der Erde einen Besuch abstatten und nichts Gutes verheißen. Billy wird sich fortan wappnen müssen, obwohl er gleichzeitig inmitten einer Sinnkrise steckt und von dem Glauben geplagt wird, den Superheldenstatus nicht zu verdienen.', '/iWY9o2CipruRD2Np8wuxpaVRy1l.jpg', '2023-03-15', 7, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(603692, 'John Wick: Kapitel 4', 'Der Auftragskiller John Wick setzt seinen Kampf gegen die \"Hohe Kammer\" fort, während das Kopfgeld auf ihn steigt. Er will die mächtigsten Spieler der Unterwelt ausfindig machen und reist von New York über Paris und Japan bis nach Berlin.', '/wHKeE6UsoYWDpdmkSXpUoFOPadW.jpg', '2023-03-22', 8.2, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(631842, 'Knock at the Cabin', 'Während eines Urlaubs in einer abgelegenen Hütte werden ein junges Mädchen und ihre Eltern von vier bewaffneten Fremden als Geiseln genommen, die von der Familie verlangen, eine undenkbare Entscheidung zu treffen, um die Apokalypse abzuwenden. Mit eingeschränktem Zugang zur Außenwelt muss die Familie entscheiden, was sie glaubt, bevor alles verloren ist.', '/yweX7Ykg39hlJYR7N2KCcaSiWmP.jpg', '2023-02-01', 6.4, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(646389, 'Plane', 'Nach einer heldenhaften Landung seines sturmbeschädigten Flugzeugs in einem Kriegsgebiet findet sich ein furchtloser Pilot zwischen den Agenden mehrerer Milizen wieder, die planen, das Flugzeug und seine Passagiere als Geiseln zu nehmen.', '/2JMsLDkl0JE3Bn4juJ8HcidglVe.jpg', '2023-01-12', 6.9, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(677179, 'Creed III: Rocky\'s Legacy', 'Nachdem Adonis Creed die Boxwelt dominiert hat, blüht er sowohl in seiner Karriere als auch in seinem Familienleben auf. Als sein Jugendfreund und ehemaliges Box-Wunderkind Damian nach einer langen Haftstrafe wieder auftaucht, will er beweisen, dass er eine Chance im Ring verdient hat. Das Aufeinandertreffen der ehemaligen Freunde ist mehr als nur ein Kampf. Um die Rechnung zu begleichen, muss Adonis seine Zukunft aufs Spiel setzen und gegen Damian antreten - einen Kämpfer, der nichts zu verlieren hat.', '/vJU3rXSP9hwUuLeq8IpfsJShLOk.jpg', '2023-03-01', 7.1, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(730629, 'John Wick: Kapitel 5', 'Nach den Vorfällen in dem vierten Teil Hagakure kommt John Wick ein weiteres Mal als schwarzer Mann zurück.', '/ndPy3KNHsbPQcoHU9RK92hSwEJ0.jpg', NULL, 0, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(804150, 'Cocaine Bear', '1985 stürzt ein randvoll mit Kokain beladenes Flugzeug irgendwo im Nirgendwo über den Wäldern Georgias ab. Sind die mehr als 200 Kilogramm Rauschgift und damit potenziell eine ganze Menge Geld also für immer verloren? Die Eigentümer, eine Handvoll Kriminelle, wollen es eher nicht darauf ankommen lassen und vor Ort lieber auf Nummer sicher gehen. Auf der Suche nach dem wertvollen Stoff merken sie jedoch, dass jemand anderes schneller als sie war. Denn fündig geworden ist nämlich ein riesiger Schwarzbär. Und der dreht nun völlig zugedröhnt am Rad. Touristen, ein paar Teenager, Polizisten und auch die Gangster passen auf Koks super in’s Beuteschema des monströsen Tieres. Jetzt heißt es nur noch eins: überleben und hoffen, dass die pelzige Kampfmaschine irgendwann von ihrem Trip runterkommt. Doch der Bär ist auf den Geschmack gekommen und will immer mehr von dem weißen Pulver.', '/gOnmaxHo0412UVr1QM5Nekv1xPi.jpg', '2023-02-22', 6.6, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(850871, 'Sayen', 'In den Wäldern im Süden Chiles macht sich Sayen auf die Suche nach den Mördern ihrer Großmutter, um sie zur Strecke zu bringen.  Sie muss sich entscheiden, ob sie lieber fliehen oder auch andere indigene Bevölkerungsgruppen vor dem bösartigen Konzern beschützen will, der ihr Land und ihre Lebensgrundlagen bedroht.', '/aCy61aU7BMG7SfhkaAaasS0KzUO.jpg', '2023-03-03', 6.2, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(884184, 'Consecration', '', '/txP5HTHAlwLV1ZieGKviCsnWhXS.jpg', '2023-02-09', 6.9, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(943822, 'Prizefighter', 'London im Jahre 1800: Der aus ärmlichen Verhältnissen stammende Faustkämpfer Jem Belcher schafft mithilfe seines Trainers Bill Warr den Aufstieg zum gefeierten Champion des neu entstehenden Boxsports. Für Jem eröffnet sich eine neue, luxuriöse Welt – bis zu einem tragischen Unfall, der ihn das linke Auge kostet. Der skrupellose Promoter Lord Rushworth lässt ihn fallen, und Jem fällt tief, er beginnt zu trinken und landet im Kerker. Doch mit Hilfe seines Coachs lernt Jem mühsam, mit eingeschränkter Sicht zu kämpfen, um sich einem gnadenlosen Titelkampf zu stellen.', '/4BbABYtaTWamLpSq4Z0klUGdKx0.jpg', '2022-06-30', 6.2, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(980078, 'Winnie the Pooh: Blood and Honey', '', '/ewF3IlGscc7FjgGEPcQvZsAsgAW.jpg', '2023-01-27', 5.9, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(1003579, 'Batman: The Doom That Came to Gotham', '', '/hrATQE8ScQceohwInaMluluNEaf.jpg', '2023-03-10', 6.4, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(1011679, 'Shark Side of the Moon', '', '/v5CfpzxoJDkZxjZAizClFdlEF0U.jpg', '2022-08-12', 5.3, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(1077280, 'Die Hart', 'Kevin Hart verfolgt mit Nachdruck sein persönliches Ziel, die Rolle seines Lebens zu bekommen - als großer Star eines gewaltigen Actionblockbusters. Doch sein Anliegen wird vom Studio ohne mit der Wimper zu zucken kurzerhand abgeschmettert und seine Träume scheinen von einem Augenblick auf den anderen zu zerbrechen. Direkt nach dieser schmerzhaften Nachricht begegnet er durch puren Zufall gleich mehrmals einem der größten gegenwärtigen Action-Stars. Dieses schicksalhafte Aufeinandertreffen ist der Startpunkt einer skurrilen Ereigniskette, die Hart dazu zwingt, sich durch eine Kaskade von wahnwitzigen und von irrer Action dominierten Situationen zu kämpfen. Ein Glück, dass ihm gleich eine ganze Reihe an namenhaften Hollywoodgrößen aus dem Action-Genre mit helfender Hand zur Seite steht.', '/1EnBjTJ5utgT1OXYBZ8YwByRCzP.jpg', '2023-02-22', 6.2, '2023-03-29 15:42:44', '2023-03-29 15:42:44'),
(1087040, 'Money Shot: The Pornhub Story', 'Pornhub veränderte die Art und Weise, wie pornografische Inhalte erstellt und verbreitet werden, von Grund auf. Die berühmteste Internetplattform für Erwachsenenunterhaltung ermöglichte es Anbietern erotischer Inhalte, ein viel größeres Publikum zu erreichen, und machte damit Milliarden. Dem Unternehmen wurde jedoch vorgeworfen, nicht einvernehmliches Material zu verbreiten und den Menschenhandel zu fördern. Kann der Onlineriese angesichts des Gerechtigkeitskampfes der Organisationen, die sich gegen den Menschenhandel einsetzen, jene beschützen, die zum Profit des Unternehmens beitragen? Oder handelt es sich um eine neue Welle der Zensur für Darsteller*innen einvernehmlicher Pornografie?', '/kUWTY8rwEZ3d8G31GuPMbvqS67D.jpg', '2023-03-15', 5.9, '2023-03-29 15:42:44', '2023-03-29 15:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `newsletter` tinyint DEFAULT '1' COMMENT 'is set if the user wants mails',
  `token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'for validation purpose',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`, `is_admin`,  `newsletter`, `token`, `created_at`, `updated_at`) VALUES
(1, 'default_user', 'default@user.com', '$2y$10$FxmXMxJnRidoOMO5vRqwNOs4mjxUoSOwhrG8Wgbm1978pDucKFGpK', 0, 1, NULL, '2023-03-29 15:11:25', '2023-03-29 15:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_events`
--

CREATE TABLE `user_events` (
  `eid` int NOT NULL COMMENT 'FK auf events',
  `uid` int NOT NULL COMMENT 'FK auf user',
  `external` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ad` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_events`
--

INSERT INTO `user_events` (`eid`, `uid`, `external`, `created_at`, `updated_ad`) VALUES
(1, 1, 0, '2023-03-29 15:20:34', '2023-03-29 15:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `uid` int NOT NULL,
  `gid` int NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`uid`, `gid`, `joined_at`) VALUES
(1, 2, '2023-03-29 15:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `web_group`
--

CREATE TABLE `web_group` (
  `gid` int NOT NULL,
  `groupname` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin` int NOT NULL COMMENT 'Fremdschluesel auf ein user (UID)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `web_group`
--

INSERT INTO `web_group` (`gid`, `groupname`, `created_at`, `updated_at`, `admin`) VALUES
(2, 'default_group', '2023-03-29 15:12:14', '2023-03-29 15:12:14', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_events`
--
ALTER TABLE `user_events`
  ADD PRIMARY KEY (`eid`,`uid`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`uid`,`gid`);

--
-- Indexes for table `web_group`
--
ALTER TABLE `web_group`
  ADD PRIMARY KEY (`gid`),
  ADD UNIQUE KEY `groupname` (`groupname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `mid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1087041;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_group`
--
ALTER TABLE `web_group`
  MODIFY `gid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
