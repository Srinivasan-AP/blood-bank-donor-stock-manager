CREATE DATABASE IF NOT EXISTS blood_bank_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE blood_bank_db;

CREATE TABLE IF NOT EXISTS donors (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  blood_group ENUM('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  phone VARCHAR(20) NOT NULL,
  city VARCHAR(80) NOT NULL,
  last_donation_date DATE NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_donors_group (blood_group),
  INDEX idx_donors_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blood_stock (
  blood_group ENUM('A+','A-','B+','B-','AB+','AB-','O+','O-') PRIMARY KEY,
  units INT UNSIGNED NOT NULL DEFAULT 0,
  low_stock_threshold INT UNSIGNED NOT NULL DEFAULT 5,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS blood_requests (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  requester_name VARCHAR(100) NOT NULL,
  blood_group ENUM('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  units SMALLINT UNSIGNED NOT NULL,
  contact_phone VARCHAR(20) NOT NULL,
  organization VARCHAR(140) NOT NULL,
  status ENUM('Pending','Approved','Fulfilled') NOT NULL DEFAULT 'Pending',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_requests_status (status),
  INDEX idx_requests_group (blood_group)
) ENGINE=InnoDB;

INSERT INTO blood_stock (blood_group, units, low_stock_threshold) VALUES
('A+',18,5),('A-',7,5),('B+',14,5),('B-',4,5),('AB+',9,5),('AB-',3,5),('O+',22,5),('O-',6,5)
ON DUPLICATE KEY UPDATE blood_group=VALUES(blood_group);

INSERT INTO donors (name,blood_group,phone,city,last_donation_date) VALUES
('Demo Donor One','A+','000-000-0101','Chennai','2025-08-12'),
('Demo Donor Two','O+','000-000-0102','Coimbatore','2025-06-20'),
('Demo Donor Three','B-','000-000-0103','Madurai',NULL),
('Demo Donor Four','AB+','000-000-0104','Trichy','2025-09-05');

INSERT INTO blood_requests (requester_name,blood_group,units,contact_phone,organization,status) VALUES
('Sample Request Alpha','O+','2','000-000-0201','Demo General Hospital','Pending'),
('Sample Request Beta','B-','1','000-000-0202','Example Care Centre','Approved');
