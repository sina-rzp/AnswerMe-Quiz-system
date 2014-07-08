-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2013 at 02:09 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `answerme`
--
CREATE DATABASE IF NOT EXISTS `answerme` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `answerme`;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `mod_id` varchar(50) NOT NULL,
  `mod_name` varchar(50) NOT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`mod_id`, `mod_name`) VALUES
('S001', 'Biology'),
('S002', 'Geography'),
('S003', 'IT'),
('S004', 'Design');

-- --------------------------------------------------------

--
-- Table structure for table `mod_assignment`
--

DROP TABLE IF EXISTS `mod_assignment`;
CREATE TABLE IF NOT EXISTS `mod_assignment` (
  `user_id` varchar(50) NOT NULL,
  `mod_id` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  KEY `mod_index` (`user_id`,`mod_id`),
  KEY `mod_id_idx` (`mod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod_assignment`
--

INSERT INTO `mod_assignment` (`user_id`, `mod_id`, `usertype`) VALUES
('U002', 'S001', '2'),
('U003', 'S001', '3'),
('U003', 'S002', '3'),
('U006', 'S001', '3'),
('U006', 'S002', '3'),
('U005', 'S002', '2');

-- --------------------------------------------------------

--
-- Table structure for table `obj_answers`
--

DROP TABLE IF EXISTS `obj_answers`;
CREATE TABLE IF NOT EXISTS `obj_answers` (
  `question_id` varchar(50) NOT NULL,
  `ans` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obj_questions`
--

DROP TABLE IF EXISTS `obj_questions`;
CREATE TABLE IF NOT EXISTS `obj_questions` (
  `question_id` varchar(50) NOT NULL,
  `question_text` text,
  `ans_a` text,
  `ans_b` text,
  `ans_c` text,
  `ans_d` text,
  `topic` varchar(50) NOT NULL,
  `mod_id` varchar(50) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_assignment`
--

DROP TABLE IF EXISTS `quiz_assignment`;
CREATE TABLE IF NOT EXISTS `quiz_assignment` (
  `user_id` varchar(50) NOT NULL,
  `quiz_id` varchar(50) NOT NULL DEFAULT '',
  `quiz_status` varchar(50) DEFAULT NULL,
  `ass_status` varchar(50) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_detail`
--

DROP TABLE IF EXISTS `quiz_detail`;
CREATE TABLE IF NOT EXISTS `quiz_detail` (
  `quiz_id` varchar(50) NOT NULL,
  `quiz_title` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `no_of_questions` int(11) NOT NULL,
  `quiz_status` varchar(50) DEFAULT NULL,
  `quiz_type` int(11) DEFAULT NULL,
  `timelimit` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `question_id` varchar(50) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  `question_type` varchar(10) NOT NULL,
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `q_id`
--

DROP TABLE IF EXISTS `q_id`;
CREATE TABLE IF NOT EXISTS `q_id` (
  `last_id` varchar(50) NOT NULL,
  PRIMARY KEY (`last_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q_id`
--

INSERT INTO `q_id` (`last_id`) VALUES
('0');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `user_id` varchar(50) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  `question_id` varchar(50) NOT NULL DEFAULT '',
  `answer_given` text,
  `marks_scored` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`quiz_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_questions`
--

DROP TABLE IF EXISTS `sub_questions`;
CREATE TABLE IF NOT EXISTS `sub_questions` (
  `question_id` varchar(50) NOT NULL,
  `question_text` text,
  `question_mark` int(11) DEFAULT NULL,
  `topic` varchar(50) NOT NULL,
  `mod_id` varchar(50) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `mod_id` varchar(50) NOT NULL,
  `topic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usertype` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `name`, `email`, `usertype`) VALUES
('U001', 'pass1', 'John', 'john@taylors.edu.my', 1),
('U002', 'pass2', 'Ali', 'ali@taylors.edu.my', 2),
('U003', 'pass3', 'Sina', 'sina@taylors.my', 3),
('U004', 'pass4', 'Sree', 'sree@taylors.my', 1),
('U005', 'pass5', 'Melissa', 'melissa@taylors.my', 2),
('U006', 'pass6', 'Allan', 'allan@taylors.my', 3),
('U007', 'george', 'George', 'george@taylors.my', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mod_assignment`
--
ALTER TABLE `mod_assignment`
  ADD CONSTRAINT `mod_id_fk` FOREIGN KEY (`mod_id`) REFERENCES `modules` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mod_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `obj_answers`
--
ALTER TABLE `obj_answers`
  ADD CONSTRAINT `obj_question_id` FOREIGN KEY (`question_id`) REFERENCES `obj_questions` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_detail`
--
ALTER TABLE `quiz_detail`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
