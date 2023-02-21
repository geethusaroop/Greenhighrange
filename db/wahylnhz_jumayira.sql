-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2019 at 12:36 PM
-- Server version: 5.6.41-84.1-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wahylnhz_jumayira`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(25) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_address` text NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `tin_no` varchar(255) NOT NULL,
  `gstin_no` varchar(50) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `user_name`, `admin_email`, `admin_password`, `shop_name`, `shop_address`, `user_type`, `tin_no`, `gstin_no`, `phone_no`, `created_date`, `updated_date`, `user_status`) VALUES
(1, 'admin', 'marvins@gmail.com', 'admin1234!', 'TKR Residency', ' Behind Changampuzha Park Metro Station, Mamangalam, Edappally, Kochi, Kerala 682024', 'A', 'ANFG2341234', '32ARSPK8864B1ZJ', '9656905555', '2017-12-11 16:23:47', '2017-12-11 11:11:44', 0),
(2, 'Maiz', '', 'qwerty', '', '', 'user', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'wrer', '', 'asd', '', '', 'user', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'hari', '', 'hari2018', '', '', 'user', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 'shameer', '', 'terminated', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `book_id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `child` bigint(20) NOT NULL,
  `adults` bigint(20) NOT NULL,
  `mobnum` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`book_id`, `customer_name`, `startdate`, `enddate`, `child`, `adults`, `mobnum`, `email`, `status`) VALUES
(1, '', '2018-12-21', '2018-12-28', 2, 3, 9048048024, 'info@wahylab.com', 1),
(2, '', '2018-12-14', '2018-12-27', 3, 3, 9048048024, 'info@wahylab.com', 1),
(3, '', '2018-12-16', '2018-12-19', 1, 2, 8891155994, 'ivin.appu@gmail.com', 1),
(4, '', '2018-12-16', '2018-12-19', 1, 2, 8891155994, 'ivin.appu@gmail.com', 1),
(5, '', '2018-12-13', '2018-12-22', 1, 2, 8891155994, 'so01.wahylab@gmail.com', 1),
(6, '', '2018-12-17', '2018-12-18', 1, 1, 0, '', 1),
(7, '', '2018-12-17', '2018-12-18', 1, 1, 8111846660, 'aaarshadkhan@gmail.com', 1),
(8, '', '2018-12-20', '2018-12-22', 1, 1, 8111846660, 'aaarshadkhan@gmail.com', 1),
(9, '', '1970-01-01', '1970-01-01', 0, 0, 0, '', 1),
(10, '', '2018-12-19', '2018-12-21', 1, 2, 8111846667, 'aaarshadkhan@gmail.com', 1),
(11, '', '2018-12-20', '2018-12-22', 1, 2, 8111846662, 'aaarshadkhan@gmail.com', 1),
(12, '', '2018-12-12', '2018-12-20', 2, 2, 9048048024, 'info@wahylab.com', 1),
(13, 'dfgfdgfdgfdgfdg', '2018-12-12', '2018-12-20', 3, 2, 9048048024, 'info@wahylab.com', 1),
(14, '', '1970-01-01', '1970-01-01', 1, 1, 0, '', 1),
(15, 'Arshad Khan', '2018-12-19', '2018-12-20', 1, 1, 8111846660, 'aaarshadkhan@gmail.com', 1),
(16, '', '2018-12-19', '2018-12-20', 1, 1, 8111846660, 'aaarshadkhan@gmail.com', 1),
(17, '', '2018-12-13', '2018-12-13', 2, 2, 9048048024, 'info@wahylab.com', 1),
(18, 'dfgfdgfdgfdgfdg', '2018-12-05', '2018-12-21', 3, 2, 9048048024, 'info@wahylab.com', 1),
(19, 'Arshad Khan', '2018-12-19', '2018-12-20', 1, 1, 8111846660, 'aaarshadkhan@gmail.com', 1),
(20, 'shanif', '2018-12-19', '2018-12-20', 1, 2, 8111846660, 'aaarshadkhan@gmail.com', 1),
(21, 'joby', '2018-12-06', '2018-12-14', 2, 2, 9048048024, 'info@wahylab.com', 1),
(22, '', '1970-01-01', '1970-01-01', 0, 0, 0, '', 1),
(23, 'joby1', '2018-12-06', '2018-12-14', 2, 2, 9048048024, 'info@wahylab.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkin`
--

CREATE TABLE `tbl_checkin` (
  `check_id` int(11) NOT NULL,
  `hotel_name` int(11) NOT NULL,
  `guest_id_fk` int(11) NOT NULL,
  `rev_id_fk` int(11) NOT NULL,
  `tax_id_fk` int(11) NOT NULL,
  `fin_year` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `checkin_number` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `checkin_date` date NOT NULL,
  `no_of_days` varchar(20) NOT NULL,
  `no_of_person` varchar(20) NOT NULL,
  `person_plus` int(11) NOT NULL,
  `checkout_date` date NOT NULL,
  `notes` text NOT NULL,
  `rooms` varchar(50) NOT NULL,
  `room_charge` double NOT NULL,
  `additional_charge` double NOT NULL,
  `discount` double NOT NULL,
  `subtotal` double NOT NULL,
  `paidamount` double NOT NULL,
  `balance_amount` double NOT NULL,
  `cin_status` int(11) NOT NULL,
  `checkin_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `checkout_id` int(11) NOT NULL,
  `hotel_name` int(11) NOT NULL,
  `check_id_fk` int(11) NOT NULL,
  `rev_id_fk` int(11) NOT NULL,
  `fin_year` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `guest_id_fk` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `checkout_number` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `no_of_person` varchar(50) NOT NULL,
  `checkout_date` date NOT NULL,
  `notes` text NOT NULL,
  `balance_amount` double NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `cout_status` int(11) NOT NULL,
  `checkout_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daybook`
--

CREATE TABLE `tbl_daybook` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `closing_amount` double NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_daybook`
--

INSERT INTO `tbl_daybook` (`id`, `date`, `closing_amount`, `status`) VALUES
(1, '2018-12-18', 1880.6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finyear`
--

CREATE TABLE `tbl_finyear` (
  `finyear_id` int(11) NOT NULL,
  `fin_year` varchar(50) NOT NULL,
  `fin_startdate` date NOT NULL,
  `fin_enddate` date NOT NULL,
  `finyear_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_finyear`
--

INSERT INTO `tbl_finyear` (`finyear_id`, `fin_year`, `fin_startdate`, `fin_enddate`, `finyear_status`) VALUES
(1, '2018-2019', '2018-04-01', '2019-03-31', 1),
(2, '2017-2018', '2018-06-26', '2018-06-30', 0),
(3, '2020-2021', '2018-12-20', '2018-12-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gusetdetails`
--

CREATE TABLE `tbl_gusetdetails` (
  `guest_id` int(11) NOT NULL,
  `guest_name` varchar(50) NOT NULL,
  `guest_photo` text NOT NULL,
  `arrival_date` date NOT NULL,
  `guest_street` text NOT NULL,
  `guest_city` text NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `idcard_number` varchar(50) NOT NULL,
  `pan_number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `guest_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gusetdetails`
--

INSERT INTO `tbl_gusetdetails` (`guest_id`, `guest_name`, `guest_photo`, `arrival_date`, `guest_street`, `guest_city`, `state`, `country`, `phone_number`, `idcard_number`, `pan_number`, `email`, `guest_status`) VALUES
(1, 'sanju', '20181204_120210.jpeg', '2018-12-17', 'restyys', 'gsjh ', 'FDJHGBKJDSHGFKJDSFGF', 'FDJHBGKJFDSGHK', 999999999999, '4675868', '44655768679', 'sanju@gmail.com', 0),
(2, 'Shanif', '_MG_0012.jpg', '2018-12-18', 'second', 'Trivandrum', 'Kerala', 'India', 8111846667, '121/1212/12', '211212323232', 'aaarshadkhan@gmail.com', 0),
(3, 'joby', '', '2018-12-14', '', '', '', '', 0, '', '', '', 0),
(4, 'joby3', '', '2018-12-13', '', '', '', '', 0, '', '', '', 0),
(5, 'Arun', '', '2018-12-12', '', '', '', '', 0, '', '', '', 0),
(6, 'Arun', '', '2018-12-28', '', '', '', '', 0, '', '', '', 0),
(7, 'David', '', '2018-12-21', '', '', '', '', 0, '', '', '', 0),
(8, 'Augustin Livingston G', '1_Augustin_Livingston.jpg', '2018-12-31', 'Vattappara', 'Trivandrum', 'Kerala', 'India', 8547286002, '21/384/2017', 'Driving License', '1', 1),
(9, 'Boban CJ', 'Boban_CJ_1.png', '2019-01-02', 'Chakalakandathil House, Chendamagalam P.O, North Paravur', 'Ernakulam', 'Keraka', 'India', 0, 'DL 42/6103/2009', 'NIL', 'NIL', 1),
(10, 'Muhammad Younus', '', '2019-01-02', 'Kottapadam', 'Mannarkkad', 'Kerala', 'India', 8137817294, 'Voter : ZET0118349', 'nil', 'nil', 1),
(11, 'Malwa Choudary', '', '2019-01-04', 'B6/21 , pitambspra', 'varanasi', 'UP', 'india', 9453048649, 'aadhar 791678830620', 'nil', 'nil', 1),
(12, 'Abbas', '', '2019-01-04', 'Plamoottil', 'Muvvattupuzha', 'Kerala', 'India', 9744777727, 'Passport : H4807689', 'nil', 'nil', 1),
(13, 'suresh babu', '', '2019-01-05', 'Yayath , Valayandhinagar P.O', 'Perumbavoor', 'Kerala', 'India', 8589039013, 'Voter : URJ0413518', 'nil', 'nil', 1),
(14, 'surendra kumar sharma', '', '2019-01-05', 'nirmal bagh', 'Dehradun', 'Uttarakhand', 'India', 7409010107, 'Aadhar : 938408755941', 'nil', 'nil', 1),
(15, 'Ashish Gupta', '', '2019-01-05', 'Company Bagh', 'Barabanki', 'U P', 'India', 9415189409, 'Aadhar : 363544653307', 'nil', 'nil', 1),
(16, 'Hari Mon MT', '', '2019-01-06', 'Valanchery', 'Malappuram', 'Kerala', 'India', 9048484831, 'Voters: SKL0092098', 'nil', 'nil', 1),
(17, 'Abhishek', '', '2019-01-06', 'Arummuli', 'Arummuli', 'Maharastra', 'India', 9096460730, 'Voter : XKU6299275', 'nil', 'nil', 1),
(18, 'Harish Raghuvanshi', '', '2019-01-06', 'Bank Colony', 'Indore', 'Madhya Pradesh', 'India', 9111672110, 'D/L : MP09R/2014/0973607', 'nil', 'nil', 1),
(19, 'K J Joseph', '', '2019-01-07', 'Vile Parle east', 'Mumbai', 'Maharastra', 'India', 9820779846, 'Indian Customs : CM 4100', 'nil', 'nil', 1),
(20, 'b m maru', '', '2019-01-07', 'pujaraplot', 'rajkot', 'gujarat', 'India', 9428710942, 'adadhar 461372477336', 'nil', 'nil', 1),
(21, 'Kalai arasan', '', '2019-01-07', 'Arumbakam', 'Chennai', 'Tamil Nadu', 'India', 0, 'DL : TN02/20160000744', 'nil', 'nil', 1),
(22, 'Binu Lal PS', '', '2019-01-07', 'Thattamoola', 'Kollam', 'Kerala', 'India', 0, 'DL : 2/537/1999', 'nil', 'nil', 1),
(23, 'Alfred', '', '2019-01-07', 'Venganoor', 'Trivandrum', 'Kerala', 'India', 0, 'nil', 'nil', 'nil', 1),
(24, 'Jiby V G', '', '2019-01-07', 'Methri P O', 'Ramapuram', 'Kerala', 'India', 9961474505, 'DL : 35/2095/2010', 'nil', 'nil', 1),
(25, 'Sanjay soni', '', '2019-01-07', 'Deklab', 'Rewa', 'Madhya Pradesh', 'India', 9425469522, 'Aadhar : 426005744675', 'nil', 'nil', 1),
(26, 'Arshad Khan', '', '2019-01-09', '', '', '', '', 0, '', '', '', 1),
(27, 'salim bhai', '', '2019-01-10', 'nagpur', 'nagpur', 'Maharashtra', 'India', 0, 'nil', 'nil', 'nil', 1),
(28, 'R Balachander', '', '2019-01-10', '30 Velappar St', 'Anappukkottai', 'Tamilnadu', 'India', 9498179013, 'DL : TN67/2008/0003316', 'nil', 'nil', 1),
(29, 'Narayanan', '', '2019-01-15', 'thirunelveli', 'Thirunelveli', 'Thamilnadu', 'India', 8438434726, '246874375311', 'nil', 'nil', 1),
(30, 'Fayas Ahmed', '', '2019-01-16', 'Ugargol', 'Dharwad', 'Karnadaka', 'India', 0, '423643927714', 'nil', 'nil', 1),
(31, 'Fayaz Ahmed', '', '2019-01-16', 'Ugargol  ', 'ugargol', 'Karnadaka', 'India', 6238470475, '423643927714', 'nil', 'nil', 1),
(32, 'Anto  John', '', '2019-01-16', 'Ollur', 'Ollur', 'Kerala', 'India', 9995068783, '8/1383/2008', 'nil', 'nil', 1),
(33, 'Anto  John', '', '2019-01-16', 'Ollur', 'Ollur', 'Kerala', 'India', 9995068783, '8/1383/2008', 'nil', 'nil', 1),
(34, 'Ajay Kumar', '', '2019-01-16', 'Navayuva Complex', 'Chintal , Hyderabad', 'Telangana', 'India', 7799881502, 'nil', 'nil', 'nil', 1),
(35, 'sreeju', '', '2019-01-18', 'thaliyal', 'Trivandrum', 'Kerala', 'India', 974646808, '916691142563', 'nil', 'nil', 1),
(36, 'renjith', '', '2019-01-18', 'mala', 'Ernakulam', 'Kerala', 'India', 9947992213, 'Passport : L9816454', 'nil', 'nil', 1),
(37, 'Aneesh', '', '2019-01-20', 'Kamukinkodu', 'Trivandrum', 'Kerala', 'India', 8689389720, 'XAA0192260', 'nil', 'nil', 1),
(38, 'Riyas Mydeen', '', '2019-01-21', '489 N,  no:39/1, Sambanthapuram, Seetakathi St', 'Rajapalam', 'Tamilnadu', 'India', 9629141568, 'DL : TN67Z/2008/0001728', 'nil', 'nil', 1),
(39, 'binjil', '', '2019-01-22', 'kuruvalasery', 'trichur', 'Kerala', 'India', 9747171706, 'aadhar : 741480073518', 'nil', 'nil', 1),
(40, 'manoharan gunaselvam', '', '2019-01-22', 'Sastri Nagar', 'Chennai', 'Tamilnadu', 'India', 7397335276, 'Aadhar : 675815543764 (Karunakaran SR)', 'nil', 'nil', 1),
(41, 'Rasheena', '', '2019-01-22', 'Kalayamkunne (H), Chanthapura, Puducode', 'Palakkad', 'Kerala', 'India', 9895549286, 'Aadhar : 758970472176', 'nil', 'nil', 1),
(42, 'K S Vanarajan', '', '2019-01-23', '47/5 , Sokkanathapuram , SPK Road , Chinnamanur , Uttamapalayam', 'Theni', 'Tamilnadu', 'India', 9894657619, 'Aadhar : 913938657667', 'nil', 'nil', 1),
(43, 'Fahad Bin Abdul Rahman', '', '2019-01-25', 'Mattanchery', 'Ernakulam', 'Kerala', 'India', 9846732253, '273881310715', 'nil', 'nil', 1),
(44, 'Kafil', '', '2019-01-25', 'saharanpur', 'saharanpur', 'Uttarpradhesh', 'India', 8650516771, '367702714048', 'nil', 'nil', 1),
(45, 'midhum', '', '2019-01-26', 'valayil', 'kadakkad', 'kerala', 'india', 9744894848, 'dl 25/3031/2009', 'nil', 'nil', 1),
(46, 'vijayakumar', '', '2019-01-26', 'kottapuram', 'vizhinjam', 'kerala', 'india', 0, 'aadhar 212887080739', 'nil', 'nil', 1),
(47, 'rajesh kanna', '', '2019-01-26', 'kumbakonam', 'kumbakonam', 'tamilnadu', 'india', 9597386828, 'aadhar 237835308078', 'nil', 'nil', 1),
(48, 'shivom', '', '2019-01-27', '422-A , Sethmishri lal Nagar', 'Dewas', 'Madhya Pradesh', 'India', 9179886725, 'aadhar 922703481589', 'nil', 'nil', 1),
(49, 'Bridgit', '', '2019-01-28', 'chapparapadavu', 'kannur', 'Kerala', 'India', 9539690413, 'voter sdx0265843', 'nil', 'nil', 1),
(50, 'shivaji y korvi', '', '2019-01-28', 'kadamwadi road , near menam banglow', 'Kolhapur', 'maharastra', 'india', 8421015210, 'aadhar 882184425878', 'nil', 'nil', 1),
(51, 'sreenath n', '', '2019-01-28', 'parekudath', 'thirunavaju', 'kerala', 'india', 9526797799, 'voter zvt0471631', 'nil', 'nil', 1),
(52, 'Karunesh Srimani', '', '2019-02-04', 'Manikotala', 'Manikotala', 'Utrarpredesh', 'India', 0, 'Elec JSC2365187 ', '23', 'nil', 1),
(53, 'ivin - test', '', '2019-02-07', '', '', '', '', 0, '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partialpay`
--

CREATE TABLE `tbl_partialpay` (
  `pay_id` int(11) NOT NULL,
  `guest_id_fk` int(11) NOT NULL,
  `check_id` int(11) NOT NULL,
  `pat_amount` double NOT NULL,
  `pay_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receiptdetails`
--

CREATE TABLE `tbl_receiptdetails` (
  `receipt_id` int(20) NOT NULL,
  `rec_id` int(20) NOT NULL,
  `account_head` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `narration` varchar(300) NOT NULL,
  `fin_year` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `isactive` varchar(50) NOT NULL,
  `receipt_status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_receiptdetails`
--

INSERT INTO `tbl_receiptdetails` (`receipt_id`, `rec_id`, `account_head`, `amount`, `narration`, `fin_year`, `user_id`, `type`, `created_date`, `isactive`, `receipt_status`) VALUES
(1, 100, 'Laundry', 200, 'Payment for Laundry ', '2018-2019', 1, 'receipt', '2018-12-17', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receiptentry`
--

CREATE TABLE `tbl_receiptentry` (
  `entry_id` int(11) NOT NULL,
  `fin_year` varchar(50) NOT NULL,
  `entry_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `receipt_head` int(11) NOT NULL,
  `receiptid` int(11) NOT NULL,
  `entry_amount` double NOT NULL,
  `paidto` varchar(50) NOT NULL,
  `entry_narration` text NOT NULL,
  `entry_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `reserv_id` int(11) NOT NULL,
  `guest_id_fk` int(11) NOT NULL,
  `fin_year` varchar(20) NOT NULL,
  `created_date` date NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `room` int(11) NOT NULL,
  `room_charge` double NOT NULL,
  `no_of_person` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `additional_charge` double NOT NULL,
  `discount` double NOT NULL,
  `subtotal` double NOT NULL,
  `paidamount` double NOT NULL,
  `balance_amount` double NOT NULL,
  `checkout_status` int(11) NOT NULL,
  `reserv_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomdetails`
--

CREATE TABLE `tbl_roomdetails` (
  `room_id` int(11) NOT NULL,
  `hotel_name` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `room_ac` varchar(50) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `room_pic` text NOT NULL,
  `no_of_occ` int(11) NOT NULL,
  `add_of_occ` double NOT NULL,
  `room_rate` double NOT NULL,
  `room_features` text NOT NULL,
  `occupied` int(11) NOT NULL DEFAULT '0',
  `room_active` int(11) NOT NULL,
  `room_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roomdetails`
--

INSERT INTO `tbl_roomdetails` (`room_id`, `hotel_name`, `room_type`, `room_ac`, `room_number`, `room_pic`, `no_of_occ`, `add_of_occ`, `room_rate`, `room_features`, `occupied`, `room_active`, `room_status`) VALUES
(1, 1, '6', 'NonAC', 'A-101 (1)', 'a1.jpg', 2, 300, 1300, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(2, 1, '6', 'NonAC', 'A-102 (2)', 'a2.jpg', 2, 300, 1300, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(3, 1, '6', 'AC', 'A-103 (16)', 'a16.jpg', 2, 300, 900, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(4, 1, '6', 'AC', 'A-104 (17)', 'a17.jpg', 2, 300, 900, 'SIMPLE AND ELEGENT DOUBLE BED  A/C ROOMS,SIDE TABLE,DRESSING CUBOARD WITH MIRROR AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV,TOWEL,SOAP,SHAMPOO AND DRINKING WATER,RATE:   CLEAN AND WELL KEPT.', 0, 0, 1),
(5, 2, '1', 'NonAC', '104', '20181204_121626.jpeg', 2, 200, 350, 'DORMITORIES,WITH FIVE TO SIX BEDS,HOT AND COLD WATER SHOWER.A CLEAN ENVIRONMENT.RATE:Rs350 PER BED.', 0, 0, 0),
(6, 2, '1', 'AC', '105', '20181204_122021.jpeg', 1, 200, 320, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 0, 0, 0),
(7, 1, '1', 'NonAC', '106', '20181204_122848.jpeg', 1, 200, 500, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 0, 0, 0),
(8, 2, '1', 'AC', '123', '20181204_121309.jpeg', 2, 100, 500, 'sdfdsfdsf dfgdfg dsfdsfdsfds', 0, 1, 0),
(9, 1, '1', 'AC', '807', '20181204_115711.jpeg', 2, 300, 600, 'cvbcvbcvb dfdsfsdfds', 1, 0, 0),
(10, 1, '1', 'AC', '3301', 'Not uploaded', 2, 300, 1000, '', 0, 2, 0),
(11, 1, '1', 'AC', '201', 'Not uploaded', 2, 300, 1300, 'dfsdfsdfsdffsdfsda', 0, 2, 0),
(12, 1, '6', 'NonAC', 'A-105 (12)', 'a12.jpg', 2, 300, 900, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(13, 1, '6', 'NonAC', 'A-106 (14)', 'a14.jpg', 2, 300, 900, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(14, 1, '6', 'NonAC', 'A-107 (15)', 'a15.jpg', 2, 300, 800, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(15, 1, '6', 'NonAC', 'A-201 (3)', 'a31.jpg', 1, 300, 800, 'SIMPLE AND ELEGENT SINGLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 2, 1),
(16, 1, '6', 'AC', 'A-202 (4)', 'a4.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(17, 1, '6', 'NonAC', 'A-301 (7)', 'a7.jpg', 1, 300, 800, 'SIMPLE AND ELEGENT SINGLE  BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 2, 1),
(18, 1, '6', 'NonAC', 'A-302 (6)', 'a6.jpg', 1, 300, 800, 'SIMPLE AND ELEGENT SINGLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(19, 1, '6', 'AC', 'A-303 (5)', 'a5.jpg', 2, 300, 1300, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(20, 1, '6', 'AC', 'A-304 (8)', 'a8.jpg', 2, 300, 1800, 'SIMPLE AND ELEGENT THREE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(21, 1, '6', 'AC', 'A-305 (9)', 'a9.jpg', 2, 300, 1800, 'SIMPLE AND ELEGENT THREE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(22, 1, '6', 'NonAC', 'A-306 (10)', 'a10.jpg', 1, 300, 800, 'SIMPLE AND ELEGENT SINGLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(23, 1, '3', 'AC', 'A-307 (11)', '15490126058211432011420480196197.jpg', 12, 250, 2500, 'DORMITARY ROOMS UPTO 12 PAX WITH 2 TOILETS SIMPLE AND ELEGENT A/C & NON A/C ROOM, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(24, 1, '2', 'NonAC', 'B-108', 'Not uploaded', 2, 300, 1000, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(25, 1, '2', 'NonAC', 'B-109', 'Not uploaded', 2, 300, 1000, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(26, 1, '2', 'NonAC', 'B-110', 'Not uploaded', 2, 300, 1000, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(27, 1, '2', 'NonAC', 'B-111', 'Not uploaded', 2, 300, 1000, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(28, 1, '2', 'NonAC', 'B-112', 'Not uploaded', 2, 300, 1000, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(29, 1, '2', 'NonAC', 'B-113', 'Not uploaded', 2, 300, 1000, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(30, 1, '2', 'NonAC', 'B-114', 'Not uploaded', 2, 300, 1000, 'SIMPLE AND ELEGENT DOUBLE BED NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(31, 1, '2', 'AC', 'B-203', 'Not uploaded', 2, 300, 1500, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(32, 1, '2', 'AC', 'B-204', 'Not uploaded', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(33, 1, '2', 'AC', 'B-205', 'Not uploaded', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(34, 1, '2', 'AC', 'B-206', 'Not uploaded', 2, 300, 1500, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(35, 1, '2', 'AC', 'B-207', 'Not uploaded', 2, 300, 1500, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(36, 1, '2', 'AC', 'B-208', 'Not uploaded', 2, 300, 1500, 'SIMPLE AND ELEGENT DOUBLE BED A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(37, 2, '2', 'AC', 'C-201', '7_c201.jpg', 2, 300, 2500, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(38, 2, '2', 'AC', 'C-202', '8_c202.jpg', 2, 300, 2500, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(39, 2, '2', 'AC', 'C-203', '9_c203.jpg', 2, 300, 2500, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(40, 2, '2', 'AC', 'C-204', '10_c204.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(41, 2, '2', 'AC', 'C-205', '11_c205.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(42, 2, '2', 'AC', 'C-206', '12_c206.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(43, 2, '2', 'AC', 'C-102', '1_c102.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(44, 2, '2', 'AC', 'C-103', '2_c103.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(45, 2, '2', 'AC', 'C-104', '3_c104.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(46, 2, '2', 'AC', 'C-105', '4_c105.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(47, 2, '2', 'AC', 'C-106', '5_c106.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(48, 2, '2', 'AC', 'C-107', '6_c107.jpg', 2, 300, 2000, 'SIMPLE AND ELEGENT DOUBLE BED A/C & NON A/C ROOMS, SIDE TABLE, DRESSING CUBOARD WITH MIRROR, AND A CLEAN TOILET, BATH ROOM EQUIPPED WITH EUROPEAN CLOSET, WASH BASIN WITH MIRROR, HOT AND COLD SHOWER,LED TV, TOWEL, SOAP, SHAMPOO AND DRINKING WATER CLEAN AND WELL KEPT.', 0, 0, 1),
(49, 2, '3', 'NonAC', 'C-301', '13_c301.jpg', 1, 250, 250, 'Dormitory Room / Big Room, Attached Toilets, Dining Facility etc', 0, 0, 1),
(50, 2, '3', 'NonAC', 'C-302', '6_c_kitchen.jpg', 0, 0, 0, 'kitchen', 0, 0, 1),
(51, 2, '3', 'NonAC', 'C-303', '14_c303__3041.jpg', 1, 250, 250, 'Dormitory Room / Big Room, Attached Toilets, Dining Facility etc', 0, 0, 1),
(52, 2, '3', 'NonAC', 'C-304', '14_c303__304.jpg', 1, 250, 250, 'Dormitory Room / Big Room, Attached Toilets, Dining Facility etc', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roommaster`
--

CREATE TABLE `tbl_roommaster` (
  `masterid` int(11) NOT NULL,
  `mastername` varchar(250) NOT NULL,
  `masterdescription` text NOT NULL,
  `masterstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roommaster`
--

INSERT INTO `tbl_roommaster` (`masterid`, `mastername`, `masterdescription`, `masterstatus`) VALUES
(1, 'STANDARD ROOM', 'AC & Non AC Rooms, Television, Free Wifi, Card Payment, Power Backup, CCTV Cameras', 0),
(2, 'DELUXE ROOMS', 'AC & Non AC Rooms, Television, Free Wifi, Card Payment, Power Backup, CCTV Cameras', 1),
(3, 'Dormitory Rooms / Large Rooms', 'AC & Non AC Rooms, Television, Free Wifi, Card Payment, Power Backup, CCTV Cameras', 1),
(4, 'wyteruywerih', 'dfgfdg dfgfgfdgfdg ', 0),
(5, 'KITCHEN FACILITY - GROUPS', 'Providing Kitchen Facility for Groups.', 0),
(6, 'STANDARD ROOM', 'AC & Non AC Rooms, Television, Free Wifi, Card Payment, Power Backup, CCTV Cameras', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taxdetails`
--

CREATE TABLE `tbl_taxdetails` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_amount` double NOT NULL,
  `cgst` double NOT NULL,
  `sgst` double NOT NULL,
  `igst` double NOT NULL,
  `tax_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_taxdetails`
--

INSERT INTO `tbl_taxdetails` (`tax_id`, `tax_name`, `tax_amount`, `cgst`, `sgst`, `igst`, `tax_status`) VALUES
(1, 'GST 12%', 12, 6, 6, 12, 1),
(2, 'GST 18%', 18, 9, 9, 18, 1),
(3, 'Zero', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucherdetails`
--

CREATE TABLE `tbl_voucherdetails` (
  `voucher_id` int(11) NOT NULL,
  `vouch_id` int(11) NOT NULL,
  `account_head` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `narration` text NOT NULL,
  `created_date` date NOT NULL,
  `isactive` int(11) NOT NULL,
  `fin_year` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `voucher_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_voucherdetails`
--

INSERT INTO `tbl_voucherdetails` (`voucher_id`, `vouch_id`, `account_head`, `amount`, `narration`, `created_date`, `isactive`, `fin_year`, `user_id`, `type`, `voucher_status`) VALUES
(1, 100, 'LAUNDRY', 0, 'Payment given for Laundry  ', '2019-01-05', 0, '2018-2019', 1, 'voucher', 1),
(2, 101, 'ELECTRICITY - JI (Jumayira International)', 0, ' Payment to KSEB for JI', '2019-01-05', 0, '2018-2019', 1, 'voucher', 1),
(3, 102, 'ELECTRICITY - JR (Jumayira Residency)', 0, ' Payment to KSEB for JR', '2019-01-05', 0, '2018-2019', 1, 'voucher', 1),
(4, 103, 'LAUNDRY', 1500, '5-1-18 payment given ', '2019-01-05', 0, '2018-2019', 1, 'voucher', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucherentry`
--

CREATE TABLE `tbl_voucherentry` (
  `entry_id` int(11) NOT NULL,
  `fin_year` varchar(50) NOT NULL,
  `entry_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `voucher_head` int(11) NOT NULL,
  `voucherid` int(11) NOT NULL,
  `entry_amount` double NOT NULL,
  `paidto` varchar(50) NOT NULL,
  `entry_narration` text NOT NULL,
  `entry_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `tbl_checkin`
--
ALTER TABLE `tbl_checkin`
  ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `tbl_daybook`
--
ALTER TABLE `tbl_daybook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_finyear`
--
ALTER TABLE `tbl_finyear`
  ADD PRIMARY KEY (`finyear_id`);

--
-- Indexes for table `tbl_gusetdetails`
--
ALTER TABLE `tbl_gusetdetails`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `tbl_partialpay`
--
ALTER TABLE `tbl_partialpay`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `tbl_receiptdetails`
--
ALTER TABLE `tbl_receiptdetails`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_receiptentry`
--
ALTER TABLE `tbl_receiptentry`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`reserv_id`);

--
-- Indexes for table `tbl_roomdetails`
--
ALTER TABLE `tbl_roomdetails`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_roommaster`
--
ALTER TABLE `tbl_roommaster`
  ADD PRIMARY KEY (`masterid`);

--
-- Indexes for table `tbl_taxdetails`
--
ALTER TABLE `tbl_taxdetails`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tbl_voucherdetails`
--
ALTER TABLE `tbl_voucherdetails`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Indexes for table `tbl_voucherentry`
--
ALTER TABLE `tbl_voucherentry`
  ADD PRIMARY KEY (`entry_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_checkin`
--
ALTER TABLE `tbl_checkin`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_daybook`
--
ALTER TABLE `tbl_daybook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_finyear`
--
ALTER TABLE `tbl_finyear`
  MODIFY `finyear_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_gusetdetails`
--
ALTER TABLE `tbl_gusetdetails`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_partialpay`
--
ALTER TABLE `tbl_partialpay`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_receiptdetails`
--
ALTER TABLE `tbl_receiptdetails`
  MODIFY `receipt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_receiptentry`
--
ALTER TABLE `tbl_receiptentry`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roomdetails`
--
ALTER TABLE `tbl_roomdetails`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_roommaster`
--
ALTER TABLE `tbl_roommaster`
  MODIFY `masterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_taxdetails`
--
ALTER TABLE `tbl_taxdetails`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_voucherdetails`
--
ALTER TABLE `tbl_voucherdetails`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_voucherentry`
--
ALTER TABLE `tbl_voucherentry`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
