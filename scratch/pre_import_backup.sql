-- PRE-IMPORT BACKUP 2026-09-09 14:01:23

-- Table: users (4 rows)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('1', 'admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'admin', 'active', '2026-07-05 14:35:33', '2026-07-05 14:35:33');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('2', 'dama', 'dama.rahmad21@gmail.com', '$2y$10$rJn0c6jglwbWRIl39/G8Yu8Iuc3H9uWWFDHV8ucUTMrCZgRv6H.e.', NULL, 'user', 'active', '2026-07-05 17:04:13', '2026-09-06 22:01:32');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('3', 'intan', 'intan@gmail.com', '$2y$10$rJn0c6jglwbWRIl39/G8Yu8Iuc3H9uWWFDHV8ucUTMrCZgRv6H.e.', NULL, 'user', 'active', '2026-07-05 17:04:40', '2026-09-06 22:01:32');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES ('4', 'intan2', 'intan2@gmail.com', '$2y$10$rJn0c6jglwbWRIl39/G8Yu8Iuc3H9uWWFDHV8ucUTMrCZgRv6H.e.', NULL, 'user', 'active', '2026-07-06 12:15:49', '2026-09-06 22:01:32');

-- Table: savings (3 rows)
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('1', '1', NULL, NULL, '150000.00', '2026-07-05', 'minggu 1', '2026-07-05 20:47:40');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('2', '2', NULL, NULL, '100000.00', '2026-07-05', 'minggu 1', '2026-07-05 23:47:05');
INSERT INTO `savings` (`id`, `user_id`, `wallet_id`, `goal_id`, `amount`, `deposit_date`, `description`, `created_at`) VALUES ('3', '3', NULL, NULL, '150000.00', '2026-07-05', 'minggu 1', '2026-07-06 00:05:49');

-- Table: savings_targets (7 rows)
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('1', '1', '2026-07', '500000.00', '2026-07-05 16:59:01', '2026-07-05 16:59:01');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('2', '2', '2026-07', '500000.00', '2026-07-05 17:05:17', '2026-07-05 17:05:17');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('3', '3', '2026-07', '500000.00', '2026-07-05 17:05:23', '2026-07-05 17:05:23');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('4', '1', '2026-09', '500000.00', '2026-09-06 21:43:24', '2026-09-06 21:43:24');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('5', '2', '2026-09', '500000.00', '2026-09-06 21:49:49', '2026-09-06 21:49:49');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('6', '3', '2026-09', '500000.00', '2026-09-06 21:49:49', '2026-09-06 21:49:49');
INSERT INTO `savings_targets` (`id`, `user_id`, `month_year`, `target_amount`, `created_at`, `updated_at`) VALUES ('7', '4', '2026-09', '500000.00', '2026-09-06 21:49:49', '2026-09-06 21:49:49');

-- Table: transactions (3 rows)
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('1', '1', NULL, 'income', 'Gaji', '100000.00', '', NULL, '2026-07-05', '2026-07-05 15:12:50');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('2', '1', NULL, 'expense', 'Makanan', '12555.00', '', NULL, '2026-07-05', '2026-07-05 18:58:34');
INSERT INTO `transactions` (`id`, `user_id`, `wallet_id`, `type`, `category`, `amount`, `description`, `receipt_image`, `transaction_date`, `created_at`) VALUES ('3', '2', NULL, 'income', 'Gaji', '2000000.00', 'Gaji Juli', NULL, '2026-07-05', '2026-07-05 23:54:30');

-- Table: wallets (4 rows)
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('1', '1', 'Dompet Utama (Tunai)', 'cash', '-', '0.00', '#00a651', 'fa-money-bill-wave', '1', '2026-09-09 20:49:25');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('2', '2', 'Dompet Utama (Tunai)', 'cash', '-', '0.00', '#00a651', 'fa-money-bill-wave', '1', '2026-09-09 20:49:25');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('3', '3', 'Dompet Utama (Tunai)', 'cash', '-', '0.00', '#00a651', 'fa-money-bill-wave', '1', '2026-09-09 20:49:25');
INSERT INTO `wallets` (`id`, `user_id`, `name`, `type`, `account_number`, `balance`, `color`, `icon`, `is_default`, `created_at`) VALUES ('4', '4', 'Dompet Utama (Tunai)', 'cash', '-', '0.00', '#00a651', 'fa-money-bill-wave', '1', '2026-09-09 20:49:25');

-- Table: bills (0 rows)

-- Table: savings_challenges (0 rows)

-- Skipped budget_limits: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'db_keuangan.budget_limits' doesn't exist

-- Table: savings_goals (0 rows)

-- Table: activity_logs (21 rows)
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

-- Table: announcements (0 rows)

