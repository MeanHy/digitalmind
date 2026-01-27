-- Support Board Database Tables
-- Run this script in phpMyAdmin or MySQL CLI to create the tables

SET NAMES utf8mb4;

-- Table: sb_settings
CREATE TABLE IF NOT EXISTS `sb_settings` (
  `name` varchar(255) NOT NULL,
  `value` longtext,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: sb_users
CREATE TABLE IF NOT EXISTS `sb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_image` text,
  `user_type` varchar(10) DEFAULT 'user',
  `creation_time` datetime DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `typing` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_type` (`user_type`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: sb_users_data
CREATE TABLE IF NOT EXISTS `sb_users_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_slug` (`user_id`, `slug`),
  KEY `user_id` (`user_id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: sb_conversations
CREATE TABLE IF NOT EXISTS `sb_conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `status_code` tinyint(1) DEFAULT 0,
  `department` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `source` varchar(2) DEFAULT NULL,
  `extra` text,
  `extra_2` text,
  `tags` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status_code` (`status_code`),
  KEY `department` (`department`),
  KEY `agent_id` (`agent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: sb_messages
CREATE TABLE IF NOT EXISTS `sb_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text,
  `creation_time` datetime DEFAULT NULL,
  `status_code` tinyint(1) DEFAULT 0,
  `attachments` text,
  `payload` longtext,
  `conversation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `creation_time` (`creation_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: sb_reports
CREATE TABLE IF NOT EXISTS `sb_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `creation_time` date DEFAULT NULL,
  `external_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `creation_time` (`creation_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: sb_articles
CREATE TABLE IF NOT EXISTS `sb_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `link` varchar(255) DEFAULT NULL,
  `extra` text,
  `status` tinyint(1) DEFAULT 1,
  `parent_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: sb_articles_categories  
CREATE TABLE IF NOT EXISTS `sb_articles_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT IGNORE INTO `sb_settings` (`name`, `value`) VALUES ('version', '3.8.2');

-- Create admin user (password: admin123 - change this!)
-- Password hash for 'admin123': $2y$10$example...
-- You may need to update this with your own password hash

SELECT 'Support Board tables created successfully!' AS message;
