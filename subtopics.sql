-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2017 at 11:51 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kings_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `subtopics`
--

CREATE TABLE `subtopics` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `stid` int(11) NOT NULL COMMENT 'subtopic id (if exists)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subtopics`
--

INSERT INTO `subtopics` (`id`, `tid`, `name`, `stid`) VALUES
(1, 18, 'ასო-ბგერა', 0),
(2, 18, 'მარცვალი', 0),
(3, 18, 'წინადადება, წინადადების ტიპები', 0),
(4, 18, 'საკუთარი სახელი', 0),
(5, 18, 'მხოლობითი და მრავლობითი რიცხვი', 0),
(6, 18, 'მოქმედების აღმნიშვნელი სიტყვები', 0),
(7, 20, 'საპირისპირო და მსგავსი მნიშვნელობის სიტყვები', 0),
(8, 20, 'ანდაზა', 0),
(9, 24, 'წინადადების ტიპები', 0),
(10, 24, 'არსებითი სახელი', 0),
(11, 24, 'თანდებული', 0),
(12, 26, 'სინონიმები-ანტონიმები', 0),
(13, 24, 'ზმნა', 0),
(14, 24, 'ზმნიზედა', 0),
(15, 24, 'ნაცვალსახელი', 0),
(16, 24, 'ზედსართავი სახელი', 0),
(17, 24, 'რიცხვითი სახელი', 0),
(18, 26, 'ბარბარიზმები', 0),
(19, 26, 'აფორიზმი', 0),
(20, 26, 'გაპიროვნება', 0),
(21, 24, 'არსებითი სახელის ჯგუფები', 10),
(22, 24, 'არსებით სახელთა ბრუნვა ბრუნვა', 10),
(23, 24, 'მხოლობითი და მრავლობითი რიცხვი', 21),
(24, 24, 'საკუთარი და საზოგადო არსებითი სახელები', 21),
(25, 24, 'ვინ ჯგუფის და რა ჯგუფის არსებითი სახელები', 21),
(26, 24, 'სახელის ფუძე', 22),
(27, 24, 'ბრუნვის ნიშნები', 22),
(28, 24, 'კუმშვა და კვეცა', 22),
(29, 24, 'ზმნის უღლება, პირისა და რიცხვის ნიშნები', 13),
(30, 24, 'დრო', 13),
(31, 24, 'ზმნისწინი', 13),
(32, 24, 'პირის ნაცვალსახელი', 15),
(33, 24, 'კუთვნილებითი ნაცვალსახელი', 15),
(34, 24, 'ჩვენებითი ნაცვალსახელი', 15),
(35, 24, 'რაოდენობითი რიცხვითი სახელი', 17),
(36, 24, 'რიგობითი რიცხვითი სახელი', 17),
(37, 24, 'რიცხვით სახელთა მართლწერა', 17),
(39, 21, 'სიტყვა', 0),
(40, 21, 'წინადადება', 0),
(41, 21, 'მარცვალი', 0),
(42, 21, 'არსებითი სახელი', 0),
(43, 21, 'ზედსართავი სახელი', 0),
(44, 21, 'რიცხვითი სახელი', 0),
(45, 21, 'ნაცვალსახელი', 0),
(46, 21, 'დრო', 0),
(47, 21, 'ზმნა', 0),
(48, 21, 'პუნქტუაცია', 0),
(49, 23, 'სინონიმი/ანტონიმი', 0),
(50, 23, 'სიტყვის განმარტება', 0),
(51, 23, 'ფრაზეოლოგიზმი', 0),
(52, 23, 'ანდაზა', 0),
(53, 23, 'გამოცანა', 0),
(54, 23, 'ზოგადი', 0),
(55, 21, 'სულიერი/უსულო', 42),
(56, 21, 'ვინ/რა', 42),
(57, 21, 'მხ.რ./მრ.რ.', 42),
(58, 21, 'ბრუნება', 42),
(59, 21, 'კუმშვა-კვეცა', 42),
(60, 27, 'წინადადება', 0),
(61, 27, 'არსებითი სახელი', 0),
(62, 27, 'ზედსართავი სახელი', 0),
(63, 27, 'რიცხვითი სახელი', 0),
(64, 27, 'ნაცვალსახელი', 0),
(65, 27, 'ზმნა', 0),
(66, 27, 'ზმნისწინი', 0),
(67, 27, 'თანდებული', 0),
(68, 27, 'შორისდებული', 0),
(69, 27, 'აფიქსები', 0),
(70, 27, 'პუნქტუაცია', 0),
(71, 27, 'შინაარსი', 60),
(72, 27, 'წევრები', 60),
(73, 27, 'აგებულება', 60),
(74, 27, 'პირდაპირი/ირიბი თქმა', 60),
(75, 27, 'ფუძე', 61),
(76, 27, 'ჯგუფები', 61),
(77, 27, 'ბრუნება', 61),
(78, 27, 'რიცხვი', 61),
(79, 27, 'კვეცა–კუმშვა', 61),
(80, 27, 'მართლწერა', 61),
(81, 27, 'ხარისხის ფორმები', 62),
(82, 27, 'ბრუნება', 62),
(83, 27, 'მსაზღვრელ–საზღვრული', 62),
(84, 27, 'მართლწერა', 62),
(85, 27, 'ჯგუფები', 63),
(86, 27, 'ბრუნება', 63),
(87, 27, 'მართლწერა', 63),
(88, 27, 'ჯგუფები', 64),
(89, 27, 'ბრუნება', 64),
(90, 27, 'მართლწერა', 64),
(91, 27, 'მოქმედი პირები', 65),
(92, 27, 'ფუძემონაცვლე ზმნები', 65),
(93, 27, 'დრო', 65),
(94, 27, 'რიცხვი', 65),
(95, 29, 'სინონიმი', 0),
(96, 29, 'ანტონიმი', 0),
(97, 29, 'ომონიმი', 0),
(98, 29, 'არქაიზმი', 0),
(99, 29, 'ბარბარიზმი', 0),
(100, 29, 'პარონიმები', 0),
(101, 29, 'დიალექტიზმი', 0),
(102, 29, 'სიტყვა', 0),
(103, 29, 'ფრაზეოლოგიზმი', 0),
(104, 29, 'ანდაზა', 0),
(105, 29, 'მხატვრული ხერხი', 0),
(106, 29, 'პერიფრაზი', 0),
(107, 29, 'ციტატა', 0),
(108, 29, 'რიტორიკული გამოთქმები', 0),
(109, 29, 'ზოგადი', 0),
(110, 29, 'შედარება', 105),
(111, 29, 'ეპითეტი', 105),
(112, 29, 'მეტაფორა', 105),
(113, 29, 'ჰიპერბოლა', 105),
(114, 29, 'გაპიროვნება', 105),
(115, 29, 'ალეგორია', 105),
(116, 29, 'გამეორება', 105),
(117, 30, 'წინადადება', 0),
(118, 30, 'არსებითი სახელი', 0),
(119, 30, 'ზედსართავი სახელი', 0),
(120, 30, 'რიცხვითი სახელი', 0),
(121, 30, 'ნაცვალსახელი', 0),
(122, 30, 'ზმნა', 0),
(123, 30, 'ზმნიზედა', 0),
(124, 30, 'ზმნისწინი', 0),
(125, 30, 'შესიტყვება', 0),
(126, 30, 'სხვათა სიტყვა', 0),
(127, 30, 'თანდებული', 0),
(128, 30, 'შორისდებული', 0),
(129, 30, 'აფიქსები', 0),
(130, 30, 'პუნქტუაცია', 0),
(131, 30, 'შინაარსი', 117),
(132, 30, 'წევრები', 117),
(133, 30, 'აგებულება', 117),
(134, 30, 'პირდაპირი/ირიბი თქმა', 117),
(135, 30, 'ფუძე', 118),
(136, 30, 'ჯგუფები', 118),
(137, 30, 'ბრუნება', 118),
(138, 30, 'რიცხვი', 118),
(139, 30, 'კვეცა–კუმშვა', 118),
(140, 30, 'მართლწერა', 118),
(141, 30, 'ჯგუფები', 119),
(142, 30, 'ხარისხის ფორმები', 119),
(143, 30, 'ბრუნება', 119),
(144, 30, 'მსაზღვრელ–საზღვრული', 119),
(145, 30, 'მართლწერა', 119),
(146, 30, 'ჯგუფები', 120),
(147, 30, 'ბრუნება', 120),
(148, 30, 'მართლწერა', 120),
(149, 30, 'ჯგუფები', 121),
(150, 30, 'კითხვითი ნაცვალსახელი', 121),
(151, 30, 'ბრუნება', 121),
(152, 30, 'მართლწერა', 121),
(153, 30, 'მოქმედი პირები', 122),
(154, 30, 'დრო', 122),
(155, 30, 'რიცხვი', 122),
(156, 30, 'პირის ნიშნები', 122),
(157, 30, 'ასპექტი', 122),
(158, 30, 'ქცევა', 122),
(159, 32, 'სინონიმი', 0),
(160, 32, 'ანტონიმი', 0),
(161, 32, 'ომონიმი', 0),
(162, 32, 'არქაიზმი', 0),
(163, 32, 'ბარბარიზმი', 0),
(164, 32, 'პარონიმები', 0),
(165, 32, 'დიალექტიზმი', 0),
(166, 32, 'სიტყვა', 0),
(167, 32, 'ფრაზეოლოგიზმი', 0),
(168, 32, 'ანდაზა', 0),
(169, 32, 'მხატვრული ხერხი', 0),
(170, 32, 'პერიფრაზი', 0),
(171, 32, 'ციტატა', 0),
(172, 32, 'რიტორიკული გამოთქმები', 0),
(173, 32, 'ზოგადი', 0),
(174, 32, 'შედარება', 169),
(175, 32, 'ეპითეტი', 169),
(176, 32, 'მეტაფორა', 169),
(177, 32, 'ჰიპერბოლა', 169),
(178, 32, 'გაპიროვნება', 169),
(179, 32, 'ალეგორია', 169),
(180, 32, 'გამეორება', 169),
(181, 33, 'წინადადება', 0),
(182, 33, 'არსებითი სახელი', 0),
(183, 33, 'ზედსართავი სახელი', 0),
(184, 33, 'რიცხვითი სახელი', 0),
(185, 33, 'ნაცვალსახელი', 0),
(186, 33, 'ზმნა', 0),
(187, 33, 'ზმნიზედა', 0),
(188, 33, 'ზმნისწინი', 0),
(189, 33, 'შესიტყვება', 0),
(190, 33, 'სხვათა სიტყვა', 0),
(191, 33, 'თანდებული', 0),
(192, 33, 'შორისდებული', 0),
(193, 33, 'ნაწილაკი', 0),
(194, 33, 'აფიქსები', 0),
(195, 33, 'პუნქტუაცია', 0),
(196, 33, 'შინაარსი', 181),
(197, 33, 'წევრები', 181),
(198, 33, 'აგებულება', 181),
(199, 33, 'პირდაპირი/ირიბი თქმა', 181),
(200, 33, 'ფუძე', 182),
(201, 33, 'ჯგუფები', 182),
(202, 33, 'ბრუნება', 182),
(203, 33, 'რიცხვი', 182),
(204, 33, 'კვეცა–კუმშვა', 182),
(205, 33, 'მართლწერა', 182),
(206, 33, 'ჯგუფები', 183),
(207, 33, 'ხარისხის ფორმები', 183),
(208, 33, 'ბრუნება', 183),
(209, 33, 'მსაზღვრელ–საზღვრული', 183),
(210, 33, 'მართლწერა', 183),
(211, 33, 'ჯგუფები', 184),
(212, 33, 'ბრუნება', 184),
(213, 33, 'მართლწერა', 184),
(214, 33, 'ჯგუფები', 185),
(215, 33, 'კითხვითი ნაცვალსახელი', 185),
(216, 33, 'ბრუნება', 185),
(217, 33, 'მართლწერა', 185),
(218, 33, 'მოქმედი პირები', 186),
(219, 33, 'დრო', 186),
(220, 33, 'რიცხვი', 186),
(221, 33, 'პირის ნიშნები', 186),
(222, 33, 'ასპექტი', 186),
(223, 33, 'ქცევა', 186),
(224, 35, 'სინონიმი', 0),
(225, 35, 'ანტონიმი', 0),
(226, 35, 'ომონიმი', 0),
(227, 35, 'არქაიზმი', 0),
(228, 35, 'ბარბარიზმი', 0),
(229, 35, 'პარონიმები', 0),
(230, 35, 'დიალექტიზმი', 0),
(231, 35, 'სიტყვა', 0),
(232, 35, 'ფრაზეოლოგიზმი', 0),
(233, 35, 'ანდაზა', 0),
(234, 35, 'მხატვრული ხერხი', 0),
(235, 35, 'პერიფრაზი', 0),
(236, 35, 'ციტატა', 0),
(237, 35, 'რიტორიკული გამოთქმები', 0),
(238, 35, 'რითმა', 0),
(239, 35, 'ჩართული', 0),
(240, 35, 'ზოგადი', 0),
(241, 35, 'შედარება', 234),
(242, 35, 'ეპითეტი', 234),
(243, 35, 'მეტაფორა', 234),
(244, 35, 'ჰიპერბოლა', 234),
(245, 35, 'გაპიროვნება', 234),
(246, 35, 'ალეგორია', 234),
(247, 35, 'გამეორება', 234),
(248, 35, 'ზუსტი', 238),
(249, 35, 'არაზუსტი', 238),
(250, 35, 'ჯვარედინი', 238),
(251, 35, 'რკალური', 238),
(252, 35, 'ინტერვალიანი', 238),
(253, 35, 'მოსაზღვრე(პარალელური)', 238),
(254, 35, 'ასონანსი', 238),
(255, 35, 'ალიტერაცია', 238),
(256, 35, 'აფორიზმი', 0),
(257, 35, 'ნეოლოგიზმი', 0),
(258, 36, 'წინადადება', 0),
(259, 36, 'არსებითი სახელი', 0),
(260, 36, 'ზედსართავი სახელი', 0),
(261, 36, 'რიცხვითი სახელი', 0),
(262, 36, 'ნაცვალსახელი', 0),
(263, 36, 'ზმნა', 0),
(264, 36, 'ზმნიზედა', 0),
(265, 36, 'ზმნისწინი', 0),
(266, 36, 'შესიტყვება', 0),
(267, 36, 'სხვათა სიტყვა', 0),
(268, 36, 'თანდებული', 0),
(269, 36, 'შორისდებული', 0),
(270, 36, 'ნაწილაკი', 0),
(271, 36, 'აფიქსები', 0),
(272, 36, 'კალკი', 0),
(273, 36, 'პუნქტუაცია', 0),
(274, 36, 'შინაარსი', 258),
(275, 36, 'წევრები', 258),
(276, 36, 'აგებულება', 258),
(277, 36, 'პირდაპირი/ირიბი თქმა', 258),
(278, 36, 'ფუძე', 259),
(279, 36, 'ჯგუფები', 259),
(280, 36, 'ბრუნება', 259),
(281, 36, 'რიცხვი', 259),
(282, 36, 'კვეცა–კუმშვა', 259),
(283, 36, 'მართლწერა', 259),
(284, 36, 'ჯგუფები', 260),
(285, 36, 'ხარისხის ფორმები', 260),
(286, 36, 'ბრუნება', 260),
(287, 36, 'მსაზღვრელ–საზღვრული', 260),
(288, 36, 'ჯგუფები', 261),
(289, 36, 'ბრუნება', 261),
(290, 36, 'მართლწერა', 261),
(291, 36, 'ჯგუფები', 262),
(292, 36, 'კითხვითი ნაცვალსახელი', 262),
(293, 36, 'ბრუნება', 262),
(294, 36, 'მართლწერა', 262),
(295, 36, 'მოქმედი პირები', 263),
(296, 36, 'დრო', 263),
(297, 36, 'რიცხვი', 263),
(298, 36, 'პირის ნიშნები', 263),
(299, 36, 'ასპექტი', 263),
(300, 36, 'ქცევა', 263),
(301, 38, 'სინონიმი', 0),
(302, 38, 'ანტონიმი', 0),
(303, 38, 'ომონიმი', 0),
(304, 38, 'არქაიზმი', 0),
(305, 38, 'ბარბარიზმი', 0),
(306, 38, 'პარონიმები', 0),
(307, 38, 'დიალექტიზმი', 0),
(308, 38, 'სიტყვა', 0),
(309, 38, 'ფრაზეოლოგიზმი', 0),
(310, 38, 'ანდაზა', 0),
(311, 38, 'მხატვრული ხერხი', 0),
(312, 38, 'პერიფრაზი', 0),
(313, 38, 'ციტატა', 0),
(314, 38, 'რიტორიკული გამოთქმები', 0),
(315, 38, 'სიუჟეტი', 0),
(316, 38, 'რითმა', 0),
(317, 38, 'ჟანრები', 0),
(318, 38, 'ალუზია', 0),
(319, 38, 'ჩართული', 0),
(320, 38, 'ზოგადი', 0),
(321, 38, 'შედარება', 311),
(322, 38, 'ეპითეტი', 311),
(323, 38, 'მეტაფორა', 311),
(324, 38, 'ჰიპერბოლა', 311),
(325, 38, 'გაპიროვნება', 311),
(326, 38, 'ალეგორია', 311),
(327, 38, 'გამეორება', 311),
(328, 38, 'ზუსტი', 316),
(329, 38, 'არაზუსტი', 316),
(330, 38, 'ჯვარედინი', 316),
(331, 38, 'რკალური', 316),
(332, 38, 'ინტერვალიანი', 316),
(333, 38, 'მოსაზღვრე(პარალელური)', 316),
(334, 38, 'ასონანსი', 316),
(335, 38, 'ალიტერაცია', 316),
(336, 38, 'კომედია', 317),
(337, 38, 'ბალადა', 317),
(338, 41, 'ბალადა', 358),
(339, 41, 'კომედია', 358),
(340, 41, 'ალიტერაცია', 359),
(341, 41, 'ასონანსი', 359),
(342, 41, 'მოსაზღვრე(პარალელური)', 359),
(343, 41, 'ინტერვალიანი', 359),
(344, 41, 'რკალური', 359),
(345, 41, 'ჯვარედინი', 359),
(346, 41, 'არაზუსტი', 359),
(347, 41, 'ზუსტი', 359),
(348, 41, 'გამეორება', 364),
(349, 41, 'ალეგორია', 364),
(350, 41, 'გაპიროვნება', 364),
(351, 41, 'ჰიპერბოლა', 364),
(352, 41, 'მეტაფორა', 364),
(353, 41, 'ეპითეტი', 364),
(354, 41, 'შედარება', 364),
(355, 41, 'ზოგადი', 0),
(356, 41, 'ჩართული', 0),
(357, 41, 'ალუზია', 0),
(358, 41, 'ჟანრები', 0),
(359, 41, 'რითმა', 0),
(360, 41, 'სიუჟეტი', 0),
(361, 41, 'რიტორიკული გამოთქმები', 0),
(362, 41, 'ციტატა', 0),
(363, 41, 'პერიფრაზი', 0),
(364, 41, 'მხატვრული ხერხი', 0),
(365, 41, 'ანდაზა', 0),
(366, 41, 'ფრაზეოლოგიზმი', 0),
(367, 41, 'სიტყვა', 0),
(368, 41, 'დიალექტიზმი', 0),
(369, 41, 'პარონიმები', 0),
(370, 41, 'ბარბარიზმი', 0),
(371, 41, 'არქაიზმი', 0),
(372, 41, 'ომონიმი', 0),
(373, 41, 'ანტონიმი', 0),
(374, 41, 'სინონიმი', 0),
(375, 39, 'ქცევა', 412),
(376, 39, 'ასპექტი', 412),
(377, 39, 'პირის ნიშნები', 412),
(378, 39, 'რიცხვი', 412),
(379, 39, 'დრო', 412),
(380, 39, 'მოქმედი პირები', 412),
(381, 39, 'მართლწერა', 413),
(382, 39, 'ბრუნება', 413),
(383, 39, 'კითხვითი ნაცვალსახელი', 413),
(384, 39, 'ჯგუფები', 413),
(385, 39, 'მართლწერა', 414),
(386, 39, 'ბრუნება', 414),
(387, 39, 'ჯგუფები', 414),
(388, 39, 'მსაზღვრელ–საზღვრული', 415),
(389, 39, 'ბრუნება', 415),
(390, 39, 'ხარისხის ფორმები', 415),
(391, 39, 'ჯგუფები', 415),
(392, 39, 'მართლწერა', 416),
(393, 39, 'კვეცა–კუმშვა', 416),
(394, 39, 'რიცხვი', 416),
(395, 39, 'ბრუნება', 416),
(396, 39, 'ჯგუფები', 416),
(397, 39, 'ფუძე', 416),
(398, 39, 'პირდაპირი/ირიბი თქმა', 417),
(399, 39, 'აგებულება', 417),
(400, 39, 'წევრები', 417),
(401, 39, 'შინაარსი', 417),
(402, 39, 'პუნქტუაცია', 0),
(403, 39, 'კალკი', 0),
(404, 39, 'აფიქსები', 0),
(405, 39, 'ნაწილაკი', 0),
(406, 39, 'შორისდებული', 0),
(407, 39, 'თანდებული', 0),
(408, 39, 'სხვათა სიტყვა', 0),
(409, 39, 'შესიტყვება', 0),
(410, 39, 'ზმნისწინი', 0),
(411, 39, 'ზმნიზედა', 0),
(412, 39, 'ზმნა', 0),
(413, 39, 'ნაცვალსახელი', 0),
(414, 39, 'რიცხვითი სახელი', 0),
(415, 39, 'ზედსართავი სახელი', 0),
(416, 39, 'არსებითი სახელი', 0),
(417, 39, 'წინადადება', 0),
(418, 39, 'დამოკიდებული წინადადების სახეები', 417),
(419, 36, 'მართლწერა', 260),
(420, 39, 'მართლწერა', 415),
(421, 41, 'მაღალი და დაბალი შაირი', 359),
(422, 41, 'ასტროფია', 359),
(423, 41, 'მინიატურა', 358);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subtopics`
--
ALTER TABLE `subtopics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tid` (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subtopics`
--
ALTER TABLE `subtopics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
