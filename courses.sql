-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 30, 2017 at 12:08 PM
-- Server version: 5.5.45
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL,
  `id_c` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `price` int(100) NOT NULL,
  PRIMARY KEY (`id_cart`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_u`, `id_c`, `name`, `url`, `price`) VALUES
(103, 19, 7, 'dfgchgf', 'dfgchgf', 334),
(105, 19, 6, 'Node js example', 'node-js-example', 999);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id_c` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `id_mc` int(30) NOT NULL,
  `is_recommended` int(112) NOT NULL DEFAULT '0',
  `trailer` varchar(100) NOT NULL,
  `video` text NOT NULL,
  `url` varchar(300) NOT NULL,
  `price` int(100) NOT NULL,
  `id_t` int(11) NOT NULL,
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_c`, `name`, `description`, `id_mc`, `is_recommended`, `trailer`, `video`, `url`, `price`, `id_t`) VALUES
(2, 'html-css для початківця', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 0, 1, 'https://www.youtube.com/embed/qEYoy3MDY7I', 'https://www.youtube.com/embed/ehLJZUf1iMo?list=PLPSKPqKvuCibaiLM7oOpfbOZz9pkUINRl', 'html-css-dlya-pochatkivcya', 134, 20),
(4, 'php1', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"', 37, 1, 'https://www.youtube.com/embed/qEYoy3MDY7I', 'https://www.youtube.com/embed/ehLJZUf1iMo?list=PLPSKPqKvuCibaiLM7oOpfbOZz9pkUINRl', 'php1', 90, 19),
(5, 'Node js урокі', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit', 0, 1, 'https://www.youtube.com/embed/qEYoy3MDY7I', 'https://www.youtube.com/embed/ehLJZUf1iMo?list=PLPSKPqKvuCibaiLM7oOpfbOZz9pkUINRl', 'node-js-uroki', 333, 20),
(6, 'Node js example', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit', 0, 1, 'https://www.youtube.com/embed/qEYoy3MDY7I', 'https://www.youtube.com/embed/ehLJZUf1iMo?list=PLPSKPqKvuCibaiLM7oOpfbOZz9pkUINRl', 'node-js-example', 999, 0),
(7, 'dfgchgf', 'dfhcdfhfgh', 0, 1, 'https://www.youtube.com/embed/C732qODMQOE', 'https://www.youtube.com/embed/ehLJZUf1iMo?list=PLPSKPqKvuCibaiLM7oOpfbOZz9pkUINRl', 'dfgchgf', 334, 20),
(8, 'last', 'waeytdufydu6', 37, 1, 'https://www.youtube.com/embed/C732qODMQOE', 'https://www.youtube.com/embed/ehLJZUf1iMo?list=PLPSKPqKvuCibaiLM7oOpfbOZz9pkUINRl', 'last', 3344, 20),
(9, 'coursshrtdh', 'agrtehtrthhrth', 0, 1, 'https://www.youtube.com/embed/C732qODMQOE', 'https://www.youtube.com/embed/ehLJZUf1iMo?list=PLPSKPqKvuCibaiLM7oOpfbOZz9pkUINRl', 'coursshrtdh', 78, 19);

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE IF NOT EXISTS `courses_students` (
  `id_c` int(11) NOT NULL,
  `id_s` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `main_courses`
--

CREATE TABLE IF NOT EXISTS `main_courses` (
  `id_mc` int(11) NOT NULL AUTO_INCREMENT,
  `name_mc` varchar(32) NOT NULL,
  `url_mc` varchar(40) NOT NULL,
  `under` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mc`),
  UNIQUE KEY `name_mc` (`name_mc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `main_courses`
--

INSERT INTO `main_courses` (`id_mc`, `name_mc`, `url_mc`, `under`) VALUES
(3, 'course 3', 'course-3', 0),
(37, 'new course111', 'new-course111', 1),
(38, 'sdsdrsd', 'sdsdrsd', 0),
(39, 'llalalal', 'llalalal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `message`, `date`) VALUES
(1, 'igor', 'trakakakakak', '0000-00-00 00:00:00'),
(6, 'teach', 'fhgj', '2017-11-11 18:11:42'),
(9, 'teach', 'jhnkh', '2017-11-11 18:11:25'),
(12, 'teach', 'hgjg', '2017-11-11 18:11:58'),
(13, 'teach', 'bhbh', '2017-11-11 18:11:09'),
(22, 'teach', 'jkhk', '2017-11-11 19:11:08'),
(23, 'teach', 'llllll', '2017-11-11 19:11:11'),
(24, 'teach', 'njhgjj', '2017-11-11 19:11:17'),
(25, 'teach', 'nnnn', '2017-11-11 19:11:20'),
(26, 'teach20', 'last message', '2017-11-11 19:11:35'),
(27, 'teach', 'lololl', '2017-11-11 19:11:52'),
(28, 'teach20', 'roman', '2017-11-11 20:11:39'),
(29, 'teach20', 'roman', '2017-11-11 20:11:55'),
(30, 'teach', 'poland', '2017-11-11 20:11:02'),
(31, 'teach', 'ddfgdf', '2017-11-11 21:11:01'),
(32, 'teach', 'tralalala', '2017-11-11 21:11:11'),
(33, 'teach20', 'hello', '2017-11-11 21:11:25'),
(34, 'teach', 'івавіа', '2017-11-11 22:11:29'),
(35, 'teach', 'зддд', '2017-11-11 22:11:41'),
(36, 'teach', 'ромка', '2017-11-11 22:11:30'),
(37, 'teach', 'льь', '2017-11-11 22:11:04'),
(38, 'teach', 'аіваві', '2017-11-11 22:11:22'),
(39, 'teach', 'чмвасчмвасчм', '2017-11-11 22:11:26'),
(40, 'teach', 'аввава', '2017-11-11 22:11:03'),
(41, 'none', 'ffhfgh', '2017-11-14 22:11:40'),
(42, 'teach', 'hello', '2017-11-14 22:11:28'),
(43, 'teach', 'dfhfgjh', '2017-11-20 17:11:36'),
(44, 'teach', 'bjkh', '2017-11-24 12:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(100) NOT NULL AUTO_INCREMENT,
  `id_user` int(100) NOT NULL,
  `user` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(20) NOT NULL,
  `comment` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `total_price` int(100) NOT NULL,
  `bought` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `user`, `email`, `phone`, `comment`, `date_creation`, `total_price`, `bought`) VALUES
(49, 19, 'teach', 'roma_2@meta.ua', 1234567890, '1', '2017-11-17 23:11:03', 134, 0),
(50, 19, 'teach', 'roma_2@meta.ua', 1234567890, '2', '2017-11-17 23:11:15', 333, 1),
(52, 19, 'teach', 'roma_2@meta.ua', 1234567890, 'trallaa', '2017-11-18 00:11:46', 3434, 0),
(53, 21, 'teach21', 'roma3@meta.ua', 1234567890, 'fgjgk', '2017-11-20 13:11:54', 3678, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE IF NOT EXISTS `orders_details` (
  `id_od` int(11) NOT NULL AUTO_INCREMENT,
  `id_c` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `price` int(100) NOT NULL,
  `id_order` int(50) NOT NULL,
  PRIMARY KEY (`id_od`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`id_od`, `id_c`, `name`, `url`, `price`, `id_order`) VALUES
(76, 2, 'html-css для початківця', 'html-css-dlya-pochatkivcya', 134, 49),
(77, 5, 'Node js урокі', 'node-js-uroki', 333, 50),
(78, 5, 'Node js урокі', 'node-js-uroki', 333, 50),
(81, 4, 'php1', 'php1', 90, 52),
(82, 8, 'last', 'last', 3344, 52),
(83, 8, 'last', 'last', 3344, 53),
(84, 7, 'dfgchgf', 'dfgchgf', 334, 53);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id_s` int(11) NOT NULL,
  PRIMARY KEY (`id_s`),
  KEY `id_s` (`id_s`),
  KEY `id_s_2` (`id_s`),
  KEY `id_s_3` (`id_s`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_s`) VALUES
(0),
(14);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id_t` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `working_place` varchar(50) NOT NULL,
  `best` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_t`),
  KEY `id_t` (`id_t`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id_t`, `description`, `degree`, `working_place`, `best`) VALUES
(19, 'DESCRIPTIOMN', 'desgree', 'SoftServe', 1),
(20, 'descriptionfgfdhgdh\r\n', 'degreefgfg', 'Apricotfgff', 1),
(21, 'description', 'degree', 'EPAM', 1),
(22, 'lorem ipsum', 'lorem ipsum', 'lorem ipsum', 1),
(23, 'lorem ipsum2', 'lorem ipsum2', 'lorem ipsum', 1),
(24, 'lorem ipsum2', 'lorem ipsum2', 'lorem ipsum', 1),
(25, 'lorem ipsum2', 'lorem ipsum2', 'lorem ipsum', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_u` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `hesh_key` varchar(50) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  PRIMARY KEY (`id_u`),
  UNIQUE KEY `emai` (`email`),
  KEY `id_u` (`id_u`),
  KEY `id_u_2` (`id_u`),
  KEY `id_u_3` (`id_u`),
  KEY `id_u_4` (`id_u`),
  KEY `id_u_5` (`id_u`),
  KEY `id_u_6` (`id_u`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_u`, `name`, `surname`, `email`, `password`, `user_type`, `hesh_key`, `active`, `is_admin`, `date_register`) VALUES
(14, 'igor', 'surnamne', 'igor@mail.ru', '123456789', 'student', '153b40b5f90e79234d70bd4c87f7e45f', 1, 0, '2017-10-18 10:10:54'),
(19, 'teach', 'surname19', 'roma_2@meta.ua', '123456', 'teacher', 'f543539214b0cc745ddc600af25efffb', 1, 1, '2017-10-18 20:10:42'),
(20, 'teach201', 'surname201', 'roma2@meta.uo', '123456', 'teacher', 'e5e00abcb20bd80e894e4e1904c5e2b2', 1, 1, '2017-10-18 20:10:49'),
(21, 'teach21', 'surname21', 'roma3@meta.ua', '123456', 'teacher', '360bb44062587cd139a70c1e1c6e1409', 1, 0, '2017-10-18 20:10:18'),
(22, 'new', 'teacher', 'ff@ii.oi', '4555555', 'teacher', 'afaf1d625e77ca16f221dee9eaccf0ac', 1, 0, '2017-11-15 00:11:07'),
(23, 'new', 'teacher', 'ff@ii.oia', '4555555', 'teacher', 'afaf1d625e77ca16f221dee9eaccf0ac', 1, 0, '2017-11-15 00:11:07'),
(24, 'new', 'teacher', 'ff@ii.oiaa', '4555555', 'teacher', 'afaf1d625e77ca16f221dee9eaccf0ac', 1, 0, '2017-11-15 00:11:07'),
(25, 'new', 'teacher', 'ff@ii.oiaaf', '4555555', 'teacher', 'afaf1d625e77ca16f221dee9eaccf0ac', 1, 0, '2017-11-15 00:11:07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
