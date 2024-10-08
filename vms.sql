-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 08:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(100) NOT NULL,
  `parent_id` int(200) NOT NULL,
  `child_name` varchar(200) NOT NULL,
  `child_age` enum('Under 6 months','6 months to 1 year','1 year','2 year','3 year','4 year','5 year','6 year and above','Other') NOT NULL,
  `hospital` int(200) NOT NULL,
  `vaccine` int(200) NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `rejection_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `parent_id`, `child_name`, `child_age`, `hospital`, `vaccine`, `date`, `status`, `rejection_reason`) VALUES
(7, 1, 'Zawiyar', '1 year', 5, 32, '2024-10-25', 'approved', NULL),
(8, 6, 'talha', '4 year', 3, 42, '2024-10-10', 'pending', NULL),
(9, 4, 'Musfirah', '1 year', 3, 42, '2024-10-30', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `avail_vaccines`
--

CREATE TABLE `avail_vaccines` (
  `id` int(255) NOT NULL,
  `Vac_id` int(255) NOT NULL,
  `Hosp_Name` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avail_vaccines`
--

INSERT INTO `avail_vaccines` (`id`, `Vac_id`, `Hosp_Name`) VALUES
(3, 42, 3),
(4, 33, 6),
(9, 27, 5),
(10, 32, 5),
(11, 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `Subject`, `Message`) VALUES
(1, 1, 'Vaccination Inquiry', 'I need an appointment for vaccination. Could you please let me know the available dates?'),
(2, 6, 'Appointment Request', 'I need an appointment for vaccination. Could you please let me know the available dates?'),
(5, 4, 'HTBTH', 'GVHTYTJYUJU');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(255) NOT NULL,
  `Hospital_Name` varchar(255) NOT NULL,
  `Hospital_License` varchar(255) NOT NULL,
  `Hospital_Password` varchar(255) NOT NULL,
  `Email_id` varchar(255) NOT NULL,
  `Hospital_Address` varchar(255) NOT NULL,
  `Hospital_Number` int(13) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `Hospital_Name`, `Hospital_License`, `Hospital_Password`, `Email_id`, `Hospital_Address`, `Hospital_Number`, `status`) VALUES
(1, 'Aga Khan', 'HOC1234', 'agakhan', 'Agakhan@gmail.com', 'National Stadium Road', 2147483647, '0'),
(3, 'Liaquat Hospital', 'HDO158932', 'liaquat123', 'liaquat@gmail.com', 'National Stadium Road', 920323382, '0'),
(4, 'Hub Clinic', 'TOC1234', 'hub', 'hub@gmail.com', 'lalukhet', 1235674634, '0'),
(5, 'National', 'TBT154', '1', 'national@gmail.com', 'blacndas', 231312, '0'),
(6, 'MediCare', 'MDG4321', '123', 'medicare@gmail.com', 'dummy Address', 1923432438, '0'),
(7, 'oakwood', 'MDG4321', '123', 'oakwood@gmail.com', 'dummy Address', 1923432438, '0'),
(8, 'IbneSina', 'NKFS42', '123', 'ibnesina@gmail.com', 'dummy Address', 1923432438, '0'),
(9, 'Haven Health Clinic', 'HHC483', '123', 'HHClinic@gmail.com', 'dummy Address', 1923432438, '0'),
(10, 'Pincrest', 'PCDR424', '123', 'pincrest@gmail.com', 'dummy Address', 1923432438, '0'),
(11, 'Riverside', 'RTF342', '123', 'riverside@gmail.com', 'dummy Address', 1923432438, '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Users_Name` varchar(255) NOT NULL,
  `Users_Password` varchar(255) NOT NULL,
  `Users_Number` int(11) NOT NULL,
  `Uses_Address` varchar(255) NOT NULL,
  `Users_CNIC` int(14) NOT NULL,
  `Email_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Users_Name`, `Users_Password`, `Users_Number`, `Uses_Address`, `Users_CNIC`, `Email_id`) VALUES
(1, 'Syed Hamza', '12341234', 2147483647, 'Jahangir Road', 124324, 'syed.hamza2004@gmail.com'),
(4, 'Syed Ali', '123', 2147483647, 'Jahangir Road', 2147483647, 's.ali@gmail.com'),
(5, 'Zaid Kamanger', '123', 2147483647, 'sanitary market', 7866453, 'zaid@gmail.com'),
(6, 'arooba khan', '12333333', 215789887, ' gulberg  F.B area Karachi', 2147483647, 'arooba123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `Vac_id` int(255) NOT NULL,
  `Vaccine_Name` varchar(255) NOT NULL,
  `Vaccine_Desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`Vac_id`, `Vaccine_Name`, `Vaccine_Desc`) VALUES
(27, 'Hepatitis B (HepB)', 'Protects against hepatitis B virus, which can cause chronic liver infection, liver failure, and liver cancer.\r\n\r\n'),
(28, 'DTaP', 'Combats three serious diseases: diphtheria (throat infection), tetanus (muscle stiffness), and pertussis (whooping cough).\r\n\r\n'),
(29, 'Hib', 'Prevents infections like bacterial meningitis, pneumonia, and epiglottitis caused by the Hib bacteria.\r\n\r\n'),
(30, 'Polio (IPV)', 'Protects against poliovirus, which can cause paralysis and permanent disability.\r\n\r\n'),
(31, 'Pneumococcal Conjugate (PCV13)', 'Guards against pneumococcal bacteria that can lead to pneumonia, meningitis, and blood infections.\r\n\r\n'),
(32, 'Rotavirus (RV)', 'Shields infants from rotavirus, a common cause of severe diarrhea and vomiting in young children.\r\n\r\n'),
(33, 'MMR', 'Protects against three viral infections: measles (rash and fever), mumps (swollen glands), and rubella (German measles).\r\n\r\n'),
(34, 'Varicella (Chickenpox)', 'Prevents chickenpox, a contagious disease characterized by an itchy rash and fever.\r\n\r\n'),
(35, 'Hepatitis A (HepA)', 'Protects against hepatitis A virus, which can cause liver disease and jaundice.\r\n\r\n'),
(36, 'Influenza', 'Protects against seasonal influenza, which can cause severe respiratory illness, especially in young children.\r\n\r\n'),
(37, 'MenACWY ', 'Guards against meningococcal disease, which can lead to bacterial meningitis and bloodstream infections.\r\n\r\n'),
(38, 'Human Papillomavirus (HPV)', 'Recommended for older children and adolescents, this vaccine protects against HPV, which can cause cervical and other cancers.\r\n\r\n'),
(39, 'Japanese Encephalitis (JE) Vaccine', 'Recommended for children living in or traveling to areas where this mosquito-borne virus is common. It protects against a brain infection caused by the JE virus.\r\n\r\n'),
(40, 'Typhoid Vaccine', 'Protects against typhoid fever, a serious illness caused by Salmonella Typhi bacteria, recommended for children traveling to or living in areas where typhoid is common.\r\n\r\n'),
(41, 'Bacillus Calmette-Guerin (BCG)', 'Prevents tuberculosis (TB) in children, especially severe forms like TB meningitis. It is commonly administered in countries with high TB prevalence.\r\n\r\n'),
(42, 'Hepatitis E Vaccine', 'Protects against hepatitis E virus, which can cause liver inflammation, particularly recommended in areas where hepatitis E is common.\r\n\r\n'),
(43, 'Yellow Fever Vaccine', 'Recommended for children over 9 months of age traveling to or living in areas with risk of yellow fever, a mosquito-borne viral disease.\r\n\r\n'),
(44, 'Rabies Vaccine', 'Administered for children at high risk of exposure to rabies (e.g., due to bites from potentially rabid animals or travel to high-risk areas).\r\n\r\n'),
(45, 'Administered for children at high risk of exposure to rabies (e.g., due to bites from potentially rabid animals or travel to high-risk areas).', 'Protects against cholera, a bacterial disease causing severe diarrhea, recommended for travelers to high-risk areas or during outbreaks.\r\n\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `hospital` (`hospital`),
  ADD KEY `vaccine` (`vaccine`);

--
-- Indexes for table `avail_vaccines`
--
ALTER TABLE `avail_vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_fk` (`Hosp_Name`),
  ADD KEY `v_fk` (`Vac_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`Vac_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `avail_vaccines`
--
ALTER TABLE `avail_vaccines`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `Vac_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`hospital`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`vaccine`) REFERENCES `vaccines` (`Vac_id`);

--
-- Constraints for table `avail_vaccines`
--
ALTER TABLE `avail_vaccines`
  ADD CONSTRAINT `h_fk` FOREIGN KEY (`Hosp_Name`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `v_fk` FOREIGN KEY (`Vac_id`) REFERENCES `vaccines` (`Vac_id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
