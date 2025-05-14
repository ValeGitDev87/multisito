-- 1) Users
CREATE TABLE users (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  name         VARCHAR(100) NOT NULL,
  surname      VARCHAR(100) NOT NULL,
  email        VARCHAR(150) NOT NULL UNIQUE,
  password     VARCHAR(255) NOT NULL,
  is_admin     TINYINT(1)   NOT NULL DEFAULT 0,
  created_at   TIMESTAMP     NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP     NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2) Suites (i gruppi di funzioni / dropdown)
CREATE TABLE suites (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  name         VARCHAR(100) NOT NULL,
  slug         VARCHAR(100) NOT NULL UNIQUE,
  sort_order   SMALLINT      NOT NULL DEFAULT 0
) ENGINE=InnoDB;

-- 3) Functions (le singole voci di menu)
CREATE TABLE functions (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  suite_id     INT            NOT NULL,
  name         VARCHAR(100)   NOT NULL,
  route        VARCHAR(200)   NOT NULL,
  icon         VARCHAR(100)   DEFAULT NULL,
  sort_order   SMALLINT       NOT NULL DEFAULT 0,
  FOREIGN KEY (suite_id) REFERENCES suites(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4) Permissions (collega utente ⇄ suite ⇄ funzione)
CREATE TABLE permissions (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  user_id       INT            NOT NULL,
  suite_id      INT            NOT NULL,
  function_id   INT            DEFAULT NULL,
  FOREIGN KEY (user_id)     REFERENCES users(id)     ON DELETE CASCADE,
  FOREIGN KEY (suite_id)    REFERENCES suites(id)    ON DELETE CASCADE,
  FOREIGN KEY (function_id) REFERENCES functions(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Indici extra per le join
CREATE INDEX idx_permissions_user   ON permissions(user_id);
CREATE INDEX idx_permissions_suite  ON permissions(suite_id);
CREATE INDEX idx_permissions_func   ON permissions(function_id);


CREATE TABLE IF NOT EXISTS migrations (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  migration   VARCHAR(255) NOT NULL,
  batch       INT        NOT NULL,
  migrated_at TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
