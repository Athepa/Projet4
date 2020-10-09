-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 09 oct. 2020 à 11:46
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blogdatabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `idAuthor` int(11) NOT NULL AUTO_INCREMENT,
  `loginAuthor` varchar(255) NOT NULL,
  `authorFirstName` varchar(255) NOT NULL,
  `authorName` varchar(255) NOT NULL,
  `passWord` varchar(30) NOT NULL,
  PRIMARY KEY (`idAuthor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`idAuthor`, `loginAuthor`, `authorFirstName`, `authorName`, `passWord`) VALUES
(1, 'themarshall', 'Thed', 'Marshall', 'TotoEstGénial_25');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idPost` int(11) NOT NULL,
  `pseudoUser` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `commentText` text NOT NULL,
  PRIMARY KEY (`idComment`),
  KEY `idPost` (`idPost`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`idComment`, `idPost`, `pseudoUser`, `creationDate`, `commentText`) VALUES
(1, 1, 'Toto', '2020-08-28 15:47:22', 'C\'est très intéressant comme concept!!!'),
(2, 1, 'Caliméro', '2020-10-02 13:41:23', 'C\'est pas juste!'),
(3, 2, 'Marty', '2020-10-09 11:18:59', 'Super génial!'),
(4, 2, 'Caton', '2020-10-09 11:21:39', 'Carthago delenda est!');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `idAuthor` int(11) NOT NULL,
  `titlePost` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `textPost` text NOT NULL,
  PRIMARY KEY (`idPost`),
  KEY `idAuthor` (`idAuthor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`idPost`, `idAuthor`, `titlePost`, `creationDate`, `textPost`) VALUES
(1, 1, 'Quo cognito Constantius', '2020-08-28 15:45:17', 'Et est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.\r\n\r\nHacque adfabilitate confisus cum eadem postridie feceris, ut incognitus haerebis et repentinus, hortatore illo hesterno clientes numerando, qui sis vel unde venias diutius ambigente agnitus vero tandem et adscitus in amicitiam si te salutandi adsiduitati dederis triennio indiscretus et per tot dierum defueris tempus, reverteris ad paria perferenda, nec ubi esses interrogatus et quo tandem miser discesseris, aetatem omnem frustra in stipite conteres summittendo.'),
(2, 1, 'Casu conati cohortium robur robur', '2020-09-29 20:10:00', 'Quid enim tam absurdum quam delectari multis inanimis rebus, ut honore, ut gloria, ut aedificio, ut vestitu cultuque corporis, animante virtute praedito, eo qui vel amare vel, ut ita dicam, redamare possit, non admodum delectari? Nihil est enim remuneratione benevolentiae, nihil vicissitudine studiorum officiorumque iucundius.\r\n\r\nNec sane haec sola pernicies orientem diversis cladibus adfligebat. Namque et Isauri, quibus est usitatum saepe pacari saepeque inopinis excursibus cuncta miscere, ex latrociniis occultis et raris, alente inpunitate adulescentem in peius audaciam ad bella gravia proruperunt, diu quidem perduelles spiritus inrequietis motibus erigentes, hac tamen indignitate perciti vehementer, ut iactitabant, quod eorum capiti quidam consortes apud Iconium Pisidiae oppidum in amphitheatrali spectaculo feris praedatricibus obiecti sunt praeter morem.\r\n\r\nPost hoc impie perpetratum quod in aliis quoque iam timebatur, tamquam licentia crudelitati indulta per suspicionum nebulas aestimati quidam noxii damnabantur. quorum pars necati, alii puniti bonorum multatione actique laribus suis extorres nullo sibi relicto praeter querelas et lacrimas, stipe conlaticia victitabant, et civili iustoque imperio ad voluntatem converso cruentam, claudebantur opulentae domus et clarae.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`idAuthor`) REFERENCES `author` (`idAuthor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
