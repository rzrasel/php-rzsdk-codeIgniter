

DROP TABLE IF EXISTS user_password;
DROP TABLE IF EXISTS user_password_meta;
DROP TABLE IF EXISTS user_identity;
DROP TABLE IF EXISTS user_registration;
DROP TABLE IF EXISTS enrollment_type;


-- DROP TABLE IF EXISTS enrollment_type;

CREATE TABLE IF NOT EXISTS enrollment_type (
    enrollment_id           BIGINT(20) NOT NULL,
    enrollment_type         TEXT NOT NULL,
    enrollment_status       BOOLEAN NOT NULL DEFAULT TRUE,
    modified_date           DATETIME NOT NULL,
    created_date            DATETIME NOT NULL,
    CONSTRAINT pk_enrollment_type_enrollment_id PRIMARY KEY (enrollment_id),
    CONSTRAINT uk_enrollment_type_enrollment_type UNIQUE (enrollment_type)
);

INSERT INTO enrollment_type VALUES("171182948560812938", "registered", TRUE, "2024-03-31 15:33:05", "2024-03-31 15:33:05");
INSERT INTO enrollment_type VALUES("171187607072497731", "loggined", TRUE, "2024-03-31 15:35:31", "2024-03-31 15:35:31");

-- DROP TABLE IF EXISTS user_registration;

CREATE TABLE IF NOT EXISTS user_registration (
    user_regi_id            BIGINT(20) NOT NULL,
    user_regi_status        BOOLEAN NOT NULL DEFAULT TRUE,
    modified_by             BIGINT(20) NOT NULL,
    created_by              BIGINT(20) NOT NULL,
    modified_date           DATETIME NOT NULL,
    created_date            DATETIME NOT NULL,
    CONSTRAINT pk_user_registration_user_regi_id PRIMARY KEY (user_regi_id)
);

-- DROP TABLE IF EXISTS user_identity;

CREATE TABLE IF NOT EXISTS user_identity (
    user_regi_id            BIGINT(20) NOT NULL,
    enrollment_id           BIGINT(20) NOT NULL,
    user_identity_id        BIGINT(20) NOT NULL,
    user_status             BOOLEAN NOT NULL DEFAULT TRUE,
    modified_by             BIGINT(20) NOT NULL,
    created_by              BIGINT(20) NOT NULL,
    modified_date           DATETIME NOT NULL,
    created_date            DATETIME NOT NULL,
    CONSTRAINT pk_user_identity_user_identity_id PRIMARY KEY (user_identity_id),
    CONSTRAINT fk_user_identity_user_regi_id FOREIGN KEY (user_regi_id) REFERENCES user_registration(user_regi_id),
    CONSTRAINT fk_user_identity_enrollment_id FOREIGN KEY (enrollment_id) REFERENCES enrollment_type(enrollment_id)
);

-- DROP TABLE IF EXISTS user_password_meta;

CREATE TABLE IF NOT EXISTS user_password_meta (
    user_identity_id        BIGINT(20) NOT NULL,
    user_pass_meta_id       BIGINT(20) NOT NULL,
    hash_algorithom         TEXT NOT NULL,
    password_hash           TEXT NULL,
    password_salt           TEXT NULL,
    pasword_recovery_token  TEXT NULL,
    recovery_token_time     DATETIME NULL,
    user_pass_meta_status   BOOLEAN NOT NULL DEFAULT TRUE,
    modified_by             BIGINT(20) NOT NULL,
    created_by              BIGINT(20) NOT NULL,
    modified_date           DATETIME NOT NULL,
    created_date            DATETIME NOT NULL,
    CONSTRAINT pk_user_password_meta_user_pass_meta_id PRIMARY KEY (user_pass_meta_id),
    CONSTRAINT fk_user_password_meta_user_identity_id FOREIGN KEY (user_identity_id) REFERENCES user_identity(user_identity_id)
);

-- DROP TABLE IF EXISTS user_password;

CREATE TABLE IF NOT EXISTS user_password (
    user_pass_meta_id       BIGINT(20) NOT NULL,
    user_password_id        BIGINT(20) NOT NULL,
    password                TEXT NOT NULL,
    user_password_status    BOOLEAN NOT NULL DEFAULT TRUE,
    modified_by             BIGINT(20) NOT NULL,
    created_by              BIGINT(20) NOT NULL,
    modified_date           DATETIME NOT NULL,
    created_date            DATETIME NOT NULL,
    CONSTRAINT pk_user_password_user_password_id PRIMARY KEY (user_password_id),
    CONSTRAINT fk_user_password_user_pass_meta_id FOREIGN KEY (user_pass_meta_id) REFERENCES user_password_meta(user_pass_meta_id)
);



-- https://www.facebook.com/reel/971549021305245
-- https://www.facebook.com/reel/955959129506553