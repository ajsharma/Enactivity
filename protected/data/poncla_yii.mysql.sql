-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2010 at 03:55 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poncla_yii`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `creatorId` int(11) DEFAULT NULL,
  `groupId` int(11) NOT NULL,
  `starts` datetime NOT NULL,
  `ends` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creatorId` (`creatorId`),
  KEY `groupId` (`groupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `description`, `creatorId`, `groupId`, `starts`, `ends`, `location`, `created`, `modified`) VALUES
(2, 'Alpha Phi Omega Founder''s 71st Day', 'Superman in town', 1, 6, '2011-10-13 18:00:01', '2011-11-16 18:00:01', 'Metropolis', '2010-10-16 20:32:21', '2010-11-21 15:42:57'),
(3, 'Another Testable Event', 'Just some filler for the awesomeness.', 1, 7, '2011-10-16 18:00:01', '2011-11-16 18:00:01', '', '2010-10-24 15:50:16', '2010-10-24 15:50:16'),
(4, 'Old Event', 'This event has expired', 1, 5, '2009-10-16 18:00:01', '2009-11-16 18:00:04', 'Back in time!', '2009-10-31 15:25:48', '2009-10-31 15:25:48'),
(5, 'Who likes to write code?', 'I do!', 25, 5, '2011-10-16 18:00:01', '2010-11-16 18:00:04', 'Any where that has a computer and an internet connection and some sort of thingy for writing code, like a printer.', '2010-11-07 17:04:06', '2010-11-07 17:04:06'),
(6, 'Another event yo', 'Needed more events', 1, 5, '2011-10-16 18:00:01', '2010-11-16 18:00:04', 'Any where that has a computer and an internet connection and some sort of thingy for writing code, like a printer.', '2010-11-21 15:05:28', '2010-11-21 15:05:28'),
(7, 'Proin leo odio, aliquam vitae semper non, tempus sed risus. In hac volutpat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend fermentum tortor nec lacinia. Mauris justo odio, posuere sit amet molestie in, vehicula sed nibh. \r\n\r\nSuspendisse porta nulla sagittis nisi lacinia a scelerisque metus iaculis. Vivamus eu massa gravida urna ultrices bibendum adipiscing ut purus. Ut vehicula placerat mi et euismod. Quisque pretium, leo in ullamcorper luctus, tortor sapien scelerisque risus, a ullamcorper mi ipsum quis sem. Nulla ac eros ipsum. Duis tincidunt tortor et diam tristique a commodo felis tempor. Nam bibendum sagittis tellus vitae tempor. Suspendisse ac turpis sed metus commodo consectetur in a nisi. Nulla vitae leo ac justo consectetur gravida. Maecenas placerat lobortis felis, quis tempus lectus viverra sit amet. Praesent nunc magna, commodo sit amet pulvinar quis, fringilla nec mi.  Quisque quis ipsum diam, nec pulvinar nisl. Cras in est est, et blandit massa. Morbi vitae turpis egestas mi consectetur vulputate. Morbi aliquam aliquam est, sed rutrum metus sollicitudin non. Nullam aliquet augue quis nibh malesuada et facilisis nisl pulvinar. Nunc mollis, quam ut commodo tempus, eros risus aliquam mi, nec fringilla diam felis et urna. Quisque risus ante, vestibulum eu dictum ut, tristique accumsan velit. In consectetur neque id nunc euismod feugiat. Duis eget tortor nunc. Suspendisse hendrerit lobortis consequat. Fusce eu dolor urna, quis rhoncus massa. Maecenas purus sapien, luctus ac vulputate nec, convallis at magna.  In luctus feugiat dolor, vel dictum ante sagittis non. Cras eu felis libero, vel elementum justo. Vivamus neque tellus, feugiat eu gravida bibendum, porttitor nec dolor. Suspendisse sit amet nisl nec diam pharetra volutpat. Proin lacinia, dui non vehicula porta, tellus libero aliquet tortor, at aliquet turpis odio non lacus. Cras consequat ornare nisi, eu dignissim augue ultricies ac. Ut cursus feugiat diam, ut pulvinar augue sagittis id. Etiam eleifend, libero posuere lobortis rhoncus, mauris diam adipiscing massa, quis tempor odio quam a leo. Cras purus justo, pharetra quis ultricies sit amet, pellentesque eu nisi. Vestibulum massa dolor, sagittis euismod venenatis ac, consectetur ac enim. Donec facilisis sem eget est porttitor sed dictum nisi sollicitudin. Nunc eu sapien eget elit elementum sollicitudin id laoreet velit. Nullam ullamcorper rutrum fringilla. Phasellus ante ipsum, aliquam sed molestie ut, lacinia ac felis. Quisque condimentum, nulla nec tempor accumsan, arcu metus sagittis urna, faucibus fringilla lorem orci et nisi. Cras ante ante, lacinia ullamcorper iaculis in, laoreet a erat. Vivamus vestibulum fringilla mollis.  Praesent dictum fermentum vestibulum. Vestibulum pretium erat sit amet sem molestie a viverra orci posuere. Fusce facilisis pulvinar gravida. Vivamus auctor gravida tincidunt. Proin hendrerit volutpat malesuada. Quisque volutpat, nisi eu pellentesque pharetra, ipsum ipsum faucibus felis, tristique tristique lacus quam ac turpis. Praesent laoreet suscipit enim quis sollicitudin. Nunc molestie augue nec massa congue lacinia. Nulla ut leo lacus, non sodales nulla. Nullam id vehicula tellus. Sed at nisl nec nisl feugiat rhoncus eu ut nisi. Etiam dui mi, eleifend in bibendum nec, pretium ut ipsum.  Donec ultrices gravida dui, et ornare dolor consequat et. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas pretium tellus id purus rutrum et mollis ipsum hendrerit. In eget elit vel urna ullamcorper semper. Donec auctor arcu ac felis consequat cursus. Aliquam erat volutpat. Vivamus accumsan massa nec urna bibendum eleifend. Aliquam quis vestibulum turpis. Suspendisse sed tellus non dui luctus fringilla. Mauris fringilla diam eu orci malesuada viverra. Suspendisse ac ipsum et magna tempor lacinia id non purus. Quisque in nibh et quam imperdiet venenatis. \r\n\r\nUt sit amet elit est, vitae gravida magna. Fusce adipiscing, neque id dapibus tincidunt, sem augue porta enim, at pulvinar massa tellus ac', 1, 6, '2011-07-11 18:00:00', '2011-11-16 19:00:00', 'Lorem ipsum dolor sit amet, _consectet_ adipiscing elit. Morbi *digniss*, lectus vel bibendum porttitor, magna mauris tempus turpis, ac ornare nunc eros at est. Phasellus ullamcorper libero ut justo mattis semper. Sed faucibus viverra ultrices massa nunc.', '2010-11-21 15:07:13', '2010-12-07 23:20:10'),
(8, 'Gonna drop some sweet YouTube up in this thing', 'You tooooooooooooob!!\r\n\r\n<object width="480" height="385"><param name="movie" value="http://www.youtube.com/v/lBw1qqDyWVQ?fs=1&amp;hl=en_US"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/lBw1qqDyWVQ?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object>', 1, 5, '2011-11-16 18:00:01', '2011-11-19 18:00:01', '', '2010-11-28 13:42:41', '2010-11-28 13:42:41'),
(9, 'Northside Community Center - Serving Lunch to Seniors', 'Serving lunch to seniors for the Nutrition Program which include: preparation; kitchen aid (3 volunteers) and Serving (7 volunteers); clean-up; and talking and dancing with seniors (great opportunity for nursing students and other related majors). \r\nAll volunteers will help with preparation and clean-up. ', 1, 5, '2011-01-13 11:00:01', '2011-01-13 13:00:01', 'Northside Community Center', '2010-12-02 22:20:49', '2010-12-02 22:20:54'),
(10, 'Test with Date Picker', '', 1, 5, '2010-12-09 00:00:00', '2010-12-12 15:40:00', '', '2010-12-05 14:39:08', '2010-12-05 15:57:04'),
(11, 'Testing events', '', 1, 5, '2010-12-07 00:00:00', '2010-12-07 16:41:00', '', '2010-12-07 00:45:02', '2010-12-07 00:45:02'),
(12, 'Superlongeventnameeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'Loremipsumdolorsitamet,consecteturadipiscingelit.Donecrutrumnislinnisitinciduntfeugiat.Fuscemaurislectus,mollisneceuismodeu,volutpatetneque.Aliquamegetjustoelit.Aeneanlacusmi,hendreritsodalesplaceratac,sodalesasem.Sedvenenatisgravidaest.Praesentsemperfermentumleofermentumsollicitudin.Aliquameratvolutpat.Curabitursemperdolorvelnisleuismodacaccumsanlectusfermentum.Proincondimentum,semegetvestibulumcursus,esttortorconvallisurna,sedsemperduiligulaegetmauris.Fuscevenenatisnuncetnisihendrerittempor.VestibulumanteipsumprimisinfaucibusorciluctusetultricesposuerecubiliaCurae;Quisquelobortissapienacnunccursusnecbibendumloremvestibulum.Proinsitametimperdietmagna.Sedrisusipsum,laoreetnecelementumid,posuereultricieserat.Utetmetusametuseleifendornare.Donecquamtortor,egestassitametvehiculaeget,venenatisnectortor.Proindignissimpharetraaliquam.Vivamusaeliterat.Nullamornareelementumnunc,velcongueloremlobortisvitae.Doneceunequeatdolorporttitortincidunt.Pellentesquemalesuadaipsumaeratsodalespretium.Vestibulumpulvinartempusvehicula.Vivamusporttitornisldictumdolortemporvitaemollisurnacommodo.Morbiimperdietmisitametdolorcondimentumsitametconguenibhaccumsan.Duisdictumconvallistellusavestibulum.Aliquamsitametipsumaelitrhoncusporttitor.Aliquamsitametmiquisloremviverramollissedsedsapien.Insitametnisilacus,fermentumvehiculanulla.Vivamuseunullalectus.Maecenassednibhatestaliquamluctus.Curabiturtristiquepellentesquerisus,sedtempusdiamrutrumsed.Phasellusmalesuadamolestieduisedultrices.Duissagittis,nislbibendumpretiumtincidunt,massamassavulputateligula,vitaevulputatenibhtortorvitaemi.Aliquamligulaodio,luctusvitaerutrumeget,auctornecquam.Integerviverraquamvelsemeleifendscelerisque.Phasellusvehicula,eratvitaefringillafermentum,orcinisimollisleo,utluctuseratarcuidrisus.Morbialiqueturnanonleosodalesvitaeimperdiettortorconvallis.Maurisviverramagnaacmassadignissimetornaremetusullamcorper.Loremipsumdolorsitamet,consecteturadipiscingelit.Donecconsequatlectusutdiamaliquamtempus.Vivamusornareeratetipsumaccumsanquisinterdumenimfacilisis.Aeneannonquamquisipsumtemporblandit.Nullavehiculaleoatquamultricesetultriciesmagnasollicitudin.Praesentviverraipsumsapien,ettinciduntnibh.Insedlacuslacus.Quisquerhoncusplaceratbibendum.Sedfaucibusliberononnuncaccumsansedrutrumauguedignissim.Ininnisimi,eutempusneque.Donecveliaculismi.Quisquevenenatissuscipitmassa,necvolutpatvelitsagittisvel.Inacsapienligula,etcommodoelit.Quisqueviverra,erosnecmollissagittis,leonunccondimentumligula,velluctuserosauguerhoncuslorem.Nuncnisierat,dignissimeulaoreeteu,viverravitaeest.Namidduiurna,sedfeugiatjusto.Sedultriciesliberoinligulamolestienonelementummaurislacinia.Integereleifendinterdumlacus,idconsecteturmetuslobortisnec.Loremipsumdolorsitamet,consecteturadipiscingelit.Proinfringillafeugiatvolutpat.Etiametanteenim,sitametportasem.Sedscelerisquetellusveldiamconsecteturtempor.Integeranullaquisrisusconguedignissim.Donecmagnanunc,iaculisnonelementumid,sodalesatvelit.Donecindolortortor,atmalesuadaleo.Morbivehiculaerateusapienportaposuere.Namidtortororci,egettincidunterat.Etiamvestibulumporttitortempor.Nameuligularisus.Fuscetinciduntaliquamlorem,sitametultriciesturpisconsequatvitae.Cumsociisnatoquepenatibusetmagnisdisparturientmontes,nasceturridiculusmus.Curabituratantedolor.Aeneanleosem,ornareeuvenenatisquis,aliquetidmetus.Vivamusinterdum,doloracconvallispretium,puruseratmollislectus,inelementumanteenimnecante.Maurisvolutpat.', 1, 5, '2010-12-29 10:22:00', '2010-12-30 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum nisl in nisi tincidunt feugiat. Fusce mauris lectus, mollis nec euismod eu, volutpat et neque. Aliquam eget justo elit. Aenean lacus mi, hendrerit sodales placerat ac, sodales a sem. Se', '2010-12-07 21:33:53', '2010-12-07 21:48:07'),
(13, 'New Year''s Day', '', 1, 5, '2011-01-01 00:00:00', '2011-01-02 00:00:00', '', '2010-12-11 19:48:53', '2010-12-11 19:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `event_user`
--

CREATE TABLE IF NOT EXISTS `event_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `eventId_2` (`eventId`,`userId`),
  KEY `eventId` (`eventId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `event_user`
--

INSERT INTO `event_user` (`id`, `eventId`, `userId`, `status`, `created`, `modified`) VALUES
(11, 2, 1, 'Not Attending', '2010-11-06 19:51:00', '2010-12-05 19:16:09'),
(14, 5, 25, 'Attending', '2010-11-07 17:31:06', '2010-11-07 17:31:12'),
(15, 7, 1, 'Attending', '2010-11-28 14:17:52', '2010-12-05 19:15:46'),
(16, 9, 1, 'Not Attending', '2010-12-07 23:22:10', '2010-12-07 23:26:36'),
(17, 8, 1, 'Attending', '2010-12-08 23:30:34', '2010-12-08 23:30:34'),
(18, 10, 1, 'Not Attending', '2010-12-08 23:32:17', '2010-12-12 12:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `slug`, `created`, `modified`) VALUES
(5, 'Alpha Phi Omega - Zeta', 'apo-zeta', '0000-00-00 00:00:00', '2010-12-18 15:52:01'),
(6, 'Alpha Phi Omega - Gamma Beta', 'apogb', '0000-00-00 00:00:00', '2010-10-16 22:32:40'),
(7, 'Alpha Phi Omega - Alpha Gamma Nu', 'apo-agn', '2010-10-16 18:00:01', '2010-10-16 18:00:01'),
(8, 'Poncla', 'poncla', '2010-12-18 14:05:51', '2010-12-18 14:05:51'),
(9, 'testgroup7', 'test7', '2010-12-18 15:33:13', '2010-12-18 15:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `group_profile`
--

CREATE TABLE IF NOT EXISTS `group_profile` (
  `groupId` int(11) NOT NULL,
  `description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_profile`
--

INSERT INTO `group_profile` (`groupId`, `description`) VALUES
(5, 'About Us\r\n\r\nAlpha Phi Omega National Service Fraternity is an inclusive, coed, college-based organization with active chapters on over 350+ campuses across the United States. Members provide service to their communities and youth, the nation, their campuses, and each other. The organization is staffed by volunteers at all levels, including governance, advising, and program delivery.\r\n\r\nIn Alpha Phi Omega’s 75+ years of existence, more than 310,000 college men and women have dedicated themselves to the fraternity’s three cardinal principles: Leadership , Friendship and Service.\r\n\r\nOur chapter at San Jose State University strives to improve and grow by re-evaluating our goals and objectives after every college semester. Come and stay awhile to read about who we are and what we are about. If you have any comments or questions for us about the fraternity, chapter operations, or the website, please feel free to contact us.\r\n\r\nDeveloping Leadership, Promoting Friendship, and Providing Service\r\n\r\nRealistically, leadership is a matter of development. Alpha Phi Omega develops leaders, and we are very proud of that. As we grow, we seek qualities of leadership, and throughout our lives, we pursue the development of those qualities and the development of other ‘well-rounding’ qualities. Through our leadership development program in Alpha Phi Omega, we are able to develop ourselves. And, as we aspire to greater things in life, we become aware of limiting factors - which we can’t control, the external forces that shape our destiny until we control and develop what we have inside of us. We discover our own talents and strive to better our skills. We study, we learn, we practice.\r\n\r\nBrotherhood is the spirit of friendship. It implies respect, honesty and dependability. It means that we overlook differences and emphasize similarities as we join together in unselfish service. It means listening to Brothers whose views on issues might differ from our own. It means working closely with people whom under other circumstances we might not choose as our friends.\r\n\r\nOur Chapter service program provides many opportunities for the development of social awareness, friendships and leadership skills. Participation in our service program helps make Alpha Phi Omega the unique fraternal organization that it is.'),
(6, 'Gaaaaamma Beeeeeetaaa clap clap - clap clap clap'),
(7, NULL),
(8, NULL),
(9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE IF NOT EXISTS `group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groupId_2` (`groupId`,`userId`),
  KEY `groupId` (`groupId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`id`, `groupId`, `userId`, `status`, `created`, `modified`) VALUES
(1, 6, 1, 'Active', NULL, NULL),
(2, 5, 1, 'Active', '2010-10-17 13:31:51', '2010-10-17 13:31:51'),
(4, 5, 4, 'Active', '2010-10-17 13:52:35', '2010-10-17 13:52:35'),
(5, 5, 16, 'Pending', '2010-10-17 14:30:19', '2010-10-17 14:30:19'),
(6, 6, 4, 'Pending', '2010-10-17 14:52:55', '2010-10-17 14:52:55'),
(7, 5, 14, 'Pending', '2010-10-17 14:54:42', '2010-10-17 14:54:42'),
(9, 5, 25, 'Pending', '2010-10-17 14:55:25', '2010-10-17 14:55:25'),
(10, 5, 38, 'Active', '2010-12-05 18:30:06', '2010-12-05 18:30:06'),
(11, 5, 37, 'Active', '2010-12-05 18:42:38', '2010-12-05 18:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(40) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `token`, `password`, `firstName`, `lastName`, `status`, `created`, `modified`, `lastLogin`) VALUES
(1, 'admin', 'admin@poncla.com', '5d7f3e28571af8824a910e81996f409b8a6f5bd9', 'ac3642003276203b8ad9ceb60856fd9f7c3c286c', 'Poncla', 'Administrator', 'Active', '2010-10-10 00:00:00', '2010-12-12 16:18:37', NULL),
(4, 'tester', 'test@poncla.com', '0865818293977c11289e0e0c33ccae70035399c3', '1800b237666e34ff1ab4e09d7343db2365d2ef23', 'Veronica', 'Jones', 'Active', '2010-10-16 18:07:59', '2010-12-12 17:37:21', NULL),
(6, NULL, 'test7@poncla.com', '3026c7aba32f8ef1bc234f7e8d4ab932008e4ec4', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:10:27', '2010-10-16 23:10:27', NULL),
(7, NULL, 'test8@poncla.com', '736ee60eac821167231de24ba04b6a775ef9bb36', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:10:44', '2010-10-16 23:10:44', NULL),
(14, NULL, 'test53@test.com', '8f8f2c17877ff581aa1db54ec3ca2b462937e9f2', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:43:16', '2010-10-16 23:43:16', NULL),
(15, NULL, 'test54@test.com', '50f255c3b18883fab1f9a7f97bf607dd8f3844aa', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:48:07', '2010-10-16 23:48:07', NULL),
(16, NULL, 'test55@test.com', '0e6030361256e442e4fdf252acfb4ce3ebf9d699', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:50:06', '2010-10-16 23:50:06', NULL),
(17, NULL, 'test57@test.com', 'ba90d97b00b74b1b16683b88cb3395afac38ef59', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:50:41', '2010-10-16 23:50:41', NULL),
(18, NULL, 'test58@test.com', 'f3160d5c35b54941071cf4c1e76378199bfdf8af', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:51:26', '2010-10-16 23:51:26', NULL),
(19, NULL, 'test52@test.com', '3f485c72d9d18709747932ca8328bfdf4d351d21', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:52:32', '2010-10-16 23:52:32', NULL),
(20, NULL, 'test56@test.com', '148f68fd4c09780c8a5f7e2cbae5e4f99f5e6b04', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-16 23:59:13', '2010-10-16 23:59:13', NULL),
(21, NULL, 'test68@test.com', '0af9af731a7254ef16914c9bebe1147ed07b50ef', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-17 00:11:10', '2010-10-17 00:11:10', NULL),
(22, NULL, 'test88@test.com', '9900327df5cfa9f4c0482482a171df0b0945311f', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-17 00:16:11', '2010-10-17 00:16:11', NULL),
(23, NULL, 'test98@test.com', '35c5e4a1d0d9e6ba791c478fb2b7f704f1a9abd4', '05a9beae965ac78613309639f774eb92c10cb017', NULL, NULL, 'Pending', '2010-10-17 00:22:14', '2010-10-17 00:22:14', NULL),
(25, 'joethesmo', 'newuser@poncla.com', '15739124e6aa9f603e5ca46a9b7ef2ff9ca160d0', '9e5ee4077d11e2212d24f2c127399c5099fef578', 'Joe', 'Smo', 'Active', '2010-10-17 14:55:25', '2010-11-07 14:39:48', NULL),
(35, NULL, 'ajsharma@poncla.com', '597ca79dcf019d90cac300e71f2bd4c5426cdf9c', NULL, NULL, NULL, 'Pending', '2010-11-07 14:56:29', '2010-11-07 14:56:29', NULL),
(36, NULL, 'ajsharma@localhost.com', '7485382ac9c667fadf9f6e7fc61485dfbe5e6ac6', NULL, NULL, NULL, 'Pending', '2010-11-07 14:58:02', '2010-11-07 14:58:02', NULL),
(37, NULL, 'ajsharma+test1@poncla.com', 'c2784be4a9fbf06a4cc8ca9cb0588fd22f39a5ab', NULL, NULL, NULL, 'Pending', '2010-12-05 18:24:32', '2010-12-05 18:24:32', NULL),
(38, NULL, 'ajsharma+test3@poncla.com', '5d1243b49044d61d315c54ef20570ab8716a1512', NULL, NULL, NULL, 'Pending', '2010-12-05 18:28:32', '2010-12-05 18:28:32', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`creatorId`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `event_ibfk_4` FOREIGN KEY (`groupId`) REFERENCES `group` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_ibfk_3` FOREIGN KEY (`eventId`) REFERENCES `event` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `event_user_ibfk_4` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `group_profile`
--
ALTER TABLE `group_profile`
  ADD CONSTRAINT `group_profile_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `group` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `group` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `group_user_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
