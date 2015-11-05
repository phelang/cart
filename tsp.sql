-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: `tspsshop`
--
CREATE DATABASE IF NOT EXISTS `tpsshop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tpsshop`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Car'),
(2, 'Laptop'),
(3, 'Phone'),
(4, 'TV'),
(5, 'Yacht');


-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  
  `add1` varchar(50) NOT NULL,

  
  
  `postcode` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `registered` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `forname`, `surname`, `add1`,`postcode`, `phone`, `email`, `registered`) VALUES

(1, 'Thandokazi', 'Xulubana', 'Cape Town, South Africa','7580', '0617809334', 'phelang.qhu@hotmail.com', 1),
(2, 'Sibabalwe', 'Dike', 'Cape Town, South Africa','7580', '0837893990', 'sdike@gmail.com', 1),
(3, 'Phelang', 'Qhu', 'Cape Town, South Africa','7580', '0717309677', 'phelang.qhu@hotmail.com', 1);


-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `logins`
--

INSERT INTO `login` (`id`, `customer_id`, `username`, `password`) VALUES
(1, 1, 'xulubanat', 'project'),
(2, 2, 'dikes', 'project'),
(3, 3, 'qhup', 'project');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,  
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;



-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` tinyint(4) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(30) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`, `description`, `image`, `price`) VALUES
-- CARS
(1, 1, 'LamborginiVenon', 'The Lamborghini Veneno is consistently focused on optimum aerodynamics and cornering stability.', 'lamborgini_venon.jpg', 42000000),
(2, 1, 'Mercedes c63', 'Mercedes-AMG C 63 4.0 Liter V8 Biturbo Engine Max.', 'mercedes_c63.jpg', 1338800),
(3, 1, 'Bugatti Veyron', 'The Bugatti Veyron EB 16.4 is a mid-engined sports car.', 'buggatti.jpg', 34000000),
(4, 1, 'Rolls Royce', 'Rolls Royce phantom coupe.', 'rollsroyce.jpg', 9999999),
(5, 2, 'Acer', 'Acer Ultra Flexible 2015', 'acer.jpg', 10772.44),
(6, 2, 'Lenovo', 'Lenovo Thinkpad Twist ', 'lenovo.jpg', 17999.00),
(7, 2, 'Samsung Slime', 'The Series 9 Core i5 model I used NP900X4C', 'samsung.jpg', 10460.00),
(8, 2, 'HP Envy 15', '5th Gen Intel® Core™ i7 processor; 15.6" display; 6GB memory; 1TB hard drive', 'hp.jpg', 13999.00),
(9, 3, 'IPhone 7', 'IPhone 7 Plus 2015', 'iphone.jpg', 11378.60),
(10, 3, 'HTC', 'HTC M9', 'htc.jpg', 12000.60),
(11, 3, 'Galaxy', 'Galaxy S6, Edge', 'galaxy.jpg', 9984.75),
(12, 3, 'Nokia Lumia', 'Moto X 2015 3rd Generation', 'nokia.jpg', 9999.60),
(13, 4, 'LG', 'Moto X 2015 3rd Generation', 'lgtv.jpg', 184900.60),
(14, 4, 'Samsung Curve ', 'Samsung 48 LED J5300', 'samsungcurve.jpg', 200000.60),
(15, 4, 'Samsung', 'Samsung Series 65 LCD', 'samsung65.jpg', 107402.57),
(16, 4, 'Sony Bravia S90', 'Free reverse phone lookup google', 'sonytv.jpg', 15000.60),
(17, 5, 'Cichero', 'Cichero superyacht Luxury', 'cichero.jpg', 2.7),
(18, 5, 'Batmobile Yacht', 'Batmobile yacht: $30M yacht resembles the Batmobile', 'batmobile.jpg', 3.5),
(19, 5, 'Isabelle Yacht', 'Isabelle', 'isabelle.jpg', 5.00),
(20, 5, 'MCD Ycht', 'Super Yacht Island', 'superyacht.jpg', 1.00);

