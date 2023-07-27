-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 29, 2023 at 09:43 PM
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelicious`
--
CREATE DATABASE IF NOT EXISTS `laravelicious` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;
USE `laravelicious`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `meals`
--

CREATE TABLE `meals` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `Name` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `MealTypesId` int(11) NOT NULL,
  `CreationDateTime` datetime DEFAULT NULL,
  `CreatedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `EditDateTime` datetime DEFAULT NULL,
  `LastEditedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`Id`, `Title`, `Name`, `Price`, `MealTypesId`, `CreationDateTime`, `CreatedBy`, `EditDateTime`, `LastEditedBy`, `Notes`, `IsActive`) VALUES
(1, 'Pomidorowa', 'Pomidorowa', 8.50, 1, '2023-05-22 00:18:48', 'admin', '2023-05-22 20:12:47', 'w', NULL, b'1'),
(2, 'Rosol', 'Rosół', 7.50, 1, '2023-05-22 00:18:48', 'admin', '2023-05-24 21:01:10', 'michal', NULL, b'1'),
(3, 'Spaghetti', 'Spaghetti', 18.00, 2, '2023-05-22 00:20:11', 'admin', NULL, NULL, NULL, b'1'),
(4, 'Pierogiruskie', 'Pierogi ruskie', 17.00, 2, '2023-05-22 00:20:48', 'admin', NULL, NULL, NULL, b'1'),
(5, 'Sernik', 'Sernik', 12.00, 3, '2023-05-22 00:21:30', 'admin', NULL, NULL, NULL, b'1'),
(6, 'Plackipowegiersku', 'Placki po węgiersku', 25.00, 2, '2023-05-22 18:18:35', 'admin', '2023-05-26 21:08:33', 'michal', NULL, b'1'),
(7, 'Lody', 'Lody', 7.00, 3, '2023-05-22 00:11:44', 'w', '2023-05-22 00:12:07', 'w', NULL, b'1'),
(9, 'Woda', 'Woda', 4.00, 4, '2023-05-24 21:08:08', 'michal', '2023-05-24 21:08:08', 'michal', NULL, b'1'),
(11, 'q', 'q', 0.00, 1, '2023-05-24 22:36:51', 'michal', '2023-05-24 22:36:56', 'michal', NULL, b'0'),
(12, 'q', 'q', 0.00, 1, '2023-05-24 22:37:22', 'michal', '2023-05-24 22:37:25', 'michal', NULL, b'0'),
(13, 'q', 'q', 0.00, 1, '2023-05-24 22:38:17', 'michal', '2023-05-24 22:38:19', 'michal', NULL, b'0'),
(14, 'q', 'q', 0.00, 1, '2023-05-24 22:38:37', 'michal', '2023-05-24 22:39:58', 'michal', NULL, b'0'),
(15, 'q', 'q', 0.00, 1, '2023-05-24 22:39:54', 'michal', '2023-05-24 22:39:57', 'michal', NULL, b'0'),
(16, 'q', 'q', 0.00, 1, '2023-05-24 22:40:51', 'michal', '2023-05-24 22:40:53', 'michal', NULL, b'0'),
(17, 'q', 'q', 0.00, 1, '2023-05-24 22:43:58', 'michal', '2023-05-24 22:44:01', 'michal', NULL, b'0'),
(18, 'q', 'q', 0.00, 1, '2023-05-24 22:48:52', 'michal', '2023-05-24 22:48:54', 'michal', NULL, b'0'),
(19, 'q', 'q', 1.00, 1, '2023-05-24 22:50:21', 'michal', '2023-05-24 22:50:23', 'michal', NULL, b'0'),
(20, '1', '1', 2.00, 1, '2023-05-29 19:36:46', 'michal', '2023-05-29 19:36:50', 'michal', NULL, b'0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mealtypes`
--

CREATE TABLE `mealtypes` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `Name` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL,
  `CreationDateTime` datetime DEFAULT NULL,
  `CreatedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `EditDateTime` datetime DEFAULT NULL,
  `LastEditedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `mealtypes`
--

INSERT INTO `mealtypes` (`Id`, `Title`, `Name`, `CreationDateTime`, `CreatedBy`, `EditDateTime`, `LastEditedBy`, `Notes`, `IsActive`) VALUES
(1, 'Zupa', 'Zupa', '2023-05-22 00:13:45', 'admin', NULL, NULL, NULL, b'1'),
(2, 'Danie', 'Danie główne', '2023-05-22 00:15:00', 'admin', NULL, NULL, NULL, b'1'),
(3, 'Deser', 'Deser', '2023-05-22 00:15:49', 'admin', NULL, NULL, NULL, b'1'),
(4, 'Napoj', 'Napój', '2023-05-24 21:07:41', 'michal', '2023-05-24 21:24:45', 'michal', NULL, b'1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ordermeals`
--

CREATE TABLE `ordermeals` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `OrdersId` int(11) NOT NULL,
  `MealsId` int(11) NOT NULL,
  `CreationDateTime` datetime DEFAULT NULL,
  `CreatedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `EditDateTime` datetime DEFAULT NULL,
  `LastEditedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `IsActive` bit(1) NOT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `ordermeals`
--

INSERT INTO `ordermeals` (`Id`, `Title`, `OrdersId`, `MealsId`, `CreationDateTime`, `CreatedBy`, `EditDateTime`, `LastEditedBy`, `Notes`, `IsActive`, `Amount`, `Price`) VALUES
(65, 'Pozycja-2', 47, 2, '2023-05-26 21:06:04', 'q', '2023-05-26 21:06:04', 'q', NULL, b'1', 1, 7.50),
(66, 'Pozycja-4', 47, 4, '2023-05-26 21:06:04', 'q', '2023-05-26 21:06:04', 'q', NULL, b'1', 1, 17.00),
(67, 'Pozycja-7', 47, 7, '2023-05-26 21:06:04', 'q', '2023-05-26 21:06:04', 'q', NULL, b'1', 1, 7.00),
(68, 'Pozycja-8', 47, 9, '2023-05-26 21:06:04', 'q', '2023-05-26 21:06:04', 'q', NULL, b'1', 1, 4.00),
(69, 'Pozycja-2', 48, 2, '2023-05-26 21:06:15', 'q', '2023-05-26 21:06:21', 'q', NULL, b'0', 0, 7.50),
(70, 'Pozycja-3', 48, 3, '2023-05-26 21:06:21', 'q', '2023-05-26 21:06:21', 'q', NULL, b'1', 1, 18.00),
(71, 'Pozycja-4', 49, 4, '2023-05-26 21:06:47', 'a', '2023-05-26 21:06:47', 'a', NULL, b'1', 2, 17.00),
(72, 'Pozycja-2', 50, 2, '2023-05-26 21:06:55', 'a', '2023-05-26 21:06:55', 'a', NULL, b'1', 2, 7.50),
(73, 'Pozycja-1', 51, 1, '2023-05-26 21:07:00', 'a', '2023-05-26 21:07:00', 'a', NULL, b'1', 1, 8.50),
(74, 'Pozycja-1', 52, 1, '2023-05-29 18:53:56', 'q', '2023-05-29 18:53:56', 'q', NULL, b'1', 12, 8.50),
(75, 'Pozycja-1', 54, 1, '2023-05-29 19:04:26', 'q', '2023-05-29 19:04:26', 'q', NULL, b'1', 13, 8.50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `OrderStatutsId` int(11) NOT NULL,
  `UsersId` int(11) NOT NULL,
  `CreationDateTime` datetime DEFAULT NULL,
  `CreatedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `EditDateTime` datetime DEFAULT NULL,
  `LastEditedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `Title`, `OrderStatutsId`, `UsersId`, `CreationDateTime`, `CreatedBy`, `EditDateTime`, `LastEditedBy`, `Notes`, `IsActive`) VALUES
(47, 'Zamówienie-q-26-05-2023-21:06:04', 1, 2, '2023-05-26 21:06:04', 'q', '2023-05-26 21:06:04', 'q', NULL, b'1'),
(48, 'Zamówienie-q-26-05-2023-21:06:15', 1, 2, '2023-05-26 21:06:15', 'q', '2023-05-26 21:07:42', 'q', NULL, b'0'),
(49, 'Zamówienie-a-26-05-2023-21:06:47', 2, 12, '2023-05-26 21:06:47', 'a', '2023-05-26 21:06:51', 'a', NULL, b'1'),
(50, 'Zamówienie-a-26-05-2023-21:06:55', 3, 12, '2023-05-26 21:06:55', 'a', '2023-05-26 21:06:57', 'a', NULL, b'1'),
(51, 'Zamówienie-a-26-05-2023-21:07:00', 1, 12, '2023-05-26 21:07:00', 'a', '2023-05-26 21:07:00', 'a', NULL, b'1'),
(52, 'Zamówienie-q-29-05-2023-18:53:56', 1, 2, '2023-05-29 18:53:56', 'q', '2023-05-29 18:53:56', 'q', NULL, b'1'),
(54, 'Zamówienie-q-29-05-2023-19:04:26', 1, 2, '2023-05-29 19:04:26', 'q', '2023-05-29 19:04:26', 'q', NULL, b'1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderstatuts`
--

CREATE TABLE `orderstatuts` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `Name` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL,
  `CreationDateTime` datetime DEFAULT NULL,
  `CreatedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `EditDateTime` datetime DEFAULT NULL,
  `LastEditedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `orderstatuts`
--

INSERT INTO `orderstatuts` (`Id`, `Title`, `Name`, `CreationDateTime`, `CreatedBy`, `EditDateTime`, `LastEditedBy`, `Notes`, `IsActive`) VALUES
(1, 'Zlozone', 'Złożone', '2023-05-22 00:26:33', 'admin', NULL, NULL, NULL, b'1'),
(2, 'Oplacone', 'Opłacone', '2023-05-22 00:26:33', 'admin', NULL, NULL, NULL, b'1'),
(3, 'Anulowane', 'Anulowane', '2023-05-22 00:27:44', 'admin', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `UserTypesId` int(11) NOT NULL,
  `CreationDateTime` datetime DEFAULT NULL,
  `CreatedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `EditDateTime` datetime DEFAULT NULL,
  `LastEditedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Title`, `Name`, `Password`, `UserTypesId`, `CreationDateTime`, `CreatedBy`, `EditDateTime`, `LastEditedBy`, `Notes`, `IsActive`) VALUES
(1, 'michal', 'michal', 'michal', 1, '2023-05-22 00:23:58', 'admin', NULL, NULL, NULL, b'1'),
(2, 'q', 'q', 'q', 2, '2023-05-22 00:23:58', 'admin', NULL, NULL, NULL, b'1'),
(12, 'a', 'a', 'a', 2, '2023-05-24 20:42:35', 'a', '2023-05-24 20:42:35', 'a', NULL, b'1'),
(14, 'qq', 'qq', 'a', 2, '2023-05-24 21:47:14', 'qq', '2023-05-24 21:47:14', 'qq', NULL, b'1'),
(15, 'zzzzzzz', 'zzzzzzz', 'zzzzzzzz', 2, '2023-05-24 21:53:22', 'zzzzzzz', '2023-05-24 21:53:22', 'zzzzzzz', NULL, b'1'),
(16, 'ccccccc', 'ccccccc', 'cccccccc', 2, '2023-05-29 19:37:24', 'ccccccc', '2023-05-29 19:37:24', 'ccccccc', NULL, b'1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `usertypes`
--

CREATE TABLE `usertypes` (
  `Id` int(11) NOT NULL,
  `Title` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `Name` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL,
  `CreationDateTime` datetime DEFAULT NULL,
  `CreatedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `EditDateTime` datetime DEFAULT NULL,
  `LastEditedBy` varchar(64) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`Id`, `Title`, `Name`, `CreationDateTime`, `CreatedBy`, `EditDateTime`, `LastEditedBy`, `Notes`, `IsActive`) VALUES
(1, 'Pracownik', 'Pracownik', '2023-05-22 00:22:43', 'admin', NULL, NULL, NULL, b'1'),
(2, 'Klient', 'Klient', '2023-05-22 00:22:43', 'admin', NULL, NULL, NULL, b'1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `MealTypesId` (`MealTypesId`);

--
-- Indeksy dla tabeli `mealtypes`
--
ALTER TABLE `mealtypes`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `ordermeals`
--
ALTER TABLE `ordermeals`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrdersId` (`OrdersId`),
  ADD KEY `MealsId` (`MealsId`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrderStatutsId` (`OrderStatutsId`),
  ADD KEY `UsersId` (`UsersId`);

--
-- Indeksy dla tabeli `orderstatuts`
--
ALTER TABLE `orderstatuts`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserTypesId` (`UserTypesId`);

--
-- Indeksy dla tabeli `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mealtypes`
--
ALTER TABLE `mealtypes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordermeals`
--
ALTER TABLE `ordermeals`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `orderstatuts`
--
ALTER TABLE `orderstatuts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`MealTypesId`) REFERENCES `mealtypes` (`Id`);

--
-- Constraints for table `ordermeals`
--
ALTER TABLE `ordermeals`
  ADD CONSTRAINT `ordermeals_ibfk_1` FOREIGN KEY (`OrdersId`) REFERENCES `orders` (`Id`),
  ADD CONSTRAINT `ordermeals_ibfk_2` FOREIGN KEY (`MealsId`) REFERENCES `meals` (`Id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`OrderStatutsId`) REFERENCES `orderstatuts` (`Id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`UsersId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserTypesId`) REFERENCES `usertypes` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
