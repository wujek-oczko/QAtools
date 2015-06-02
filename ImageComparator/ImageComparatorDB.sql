-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2015 at 11:16 AM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Table structure for table `browser`
--

DROP TABLE IF EXISTS `browser`;
CREATE TABLE IF NOT EXISTS `browser` (
  `id_Browser` int(11) NOT NULL,
  `browser_shortcut` char(2) DEFAULT NULL,
  `browser_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `browser`
--

INSERT INTO `browser` (`id_Browser`, `browser_shortcut`, `browser_name`) VALUES
(1, 'CH', 'Chrome'),
(2, 'FF', 'Mozilla Firefox'),
(3, 'IE', 'Internet Explorer');

-- --------------------------------------------------------

--
-- Table structure for table `environment`
--

DROP TABLE IF EXISTS `environment`;
CREATE TABLE IF NOT EXISTS `environment` (
  `id_Environment` int(11) NOT NULL,
  `env_name` varchar(45) DEFAULT NULL,
  `env_shortcut` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `environment`
--

INSERT INTO `environment` (`id_Environment`, `env_name`, `env_shortcut`) VALUES
(1, 'Verification', 'VER'),
(2, 'Continouus integration', 'CI');

-- --------------------------------------------------------

--
-- Table structure for table `loaded_images`
--

DROP TABLE IF EXISTS `loaded_images`;
CREATE TABLE IF NOT EXISTS `loaded_images` (
`image_id` int(11) NOT NULL,
  `image_name` varchar(45) DEFAULT NULL,
  `class_name` varchar(45) DEFAULT NULL,
  `test_name` varchar(45) DEFAULT NULL,
  `user_login` varchar(45) DEFAULT NULL,
  `browser_id` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `full_path` varchar(250) DEFAULT NULL,
  `build_id` varchar(45) DEFAULT NULL,
  `Environment_id_Environment` int(11) NOT NULL,
  `Run_id_Run` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=142 ;

--
-- Dumping data for table `loaded_images`
--

INSERT INTO `loaded_images` (`image_id`, `image_name`, `class_name`, `test_name`, `user_login`, `browser_id`, `timestamp`, `status`, `full_path`, `build_id`, `Environment_id_Environment`, `Run_id_Run`) VALUES
(128, 'Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help2HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_62\\MSd_VER\\MSd-1191\\CH\\0\\Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 9),
(129, 'Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help3HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_62\\MSd_VER\\MSd-1191\\CH\\0\\Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 9),
(130, 'Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help4HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Rejected', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_62\\MSd_VER\\MSd-1194\\CH\\0\\Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 9),
(131, 'Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help2HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_67\\MSd_VER\\MSd-1191\\CH\\0\\Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 10),
(132, 'Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help3HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_67\\MSd_VER\\MSd-1191\\CH\\0\\Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 10),
(133, 'Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help4HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Rejected', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_67\\MSd_VER\\MSd-1194\\CH\\0\\Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 10),
(134, 'Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help2HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Rejected', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_68\\MSd_VER\\MSd-1191\\CH\\0\\Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 11),
(135, 'Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help3HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_68\\MSd_VER\\MSd-1191\\CH\\0\\Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 11),
(136, 'Help7HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help7HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_68\\MSd_VER\\MSd-1191\\CH\\0\\Help7HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 11),
(137, 'Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help4HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Rejected', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_68\\MSd_VER\\MSd-1194\\CH\\0\\Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 11),
(138, 'Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help2HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'DIFFERENT', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141018233554_dcadmin@RTNIV12-VM3_4540_31\\MSd_VER\\MSd-1191\\FF\\0\\Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 12),
(139, 'Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help3HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'DIFFERENT', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141018233554_dcadmin@RTNIV12-VM3_4540_31\\MSd_VER\\MSd-1191\\FF\\0\\Help3HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 12),
(140, 'HelpHCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'HelpHCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141018233554_dcadmin@RTNIV12-VM3_4540_31\\MSd_VER\\MSd-1191\\FF\\0\\HelpHCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 12),
(141, 'Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help4HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'DIFFERENT', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141018233554_dcadmin@RTNIV12-VM3_4540_31\\MSd_VER\\MSd-1194\\FF\\0\\Help4HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 12);

--
-- Triggers `loaded_images`
--
DROP TRIGGER IF EXISTS `WHEN_ACCEPTED`;
DELIMITER //
CREATE TRIGGER `WHEN_ACCEPTED` BEFORE UPDATE ON `loaded_images`
 FOR EACH ROW IF(UCASE(TRIM(OLD.STATUS)) != UCASE(TRIM(NEW.STATUS)) AND UCASE(TRIM(NEW.STATUS)) = 'ACCEPTED')
THEN 

INSERT INTO MODEL_IMAGES 
(BROWSER_ID, 
BUILD_ID, 
CLASS_NAME, 
ENVIRONMENT_ID_ENVIRONMENT, 
FULL_PATH, 
IMAGE_NAME, 
RUN_ID_RUN, 
STATUS, 
TEST_NAME, 
TIMESTAMP, 
USER_LOGIN)
VALUES 
(NEW.BROWSER_ID, 
NEW.BUILD_ID, 
NEW.CLASS_NAME, 
NEW.ENVIRONMENT_ID_ENVIRONMENT, 
NEW.FULL_PATH, 
NEW.IMAGE_NAME, 
NEW.RUN_ID_RUN, 
NEW.STATUS, 
NEW.TEST_NAME, 
NEW.TIMESTAMP, 
NEW.USER_LOGIN);

ELSEIF(UCASE(TRIM(NEW.STATUS)) = 'REJECTED')
THEN 

DELETE FROM MODEL_IMAGES
WHERE IMAGE_NAME = NEW.IMAGE_NAME;


INSERT INTO MODEL_IMAGES 
(BROWSER_ID, 
BUILD_ID, 
CLASS_NAME, 
ENVIRONMENT_ID_ENVIRONMENT, 
FULL_PATH, 
IMAGE_NAME, 
RUN_ID_RUN, 
STATUS, 
TEST_NAME, 
TIMESTAMP, 
USER_LOGIN)
VALUES 
(NEW.BROWSER_ID, 
NEW.BUILD_ID, 
NEW.CLASS_NAME, 
NEW.ENVIRONMENT_ID_ENVIRONMENT, 
NEW.FULL_PATH, 
NEW.IMAGE_NAME, 
NEW.RUN_ID_RUN, 
NEW.STATUS, 
NEW.TEST_NAME, 
NEW.TIMESTAMP, 
NEW.USER_LOGIN);

END IF
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `model_images`
--

DROP TABLE IF EXISTS `model_images`;
CREATE TABLE IF NOT EXISTS `model_images` (
`image_id` int(11) NOT NULL,
  `image_name` varchar(45) DEFAULT NULL,
  `class_name` varchar(45) DEFAULT NULL,
  `test_name` varchar(45) DEFAULT NULL,
  `user_login` varchar(45) DEFAULT NULL,
  `browser_id` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `full_path` varchar(250) DEFAULT NULL,
  `build_id` varchar(45) DEFAULT NULL,
  `Environment_id_Environment` int(11) NOT NULL,
  `Run_id_Run` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `model_images`
--

INSERT INTO `model_images` (`image_id`, `image_name`, `class_name`, `test_name`, `user_login`, `browser_id`, `timestamp`, `status`, `full_path`, `build_id`, `Environment_id_Environment`, `Run_id_Run`) VALUES
(52, 'Help7HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help7HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Rejected', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_68\\MSd_VER\\MSd-1191\\CH\\0\\Help7HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 11),
(53, 'HelpHCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'HelpHCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Accepted', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141018233554_dcadmin@RTNIV12-VM3_4540_31\\MSd_VER\\MSd-1191\\FF\\0\\HelpHCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 12),
(54, 'Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH', 'Help2HCPTest', 'helpHCPNavigateToIFU', 'hcpgben2', 1, '2014-12-03 16:07:18', 'Rejected', 'C:\\Users\\marcinja\\Desktop\\doTestow - Copy - Copy\\20141107124936_dcadmin@RTNIV12-VM3_17772_68\\MSd_VER\\MSd-1191\\CH\\0\\Help2HCPTest_helpHCPNavigateToIFU_hcpgben2_CH(2014-12-03 16-07-18).jpg', '1.4.1.1777389', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `run`
--

DROP TABLE IF EXISTS `run`;
CREATE TABLE IF NOT EXISTS `run` (
`id_Run` int(11) NOT NULL,
  `run_number` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `run`
--

INSERT INTO `run` (`id_Run`, `run_number`) VALUES
(1, '30'),
(9, '62'),
(10, '67'),
(11, '68'),
(12, '31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `browser`
--
ALTER TABLE `browser`
 ADD PRIMARY KEY (`id_Browser`);

--
-- Indexes for table `environment`
--
ALTER TABLE `environment`
 ADD PRIMARY KEY (`id_Environment`);

--
-- Indexes for table `loaded_images`
--
ALTER TABLE `loaded_images`
 ADD PRIMARY KEY (`image_id`), ADD KEY `fk_Loaded_Images_Browser1_idx` (`browser_id`), ADD KEY `fk_Loaded_Images_Environment1_idx` (`Environment_id_Environment`), ADD KEY `fk_Loaded_Images_Run1_idx` (`Run_id_Run`);

--
-- Indexes for table `model_images`
--
ALTER TABLE `model_images`
 ADD PRIMARY KEY (`image_id`), ADD KEY `fk_Model_Images_Browser1_idx` (`browser_id`), ADD KEY `fk_Model_Images_Environment1_idx` (`Environment_id_Environment`), ADD KEY `fk_Model_Images_Run1_idx` (`Run_id_Run`);

--
-- Indexes for table `run`
--
ALTER TABLE `run`
 ADD PRIMARY KEY (`id_Run`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loaded_images`
--
ALTER TABLE `loaded_images`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `model_images`
--
ALTER TABLE `model_images`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `run`
--
ALTER TABLE `run`
MODIFY `id_Run` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `loaded_images`
--
ALTER TABLE `loaded_images`
ADD CONSTRAINT `fk_Loaded_Images_Browser1` FOREIGN KEY (`browser_id`) REFERENCES `browser` (`id_Browser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Loaded_Images_Environment1` FOREIGN KEY (`Environment_id_Environment`) REFERENCES `environment` (`id_Environment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Loaded_Images_Run1` FOREIGN KEY (`Run_id_Run`) REFERENCES `run` (`id_Run`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `model_images`
--
ALTER TABLE `model_images`
ADD CONSTRAINT `fk_Model_Images_Browser1` FOREIGN KEY (`browser_id`) REFERENCES `browser` (`id_Browser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Model_Images_Environment1` FOREIGN KEY (`Environment_id_Environment`) REFERENCES `environment` (`id_Environment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Model_Images_Run1` FOREIGN KEY (`Run_id_Run`) REFERENCES `run` (`id_Run`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
