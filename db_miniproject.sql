-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 04:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_miniproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Adithyan PM', 'deconest001@gmail.com', 'DecoNest001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` varchar(50) NOT NULL,
  `booking_status` varchar(50) NOT NULL DEFAULT '0',
  `booking_amount` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `booking_status`, `booking_amount`, `user_id`, `booking_address`) VALUES
(1, '2025-09-04 21:49:49', '5', '300.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(2, '2025-08-04 21:52:18', '5', '1999.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(3, '2025-10-04 21:52:36', '5', '300.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(4, '2025-09-04 21:52:51', '3', '5999.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(5, '2025-09-29 21:57:28', '5', '7198.00', 2, 'Thiruvathira (H)\r\nPalayalam P. O, Mulanthuruthy,674689\r\nErnakulam'),
(6, '2025-10-04 21:57:53', '5', '1500.00', 2, 'Thiruvathira (H)\r\nPalayalam P. O, Mulanthuruthy,\r\nErnakulam'),
(7, '2025-09-04 22:02:51', '5', '400.00', 3, 'Thiruvathira (H)\r\nPalayalam P. O, \r\nErnakulam'),
(8, '2025-09-04 22:08:51', '5', '200.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(9, '2025-08-04 22:09:17', '5', '500.00', 1, 'Queens Way\r\nKottayam,pala \r\nIndia'),
(10, '2025-10-12 08:33:52', '1', '300.00', 1, 'Queens Way\r\n'),
(11, '2025-10-12 08:50:52', '5', '1497.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(12, '2025-09-12 08:52:08', '1', '400.00', 3, 'Queens Way\r\nKottayam,pala 654697\r\n68888888857'),
(13, '2025-10-12 08:53:22', '5', '897.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(14, '2025-10-12 09:05:03', '4', '99.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\n'),
(15, '2025-10-12 09:06:09', '3', '298.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(16, '2025-09-12 10:09:33', '5', '149.00', 2, 'Thiruvathira (H)\r\nPalayalam P. O, Mulanthuruthy,\r\nErnakulam'),
(17, '2025-10-12 10:10:20', '5', '399.00', 2, 'Thiruvathira (H)\r\nPalayalam P. O, Mulanthuruthy,\r\nErnakulam'),
(18, '2025-10-12 10:12:49', '3', '398.00', 2, 'Thiruvathira (H)\r\nPalayalam P. O, Mulanthuruthy,\r\n'),
(19, '2025-10-12 10:19:11', '5', '599.00', 2, 'Thiruvathira (H)\r\nPalayalam P. O, Mulanthuruthy,\r\nErnakulam'),
(20, '2025-10-12 21:50:58', '1', '9999.00', 1, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(21, '2025-10-12 23:18:17', '2', '900.00', 3, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(22, '2025-10-12 23:04:00', '2', '5999', 1, ''),
(23, '2025-10-12 23:05:28', '1', '400', 1, ''),
(24, '2025-10-12 23:16:58', '2', '1198', 3, 'Queens Way'),
(25, '2025-10-12 23:20:20', '2', '498.00', 3, 'Queens Way\r\nKottayam,pala 654697\r\nIndia'),
(26, '2025-10-12', '0', '', 1, ''),
(27, '2025-10-13 18:52:25', '4', '798.00', 3, 'kumarakom 678569 ,Alappuzha'),
(28, '2025-10-13 18:51:06', '3', '597', 3, 'kumarakom in land 646875'),
(29, '2025-10-13 18:56:56', '5', '199.00', 3, 'kumarakom 678569 ,Alappuzha'),
(30, '2025-10-13 18:53:45', '5', '299', 3, 'kumarakom 678569 ,Alappuzha');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL DEFAULT 1,
  `cart_status` varchar(50) NOT NULL DEFAULT '0',
  `booking_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_quantity`, `cart_status`, `booking_id`, `product_id`) VALUES
(1, 1, '1', 1, 62),
(2, 1, '1', 2, 54),
(3, 1, '1', 3, 62),
(4, 1, '1', 4, 57),
(5, 2, '1', 5, 59),
(6, 3, '1', 6, 48),
(7, 2, '1', 7, 53),
(8, 1, '1', 8, 53),
(9, 1, '1', 9, 34),
(11, 1, '1', 10, 62),
(12, 3, '1', 11, 51),
(13, 2, '1', 12, 53),
(14, 3, '1', 13, 61),
(15, 1, '1', 14, 5),
(16, 2, '1', 15, 36),
(17, 1, '1', 16, 18),
(18, 1, '1', 17, 46),
(19, 2, '1', 18, 60),
(20, 1, '1', 19, 43),
(21, 1, '1', 20, 63),
(22, 1, '1', 22, 28),
(24, 2, '1', 23, 53),
(27, 2, '1', 24, 43),
(28, 1, '1', 21, 34),
(29, 2, '1', 21, 53),
(30, 1, '1', 25, 39),
(31, 1, '1', 25, 29),
(32, 2, '0', 26, 53),
(33, 1, '1', 27, 62),
(34, 2, '1', 27, 58),
(36, 3, '1', 28, 60),
(38, 1, '1', 30, 61),
(39, 1, '1', 29, 60);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'New Arrivals'),
(2, 'Wall Decor'),
(3, 'Furniture & Furnishings'),
(4, 'Lighting'),
(5, 'Kitchen & Dining'),
(6, 'Outdoor & Garden Decor'),
(7, 'Smart Home & Modern Decor'),
(8, 'Home Decor');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_colour`
--

CREATE TABLE `tbl_colour` (
  `colour_id` int(11) NOT NULL,
  `colour_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_colour`
--

INSERT INTO `tbl_colour` (`colour_id`, `colour_name`) VALUES
(1, 'Other Colour'),
(2, 'Green'),
(3, 'Black'),
(4, 'White'),
(5, 'Blue'),
(7, 'Gold'),
(8, 'Gray'),
(9, 'Brown'),
(10, 'Silver');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_content` varchar(100) NOT NULL,
  `complaint_date` varchar(50) NOT NULL,
  `complaint_status` varchar(50) NOT NULL DEFAULT '0',
  `complaint_reply` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_content`, `complaint_date`, `complaint_status`, `complaint_reply`, `user_id`, `booking_id`) VALUES
(1, 'One Piece Is Broken', '2025-10-04 22:11:33', '0', '', 1, 8),
(2, 'Sometimes Website is down  ', '2025-10-04 22:42:55', '0', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customization`
--

CREATE TABLE `tbl_customization` (
  `customization_id` int(11) NOT NULL,
  `customization_content` varchar(200) NOT NULL,
  `customization_date` varchar(50) NOT NULL,
  `customization_status` varchar(50) NOT NULL DEFAULT '0',
  `customization_file` varchar(200) NOT NULL,
  `customization_amount` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `colour_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customization`
--

INSERT INTO `tbl_customization` (`customization_id`, `customization_content`, `customization_date`, `customization_status`, `customization_file`, `customization_amount`, `user_id`, `seller_id`, `colour_id`, `material_id`) VALUES
(1, 'iwant to draw in picture in material wood frame colour is goldesh', '2025-8-21', '6', '51ivkLbmPdL.AC_SX250.jpg', '450', 1, 1, 3, 3),
(2, 'iwant to draw in picture in material wood frame colour is goldesh', '2025-9-02', '4', '51ivkLbmPdL.AC_SX250.jpg', '450', 2, 2, 3, 3),
(3, 'this same item in change coilor in green in material glass', '2025-09-04', '3', '009A2382_330x.webp', '100', 1, 1, 2, 5),
(4, 'want tis itenm in colour silver ', '2025-10-12', '1', 'download (8).jfif', '7643', 1, 1, 10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'Thiruvananthapuram'),
(2, 'Kollam'),
(3, 'Pathanamthitta'),
(4, 'Idukki'),
(5, 'Kottayam'),
(6, 'Ernakulam'),
(7, 'Alappuzha'),
(8, 'Palakkad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(100) NOT NULL,
  `feedback_date` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_content`, `feedback_date`, `user_id`, `seller_id`) VALUES
(1, 'Very use full', '2025-10-04 22:13:31', 1, ''),
(2, 'good website ', '2025-10-13 18:47:55', 0, '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_file` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`material_id`, `material_name`) VALUES
(1, 'Others'),
(3, 'Wood'),
(4, 'Paper'),
(5, 'Glass'),
(7, 'Metails'),
(8, 'Stone & Ceramics'),
(9, 'Natural & Organic Elements'),
(10, 'Plastics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(1, 'Kovalam Beach', 1),
(2, 'Varkala', 1),
(3, 'Kollam Beach', 2),
(4, 'Sabarimala', 3),
(5, 'Vaikom', 5),
(6, 'Munnar', 4),
(7, 'Piravom', 6),
(8, 'Muvattupuzha', 6),
(9, 'Perumbavoor', 6),
(10, 'Ettumanoor', 5),
(11, 'Kochi', 6),
(12, 'Pala', 5),
(13, 'Kumarakom', 7),
(14, 'Otttappalam', 8),
(15, 'Mannarkkad', 8),
(16, 'Mulanthuruthy', 6),
(17, 'Thodupuzha', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_details` varchar(500) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_photo` varchar(200) NOT NULL,
  `product_date` varchar(50) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `colour_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_details`, `product_price`, `product_photo`, `product_date`, `subcategory_id`, `colour_id`, `material_id`, `seller_id`) VALUES
(1, 'Tufted Sofa', 'The image depicts a small, upholstered bench or footstool. It has a luxurious design with rolled arms on both sides and a tufted seat. The bench is covered in a grey velvet fabric and features nailhea', '10999', '009A0758_04ebec3f-1abf-41f4-9270-1faab098118d_330x.webp', '2025-08-02', 4, 8, 3, 1),
(2, 'Table', 'The image shows a round table with a blue and white decorative design, likely made of ceramic or porcelain. ', '599', '11_4_d8950582-6c89-4f61-8aa9-a2c0853a69fe_500x.webp', '2025-08-02', 14, 4, 8, 3),
(3, 'Pot', 'The pot is a decorative ceramic planter with a green and white floral pattern. It is elevated on a stand with gold-colored legs and black tips.', '199', 'WPOPLAMPBMLGLS1_LS_1.avif', '2025-08-02', 10, 2, 8, 2),
(4, 'Teapot', ' The image shows a glass teapot with a wooden handle and lid. Inside the teapot, there is a lemon, which suggests that the tea being prepared might be lemon tea.', '299', '009A8339_43803fc9-ad2c-4ef7-9c6b-5fe6952da94c_330x.webp', '2025-08-02', 8, 3, 5, 2),
(5, 'Light holder', 'The image shows a decorative tea light holder. It is a globe-shaped holder with intricate cut-out patterns, allowing light to shine through and create beautiful patterns on the surrounding surfaces. T', '99', 'download (8).jfif', '2025-08-02', 6, 7, 7, 1),
(6, 'Water Bottle', 'The image depicts a blue and white porcelain container with intricate floral designs. The container has a cylindrical shape and comes with a matching lid. The design is reminiscent of traditional Chin', '199', 'DSC_5598_500x.webp', '2025-08-02', 9, 5, 10, 2),
(7, 'Wall Decor', 'The image shows a hallway with a boho chic style. The main feature is a collection of woven baskets of various sizes and patterns arranged artistically on a dark-colored wall. The baskets are made fro', '249', 'download (9).jfif', '2025-09-02', 3, 1, 9, 1),
(8, 'Wall Decoration', 'The image depicts a wall decoration that features two pages from a historical newspaper. The left page has the headline \"WALL STREET CRASH!\" and discusses the financial crash known as Black Thursday i', '500', '009A7637_500x.webp', '2025-09-02', 2, 1, 4, 3),
(9, 'Wall Art', ' The image shows a decorative wall art piece consisting of two panels. Each panel features a floral design made of metal, with golden and grey shades. The flowers and leaves are intricately designed, ', '699', 'download (2).jpeg', '2025-09-02', 2, 7, 7, 2),
(10, 'Lamp', 'This image shows a decorative floor lamp with a unique and elegant design. The lamp features multiple light sources shaped like feathers, which are illuminated to create a warm and inviting ambiance. ', '3000', 'product8.webp', '2025-08-03', 6, 7, 7, 1),
(11, 'Clock', ' The image shows an ornate decorative clock mounted on a pedestal. The clock features a horse statue and is designed in a classical style with intricate details and gold accents.', '2999', 'product_5.webp', '2025-08-03', 12, 4, 1, 1),
(12, 'Wooden Box', 'The image shows a round wooden box with a lid. The lid and the sides of the box are decorated with a floral pattern that includes flowers and small animals, likely deer. The box appears to be handcraf', '149', 'sproduct1.webp', '2025-10-03', 9, 1, 3, 2),
(13, 'Coffee Table', 'This coffee table features a unique design with a clock face on its top surface. The clock face includes Roman numerals and visible mechanical gears, giving it a vintage and industrial look. The table', '29999', 'product_7.webp', '2025-10-03', 1, 3, 7, 1),
(14, 'Potted', 'The image shows a small potted plant with yellow foliage. The pot is terracotta with a blue rim, giving it a stylish and modern look. This type of plant is often used for decorative purposes in homes and offices.', '250', 'product4.webp', '2025-10-03', 10, 9, 9, 1),
(15, 'Wooden outdoor patio set', 'This image shows a wooden outdoor patio set consisting of a rectangular table and six matching chairs. The set appears to be made of solid wood, likely teak or a similar durable hardwood, which is commonly used for outdoor furniture due to its resistance to weather and decay.', '5500', '91-ZFWLuuKL._SL1500_.jpg', '2025-10-03', 14, 9, 3, 1),
(16, 'Table', 'The image shows a round table with a blue and white decorative design, likely made of ceramic or porcelain. ', '599', '11_4_d8950582-6c89-4f61-8aa9-a2c0853a69fe_500x.webp', '2025-10-02', 14, 5, 8, 2),
(17, 'Pot', 'The pot is a decorative ceramic planter with a green and white floral pattern. It is elevated on a stand with gold-colored legs and black tips.', '199', 'WPOPLAMPBMLGLS1_LS_1.avif', '2025-10-02', 10, 2, 8, 1),
(18, 'Wooden Box', 'The image shows a round wooden box with a lid. The lid and the sides of the box are decorated with a floral pattern that includes flowers and small animals, likely deer. ', '149', 'sproduct1.webp', '2025-10-03', 7, 1, 3, 1),
(19, 'Lamp', 'This image shows a decorative floor lamp with a unique and elegant design. The lamp features multiple light sources shaped like feathers, which are illuminated to create a warm and inviting ambiance.', '599', 'images (1).jpeg', '2025-10-03', 6, 7, 7, 2),
(20, 'Dining Table ', 'This image showcases a modern dining room with a minimalist design.', '2500', 'le-quan-BStvi8DrGnA-unsplash.webp', '2025-10-03', 16, 9, 3, 1),
(21, 'Floor Lamp', 'This image shows a decorative floor lamp with a unique and elegant design. The lamp features multiple light sources shaped like feathers, which are illuminated to create a warm and inviting ambiance.', '700', 'images (1).jfif', '2025-10-03', 6, 3, 7, 1),
(22, 'Decorative Glass Shelf', 'The image features a glass shelf mounted on a wall. The shelf is supported by two ornate black cast iron brackets with intricate designs. The glass appears to be tempered, providing both strength and a sleek, modern look.', '1050', 'DSC_7962_d343e695-39c0-4a29-b49c-b65428cfb5e5_500x.webp', '2025-10-03', 3, 3, 5, 3),
(23, 'Clock', 'The image shows an ornate clock mounted on a pedestal. The clock features intricate gold detailing and a white base, giving it a luxurious and antique appearance. The pedestal is also decorated with gold accents and has a classical design with scroll elements.', '2599', 'DSC_2041_32695ffc-2045-437b-a52f-35184b2c15ca_500x.webp', '2025-10-03', 1, 4, 8, 1),
(24, 'Jars', 'The image depicts a well-organized kitchen or pantry setup.', '499', 'download (3).jpeg', '2025-10-03', 9, 1, 5, 3),
(25, 'Wall Mounted Light', 'The light fixture in the image has a vintage or antique design, often referred to as a Spanish Revival or Gothic style. It features intricate ironwork with a scroll design and a glass candle-like enclosure.', '700', '27_2f9a78dd-246e-4849-8022-94009e9af7d0_330x.webp', '2025-10-03', 11, 3, 7, 1),
(26, 'Golden Deer Head Statue', 'The image depicts a decorative golden deer head statue with antlers. The statue is mounted on a black base and is placed on a wooden surface. The antlers are intricately designed, and the overall appearance of the statue is elegant and detailed.', '399', '009A7691_500x.webp', '2025-10-03', 13, 7, 9, 1),
(27, 'Bird Shaped Wall Hooks', 'The image features two white bird-shaped wall hooks mounted on a beige wall. These hooks are designed to resemble birds perched on a branch, adding a decorative and functional element to the space.', '299', '009A2382_330x.webp', '2025-10-03', 3, 4, 9, 3),
(28, 'Ottoman ', 'The image shows a round ottoman or pouffe with a textured, cream-colored fabric. The base of the ottoman appears to be made of a metallic material, likely brass or gold-colored, which adds a touch of elegance to the piece.', '5999', '009A0781_1c6566b0-8d37-458a-8811-f4038af1ff73_500x.webp', '2025-10-03', 4, 1, 1, 1),
(29, 'Teapot and Teacup Set', 'The teapot and teacup set in the image features a design inspired by Vincent van Goghs iconic painting Starry Night. The swirling patterns and vibrant colors of the painting are beautifully replicated on the porcelain surface of the teapot, teacup, and saucer.', '199', '15_d03317f4-9921-462e-aeeb-52920193094d_200x.avif', '2025-10-03', 8, 5, 5, 1),
(30, 'Floor Lamp', 'This image shows a decorative floor lamp with a unique and elegant design. The lamp features multiple light sources shaped like feathers, which are illuminated to create a warm and inviting ambiance.', '700', 'images (1).jfif', '2025-10-03', 6, 3, 7, 3),
(31, 'Table', 'The image shows a round table with a blue and white decorative design, likely made of ceramic or porcelain. ', '599', '11_4_d8950582-6c89-4f61-8aa9-a2c0853a69fe_500x.webp', '2025-10-02', 14, 5, 8, 1),
(32, 'Pot', 'The pot is a decorative ceramic planter with a green and white floral pattern. It is elevated on a stand with gold-colored legs and black tips.', '199', 'WPOPLAMPBMLGLS1_LS_1.avif', '2025-10-02', 10, 2, 8, 3),
(33, 'Clock', ' The image shows an ornate decorative clock mounted on a pedestal. The clock features a horse statue and is designed in a classical style with intricate details and gold accents.', '2999', 'product_5.webp', '2025-10-03', 12, 4, 1, 3),
(34, 'Bull Figurines', 'The image shows two bull figurines. Both bulls are black with gold accents on their horns, hooves, and tails. The figurines are positioned in a dynamic stance, with one bull appearing to be in a charging position and the other in a more defensive stance.', '500', '01_13_500x.webp', '2025-10-03', 15, 2, 8, 1),
(35, 'Table Lamp', 'The lamp in the image is designed to resemble a bird perched on a stand. It is an LED lamp, which means it uses light-emitting diodes to produce light, making it energy-efficient and long-lasting.', '799', '2_436f58d4-4e01-4d37-8868-33db97ae4f95_330x.webp', '2025-10-03', 6, 3, 7, 2),
(36, 'Plants', 'The plant in the image is a variegated plant with green leaves that have white or light green patterns. The leaves are heart-shaped and have prominent veins.', '149', '81ILr141goL._SL1500_.jpg', '2025-10-03', 13, 2, 9, 1),
(37, 'Kitchen Rules Sign', 'The image shows a kitchen with a decorative sign listing humorous kitchen rules. The sign is made of wooden planks and is hung on the wall', '399', 'download (11).jfif', '2025-10-03', 3, 9, 3, 2),
(38, 'Dinnerware', 'The image shows a well-arranged set of dinnerware and glassware (5 set)', '799', '2._SS460_QL85_.jpg', '2025-10-03', 8, 10, 5, 1),
(39, 'Glassware Set', 'The image depicts a set of glassware consisting of a carafe and three glasses', '299', '4._SS460_QL85_.jpg', '2025-10-03', 7, 1, 5, 1),
(40, 'Golden Owl ', 'The image shows a golden owl statue placed on a round, white table in a living room. The owl statue is intricately designed with a perforated pattern and large, round eyes. The living room is elegantly decorated with a beige sofa, beige and white cushions, a lamp, and a mirror with a golden frame on the wall. The room has a bright and airy feel, with natural light coming in through the windows.', '2999', '41D6kJo4npL.AC_SX250.jpg', '2025-10-03', 15, 7, 8, 1),
(41, 'Painting', 'This image is a stylized representation of the map of India, featuring various cultural and regional symbols that highlight the diversity and heritage of the country', '99.00', '41JZyZgU6NL.AC_SX250.jpg', '2025-10-03', 2, 3, 4, 3),
(42, 'Mirror', 'The image features three round wall mirrors with a unique, swirling design. The frames of these mirrors are gold-colored and have a pattern that resembles a spiral or a sunburst. This design adds a touch of elegance and sophistication to the mirrors, making them suitable for various interior decor styles.', '300', '41v4NdOF+wL.AC_SX250.jpg', '2025-10-03', 3, 9, 9, 1),
(43, 'Vintage car', 'The image shows a metal model of a vintage car. This model is likely a decorative piece, often used as a collectible or for display purposes in homes or offices.', '599', '41V-qBc11BL.AC_SX250.jpg', '2025-10-03', 15, 3, 7, 1),
(44, 'Grass', 'Artificial pampas grass is a popular decorative item used in homes, weddings, and various events. The image shows three stems of faux pampas grass, which are typically made from synthetic materials to mimic the appearance of real pampas grass. These artificial stems are often used in vases or as part of floral arrangements to add a natural and elegant touch to interior decor.', '199', '51Df-kx4czL._SX300_SY300_QL70_FMwebp_.webp', '2025-10-03', 10, 1, 9, 3),
(45, 'Miniature Wicker Furniture Set', 'The image features a set of miniature wicker furniture pieces. These include two small chairs, a round basket, a vase, and a bowl. The items are intricately woven and placed on a wooden slice, which serves as a display base.', '250', '51y164pHM4L._AC_UL480_FMwebp_QL65_.webp', '2025-10-03', 17, 9, 9, 1),
(46, 'Bathroom Corner Shelf', 'The image depicts a corner shelf in a bathroom, organized with various personal care products', '399', '51OtdGHVvGL._SR480,440_.jpg', '2025-10-03', 18, 3, 7, 1),
(47, 'Painting', 'This image shows seven white horses running together with a bright sun rising in the background. The horses are depicted in a dynamic and energetic manner, symbolizing strength, power, and freedom. The bright sun adds a sense of positivity and new beginnings.', '6000', '51JyByazfCL.AC_SX250.jpg', '2025-10-03', 2, 1, 5, 1),
(48, 'Two framed pictures of Eiffel Tower', 'The image features two framed pictures of the Eiffel Tower. The frames are black and have a modern, minimalist design.', '500', '51ivkLbmPdL.AC_SX250.jpg', '2025-10-03', 17, 3, 4, 3),
(49, 'Silver Cow and Calf Statue', ' The image shows a silver statue of a cow and calf. The cow is adorned with intricate designs, and there is a depiction of a deity on its back, which is likely Lord Krishna or another Hindu deity, given the cultural context of such statues.', '2500', '81kfe0lrQAL._AC_UL480_FMwebp_QL65_.webp', '2025-10-03', 17, 10, 7, 1),
(50, 'Table', 'The table appears to be made of durable plastic, suitable for outdoor use. It has a rectangular shape with a weather-resistant finish, making it ideal for various weather conditions.', '750', '91kWws4bJUL._AC_UL480_QL65_.jpg', '2025-10-03', 14, 9, 10, 2),
(51, 'Decorative Swan Shaped Container', 'The image shows a decorative container with a swan-shaped handle and lid. The container is made of glass and metal, likely aluminum or a similar material. The swan design adds an elegant touch, making it suitable for use as a home decor item or for storing small items like spices, dry fruits, or candies.', '499', '411AXC3ba-L._AC_UL480_FMwebp_QL65_.webp', '2025-10-03', 9, 10, 8, 1),
(52, 'Radha Krishna Painting', 'The image shows a multi-panel painting of Radha and Krishna, two significant figures in Hindu mythology. They are often depicted together, symbolizing divine love and devotion. In this painting, Radha and Krishna are seated together in a serene, natural setting, with a deer and a swan nearby, which adds to the peaceful and idyllic atmosphere.', '7500', '515roaRNaJL.AC_SX250.jpg', '2025-10-03', 2, 1, 9, 1),
(53, 'Glass Bud Vases', 'The image displays a set of five glass bud vases, each with a unique design and pattern. These vases are clear and made of glass, showcasing intricate textures and shapes.', '200', '51hqZjEfZRL.AC_SX250.jpg', '2025-10-03', 7, 1, 5, 1),
(54, 'Artificial Potted Plants', 'Artificial potted plants are a popular choice for home and office decor due to their low maintenance and long-lasting beauty. The image shows a set of eight artificial plants, each in a white pot. These plants are designed to mimic the appearance of real plants, providing a touch of greenery without the need for watering or sunlight.', '1999', '8139T8YbdkL._AC_UL480_QL65_.jpg', '2025-10-03', 10, 2, 9, 2),
(55, 'Bull Figurines', 'The image shows two bull figurines. Both bulls are black with gold accents on their horns, hooves, and tails. The figurines are positioned in a dynamic stance, with one bull appearing to be in a charging position and the other in a more defensive stance.', '500', '01_13_500x.webp', '2025-10-03', 15, 2, 8, 3),
(56, 'Bathroom Corner Shelf', 'The image depicts a corner shelf in a bathroom, organized with various personal care products', '399', '51OtdGHVvGL._SR480,440_.jpg', '2025-10-03', 18, 3, 7, 3),
(57, 'Ottoman ', 'The image shows a round ottoman or pouffe with a textured, cream-colored fabric. The base of the ottoman appears to be made of a metallic material, likely brass or gold-colored, which adds a touch of elegance to the piece.', '5999', '009A0781_1c6566b0-8d37-458a-8811-f4038af1ff73_500x.webp', '2025-10-03', 4, 1, 1, 3),
(58, 'Furniture pieces', 'The image features a set of miniature wicker furniture pieces. These include two small chairs, a round basket, a vase, and a bowl. The items are intricately woven and placed on a wooden slice, which serves as a display base.', '249', '51y164pHM4L._AC_UL480_FMwebp_QL65_.webp', '2025-10-04', 15, 9, 9, 4),
(59, 'Modern Gold Chandelier', 'The image depicts a modern chandelier with a gold finish. The chandelier has a square shape and is suspended from the ceiling by four wires. The design features a series of vertical gold elements that create a luxurious and elegant appearance.', '3599', 'product_8.webp', '2025-10-04', 12, 7, 5, 4),
(60, 'Container', 'This is a ceramic container featuring a decorative lemon tree pattern. The container has a wooden lid with a white knob on top, which adds a touch of elegance and functionality.', '199', 'sproduct3.webp', '2025-10-04', 8, 4, 3, 4),
(61, 'Wall Clock', 'The wall clock features a floral design with various leaves and flowers in shades of green, blue, and pink. The frame of the clock is teal, which complements the floral pattern.', '299', 'product1.webp', '2025-10-04', 17, 1, 1, 4),
(62, 'Glass Reindeer Figurine', 'The figurine appears to be made of glass or crystal, giving it a transparent and reflective quality. The reindeer is depicted in a standing position with detailed antlers and a smooth, polished surface.', '300', 'sproduct2.webp', '2025-10-04', 1, 10, 5, 4),
(63, 'Floral Painting', 'The image shows a vibrant and detailed painting of various flowers in full bloom. The flowers are depicted in a range of colors including blue, pink, orange, and white, creating a visually striking composition. The painting is hung on a wall above a yellow couch, adding a touch of elegance and color to the room.', '9999', 'WPTGSEGBP24S1_LS_1.avif', '2025-10-12', 2, 1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `review_datetime` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_review` varchar(100) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `review_datetime`, `product_id`, `user_review`, `user_rating`, `user_id`) VALUES
(1, '2025-10-04 22:00:41', 48, 'Good', 4, 2),
(2, '2025-10-04 22:01:02', 59, 'Very interesting', 5, 2),
(3, '2025-10-04 22:03:44', 53, 'good', 4, 2),
(4, '2025-10-04 22:06:24', 59, 'good', 4, 2),
(5, '2025-10-04 22:06:51', 62, 'Good', 4, 1),
(6, '2025-10-04 22:07:19', 62, 'Intersting\n', 5, 1),
(7, '2025-10-04 22:07:39', 54, 'good very nice', 3, 1),
(8, '2025-10-04 22:10:21', 34, 'nice', 4, 1),
(9, '2025-10-04 22:10:54', 53, 'One Piece is broken\n', 1, 1),
(10, '2025-10-12 09:02:54', 34, 'good', 5, 1),
(11, '2025-10-12 10:20:42', 43, 'good', 4, 2),
(12, '2025-10-12 10:20:56', 46, 'good', 4, 2),
(13, '2025-10-12 10:21:05', 18, 'nice', 5, 2),
(14, '2025-10-12 10:21:22', 46, 'nice product', 3, 2),
(15, '2025-10-13 19:01:07', 61, 'good product', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(50) NOT NULL,
  `seller_email` varchar(50) NOT NULL,
  `seller_contact` varchar(50) NOT NULL,
  `seller_address` varchar(100) NOT NULL,
  `seller_photo` varchar(200) NOT NULL,
  `seller_proof` varchar(200) NOT NULL,
  `seller_status` varchar(50) NOT NULL DEFAULT '0',
  `place_id` int(11) NOT NULL,
  `seller_password` varchar(50) NOT NULL,
  `seller_customization` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_name`, `seller_email`, `seller_contact`, `seller_address`, `seller_photo`, `seller_proof`, `seller_status`, `place_id`, `seller_password`, `seller_customization`) VALUES
(1, 'Home Made', 'adithyanpm745@gmail.com', '9597835456', 'ottapalam,piravon 688810', 'OIP (1).webp', 'upload3.jpg', '1', 7, 'Sadithyanpm745', 1),
(2, 'Kazari', 'kazari4789@gmail.com', '9345678902', 'Applo Junction ,ettumanoor kottayam', '5c1225ba59059c6c6a68e863_1544693178530.jpg', 'Proof_Upload_1.png', '1', 10, 'Skazari4789', 1),
(3, 'Simple', 'simple854@gmail.com', '8934789302', 'Palamuku ,near ksrtc stand ,muvattupuzha, ernakulam', 'OIP.webp', 'maxresdefault.jpg', '1', 8, 'Ssimple854', 2),
(4, 'Decor Cart', 'decorcart79@gmail.com', '9373783829', 'decor cart, palarivattom , Thodupuzha', 'images (3).jpeg', 'cropped-shop-act-form-1.png', '1', 17, 'Sdecorcart79', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_count` int(11) NOT NULL,
  `stock_date` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_count`, `stock_date`, `product_id`) VALUES
(1, 15, '2025-10-02', 6),
(2, 15, '2025-10-03', 29),
(3, 10, '2025-10-03', 28),
(4, 12, '2025-10-03', 27),
(5, 7, '2025-10-03', 26),
(6, 79, '2025-10-03', 23),
(7, 43, '2025-10-03', 24),
(8, 37, '2025-10-03', 25),
(9, 12, '2025-10-03', 12),
(10, 60, '2025-10-03', 1),
(11, 9, '2025-10-03', 2),
(12, 23, '2025-10-03', 4),
(13, 5, '2025-10-03', 3),
(14, 6, '2025-10-03', 22),
(15, 28, '2025-10-03', 5),
(16, 9, '2025-10-03', 8),
(17, 6, '2025-10-03', 21),
(18, 4, '2025-10-03', 11),
(19, 18, '2025-10-03', 7),
(20, 87, '2025-10-03', 18),
(21, 2, '2025-10-03', 10),
(22, 5, '2025-10-03', 9),
(23, 50, '2025-10-03', 14),
(24, 7, '2025-10-03', 13),
(25, 34, '2025-10-03', 17),
(26, 8, '2025-10-03', 15),
(27, 8, '2025-10-03', 33),
(28, 24, '2025-10-03', 32),
(29, 15, '2025-10-02', 16),
(30, 7, '2025-10-03', 19),
(31, 23, '2025-10-03', 31),
(32, 13, '2025-10-03', 34),
(33, 45, '2025-10-03', 35),
(34, 35, '2025-10-03', 36),
(35, 7, '2025-10-03', 37),
(36, 77, '2025-10-03', 38),
(37, 77, '2025-10-03', 39),
(38, 8, '2025-10-03', 40),
(39, 47, '2025-10-03', 41),
(40, 37, '2025-10-03', 42),
(41, 79, '2025-10-03', 43),
(42, 68, '2025-10-03', 44),
(43, 86, '2025-10-03', 45),
(44, 979, '2025-10-03', 46),
(45, 65, '2025-10-03', 47),
(46, 685, '2025-10-03', 48),
(47, 87, '2025-10-03', 49),
(48, 97, '2025-10-03', 50),
(49, 34, '2025-10-03', 51),
(51, 894, '2025-10-03', 53),
(52, 135, '2025-10-03', 54),
(53, 15, '2025-10-03', 57),
(54, 78, '2025-10-04', 58),
(55, 9, '2025-10-04', 61),
(56, 16, '2025-10-04', 59),
(57, 57, '2025-10-04', 60),
(58, 56, '2025-10-04', 62),
(59, 0, '2025-10-03', 55),
(60, 3, '2025-10-12', 63),
(61, 34, '2025-10-03', 56),
(62, 7, '2025-10-03', 55);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'Others', 1),
(2, 'Arts & Paintings', 2),
(3, 'Creative Decor', 2),
(4, 'Sofas', 3),
(5, 'Wall Lighting', 4),
(6, 'Lamps', 4),
(7, 'Table Decor', 5),
(8, 'Serveware', 5),
(9, 'Functional Storage', 5),
(10, 'Planters', 6),
(11, 'Outdoor Lighting & Lanterns', 6),
(12, 'Minimalist & Modern Arts Pieces', 7),
(13, 'Eco Friendly Items', 1),
(14, 'Tables', 6),
(15, 'All Decor', 8),
(16, 'Tables', 3),
(17, 'Home Accents', 8),
(18, 'Bath Decor', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contact` varchar(50) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_photo` varchar(200) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_address`, `user_photo`, `user_password`, `place_id`) VALUES
(1, 'Sooraj K', 'adithyanpm108@gmail.com', '6282927579', 'Queens Way\r\nKottayam,pala 654697\r\nIndia', 'download (2).png', 'Uadithyanpm108', 12),
(2, 'Ananya ', 'ananya764@gmail.com', '9961106778', 'Thiruvathira (H)\r\nPalayalam P. O, Mulanthuruthy,\r\nErnakulam', 'download (1).png', 'Uananya764', 16),
(3, 'Christeena Roy', 'christeenaroy568@gmail.com', '8505055555', 'kumarakom 678569 ,Alappuzha', 'download (2).png', 'Uchristeenaroy568', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlist_id`, `product_id`, `user_id`) VALUES
(1, 55, 1),
(2, 62, 1),
(3, 60, 2),
(4, 63, 1),
(5, 52, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_colour`
--
ALTER TABLE `tbl_colour`
  ADD PRIMARY KEY (`colour_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_customization`
--
ALTER TABLE `tbl_customization`
  ADD PRIMARY KEY (`customization_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_colour`
--
ALTER TABLE `tbl_colour`
  MODIFY `colour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customization`
--
ALTER TABLE `tbl_customization`
  MODIFY `customization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
