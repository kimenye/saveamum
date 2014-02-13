CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  type VARCHAR(25),
  external_id VARCHAR(50),
  email VARCHAR(255),
  created_at DATETIME,
  modified_at DATETIME
);

CREATE TABLE user_donations (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  type VARCHAR(25) NOT NULL,
  ref VARCHAR(25) NOT NULL,
  amount DOUBLE,
  user_id INT(11) NOT NULL,
  created_at DATETIME,
  modified_at DATETIME
);