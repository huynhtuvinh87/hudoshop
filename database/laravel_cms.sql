/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 100140
 Source Host           : localhost:3306
 Source Schema         : laravel_cms

 Target Server Type    : MySQL
 Target Server Version : 100140
 File Encoding         : 65001

 Date: 28/04/2020 16:48:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT NULL,
  `level` int(11) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, NULL, 1, 'Ngoại hạng Anh', 'ngoai-hang-anh', 'Mo ta', NULL, '2020-04-28 02:02:05', 3);
INSERT INTO `categories` VALUES (2, NULL, 1, 'Bóng đá Tây Ba Nha', 'bong-da-tay-ba-nha', 'Bóng đá Tây Ba Nha', NULL, '2020-04-28 05:03:39', 0);
INSERT INTO `categories` VALUES (3, NULL, 1, 'Nhận định soi kèo', 'nhan-dinh-soi-keo', NULL, NULL, '2020-04-27 08:13:57', 0);
INSERT INTO `categories` VALUES (4, NULL, 1, 'Kinh nghiệm cá cược', 'kinh-nghiem-ca-cuoc', NULL, '2020-04-20 03:27:42', '2020-04-27 08:14:27', 0);
INSERT INTO `categories` VALUES (5, NULL, 1, 'Video', 'video', NULL, '2020-04-20 03:33:18', '2020-04-27 08:14:53', 0);
INSERT INTO `categories` VALUES (6, NULL, 1, 'Bóng đá Đức', 'bong-da-duc', NULL, '2020-04-20 03:52:22', '2020-04-27 08:12:09', 0);
INSERT INTO `categories` VALUES (7, NULL, 1, 'Bóng đá Pháp', 'bong-da-phap', NULL, '2020-04-20 03:56:16', '2020-04-27 08:12:25', 0);
INSERT INTO `categories` VALUES (8, NULL, 1, 'Bóng đá Ý', 'bong-da-y', NULL, '2020-04-20 04:02:02', '2020-04-27 08:12:52', 0);
INSERT INTO `categories` VALUES (9, NULL, 1, 'Góc nhà cái', 'goc-nha-cai', NULL, '2020-04-20 04:02:26', '2020-04-27 08:15:14', 0);
INSERT INTO `categories` VALUES (10, NULL, 1, 'Các giải bóng đá khác', 'cac-giai-bong-da-khac', NULL, '2020-04-22 02:38:52', '2020-04-27 08:13:15', 0);
INSERT INTO `categories` VALUES (11, NULL, 1, 'Thủ thuật chơi phạt góc', 'thu-thuat-choi-phat-goc', 'Thủ thuật chơi phạt góc', '2020-04-28 05:02:38', '2020-04-28 05:02:38', 0);
INSERT INTO `categories` VALUES (12, NULL, 1, 'Tips miễn phí', 'tips-mien-phi', 'Tips miễn phí', '2020-04-28 05:03:05', '2020-04-28 05:03:05', 0);
INSERT INTO `categories` VALUES (13, NULL, 1, 'Người đẹp 18 +', 'nguoi-dep-18', 'Người đẹp 18 +', '2020-04-28 05:03:23', '2020-04-28 05:03:23', 0);

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT NULL,
  `level` int(11) NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `type` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, NULL, 1, 'Header', 'Trang chủ', 'http://127.0.0.1:8000/', '2020-04-22 02:48:19', '2020-04-22 02:48:19', NULL, NULL);
INSERT INTO `menus` VALUES (2, NULL, 1, 'Header', 'Nhận định soi kèo', 'http://127.0.0.1:8000/abc', '2020-04-22 03:00:28', '2020-04-22 03:00:28', NULL, NULL);
INSERT INTO `menus` VALUES (3, NULL, 1, 'Header', 'Tin tức', 'http://127.0.0.1:8000/', '2020-04-22 03:00:47', '2020-04-22 03:00:47', NULL, NULL);
INSERT INTO `menus` VALUES (4, 3, 1, 'Header', 'Bóng đá Việt Nam', 'http://127.0.0.1:8000/', '2020-04-22 03:01:15', '2020-04-22 03:01:15', NULL, NULL);
INSERT INTO `menus` VALUES (5, 3, 1, 'Header', 'Bóng đá thế giới', 'http://127.0.0.1:8000/', '2020-04-22 03:01:40', '2020-04-22 03:01:40', NULL, NULL);
INSERT INTO `menus` VALUES (6, 4, 1, 'Body', 'Đà Nẵng', 'http://127.0.0.1:8000/', '2020-04-22 04:02:31', '2020-04-22 04:02:31', NULL, NULL);
INSERT INTO `menus` VALUES (7, NULL, 1, 'sdsdqas', 'Ngoại hạng Anh', 'http://127.0.0.1:8000/category/ngoai-hang-anh', '2020-04-27 09:13:05', '2020-04-27 09:13:05', 'category', 1);
INSERT INTO `menus` VALUES (8, NULL, 1, 'sdsdqas', 'Ngoại hạng Anh', 'http://127.0.0.1:8000/category/ngoai-hang-anh', '2020-04-27 09:15:25', '2020-04-27 09:15:25', 'category', 1);
INSERT INTO `menus` VALUES (10, NULL, 1, 'vdsa', 'Nhận định soi kèo', 'http://127.0.0.1:8000/category/nhan-dinh-soi-keo', '2020-04-27 09:21:12', '2020-04-27 09:21:12', 'category', 3);
INSERT INTO `menus` VALUES (11, NULL, 1, 'Body', 'Bóng đá Đức', 'http://127.0.0.1:8000/category/bong-da-duc', '2020-04-27 09:24:26', '2020-04-27 09:24:26', 'category', 6);
INSERT INTO `menus` VALUES (12, NULL, 1, 'Body', 'Bóng đá Pháp', 'http://127.0.0.1:8000/category/bong-da-phap', '2020-04-27 09:24:26', '2020-04-27 09:24:26', 'category', 7);
INSERT INTO `menus` VALUES (17, NULL, 1, 'Page', 'Giới thiệu', 'http://127.0.0.1:8000/page/gioi-thieu', '2020-04-28 03:52:48', '2020-04-28 03:52:48', 'page', 7);
INSERT INTO `menus` VALUES (18, NULL, 1, 'Page', 'Hướng dẫn sử dụng 123', 'http://127.0.0.1:8000/page/huong-dan-su-dung', '2020-04-28 03:52:48', '2020-04-28 04:03:01', 'page', 8);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_04_01_093140_create_post_categories_table', 2);
INSERT INTO `migrations` VALUES (5, '2020_04_01_093140_create_post_metas_table', 2);
INSERT INTO `migrations` VALUES (6, '2020_04_01_093140_create_posts_table', 2);
INSERT INTO `migrations` VALUES (7, '2020_04_02_022734_create_categories_table', 2);
INSERT INTO `migrations` VALUES (8, '2020_04_02_022735_create_menus_table', 3);
INSERT INTO `migrations` VALUES (9, '2020_04_02_022736_create_settings_table', 4);
INSERT INTO `migrations` VALUES (10, '2020_04_02_022737_create_contacts_table', 5);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES (2, 'huynhtuvinh87@gmail.com', '$2y$10$oF9im6V6kr/jafqGPCfh8uY.FDb7qbt4VcyfC6/4AcUc/9uNbgloC', '2020-04-15 07:36:25', '2020-04-15 09:27:21');

-- ----------------------------
-- Table structure for post_categories
-- ----------------------------
DROP TABLE IF EXISTS `post_categories`;
CREATE TABLE `post_categories`  (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of post_categories
-- ----------------------------
INSERT INTO `post_categories` VALUES (7, 7);
INSERT INTO `post_categories` VALUES (9, 1);
INSERT INTO `post_categories` VALUES (9, 4);
INSERT INTO `post_categories` VALUES (10, 1);
INSERT INTO `post_categories` VALUES (10, 2);
INSERT INTO `post_categories` VALUES (11, 3);
INSERT INTO `post_categories` VALUES (11, 6);
INSERT INTO `post_categories` VALUES (6, 4);
INSERT INTO `post_categories` VALUES (6, 5);
INSERT INTO `post_categories` VALUES (5, 3);
INSERT INTO `post_categories` VALUES (5, 4);
INSERT INTO `post_categories` VALUES (5, 7);
INSERT INTO `post_categories` VALUES (5, 8);
INSERT INTO `post_categories` VALUES (5, 9);
INSERT INTO `post_categories` VALUES (5, 10);
INSERT INTO `post_categories` VALUES (5, 11);
INSERT INTO `post_categories` VALUES (4, 1);
INSERT INTO `post_categories` VALUES (4, 2);
INSERT INTO `post_categories` VALUES (4, 3);
INSERT INTO `post_categories` VALUES (4, 4);
INSERT INTO `post_categories` VALUES (4, 5);
INSERT INTO `post_categories` VALUES (4, 6);
INSERT INTO `post_categories` VALUES (4, 7);
INSERT INTO `post_categories` VALUES (4, 8);
INSERT INTO `post_categories` VALUES (2, 2);
INSERT INTO `post_categories` VALUES (2, 6);
INSERT INTO `post_categories` VALUES (2, 7);
INSERT INTO `post_categories` VALUES (2, 8);
INSERT INTO `post_categories` VALUES (2, 11);
INSERT INTO `post_categories` VALUES (12, 1);
INSERT INTO `post_categories` VALUES (12, 2);
INSERT INTO `post_categories` VALUES (12, 6);
INSERT INTO `post_categories` VALUES (12, 7);
INSERT INTO `post_categories` VALUES (12, 8);
INSERT INTO `post_categories` VALUES (12, 10);
INSERT INTO `post_categories` VALUES (12, 11);
INSERT INTO `post_categories` VALUES (1, 1);
INSERT INTO `post_categories` VALUES (1, 3);
INSERT INTO `post_categories` VALUES (1, 9);
INSERT INTO `post_categories` VALUES (1, 10);
INSERT INTO `post_categories` VALUES (3, 3);
INSERT INTO `post_categories` VALUES (3, 6);
INSERT INTO `post_categories` VALUES (3, 7);
INSERT INTO `post_categories` VALUES (3, 8);

-- ----------------------------
-- Table structure for post_metas
-- ----------------------------
DROP TABLE IF EXISTS `post_metas`;
CREATE TABLE `post_metas`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (1, 'article', 1, 'M.U đã có truyền nhân của Paul Scholes sau nhiều năm chờ đợi', 'mu-da-co-truyen-nhan-cua-paul-scholes-sau-nhieu-nam-cho-doi', '<p>obson từng c&oacute; 13 năm th&agrave;nh c&ocirc;ng trong m&agrave;u &aacute;o M.U (1981-1994). Cựu thủ qu&acirc;n&nbsp;của Quỷ đỏ th&agrave;nh Manchester đ&atilde; n&acirc;ng cao chức v&ocirc; địch giải&nbsp;<a href=\"https://bongdaplus.vn/ngoai-hang-anh.html\">Ngoại hạng Anh</a>&nbsp;2 m&ugrave;a giải li&ecirc;n tiếp (1992/93, 1993/94) cũng như gi&agrave;nh 3 chức v&ocirc; địch FA Cup c&ugrave;ng 1&nbsp;c&uacute;p C2. Sau 461 trận cho đội chủ s&acirc;n Old Trafford, Robson c&oacute; được 99 b&agrave;n thắng v&agrave; được xem l&agrave; tượng đ&agrave;i của đội b&oacute;ng.</p>\r\n\r\n<p>Trong ph&aacute;t biểu mới đ&acirc;y của m&igrave;nh, Robson tiết lộ &ocirc;ng rất ấn tượng với những g&igrave; đo&agrave;n qu&acirc;n HLV Ole Gunnar Solskjaer thể hiện trước khi m&ugrave;a giải tạm nghỉ do đại dịch Covid-19. Một trong những c&aacute;i t&ecirc;n thuyết phục được Robson nhất ch&iacute;nh l&agrave; tiền vệ t&acirc;n binh Bruno Fernandes, người được &ocirc;ng khẳng định gần đẳng cấp Paul Scholes nhất sau nhiều năm.</p>\r\n\r\n<p>&quot;M&agrave;n tr&igrave;nh diễn trước khi m&ugrave;a giải tạm ho&atilde;n chắc chắn rất đ&aacute;ng kh&iacute;ch lệ. Những g&igrave; đang diễn ra cho thấy Solskjaer đang đi đ&uacute;ng đường. Bruno Fernandes cũng đ&atilde; chứng minh m&igrave;nh l&agrave; một bản hợp đồng tuyệt vời&quot;, huyền thoại Robson chia sẻ.</p>', 1, '2020-04-21 04:26:18', '2020-04-28 05:39:19', NULL, 'http://127.0.0.1:8000/photos/shares/thumbs/unnamed.jpg', 'M.U đã có truyền nhân của Paul Scholes sau nhiều năm chờ đợi', 'M.U đã có truyền nhân của Paul Scholes sau nhiều năm chờ đợi', 'Trong phát biểu mới đây của mình, Robson tiết lộ ông rất ấn tượng với những gì đoàn quân HLV Ole Gunnar Solskjaer thể hiện trước khi mùa giải tạm nghỉ do đại dịch Covid-19');
INSERT INTO `posts` VALUES (2, 'article', 1, 'Nhìn lại một số pha thay người hay nhất ở Premier League', 'nhin-lai-mot-so-pha-thay-nguoi-hay-nhat-o-premier-league', '<p>Trong lịch sử b&oacute;ng đ&aacute;, c&oacute; những quyết định thay người tưởng như rất b&igrave;nh thường lại định đoạt cả cục diện trận đấu. Dưới đ&acirc;y l&agrave; một số v&iacute; dụ kinh điển về điều đ&oacute; tại Premier League.</p>', 1, '2020-04-21 04:29:01', '2020-04-28 05:37:45', NULL, 'http://127.0.0.1:8000/photos/shares/test/thumbs/87186609_184215699658200_1870881818492796928_n-250x240.jpg', NULL, NULL, 'Trong lịch sử bóng đá, có những quyết định thay người tưởng như rất bình thường lại định đoạt cả cục diện trận đấu. Dưới đây là một số ví dụ kinh điển về điều đó tại Premier League.');
INSERT INTO `posts` VALUES (3, 'article', 1, 'Ferdinand tiết lộ vụ \'trả đũa\' Suarez vì từ chối bắt tay Evra', 'ferdinand-tiet-lo-vu-tra-dua-suarez-vi-tu-choi-bat-tay-evra', '<p>Cựu trung vệ CLB Man United - Rio Ferdinand mới đ&acirc;y đ&atilde; tiết lộ c&acirc;u chuyện ly kỳ li&ecirc;n quan đến vụ xung đột giữa Luis Suarez v&agrave; Patrice Evra khiến b&aacute;o giới từng phải tốn rất nhiều giấy mực.</p>', 1, '2020-04-21 04:32:06', '2020-04-28 05:40:36', NULL, 'http://127.0.0.1:8000/photos/shares/thumbs/5c1de394b9585.png', NULL, NULL, 'Cựu trung vệ CLB Man United - Rio Ferdinand mới đây đã tiết lộ câu chuyện ly kỳ liên quan đến vụ xung đột giữa Luis Suarez và Patrice Evra khiến báo giới từng phải tốn rất nhiều giấy mực.');
INSERT INTO `posts` VALUES (4, 'article', 1, 'Liverpool phải lùi kế hoạch mở rộng sân Anfield vì đại dịch Covid-19', 'liverpool-phai-lui-ke-hoach-mo-rong-san-anfield-vi-dai-dich-covid-19', '<p>Liverpool đ&atilde; l&ecirc;n kế hoạch tăng số lượng ghế của s&acirc;n Anfield th&ecirc;m 16.000 chỗ ngồi, n&acirc;ng tổng sức chứa l&ecirc;n th&agrave;nh 61.000 chỗ ngồi. Dự &aacute;n n&agrave;y đ&atilde; được c&ocirc;ng bố v&agrave;o năm ngo&aacute;i, dự kiến thi c&ocirc;ng cuối năm nay nhưng bất th&agrave;nh v&igrave; đại dịch virus Covid-19.&nbsp;</p>', 3, '2020-04-21 04:33:14', '2020-04-28 05:35:42', NULL, 'http://127.0.0.1:8000/photos/shares/thumbs/2020-02-20 10_36_30-Capture.png', NULL, NULL, 'Liverpool đã lên kế hoạch tăng số lượng ghế của sân Anfield thêm 16.000 chỗ ngồi, nâng tổng sức chứa lên thành 61.000 chỗ ngồi. Dự án này đã được công bố vào năm ngoái, dự kiến thi công cuối năm nay nhưng bất thành vì đại dịch virus Covid-19.');
INSERT INTO `posts` VALUES (5, 'article', 1, 'Đẩy lùi Covid-19, Premier League dự kiến trở lại vào đầu tháng 6', 'day-lui-covid-19-premier-league-du-kien-tro-lai-vao-dau-thang-6', '<p>dsadsaqsadasd</p>', 1, '2020-04-21 04:34:07', '2020-04-28 05:34:54', 'a:3:{i:0;s:60:\"http://127.0.0.1:8000/photos/shares/thumbs/5c1de394b872b.png\";i:1;s:94:\"http://127.0.0.1:8000/photos/shares/thumbs/93412120_1118529035173807_6305220146118000640_n.jpg\";i:2;s:60:\"http://127.0.0.1:8000/photos/shares/thumbs/5c1de394b8c2d.png\";}', 'http://127.0.0.1:8000/photos/shares/thumbs/8ea7dbbdd47ae1037de30fd55ae446b2.jpeg', NULL, NULL, 'Trong cuộc đàm phán mới nhất với những người đứng đầu Premier League, Chính phủ Anh đã đưa ra yêu cầu đưa bóng đá trở lại \"càng sớm càng tốt\".');
INSERT INTO `posts` VALUES (6, 'article', 1, 'Chợ hè Ngoại hạng Anh mở cửa ở thời điểm bất thường', 'cho-he-ngoai-hang-anh-mo-cua-o-thoi-diem-bat-thuong', '<p>dsadsaqsadasd</p>', 1, '2020-04-21 04:34:32', '2020-04-28 05:33:35', '', 'http://127.0.0.1:8000/photos/shares/thumbs/2020-02-20 10_36_30-Capture.png', 'mjhvjh', 'hjhhg', 'Kỳ chuyển nhượng hè 2020 ở Anh nhiều khả năng sẽ chỉ mở cửa vào cuối tháng 8, khi hầu hết các CLB tại Premier League đặt mục tiêu mua sắm vào tháng 9.');
INSERT INTO `posts` VALUES (7, 'page', 1, 'Giới thiệu', 'gioi-thieu', '<p>dsfAASf edsfa</p>', 1, '2020-04-28 03:27:49', '2020-04-28 03:28:40', NULL, 'http://127.0.0.1:8000/photos/shares/thumbs/KuNf3c_simg_de2fe0_500x500_maxb.jpg', 'áDA', 'dvdsd', NULL);
INSERT INTO `posts` VALUES (8, 'page', 1, 'Hướng dẫn sử dụng', 'huong-dan-su-dung', '<p>aaaaas</p>', 1, '2020-04-28 03:32:33', '2020-04-28 03:32:33', NULL, NULL, 'á', 'sáa', 'sâ');
INSERT INTO `posts` VALUES (9, 'article', 1, 'Thành Lương - ngôi sao không hào nhoáng của tuyển Việt Nam', 'thanh-luong-ngoi-sao-khong-hao-nhoang-cua-tuyen-viet-nam', '<h1>Th&agrave;nh Lương - ng&ocirc;i sao kh&ocirc;ng h&agrave;o nho&aacute;ng của tuyển Việt Nam</h1>', 1, '2020-04-28 05:30:45', '2020-04-28 05:30:45', NULL, 'http://127.0.0.1:8000/photos/shares/thumbs/Chữa-bệnh-gout-bằng-trái-Cherry-Úc.png', NULL, NULL, 'Thành Lương - ngôi sao không hào nhoáng của tuyển Việt Nam');
INSERT INTO `posts` VALUES (10, 'article', 1, 'Ferdinand kêu gọi Pogba làm rõ tương lai', 'ferdinand-keu-goi-pogba-lam-ro-tuong-lai', '<p>Cựu danh thủ Rio Ferdinand n&oacute;i rằng đ&atilde; đến l&uacute;c Paul Pogba tự đứng ra x&aacute;c nhận về tương lai của bản th&acirc;n tại Manchester United.</p>', 1, '2020-04-28 05:32:10', '2020-04-28 05:32:10', NULL, 'http://127.0.0.1:8000/photos/shares/thumbs/KuNf3c_simg_de2fe0_500x500_maxb.jpg', NULL, NULL, 'Cựu danh thủ Rio Ferdinand nói rằng đã đến lúc Paul Pogba tự đứng ra xác nhận về tương lai của bản thân tại Manchester United.');
INSERT INTO `posts` VALUES (11, 'article', 1, 'James Milner: \'Tôi thích đá tiền vệ trung tâm, nhưng toàn bị ép đá cánh\'', 'james-milner-toi-thich-da-tien-ve-trung-tam-nhung-toan-bi-ep-da-canh', '<p>Trong cuộc phỏng vấn với chương tr&igrave;nh Friday Night Football Social của BBC, tiền vệ kỳ cựu James Milner chia sẻ với độc giả rất nhiều điều. Anh n&oacute;i về việc chứng kiến Wayne Rooney trong ng&agrave;y&hellip;</p>', 1, '2020-04-28 05:33:00', '2020-04-28 05:33:00', NULL, 'http://127.0.0.1:8000/photos/shares/thumbs/dau-goi-va-sua-tam-cho-be-paw-paw.png', NULL, NULL, 'Trong cuộc phỏng vấn với chương trình Friday Night Football Social của BBC, tiền vệ kỳ cựu James Milner chia sẻ với độc giả rất nhiều điều. Anh nói về việc chứng kiến Wayne Rooney trong ngày…');
INSERT INTO `posts` VALUES (12, 'article', 1, 'Andy Cole & chỗ xuất sắc... không thể thống kê', 'andy-cole-cho-xuat-sac-khong-the-thong-ke', '<p>V&igrave; sao &ldquo;tượng đ&agrave;i&rdquo; Andy Cole chỉ được kho&aacute;c &aacute;o Tam sư c&oacute; 15 lần v&agrave; chưa bao giờ được c&ugrave;ng ĐT Anh dự một giải lớn? Cựu HLV Glenn Hoddle c&oacute; c&acirc;u n&oacute;i bất hủ: &ldquo;Cole cần khoảng 5-6 cơ hội để ghi 1 b&agrave;n&rdquo;.</p>', 1, '2020-04-28 05:38:34', '2020-04-28 05:38:34', NULL, NULL, NULL, NULL, 'Vì sao “tượng đài” Andy Cole chỉ được khoác áo Tam sư có 15 lần và chưa bao giờ được cùng ĐT Anh dự một giải lớn? Cựu HLV Glenn Hoddle có câu nói bất hủ: “Cole cần khoảng 5-6 cơ hội để ghi 1 bàn”.');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `option` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `option_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('title', 'Laravel CMS 123', 'Title');
INSERT INTO `settings` VALUES ('logo', 'Laravel CMS', 'Logo');
INSERT INTO `settings` VALUES ('email', 'admin@gmail.com', 'Email');
INSERT INTO `settings` VALUES ('keyword', 'Laravel CMS', 'Keyword');
INSERT INTO `settings` VALUES ('description', 'Laravel CMS', 'Description');
INSERT INTO `settings` VALUES ('google-analytics', 'Laravel CMS', 'Google Analytics');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `birthday` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `question` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `answer` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_username_index`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Vinh', 'huynhtuvinh87', 'huynhtuvinh87@gmail.com', NULL, '$2y$10$ay0NYVN7BjEYzk9/MtvXHey7mOGw0N8q.tilGaeL.U.SKEH8H1pMG', NULL, NULL, NULL, '0', '2', 'Mật khẩu bạn là gì', '123321', 1, NULL, '2020-04-15 07:27:10', '2020-04-15 09:27:21');
INSERT INTO `users` VALUES (2, 'Vinh', 'huynhtuvinh', 'dcss@gmail.com', NULL, '$2y$10$9EzbO6nyHwXkyYCImBmDTuuWleq9IO3V8dhaLEaBtEBBUKOKR6UtW', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 1, NULL, '2020-04-17 05:33:49', '2020-04-20 09:16:57');
INSERT INTO `users` VALUES (3, 'ABC123', 'abc', 'abc@gmail.com', NULL, '$2y$10$dsO.aTaXTCJFT8jn1jdVb.i40T8u8YuyepSqhmO4Y9ooCsWSVtQVW', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 2, NULL, '2020-04-17 05:38:02', '2020-04-20 09:16:31');
INSERT INTO `users` VALUES (4, 'Dev', 'dev', 'dev@gmail.com', NULL, '$2y$10$jkqWkuf2FbpHa0po1ZuTJeYeGHTgMywxQ6ssdPOWLrcnYcFMh2wuy', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 1, NULL, '2020-04-17 05:39:20', '2020-04-17 05:39:20');
INSERT INTO `users` VALUES (5, 'sad', 'dsasa', 'vinh@gmail.com', NULL, '$2y$10$BrNQFumOnR/iqb.TehigE.kfH9vtPi4E.Qx/GtyPbFrSAeUpKf8ki', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 1, NULL, '2020-04-17 06:28:25', '2020-04-17 06:28:25');
INSERT INTO `users` VALUES (6, 'source', 'admin', 'vinh12@gmail.com', NULL, '$2y$10$IrzfpZ5taMWrJblfkntn5e/TRhDpJGDp43MP.vK8c6cXB2SJAof82', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 1, NULL, '2020-04-17 06:29:22', '2020-04-17 06:29:22');
INSERT INTO `users` VALUES (7, 'content', 'viettd', 'vinh121@gmail.com', NULL, '$2y$10$9F95DxrEbLlyAQzEO7FOeOvt/Gc3aFuWmY55x9QMIPfBy4DRZJ6s6', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 1, NULL, '2020-04-17 06:30:32', '2020-04-17 06:30:32');
INSERT INTO `users` VALUES (8, 'slug', 'root', 'abc12@gmail.com', NULL, '$2y$10$W349guWAFCRuXnTccQeQYe0dT1gOFlREkX09J0fYheGfesst6rxn.', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 1, NULL, '2020-04-17 06:31:44', '2020-04-17 06:31:44');
INSERT INTO `users` VALUES (9, 'Vinh', 'test', 'test@gmail.com', NULL, '$2y$10$M0lVUVCswPvhFlegrHctjeW59uTSFsr6ZcE8AWB8uTJaH9X5HM3Ly', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 1, NULL, '2020-04-17 06:32:40', '2020-04-17 06:32:40');
INSERT INTO `users` VALUES (10, 'Vinh', 'test123', 'sds@gmail.com', NULL, '$2y$10$SH.RBr45I3XsMg5bdXe.hOAVek1WAU8Df.ZOlqWfljXTR7ZxAR2CK', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 3, NULL, '2020-04-17 06:34:40', '2020-04-17 09:19:33');
INSERT INTO `users` VALUES (11, 'sxza', 'xsasasasasasa', 'saDSA@gmail.com', NULL, '$2y$10$G9BVSEk4knF/nIJgY5kVl.zquuMGicpyzhrp218RJ3NQzXP.fCLE2', '0905951699', 'Số 15, Mỹ An 19, Ngũ Hành Sơn, Đà Nẵng', NULL, '0', '1', NULL, NULL, 3, NULL, '2020-04-17 06:35:41', '2020-04-17 08:44:25');

SET FOREIGN_KEY_CHECKS = 1;
