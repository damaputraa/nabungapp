-- ================================================================
-- DATABASE DUMP FOR HOSTING / PRODUCTION DEPLOYMENT
-- Database Name: damm5992_nabung / db_keuangan
-- Generated on: 2026-09-09 14:29:55
-- ================================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+07:00';

-- --------------------------------------------------------
-- Table structure for `activity_logs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `activity_logs`
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('1', '1', 'LOGOUT_ADMIN', 'Administrator admin keluar dari sistem.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:41:14');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('2', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:41:21');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('3', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:41:58');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('4', '1', 'LOGOUT_ADMIN', 'Administrator admin keluar dari sistem.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:42:04');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('5', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:42:20');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('6', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:42:24');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('7', '1', 'LOGOUT_ADMIN', 'Administrator admin keluar dari sistem.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:45:22');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('8', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:45:45');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('9', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-06 15:51:11');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('10', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-09 13:40:11');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('11', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', '', '2026-09-09 13:45:04');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('12', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', 'Mozilla/5.0', '2026-09-09 13:58:12');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('13', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Mozilla/5.0', '2026-09-09 13:58:13');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('14', '1', 'DATABASE_BACKUP', 'Mengunduh backup database (backup_keuangan_dams_2026-09-09_135813.sql)', '::1', 'Python-urllib/3.10', '2026-09-09 13:58:13');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('15', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', 'Mozilla/5.0', '2026-09-09 13:58:30');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('16', '2', 'WALLET_ADD', 'Menambahkan dompet baru: BCA Digital Test', '::1', 'Python-urllib/3.10', '2026-09-09 13:58:30');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('17', '2', 'BILL_ADD', 'Menambahkan pengingat tagihan: Langganan Netflix Test', '::1', 'Python-urllib/3.10', '2026-09-09 13:58:31');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('18', '2', 'CHALLENGE_CREATE', 'Memulai tantangan menabung baru: Tantangan 30 Hari Test', '::1', 'Python-urllib/3.10', '2026-09-09 13:58:31');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('19', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', 'Python-urllib/3.10', '2026-09-09 13:58:54');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('20', '2', 'WALLET_DELETE', 'Menghapus dompet: BCA Digital Test', '::1', 'Python-urllib/3.10', '2026-09-09 13:58:54');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('21', '2', 'BILL_DELETE', 'Menghapus tagihan: Langganan Netflix Test', '::1', 'Python-urllib/3.10', '2026-09-09 13:58:55');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('22', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Mozilla/5.0', '2026-09-09 14:01:44');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('23', '1', 'DATABASE_BACKUP', 'Mengunduh backup database (backup_keuangan_dams_2026-09-09_140144.sql)', '::1', 'Python-urllib/3.10', '2026-09-09 14:01:44');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('24', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Python-urllib/3.10', '2026-09-09 14:02:22');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('25', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Python-urllib/3.10', '2026-09-09 14:02:27');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('26', '4', 'LOGIN_USER', 'Pengguna intan2 berhasil masuk ke portal pengguna.', '::1', 'Python-urllib/3.10', '2026-09-09 14:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('27', '1', 'LOGIN_ADMIN', 'Administrator admin masuk ke sistem panel admin.', '::1', 'Python-urllib/3.10', '2026-09-09 14:08:49');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('28', '2', 'LOGIN_USER', 'Pengguna dama berhasil masuk ke portal pengguna.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-09 14:12:11');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('29', '9', 'LOGIN_USER', 'Pengguna _test_user_e2e berhasil masuk ke portal pengguna.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) YukNabungTester/1.0', '2026-09-09 14:29:42');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('30', '9', 'REPORT_PDF', 'Mengunduh Rekening Koran PDF periode September 2026 untuk akun: _test_user_e2e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) YukNabungTester/1.0', '2026-09-09 14:29:43');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES ('31', '10', 'LOGIN_ADMIN', 'Administrator _test_admin_e2e masuk ke sistem panel admin.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) YukNabungTester/1.0', '2026-09-09 14:29:44');

-- --------------------------------------------------------
-- Table structure for `announcements`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('info','warning','success','danger') DEFAULT 'info',
  `is_active` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for `bills`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `due_day` int(11) NOT NULL DEFAULT '1',
  `status` enum('unpaid','paid') DEFAULT 'unpaid',
  `paid_at` date DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_bill_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for `category_budgets`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `category_budgets`;
CREATE TABLE `category_budgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `monthly_limit` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_user_cat` (`user_id`,`category`),
  CONSTRAINT `fk_budget_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `category_budgets`
INSERT INTO `category_budgets` (`id`, `user_id`, `category`, `monthly_limit`, `created_at`, `updated_at`) VALUES ('1', '2', 'Makanan & Minuman', '500000.00', '2026-09-06 22:06:36', '2026-09-06 22:06:36');

-- --------------------------------------------------------
-- Table structure for `savings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `savings`;
CREATE TABLE `savings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wallet_id` int(11) DEFAULT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `deposit_date` date NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `savings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table `savings`
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('12', '2', '2', NULL, '150000.00', '2026-07-04', 'minggu 1', '2026-07-06 16:37:02');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('13', '5', '6', NULL, '500000000.00', '2026-07-06', 'Mau nabung ah', '2026-07-06 17:34:19');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('14', '2', '2', NULL, '250000.00', '2026-07-13', 'minggu 2 dan 3', '2026-07-13 18:08:22');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('16', '3', '3', NULL, '100000.00', '2026-07-19', '', '2026-07-19 18:22:03');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('17', '2', '2', NULL, '5000.00', '2026-07-19', 'Dikasih embah', '2026-07-19 21:37:53');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('18', '3', '3', NULL, '100000.00', '2026-07-23', '', '2026-07-23 12:39:25');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('19', '2', '2', NULL, '100000.00', '2026-07-25', 'Setorang minggu 4 lunas 500', '2026-07-25 13:05:45');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('20', '3', '3', NULL, '300000.00', '2026-07-27', '', '2026-07-27 16:56:37');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('21', '2', '2', NULL, '107000.00', '2026-08-04', 'Minggu 1', '2026-08-04 19:57:22');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('22', '3', '3', NULL, '100000.00', '2026-08-14', '', '2026-08-14 11:41:23');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('23', '3', '3', NULL, '100000.00', '2026-08-20', '', '2026-08-20 05:05:30');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('24', '2', '2', NULL, '150000.00', '2026-08-20', 'Setoran ke 2', '2026-08-20 08:00:14');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('25', '2', '2', NULL, '250000.00', '2026-08-28', 'Last week', '2026-08-28 07:31:29');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('26', '3', '3', NULL, '300000.00', '2026-08-29', '', '2026-08-29 12:04:16');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('27', '2', '2', NULL, '150000.00', '2026-09-02', 'nabung 1', '2026-09-02 14:57:33');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('28', '3', '3', NULL, '150000.00', '2026-09-03', 'September minggu 1', '2026-09-03 11:41:22');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('29', '2', '2', NULL, '150000.00', '2026-09-03', 'Setoran ke 2', '2026-09-03 18:02:00');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('30', '8', '8', NULL, '500000.00', '2026-09-06', 'Setoran minggu pertama di bulan september', '2026-09-06 14:06:57');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('31', '3', '3', NULL, '150000.00', '2026-09-08', '', '2026-09-08 10:52:24');

-- --------------------------------------------------------
-- Table structure for `savings_challenges`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `savings_challenges`;
CREATE TABLE `savings_challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `challenge_type` enum('30_days','52_weeks') NOT NULL,
  `title` varchar(150) NOT NULL,
  `target_amount` decimal(15,2) NOT NULL,
  `current_amount` decimal(15,2) DEFAULT '0.00',
  `completed_steps` text,
  `status` enum('active','completed') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_challenge_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for `savings_goals`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `savings_goals`;
CREATE TABLE `savings_goals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `target_amount` decimal(15,2) NOT NULL,
  `current_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `deadline` date DEFAULT NULL,
  `category` varchar(100) DEFAULT 'Umum',
  `icon` varchar(50) DEFAULT 'fa-bullseye',
  `color` varchar(20) DEFAULT '#00a651',
  `notes` text,
  `status` enum('active','completed') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_goal` (`user_id`),
  CONSTRAINT `fk_goals_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for `savings_targets`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `savings_targets`;
CREATE TABLE `savings_targets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `month_year` varchar(7) NOT NULL,
  `target_amount` decimal(15,2) NOT NULL DEFAULT '500000.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_target` (`user_id`,`month_year`),
  CONSTRAINT `savings_targets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table `savings_targets`
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('1', '1', '2026-07', '500000.00', '2026-07-05 16:59:01', '2026-07-05 16:59:01');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('2', '2', '2026-07', '500000.00', '2026-07-05 17:05:17', '2026-07-05 17:05:17');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('3', '3', '2026-07', '500000.00', '2026-07-05 17:05:23', '2026-07-05 17:05:23');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('5', '5', '2026-07', '500000.00', '2026-07-06 17:29:56', '2026-07-06 17:29:56');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('6', '3', '2026-08', '500000.00', '2026-08-03 07:35:44', '2026-08-03 07:35:44');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('7', '2', '2026-08', '500000.00', '2026-08-04 19:57:08', '2026-08-04 19:57:08');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('8', '1', '2026-08', '500000.00', '2026-08-06 16:50:09', '2026-08-06 16:50:09');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('9', '5', '2026-08', '500000.00', '2026-08-06 16:50:09', '2026-08-06 16:50:09');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('11', '7', '2026-08', '500000.00', '2026-08-06 16:50:47', '2026-08-06 16:50:47');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('12', '8', '2026-08', '500000.00', '2026-08-08 13:01:11', '2026-08-08 13:01:11');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('13', '3', '2026-09', '500000.00', '2026-09-01 23:38:45', '2026-09-01 23:38:45');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('14', '2', '2026-09', '500000.00', '2026-09-02 14:56:53', '2026-09-02 14:56:53');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('15', '1', '2026-09', '500000.00', '2026-09-06 14:04:09', '2026-09-06 14:04:09');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('16', '5', '2026-09', '500000.00', '2026-09-06 14:04:09', '2026-09-06 14:04:09');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('17', '7', '2026-09', '500000.00', '2026-09-06 14:04:09', '2026-09-06 14:04:09');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('18', '8', '2026-09', '500000.00', '2026-09-06 14:04:09', '2026-09-06 14:04:09');

-- --------------------------------------------------------
-- Table structure for `transactions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wallet_id` int(11) DEFAULT NULL,
  `type` enum('income','expense') NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` text,
  `receipt_image` varchar(255) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=latin1;

-- Dumping data for table `transactions`
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('1', '1', '1', 'income', 'Gaji', '100000.00', '', NULL, '2026-07-05', '2026-07-05 15:12:50');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('2', '1', '1', 'expense', 'Makanan', '12555.00', '', NULL, '2026-07-05', '2026-07-05 18:58:34');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('3', '2', '2', 'income', 'Gaji', '2000000.00', 'Gaji Juli', NULL, '2026-07-05', '2026-07-05 23:54:30');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('5', '1', '1', 'income', 'Tagihan', '500000.00', 'Perpanjang Gojek Bulan Juli', NULL, '2026-07-05', '2026-07-06 14:45:55');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('6', '2', '2', 'income', 'Tagihan', '500000.00', 'Tagihan Adrian Bulanan sewa akun gojek Juli ', NULL, '2026-07-05', '2026-07-06 14:47:11');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('19', '2', '2', 'expense', 'Kesehatan', '40000.00', '', NULL, '2026-07-06', '2026-07-06 16:32:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('20', '5', '6', 'income', 'Investasi', '1000000000.00', '', NULL, '2026-07-06', '2026-07-06 17:30:45');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('21', '2', '2', 'income', 'Bonus', '50000.00', 'Dari pak edi', NULL, '2026-07-04', '2026-07-06 18:20:56');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('22', '2', '2', 'income', 'Gaji', '350000.00', 'S35 Bu halimah dkk', NULL, '2026-07-05', '2026-07-07 05:19:42');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('23', '2', '2', 'expense', 'Tagihan', '321000.00', 'Pijat dan makam', NULL, '2026-07-07', '2026-07-07 05:22:21');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('24', '2', '2', 'expense', 'Tagihan', '100000.00', 'Bpjs juli', NULL, '2026-07-01', '2026-07-07 05:23:28');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('25', '2', '2', 'expense', 'Hiburan', '100000.00', 'Stay', NULL, '2026-07-04', '2026-07-07 05:24:46');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('29', '3', '3', 'income', 'Lainnya', '100000.00', '', NULL, '2026-07-05', '2026-07-07 17:11:29');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('30', '3', '3', 'expense', 'Transportasi', '70000.00', 'bensin full tank', NULL, '2026-07-07', '2026-07-07 17:12:07');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('31', '3', '3', 'expense', 'Makanan', '25000.00', '', NULL, '2026-07-07', '2026-07-07 17:12:22');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('32', '2', '2', 'expense', 'Makanan', '10000.00', 'Beli ayam roket', NULL, '2026-07-07', '2026-07-07 20:02:56');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('33', '2', '2', 'expense', 'Hiburan', '25000.00', 'Rokok', NULL, '2026-07-07', '2026-07-07 22:55:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('34', '2', '2', 'income', 'Bonus', '140000.00', 'Dari bu janah ngerjakan laporan wasdal', NULL, '2026-07-08', '2026-07-08 12:52:09');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('35', '2', '2', 'expense', 'Makanan', '15000.00', 'beli burger ayam krispi', NULL, '2026-07-08', '2026-07-08 17:01:36');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('36', '2', '2', 'expense', 'Makanan', '44000.00', 'beli jajan shopee makaroni', NULL, '2026-07-07', '2026-07-08 18:09:39');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('37', '3', '3', 'expense', 'Kesehatan', '8000.00', 'obat', NULL, '2026-07-08', '2026-07-08 19:52:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('38', '2', '2', 'expense', 'Makanan', '20000.00', 'Makan naskun', NULL, '2026-07-09', '2026-07-10 05:14:52');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('39', '3', '3', 'expense', 'Makanan', '10000.00', 'es teh ', NULL, '2026-07-11', '2026-07-11 19:19:15');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('40', '3', '3', 'income', 'Lainnya', '100000.00', '', NULL, '2026-07-13', '2026-07-13 20:29:07');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('41', '3', '3', 'expense', 'Lainnya', '83000.00', 'face wash ', NULL, '2026-07-14', '2026-07-14 12:25:09');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('42', '2', '2', 'income', 'Bonus', '48500200.00', 'Aplikasi Salary', NULL, '2026-07-19', '2026-07-19 21:16:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('43', '2', '2', 'expense', 'Makanan', '10000.00', 'Beli gorengan buat cemilan', NULL, '2026-07-19', '2026-07-19 21:19:52');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('44', '2', '2', 'income', 'Lainnya', '25000.00', 'Nabung dari sangu hari senin', NULL, '2026-07-20', '2026-07-19 21:24:03');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('45', '2', '2', 'income', 'Lainnya', '25000.00', 'Sangu sekolah Riko', NULL, '2026-07-20', '2026-07-19 21:34:58');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('46', '2', '2', 'expense', 'Makanan', '15000.00', 'Beli bakso goreng', NULL, '2026-07-18', '2026-07-19 21:36:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('47', '3', '3', 'income', 'Lainnya', '150000.00', '', NULL, '2026-07-19', '2026-07-19 22:47:54');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('48', '3', '3', 'expense', 'Lainnya', '8000.00', 'fotokopi ', NULL, '2026-07-19', '2026-07-19 22:49:55');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('49', '3', '3', 'expense', 'Makanan', '59000.00', '', NULL, '2026-07-18', '2026-07-19 22:50:55');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('50', '3', '3', 'expense', 'Makanan', '60000.00', 'es pisang ijo', NULL, '2026-07-13', '2026-07-19 22:55:30');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('51', '3', '3', 'expense', 'Makanan', '15000.00', 'es teh', NULL, '2026-07-18', '2026-07-19 23:07:09');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('52', '3', '3', 'income', 'Lainnya', '200000.00', '', NULL, '2026-07-19', '2026-07-21 22:54:37');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('53', '3', '3', 'expense', 'Transportasi', '6000.00', 'bayar parkir ', NULL, '2026-07-21', '2026-07-21 22:54:58');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('54', '3', '3', 'expense', 'Lainnya', '44500.00', 'kado', NULL, '2026-07-20', '2026-07-21 22:55:57');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('55', '3', '3', 'expense', 'Belanja', '82000.00', 'tas', NULL, '2026-07-23', '2026-07-23 12:40:14');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('56', '3', '3', 'income', 'Gaji', '700000.00', 'honor dr adit, nindy, joe', NULL, '2026-07-23', '2026-07-23 17:45:58');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('57', '3', '3', 'expense', 'Transportasi', '67000.00', 'bensin full tank', NULL, '2026-07-23', '2026-07-23 17:46:47');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('58', '3', '3', 'expense', 'Lainnya', '100000.00', 'nabung sama mas', NULL, '2026-07-23', '2026-07-23 17:47:27');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('59', '3', '3', 'expense', 'Lainnya', '100000.00', 'nabung bni intan', NULL, '2026-07-23', '2026-07-23 17:47:54');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('60', '3', '3', 'expense', 'Lainnya', '300000.00', 'nabung intan', NULL, '2026-07-23', '2026-07-23 17:48:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('61', '3', '3', 'expense', 'Belanja', '66000.00', 'mainan mobil', NULL, '2026-07-22', '2026-07-23 17:49:39');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('62', '3', '3', 'expense', 'Makanan', '16000.00', 'roti ', NULL, '2026-07-23', '2026-07-23 17:50:01');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('63', '3', '3', 'expense', 'Makanan', '25000.00', 'tahu bulat', NULL, '2026-07-23', '2026-07-23 18:26:53');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('64', '3', '3', 'expense', 'Makanan', '34000.00', 'burger dan kebab', NULL, '2026-07-25', '2026-07-26 10:46:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('65', '3', '3', 'expense', 'Makanan', '48000.00', 'jajan di alfa dan pentol ', NULL, '2026-07-24', '2026-07-26 10:47:58');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('66', '3', '3', 'income', 'Lainnya', '100000.00', 'sangu', NULL, '2026-07-26', '2026-07-26 20:53:55');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('67', '3', '3', 'expense', 'Makanan', '20000.00', 'pentol ', NULL, '2026-07-26', '2026-07-26 20:54:19');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('68', '3', '3', 'expense', 'Lainnya', '4500.00', 'ngeprint ', NULL, '2026-07-26', '2026-07-26 20:54:41');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('69', '3', '3', 'expense', 'Kesehatan', '3000.00', 'neo napacin', NULL, '2026-07-27', '2026-07-27 18:48:05');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('70', '3', '3', 'expense', 'Makanan', '36000.00', 'burger', NULL, '2026-07-27', '2026-07-27 21:26:11');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('71', '3', '3', 'income', 'Gaji', '600000.00', 'honor adit nindy josh', NULL, '2026-07-29', '2026-07-29 14:07:57');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('72', '3', '3', 'expense', 'Makanan', '10000.00', 'cilok', NULL, '2026-07-28', '2026-07-29 14:08:31');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('73', '3', '3', 'expense', 'Makanan', '18000.00', 'jajan', NULL, '2026-07-28', '2026-07-29 14:09:04');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('74', '3', '3', 'expense', 'Makanan', '14000.00', 'corn dog ', NULL, '2026-07-28', '2026-07-29 14:09:33');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('75', '3', '3', 'expense', 'Makanan', '32000.00', 'mixue', NULL, '2026-07-29', '2026-07-29 14:11:11');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('76', '3', '3', 'expense', 'Gaji', '300000.00', 'nabung ukt intan', NULL, '2026-07-30', '2026-07-30 00:04:20');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('77', '3', '3', 'expense', 'Makanan', '35000.00', 'Buah', NULL, '2026-07-30', '2026-07-31 13:19:37');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('78', '3', '3', 'expense', 'Makanan', '55000.00', 'gacoan', NULL, '2026-07-31', '2026-07-31 20:24:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('79', '3', '3', 'expense', 'Makanan', '10000.00', 'kebab', NULL, '2026-07-31', '2026-07-31 20:24:24');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('80', '3', '3', 'expense', 'Lainnya', '2000.00', 'fotokopi ', NULL, '2026-07-31', '2026-07-31 20:24:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('81', '3', '3', 'income', 'Lainnya', '200000.00', 'uang saku', NULL, '2026-08-02', '2026-08-03 07:36:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('82', '3', '3', 'expense', 'Transportasi', '60000.00', 'bensin', NULL, '2026-08-02', '2026-08-03 07:36:30');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('83', '3', '3', 'expense', 'Makanan', '48000.00', 'rc', NULL, '2026-08-02', '2026-08-03 07:36:46');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('84', '3', '3', 'expense', 'Lainnya', '50000.00', 'nabung intan ', NULL, '2026-07-26', '2026-08-03 07:41:32');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('85', '3', '3', 'expense', 'Makanan', '17000.00', 'susu', NULL, '2026-08-04', '2026-08-04 19:13:00');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('86', '3', '3', 'expense', 'Makanan', '19000.00', 'kacang', NULL, '2026-08-03', '2026-08-04 19:13:16');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('87', '3', '3', 'expense', 'Makanan', '30000.00', 'Salad sayur', NULL, '2026-08-05', '2026-08-05 19:27:52');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('88', '3', '3', 'expense', 'Makanan', '9000.00', 'Susu', NULL, '2026-08-05', '2026-08-05 19:28:06');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('89', '3', '3', 'expense', 'Makanan', '8000.00', 'Pentol', NULL, '2026-08-05', '2026-08-05 19:28:19');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('90', '2', '2', 'expense', 'Makanan', '2000.00', 'makan pentol', NULL, '2026-08-06', '2026-08-06 16:47:35');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('91', '7', '7', 'income', 'Gaji', '1206000.00', 'Saldo Mandiri+Cash ', NULL, '2026-08-06', '2026-08-06 16:57:32');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('93', '7', '7', 'expense', 'Makanan', '8000.00', 'Ngopi (Cash)', NULL, '2026-08-06', '2026-08-06 18:09:06');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('94', '7', '7', 'expense', 'Makanan', '13000.00', 'Beli stok mie (Cash) ', NULL, '2026-08-06', '2026-08-06 20:11:42');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('95', '7', '7', 'expense', 'Makanan', '8000.00', 'Ngopag (Cash) ', NULL, '2026-08-07', '2026-08-07 11:10:16');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('96', '7', '7', 'expense', 'Lainnya', '100000.00', 'Pindah ke BNI (Saldo) ', NULL, '2026-08-07', '2026-08-07 11:12:05');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('97', '7', '7', 'expense', 'Hiburan', '11500.00', 'Ngopi (Cash) ', NULL, '2026-08-07', '2026-08-07 12:28:41');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('98', '7', '7', 'income', 'Lainnya', '100400.00', 'Biar balance sama di Real Life', NULL, '2026-08-07', '2026-08-07 12:34:10');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('99', '7', '7', 'expense', 'Makanan', '32000.00', 'BV (Cash)', NULL, '2026-08-07', '2026-08-07 20:31:33');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('100', '7', '7', 'expense', 'Hiburan', '5000.00', 'Sedekah (Cash)', NULL, '2026-08-07', '2026-08-07 21:12:00');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('101', '7', '7', 'expense', 'Makanan', '10000.00', 'Ngopag (Cash) ', NULL, '2026-08-08', '2026-08-08 11:21:51');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('102', '8', '8', 'income', 'Gaji', '3200000.00', 'Gaji bulan agustus', NULL, '2026-08-05', '2026-08-08 13:05:07');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('103', '8', '8', 'expense', 'Gaji', '1500000.00', 'Bayar uang hp ke om ', NULL, '2026-08-05', '2026-08-08 13:06:27');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('104', '8', '8', 'expense', 'Gaji', '350000.00', 'Ngasih mamah', NULL, '2026-08-05', '2026-08-08 13:08:26');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('105', '8', '8', 'expense', 'Gaji', '300000.00', 'Bayar hutang abang', NULL, '2026-08-05', '2026-08-08 13:09:21');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('106', '8', '8', 'expense', 'Gaji', '100000.00', 'Ngasih teman', NULL, '2026-08-08', '2026-08-08 13:10:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('107', '8', '8', 'expense', 'Gaji', '72000.00', 'Beli es ntb 6', NULL, '2026-08-05', '2026-08-08 13:11:20');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('108', '7', '7', 'expense', 'Makanan', '13000.00', 'Mentol+kopee (Cash)', NULL, '2026-08-08', '2026-08-08 19:26:17');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('109', '7', '7', 'expense', 'Transportasi', '35000.00', 'Bensin motor (Cash)', NULL, '2026-08-08', '2026-08-08 19:26:35');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('110', '7', '7', 'expense', 'Hiburan', '192500.00', 'Self rewards', NULL, '2026-08-08', '2026-08-08 22:00:03');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('111', '7', '7', 'expense', 'Makanan', '22000.00', 'Nasgor We.Co', NULL, '2026-08-08', '2026-08-08 22:36:38');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('112', '3', '3', 'income', 'Lainnya', '150000.00', 'Uang saku', NULL, '2026-08-09', '2026-08-09 12:44:43');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('114', '3', '3', 'expense', 'Makanan', '18000.00', 'Cookies', NULL, '2026-08-06', '2026-08-09 12:47:13');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('115', '7', '7', 'income', 'Bonus', '15000.00', 'Plus Kas (Cash) ', NULL, '2026-08-08', '2026-08-09 12:49:15');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('116', '7', '7', 'expense', 'Transportasi', '200000.00', 'Bensin Mobil Papah (Saldo) ', NULL, '2026-08-09', '2026-08-09 12:50:11');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('117', '7', '7', 'expense', 'Makanan', '22500.00', 'Cakwe (Saldo) ', NULL, '2026-08-09', '2026-08-09 12:50:50');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('118', '7', '7', 'expense', 'Makanan', '10000.00', 'Sempol TKL (Saldo)', NULL, '2026-08-09', '2026-08-09 12:51:43');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('119', '7', '7', 'expense', 'Makanan', '6000.00', 'Es Teh TKL (Cash)', NULL, '2026-08-09', '2026-08-09 12:52:14');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('120', '7', '7', 'expense', 'Makanan', '25000.00', 'Point Cafe (Saldo) ', NULL, '2026-08-09', '2026-08-09 12:53:47');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('121', '7', '7', 'income', 'Gaji', '200000.00', 'Dikasih Bunda biaya Transportasi (Cash) ', NULL, '2026-08-09', '2026-08-09 12:55:12');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('122', '7', '7', 'income', 'Lainnya', '100.00', 'Biar balance sama RL', NULL, '2026-08-09', '2026-08-09 14:59:41');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('123', '3', '3', 'expense', 'Makanan', '14000.00', 'susu ', NULL, '2026-08-09', '2026-08-09 21:03:43');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('124', '3', '3', 'expense', 'Lainnya', '17000.00', 'fotokopi ', NULL, '2026-08-09', '2026-08-09 21:04:00');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('125', '7', '7', 'expense', 'Makanan', '15000.00', 'Pencok (Cash) ', NULL, '2026-08-09', '2026-08-09 21:22:27');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('126', '3', '3', 'expense', 'Lainnya', '75000.00', 'semvak', NULL, '2026-08-06', '2026-08-09 22:02:26');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('127', '7', '7', 'expense', 'Makanan', '50000.00', 'Tahu tek + BV (Cash)', NULL, '2026-08-09', '2026-08-10 12:07:50');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('128', '7', '7', 'expense', 'Makanan', '14500.00', 'Amber (Saldo)', NULL, '2026-08-10', '2026-08-10 12:08:41');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('129', '3', '3', 'expense', 'Makanan', '10000.00', 'cilok', NULL, '2026-08-10', '2026-08-10 19:00:20');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('130', '7', '7', 'income', 'Bonus', '20000.00', 'Bonus kasir (Cash) ', NULL, '2026-08-10', '2026-08-10 19:26:07');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('131', '7', '7', 'expense', 'Transportasi', '60000.00', 'Cuci mobil Papah (Cash) ', NULL, '2026-08-10', '2026-08-10 19:26:26');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('132', '7', '7', 'expense', 'Makanan', '20000.00', 'Tahutek (Cash)', NULL, '2026-08-10', '2026-08-10 21:27:38');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('133', '3', '3', 'expense', 'Transportasi', '65000.00', 'Bensin full tank', NULL, '2026-08-11', '2026-08-11 16:44:02');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('134', '7', '7', 'expense', 'Makanan', '84998.00', 'Richis Factory (Saldo)', NULL, '2026-08-11', '2026-08-11 19:53:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('135', '7', '7', 'expense', 'Makanan', '8000.00', 'Ngopi (Cash)', NULL, '2026-08-11', '2026-08-11 19:53:29');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('136', '7', '7', 'expense', 'Makanan', '10000.00', 'Pentol (Cash)', NULL, '2026-08-11', '2026-08-11 19:53:48');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('137', '7', '7', 'expense', 'Makanan', '3000.00', 'Snack Better (Cash) ', NULL, '2026-08-11', '2026-08-12 01:42:59');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('138', '7', '7', 'expense', 'Makanan', '35000.00', 'Bakso (30 Saldo+ 5 Cash)', NULL, '2026-08-12', '2026-08-12 02:25:05');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('139', '7', '7', 'income', 'Bonus', '6000.00', 'Cash', NULL, '2026-08-12', '2026-08-12 19:46:16');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('140', '7', '7', 'expense', 'Makanan', '8000.00', 'Air putih (Cash) ', NULL, '2026-08-12', '2026-08-12 19:51:44');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('141', '7', '7', 'expense', 'Transportasi', '30000.00', 'Bensin motor (Saldo) ', NULL, '2026-08-12', '2026-08-12 19:52:35');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('142', '7', '7', 'expense', 'Makanan', '8000.00', 'Kopi (Cash) ', NULL, '2026-08-12', '2026-08-12 19:53:14');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('143', '7', '7', 'income', 'Lainnya', '150000.00', 'Narik saldo (+Cash) ', NULL, '2026-08-12', '2026-08-12 19:53:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('144', '7', '7', 'income', 'Bonus', '20000.00', 'Plus kasir (Cash) ', NULL, '2026-08-13', '2026-08-13 14:18:39');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('145', '7', '7', 'expense', 'Makanan', '16000.00', 'Nyetok mie (Cash) ', NULL, '2026-08-12', '2026-08-13 14:19:51');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('146', '7', '7', 'expense', 'Makanan', '7000.00', 'Air mineral (Cash) ', NULL, '2026-08-13', '2026-08-13 23:48:41');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('147', '7', '7', 'expense', 'Makanan', '22000.00', 'Biar balance sama RL', NULL, '2026-08-14', '2026-08-14 00:03:04');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('148', '7', '7', 'income', 'Bonus', '35000.00', 'Cash', NULL, '2026-08-13', '2026-08-14 02:48:00');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('149', '3', '3', 'expense', 'Makanan', '20000.00', 'pempek', NULL, '2026-08-13', '2026-08-14 11:33:48');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('150', '3', '3', 'expense', 'Makanan', '20000.00', 'susu', NULL, '2026-08-13', '2026-08-14 11:34:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('151', '3', '3', 'expense', 'Makanan', '32000.00', 'makan', NULL, '2026-08-11', '2026-08-14 11:36:25');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('152', '3', '3', 'expense', 'Lainnya', '10000.00', 'cetak foto', NULL, '2026-08-12', '2026-08-14 11:36:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('153', '3', '3', 'income', 'Gaji', '500000.00', 'honor adit nindy', NULL, '2026-08-14', '2026-08-14 11:37:17');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('154', '7', '7', 'income', 'Bonus', '4000.00', 'Cash', NULL, '2026-08-14', '2026-08-15 16:22:24');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('155', '7', '7', 'expense', 'Transportasi', '5000.00', 'Parkir (Cash) ', NULL, '2026-08-14', '2026-08-15 16:22:59');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('156', '7', '7', 'expense', 'Lainnya', '10000.00', 'Infaq (Cash) ', NULL, '2026-08-15', '2026-08-15 16:23:20');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('157', '7', '7', 'expense', 'Makanan', '15000.00', 'Es teh (Cash) ', NULL, '2026-08-14', '2026-08-15 16:23:44');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('158', '7', '7', 'expense', 'Makanan', '1000.00', 'Permen (Cash) ', NULL, '2026-08-14', '2026-08-15 16:24:25');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('159', '7', '7', 'expense', 'Lainnya', '80000.00', 'Cat tembok (Cash) ', NULL, '2026-08-14', '2026-08-15 16:24:51');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('160', '7', '7', 'expense', 'Lainnya', '35000.00', 'Makam (Cash) ', NULL, '2026-08-14', '2026-08-15 16:25:22');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('161', '7', '7', 'expense', 'Makanan', '9000.00', 'Jajan (Cash) ', NULL, '2026-08-14', '2026-08-15 16:25:52');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('162', '7', '7', 'income', 'Gaji', '50000.00', 'Upah ganti ronda (Cash) ', NULL, '2026-08-14', '2026-08-15 16:26:29');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('163', '7', '7', 'expense', 'Makanan', '20000.00', 'Bakso (Cash) ', NULL, '2026-08-15', '2026-08-15 16:27:07');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('164', '3', '3', 'expense', 'Makanan', '33000.00', 'rc', NULL, '2026-08-15', '2026-08-15 20:31:15');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('165', '3', '3', 'expense', 'Lainnya', '100000.00', 'cek in ', NULL, '2026-08-15', '2026-08-15 20:31:36');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('166', '3', '3', 'expense', 'Makanan', '34000.00', 'Bakaran ', NULL, '2026-08-15', '2026-08-15 20:31:55');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('167', '3', '3', 'expense', 'Lainnya', '75000.00', 'tisu, lip balm, obat', NULL, '2026-08-14', '2026-08-15 20:32:34');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('168', '3', '3', 'expense', 'Lainnya', '200000.00', 'nabung BNI', NULL, '2026-08-15', '2026-08-15 20:32:57');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('169', '3', '3', 'expense', 'Makanan', '7000.00', 'air minum', NULL, '2026-08-15', '2026-08-15 20:38:25');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('170', '7', '7', 'expense', 'Makanan', '52000.00', 'OHANA Cafe (Cash)', NULL, '2026-08-15', '2026-08-16 10:10:26');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('171', '7', '7', 'expense', 'Kesehatan', '316400.00', 'Lensa kacamata ', NULL, '2026-08-16', '2026-08-16 20:27:31');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('172', '3', '3', 'income', 'Lainnya', '200000.00', 'Uang saku ', NULL, '2026-08-16', '2026-08-16 21:13:13');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('173', '3', '3', 'expense', 'Makanan', '6000.00', 'Air minum', NULL, '2026-08-16', '2026-08-16 21:13:30');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('174', '3', '3', 'expense', 'Makanan', '65000.00', 'Snacks', NULL, '2026-08-16', '2026-08-16 21:13:51');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('175', '3', '3', 'expense', 'Makanan', '29000.00', 'Snacks titipan', NULL, '2026-08-16', '2026-08-16 21:14:06');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('176', '7', '7', 'expense', 'Makanan', '25000.00', 'Nasreng (Cash) ', NULL, '2026-08-16', '2026-08-17 15:25:05');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('177', '3', '3', 'expense', 'Belanja', '40000.00', 'yogurt dan pewangi ', NULL, '2026-08-17', '2026-08-17 17:34:31');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('178', '3', '3', 'expense', 'Belanja', '42000.00', 'blush dan toner', NULL, '2026-08-17', '2026-08-17 17:35:00');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('179', '7', '7', 'income', 'Bonus', '18100.00', '(Cash) ', NULL, '2026-08-18', '2026-08-18 02:57:46');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('180', '3', '3', 'expense', 'Transportasi', '60000.00', 'bensin ', NULL, '2026-08-18', '2026-08-18 08:58:20');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('181', '7', '7', 'expense', 'Makanan', '36000.00', 'Makan BV (Cash) ', NULL, '2026-08-18', '2026-08-18 20:48:47');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('182', '7', '7', 'expense', 'Lainnya', '15000.00', 'Jahit tas (Cash) ', NULL, '2026-08-18', '2026-08-18 20:49:06');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('183', '7', '7', 'expense', 'Kesehatan', '25000.00', 'Sangobion (Saldo) ', NULL, '2026-08-18', '2026-08-19 01:36:11');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('184', '7', '7', 'expense', 'Makanan', '8000.00', 'Kopi (Cash) ', NULL, '2026-08-18', '2026-08-19 01:36:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('185', '7', '7', 'income', 'Bonus', '45000.00', 'Bonus Gawe (Cash) ', NULL, '2026-08-19', '2026-08-19 01:41:13');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('186', '7', '7', 'expense', 'Makanan', '9000.00', 'Mie (Cash) ', NULL, '2026-08-19', '2026-08-19 22:40:42');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('187', '7', '7', 'expense', 'Makanan', '8000.00', 'Kopi (Cash) ', NULL, '2026-08-19', '2026-08-19 22:41:00');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('188', '7', '7', 'expense', 'Makanan', '5000.00', 'Es krim (Cash) ', NULL, '2026-08-19', '2026-08-19 22:41:13');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('189', '3', '3', 'income', 'Gaji', '300000.00', 'honor adit Nindy ', NULL, '2026-08-19', '2026-08-20 06:07:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('190', '3', '3', 'expense', 'Makanan', '22000.00', 'sarapan soto ', NULL, '2026-08-19', '2026-08-20 06:08:12');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('191', '7', '7', 'income', 'Bonus', '86000.00', 'Bonus (Cash) ', NULL, '2026-08-20', '2026-08-20 22:05:41');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('192', '7', '7', 'expense', 'Makanan', '25000.00', 'Bakso (Cash) ', NULL, '2026-08-20', '2026-08-20 22:05:54');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('193', '7', '7', 'expense', 'Makanan', '8000.00', 'Kopi (Cash) ', NULL, '2026-08-20', '2026-08-20 22:06:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('194', '7', '7', 'expense', 'Hiburan', '5000.00', 'Jajan (Cash) ', NULL, '2026-08-20', '2026-08-20 22:07:10');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('195', '7', '7', 'income', 'Bonus', '120000.00', '(Cash) ', NULL, '2026-08-21', '2026-08-21 02:14:29');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('196', '7', '7', 'income', 'Lainnya', '65000.00', 'Narik dari BNI (Cash) ', NULL, '2026-08-21', '2026-08-21 02:14:45');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('197', '7', '7', 'income', 'Lainnya', '10000.00', 'Test', NULL, '2026-08-21', '2026-08-21 02:18:43');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('198', '7', '7', 'expense', 'Makanan', '20000.00', 'Ganje (Cash)', NULL, '2026-08-21', '2026-08-21 11:46:51');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('199', '7', '7', 'expense', 'Makanan', '8000.00', 'Kopi (Cash)', NULL, '2026-08-21', '2026-08-21 11:47:06');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('200', '7', '7', 'income', 'Bonus', '40000.00', '(Cash)', NULL, '2026-08-21', '2026-08-21 18:21:57');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('201', '3', '3', 'expense', 'Transportasi', '55000.00', 'bensin', NULL, '2026-08-21', '2026-08-21 19:34:36');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('202', '3', '3', 'expense', 'Makanan', '10000.00', 'gorengan', NULL, '2026-08-20', '2026-08-21 19:38:59');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('203', '3', '3', 'expense', 'Makanan', '100000.00', 'donat', NULL, '2026-08-19', '2026-08-21 19:39:16');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('204', '3', '3', 'expense', 'Kesehatan', '52000.00', 'masker', NULL, '2026-08-20', '2026-08-21 19:40:00');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('205', '7', '7', 'income', 'Bonus', '8000.00', 'Balance', NULL, '2026-08-22', '2026-08-22 18:42:57');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('206', '3', '3', 'expense', 'Belanja', '96000.00', 'kemeja', NULL, '2026-08-22', '2026-08-23 11:15:55');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('207', '3', '3', 'income', 'Lainnya', '400000.00', '', NULL, '2026-08-23', '2026-08-23 11:24:47');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('208', '3', '3', 'expense', 'Makanan', '49000.00', 'jajan di Indomaret ', NULL, '2026-08-23', '2026-08-23 17:20:57');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('209', '7', '7', 'expense', 'Makanan', '50000.00', 'Ngopi (Cash)', NULL, '2026-08-22', '2026-08-23 19:49:46');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('210', '7', '7', 'income', 'Bonus', '59000.00', 'Bonus (Cash)', NULL, '2026-08-23', '2026-08-23 19:53:29');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('211', '3', '3', 'expense', 'Transportasi', '23000.00', 'bensin skupi', NULL, '2026-08-23', '2026-08-24 05:39:38');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('212', '3', '3', 'expense', 'Makanan', '30000.00', 'tahu crispy ', NULL, '2026-08-23', '2026-08-24 05:40:04');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('213', '3', '3', 'expense', 'Makanan', '25000.00', 'nasi Padang ', NULL, '2026-08-23', '2026-08-24 05:40:53');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('214', '3', '3', 'expense', 'Makanan', '58000.00', 'burger\r\n', NULL, '2026-08-26', '2026-08-28 06:39:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('215', '3', '3', 'expense', 'Kesehatan', '56000.00', 'vitamin', NULL, '2026-08-26', '2026-08-28 06:39:35');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('216', '3', '3', 'expense', 'Makanan', '23000.00', 'jajan', NULL, '2026-08-27', '2026-08-28 06:40:02');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('217', '3', '3', 'expense', 'Makanan', '26000.00', 'makan siang', NULL, '2026-08-26', '2026-08-28 06:40:32');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('218', '3', '3', 'expense', 'Makanan', '25000.00', 'pangsit', NULL, '2026-08-27', '2026-08-28 06:41:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('219', '3', '3', 'expense', 'Makanan', '25000.00', 'buah', NULL, '2026-08-25', '2026-08-28 06:43:32');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('220', '3', '3', 'expense', 'Makanan', '25000.00', 'kopi\r\n', NULL, '2026-08-25', '2026-08-28 06:44:11');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('221', '3', '3', 'expense', 'Makanan', '10000.00', 'milo', NULL, '2026-08-25', '2026-08-28 06:44:39');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('222', '3', '3', 'income', 'Lainnya', '100000.00', '', NULL, '2026-08-26', '2026-08-28 06:45:09');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('223', '3', '3', 'expense', 'Makanan', '12000.00', 'gorengan', NULL, '2026-08-25', '2026-08-28 06:47:15');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('224', '3', '3', 'expense', 'Lainnya', '29000.00', 'minyak zaitun', NULL, '2026-08-25', '2026-08-28 06:47:40');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('225', '3', '3', 'expense', 'Belanja', '15000.00', 'tisu', NULL, '2026-08-24', '2026-08-28 06:50:01');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('226', '3', '3', 'expense', 'Makanan', '50000.00', 'jajan', NULL, '2026-08-24', '2026-08-28 06:50:47');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('227', '3', '3', 'expense', 'Lainnya', '8000.00', 'korek kuping', NULL, '2026-08-24', '2026-08-28 06:51:20');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('228', '3', '3', 'income', 'Gaji', '625000.00', 'honor yogi dan joe', NULL, '2026-08-29', '2026-08-29 12:04:43');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('229', '3', '3', 'expense', 'Lainnya', '300000.00', 'nabung sama mas', NULL, '2026-08-29', '2026-08-29 12:05:04');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('230', '3', '3', 'expense', 'Transportasi', '60000.00', 'bensin ', NULL, '2026-08-30', '2026-08-30 15:47:45');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('231', '3', '3', 'expense', 'Makanan', '20000.00', 'rujak ', NULL, '2026-08-30', '2026-08-30 15:48:05');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('232', '3', '3', 'expense', 'Transportasi', '2000.00', 'parkir', NULL, '2026-08-30', '2026-08-30 20:20:32');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('233', '3', '3', 'income', 'Lainnya', '200000.00', 'uang Mingguan', NULL, '2026-08-30', '2026-08-30 20:20:53');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('234', '3', '3', 'expense', 'Belanja', '141000.00', 'kado wedding mbak nisa', NULL, '2026-08-30', '2026-08-30 20:21:15');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('235', '3', '3', 'expense', 'Makanan', '10000.00', 'roti', NULL, '2026-09-01', '2026-09-01 23:39:16');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('236', '3', '3', 'expense', 'Lainnya', '22000.00', 'baterai', NULL, '2026-08-31', '2026-09-01 23:39:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('237', '3', '3', 'expense', 'Makanan', '26000.00', 'makan malam', NULL, '2026-09-01', '2026-09-01 23:40:09');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('238', '3', '3', 'expense', 'Makanan', '22000.00', 'snack', NULL, '2026-09-01', '2026-09-01 23:40:29');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('239', '3', '3', 'expense', 'Makanan', '50000.00', 'makan malam ', NULL, '2026-08-28', '2026-09-01 23:44:27');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('240', '3', '3', 'expense', 'Makanan', '20000.00', 'buah', NULL, '2026-08-28', '2026-09-01 23:45:04');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('241', '3', '3', 'expense', 'Tagihan', '10000.00', 'pulsa', NULL, '2026-09-01', '2026-09-01 23:53:37');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('243', '3', '3', 'expense', 'Makanan', '15000.00', 'molen', NULL, '2026-09-02', '2026-09-03 08:47:53');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('244', '3', '3', 'expense', 'Belanja', '30000.00', 'softex', NULL, '2026-09-02', '2026-09-03 08:48:25');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('245', '3', '3', 'income', 'Gaji', '300000.00', 'honor josh', NULL, '2026-09-03', '2026-09-03 08:57:11');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('246', '3', '3', 'expense', 'Lainnya', '150000.00', 'nabung September Minggu 1', NULL, '2026-09-03', '2026-09-03 11:41:49');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('247', '3', '3', 'expense', 'Makanan', '10000.00', 'jamu', NULL, '2026-09-03', '2026-09-04 10:49:10');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('248', '3', '3', 'expense', 'Lainnya', '39000.00', 'kacamata ', NULL, '2026-09-04', '2026-09-04 10:52:30');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('249', '8', '8', 'income', 'Lainnya', '500000.00', '', NULL, '2026-09-06', '2026-09-06 14:13:10');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('250', '3', '3', 'expense', 'Lainnya', '50000.00', 'nabung intan\r\n', NULL, '2026-09-06', '2026-09-06 14:25:59');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('251', '3', '3', 'expense', 'Transportasi', '20000.00', 'bensin scoopy', NULL, '2026-09-06', '2026-09-06 14:26:19');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('252', '3', '3', 'expense', 'Makanan', '12000.00', 'gado-gado', NULL, '2026-09-06', '2026-09-06 14:26:42');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('253', '3', '3', 'income', 'Lainnya', '200000.00', 'uang saku mingguan', NULL, '2026-09-07', '2026-09-07 10:36:58');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('254', '3', '3', 'income', 'Gaji', '300000.00', 'honor adit', NULL, '2026-09-08', '2026-09-08 10:52:08');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('255', '3', '3', 'expense', 'Lainnya', '150000.00', 'nabung blugether', NULL, '2026-09-08', '2026-09-08 10:53:23');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('256', '3', '3', 'expense', 'Makanan', '27000.00', 'mango sticky rice', NULL, '2026-09-08', '2026-09-08 15:56:31');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('257', '3', '3', 'expense', 'Transportasi', '60000.00', 'bensin', NULL, '2026-09-08', '2026-09-08 15:56:48');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('258', '3', '3', 'expense', 'Transportasi', '2000.00', 'parkir', NULL, '2026-09-08', '2026-09-08 22:53:57');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('259', '3', '3', 'expense', 'Belanja', '65000.00', 'buku cerita', NULL, '2026-09-08', '2026-09-08 22:55:06');

-- --------------------------------------------------------
-- Table structure for `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `status` enum('active','suspended') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('1', 'admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'admin', 'active', '2026-07-05 14:35:33', '2026-07-05 14:35:33');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('2', 'dama', 'dama.rahmad21@gmail.com', '$2y$10$HIFqI3nZceee.TmkCGuGte2fnDvaU5MPCbj0oKf6EeTGJwFlYKi6G', NULL, 'user', 'active', '2026-07-05 17:04:13', '2026-07-05 17:04:13');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('3', 'intan', 'intan@gmail.com', '$2y$10$FfOE1GmihTWDdjJ7uSRHx.XHlkxsYjq1u4HZ3Tpo2YPxWgJsj7H0K', NULL, 'user', 'active', '2026-07-05 17:04:40', '2026-07-05 17:04:40');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('5', 'sauvij', 'sv.tiktok@gmail.com', '$2y$12$WIlMTUmRjFyGmf9o2NS8/OILSWrD8y6C9FDkfLvkb1Z2YooDs2mAC', NULL, 'user', 'active', '2026-07-06 17:29:38', '2026-07-06 17:29:38');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('7', 'Mas D', 'mnramadhani22@gmail.com', '$2y$12$Nl6RSaMtl9a2Jt5G48yi5OgMS7VERSrnEwU8ESjAkrhBSs8sC9Mge', NULL, 'user', 'active', '2026-08-06 16:50:37', '2026-08-06 16:50:37');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('8', 'Dandisatria', 'arapgragazz17@gmail.com', '$2y$12$sSTDP/CAANciArSt7Ik1iu7L1fC.H1bWhQHWZK3NT6i9SK4/.ex7q', NULL, 'user', 'active', '2026-08-08 13:01:04', '2026-09-06 14:05:02');

-- --------------------------------------------------------
-- Table structure for `wallets`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `wallets`;
CREATE TABLE `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('bank','ewallet','cash') DEFAULT 'bank',
  `account_number` varchar(50) DEFAULT NULL,
  `balance` decimal(15,2) DEFAULT '0.00',
  `color` varchar(20) DEFAULT '#2563eb',
  `icon` varchar(50) DEFAULT 'fa-wallet',
  `is_default` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_wallet_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table `wallets`
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('1', '1', 'Dompet Utama (Tunai)', 'cash', '-', '587445.00', '#00a651', 'fa-money-bill-wave', '1', '2026-09-09 20:49:25');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('2', '2', 'Dompet Utama (Tunai)', 'cash', '-', '50888200.00', '#00a651', 'fa-money-bill-wave', '1', '2026-09-09 20:49:25');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('3', '3', 'Dompet Utama (Tunai)', 'cash', '-', '309000.00', '#00a651', 'fa-money-bill-wave', '1', '2026-09-09 20:49:25');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('6', '5', 'Dompet Utama (Tunai)', 'cash', '-', '1000000000.00', '#2563eb', 'fa-wallet', '1', '2026-09-09 21:01:38');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('7', '7', 'Dompet Utama (Tunai)', 'cash', '-', '362202.00', '#2563eb', 'fa-wallet', '1', '2026-09-09 21:01:38');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('8', '8', 'Dompet Utama (Tunai)', 'cash', '-', '1378000.00', '#2563eb', 'fa-wallet', '1', '2026-09-09 21:01:38');

SET FOREIGN_KEY_CHECKS=1;
