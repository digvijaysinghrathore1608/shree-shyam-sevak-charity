-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 25, 2023 at 01:39 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infy-funding-fresh`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'menu_title', 'Our Mission: Food, Education, Medicine', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'menu_bg_image', 'front_landing/images/about-hero-img.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'title', 'We Have Funded 44k Dollars Over', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'short_description', 'We have plenty of water of drink even.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(5, 'image_1', 'front_landing/images/about-us2.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(6, 'image_2', 'front_landing/images/about-us1.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(7, 'point_1', 'A place in history.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(8, 'point_2', 'Its about impact, goodness.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(9, 'point_3', 'More goodness in the world.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(10, 'point_4', 'The world we live in right now can be hard.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(11, 'years_of_exp', '25', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_details`
--

CREATE TABLE `bank_account_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `withdrawal_request_id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'HeartCare', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'HeartCare', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Duragas', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'SafeGuard', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(5, 'Maxton Design ', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(6, 'LogoType', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(7, 'TurboLogo', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `call_to_actions`
--

CREATE TABLE `call_to_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campaign_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goal` double DEFAULT NULL,
  `recommended_amount` double DEFAULT NULL,
  `amount_prefilled` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_end_method` int(11) DEFAULT NULL,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `is_emergency` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gift_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `campaign_category_id`, `user_id`, `slug`, `short_description`, `description`, `currency`, `goal`, `recommended_amount`, `amount_prefilled`, `campaign_end_method`, `video_link`, `country_id`, `location`, `start_date`, `deadline`, `status`, `is_featured`, `is_emergency`, `created_at`, `updated_at`, `gift_status`) VALUES
(1, 'Emergency Response And School Food', 3, 1, 'emergency-respo', 'Nutritious school food helps students develop lifelong healthy eating habits', 'This campaign helps students develop lifelong healthy eating habits', 'inr', 1000, 2000, '500', 1, 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities', 1, 'uganda', '2023-01-25', '2023-02-25', 1, 1, 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40', 0),
(2, 'People Health Response And Village Mans', 3, 1, 'people-health-r', 'Nutritious school food helps students develop lifelong healthy eating habits', 'This campaign helps students develop lifelong healthy eating habits', 'inr', 3000, 5000, '2000', 1, 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities', 1, 'uganda', '2023-01-25', '2023-02-25', 1, 1, 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40', 0),
(3, 'Because Everyone Deserves Clean Water', 2, 1, 'because-everyon', 'Nutritious school food helps students develop lifelong healthy eating habits', 'This campaign helps students develop lifelong healthy eating habits', 'inr', 5000, 7000, '1000', 1, 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities', 2, 'uganda', '2023-01-25', '2023-02-25', 1, 1, 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `campaign_categories`
--

CREATE TABLE `campaign_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_categories`
--

INSERT INTO `campaign_categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Food', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Health', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Water', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_donations`
--

CREATE TABLE `campaign_donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donated_amount` double(8,2) DEFAULT '0.00',
  `charge_amount` double DEFAULT NULL,
  `campaign_donation_transaction_id` bigint(20) UNSIGNED NOT NULL,
  `is_withdrawal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `donate_anonymously` tinyint(1) NOT NULL DEFAULT '0',
  `gift_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_donation_transaction`
--

CREATE TABLE `campaign_donation_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) DEFAULT '0.00',
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gift_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_faqs`
--

CREATE TABLE `campaign_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_gift`
--

CREATE TABLE `campaign_gift` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `donation_gift_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_updates`
--

CREATE TABLE `campaign_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_2_categories`
--

CREATE TABLE `cms_2_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_2_categories`
--

INSERT INTO `cms_2_categories` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'title_1', 'Healthy Foods', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'title_2', 'Make Donation', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'title_3', 'Medical Facilities', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'description_1', 'There are only a few times in each of our lives that we get to witness a truly historic global compliment Ending smallpox,                  tearing', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(5, 'description_2', 'There are only a few times in each of our lives that we get to witness a truly historic global compliment Ending smallpox, tearing', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(6, 'description_3', 'There are only a few times in each of our lives that we get to witness a truly historic global compliment Ending smallpox,                 tearing', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(7, 'image_1', 'http://infy-funding.test/front_landing/landing/img/categories/box.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(8, 'image_2', 'http://infy-funding.test/front_landing/landing/img/categories/hand-love.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(9, 'image_3', 'http://infy-funding.test/front_landing/landing/img/categories/medical.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `cms_3_categories`
--

CREATE TABLE `cms_3_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_3_categories`
--

INSERT INTO `cms_3_categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Pure Water', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Healthy Food', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'No Poverty', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'Good Health', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(5, 'Partnerships', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(6, 'Good Health', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'menu_title', 'Our Mission: Food, Education', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'menu_image', 'http://infy-funding.test/front_landing/images/causes-hero-img.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'India', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Japan', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `donation_gifts`
--

CREATE TABLE `donation_gifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) DEFAULT '0.00',
  `commission_amount` double(8,2) DEFAULT '0.00',
  `is_withdrawal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_subscribes`
--

CREATE TABLE `email_subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `available_tickets` int(11) NOT NULL,
  `event_organizer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_organizer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_organizer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_organizer_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `slug`, `category_id`, `description`, `event_date`, `start_time`, `end_time`, `available_tickets`, `event_organizer_name`, `event_organizer_email`, `event_organizer_phone`, `event_organizer_website`, `venue`, `venue_location`, `venue_phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Top 24 National Festivals', 'top-24-nationa', 2, 'They say we should celebrate life, not just festivals. Well, in a country like India, life is synonymous with festivals because there are more fiestas than you can count, and each of these mirrors our culture and traditions. Breaking the humdrum of daily routine, these festivals bring with them a wave of excitement and happiness. Interestingly, almost every big and small occasion in India calls for a celebration. Be it the arrival of spring, harvesting of crops or something else, you will never run of out reasons and seasons to celebrate. Experiencing the festive spirit of the country is akin to celebrating life, speckled with an ample dose of colors, music, dance, folk songs, food, and friends, all rolled into a wholesome package offering absolute gratification..', '2023-02-04', '12:42:40', '14:42:40', 41, 'Miranda H', 'info@webmail.com', '98709809809', 'www.meta.com', 'London', '12/A, Miranda Halim City Town Hall, London', '9991113339', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Slate & Crystal Events', 'slate-&-crystal', 3, 'You’ve decided to launch an event planning company. Congratulations! This is an exciting time filled with anticipation, nerves, and a to-do list a million miles long — including choosing a name for your business.\n\nThe name you pick for your event planning company can make or break your brand. It’s your calling card — so make sure it says what you want it to say. A great event company name captures attention, establishes the vibe of your business, and clarifies what your event design service is all about. That’s heavy lifting for a handful of words.', '2023-02-04', '12:42:40', '14:42:40', 48, 'Miranda H', 'info@webmail.com', '98709809809', 'www.meta.com', 'London', '12/A, Miranda Halim City Town Hall, London', '9991113339', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Water and Climate Change', 'water-and-clima', 1, 'According to the UN organisation, \"World Water Day 2022 is about water and climate change - and how the two are inextricably linked. The campaign shows how our use of water will help reduce floods, droughts, scarcity and pollution, and will help fight climate change itself.\n\nBy adapting to the water effects of climate change, we will protect health and save lives. And, by using water more efficiently, we will reduce greenhouse gases.\"\n\nAccording to the UN organization, the key messages for World Water Day 2020 are as follows:\n\n\"We cannot afford to wait. Climate policymakers must put water at the heart of action plans.\"\n\"Water can help fight climate change. There are sustainable, affordable and scalable water and sanitation solutions.\"\n\"Everyone has a role to play. In our daily lives, there are surprisingly easy steps we can all take to address climate change.\"\nOn the significant event of World Water Day 2020, here are some of the inspirational, wise and thoughtful water slogans, sayings and quotes, have a look.', '2023-02-04', '12:42:40', '14:42:40', 44, 'Miranda H', 'info@webmail.com', '98709809809', 'www.meta.com', 'London', '12/A, Miranda Halim City Town Hall, London', '9991113339', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Water Day', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Festival', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Pro Event', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'Trending', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `event_participants`
--

CREATE TABLE `event_participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'How To Donate On Our Site Using Your Form?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'How To Became A Volunteer In Zambia State?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'How Can I Give My Clothes And Other Products?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'How To Donate On Our Site Using Your Form?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi..', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(5, 'How To Became A Volunteer In Zambia State?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi..', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(6, 'How Can I Give My Clothes And Other Products?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `front_sliders`
--

CREATE TABLE `front_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `front_sliders`
--

INSERT INTO `front_sliders` (`id`, `title_1`, `title_2`, `created_at`, `updated_at`) VALUES
(1, 'Our Mission:Food', 'We are On A Mission To  Start Today', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Our Mission:Medicine', 'More charity Make More better life', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Our Mission:Education', 'We are On A Mission To Change That', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `front_video_settings`
--

CREATE TABLE `front_video_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `front_video_settings`
--

INSERT INTO `front_video_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'short_title', 'Life Changing Video', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'title', 'Joel Orphanage Of Ministry Uganda', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'bg_image', 'front_landing/web/media/avatars/150-26.jpg', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'youtube_video_link', 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donation_gift_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `iso_code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `generated_conversions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_26_044558_create_media_table', 1),
(5, '2021_07_28_114939_create_settings_table', 1),
(6, '2021_08_05_085326_create_permission_tables', 1),
(7, '2022_02_03_035457_create_campaign_categories_table', 1),
(8, '2022_02_05_104307_create_event_categories_table', 1),
(9, '2022_02_07_053238_create_countries_table', 1),
(10, '2022_02_07_075323_create_events_table', 1),
(11, '2022_02_08_051832_create_campaigns_table', 1),
(12, '2022_02_08_113503_create_front_sliders_table', 1),
(13, '2022_02_09_050951_create_brands_table', 1),
(14, '2022_02_09_100658_create_success_stories_table', 1),
(15, '2022_02_10_050643_create_email_subscribes_table', 1),
(16, '2022_02_10_052108_create_pages_table', 1),
(17, '2022_02_10_100554_create_news_tags_table', 1),
(18, '2022_02_11_092242_create_news_categories_table', 1),
(19, '2022_02_12_050558_create_about_us_table', 1),
(20, '2022_02_12_074952_create_news_table', 1),
(21, '2022_02_12_081517_create_inquiries_table', 1),
(22, '2022_02_14_094328_create_news_news_tags_table', 1),
(23, '2022_02_16_105105_create_front_video_settings_table', 1),
(24, '2022_02_18_071358_create_contact_us_table', 1),
(25, '2022_02_18_091221_create_call_to_actions_table', 1),
(26, '2022_02_19_050505_create_event_participants_table', 1),
(27, '2022_02_21_095530_create_campaign_faqs_table', 1),
(28, '2022_02_22_090424_create_campaign_updates_table', 1),
(29, '2022_02_24_113029_create_faqs_table', 1),
(30, '2022_02_25_060938_create_teams_table', 1),
(31, '2022_02_28_054133_create_news_comments_table', 1),
(32, '2022_02_28_072921_second_sliders_table', 1),
(33, '2022_02_28_121932_create_cms_2_categories_table', 1),
(34, '2022_02_28_123025_create_second_video_sections_table', 1),
(35, '2022_03_01_062448_create_third_sliders_table', 1),
(36, '2022_03_01_085405_create_cms_3_categories_table', 1),
(37, '2022_03_01_123736_create_third_video_sections', 1),
(38, '2022_03_02_060036_create_slider_card_table', 1),
(39, '2022_03_04_104559_add_is_default_field_in_users_table', 1),
(40, '2022_03_11_054159_change_country_name_to_users_table', 1),
(41, '2022_03_11_054505_change_country_datatype_to_users_table', 1),
(42, '2022_03_19_061725_add_campaign_id_field_to_campaign_updates_table', 1),
(43, '2022_03_19_124028_remove_description_field_to_success_stories_table', 1),
(44, '2022_03_25_095036_create_campaign_donation_transaction_table', 1),
(45, '2022_03_25_095113_create_campaign_donations_table', 1),
(46, '2022_03_31_092107_create_languages_table', 1),
(47, '2022_04_05_073444_create_withdrawal_requests_table', 1),
(48, '2022_04_09_075740_create_earnings_table', 1),
(49, '2022_04_20_131856_add_field_in_success_stories_table', 1),
(50, '2022_04_30_052948_create_bank_account_details_table', 1),
(51, '2022_05_03_093227_add_payment_type_field_in_withdrawal_requests_table', 1),
(52, '2022_05_27_045530_create_user_settings_table', 1),
(53, '2022_09_27_054339_run_default_all_seeder', 1),
(54, '2022_11_15_071922_create_withdrawals_table', 1),
(55, '2022_11_15_084827_run_withdrawals_seeder', 1),
(56, '2022_11_16_060632_add_two_fields_in_withdrawal_requests_table', 1),
(57, '2022_11_18_071151_run_add_charges_type_seeder', 1),
(58, '2022_12_01_071005_add_charge_amount_field_in_campaign_donations_table', 1),
(59, '2022_12_10_061447_add_donate_anonymously_field_in_campaign_donations_table', 1),
(60, '2022_12_12_093014_create_donation_gifts_table', 1),
(61, '2022_12_12_121937_create_gifts_table', 1),
(62, '2022_12_13_091730_create_campaign_gift', 1),
(63, '2022_12_13_102650_add_gift_status_field_to_campaign_table', 1),
(64, '2022_12_19_072406_add_gift_id_to_campaign_donation_transaction_table', 1),
(65, '2022_12_21_042754_add_gift_id_to_campaign_donations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_category_id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `news_category_id`, `description`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'Save the Children Role in Fight Against Malnutrition Hailed', 'save-the-childr', 2, 'Your contribution has the power to uplift children in dire situations. We’re working towards a nation where its children live a secure life, full of opportunities for growth and development', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Back to the future: Quality education through', 'back-to-the-fut', 1, 'Donate For Education For One Poor Child For One Year and Help Them Secure Their Future Help A Poor Child In Completing is Education By donating In few Easy Steps', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Take Care Of The Elderly Without Home', 'take-care-of-th', 3, 'Malnutrition is a condition that results from eating a diet lacking in nutrients and Malnutrition in children is especially harmful', 1, '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `news_categories`
--

CREATE TABLE `news_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_categories`
--

INSERT INTO `news_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Charity', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Education', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Food', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_news_tags`
--

CREATE TABLE `news_news_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_tags_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_news_tags`
--

INSERT INTO `news_news_tags` (`id`, `news_tags_id`, `news_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_tags`
--

CREATE TABLE `news_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_tags`
--

INSERT INTO `news_tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'donate', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'help', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'water', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage_users', 'Manage User', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(2, 'manage_settings', 'Manage Settings', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(3, 'manage_roles', 'Manage Roles', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(4, 'manage_dashboard', 'Manage Dashboard', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(5, 'manage_countries', 'Manage Countries', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(6, 'manage_events', 'Manage Events', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(7, 'manage_inquiries', 'Manage Inquiries', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(8, 'manage_pages', 'Manage Pages', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(9, 'manage_success_stories', 'Manage Success Stories', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(10, 'manage_brands', 'Manage Brands', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(11, 'manage_email_subscribe', 'Manage Email Subscribe', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(12, 'manage_about_us', 'Manage About Us', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(13, 'manage_news', 'Manage News', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(14, 'manage_campaign', 'Manage Campaign', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(15, 'manage_contact_us', 'Manage Contact Us', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(16, 'manage_teams', 'Manage Teams', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(17, 'manage_faqs', 'Manage Faqs', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(18, 'manage_sliders_third', 'Manage Sliders ', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(19, 'manage_categories_third', 'Manage Categories', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(20, 'manage_video_section_third', 'Manage Video Section ', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(21, 'manage_terms_conditions', 'Manage Terms Conditions', 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(22, 'manage_language', 'Manage Language', 'web', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `is_default`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 1, 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(2, 'user', 'User', 1, 'web', '2023-01-25 07:12:39', '2023-01-25 07:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `second_sliders`
--

CREATE TABLE `second_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `second_sliders`
--

INSERT INTO `second_sliders` (`id`, `title_1`, `title_2`, `created_at`, `updated_at`) VALUES
(1, 'Healthy Foods', 'We are On A Mission To  Start Today', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Our Mission:Medicine', 'More charity Make More better life', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Our Mission:Education', 'We are On A Mission To Change That', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `second_video_sections`
--

CREATE TABLE `second_video_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `second_video_sections`
--

INSERT INTO `second_video_sections` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'short_title', 'Life Changing Video', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'title', 'Joel Orphanage Of Ministry Uganda', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'bg_image', 'front_landing/web/media/avatars/150-26.jpg', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'youtube_video_link', 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'application_name', 'InfyFunding', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(2, 'app_logo', 'front_landing/images/funding-logo.png', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(3, 'app_favicon', 'front_landing/images/funding-logo.png', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(4, 'email', 'metrnonics@gmail.com', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(5, 'prefix_code', '91', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(6, 'phone', '9876543210', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(7, 'address', 'Mota Varachha, Surat, Gujarat', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(8, 'about_us', 'Elit aenean, amet eros curabitur. Wisi ad eget ipsum metus sociis Cras enim wisi elit aenean.', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(9, 'active_homepage_status', '1', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(10, 'terms_conditions', '<h1>Terms and Conditions</h1>\n<p>Last updated: December 28, 2021</p>\n<p>Please read these terms and conditions carefully before using Our Service.</p>\n<h1>Interpretation and Definitions</h1>\n<h2>Interpretation</h2>\n<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The\n    following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>\n<h2>Definitions</h2>\n<p>For the purposes of these Terms and Conditions:</p>\n<ul>\n    <li>\n        <p><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a\n            party, where &quot;control&quot; means ownership of 50% or more of the shares, equity interest or other\n            securities entitled to vote for election of directors or other managing authority.</p>\n    </li>\n    <li>\n        <p><strong>Country</strong> refers to: Gujarat, India</p>\n    </li>\n    <li>\n        <p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or\n            &quot;Our&quot; in this Agreement) refers to My Site.</p>\n    </li>\n    <li>\n        <p><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a\n            digital tablet.</p>\n    </li>\n    <li>\n        <p><strong>Service</strong> refers to the Website.</p>\n    </li>\n    <li>\n        <p><strong>Terms and Conditions</strong> (also referred as &quot;Terms&quot;) mean these Terms and Conditions\n            that form the entire agreement between You and the Company regarding the use of the Service.</p>\n    </li>\n    <li>\n        <p><strong>Third-party Social Media Service</strong> means any services or content (including data, information,\n            products or services) provided by a third-party that may be displayed, included or made available by the\n            Service.</p>\n    </li>\n    <li>\n        <p><strong>Website</strong> refers to My Site, accessible from <a href=\"http://infy-funding.test\"\n                                                                          rel=\"external nofollow noopener\"\n                                                                          target=\"_blank\">http://infy-funding.test</a></p>\n    </li>\n    <li>\n        <p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal\n            entity on behalf of which such individual is accessing or using the Service, as applicable.</p>\n    </li>\n</ul>\n<h1>Acknowledgment</h1>\n<p>These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and\n    the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the\n    Service.</p>\n<p>Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and\n    Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.</p>\n<p>By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree with any part\n    of these Terms and Conditions then You may not access the Service.</p>\n<p>You represent that you are over the age of 18. The Company does not permit those under 18 to use the Service.</p>\n<p>Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the Privacy\n    Policy of the Company. Our Privacy Policy describes Our policies and procedures on the collection, use and\n    disclosure of Your personal information when You use the Application or the Website and tells You about Your privacy\n    rights and how the law protects You. Please read Our Privacy Policy carefully before using Our Service.</p>\n<h1>Links to Other Websites</h1>\n<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by the\n    Company.</p>\n<p>The Company has no control over, and assumes no responsibility for, the content, privacy policies, or practices of\n    any third party web sites or services. You further acknowledge and agree that the Company shall not be responsible\n    or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with\n    the use of or reliance on any such content, goods or services available on or through any such web sites or\n    services.</p>\n<p>We strongly advise You to read the terms and conditions and privacy policies of any third-party web sites or services\n    that You visit.</p>\n<h1>Termination</h1>\n<p>We may terminate or suspend Your access immediately, without prior notice or liability, for any reason whatsoever,\n    including without limitation if You breach these Terms and Conditions.</p>\n<p>Upon termination, Your right to use the Service will cease immediately.</p>\n<h1>Limitation of Liability</h1>\n<p>Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under\n    any provision of this Terms and Your exclusive remedy for all of the foregoing shall be limited to the amount\n    actually paid by You through the Service or 100 USD if You haven\'t purchased anything through the Service.</p>\n<p>To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any\n    special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss\n    of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy\n    arising out of or in any way related to the use of or inability to use the Service, third-party software and/or\n    third-party hardware used with the Service, or otherwise in connection with any provision of this Terms), even if\n    the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its\n    essential purpose.</p>\n<p>Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or\n    consequential damages, which means that some of the above limitations may not apply. In these states, each party\'s\n    liability will be limited to the greatest extent permitted by law.</p>\n<h1>&quot;AS IS&quot; and &quot;AS AVAILABLE&quot; Disclaimer</h1>\n<p>The Service is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and defects without\n    warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on\n    behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all\n    warranties, whether express, implied, statutory or otherwise, with respect to the Service, including all implied\n    warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may\n    arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing,\n    the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet\n    Your requirements, achieve any intended results, be compatible or work with any other software, applications,\n    systems or services, operate without interruption, meet any performance or reliability standards or be error free or\n    that any errors or defects can or will be corrected.</p>\n<p>Without limiting the foregoing, neither the Company nor any of the company\'s provider makes any representation or\n    warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the\n    information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or\n    error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the\n    Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are\n    free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>\n<p>Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory\n    rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a\n    case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable\n    under applicable law.</p>\n<h1>Governing Law</h1>\n<p>The laws of the Country, excluding its conflicts of law rules, shall govern this Terms and Your use of the Service.\n    Your use of the Application may also be subject to other local, state, national, or international laws.</p>\n<h1>Disputes Resolution</h1>\n<p>If You have any concern or dispute about the Service, You agree to first try to resolve the dispute informally by\n    contacting the Company.</p>\n<h1>For European Union (EU) Users</h1>\n<p>If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the country in\n    which you are resident in.</p>\n<h1>United States Legal Compliance</h1>\n<p>You represent and warrant that (i) You are not located in a country that is subject to the United States government\n    embargo, or that has been designated by the United States government as a &quot;terrorist supporting&quot; country,\n    and (ii) You are not listed on any United States government list of prohibited or restricted parties.</p>\n<h1>Severability and Waiver</h1>\n<h2>Severability</h2>\n<p>If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and\n    interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and\n    the remaining provisions will continue in full force and effect.</p>\n<h2>Waiver</h2>\n<p>Except as provided herein, the failure to exercise a right or to require performance of an obligation under this\n    Terms shall not effect a party\'s ability to exercise such right or require such performance at any time thereafter\n    nor shall be the waiver of a breach constitute a waiver of any subsequent breach.</p>\n<h1>Translation Interpretation</h1>\n<p>These Terms and Conditions may have been translated if We have made them available to You on our Service.\n    You agree that the original English text shall prevail in the case of a dispute.</p>\n<h1>Changes to These Terms and Conditions</h1>\n<p>We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material\n    We will make reasonable efforts to provide at least 30 days\' notice prior to any new terms taking effect. What\n    constitutes a material change will be determined at Our sole discretion.</p>\n<p>By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the\n    revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the\n    Service.</p>\n<h1>Contact Us</h1>\n<p>If you have any questions about these Terms and Conditions, You can contact us:</p>\n\n', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(11, 'privacy_policy', '<h1>Privacy Policy</h1>\n<p>Last updated: December 28, 2021</p>\n<p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information\n    when You use the Service and tells You about Your privacy rights and how the law protects You.</p>\n<p>We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and\n    use of information in accordance with this Privacy Policy.</p>\n<h1>Interpretation and Definitions</h1>\n<h2>Interpretation</h2>\n<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The\n    following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>\n<h2>Definitions</h2>\n<p>For the purposes of this Privacy Policy:</p>\n<ul>\n    <li>\n        <p><strong>Account</strong> means a unique account created for You to access our Service or parts of our\n            Service.</p>\n    </li>\n    <li>\n        <p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or\n            &quot;Our&quot; in this Agreement) refers to My Site.</p>\n    </li>\n    <li>\n        <p><strong>Cookies</strong> are small files that are placed on Your computer, mobile device or any other device\n            by a website, containing the details of Your browsing history on that website among its many uses.</p>\n    </li>\n    <li>\n        <p><strong>Country</strong> refers to: Gujarat, India</p>\n    </li>\n    <li>\n        <p><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a\n            digital tablet.</p>\n    </li>\n    <li>\n        <p><strong>Personal Data</strong> is any information that relates to an identified or identifiable individual.\n        </p>\n    </li>\n    <li>\n        <p><strong>Service</strong> refers to the Website.</p>\n    </li>\n    <li>\n        <p><strong>Service Provider</strong> means any natural or legal person who processes the data on behalf of the\n            Company. It refers to third-party companies or individuals employed by the Company to facilitate the\n            Service, to provide the Service on behalf of the Company, to perform services related to the Service or to\n            assist the Company in analyzing how the Service is used.</p>\n    </li>\n    <li>\n        <p><strong>Usage Data</strong> refers to data collected automatically, either generated by the use of the\n            Service or from the Service infrastructure itself (for example, the duration of a page visit).</p>\n    </li>\n    <li>\n        <p><strong>Website</strong> refers to My Site, accessible from <a href=\"http://infy-funding.test\"\n                                                                          rel=\"external nofollow noopener\"\n                                                                          target=\"_blank\">http://infy-funding.test</a></p>\n    </li>\n    <li>\n        <p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal\n            entity on behalf of which such individual is accessing or using the Service, as applicable.</p>\n    </li>\n</ul>\n<h1>Collecting and Using Your Personal Data</h1>\n<h2>Types of Data Collected</h2>\n<h3>Personal Data</h3>\n<p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be\n    used to contact or identify You. Personally identifiable information may include, but is not limited to:</p>\n<ul>\n    <li>\n        <p>Email address</p>\n    </li>\n    <li>\n        <p>First name and last name</p>\n    </li>\n    <li>\n        <p>Phone number</p>\n    </li>\n    <li>\n        <p>Usage Data</p>\n    </li>\n</ul>\n<h3>Usage Data</h3>\n<p>Usage Data is collected automatically when using the Service.</p>\n<p>Usage Data may include information such as Your Device\'s Internet Protocol address (e.g. IP address), browser type,\n    browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those\n    pages, unique device identifiers and other diagnostic data.</p>\n<p>When You access the Service by or through a mobile device, We may collect certain information automatically,\n    including, but not limited to, the type of mobile device You use, Your mobile device unique ID, the IP address of\n    Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device\n    identifiers and other diagnostic data.</p>\n<p>We may also collect information that Your browser sends whenever You visit our Service or when You access the Service\n    by or through a mobile device.</p>\n<h3>Tracking Technologies and Cookies</h3>\n<p>We use Cookies and similar tracking technologies to track the activity on Our Service and store certain information.\n    Tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and\n    analyze Our Service. The technologies We use may include:</p>\n<ul>\n    <li><strong>Cookies or Browser Cookies.</strong> A cookie is a small file placed on Your Device. You can instruct\n        Your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if You do not accept\n        Cookies, You may not be able to use some parts of our Service. Unless you have adjusted Your browser setting so\n        that it will refuse Cookies, our Service may use Cookies.\n    </li>\n    <li><strong>Flash Cookies.</strong> Certain features of our Service may use local stored objects (or Flash Cookies)\n        to collect and store information about Your preferences or Your activity on our Service. Flash Cookies are not\n        managed by the same browser settings as those used for Browser Cookies. For more information on how You can\n        delete Flash Cookies, please read &quot;Where can I change the settings for disabling, or deleting local shared\n        objects?&quot; available at <a\n                href=\"//helpx.adobe.com/flash-player/kb/disable-local-shared-objects-flash.html#main_Where_can_I_change_the_settings_for_disabling__or_deleting_local_shared_objects_\"\n                rel=\"external nofollow noopener\" target=\"_blank\">Link</a>\n    </li>\n    <li><strong>Web Beacons.</strong> Certain sections of our Service and our emails may contain small electronic files\n        known as web beacons (also referred to as clear gifs, pixel tags, and single-pixel gifs) that permit the\n        Company, for example, to count users who have visited those pages or opened an email and for other related\n        website statistics (for example, recording the popularity of a certain section and verifying system and server\n        integrity).\n    </li>\n</ul>\n<p>Cookies can be &quot;Persistent&quot; or &quot;Session&quot; Cookies. Persistent Cookies remain on Your personal\n    computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close Your web\n    browser. You can learn more about cookies here: <a href=\"//html.com/resources/cookies-ultimate-guide/\"\n                                                       target=\"_blank\">Cookies Ultimate Guide</a>.</p>\n<p>We use both Session and Persistent Cookies for the purposes set out below:</p>\n<ul>\n    <li>\n        <p><strong>Necessary / Essential Cookies</strong></p>\n        <p>Type: Session Cookies</p>\n        <p>Administered by: Us</p>\n        <p>Purpose: These Cookies are essential to provide You with services available through the Website and to enable\n            You to use some of its features. They help to authenticate users and prevent fraudulent use of user\n            accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use\n            these Cookies to provide You with those services.</p>\n    </li>\n    <li>\n        <p><strong>Cookies Policy / Notice Acceptance Cookies</strong></p>\n        <p>Type: Persistent Cookies</p>\n        <p>Administered by: Us</p>\n        <p>Purpose: These Cookies identify if users have accepted the use of cookies on the Website.</p>\n    </li>\n    <li>\n        <p><strong>Functionality Cookies</strong></p>\n        <p>Type: Persistent Cookies</p>\n        <p>Administered by: Us</p>\n        <p>Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering\n            your login details or language preference. The purpose of these Cookies is to provide You with a more\n            personal experience and to avoid You having to re-enter your preferences every time You use the Website.</p>\n    </li>\n</ul>\n<p>For more information about the cookies we use and your choices regarding cookies, please visit our Cookies Policy or\n    the Cookies section of our Privacy Policy.</p>\n<h2>Use of Your Personal Data</h2>\n<p>The Company may use Personal Data for the following purposes:</p>\n<ul>\n    <li>\n        <p><strong>To provide and maintain our Service</strong>, including to monitor the usage of our Service.</p>\n    </li>\n    <li>\n        <p><strong>To manage Your Account:</strong> to manage Your registration as a user of the Service. The Personal\n            Data You provide can give You access to different functionalities of the Service that are available to You\n            as a registered user.</p>\n    </li>\n    <li>\n        <p><strong>For the performance of a contract:</strong> the development, compliance and undertaking of the\n            purchase contract for the products, items or services You have purchased or of any other contract with Us\n            through the Service.</p>\n    </li>\n    <li>\n        <p><strong>To contact You:</strong> To contact You by email, telephone calls, SMS, or other equivalent forms of\n            electronic communication, such as a mobile application\'s push notifications regarding updates or informative\n            communications related to the functionalities, products or contracted services, including the security\n            updates, when necessary or reasonable for their implementation.</p>\n    </li>\n    <li>\n        <p><strong>To provide You</strong> with news, special offers and general information about other goods, services\n            and events which we offer that are similar to those that you have already purchased or enquired about unless\n            You have opted not to receive such information.</p>\n    </li>\n    <li>\n        <p><strong>To manage Your requests:</strong> To attend and manage Your requests to Us.</p>\n    </li>\n    <li>\n        <p><strong>For business transfers:</strong> We may use Your information to evaluate or conduct a merger,\n            divestiture, restructuring, reorganization, dissolution, or other sale or transfer of some or all of Our\n            assets, whether as a going concern or as part of bankruptcy, liquidation, or similar proceeding, in which\n            Personal Data held by Us about our Service users is among the assets transferred.</p>\n    </li>\n    <li>\n        <p><strong>For other purposes</strong>: We may use Your information for other purposes, such as data analysis,\n            identifying usage trends, determining the effectiveness of our promotional campaigns and to evaluate and\n            improve our Service, products, services, marketing and your experience.</p>\n    </li>\n</ul>\n<p>We may share Your personal information in the following situations:</p>\n<ul>\n    <li><strong>With Service Providers:</strong> We may share Your personal information with Service Providers to\n        monitor and analyze the use of our Service, to contact You.\n    </li>\n    <li><strong>For business transfers:</strong> We may share or transfer Your personal information in connection with,\n        or during negotiations of, any merger, sale of Company assets, financing, or acquisition of all or a portion of\n        Our business to another company.\n    </li>\n    <li><strong>With Affiliates:</strong> We may share Your information with Our affiliates, in which case we will\n        require those affiliates to honor this Privacy Policy. Affiliates include Our parent company and any other\n        subsidiaries, joint venture partners or other companies that We control or that are under common control with\n        Us.\n    </li>\n    <li><strong>With business partners:</strong> We may share Your information with Our business partners to offer You\n        certain products, services or promotions.\n    </li>\n    <li><strong>With other users:</strong> when You share personal information or otherwise interact in the public areas\n        with other users, such information may be viewed by all users and may be publicly distributed outside.\n    </li>\n    <li><strong>With Your consent</strong>: We may disclose Your personal information for any other purpose with Your\n        consent.\n    </li>\n</ul>\n<h2>Retention of Your Personal Data</h2>\n<p>The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy\n    Policy. We will retain and use Your Personal Data to the extent necessary to comply with our legal obligations (for\n    example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our\n    legal agreements and policies.</p>\n<p>The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a\n    shorter period of time, except when this data is used to strengthen the security or to improve the functionality of\n    Our Service, or We are legally obligated to retain this data for longer time periods.</p>\n<h2>Transfer of Your Personal Data</h2>\n<p>Your information, including Personal Data, is processed at the Company\'s operating offices and in any other places\n    where the parties involved in the processing are located. It means that this information may be transferred to — and\n    maintained on — computers located outside of Your state, province, country or other governmental jurisdiction where\n    the data protection laws may differ than those from Your jurisdiction.</p>\n<p>Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that\n    transfer.</p>\n<p>The Company will take all steps reasonably necessary to ensure that Your data is treated securely and in accordance\n    with this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country\n    unless there are adequate controls in place including the security of Your data and other personal information.</p>\n<h2>Disclosure of Your Personal Data</h2>\n<h3>Business Transactions</h3>\n<p>If the Company is involved in a merger, acquisition or asset sale, Your Personal Data may be transferred. We will\n    provide notice before Your Personal Data is transferred and becomes subject to a different Privacy Policy.</p>\n<h3>Law enforcement</h3>\n<p>Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law\n    or in response to valid requests by public authorities (e.g. a court or a government agency).</p>\n<h3>Other legal requirements</h3>\n<p>The Company may disclose Your Personal Data in the good faith belief that such action is necessary to:</p>\n<ul>\n    <li>Comply with a legal obligation</li>\n    <li>Protect and defend the rights or property of the Company</li>\n    <li>Prevent or investigate possible wrongdoing in connection with the Service</li>\n    <li>Protect the personal safety of Users of the Service or the public</li>\n    <li>Protect against legal liability</li>\n</ul>\n<h2>Security of Your Personal Data</h2>\n<p>The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet,\n    or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your\n    Personal Data, We cannot guarantee its absolute security.</p>\n<h1>Children\'s Privacy</h1>\n<p>Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable\n    information from anyone under the age of 13. If You are a parent or guardian and You are aware that Your child has\n    provided Us with Personal Data, please contact Us. If We become aware that We have collected Personal Data from\n    anyone under the age of 13 without verification of parental consent, We take steps to remove that information from\n    Our servers.</p>\n<p>If We need to rely on consent as a legal basis for processing Your information and Your country requires consent from\n    a parent, We may require Your parent\'s consent before We collect and use that information.</p>\n<h1>Links to Other Websites</h1>\n<p>Our Service may contain links to other websites that are not operated by Us. If You click on a third party link, You\n    will be directed to that third party\'s site. We strongly advise You to review the Privacy Policy of every site You\n    visit.</p>\n<p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third\n    party sites or services.</p>\n<h1>Changes to this Privacy Policy</h1>\n<p>We may update Our Privacy Policy from time to time. We will notify You of any changes by posting the new Privacy\n    Policy on this page.</p>\n<p>We will let You know via email and/or a prominent notice on Our Service, prior to the change becoming effective and\n    update the &quot;Last updated&quot; date at the top of this Privacy Policy.</p>\n<p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are\n    effective when they are posted on this page.</p>\n<h1>Contact Us</h1>\n<p>If you have any questions about this Privacy Policy, You can contact us:</p>\n', '2023-01-25 07:12:39', '2023-01-25 07:12:39'),
(12, 'youtube_url', 'https://www.youtube.com/infyom/', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(13, 'pinterest_url', 'https://www.pinterest.com/infyom/', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(14, 'twitter_url', 'https://www.twitter.com/infyom/', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(15, 'instagram_url', 'https://www.instagram.com/infyom/', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(16, 'facebook_url', 'https://www.facebook.com/infyom/', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(17, 'linkedin_url', 'https://www.linkedin.com/infyom/', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(18, 'stripe_enable', '0', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(19, 'paypal_enable', '0', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(20, 'charges_type', '2', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(21, 'donation_commission', '0', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `slider_card`
--

CREATE TABLE `slider_card` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_card`
--

INSERT INTO `slider_card` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'title_1', 'Trending Cause', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'title_2', 'Make A Support', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'image', 'front_landing/landing/img/home1/support_girl2.jpg', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `success_stories`
--

CREATE TABLE `success_stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `designation`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Salman Ahmad', 'Founder', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Mrs. Dimassi Shatt', 'CEO', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Mr. Paul Smith', 'Support Staff', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'Mr. John Thompson', 'Support Staff', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `third_sliders`
--

CREATE TABLE `third_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `third_sliders`
--

INSERT INTO `third_sliders` (`id`, `title_1`, `title_2`, `created_at`, `updated_at`) VALUES
(1, 'Healthy Foods', 'We are On A Mission To  Start Today', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Our Mission:Medicine', 'More charity Make More better life', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'Our Mission:Education', 'We are On A Mission To Change That', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `third_video_sections`
--

CREATE TABLE `third_video_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `third_video_sections`
--

INSERT INTO `third_video_sections` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'short_title', 'Life Changing Video', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'title', 'Joel Orphanage Of Ministry Uganda', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(3, 'bg_image', 'http://infy-funding.test/front_landing/images/video-img.png', '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(4, 'youtube_video_link', 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities', '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `address` text COLLATE utf8mb4_unicode_ci,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `region_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `contact`, `gender`, `dob`, `is_active`, `role`, `language`, `address`, `country_id`, `type`, `region_code`, `remember_token`, `created_at`, `updated_at`, `is_default`) VALUES
(1, 'Super', 'Admin', 'admin@infyfund.com', '2023-01-25 07:12:39', '$2y$10$w4rs8YmJtcWWPqfBVAjSruWCyT2Y..HtJQFzdQnngeKoGqR/EU/Ii', '1234567890', 1, NULL, 1, NULL, 'en', NULL, NULL, 1, NULL, NULL, '2023-01-25 07:12:39', '2023-01-25 07:12:39', 1),
(2, 'John', 'Doe', 'user@infyfund.com', '2023-01-25 07:12:39', '$2y$10$8jOWJTzcUVzW3u.IpI8lMOG0BFxrOWR6HOsKYYH35kS0QAS7EW1Ze', '1234567890', 1, NULL, 1, NULL, 'en', NULL, NULL, 1, NULL, NULL, '2023-01-25 07:12:39', '2023-01-25 07:12:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` int(11) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `payment_type`, `discount_type`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'PayPal', 1, 10, '2023-01-25 07:12:40', '2023-01-25 07:12:40'),
(2, 'Bank', 1, 10, '2023-01-25 07:12:40', '2023-01-25 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_requests`
--

CREATE TABLE `withdrawal_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT '0.00',
  `is_approved` tinyint(1) DEFAULT '0',
  `status` int(11) DEFAULT '2',
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `admin_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `deducate_amount` double DEFAULT NULL,
  `charge_amount` double DEFAULT NULL,
  `discount_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_account_details_withdrawal_request_id_foreign` (`withdrawal_request_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_to_actions`
--
ALTER TABLE `call_to_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campaigns_title_unique` (`title`),
  ADD UNIQUE KEY `campaigns_slug_unique` (`slug`),
  ADD KEY `campaigns_campaign_category_id_foreign` (`campaign_category_id`),
  ADD KEY `campaigns_country_id_foreign` (`country_id`),
  ADD KEY `campaigns_user_id_foreign` (`user_id`);

--
-- Indexes for table `campaign_categories`
--
ALTER TABLE `campaign_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign_donations`
--
ALTER TABLE `campaign_donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_donations_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_donations_user_id_foreign` (`user_id`),
  ADD KEY `campaign_donations_campaign_donation_transaction_id_foreign` (`campaign_donation_transaction_id`),
  ADD KEY `campaign_donations_gift_id_foreign` (`gift_id`);

--
-- Indexes for table `campaign_donation_transaction`
--
ALTER TABLE `campaign_donation_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_donation_transaction_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_donation_transaction_gift_id_foreign` (`gift_id`);

--
-- Indexes for table `campaign_faqs`
--
ALTER TABLE `campaign_faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_faqs_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `campaign_gift`
--
ALTER TABLE `campaign_gift`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_gift_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_gift_donation_gift_id_foreign` (`donation_gift_id`);

--
-- Indexes for table `campaign_updates`
--
ALTER TABLE `campaign_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_updates_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `cms_2_categories`
--
ALTER TABLE `cms_2_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_3_categories`
--
ALTER TABLE `cms_3_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_gifts`
--
ALTER TABLE `donation_gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_subscribes`
--
ALTER TABLE `email_subscribes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_subscribes_email_unique` (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_category_id_foreign` (`category_id`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_participants_event_id_foreign` (`event_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_sliders`
--
ALTER TABLE `front_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_video_settings`
--
ALTER TABLE `front_video_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gifts_donation_gift_id_foreign` (`donation_gift_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_iso_code_unique` (`iso_code`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_id`,`model_type`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_news_category_id_foreign` (`news_category_id`),
  ADD KEY `news_added_by_foreign` (`added_by`);

--
-- Indexes for table `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_categories_name_unique` (`name`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_comments_news_id_foreign` (`news_id`),
  ADD KEY `news_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `news_news_tags`
--
ALTER TABLE `news_news_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_news_tags_news_tags_id_foreign` (`news_tags_id`),
  ADD KEY `news_news_tags_news_id_foreign` (`news_id`);

--
-- Indexes for table `news_tags`
--
ALTER TABLE `news_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_tags_name_unique` (`name`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `second_sliders`
--
ALTER TABLE `second_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `second_video_sections`
--
ALTER TABLE `second_video_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_card`
--
ALTER TABLE `slider_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `success_stories`
--
ALTER TABLE `success_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_sliders`
--
ALTER TABLE `third_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_video_sections`
--
ALTER TABLE `third_video_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawal_requests_campaign_id_foreign` (`campaign_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `call_to_actions`
--
ALTER TABLE `call_to_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaign_categories`
--
ALTER TABLE `campaign_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaign_donations`
--
ALTER TABLE `campaign_donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_donation_transaction`
--
ALTER TABLE `campaign_donation_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_faqs`
--
ALTER TABLE `campaign_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_gift`
--
ALTER TABLE `campaign_gift`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_updates`
--
ALTER TABLE `campaign_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_2_categories`
--
ALTER TABLE `cms_2_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cms_3_categories`
--
ALTER TABLE `cms_3_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation_gifts`
--
ALTER TABLE `donation_gifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_subscribes`
--
ALTER TABLE `email_subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_participants`
--
ALTER TABLE `event_participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `front_sliders`
--
ALTER TABLE `front_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `front_video_settings`
--
ALTER TABLE `front_video_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_news_tags`
--
ALTER TABLE `news_news_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_tags`
--
ALTER TABLE `news_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `second_sliders`
--
ALTER TABLE `second_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `second_video_sections`
--
ALTER TABLE `second_video_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `slider_card`
--
ALTER TABLE `slider_card`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `success_stories`
--
ALTER TABLE `success_stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `third_sliders`
--
ALTER TABLE `third_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `third_video_sections`
--
ALTER TABLE `third_video_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  ADD CONSTRAINT `bank_account_details_withdrawal_request_id_foreign` FOREIGN KEY (`withdrawal_request_id`) REFERENCES `withdrawal_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_campaign_category_id_foreign` FOREIGN KEY (`campaign_category_id`) REFERENCES `campaign_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaigns_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaigns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign_donations`
--
ALTER TABLE `campaign_donations`
  ADD CONSTRAINT `campaign_donations_campaign_donation_transaction_id_foreign` FOREIGN KEY (`campaign_donation_transaction_id`) REFERENCES `campaign_donation_transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaign_donations_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaign_donations_gift_id_foreign` FOREIGN KEY (`gift_id`) REFERENCES `donation_gifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaign_donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign_donation_transaction`
--
ALTER TABLE `campaign_donation_transaction`
  ADD CONSTRAINT `campaign_donation_transaction_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaign_donation_transaction_gift_id_foreign` FOREIGN KEY (`gift_id`) REFERENCES `donation_gifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign_faqs`
--
ALTER TABLE `campaign_faqs`
  ADD CONSTRAINT `campaign_faqs_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign_gift`
--
ALTER TABLE `campaign_gift`
  ADD CONSTRAINT `campaign_gift_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaign_gift_donation_gift_id_foreign` FOREIGN KEY (`donation_gift_id`) REFERENCES `donation_gifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign_updates`
--
ALTER TABLE `campaign_updates`
  ADD CONSTRAINT `campaign_updates_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `event_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD CONSTRAINT `event_participants_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gifts`
--
ALTER TABLE `gifts`
  ADD CONSTRAINT `gifts_donation_gift_id_foreign` FOREIGN KEY (`donation_gift_id`) REFERENCES `donation_gifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_news_category_id_foreign` FOREIGN KEY (`news_category_id`) REFERENCES `news_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD CONSTRAINT `news_comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_news_tags`
--
ALTER TABLE `news_news_tags`
  ADD CONSTRAINT `news_news_tags_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_news_tags_news_tags_id_foreign` FOREIGN KEY (`news_tags_id`) REFERENCES `news_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD CONSTRAINT `withdrawal_requests_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
