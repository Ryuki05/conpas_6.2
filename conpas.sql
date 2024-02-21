-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-01-22 01:51:20
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `conpas`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `chatmessages`
--

CREATE TABLE `chatmessages` (
  `MessageID` int(11) NOT NULL,
  `SenderID` int(11) NOT NULL,
  `ReceiverID` int(11) NOT NULL,
  `MessageContent` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `Players`
--

CREATE TABLE `Players` (
  `ID` int(11) NOT NULL,
  `ImgName` VARCHAR(255) NOT NULL,
  `PlayerID` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Weight` decimal(5,2) DEFAULT NULL,
  `Height` decimal(5,2) DEFAULT NULL,
  `MuscleMass` decimal(5,2) DEFAULT NULL,
  `BMI` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `trainingnotes`
--

CREATE TABLE `trainingnotes` (
  `NoteID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL,
  `NoteContent` text DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Record_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `trainingsessions`
--

CREATE TABLE `trainingsessions` (
  `SessionID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `SessionDate` date NOT NULL,
  `Intensity` varchar(255) DEFAULT NULL,
  `SessionPurpose` varchar(255) DEFAULT NULL,
  `Reflection` text DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `WeekNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルの構造 `Record`
--

CREATE TABLE `Record`(
  `ID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `Match_Name` varchar(255) NOT NULL,
  `Match_Day` date NOT NULL,
  `Match_Results` varchar(255) DEFAULT NULL,
  `Reflect` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `Condition` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerID` int(11) NOT NULL,
  `Weight` decimal(5,2) DEFAULT NULL,
  `Height` decimal(5,2) DEFAULT NULL,
  `MuscleMass` decimal(5,2) DEFAULT NULL,
  `BMI` decimal(5,2) DEFAULT NULL,
  `Day` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- テーブルの構造 `videofiles`
--

CREATE TABLE `videofiles` (
  `FileID` int(11) NOT NULL,
  `FileName` varchar(255) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL,
  `FilePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルの構造 `image_table`
--

CREATE TABLE image_table (
    `FileID` INT AUTO_INCREMENT PRIMARY KEY,
    `PlayerID` INT NOT NULL,
    `ImgName` VARCHAR(255) NOT NULL
);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD PRIMARY KEY (`MessageID`);

--
-- テーブルのインデックス `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `trainingnotes`
--
ALTER TABLE `trainingnotes`
  ADD PRIMARY KEY (`NoteID`);

--
-- テーブルのインデックス `trainingsessions`
--
ALTER TABLE `trainingsessions`
  ADD PRIMARY KEY (`SessionID`);

--
-- テーブルのインデックス `videofiles`
--
ALTER TABLE `videofiles`
  ADD PRIMARY KEY (`FileID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `chatmessages`
--
ALTER TABLE `chatmessages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `players`
--
ALTER TABLE `players`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `trainingnotes`
--
ALTER TABLE `trainingnotes`
  MODIFY `NoteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `trainingsessions`
--
ALTER TABLE `trainingsessions`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `videofiles`
--
ALTER TABLE `videofiles`
  MODIFY `FileID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
