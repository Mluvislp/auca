-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2023 at 08:39 PM
-- Server version: 10.6.15-MariaDB-cll-lve-log
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vhrjhzrn_auca`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `batch_name` varchar(255) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `batch_product_suggest` varchar(255) DEFAULT NULL,
  `batch_status` int(11) NOT NULL DEFAULT 1 COMMENT '1: Show , 2 : Hide',
  `user_id` int(11) NOT NULL,
  `created_at` int(15) NOT NULL,
  `updated_at` int(15) NOT NULL,
  `deleted_at` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `batch_name`, `groupid`, `batch_product_suggest`, `batch_status`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'hello batch', 2, NULL, 1, 1, 1690086423, 0, NULL),
(2, 'L007', 2, NULL, 1, 1, 1690086751, 0, NULL),
(3, 'L007', 2, NULL, 1, 1, 1690087774, 0, NULL),
(4, 'L007', 2, NULL, 1, 1, 1690087795, 0, NULL),
(5, 'L007', 2, NULL, 1, 1, 1690087851, 0, NULL),
(6, 'L007', 2, NULL, 1, 1, 1690088162, 0, NULL),
(7, 'L007', 2, NULL, 1, 1, 1690088203, 0, NULL),
(8, 'L007', 2, NULL, 1, 1, 1690088332, 0, NULL),
(9, 'L007', 2, NULL, 1, 1, 1690088422, 0, NULL),
(10, 'L007', 2, NULL, 1, 1, 1690088462, 0, NULL),
(11, 'L007', 2, NULL, 2, 1, 1690088520, 0, NULL),
(12, 'L007', 2, NULL, 1, 1, 1690088732, 0, NULL),
(13, 'L007', 2, NULL, 1, 1, 1690088795, 0, NULL),
(14, 'L007', 2, NULL, 1, 1, 1690088929, 0, NULL),
(15, 'L007', 2, NULL, 1, 1, 1690088990, 0, NULL),
(16, 'L007', 2, NULL, 1, 1, 1690089036, 0, NULL),
(17, 'L007', 2, NULL, 1, 1, 1690089062, 0, NULL),
(18, 'L007', 2, NULL, 1, 1, 1690089763, 0, NULL),
(19, '34234', 2, NULL, 1, 1, 1690090376, 0, NULL),
(20, 'L007', 2, NULL, 1, 1, 1690090404, 0, NULL),
(21, 'SLOA1', 2, NULL, 1, 1, 1690097743, 0, NULL),
(22, 'LO900', 2, NULL, 1, 1, 1690107405, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `batch_product`
--

CREATE TABLE `batch_product` (
  `bp_id` int(11) NOT NULL,
  `bp_name` varchar(255) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `bp_price` decimal(25,3) NOT NULL,
  `bp_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 là active 2 là inactive',
  `bp_manufacture_date` int(11) DEFAULT NULL,
  `groupid` int(12) NOT NULL DEFAULT 2,
  `bp_expired_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_product`
--

INSERT INTO `batch_product` (`bp_id`, `bp_name`, `batch_id`, `prd_id`, `bp_price`, `bp_status`, `bp_manufacture_date`, `groupid`, `bp_expired_date`) VALUES
(3, 'L007', 10, 1, 2500000.000, 1, 1689984000, 2, 1690502400),
(4, 'L007', 14, 1, 70000.000, 1, 1689984000, 2, 1690416000),
(5, 'L007', 15, 1, 70000.000, 1, 1689811200, 2, 1690675200),
(6, 'L007', 16, 1, 800000.000, 1, 1690588800, 2, 1690416000),
(7, 'L007', 17, 2, 700000.000, 1, 1690416000, 2, 1690761600),
(8, 'L007', 17, 1, 600000.000, 1, 1690588800, 2, 1690502400),
(9, 'L007', 18, 1, 20000.000, 1, 1690070400, 2, 1690761600),
(11, '34234', 19, 2, 7000000.000, 1, 1690761600, 2, 1690761600),
(12, 'L007', 20, 2, 60000.000, 1, 1690502400, 2, 1690761600),
(13, 'SLOA1', 21, 2, 100.000, 1, 1688169600, 2, 1690675200),
(14, 'LO900', 22, 1, 100000.000, 1, 1690070400, 2, 1690675200),
(15, 'LO900', 22, 2, 200000.000, 1, 1690070400, 2, 1690675200);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_parent_id` int(11) DEFAULT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_code` varchar(255) DEFAULT NULL,
  `brand_order` int(11) DEFAULT NULL,
  `brand_description` varchar(255) DEFAULT NULL,
  `brand_content` text DEFAULT NULL,
  `brand_image` varchar(255) DEFAULT NULL,
  `brand_meta_title` varchar(255) DEFAULT NULL,
  `brand_meta_keyword` varchar(255) DEFAULT NULL,
  `brand_meta_description` varchar(255) DEFAULT NULL,
  `brand_status` int(11) NOT NULL DEFAULT 1 COMMENT '	1 = Active, 2 = Inactive	',
  `user_id` int(11) NOT NULL,
  `groupid` int(12) NOT NULL DEFAULT 2,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_parent_id`, `brand_name`, `brand_code`, `brand_order`, `brand_description`, `brand_content`, `brand_image`, `brand_meta_title`, `brand_meta_keyword`, `brand_meta_description`, `brand_status`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 0, 'gucci', 'channel0005', 1, '123123', 'heheheh', '', '', '', NULL, 1, 1, 2, '2023-07-13 02:45:22', '2023-08-13 17:55:56', NULL),
(9, 0, 'import 1', 'import-1', 9, '1', 'content - 1', '', '', '', NULL, 1, 1, 2, '2023-07-13 02:47:54', '2023-07-20 02:04:29', NULL),
(11, 0, 'import 5', 'import-5', 2, '5', 'content - 5', '', '', '', NULL, 1, 1, 2, '2023-07-13 02:47:54', '2023-08-13 17:55:56', NULL),
(12, 0, 'import 4', 'import-4', 3, '4', 'content - 4', '', '', '', NULL, 1, 1, 2, '2023-07-13 02:47:54', '2023-08-13 17:55:57', NULL),
(17, 0, 'ss', 'ss', 6, 'ssss', '', '871418b514c9d2f41f312c2d89bc99a5.png', '', '', NULL, 1, 1, 2, '2023-07-13 15:22:56', '2023-08-13 17:58:48', NULL),
(19, 0, 'a', 'S3', 5, '', '', '', '', '', NULL, 1, 1, 2, '2023-07-19 02:00:12', '2023-08-13 17:55:57', NULL),
(20, 0, 'a', 'S2', 8, '', '', '', '', '', NULL, 2, 1, 2, '2023-07-19 02:00:12', '2023-08-13 17:58:52', NULL),
(21, 0, 'a', 'S2', 7, '', '', '', '', '', NULL, 2, 1, 2, '2023-07-19 02:01:07', '2023-08-13 17:58:52', NULL),
(22, 0, 'b', 'S1', 11, '', '', '', '', '', NULL, 1, 1, 2, '2023-07-19 02:01:07', '2023-07-19 06:58:53', NULL),
(23, 0, 'b', 'S1', NULL, '', '', '', '', '', NULL, 1, 1, 2, '2023-07-19 02:01:07', '2023-07-19 02:01:07', NULL),
(24, 0, 'a', 'S3', NULL, '', '', '', '', '', NULL, 1, 1, 2, '2023-07-19 02:01:07', '2023-07-19 02:01:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_account`
--

CREATE TABLE `cash_account` (
  `ca_id` int(11) NOT NULL,
  `ca_code` varchar(255) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_parent_id` int(11) DEFAULT NULL,
  `cat_code` varchar(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_order` int(11) DEFAULT NULL,
  `cat_image` varchar(255) DEFAULT NULL,
  `cat_icon` varchar(255) DEFAULT NULL,
  `cat_description` text DEFAULT NULL,
  `cat_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Active, 2 = Inactive',
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_parent_id`, `cat_code`, `cat_name`, `cat_order`, `cat_image`, `cat_icon`, `cat_description`, `cat_status`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'QUAO', 'Quần áo', 3, NULL, NULL, NULL, 1, 1, 2, 1687941848, 1687941848, NULL),
(2, NULL, 'GIAYDEP', 'Giày dép', 2, NULL, NULL, NULL, 1, 1, 2, 1687941848, 1687941848, NULL),
(4, 1, 'QĐAP', 'Quần đùi áo phông', 6, 'a94b85aab148b590de9f182ee1903c14.jpg', 'ccd483573bef067f17ff14e7f9ee8ea2.png', 'Quan dui ao phong long nhong giua pho', 2, 1, 2, 1689270379, 1689270379, NULL),
(10, NULL, 'PKXH', 'Phụ kiện xe hơi', 1, 'edd4dc27e401903ea7b6cb7681334647.png', '20a4ae109dcda4b5864967a2780408a0.png', 'Phụ kiện cho xe hơi', 1, 1, 2, 1689339885, 1689339885, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_internal`
--

CREATE TABLE `category_internal` (
  `cat_inter_id` int(11) NOT NULL,
  `cat_inter_parent_id` int(11) DEFAULT NULL,
  `cat_inter_name` varchar(255) NOT NULL,
  `cat_inter_code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `category_internal`
--

INSERT INTO `category_internal` (`cat_inter_id`, `cat_inter_parent_id`, `cat_inter_name`, `cat_inter_code`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'Danh mục số 1', 'DM1', 1, 2, 1689057452, 1689122074, NULL),
(2, NULL, 'Danh mục 2', 'DM2', 1, 2, 1689057466, 1689057466, NULL),
(3, 2, 'Danh mục con của danh mục 2', 'DMCCDM2', 1, 2, 1689057484, 1689057484, NULL),
(4, 1, 'Danh mục con của danh mục 1', 'DMCCDM1', 1, 2, 1689057499, 1689057499, NULL),
(6, 1, 'Test import2', 'ti2', 1, 2, 1689061476, 1689061476, NULL),
(7, 1, 'Test import6', 'ti6', 1, 2, 1689061476, 1689061476, NULL),
(8, 1, 'Test import7', 'ti7', 1, 2, 1689061476, 1689061476, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_tag`
--

CREATE TABLE `category_tag` (
  `cat_id` int(11) NOT NULL,
  `ctag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_tag`
--

INSERT INTO `category_tag` (`cat_id`, `ctag_id`) VALUES
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(9, 1),
(9, 2),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cat_tag`
--

CREATE TABLE `cat_tag` (
  `ctag_id` int(11) NOT NULL,
  `ctag_name` varchar(255) NOT NULL,
  `ctag_color` varchar(255) DEFAULT NULL,
  `ctag_text_color` varchar(255) DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `cat_tag`
--

INSERT INTO `cat_tag` (`ctag_id`, `ctag_name`, `ctag_color`, `ctag_text_color`, `groupid`) VALUES
(1, 'Hot', NULL, NULL, 2),
(2, 'New', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_iso` char(2) NOT NULL,
  `country_name` varchar(80) NOT NULL,
  `country_nicename` varchar(80) NOT NULL,
  `country_iso3` char(3) DEFAULT NULL,
  `country_numcode` smallint(6) DEFAULT NULL,
  `country_phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_iso`, `country_name`, `country_nicename`, `country_iso3`, `country_numcode`, `country_phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `depot`
--

CREATE TABLE `depot` (
  `depot_id` int(11) NOT NULL,
  `depot_name` varchar(255) NOT NULL,
  `depot_mobile` varchar(255) DEFAULT NULL,
  `depot_country_id` int(11) DEFAULT NULL,
  `depot_country_iso` varchar(255) DEFAULT NULL,
  `depot_city_id` int(11) DEFAULT NULL,
  `depot_city_name` varchar(255) DEFAULT NULL,
  `depot_district_id` int(11) DEFAULT NULL,
  `depot_district_name` varchar(255) DEFAULT NULL,
  `depot_ward_id` int(11) DEFAULT NULL,
  `depot_ward_name` varchar(255) DEFAULT NULL,
  `depot_address` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `depot`
--

INSERT INTO `depot` (`depot_id`, `depot_name`, `depot_mobile`, `depot_country_id`, `depot_country_iso`, `depot_city_id`, `depot_city_name`, `depot_district_id`, `depot_district_name`, `depot_ward_id`, `depot_ward_name`, `depot_address`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Âu ca HCM', '0987773123', 232, 'VN', NULL, NULL, NULL, NULL, NULL, NULL, 'Hồ Chí Minh ', 1, 2, 1687755702, 1687755702, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_check`
--

CREATE TABLE `inventory_check` (
  `ic_id` int(11) NOT NULL,
  `ic_type` int(11) NOT NULL,
  `ic_total_inventory_real` int(11) NOT NULL DEFAULT 0,
  `ic_totalI_inventory_different1` int(11) NOT NULL DEFAULT 0,
  `ic_totalI_inventory_different2` int(11) NOT NULL DEFAULT 0,
  `ic_totalI_inventory_different` int(11) NOT NULL DEFAULT 0,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_check_product`
--

CREATE TABLE `inventory_check_product` (
  `icp_id` int(11) NOT NULL,
  `icp_inventory` int(11) DEFAULT NULL,
  `icp_delivering` int(11) DEFAULT NULL,
  `icp_remaining_inventory` int(11) DEFAULT NULL COMMENT 'icp_remaining_inventory = icp_inventory -icp_delivering',
  `icp_holding` int(11) DEFAULT NULL COMMENT 'tam giu',
  `icp_inventory_real` int(11) DEFAULT NULL,
  `icp_inventory_different` int(11) DEFAULT NULL,
  `icp_inventory_different_value` decimal(14,3) DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_product`
--

CREATE TABLE `log_product` (
  `log_prd_id` int(11) NOT NULL,
  `w_id` int(11) DEFAULT NULL,
  `prd_id` int(11) NOT NULL COMMENT 'product_id',
  `log_prd_name` text DEFAULT NULL,
  `log_prd_code` varchar(255) DEFAULT NULL,
  `log_prd_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`log_prd_type`)),
  `log_prd_step` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`log_prd_step`)),
  `log_prd_old_value` text DEFAULT NULL,
  `log_prd_new_value` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `log_product`
--

INSERT INTO `log_product` (`log_prd_id`, `w_id`, `prd_id`, `log_prd_name`, `log_prd_code`, `log_prd_type`, `log_prd_step`, `log_prd_old_value`, `log_prd_new_value`, `user_id`, `groupid`, `created_at`) VALUES
(10, NULL, 36, '- Vải vóc', '-VV', '{\"type_id\":[3,7]}', '{\"step_id\":[2]}', '\"[]\"', '\"[]\"', 1, 2, 1692199128),
(11, NULL, 37, 'bach test', 'asdijc asdcuin', '{\"type_id\":[]}', '{\"step_id\":[]}', '\"[]\"', '\"[]\"', 1, 2, 1692280966),
(12, NULL, 38, '- Vải vóc', '-VV', '{\"type_id\":[3,7]}', '{\"step_id\":[2]}', '\"[]\"', '\"[]\"', 1, 2, 1692281010),
(13, NULL, 40, '- Vải vóc', '-VV', '{\"type_id\":[3,7]}', '{\"step_id\":[2]}', '\"[]\"', '\"[]\"', 1, 2, 1692281018),
(14, NULL, 29, 'Test api 3', 'ssssss', '{\"type_id\":[1,2]}', '{\"step_id\":[1,1]}', '\"{\\\"pd_price\\\":\\\"19000000.000\\\",\\\"pd_import_price\\\":\\\"9000000.000\\\"}\"', '\"{\\\"pd_price\\\":\\\"2222222\\\",\\\"pd_import_price\\\":\\\"3333333\\\"}\"', 1, 2, 1692630028),
(15, NULL, 37, 'bach test', 'asdijc asdcuin', '{\"type_id\":[]}', '{\"step_id\":[]}', '\"[]\"', '\"[]\"', 1, 2, 1692807978),
(16, NULL, 3, 'Test api 2', 'CODETEST2', '{\"type_id\":[2]}', '{\"step_id\":[1]}', '\"{\\\"pd_import_price\\\":\\\"9000000.000\\\"}\"', '\"{\\\"pd_import_price\\\":\\\"55555555\\\"}\"', 1, 2, 1692808021),
(17, NULL, 47, 'con chim', 'awaweaw', '{\"type_id\":[3,7]}', '{\"step_id\":[2]}', '\"[]\"', '\"[]\"', 1, 2, 1694233224),
(18, NULL, 46, 'aaaaaaa - Vải thưa - Nilon1', ' -VV-NL1', '{\"type_id\":[]}', '{\"step_id\":[]}', '\"[]\"', '\"[]\"', 1, 2, 1694241685);

-- --------------------------------------------------------

--
-- Table structure for table `position_category`
--

CREATE TABLE `position_category` (
  `id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT 2,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `parent2` varchar(255) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position_category`
--

INSERT INTO `position_category` (`id`, `groupid`, `name`, `level`, `parent`, `parent2`, `warehouse_id`, `created_by`, `created_at`) VALUES
(1, 2, 'kho hàng số 33', 1, 0, '1', 1, 1, 1690991850),
(2, 2, 'kệ hàng 34', 2, 1, '1,2', 1, 1, 1690991885),
(3, 2, 'khung hàng 15', 3, 2, '1,2,3', 1, 1, 1690991898);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prd_id` int(11) NOT NULL,
  `prd_name` varchar(255) DEFAULT NULL,
  `prd_type_id` int(11) NOT NULL COMMENT 'Active | Inactive | OutOfStock',
  `prd_parent_id` int(11) DEFAULT NULL,
  `prd_code` varchar(255) DEFAULT NULL,
  `prd_barcode` varchar(255) DEFAULT NULL COMMENT 'ma vach o dang so',
  `prd_imei` varchar(255) DEFAULT NULL,
  `prd_status_id` int(11) DEFAULT 0,
  `cat_id` int(11) DEFAULT NULL COMMENT 'danh muc',
  `cat_inter_id` int(11) DEFAULT NULL COMMENT 'danh muc noi bo',
  `brand_id` int(11) DEFAULT NULL COMMENT 'thuong hieu',
  `sup_id` int(11) DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prd_id`, `prd_name`, `prd_type_id`, `prd_parent_id`, `prd_code`, `prd_barcode`, `prd_imei`, `prd_status_id`, `cat_id`, `cat_inter_id`, `brand_id`, `sup_id`, `groupid`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Test api 2', 1, NULL, 'CODETEST2', 'PRD-78793894', NULL, 1, 2, 1, 7, 3, 2, 1, 1690302223, 1692808021, NULL),
(4, 'Test api 2 child', 1, 3, 'CODETESTCHILD2', 'PRD-72401351', NULL, 1, 2, 1, 7, 3, 2, 1, 1690302223, 1690302223, NULL),
(16, 'Giày thuong dinh', 1, NULL, 'GTD', 'PRD-67591995', NULL, 1, 2, NULL, 7, NULL, 2, 1, 1690996165, 1690996165, NULL),
(17, 'Giày batman', 1, NULL, 'BATMAT', 'PRD-57447476', NULL, 1, 2, NULL, NULL, NULL, 2, 1, 1691085841, 1691085841, NULL),
(18, 'GIAY BATMAN - Vải vóc', 1, 17, 'BATMAN-VV', 'PRD-91154517', NULL, 1, 2, NULL, NULL, NULL, 2, 1, 1691085841, 1691085841, NULL),
(23, 'Giày Chạy Bộ Nam Under Armour HOVR Turbulence', 1, NULL, 'UAHOVR', 'PRD-83277753', NULL, 1, 2, NULL, 7, NULL, 2, 1, 1691259916, 1691259916, NULL),
(27, 'Test api 1', 1, 1, 'PRDTESTAPI1', 'abc', NULL, 1, 2, 1, 7, 3, 2, 1, 1691603214, 1691604880, NULL),
(29, 'Test api 3', 1, NULL, 'ssssss', 'PRD-52560533', NULL, 1, 2, 1, 7, 3, 2, 1, 1691603506, 1692630028, NULL),
(35, 'Bach test', 3, NULL, '12asdc23', 'PRD-80659655', NULL, 2, 1, 7, 7, 43, 2, 1, 1691866678, 1691866678, NULL),
(37, 'bach test', 2, NULL, 'asdijc asdcuin', 'PRD-91160325', NULL, 2, 10, 4, 7, 42, 2, 1, 1692000653, 1692807978, NULL),
(39, 'bach test 2', 7, 16, 'iambatman', 'PRD-20796455', NULL, 3, 1, 7, 11, 43, 2, 1, 1692001196, 1692001256, NULL),
(41, 'test abc', 2, NULL, NULL, 'PRD-93024539', NULL, 1, 2, NULL, NULL, NULL, 2, 1, 1692891207, 1692891207, NULL),
(42, 'test abc - Vải thưa - Nilon cooton', 2, 41, ' -VV-niclc', 'PRD-78927926', NULL, 1, 2, NULL, NULL, NULL, 2, 1, 1692891207, 1692891207, NULL),
(43, 'test abc - Vải thưa - Nilon 2', 2, 41, ' -VV-NL2', 'PRD-35573966', NULL, 1, 2, NULL, NULL, NULL, 2, 1, 1692891207, 1692891207, NULL),
(44, 'aaaaaaa', 1, NULL, NULL, 'PRD-11142065', NULL, 1, 1, NULL, NULL, NULL, 2, 1, 1692891318, 1692891318, NULL),
(45, 'aaaaaaa - Vải thưa - Nilon 2', 1, 44, ' -VV-NL2', 'PRD-17050782', NULL, 1, 1, NULL, NULL, NULL, 2, 1, 1692891318, 1692891318, NULL),
(46, 'aaaaaaa - Vải thưa - Nilon1112312312312312', 1, 44, '-VV-NL1', 'PRD-30740569', NULL, 1, 1, NULL, NULL, NULL, 2, 1, 1692891318, 1694241685, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `pd_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `pd_import_price` decimal(25,3) DEFAULT NULL,
  `pd_vat` int(11) DEFAULT NULL,
  `pd_price` decimal(25,3) DEFAULT NULL,
  `pd_wholesale_price` decimal(25,3) DEFAULT NULL,
  `pd_old_price` decimal(25,3) DEFAULT NULL,
  `pd_shipping_weight` int(11) DEFAULT NULL,
  `pd_unit` varchar(255) DEFAULT NULL,
  `pd_lenght` int(11) DEFAULT NULL,
  `pd_width` int(11) DEFAULT NULL,
  `pd_height` int(11) DEFAULT NULL,
  `pd_image` varchar(255) DEFAULT NULL,
  `pd_tag` int(11) DEFAULT NULL,
  `pd_variant` int(11) DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`pd_id`, `prd_id`, `pd_import_price`, `pd_vat`, `pd_price`, `pd_wholesale_price`, `pd_old_price`, `pd_shipping_weight`, `pd_unit`, `pd_lenght`, `pd_width`, `pd_height`, `pd_image`, `pd_tag`, `pd_variant`, `groupid`) VALUES
(1, 3, 55555555.000, 10, 19000000.000, NULL, NULL, 150, 'Chiếc', 15, 15, 15, '822a368f42cb5c471c8ca785ebce312b.png', NULL, NULL, 2),
(2, 4, 9000000.000, 10, 19000000.000, NULL, NULL, 11, 'Chiếc', 12, 13, 14, '0b72ec5bf274b50445312b2b14138eb0.jpg', NULL, NULL, 2),
(3, 16, 80000.000, NULL, 90000.000, 85000.000, 85000.000, 100, 'Cái', 10, 20, 30, 'd2381fba68bd0ccc15d75373150187b3.jpg', NULL, NULL, 2),
(4, 17, 900000.000, NULL, 1000000.000, 950000.000, NULL, 900, NULL, 15, 15, 12, 'a182d0522d011660b4911a5fbf32e33d.jpeg', NULL, NULL, 2),
(5, 18, 900000.000, NULL, 1000000.000, 950000.000, NULL, 900, NULL, 15, 15, 12, 'a182d0522d011660b4911a5fbf32e33d.jpeg', NULL, NULL, 2),
(10, 23, 1180000.000, 10, 1280000.000, 1200000.000, 1200000.000, 900, NULL, 25, 15, 10, '66d875e7f653e3f7cc4388227d9c8c6f.jpg', NULL, NULL, 2),
(14, 27, 9000000.000, 10, 19000000.000, NULL, NULL, 150, 'Chiếc', 15, 15, 15, '37ec4a4a1109abcfb052e40f086aec31.jpg', NULL, NULL, 2),
(16, 29, 3333333.000, 10, 2222222.000, NULL, 1111111111.000, 150, 'Chiếc', 15, 15, 15, '064652bab87da334dbc534f2990db58d.jpeg', NULL, NULL, 2),
(22, 35, 12333.000, 8, 34343.000, 21313.000, 23234.000, 123, 'cái', 12, 1223, 123, '05a19ee919c2202e11e4d5b16245b15b.jpg', NULL, NULL, 2),
(24, 37, 123565.000, 9, 134141.000, 123412.000, 222245.000, 1233, 'cái', 12, 24, 54, '119ed40d99ccc8f2631f82574f6cac3f.jpg', NULL, NULL, 2),
(26, 39, 123544.000, 8, 123123.000, 13134.000, 45423.000, 333, 'cái', 123, 324, 434, '8a3588449408a23ff6590d7e7b2389d2.jpg', NULL, NULL, 2),
(28, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13f3f08c97d7c868f9c3a47c6b555560.jpg', NULL, NULL, 2),
(29, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13f3f08c97d7c868f9c3a47c6b555560.jpg', NULL, NULL, 2),
(30, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13f3f08c97d7c868f9c3a47c6b555560.jpg', NULL, NULL, 2),
(31, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '747c1fec043578fd52ff874dea2aa624.jpeg', NULL, NULL, 2),
(32, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '747c1fec043578fd52ff874dea2aa624.jpeg', NULL, NULL, 2),
(33, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '747c1fec043578fd52ff874dea2aa624.jpeg', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_of_package`
--

CREATE TABLE `product_of_package` (
  `pop_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `prd_id_pack` int(11) NOT NULL,
  `pop_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_position`
--

CREATE TABLE `product_position` (
  `id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT 2,
  `prd_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `postion_type` int(11) NOT NULL DEFAULT 1 COMMENT '1 là đưa vào,2 là đưa ra khỏi kho',
  `position_value` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `datecreated` int(15) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_position`
--

INSERT INTO `product_position` (`id`, `groupid`, `prd_id`, `warehouse_id`, `category_id`, `postion_type`, `position_value`, `quantity`, `datecreated`, `created_by`) VALUES
(3, 2, 16, 2, 0, 1, 'undefined', 1, 1691070180, 1),
(4, 2, 16, 1, 3, 1, 'hello bình thạnh', 1, 1691394578, 1),
(5, 2, 23, 1, 3, 1, 'hello bình thạnh', 40, 1691394578, 1),
(6, 2, 4, 1, 2, 1, 'hello bình thạnh', 1, 1691421846, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `prd_status_id` int(11) NOT NULL,
  `prd_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`prd_status_id`, `prd_status_name`) VALUES
(1, 'Mới'),
(2, 'Đang bán'),
(3, 'Ngừng bán'),
(4, 'Hết hàng');

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `ptag_id` int(11) NOT NULL,
  `ptag_name` varchar(255) NOT NULL,
  `ptag_color` varchar(255) DEFAULT NULL,
  `ptag_text_color` varchar(255) DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `prd_type_id` int(11) NOT NULL,
  `prd_type_name` text NOT NULL,
  `prd_type_active` int(11) DEFAULT 1 COMMENT '1 : active , 2 : inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`prd_type_id`, `prd_type_name`, `prd_type_active`) VALUES
(1, 'Sản phẩm', 1),
(2, 'Voucher', 1),
(3, 'Sản phẩm cân đo', 1),
(4, 'Sản phẩm theo IMEI', 1),
(5, 'Gói sản phẩm', 1),
(6, 'Dịch vụ', 1),
(7, 'Dụng cụ', 1),
(8, 'Sản phẩm bán theo Lô', 1),
(9, 'Combo', 1),
(10, 'Sản phẩm nhiều đơn vị tính', 1);

-- --------------------------------------------------------

--
-- Table structure for table `relation_product_tag`
--

CREATE TABLE `relation_product_tag` (
  `prd_id` int(11) NOT NULL,
  `ptag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relation_product_variant_value`
--

CREATE TABLE `relation_product_variant_value` (
  `prd_id` int(11) NOT NULL,
  `vv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relation_product_variant_value`
--

INSERT INTO `relation_product_variant_value` (`prd_id`, `vv_id`) VALUES
(4, 3),
(4, 5),
(17, 5),
(18, 5),
(23, 5),
(23, 7),
(27, 3),
(27, 5),
(35, 5),
(35, 7),
(35, 3),
(39, 5),
(39, 7),
(39, 4),
(29, 5),
(3, 5),
(42, 5),
(42, 6),
(43, 5),
(43, 7),
(44, 5),
(44, 6),
(45, 5),
(45, 7),
(46, 5),
(46, 8);

-- --------------------------------------------------------

--
-- Table structure for table `search_storage`
--

CREATE TABLE `search_storage` (
  `ss_id` int(11) NOT NULL,
  `ss_link` varchar(255) NOT NULL,
  `ss_content` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `sup_code` varchar(255) DEFAULT NULL,
  `sup_representative_name` varchar(255) DEFAULT NULL COMMENT 'Ten nguoi dai dien',
  `sup_representative_position` varchar(255) DEFAULT NULL COMMENT 'Vi tri nguoi dai dien',
  `sup_representative_mobile` varchar(255) DEFAULT NULL COMMENT 'SDT nguoi dai dien',
  `sup_tel` varchar(255) NOT NULL,
  `sup_email` varchar(255) DEFAULT NULL,
  `sup_address` varchar(255) DEFAULT NULL,
  `sup_tax_code` varchar(255) DEFAULT NULL,
  `sup_type_id` int(11) NOT NULL,
  `sup_personal_id` bigint(20) DEFAULT NULL,
  `sup_bank_name` varchar(255) DEFAULT NULL,
  `sup_bank_branch` varchar(255) DEFAULT NULL,
  `sup_bank_account_number` varchar(255) DEFAULT NULL,
  `sup_bank_account_holder` varchar(255) DEFAULT NULL,
  `sup_note` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sup_status` int(11) NOT NULL COMMENT '1 = Active, 2 = Inactive',
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sup_id`, `sup_name`, `sup_code`, `sup_representative_name`, `sup_representative_position`, `sup_representative_mobile`, `sup_tel`, `sup_email`, `sup_address`, `sup_tax_code`, `sup_type_id`, `sup_personal_id`, `sup_bank_name`, `sup_bank_branch`, `sup_bank_account_number`, `sup_bank_account_holder`, `sup_note`, `user_id`, `sup_status`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'NIKE', 'NIK-1', NULL, NULL, NULL, '0987773123', 'contact@nike.com', 'Cali', '23423423', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921376, 1688921376, NULL),
(4, 'Adidas store', 'ADIDAS-ST', NULL, NULL, NULL, '0987777777', 'adidas@gmail.com', 'France', '1231232', 1, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921413, 1688921413, NULL),
(5, 'Kingsport', 'King-sp', NULL, NULL, NULL, '0988888888', 'kingsp@gmail.com', 'Ho chi minh', NULL, 2, NULL, 'ACB', 'Huynh tan phat', '9990009999', 'King sport', 'khong co', 1, 1, 2, 1688921463, 1688921463, NULL),
(6, 'Test nhà cung cấp 1', 'CODE-01', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777888', 1, 98766666, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(7, 'Test nhà cung cấp 2', 'CODE-02', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777889', 1, 98766667, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(8, 'Test nhà cung cấp 3', 'CODE-03', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777890', 1, 98766668, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(9, 'Test nhà cung cấp 4', 'CODE-04', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777891', 1, 98766669, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(10, 'Test nhà cung cấp 5', 'CODE-05', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777892', 1, 98766670, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(11, 'Test nhà cung cấp 6', 'CODE-06', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777893', 1, 98766671, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(12, 'Test nhà cung cấp 7', 'CODE-07', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777894', 1, 1, 'a', NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(13, 'Test nhà cung cấp 8', 'CODE-08', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777895', 1, 98766673, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(14, 'Test nhà cung cấp 9', 'CODE-09', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777896', 1, 98766674, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(15, 'Test nhà cung cấp 10', 'CODE-10', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777897', 1, 98766675, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(16, 'Test nhà cung cấp 11', 'CODE-11', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777898', 1, 98766676, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(17, 'Test nhà cung cấp 12', 'CODE-12', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777899', 1, 98766677, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(18, 'Test nhà cung cấp 13', 'CODE-13', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777900', 1, 98766678, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(19, 'Test nhà cung cấp 14', 'CODE-14', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777901', 1, 98766679, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(20, 'Test nhà cung cấp 15', 'CODE-15', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777902', 1, 98766680, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(21, 'Test nhà cung cấp 16', 'CODE-16', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777903', 1, 98766681, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(22, 'Test nhà cung cấp 17', 'CODE-17', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777904', 1, 98766682, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(23, 'Test nhà cung cấp 18', 'CODE-18', NULL, NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777905', 1, 98766683, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921793, 1688921793, NULL),
(31, 'Test nhà cung cấp 8', 'CODE-08', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777895', 1, 98766673, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(32, 'Test nhà cung cấp 9', 'CODE-09', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777896', 1, 98766674, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(33, 'Test nhà cung cấp 10', 'CODE-10', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777897', 1, 98766675, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(34, 'Test nhà cung cấp 11', 'CODE-11', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777898', 1, 98766676, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(35, 'Test nhà cung cấp 12', 'CODE-12', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777899', 1, 98766677, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(36, 'Test nhà cung cấp 13', 'CODE-13', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777900', 1, 98766678, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(37, 'Test nhà cung cấp 14', 'CODE-14', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777901', 1, 98766679, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(38, 'Test nhà cung cấp 15', 'CODE-15', 'Dang abvc', NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777902', 1, 98766680, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(39, 'Test nhà cung cấp 16', 'CODE-16', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777903', 1, 98766681, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(40, 'Test nhà cung cấp 17', 'CODE-17', 'Hoang hai dang', NULL, NULL, '987773123', 'email2@gmail.com', 'Vũng tàu', '777904', 1, 98766682, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(41, 'Test nhà cung cấp 18', 'CODE-18', NULL, NULL, NULL, '987773123', 'email3@gmail.com', 'Đà nẵng', '777905', 1, 98766683, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688921915, 1688921915, NULL),
(42, 'Test nhà cung cấp 999', 'CODE-0999', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777888', 1, 98766666, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688922097, 1688922097, NULL),
(43, 'Test nhà cung cấp 999', 'CODE-0999', 'Dangqc', NULL, NULL, '987773123', 'email1@gmail.com', 'Hồ Chí Minh', '777888', 1, 98766666, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1688922142, 1688922142, NULL),
(55, 'TEST 22222', NULL, NULL, NULL, NULL, '0961174895', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, 1691637297, 1691637297, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_type`
--

CREATE TABLE `supplier_type` (
  `sup_type_id` int(11) NOT NULL,
  `sup_type_name` varchar(255) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `supplier_type`
--

INSERT INTO `supplier_type` (`sup_type_id`, `sup_type_name`, `groupid`) VALUES
(1, 'Cá nhân', 2),
(2, 'Doanh nghiệp', 2);

-- --------------------------------------------------------

--
-- Table structure for table `table_group`
--

CREATE TABLE `table_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_type` int(1) DEFAULT 3,
  `callerid` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tax_code` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `createby` varchar(50) DEFAULT NULL,
  `datecreate` int(11) DEFAULT NULL,
  `dateupdate` int(11) DEFAULT NULL,
  `external_hashcode` varchar(100) DEFAULT NULL COMMENT 'hashcode',
  `time_work_id` int(11) DEFAULT NULL COMMENT 'gio lam viec cua group',
  `date_register` date DEFAULT NULL,
  `date_expired` date DEFAULT NULL,
  `total_user` int(11) DEFAULT 0,
  `active` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `table_group`
--

INSERT INTO `table_group` (`id`, `group_name`, `group_type`, `callerid`, `description`, `tax_code`, `address`, `email`, `phone`, `fax`, `website`, `bank_account_number`, `bank_name`, `createby`, `datecreate`, `dateupdate`, `external_hashcode`, `time_work_id`, `date_register`, `date_expired`, `total_user`, `active`) VALUES
(2, 'Auca Dev Feature', 3, NULL, 'ădawdawd', '3232163131', NULL, 'sss@gmail.com', NULL, NULL, NULL, NULL, NULL, '13', 1610071372, 1634700690, '45023b46344a0f3e955eb701afca9c34', 13, '2021-01-08', '2022-02-26', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_user_type`
--

CREATE TABLE `table_user_type` (
  `id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `name` varchar(765) DEFAULT NULL,
  `summary` varchar(765) DEFAULT NULL,
  `public` char(21) DEFAULT NULL,
  `type` enum('admin','group') DEFAULT NULL,
  `datecreate` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `table_user_type`
--

INSERT INTO `table_user_type` (`id`, `groupid`, `name`, `summary`, `public`, `type`, `datecreate`) VALUES
(352, 2, 'test role', 'đừng xóa role này (dùng để test)', 'active', 'group', '1688981829');

-- --------------------------------------------------------

--
-- Table structure for table `table_user_type_detail`
--

CREATE TABLE `table_user_type_detail` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `action` enum('view','add','edit','delete','export','view_data') DEFAULT NULL,
  `page` varchar(765) DEFAULT NULL,
  `datecreate` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `table_user_type_detail`
--

INSERT INTO `table_user_type_detail` (`id`, `type_id`, `action`, `page`, `datecreate`) VALUES
(190338, 352, 'view', 'brand', NULL),
(190339, 352, 'add', 'product', NULL),
(190341, 352, 'edit', 'variantgroup', '1688632525'),
(190342, 352, 'view', 'variantvalue', '1688632525'),
(190343, 352, 'delete', 'variantvalue', '1688632526'),
(190344, 422, 'view', 'product', '1688980991'),
(190345, 422, 'add', 'brand', '1688980992'),
(190346, 422, 'add', 'variantgroup', '1688980993'),
(190347, 422, 'edit', 'variantgroup', '1688980994'),
(190348, 422, 'edit', 'variantvalue', '1688980995'),
(190349, 422, 'add', 'variantvalue', '1688980995'),
(190354, 19, 'view', 'variantvalue', '1688981227'),
(190364, 425, 'add', 'permission', '1688981454'),
(190368, 425, 'add', 'variantgroup', '1688981457'),
(190373, 425, 'add', 'variantvalue', '1688981469');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_account`
--

CREATE TABLE `transfer_account` (
  `ta_id` int(11) NOT NULL,
  `ta_code` varchar(255) NOT NULL,
  `ta_name` varchar(255) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `transfer_account`
--

INSERT INTO `transfer_account` (`ta_id`, `ta_code`, `ta_name`, `groupid`) VALUES
(1, '1112.1', 'Vietcombank', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_tel` varchar(255) DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_country` varchar(255) DEFAULT NULL,
  `user_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','supervisor','agent','groupadmin') DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `user_type_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_tel`, `user_birthday`, `user_country`, `user_token`, `created_at`, `updated_at`, `deleted_at`, `password`, `level`, `groupid`, `user_type_id`) VALUES
(1, 'hoanghaidang', 'hoanghaidang.dev@gmail.com', NULL, NULL, NULL, NULL, '2023-06-25 13:08:13', '2023-06-25 13:08:13', NULL, '$2y$10$zg916uPt.eRIc9AzQjZNYOYMOcUx/wGQQu5P5/uRVL0riIwHB1Wgu', 'admin', 2, 19),
(2, 'hoanghaidang', 'xicoi1033@gmail.com', NULL, NULL, NULL, NULL, '2023-06-25 13:08:13', '2023-06-25 13:08:13', NULL, '$2y$10$zg916uPt.eRIc9AzQjZNYOYMOcUx/wGQQu5P5/uRVL0riIwHB1Wgu', 'agent', 2, 352),
(3, 'admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, '2023-07-10 16:53:57', '2023-07-10 16:53:57', NULL, '$2y$10$zg916uPt.eRIc9AzQjZNYOYMOcUx/wGQQu5P5/uRVL0riIwHB1Wgu', 'admin', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `varian`
--

CREATE TABLE `varian` (
  `var_id` int(11) NOT NULL,
  `vg_id` int(11) DEFAULT NULL COMMENT 'Variant group',
  `var_parent_id` int(11) DEFAULT NULL,
  `var_name` varchar(255) NOT NULL,
  `var_code` varchar(255) NOT NULL,
  `var_type` enum('Select','Text','Checkbox','Number') NOT NULL COMMENT 'Type value',
  `var_unit` varchar(255) DEFAULT NULL,
  `var_order` int(11) DEFAULT NULL,
  `var_description` varchar(255) DEFAULT NULL,
  `var_require` enum('Y','N') DEFAULT NULL COMMENT 'phai nhap',
  `var_searchable` enum('Y','N') DEFAULT NULL COMMENT 'co the tim kiem',
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL,
  `created_at` int(1) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `varian`
--

INSERT INTO `varian` (`var_id`, `vg_id`, `var_parent_id`, `var_name`, `var_code`, `var_type`, `var_unit`, `var_order`, `var_description`, `var_require`, `var_searchable`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 3, NULL, 'Màu sáng', 'MS', 'Text', NULL, 1, NULL, 'N', 'N', 1, 2, 1688220729, 1688220729, NULL),
(7, 45, NULL, 'Vải', 'VAI', 'Text', NULL, 2, NULL, 'N', 'N', 1, 2, 1688284081, 1688284081, NULL),
(8, 45, NULL, 'Nilon', 'NILON', 'Text', NULL, 3, NULL, 'N', 'N', 1, 2, 1688284119, 1688284119, NULL),
(9, 44, NULL, 'Áo len', 'AOLEN', 'Text', NULL, 4, NULL, 'N', 'N', 1, 2, 1688284142, 1688284142, NULL),
(10, 44, NULL, 'Áo sơmi', 'AOSOMI', 'Text', NULL, 5, NULL, 'N', 'N', 1, 2, 1688284171, 1688284171, NULL),
(11, 43, NULL, 'Đế bằng', 'DEBANG', 'Text', NULL, 2, NULL, 'N', 'N', 1, 2, 1688284188, 1688284188, NULL),
(12, 43, NULL, 'Đế địa hình', 'DEDIAHINH', 'Text', NULL, 2, NULL, 'N', 'N', 1, 2, 1688284215, 1688284215, NULL),
(13, 42, NULL, 'Quai ngang', 'QUAINGANG', 'Text', 'Cái', 0, 'Quai dành cho dép lào', 'N', 'N', 1, 2, 1688284238, 1688799951, NULL),
(14, NULL, NULL, 'Test thuộc tính khác group', 'testkhacgroup', 'Text', NULL, NULL, NULL, 'Y', 'Y', 1, 999, 1688488114, 1688488114, NULL),
(15, NULL, NULL, 'sdsd', 'adasdasd', 'Select', NULL, 1, NULL, 'N', 'N', 1, 2, 1689069439, 1689069439, NULL),
(16, 7, NULL, 'ada', 'adasdad', 'Select', NULL, 1, NULL, 'N', 'N', 1, 2, 1689069445, 1692721853, NULL),
(18, 7, 7, 'co ao skjsk', 'sozk', 'Select', 'cái', 3, 'co ap dep', 'N', 'Y', 1, 2, 1692000307, 1692000307, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant_category`
--

CREATE TABLE `variant_category` (
  `cat_id` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant_category`
--

INSERT INTO `variant_category` (`cat_id`, `var_id`, `groupid`) VALUES
(1, 7, 2),
(2, 7, 2),
(1, 8, 2),
(2, 8, 2),
(1, 9, 2),
(1, 10, 2),
(2, 11, 2),
(2, 12, 2),
(1, 14, 2),
(2, 14, 2),
(1, 14, 2),
(2, 14, 2),
(2, 13, 2),
(1, 15, 2),
(2, 15, 2),
(1, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `variant_group`
--

CREATE TABLE `variant_group` (
  `vg_id` int(11) NOT NULL,
  `vg_name` varchar(255) NOT NULL,
  `vg_order` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `variant_group`
--

INSERT INTO `variant_group` (`vg_id`, `vg_name`, `vg_order`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Chiều cao', 1, 1, 2, 1688026235, 1688026235, NULL),
(7, 'Loại cổ áo', 2, 1, 2, 1688026245, 1688026245, NULL),
(8, 'Loại cúc áo', 3, 1, 2, 1688026249, 1688109274, NULL),
(9, 'Loại ống quần', 4, 1, 2, 1688026259, 1688026259, NULL),
(40, 'Màu sắc', 2, 1, 2, 1688283987, 1688283987, NULL),
(41, 'Kích cỡ', 1, 1, 2, 1688283992, 1688283992, NULL),
(42, 'Loại Quai', 1, 1, 2, 1688283999, 1688283999, NULL),
(43, 'Loại Đế', NULL, 1, 2, 1688284005, 1688284005, NULL),
(44, 'Kiểu áo', NULL, 1, 2, 1688284015, 1688284015, NULL),
(45, 'Chất liệu', 1, 1, 2, 1688284022, 1688284022, NULL),
(48, 'Đồ chơi trẻ em', 1, 3, 2, 1688983321, 1688994190, NULL),
(49, 'Phụ kiện xe hơi', 2, 1, 2, 1688993955, 1688993955, NULL),
(50, 'Phụ kiện xe hơi', 3, 1, 2, 1688993957, 1688993957, NULL),
(51, 'Phụ kiện xe máy', 4, 1, 2, 1688993967, 1688993967, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant_value`
--

CREATE TABLE `variant_value` (
  `vv_id` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `vv_parent_id` int(11) DEFAULT NULL,
  `vv_name` varchar(255) NOT NULL,
  `vv_value` text DEFAULT NULL,
  `vv_other_name` varchar(255) DEFAULT NULL,
  `vv_code` varchar(255) DEFAULT NULL,
  `vv_other_code` varchar(255) DEFAULT NULL,
  `vv_unit` varchar(255) DEFAULT NULL,
  `vv_order` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant_value`
--

INSERT INTO `variant_value` (`vv_id`, `var_id`, `vv_parent_id`, `vv_name`, `vv_value`, `vv_other_name`, `vv_code`, `vv_other_code`, `vv_unit`, `vv_order`, `user_id`, `groupid`) VALUES
(3, 9, NULL, 'Áo len dài tay', 'aolendaitay', NULL, NULL, NULL, NULL, NULL, 1, 2),
(4, 9, NULL, 'Áo len ngắn tay', 'aolenngantay', NULL, NULL, NULL, NULL, NULL, 1, 2),
(5, 7, NULL, 'Vải thưa', 'vaithua', NULL, 'VV', NULL, NULL, NULL, 1, 2),
(6, 8, NULL, 'Nilon cooton', 'Niloncotton', NULL, 'niclc', NULL, NULL, NULL, 1, 2),
(7, 8, NULL, 'Nilon 2', 'nilon2', NULL, 'NL2', NULL, NULL, NULL, 1, 2),
(8, 8, NULL, 'Nilon1', 'Nilon1', NULL, 'NL1', NULL, NULL, NULL, 1, 2),
(9, 7, NULL, 'Vải dày', 'vaiday', NULL, 'vday', NULL, NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `w_id` int(11) NOT NULL,
  `w_name` text NOT NULL,
  `w_mobile` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `w_country_id` int(11) DEFAULT NULL,
  `w_country_iso` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `w_city_id` int(11) DEFAULT NULL,
  `w_city_name` varchar(255) DEFAULT NULL,
  `w_district_id` int(11) DEFAULT NULL,
  `w_district_name` varchar(255) DEFAULT NULL,
  `w_ward_id` int(11) DEFAULT NULL,
  `w_ward_name` varchar(255) DEFAULT NULL,
  `w_address` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `groupid` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`w_id`, `w_name`, `w_mobile`, `w_country_id`, `w_country_iso`, `w_city_id`, `w_city_name`, `w_district_id`, `w_district_name`, `w_ward_id`, `w_ward_name`, `w_address`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Âu ca HCM 1', '0987773123', 232, 'VN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1687941848, 1687941848, NULL),
(2, 'Âu ca HCM 2', '0987773123', 232, 'VN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1687941848, 1687941848, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_bill`
--

CREATE TABLE `warehouse_bill` (
  `wb_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL COMMENT 'Kho',
  `wtrans_id` int(15) DEFAULT NULL,
  `wb_type` enum('Import','Export') NOT NULL COMMENT 'import/export',
  `wb_mode` int(11) NOT NULL COMMENT 'warehouse bill mode',
  `sup_id` int(11) DEFAULT NULL,
  `wb_customer_name` varchar(255) DEFAULT NULL,
  `wb_customer_tel` varchar(255) DEFAULT NULL,
  `wb_description` text DEFAULT NULL,
  `wb_manual_discount_type` enum('Money','Percent') DEFAULT 'Money',
  `wb_manual_discount` decimal(25,3) DEFAULT NULL,
  `wb_total_money` decimal(25,3) DEFAULT NULL,
  `wb_money` decimal(25,3) DEFAULT NULL,
  `ca_id` int(11) DEFAULT NULL COMMENT 'cash account',
  `wb_money_transfer` decimal(25,3) DEFAULT NULL,
  `ta_id` int(11) DEFAULT NULL COMMENT 'transfer account',
  `wb_from_w` int(15) DEFAULT NULL,
  `wb_to_w` int(15) DEFAULT NULL,
  `wb_debt_due_date` datetime DEFAULT NULL,
  `wb_vat_type` enum('Percent','Money') DEFAULT NULL,
  `wb_vat_value` decimal(25,3) DEFAULT 0.000 COMMENT 'Gia tri VAT',
  `wb_tax_bill_code` varchar(255) DEFAULT NULL COMMENT 'So hoa don VAT',
  `wb_tax_bill_date` date DEFAULT NULL COMMENT 'Ngay xuat hoa don VAT',
  `user_id` int(11) NOT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `warehouse_bill`
--

INSERT INTO `warehouse_bill` (`wb_id`, `w_id`, `wtrans_id`, `wb_type`, `wb_mode`, `sup_id`, `wb_customer_name`, `wb_customer_tel`, `wb_description`, `wb_manual_discount_type`, `wb_manual_discount`, `wb_total_money`, `wb_money`, `ca_id`, `wb_money_transfer`, `ta_id`, `wb_from_w`, `wb_to_w`, `wb_debt_due_date`, `wb_vat_type`, `wb_vat_value`, `wb_tax_bill_code`, `wb_tax_bill_date`, `user_id`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Import', 1, NULL, NULL, NULL, 'Nhập khi tạo sản phẩm', NULL, NULL, 118000000.000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 1691259916, 1691259916, NULL),
(2, 1, NULL, 'Import', 1, 3, NULL, NULL, 'Nhập khi tạo sản phẩm', NULL, NULL, 900000000.000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 1691603214, 1691603214, NULL),
(3, 1, NULL, 'Import', 1, 3, NULL, NULL, 'Nhập khi tạo sản phẩm', NULL, NULL, 900000000.000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 1691603506, 1691603506, NULL),
(4, 1, NULL, 'Import', 1, 43, NULL, NULL, 'Nhập tồn đầu khi thêm sản phẩm mới có thuộc tính', NULL, NULL, 1547280.000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 1691866678, 1691866678, NULL),
(5, 1, NULL, 'Import', 1, 42, NULL, NULL, 'Nhập tồn đầu khi thêm sản phẩm mới có thuộc tính', NULL, NULL, 2864259.000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 1692000653, 1692000653, NULL),
(6, 2, NULL, 'Import', 1, 43, NULL, NULL, 'Nhập khi tạo sản phẩm', NULL, NULL, 152082664.000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 1692001196, 1692001196, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_bill_mode`
--

CREATE TABLE `warehouse_bill_mode` (
  `wbm_id` int(11) NOT NULL,
  `wbm_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_bill_mode`
--

INSERT INTO `warehouse_bill_mode` (`wbm_id`, `wbm_name`) VALUES
(1, 'nhà cung cấp'),
(2, 'khác'),
(3, 'chuuyển kho'),
(4, 'giao hàng'),
(5, 'bán lẻ'),
(6, 'bán sỉ'),
(7, 'tặng kèm (bán lẻ)'),
(8, 'tặng kèm (giao hàng)'),
(9, 'tặng kèm (bán sỉ)'),
(10, 'bù trừ kiểm kho'),
(11, 'bảo hành'),
(12, 'sửa chữa'),
(13, 'linh kiện bảo hành'),
(14, 'combo');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_bill_product`
--

CREATE TABLE `warehouse_bill_product` (
  `wbp_id` int(11) NOT NULL,
  `wb_id` int(11) NOT NULL COMMENT 'warehouse_bill',
  `prd_id` int(11) NOT NULL COMMENT 'Product',
  `wbp_quantity` int(11) NOT NULL,
  `wbp_quantity_defective` int(11) DEFAULT NULL COMMENT 'so luong san pham loi ',
  `wbp_price` decimal(25,3) DEFAULT NULL,
  `wbp_discount_type` enum('Money','Percent') DEFAULT NULL,
  `wbp_discount_value` decimal(25,3) DEFAULT NULL,
  `wbp_discount_money` decimal(25,3) DEFAULT 0.000,
  `wbp_shipping_weight` decimal(25,3) DEFAULT NULL,
  `wbp_note` text DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `warehouse_bill_product`
--

INSERT INTO `warehouse_bill_product` (`wbp_id`, `wb_id`, `prd_id`, `wbp_quantity`, `wbp_quantity_defective`, `wbp_price`, `wbp_discount_type`, `wbp_discount_value`, `wbp_discount_money`, `wbp_shipping_weight`, `wbp_note`, `groupid`) VALUES
(1, 1, 23, 100, 0, 1180000.000, 'Money', 0.000, 0.000, 900.000, '', 2),
(2, 2, 27, 100, 0, 9000000.000, 'Money', 0.000, 0.000, 150.000, '', 2),
(3, 3, 29, 100, 0, 9000000.000, 'Money', 0.000, 0.000, 150.000, '', 2),
(4, 4, 35, 12, 0, 128940.000, 'Money', 0.000, 0.000, 23.000, '', 2),
(5, 5, 37, 1233, 0, 2323.000, 'Money', 0.000, 0.000, 1414.000, '', 2),
(6, 6, 39, 1231, 0, 123544.000, 'Money', 0.000, 0.000, 333.000, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_product`
--

CREATE TABLE `warehouse_product` (
  `wp_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `wp_quantity` int(11) NOT NULL,
  `wp_quantity_defective` int(11) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_product`
--

INSERT INTO `warehouse_product` (`wp_id`, `w_id`, `prd_id`, `wp_quantity`, `wp_quantity_defective`, `groupid`) VALUES
(1, 1, 23, 100, 0, 2),
(2, 1, 27, 100, 0, 2),
(3, 1, 29, 100, 0, 2),
(4, 1, 35, 12, 0, 2),
(5, 1, 37, 1233, 0, 2),
(6, 2, 39, 1231, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_product_archive`
--

CREATE TABLE `warehouse_product_archive` (
  `wpa_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `wpa_min` int(11) NOT NULL,
  `wpa_max` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_tag`
--

CREATE TABLE `warehouse_tag` (
  `wtag_id` int(11) NOT NULL,
  `wtag_name` varchar(255) NOT NULL,
  `wtag_color` varchar(255) DEFAULT NULL,
  `wtag_text_color` varchar(255) DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_transfer`
--

CREATE TABLE `warehouse_transfer` (
  `wtrans_id` int(11) NOT NULL,
  `wtrans_from_w_id` int(11) NOT NULL COMMENT 'from warehouse',
  `wtrans_to_w_id` int(11) NOT NULL COMMENT 'to warehouse',
  `wtrans_tag` text DEFAULT NULL,
  `wtrans_status` varchar(50) NOT NULL DEFAULT 'draft',
  `wtrans_description` text DEFAULT NULL,
  `wtrans_file` text DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `accepted_by` int(11) DEFAULT NULL,
  `accepted_at` int(15) DEFAULT NULL,
  `confirm_at` int(15) DEFAULT NULL,
  `confirm_by` int(15) DEFAULT NULL,
  `created_by` int(15) DEFAULT NULL,
  `created_at` int(15) DEFAULT NULL,
  `updated_at` int(15) DEFAULT NULL,
  `deleted_at` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `warehouse_transfer`
--

INSERT INTO `warehouse_transfer` (`wtrans_id`, `wtrans_from_w_id`, `wtrans_to_w_id`, `wtrans_tag`, `wtrans_status`, `wtrans_description`, `wtrans_file`, `groupid`, `accepted_by`, `accepted_at`, `confirm_at`, `confirm_by`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, NULL, 'draft', '', NULL, 2, NULL, NULL, NULL, NULL, 1, 1692094150, NULL, NULL),
(2, 1, 2, NULL, 'draft', '', NULL, 2, NULL, NULL, NULL, NULL, 1, 1692094150, NULL, NULL),
(3, 1, 2, NULL, 'draft', 'aaaaaaaaa', NULL, 2, NULL, NULL, NULL, NULL, 1, 1692630920, NULL, NULL),
(4, 1, 2, NULL, 'draft', 'awdwaddwa', NULL, 2, NULL, NULL, NULL, NULL, 1, 1693454008, NULL, NULL),
(5, 1, 2, NULL, 'draft', 'uiiefbioeqf', NULL, 2, NULL, NULL, NULL, NULL, 3, 1693898084, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_transfer_product`
--

CREATE TABLE `warehouse_transfer_product` (
  `wtp_id` int(11) NOT NULL,
  `wht_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL COMMENT 'product id',
  `wtp_price` decimal(25,3) NOT NULL COMMENT 'price of 1 product',
  `wtp_quantity` int(11) NOT NULL,
  `wtp_discount_type` enum('Percent','Money') NOT NULL DEFAULT 'Money',
  `wtp_discount` decimal(25,3) DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `wtp_quantity_defective` int(11) DEFAULT NULL COMMENT 'san pham loi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `warehouse_transfer_product`
--

INSERT INTO `warehouse_transfer_product` (`wtp_id`, `wht_id`, `prd_id`, `wtp_price`, `wtp_quantity`, `wtp_discount_type`, `wtp_discount`, `groupid`, `wtp_quantity_defective`) VALUES
(1, 2, 27, 19000000.000, 50, 'Money', NULL, 2, 0),
(2, 3, 23, 1280000.000, 1, 'Money', NULL, 2, 0),
(3, 4, 23, 1280000.000, 100, 'Money', NULL, 2, 0),
(4, 5, 23, 1280000.000, 1, 'Money', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `warranty`
--

CREATE TABLE `warranty` (
  `wa_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL COMMENT 'Product id',
  `country_iso` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `wa_address` varchar(255) DEFAULT NULL,
  `wa_tel` varchar(255) DEFAULT NULL,
  `wa_num_month` int(11) DEFAULT NULL COMMENT 'number of months\r\n',
  `wa_content` text DEFAULT NULL,
  `groupid` int(15) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`wa_id`, `prd_id`, `country_iso`, `country_id`, `wa_address`, `wa_tel`, `wa_num_month`, `wa_content`, `groupid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, '', NULL, 'Huỳnh tấn phát HCM', '987773123', 1, '<p>Bảo hành test cho sản phẩm test api 1</p>', 2, 1690302223, 1692808021, NULL),
(2, 4, 'VN', 232, 'Huỳnh tấn phát HCM', '0987773123', 1, '<p>Bảo hành test cho sản phẩm test api 1</p>', 2, 1690302223, 1690302223, NULL),
(3, 16, 'CN', 44, 'HCM', NULL, NULL, NULL, 2, 1690996165, 1690996165, NULL),
(4, 17, 'VN', 232, 'HO CHI MINH', '987773412', 12, '<p><strong>BAO HANH</strong></p>', 2, 1691085841, 1691085841, NULL),
(5, 18, 'VN', 232, 'HO CHI MINH', '987773412', 12, '<p><strong>BAO HANH</strong></p>', 2, 1691085841, 1691085841, NULL),
(10, 23, 'CN', 44, 'HCM', '987773123', 12, '<p>ădawdawdaw</p>', 2, 1691259916, 1691259916, NULL),
(14, 27, 'VN', 232, 'Huỳnh tấn phát HCM', '123', 1, '<p>Bảo hành test cho sản phẩm test api 1</p>', 2, 1691603214, 1691604880, NULL),
(16, 29, '', NULL, 'Huỳnh tấn phát HCM', '12312312', 1, '<p>Bảo hành test cho sản phẩm test api 1</p>', 2, 1691603506, 1692630028, NULL),
(22, 35, 'VN', 232, 'quang trung', '396262888', 14, '<ol><li><i><strong>qwedq qwedq</strong></i></li><li><i><strong>sadcj</strong></i></li><li><i><strong>ascdim</strong></i></li><li><i><strong>asdcm</strong></i></li></ol>', 2, 1691866678, 1691866678, NULL),
(24, 37, '', NULL, 'quang trung', '396262888', 13, '<ul><li><i><strong>sdc</strong></i></li><li><i><strong>asdcn aosdc</strong></i></li><li><i><strong>laskc</strong></i></li><li><i><strong>jkasdcnlasc</strong></i></li><li><i><strong>asdc</strong></i></li></ul>', 2, 1692000653, 1692807978, NULL),
(26, 39, 'AL', 2, 'quanas asodcjn', '396262888', 15, '<ul><li>asdc</li><li>ascndal</li><li>asujcn]asdcn</li><li>]ujasncods</li></ul>', 2, 1692001196, 1692001256, NULL),
(28, 41, '', NULL, NULL, NULL, NULL, NULL, 2, 1692891207, 1692891207, NULL),
(29, 42, '', NULL, NULL, NULL, NULL, NULL, 2, 1692891207, 1692891207, NULL),
(30, 43, '', NULL, NULL, NULL, NULL, NULL, 2, 1692891207, 1692891207, NULL),
(31, 44, '', NULL, NULL, NULL, NULL, NULL, 2, 1692891318, 1692891318, NULL),
(32, 45, '', NULL, NULL, NULL, NULL, NULL, 2, 1692891318, 1692891318, NULL),
(33, 46, '', NULL, NULL, NULL, NULL, NULL, 2, 1692891318, 1692891318, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `batch_product`
--
ALTER TABLE `batch_product`
  ADD PRIMARY KEY (`bp_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cash_account`
--
ALTER TABLE `cash_account`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `category_internal`
--
ALTER TABLE `category_internal`
  ADD PRIMARY KEY (`cat_inter_id`);

--
-- Indexes for table `cat_tag`
--
ALTER TABLE `cat_tag`
  ADD PRIMARY KEY (`ctag_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`depot_id`);

--
-- Indexes for table `inventory_check`
--
ALTER TABLE `inventory_check`
  ADD PRIMARY KEY (`ic_id`);

--
-- Indexes for table `inventory_check_product`
--
ALTER TABLE `inventory_check_product`
  ADD PRIMARY KEY (`icp_id`);

--
-- Indexes for table `log_product`
--
ALTER TABLE `log_product`
  ADD PRIMARY KEY (`log_prd_id`);

--
-- Indexes for table `position_category`
--
ALTER TABLE `position_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prd_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `product_of_package`
--
ALTER TABLE `product_of_package`
  ADD PRIMARY KEY (`pop_id`);

--
-- Indexes for table `product_position`
--
ALTER TABLE `product_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`prd_status_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`ptag_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`prd_type_id`);

--
-- Indexes for table `search_storage`
--
ALTER TABLE `search_storage`
  ADD PRIMARY KEY (`ss_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `supplier_type`
--
ALTER TABLE `supplier_type`
  ADD PRIMARY KEY (`sup_type_id`);

--
-- Indexes for table `table_group`
--
ALTER TABLE `table_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_user_type`
--
ALTER TABLE `table_user_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupid` (`groupid`);

--
-- Indexes for table `table_user_type_detail`
--
ALTER TABLE `table_user_type_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `transfer_account`
--
ALTER TABLE `transfer_account`
  ADD PRIMARY KEY (`ta_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `varian`
--
ALTER TABLE `varian`
  ADD PRIMARY KEY (`var_id`);

--
-- Indexes for table `variant_group`
--
ALTER TABLE `variant_group`
  ADD PRIMARY KEY (`vg_id`);

--
-- Indexes for table `variant_value`
--
ALTER TABLE `variant_value`
  ADD PRIMARY KEY (`vv_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`w_id`);

--
-- Indexes for table `warehouse_bill`
--
ALTER TABLE `warehouse_bill`
  ADD PRIMARY KEY (`wb_id`);

--
-- Indexes for table `warehouse_bill_mode`
--
ALTER TABLE `warehouse_bill_mode`
  ADD PRIMARY KEY (`wbm_id`);

--
-- Indexes for table `warehouse_bill_product`
--
ALTER TABLE `warehouse_bill_product`
  ADD PRIMARY KEY (`wbp_id`);

--
-- Indexes for table `warehouse_product`
--
ALTER TABLE `warehouse_product`
  ADD PRIMARY KEY (`wp_id`);

--
-- Indexes for table `warehouse_product_archive`
--
ALTER TABLE `warehouse_product_archive`
  ADD PRIMARY KEY (`wpa_id`);

--
-- Indexes for table `warehouse_tag`
--
ALTER TABLE `warehouse_tag`
  ADD PRIMARY KEY (`wtag_id`);

--
-- Indexes for table `warehouse_transfer`
--
ALTER TABLE `warehouse_transfer`
  ADD PRIMARY KEY (`wtrans_id`);

--
-- Indexes for table `warehouse_transfer_product`
--
ALTER TABLE `warehouse_transfer_product`
  ADD PRIMARY KEY (`wtp_id`);

--
-- Indexes for table `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`wa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `batch_product`
--
ALTER TABLE `batch_product`
  MODIFY `bp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cash_account`
--
ALTER TABLE `cash_account`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category_internal`
--
ALTER TABLE `category_internal`
  MODIFY `cat_inter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cat_tag`
--
ALTER TABLE `cat_tag`
  MODIFY `ctag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `depot`
--
ALTER TABLE `depot`
  MODIFY `depot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_check`
--
ALTER TABLE `inventory_check`
  MODIFY `ic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_check_product`
--
ALTER TABLE `inventory_check_product`
  MODIFY `icp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_product`
--
ALTER TABLE `log_product`
  MODIFY `log_prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `position_category`
--
ALTER TABLE `position_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_of_package`
--
ALTER TABLE `product_of_package`
  MODIFY `pop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_position`
--
ALTER TABLE `product_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `prd_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `ptag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `prd_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `search_storage`
--
ALTER TABLE `search_storage`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `supplier_type`
--
ALTER TABLE `supplier_type`
  MODIFY `sup_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_group`
--
ALTER TABLE `table_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `table_user_type`
--
ALTER TABLE `table_user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `table_user_type_detail`
--
ALTER TABLE `table_user_type_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190379;

--
-- AUTO_INCREMENT for table `transfer_account`
--
ALTER TABLE `transfer_account`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `varian`
--
ALTER TABLE `varian`
  MODIFY `var_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `variant_group`
--
ALTER TABLE `variant_group`
  MODIFY `vg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `variant_value`
--
ALTER TABLE `variant_value`
  MODIFY `vv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse_bill`
--
ALTER TABLE `warehouse_bill`
  MODIFY `wb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warehouse_bill_mode`
--
ALTER TABLE `warehouse_bill_mode`
  MODIFY `wbm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `warehouse_bill_product`
--
ALTER TABLE `warehouse_bill_product`
  MODIFY `wbp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warehouse_product`
--
ALTER TABLE `warehouse_product`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warehouse_product_archive`
--
ALTER TABLE `warehouse_product_archive`
  MODIFY `wpa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_tag`
--
ALTER TABLE `warehouse_tag`
  MODIFY `wtag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_transfer`
--
ALTER TABLE `warehouse_transfer`
  MODIFY `wtrans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouse_transfer_product`
--
ALTER TABLE `warehouse_transfer_product`
  MODIFY `wtp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warranty`
--
ALTER TABLE `warranty`
  MODIFY `wa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
