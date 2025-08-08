-- Additional tables for Alumpro.Az Management System
-- Run this after the main database.sql

-- Table for saved calculations
CREATE TABLE IF NOT EXISTS `saved_calculations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `calculation_data` json NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `created_at` (`created_at`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for contact messages (if not using external service)
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `contact_methods` json DEFAULT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('new','read','replied','closed') NOT NULL DEFAULT 'new',
  `replied_by` int(11) DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `replied_by` (`replied_by`),
  FOREIGN KEY (`replied_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for system logs
CREATE TABLE IF NOT EXISTS `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` enum('debug','info','warning','error','critical') NOT NULL DEFAULT 'info',
  `message` text NOT NULL,
  `context` json DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `created_at` (`created_at`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for file uploads
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `file_size` bigint(20) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT 'general',
  `uploaded_by` int(11) DEFAULT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uploaded_by` (`uploaded_by`),
  KEY `entity_type` (`entity_type`, `entity_id`),
  KEY `category` (`category`),
  FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for order status history
CREATE TABLE IF NOT EXISTS `order_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `changed_by` (`changed_by`),
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for customer addresses
CREATE TABLE IF NOT EXISTS `customer_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `type` enum('billing','shipping','both') NOT NULL DEFAULT 'both',
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(2) NOT NULL DEFAULT 'AZ',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add some indexes for better performance
ALTER TABLE `orders` ADD INDEX `idx_orders_date_status` (`created_at`, `status`);
ALTER TABLE `activity_log` ADD INDEX `idx_activity_user_date` (`user_id`, `created_at`);
ALTER TABLE `whatsapp_messages` ADD INDEX `idx_whatsapp_phone_date` (`phone`, `timestamp`);

-- Add some sample data for demo
INSERT INTO `whatsapp_auto_replies` (`keyword`, `reply_message`, `priority`) VALUES
('mərhəba', 'Mərhəba! Alumpro.Az-a xoş gəlmisiniz. Sizə necə kömək edə bilərik?', 1),
('qiymet', 'Qiymət məlumatı üçün məhsul növünü və ölçüləri göndərin. Kalkulyatorumuzdan da istifadə edə bilərsiniz: alumpro.az/calculator', 2),
('sifaris', 'Sifariş vermək üçün saytımızdan istifadə edin və ya +994 XX XXX XX XX nömrəsinə zəng edin.', 3),
('help', 'Kömək üçün:\n📞 Telefon: +994 XX XXX XX XX\n📧 Email: info@alumpro.az\n🌐 Sayt: alumpro.az', 4),
('tesekkur', 'Rica edirik! Başqa sualınız varsa, buradayıq. 😊', 5);

-- Add sample gallery items
INSERT INTO `gallery` (`title`, `description`, `image`, `category`, `sort_order`) VALUES
('Villa Layihəsi - Nərimanov', '250m² villa üçün alüminium pəncərə sistemi', 'residential-1.jpg', 'residential', 1),
('Ofis Binası - Mərkəz', '5 mərtəbəli ofis binası üçün fasad sistemi', 'commercial-1.jpg', 'commercial', 2),
('Yaşayış Kompleksi - Yasamal', '120 mənzilli kompleks üçün pəncərə sistemləri', 'residential-2.jpg', 'residential', 3),
('Sənaye Obyekti - Səngəçal', 'Böyük sənaye obyekti üçün xüsusi həllər', 'industrial-1.jpg', 'industrial', 4),
('Fasad Sistemi - Port Baku', 'Müasir fasad həlləri', 'facade-1.jpg', 'facade', 5),
('Ticarət Mərkəzi - 28 May', 'Böyük ticarət mərkəzi layihəsi', 'commercial-2.jpg', 'commercial', 6);

-- Update products table with some sample data
INSERT INTO `categories` (`name`, `description`, `parent_id`) VALUES
('Pəncərə Profillər', 'Pəncərə üçün alüminium profillər', 1),
('Qapı Profillər', 'Qapı üçün alüminium profillər', 1),
('İkili Şüşə', 'Enerji səmərəli ikili şüşə sistemləri', 2),
('Üçlü Şüşə', 'Maksimum izolyasiya üçün üçlü şüşə', 2),
('Dəstəklər', 'Müxtəlif növ qapı və pəncərə dəstəkləri', 3),
('Kilidlər', 'Təhlükəsizlik kilidləri', 3);