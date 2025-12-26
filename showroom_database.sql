-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 04:46 PM
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
-- Database: `showroom_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_table`
--

CREATE TABLE `cart_table` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_table`
--

INSERT INTO `cart_table` (`cart_id`, `user_id`, `product_id`, `product_name`, `product_price`, `quantity`, `total_price`) VALUES
(48, 1, 6, 'Wireless Noise-Canceling Headphones', 999, 6, 5994);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_table`
--

CREATE TABLE `inquiry_table` (
  `inquiry_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry_table`
--

INSERT INTO `inquiry_table` (`inquiry_id`, `name`, `email`, `message`) VALUES
(1, 'Testing', 'asd@zxc.fgh', 'asdasd'),
(2, 'Test 2', 'Hello@wolrd.com', 'asdfasdfasdfasd\r\n'),
(3, 'Test3', 'Hello@wolrd.com', 'qwezxzvcxcvsdafgdsfg'),
(4, 'asd', 'asdf@asdf.asdf', 'asdasdasd'),
(5, 'asdasd', 'asdf@asdf.asdf', 'asdasdasdas'),
(6, 'asdasd', 'asdasd@asdas.dsfgs', 'asdasdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `orders_table`
--

CREATE TABLE `orders_table` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `receiver_name` varchar(50) NOT NULL,
  `contact_number` int(255) NOT NULL,
  `order_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `delivery_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_table`
--

INSERT INTO `orders_table` (`order_id`, `user_id`, `receiver_name`, `contact_number`, `order_date`, `total`, `payment_method`, `shipping_address`, `delivery_method`) VALUES
(10, 1, 'Sample User', 123123123, '2024-06-14 23:43:33', 32548.00, 'MasterCard', 'Address', ''),
(11, 1, 'John Cena', 123, '2024-06-17 05:49:38', 1778.00, 'MasterCard', '123123', ''),
(12, 1, 'John Cena', 12312, '2024-06-17 05:52:27', 1398.00, 'Gcash', 'asd', ''),
(13, 1, 'John Cena', 619, '2024-06-17 05:53:59', 1678.00, 'Paymaya', 'asdasd', ''),
(14, 1, 'John Cena', 123123, '2024-06-17 05:55:33', 2797.00, 'Credit Card', '1asd2312', ''),
(15, 1, 'John Cena', 619, '2024-06-17 05:56:41', 2297.00, 'Visa', 'qweqwe', ''),
(16, 1, 'John Cena', 619, '2024-06-17 06:07:25', 1198.00, 'Wash Dishes', 'asdasd', ''),
(17, 1, 'Shikamaru Narra', 1231, '2024-06-17 06:20:10', 1198.00, 'Gcash', 'aasad', ''),
(18, 1, 'Sasuke Uchiha', 12312, '2024-06-17 06:32:17', 499.00, 'Credit Card', 'Uchiha Compound', 'Lalamove'),
(19, 1, 'Naruto Uzumaki', 11231, '2024-06-17 07:35:17', 11195.00, 'Credit Card', 'Konoha Hokage Office', 'Grab Move'),
(20, 2, 'Madara Uchiha', 123123, '2024-06-17 08:21:59', 999.00, 'Visa', 'Uchiha Compound', 'Angkas Padala'),
(21, 3, 'patrick', 918, '2024-06-17 09:23:01', 1798.00, 'COD', 'b5 l3 p2 skejwjkas lswqa', 'J&T Express'),
(22, 3, 'patrick', 918, '2024-06-17 09:23:43', 1798.00, 'COD', 'b5 l3 p2 skejwjkas lswqa', 'J&T Express'),
(23, 2, 'Ella Odvina', 1235456788, '2024-06-17 12:35:59', 35994.00, 'Gcash', '12b 23L 4Ph asdnjkasnd', 'J&T Express');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `product_id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_classification` varchar(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  `product_stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`product_id`, `product_name`, `product_description`, `product_classification`, `product_price`, `product_stock`) VALUES
(1, 'Wireless Optical Mouse', 'The Wireless Optical Mouse is an essential tool for both work and play, offering seamless functionality with its 2.4GHz wireless connectivity. It features a sleek, ambidextrous design that fits comfortably in either hand, making it ideal for all users. The mouse is equipped with a high-precision optical sensor that provides smooth and accurate tracking on various surfaces, ensuring reliable performance. With its plug-and-play setup, users can quickly connect it to their device without the need for additional drivers. Additionally, the mouse boasts a long battery life, with a power-saving mode that automatically conserves energy when not in use, ensuring it is always ready for action.', 'Mouse', 499, 12),
(2, 'Gaming Mouse with Customizable DPI', 'The Gaming Mouse with Customizable DPI is designed for serious gamers who demand both speed and accuracy. This mouse features adjustable DPI settings, allowing users to switch between different sensitivity levels on the fly, catering to various gaming scenarios. It comes with programmable buttons, enabling the customization of in-game commands and shortcuts for a competitive edge. The mouse is ergonomically shaped to fit comfortably in the hand, reducing fatigue during long gaming sessions. RGB lighting enhances its visual appeal, with customizable color options to match any gaming setup. Built with durable materials and a high-precision sensor, this mouse ensures longevity and consistent performance.', 'Mouse', 299, 14),
(3, 'Ergonomic Vertical Mouse', 'The Ergonomic Vertical Mouse is specifically designed to promote a healthier hand position and reduce strain associated with prolonged computer use. Its vertical orientation encourages a more natural grip, alleviating pressure on the wrist and forearm. The mouse features an adjustable DPI button, providing users with control over cursor sensitivity for precise navigation. It includes convenient forward and backward buttons for easy web browsing and a textured grip for added comfort. This mouse connects via USB and offers plug-and-play functionality, making it simple to set up and use. Ideal for office environments and home use, the Ergonomic Vertical Mouse is a perfect choice for those seeking to improve their computing experience and reduce the risk of repetitive strain injuries.', 'Mouse', 399, 6),
(4, 'Mechanical Gaming Keyboard', 'The Mechanical Gaming Keyboard is a high-performance keyboard designed for avid gamers seeking precision and durability. Featuring customizable RGB backlighting, this keyboard allows users to create dynamic lighting effects and personalize their gaming setup. Each key is equipped with a mechanical switch, providing tactile feedback and a satisfying click with every press, ensuring faster response times and improved accuracy. The keyboard also includes programmable macro keys, enabling gamers to execute complex commands with a single keystroke. Constructed with a sturdy aluminum frame, this keyboard is built to withstand intense gaming sessions, while the ergonomic design ensures comfort during prolonged use.', 'Keyboard', 699, 23),
(5, 'Wireless Ergonomic Keyboard', 'The Wireless Ergonomic Keyboard combines advanced functionality with a design focused on comfort and health. This keyboard features a split layout with a curved design, reducing strain on the wrists and promoting a more natural typing posture. Equipped with quiet, low-profile keys, it ensures a smooth and silent typing experience, perfect for both home and office environments. The wireless connectivity eliminates cable clutter and allows for flexible placement, with a reliable connection up to 30 feet. Additionally, the keyboard includes a built-in rechargeable battery, offering long-lasting usage on a single charge, and multimedia shortcut keys for quick access to common functions, enhancing productivity and convenience.', 'Keyboard', 779, 30),
(6, 'Wireless Noise-Canceling Headphones', 'The Wireless Noise-Canceling Headphones deliver an exceptional audio experience, perfect for music enthusiasts and professionals alike. Featuring advanced active noise-canceling technology, these headphones effectively block out ambient sounds, allowing users to immerse themselves in their audio without distractions. The headphones boast high-fidelity sound with deep bass and crisp trebles, thanks to their large, high-quality drivers. With Bluetooth connectivity, they offer the convenience of wireless use, and the built-in rechargeable battery provides up to 30 hours of continuous playback on a single charge. The ergonomic design, with plush ear cushions and an adjustable headband, ensures comfort during extended listening sessions. Additionally, the headphones include intuitive touch controls for volume adjustment, track navigation, and call handling, making them a versatile and stylish choice for any audio aficionado.', 'Headphone', 999, 15),
(7, 'Over-Ear Studio Headphones', 'The Over-Ear Studio Headphones are engineered for professional-grade audio performance, making them ideal for musicians, producers, and audiophiles. These headphones feature large, over-ear cups with soft, breathable padding, providing maximum comfort and excellent noise isolation for extended wear. Equipped with high-resolution drivers, they deliver an incredibly accurate sound profile, capturing every detail from the deepest lows to the highest highs. The detachable, oxygen-free copper cable ensures optimal signal transmission and reduces interference, while the adjustable headband allows for a perfect fit. Built with a durable yet lightweight frame, these headphones are designed to withstand the rigors of studio use. Whether you\'re mixing tracks, recording vocals, or simply enjoying your favorite music, the Over-Ear Studio Headphones offer an unparalleled listening experience.', 'Headphone', 1299, 33),
(8, '1080p HD Webcam', 'The 1080p HD Webcam is the perfect solution for high-quality video conferencing, streaming, and online content creation. This webcam captures video in full HD resolution, providing crisp and clear visuals with vibrant colors, ensuring you look your best in every frame. It features an advanced CMOS sensor and automatic low-light correction, delivering excellent performance even in dimly lit environments. The built-in stereo microphones with noise reduction technology ensure your voice comes through loud and clear, free from background noise. With its easy plug-and-play setup via USB, you can connect and start using it immediately without the need for additional drivers. The webcam also includes a flexible, adjustable clip for secure mounting on laptops, monitors, or tripods, and a privacy shutter for added security when not in use. Ideal for professional meetings, virtual classes, or social video calls, the 1080p HD Webcam enhances your online presence with superior video quality and reliable audio performance.', 'Web Camera', 899, 10),
(9, '27-Inch 4K Ultra HD Monitor', 'The 27-Inch 4K Ultra HD Monitor is a top-tier display solution designed for professionals and enthusiasts who demand stunning visuals and exceptional performance. Featuring a breathtaking 3840 x 2160 resolution, this monitor delivers incredibly sharp and detailed images, making it perfect for tasks such as graphic design, video editing, and immersive gaming. The IPS panel ensures wide viewing angles and vibrant, accurate colors, covering over 99% of the sRGB color spectrum for true-to-life visuals. With a sleek, bezel-less design, it offers a modern aesthetic and maximizes screen real estate, ideal for multi-monitor setups. The monitor also includes multiple connectivity options, such as HDMI, DisplayPort, and USB-C, providing versatility and ease of use with various devices. Enhanced with features like flicker-free technology and a blue light filter, it reduces eye strain for comfortable extended use. The ergonomic stand allows for easy adjustment of height, tilt, and swivel, ensuring optimal viewing comfort. Whether for professional applications or high-quality entertainment, the 27-Inch 4K Ultra HD Monitor is a superior choice for those seeking outstanding display performance.', 'Monitor', 5999, 6),
(10, 'Bluetooth Travel Mouse', 'The Bluetooth Travel Mouse is the ideal companion for professionals and students on the go, offering portability and convenience without compromising on functionality. This sleek, compact mouse features Bluetooth connectivity, eliminating the need for a USB receiver and freeing up valuable ports. Its precise optical sensor provides smooth and accurate tracking on various surfaces, making it versatile for different environments, whether you\'re working at a desk or on the move. The mouse includes a rechargeable battery that delivers weeks of use on a single charge, with a quick-charging feature that provides hours of usage from just a few minutes of charging. The ergonomic design fits comfortably in your hand, while the ambidextrous shape ensures it suits both left and right-handed users. With silent buttons that reduce clicking noise, it\'s perfect for quiet environments like libraries and meetings. Lightweight and durable, the Bluetooth Travel Mouse is designed to enhance your productivity wherever your work takes you.', 'Mouse', 1099, 21),
(11, 'Portable Bluetooth Speaker', 'The Portable Bluetooth Speaker delivers powerful sound and deep bass in a compact and stylish design, perfect for music lovers on the go. With its robust wireless connectivity, this speaker pairs effortlessly with your smartphone, tablet, or laptop, providing a seamless streaming experience. It features high-fidelity audio with rich, full-range sound, thanks to its advanced drivers and passive radiators. The speaker is built to withstand outdoor adventures with its rugged, water-resistant design, making it ideal for pool parties, beach trips, or camping. The long-lasting rechargeable battery offers up to 20 hours of playtime on a single charge, ensuring your music keeps playing all day. Additionally, the speaker includes a built-in microphone for hands-free calls, and intuitive controls for volume, track selection, and pairing. Compact yet powerful, the Portable Bluetooth Speaker is the perfect audio solution for any occasion, bringing high-quality sound wherever you go.', 'Speaker', 1199, 7),
(12, 'Wireless All-In-One Printer', 'The Wireless All-In-One Printer is a versatile and efficient solution for all your printing, scanning, copying, and faxing needs. Designed for both home and office use, this printer offers high-quality output with sharp text and vibrant color prints, thanks to its advanced inkjet technology. The wireless connectivity allows for seamless printing from your smartphone, tablet, or laptop, and supports popular cloud services for direct printing from online storage. Its automatic document feeder and duplex printing feature save time and paper, making large tasks more manageable. The intuitive touchscreen interface provides easy access to all functions and settings, while the compact design ensures it fits neatly into any workspace. With fast print speeds and a high monthly duty cycle, the Wireless All-In-One Printer is built to handle demanding workloads, delivering professional results every time.', 'Printer', 4999, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_name`, `user_email`, `user_password`, `account_type`) VALUES
(1, 'Admin', 'test@account.com', 'qweqweqwe', 'Admin'),
(2, 'Customer', 'test@participant.com', 'qweqweqwe', 'Customer'),
(3, 'patrick', 'patrick@gmail.com', 'patrick', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `inquiry_table`
--
ALTER TABLE `inquiry_table`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `orders_table`
--
ALTER TABLE `orders_table`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_table`
--
ALTER TABLE `cart_table`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `inquiry_table`
--
ALTER TABLE `inquiry_table`
  MODIFY `inquiry_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_table`
--
ALTER TABLE `orders_table`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD CONSTRAINT `cart_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `cart_table_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`);

--
-- Constraints for table `orders_table`
--
ALTER TABLE `orders_table`
  ADD CONSTRAINT `orders_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
