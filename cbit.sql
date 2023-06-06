
CREATE TABLE `bnr_mst` (
  `bnrm_id` int(11) NOT NULL,
  `bnrm_name` varchar(250) NOT NULL,
  `bnrm_desc` text,
  `bnrm_imgnm` varchar(250) DEFAULT NULL,
  `bnrm_lnk` varchar(250) DEFAULT NULL,
  `bnrm_text` varchar(250) DEFAULT NULL,
  `bnrm_prty` int(15) DEFAULT NULL,
  `bnrm_sts` char(1) DEFAULT NULL,
  `bnrm_crtdon` datetime DEFAULT NULL,
  `bnrm_crtdby` varchar(250) DEFAULT NULL,
  `bnrm_mdfdon` datetime DEFAULT NULL,
  `bnrm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bnr_mst`
--

INSERT INTO `bnr_mst` (`bnrm_id`, `bnrm_name`, `bnrm_desc`, `bnrm_imgnm`, `bnrm_lnk`, `bnrm_text`,`bnrm_prty`, `bnrm_sts`, `bnrm_crtdon`, `bnrm_crtdby`, `bnrm_mdfdon`, `bnrm_mdfdby`) VALUES
(3, 'SDES 2', 'abnohfkfalkdf', 'bnrimg642d12424535b.jpg', '','L', 3, 'a', '2023-04-05 06:16:34', 'admin', '2023-04-05 06:57:36', 'admin'),
(2, 'SDES 1', 'about sdes 1', 'bnrimg642d0de0596c2.jpg', '','R', 2, 'a', '2023-04-05 05:57:52', 'admin', '2023-04-05 06:32:54', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `brnd_mst`
--

CREATE TABLE `brnd_mst` (
  `brndm_id` int(15) NOT NULL,
  `brndm_name` varchar(250) NOT NULL COMMENT 'Name of the brand',
  `brndm_desc` text,
  `brndm_img` varchar(250) DEFAULT NULL,
  `brndm_zmimg` varchar(250) DEFAULT NULL,
  `brndm_lnk` varchar(250) DEFAULT NULL,
  `brndm_seotitle` varchar(250) DEFAULT NULL,
  `brndm_seodesc` text,
  `brndm_seokywrd` text,
  `brndm_seohonetitle` varchar(250) DEFAULT NULL,
  `brndm_seohonedesc` text,
  `brndm_seohtwotitle` varchar(250) DEFAULT NULL,
  `brndm_seohtwodesc` text,
  `brndm_typ` char(1) NOT NULL,
  `brndm_sts` char(1) NOT NULL COMMENT 'Status of the brand',
  `brndm_prty` int(15) NOT NULL COMMENT 'Priority of the brand',
  `brndm_crtdon` date DEFAULT NULL COMMENT 'Date on which the brand is created',
  `brndm_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the brand is created',
  `brndm_mdfdon` date DEFAULT NULL COMMENT 'Date on which the brand is modified',
  `brndm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the brand is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lgntrck_mst`
--

CREATE TABLE `lgntrck_mst` (
  `lgntrckm_id` int(15) NOT NULL,
  `lgntrckm_sesid` varchar(250) NOT NULL,
  `lgntrckm_ipadrs` varchar(250) DEFAULT NULL,
  `lgntrckm_lgnm_id` int(15) NOT NULL,
  `lgntrckm_crtdon` datetime DEFAULT NULL,
  `lgntrckm_crtdby` varchar(250) DEFAULT NULL,
  `lgntrckm_mdfdon` datetime DEFAULT NULL,
  `lgntrckm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lgntrck_mst`
--

INSERT INTO `lgntrck_mst` (`lgntrckm_id`, `lgntrckm_sesid`, `lgntrckm_ipadrs`, `lgntrckm_lgnm_id`, `lgntrckm_crtdon`, `lgntrckm_crtdby`, `lgntrckm_mdfdon`, `lgntrckm_mdfdby`) VALUES
(1, 'f8jnv8k9rucbj331tlq5d55pmi', '::1', 1, '2023-03-31 05:41:25', 'admin', '2023-03-31 05:41:30', 'admin'),
(2, 'f8jnv8k9rucbj331tlq5d55pmi', '::1', 1, '2023-03-31 05:41:52', 'admin', '2023-03-31 05:42:18', 'admin'),
(3, 'f8jnv8k9rucbj331tlq5d55pmi', '::1', 1, '2023-03-31 05:42:31', 'admin', '2023-03-31 06:03:36', 'admin'),
(4, 'f8jnv8k9rucbj331tlq5d55pmi', '::1', 1, '2023-03-31 06:08:13', 'admin', NULL, NULL),
(5, '5l3hvl538ko715fve968s3gb0h', '::1', 1, '2023-04-01 04:25:45', 'admin', NULL, NULL),
(6, '5l3hvl538ko715fve968s3gb0h', '::1', 1, '2023-04-01 07:40:34', 'admin', '2023-04-01 10:15:24', 'admin'),
(7, '5l3hvl538ko715fve968s3gb0h', '::1', 1, '2023-04-01 10:15:31', 'admin', NULL, NULL),
(8, '5l3hvl538ko715fve968s3gb0h', '::1', 1, '2023-04-01 11:24:30', 'admin', NULL, NULL),
(9, 't1ls5gjh70jnkof2o07l0iv6hl', '::1', 1, '2023-04-03 04:34:10', 'admin', NULL, NULL),
(10, '3lh09mvb0p35o7qjp3hv2uq3fl', '::1', 1, '2023-04-04 04:35:41', 'admin', NULL, NULL),
(11, 'qo75epl9f7ak6t8dg1u19s7gc1', '::1', 1, '2023-04-04 05:55:30', 'admin', NULL, NULL),
(12, 'qo75epl9f7ak6t8dg1u19s7gc1', '::1', 1, '2023-04-04 12:47:42', 'admin', NULL, NULL),
(13, 'ce035e5s8oulhkq7hcleif5k6n', '::1', 1, '2023-04-05 04:32:10', 'admin', NULL, NULL),
(14, 'ce035e5s8oulhkq7hcleif5k6n', '::1', 1, '2023-04-05 04:38:00', 'admin', '2023-04-05 04:57:06', 'admin'),
(15, 'ce035e5s8oulhkq7hcleif5k6n', '::1', 1, '2023-04-05 04:57:18', 'admin', NULL, NULL),
(16, 'ef29mc0d9sumhsiptepomb19e4', '::1', 1, '2023-04-06 04:02:01', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lgn_mst`
--

CREATE TABLE `lgn_mst` (
  `lgnm_id` int(15) NOT NULL,
  `lgnm_uid` varchar(250) NOT NULL,
  `lgnm_pwd` varchar(250) DEFAULT NULL,
  `lgnm_typ` char(1) DEFAULT NULL,
  `lgnm_store_id` varchar(10) DEFAULT NULL,
  `lgnm_sts` char(1) DEFAULT NULL,
  `lgnm_crtdon` datetime DEFAULT NULL,
  `lgnm_crtdby` varchar(250) DEFAULT NULL,
  `lgnm_mdfdon` datetime DEFAULT NULL,
  `lgnm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lgn_mst`
--

INSERT INTO `lgn_mst` (`lgnm_id`, `lgnm_uid`, `lgnm_pwd`, `lgnm_typ`, `lgnm_store_id`, `lgnm_sts`, `lgnm_crtdon`, `lgnm_crtdby`, `lgnm_mdfdon`, `lgnm_mdfdby`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'a', NULL, 'a', '2023-03-31 11:02:03', 'admin', '2023-03-31 05:42:18', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `prodcat_mst`
--

CREATE TABLE `prodcat_mst` (
  `prodcatm_id` int(15) NOT NULL,
  `prodcatm_prodmnlnksm_id` int(15) NOT NULL,
  `prodcatm_name` varchar(250) NOT NULL COMMENT 'Unique name for each category',
  `prodcatm_desc` text,
  `prodcatm_bnrimg` varchar(250) DEFAULT NULL,
  `prodcatm_icn` varchar(250) NOT NULL,
  `prodcatm_seotitle` varchar(250) DEFAULT NULL,
  `prodcatm_seodesc` text,
  `prodcatm_seokywrd` tinytext,
  `prodcatm_seohone` text,
  `prodcatm_seohtwo` text,
  `prodcatm_dsplytyp` char(1) NOT NULL,
  `prodcatm_typ` char(1) DEFAULT NULL,
  `prodcatm_sts` char(1) NOT NULL COMMENT 'Status of each category',
  `prodcatm_prty` int(15) DEFAULT NULL COMMENT 'Priority of each categories',
  `prodcatm_crtdon` date DEFAULT NULL COMMENT 'Date on which the category is created',
  `prodcatm_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the category is created',
  `prodcatm_mdfdon` date DEFAULT NULL COMMENT 'Date on which the category is modified',
  `prodcatm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the category is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodcat_mst`
--

INSERT INTO `prodcat_mst` (`prodcatm_id`, `prodcatm_prodmnlnksm_id`, `prodcatm_name`, `prodcatm_desc`, `prodcatm_bnrimg`, `prodcatm_icn`, `prodcatm_seotitle`, `prodcatm_seodesc`, `prodcatm_seokywrd`, `prodcatm_seohone`, `prodcatm_seohtwo`, `prodcatm_dsplytyp`, `prodcatm_typ`, `prodcatm_sts`, `prodcatm_prty`, `prodcatm_crtdon`, `prodcatm_crtdby`, `prodcatm_mdfdon`, `prodcatm_mdfdby`) VALUES
(1, 34, 'About Colleges', 'cbit', 'bimg642a7431df2bd.jpg', '', 'seo title', 'lokesh', 'abgjhgjg', '', '', '1', 'g', 'a', 1, '2023-03-31', '', '2023-04-04', 'admin'),
(5, 34, 'libraries', 'college lib', 'bimg642a7aeb68275.jpg', '', '', '', '', '', '', '1', 'g', 'a', 2, '2023-04-03', '', NULL, NULL),
(4, 36, 'Admission Criteria', 'admission', 'bimg642a753f70d01.jpg', 'simg642a753f710e9.jpg', '', '', '', '', '', '1', 'g', 'i', 1, '2023-04-03', '', '2023-04-04', 'admin'),
(6, 37, 'Student Events', 'In this section, we present everything that the young geniuses of CBIT are doing in and around the campus to make their youth more exciting, fun-filled and energy-packed.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industryâ€™s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'bimg642bb17d15315.jpg', 'simg642bb17d156fd.jpg', '', '', '', '', '', '1', 'g', 'a', 1, '2023-04-04', '', '2023-04-04', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `prodmnlnks_mst`
--

CREATE TABLE `prodmnlnks_mst` (
  `prodmnlnksm_id` int(15) NOT NULL,
  `prodmnlnksm_name` varchar(250) NOT NULL,
  `prodmnlnksm_desc` text NOT NULL,
  `prodmnlnksm_bnrimg` varchar(250) NOT NULL,
  `prodmnlnksm_seotitle` varchar(250) NOT NULL,
  `prodmnlnksm_seodesc` text NOT NULL,
  `prodmnlnksm_seokywrd` tinytext NOT NULL,
  `prodmnlnksm_seohone` text NOT NULL,
  `prodmnlnksm_seohtwo` text NOT NULL,
  `prodmnlnksm_dsplytyp` char(1) NOT NULL,
  `prodmnlnksm_typ` char(1) NOT NULL,
  `prodmnlnksm_sts` char(1) NOT NULL,
  `prodmnlnksm_prty` int(15) NOT NULL,
  `prodmnlnksm_crtdon` datetime NOT NULL,
  `prodmnlnksm_crtdby` varchar(250) NOT NULL,
  `prodmnlnksm_mdfdon` datetime NOT NULL,
  `prodmnlnksm_mdfdby` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodmnlnks_mst`
--

INSERT INTO `prodmnlnks_mst` (`prodmnlnksm_id`, `prodmnlnksm_name`, `prodmnlnksm_desc`, `prodmnlnksm_bnrimg`, `prodmnlnksm_seotitle`, `prodmnlnksm_seodesc`, `prodmnlnksm_seokywrd`, `prodmnlnksm_seohone`, `prodmnlnksm_seohtwo`, `prodmnlnksm_dsplytyp`, `prodmnlnksm_typ`, `prodmnlnksm_sts`, `prodmnlnksm_prty`, `prodmnlnksm_crtdon`, `prodmnlnksm_crtdby`, `prodmnlnksm_mdfdon`, `prodmnlnksm_mdfdby`) VALUES
(36, 'Acadamics', 'college acadamics', 'bimg6427e2b6628b4.jpg', '', 'abcjfdljfla', 'dflf', 'lfdfk;', 'dfd&#039;f', '1', 'g', 'a', 2, '2023-04-01 07:52:22', '', '2023-04-04 11:50:32', 'admin'),
(37, 'Activities', 'college activities', 'bimg6428167404868.jpg', '', '', '', '', '', '1', 'g', 'a', 3, '2023-04-01 10:55:27', '', '2023-04-01 11:33:08', ''),
(38, 'Placement', 'Career Development Centre\r\nVision  \r\n\r\nTo be centre of excellence in technical education and research\r\nMission \r\n\r\n To address the emerging needs through quality technical education and advanced research\r\nTo improve the industry institute interaction\r\nTo organize Conferences/Workshops/Seminars\r\nTo promote R&D activity\r\nTo strive for studentsâ€™ placement\r\nTo organize co-curricular and extra curricular activities\r\nTo develop and maintain the linkage with alumni associations of CBIT\r\nTo improve internal communication', 'bimg642bd0cee03d5.jpg', '', '', '', '', '', '1', 'g', 'a', 4, '2023-04-04 07:25:02', '', '2023-04-04 11:36:12', 'admin'),
(34, 'About Us', 'CHAITANYA BHARATHI INSTITUTE OF TECHNOLOGY, established in the Year 1979, esteemed as the Premier Engineering Institute in the States of Telangana and Andhra Pradesh, was promoted by a Group of Visionaries from varied Professions of Engineering, Medical, Legal and Management, with an Objective to facilitate the Best Engineering and Management Education to the Students and contribute towards meeting the need of Skilled and Technically conversant Engineers and Management Professionals, for the Country that embarked on an Economic Growth Plan.', 'bimg6427f90adb2ee.jpg', '', '', 'fgh', '', '', '1', 'n', 'a', 1, '2023-03-31 11:04:02', '', '2023-04-04 12:22:41', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `prodscat_mst`
--

CREATE TABLE `prodscat_mst` (
  `prodscatm_id` int(11) NOT NULL,
  `prodscatm_name` varchar(250) NOT NULL COMMENT 'Unique name for each category',
  `prodscatm_desc` text,
  `prodscatm_bnrimg` varchar(250) DEFAULT NULL,
  `prodscatm_dpttitle` text NOT NULL,
  `prodscatm_dpthead` varchar(250) NOT NULL,
  `prodscatm_dptname` varchar(250) NOT NULL,
  `prodscatm_seotitle` varchar(250) DEFAULT NULL,
  `prodscatm_seodesc` text,
  `prodscatm_seokywrd` tinytext,
  `prodscatm_seohone` text,
  `prodscatm_seohtwo` text,
  `prodscatm_typ` char(1) NOT NULL,
  `prodscatm_sts` char(1) NOT NULL COMMENT 'Status of each category',
  `prodscatm_prty` int(15) DEFAULT NULL COMMENT 'Priority of each categories',
  `prodscatm_prodcatm_id` int(15) NOT NULL,
  `prodscatm_prodmnlnksm_id` int(15) DEFAULT NULL,
  `prodscatm_crtdon` date DEFAULT NULL COMMENT 'Date on which the category is created',
  `prodscatm_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the category is created',
  `prodscatm_mdfdon` date DEFAULT NULL COMMENT 'Date on which the category is modified',
  `prodscatm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the category is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodscat_mst`
--

INSERT INTO `prodscat_mst` (`prodscatm_id`, `prodscatm_name`, `prodscatm_desc`, `prodscatm_bnrimg`, `prodscatm_dpttitle`, `prodscatm_dpthead`, `prodscatm_dptname`, `prodscatm_seotitle`, `prodscatm_seodesc`, `prodscatm_seokywrd`, `prodscatm_seohone`, `prodscatm_seohtwo`, `prodscatm_typ`, `prodscatm_sts`, `prodscatm_prty`, `prodscatm_prodcatm_id`, `prodscatm_prodmnlnksm_id`, `prodscatm_crtdon`, `prodscatm_crtdby`, `prodscatm_mdfdon`, `prodscatm_mdfdby`) VALUES
(2, 'About Admission', 'cbit admisssion', 'scatimg642aa2b554653.jpg', '', '', '', '', '', '', '', '', '2', 'a', 2, 4, 36, '2023-04-03', 'admin', NULL, NULL),
(3, 'about', 'fdjlajdlfjsfjdasfjasflf', 'scatimg642ab8ec75243.jpg', '', '', '', '', '', '', '', '', '1', 'a', 3, 4, 36, '2023-04-03', 'admin', NULL, NULL),
(5, 'SPORTS &amp; REC', 'sports of cbit college', 'scatimg642bb33d953e5.jpg', 'computer science', 'lokesh', 'mca', '', '', '', '', '', '3', 'a', 1, 6, 37, '2023-04-04', 'admin', NULL, NULL),
(6, 'STUDENT LIBRARY', 'LIBRARY', 'scatimg642bb492f2fb3.jpg', 'library', 'bharath', 'education', '', '', '', '', '', '1', 'a', 2, 5, 34, '2023-04-04', 'admin', '2023-04-04', 'admin'),
(7, 'ARTS &amp; PERFORMANCE', '', 'scatimg642bb5fcd8167.jpg', '', '', '', '', '', '', '', '', '2', 'a', 2, 6, 37, '2023-04-04', 'admin', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bnr_mst`
--
ALTER TABLE `bnr_mst`
  ADD PRIMARY KEY (`bnrm_id`);

--
-- Indexes for table `brnd_mst`
--
ALTER TABLE `brnd_mst`
  ADD PRIMARY KEY (`brndm_name`),
  ADD KEY `brndm_id` (`brndm_id`);

--
-- Indexes for table `lgntrck_mst`
--
ALTER TABLE `lgntrck_mst`
  ADD PRIMARY KEY (`lgntrckm_id`),
  ADD KEY `FK_lgntrck_mst` (`lgntrckm_lgnm_id`);

--
-- Indexes for table `lgn_mst`
--
ALTER TABLE `lgn_mst`
  ADD PRIMARY KEY (`lgnm_uid`),
  ADD UNIQUE KEY `lgnm_id` (`lgnm_id`);

--
-- Indexes for table `prodcat_mst`
--
ALTER TABLE `prodcat_mst`
  ADD PRIMARY KEY (`prodcatm_name`),
  ADD KEY `prodcatm_id` (`prodcatm_id`);

--
-- Indexes for table `prodmnlnks_mst`
--
ALTER TABLE `prodmnlnks_mst`
  ADD PRIMARY KEY (`prodmnlnksm_id`);

--
-- Indexes for table `prodscat_mst`
--
ALTER TABLE `prodscat_mst`
  ADD PRIMARY KEY (`prodscatm_id`,`prodscatm_name`,`prodscatm_prodcatm_id`),
  ADD UNIQUE KEY `prodscatm_id` (`prodscatm_id`),
  ADD UNIQUE KEY `prodscatm_id_2` (`prodscatm_id`),
  ADD KEY `prodcatm_id` (`prodscatm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bnr_mst`
--
ALTER TABLE `bnr_mst`
  MODIFY `bnrm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brnd_mst`
--
ALTER TABLE `brnd_mst`
  MODIFY `brndm_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lgntrck_mst`
--
ALTER TABLE `lgntrck_mst`
  MODIFY `lgntrckm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lgn_mst`
--
ALTER TABLE `lgn_mst`
  MODIFY `lgnm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodcat_mst`
--
ALTER TABLE `prodcat_mst`
  MODIFY `prodcatm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prodmnlnks_mst`
--
ALTER TABLE `prodmnlnks_mst`
  MODIFY `prodmnlnksm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `prodscat_mst`
--
ALTER TABLE `prodscat_mst`
  MODIFY `prodscatm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

