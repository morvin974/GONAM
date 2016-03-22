-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Mars 2016 à 19:22
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `eboutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `page` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`page`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `access`
--

INSERT INTO `access` (`page`, `level`) VALUES
('access', 50),
('admin', 10),
('article/add', 50),
('article/addSelect', 50),
('article/addStock', 50),
('article/admin', 50),
('article/afficherModifier', 50),
('article/modifierArticle', 50),
('categorie', 50),
('comment/modifierComment', 10),
('comment/supprimerComment', 10),
('delivery', 50),
('firm', 50),
('groups', 50),
('users', 50);

-- --------------------------------------------------------

--
-- Structure de la table `add_in_cart`
--

CREATE TABLE IF NOT EXISTS `add_in_cart` (
  `quantity` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  PRIMARY KEY (`id_article`,`id_cart`),
  KEY `FK_add_in_cart_id_cart` (`id_cart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `add_in_cart`
--

INSERT INTO `add_in_cart` (`quantity`, `id_article`, `id_cart`) VALUES
(1, 1, 15),
(1, 1, 17),
(2, 1, 21),
(2, 1, 22),
(1, 1, 23),
(1, 1, 24),
(1, 1, 25);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `article_brand` varchar(32) DEFAULT NULL,
  `article_description` text,
  `article_photo` varchar(128) DEFAULT NULL,
  `article_price_dutyfree` decimal(25,2) NOT NULL,
  `article_stock` decimal(5,2) NOT NULL,
  `article_title` varchar(64) NOT NULL,
  `article_weight` decimal(5,2) DEFAULT NULL,
  `article_date` date DEFAULT NULL,
  `article_sold` decimal(5,2) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `FK_article_id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id_article`, `article_brand`, `article_description`, `article_photo`, `article_price_dutyfree`, `article_stock`, `article_title`, `article_weight`, `article_date`, `article_sold`, `id_category`) VALUES
(1, 'Asus', 'Carte mere de la mort', 'public/imgs/thumb.png', '250.50', '6.00', 'Carte mere150-E', '12.00', '2015-01-25', '4.00', 1),
(2, 'Asus', 'Elle date un peu', 'public/imgs/thumb.png', '1.00', '10.00', 'Asus M78', '900.00', '2015-01-25', '0.00', 1),
(3, 'Apple', 'Processeur bas de gamme', 'public/imgs/thumb.png', '50.60', '0.00', 'Processeur 15-D', '50.50', '2015-01-25', '0.00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `cart_price_HT` decimal(20,2) NOT NULL,
  `actif` tinyint(1) DEFAULT NULL,
  `id_delivery` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cart`),
  KEY `FK_cart_id_delivery` (`id_delivery`),
  KEY `FK_cart_id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `cart`
--

INSERT INTO `cart` (`id_cart`, `cart_price_HT`, `actif`, `id_delivery`, `id_user`) VALUES
(14, '0.00', 1, 1, 5),
(15, '250.50', 0, 3, 6),
(16, '0.00', 1, 1, 7),
(17, '250.50', 0, 1, 6),
(18, '0.00', 1, 1, 6),
(19, '0.00', 1, 1, NULL),
(20, '0.00', 1, 1, 8),
(21, '501.00', 0, 2, 9),
(22, '501.00', 1, 1, 9),
(23, '0.00', 1, 1, NULL),
(24, '0.00', 1, 1, NULL),
(25, '0.00', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(64) DEFAULT NULL,
  `category_description` text,
  `id_category_mother` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_category`),
  KEY `FK_category_id_category_mother` (`id_category_mother`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id_category`, `category_name`, `category_description`, `id_category_mother`) VALUES
(1, 'Carte mère', 'Motherboard', NULL),
(2, 'Processeur', 'CPU', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id_notice` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_notice`,`id_article`,`id_user`),
  KEY `FK_comment_id_article` (`id_article`),
  KEY `FK_comment_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id_notice`, `id_article`, `id_user`) VALUES
(3, 1, 6),
(4, 2, 6),
(5, 3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `id_delivery` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_name` varchar(25) NOT NULL,
  `delivery_price` double NOT NULL,
  PRIMARY KEY (`id_delivery`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `delivery`
--

INSERT INTO `delivery` (`id_delivery`, `delivery_name`, `delivery_price`) VALUES
(1, 'La poste', 1.5),
(2, 'UPS', 5.9),
(3, 'Colissimo', 2.9);

-- --------------------------------------------------------

--
-- Structure de la table `firm`
--

CREATE TABLE IF NOT EXISTS `firm` (
  `id_firm` int(11) NOT NULL AUTO_INCREMENT,
  `firm_name` varchar(64) NOT NULL,
  `firm_description` text,
  `firm_address` text NOT NULL,
  `firm_city` varchar(64) NOT NULL,
  `firm_postcode` varchar(8) DEFAULT NULL,
  `firm_phone` varchar(13) NOT NULL,
  `firm_fax` varchar(13) NOT NULL,
  `firm_mail` varchar(128) NOT NULL,
  PRIMARY KEY (`id_firm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `firm`
--

INSERT INTO `firm` (`id_firm`, `firm_name`, `firm_description`, `firm_address`, `firm_city`, `firm_postcode`, `firm_phone`, `firm_fax`, `firm_mail`) VALUES
(1, 'GONAM', 'Best of the world', '140 rue Nouvelle France', 'Montreuil', '93100', '0161290754', '0161290754', 'gonam@gonam.com');

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) DEFAULT NULL,
  `group_privileges` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `group`
--

INSERT INTO `group` (`id_group`, `group_name`, `group_privileges`) VALUES
(1, 'Client', 1),
(2, 'Administrateur', 50);

-- --------------------------------------------------------

--
-- Structure de la table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id_notice` int(11) NOT NULL AUTO_INCREMENT,
  `notice_description` text,
  `notice_mark` int(11) DEFAULT NULL,
  `notice_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_notice`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `notice`
--

INSERT INTO `notice` (`id_notice`, `notice_description`, `notice_mark`, `notice_date`) VALUES
(3, 'Dumque ibi diu moratur commeatus opperiens, quorum translationem ex Aquitania verni imbres solito crebriores prohibebant auctique torrentes, Herculanus advenit protector domesticus,', 4, '2015-01-25 14:47:42'),
(4, 'Dumque ibi diu moratur commeatus opperiens, quorum translationem ex Aquitania verni imbres solito crebriores prohibebant auctique torrentes, Herculanus advenit protector domesticus,', 1, '2015-01-25 14:47:57'),
(5, 'Dumque ibi diu moratur commeatus opperiens, quorum translationem ex Aquitania verni imbres solito crebriores prohibebant auctique torrentes, Herculanus advenit protector domesticus,', 4, '2015-01-25 14:48:03');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `order_billing_address` varchar(128) DEFAULT NULL,
  `order_billing_city` varchar(32) NOT NULL,
  `order_billing_postcode` int(11) NOT NULL,
  `order_billing_type` varchar(32) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `order_delivery_address` varchar(128) NOT NULL,
  `order_delivery_city` varchar(64) NOT NULL,
  `order_delivery_date` datetime DEFAULT NULL,
  `order_delivery_postcode` int(11) NOT NULL,
  `order_delivery_price` double NOT NULL,
  `order_price_HT` double NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_tax` double DEFAULT NULL,
  `id_cart` int(11) NOT NULL,
  `id_firm` int(11) NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `FK_order_id_cart` (`id_cart`),
  KEY `FK_order_id_firm` (`id_firm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `order`
--

INSERT INTO `order` (`id_order`, `order_billing_address`, `order_billing_city`, `order_billing_postcode`, `order_billing_type`, `order_date`, `order_delivery_address`, `order_delivery_city`, `order_delivery_date`, `order_delivery_postcode`, `order_delivery_price`, `order_price_HT`, `order_status`, `order_tax`, `id_cart`, `id_firm`) VALUES
(2, '2 Rue de la République', 'Paris', 75001, '1', '2015-01-25 14:51:45', '2 Rue de la République', 'Paris', '2015-01-25 14:51:45', 75001, 1.5, 250.5, 3, 0.2, 15, 1),
(3, '2 Rue de la République', 'Paris', 75001, '1', '2015-01-25 15:12:10', '2 Rue de la République', 'Paris', '2015-01-25 15:12:10', 75001, 1.5, 250.5, 3, 0.2, 17, 1),
(4, 'd', 'e', 77777, '1', '2015-01-25 20:59:04', 'a', 'b', '2015-01-25 20:59:04', 77777, 1.5, 501, 3, 0.2, 21, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `tax_tva` double NOT NULL,
  PRIMARY KEY (`tax_tva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tax`
--

INSERT INTO `tax` (`tax_tva`) VALUES
(0.2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_birthday` date NOT NULL,
  `user_firstname` varchar(32) NOT NULL,
  `user_gender` varchar(12) NOT NULL,
  `user_mail` varchar(128) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `user_mail` (`user_mail`),
  KEY `FK_user_id_group` (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `user_birthday`, `user_firstname`, `user_gender`, `user_mail`, `user_name`, `user_password`, `id_group`) VALUES
(5, '1998-10-10', 'Admin', 'H', 'admin01@example.com', 'Admin', 'd812592c00a6c5609f6811a97bc67b2d6b075fb4', 2),
(6, '1998-11-01', 'User', 'H', 'user01@example.com', 'ZeroUn', '92f110a457220a2562f9c633d43bc857a4ccb890', 1),
(7, '1998-10-10', 'User', 'F', 'user02@example.com', 'ZeroDeux', 'cb957f40c4f0461afdf32f462e996ad9590b4566', 1),
(8, '1998-10-10', 'Zbreeh', 'H', 'zbreeh@gmail.com', 'bbbbb', 'b56ba40e630e6f2fd8bc675740c299fe82507152', 1),
(9, '1990-05-25', 'Zbreeh', 'H', 'ahahah@gmail.com', 'bbbbb', 'dd6fae3ad64a551d2ee144c03fb6c0f4f6d89bd0', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `add_in_cart`
--
ALTER TABLE `add_in_cart`
  ADD CONSTRAINT `FK_add_in_cart_id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `FK_add_in_cart_id_cart` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id_cart`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_article_id_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_cart_id_delivery` FOREIGN KEY (`id_delivery`) REFERENCES `delivery` (`id_delivery`),
  ADD CONSTRAINT `FK_cart_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_category_id_category_mother` FOREIGN KEY (`id_category_mother`) REFERENCES `category` (`id_category`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_comment_id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `FK_comment_id_notice` FOREIGN KEY (`id_notice`) REFERENCES `notice` (`id_notice`),
  ADD CONSTRAINT `FK_comment_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_id_cart` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id_cart`),
  ADD CONSTRAINT `FK_order_id_firm` FOREIGN KEY (`id_firm`) REFERENCES `firm` (`id_firm`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_id_group` FOREIGN KEY (`id_group`) REFERENCES `group` (`id_group`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
