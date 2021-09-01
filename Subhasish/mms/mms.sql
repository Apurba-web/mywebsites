SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */

CREATE DATABASE IF NOT EXISTS `mms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mms`;

CREATE TABLE `CLIENTMAST` (
  `SRL` int(11) NOT NULL,
  `CLIENT_ID` char(6) NOT NULL,
  `VENCD` char(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `ADD1` varchar(30) NOT NULL,
  `ADD2` varchar(30) DEFAULT NULL,
  `CITY` varchar(20) DEFAULT NULL,
  `CLSTATE` varchar(20) DEFAULT NULL,
  `PIN` char(6) DEFAULT NULL,
  `GSTN` varchar(15) DEFAULT NULL,
  `CONTACT` varchar(30) DEFAULT NULL,
  `MOBILE` char(10) DEFAULT NULL,
  `PartyType` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `GRN` (
  `srl` int(5) NOT NULL,
  `GRN` char(5) NOT NULL,
  `GRDate` varchar(10) NOT NULL,
  `i_code` char(4) NOT NULL,
  `s_code` char(5) NOT NULL,
  `Driver` varchar(25) NOT NULL,
  `TicketNo` varchar(4) NOT NULL,
  `Qty` int(11) NOT NULL,
  `UOM` varchar(4) NOT NULL,
  `BagWt` decimal(10,0) NOT NULL,
  `Rate` decimal(10,0) NOT NULL,
  `Booked` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `GRNDETAILS` (
`srl` int(5)
,`GRN` char(5)
,`GRDate` varchar(10)
,`i_code` char(4)
,`s_code` char(5)
,`Driver` varchar(25)
,`TicketNo` varchar(4)
,`Qty` int(11)
,`UOM` varchar(4)
,`BagWt` decimal(10,0)
,`Rate` decimal(10,0)
,`i_name` varchar(15)
,`s_name` varchar(45)
);

CREATE TABLE `item` (
  `srl` smallint(4) NOT NULL,
  `i_code` char(4) NOT NULL,
  `i_type` char(2) NOT NULL DEFAULT '01',
  `i_name` varchar(15) NOT NULL DEFAULT 'NA',
  `i_uom_primary` varchar(6) NOT NULL,
  `i_uom_secondary` varchar(6) DEFAULT NULL,
  `i_conversion_factor` float DEFAULT NULL,
  `i_dimension` int(11) DEFAULT NULL,
  `i_dimension_unit` varchar(10) DEFAULT NULL,
  `i_gst_code` varchar(16) DEFAULT '''NA''',
  `i_gst_percentage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `purchase` (
  `srl` int(6) NOT NULL,
  `p_voucher` int(7) NOT NULL,
  `p_date` date NOT NULL,
  `s_code` char(5) NOT NULL,
  `p_gst_code` char(16) NOT NULL,
  `p_gst_percentage` float NOT NULL,
  `p_totamount` decimal(10,2) NOT NULL,
  `p_billamount` decimal(10,2) NOT NULL,
  `p_status` bit(1) NOT NULL,
  `p_billno` varchar(10) DEFAULT NULL,
  `p_billDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `PurchaseDetails` (
  `p_voucher` int(7) NOT NULL,
  `p_date` date NOT NULL,
  `i_code` char(4) NOT NULL,
  `i_uom` varchar(45) NOT NULL,
  `p_qty` smallint(4) NOT NULL,
  `p_BagWt` decimal(10,0) NOT NULL DEFAULT 0,
  `p_rate` decimal(8,2) NOT NULL,
  `TicketNo` varchar(4) NOT NULL,
  `p_billno` varchar(10) DEFAULT NULL,
  `p_billDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Sites` (
  `SiteId` varchar(3) NOT NULL,
  `SiteName` varchar(30) NOT NULL,
  `Supervisor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `Suppliers` (
  `srl` smallint(4) NOT NULL,
  `s_code` char(5) NOT NULL,
  `s_name` varchar(45) NOT NULL DEFAULT 'NA',
  `s_address` varchar(45) NOT NULL DEFAULT 'NA',
  `s_city` varchar(45) NOT NULL DEFAULT 'NA',
  `s_state` varchar(45) NOT NULL DEFAULT 'NA',
  `s_pin` char(6) NOT NULL DEFAULT 'NA',
  `s_contact` varchar(45) NOT NULL DEFAULT 'NA',
  `s_mob` char(10) NOT NULL DEFAULT 'NA',
  `s_email` varchar(45) NOT NULL DEFAULT 'NA',
  `s_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `users` (
  `user` varchar(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `usertype` varchar(1) NOT NULL,
  `fullname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`localhost` SQL SECURITY DEFINER VIEW `GRNDETAILS`  AS SELECT `GRN`.`srl` AS `srl`, `GRN`.`GRN` AS `GRN`, `GRN`.`GRDate` AS `GRDate`, `GRN`.`i_code` AS `i_code`, `GRN`.`s_code` AS `s_code`, `GRN`.`Driver` AS `Driver`, `GRN`.`TicketNo` AS `TicketNo`, `GRN`.`Qty` AS `Qty`, `GRN`.`UOM` AS `UOM`, `GRN`.`BagWt` AS `BagWt`, `GRN`.`Rate` AS `Rate`, `item`.`i_name` AS `i_name`, `Suppliers`.`s_name` AS `s_name` FROM ((`GRN` left join `item` on(`GRN`.`i_code` = `item`.`i_code`)) left join `Suppliers` on(`GRN`.`s_code` = `Suppliers`.`s_code`)) ;


ALTER TABLE `CLIENTMAST`
  ADD PRIMARY KEY (`SRL`);

ALTER TABLE `GRN`
  ADD PRIMARY KEY (`srl`);

ALTER TABLE `item`
  ADD PRIMARY KEY (`srl`);

ALTER TABLE `purchase`
  ADD PRIMARY KEY (`srl`);

ALTER TABLE `Suppliers`
  ADD PRIMARY KEY (`srl`);


ALTER TABLE `CLIENTMAST`
  MODIFY `SRL` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `GRN`
  MODIFY `srl` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `item`
  MODIFY `srl` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `purchase`
  MODIFY `srl` int(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Suppliers`
  MODIFY `srl` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
