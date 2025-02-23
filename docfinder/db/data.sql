-- CREATE DATABASE medecins_tunisie; -- Not supported in Oracle SQL

-- Connect to the database as an admin user and create a new user
CREATE USER medecins_tunisie IDENTIFIED BY password;

-- Grant necessary privileges to the new user
GRANT CONNECT, RESOURCE TO medecins_tunisie;

-- Switch to the new user
ALTER SESSION SET CURRENT_SCHEMA = medecins_tunisie;

CREATE TABLE medecins (
    id NUMBER PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    specialite VARCHAR(100) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    telephone VARCHAR(20),
    email VARCHAR(100)
);

CREATE SEQUENCE medecins_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER medecins_bir 
BEFORE INSERT ON medecins 
FOR EACH ROW 
BEGIN 
    SELECT medecins_seq.NEXTVAL INTO :new.id FROM dual; 
END;
/

CREATE SEQUENCE avis_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER avis_bir 
BEFORE INSERT ON avis 
FOR EACH ROW 
BEGIN 
    SELECT avis_seq.NEXTVAL INTO :new.id FROM dual; 
END;
/

CREATE TABLE rendez_vous (
    id NUMBER PRIMARY KEY,
    medecin_id INT,
    utilisateur_nom VARCHAR(100),
    note INT,
    commentaire TEXT,
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (medecin_id) REFERENCES medecins(id)
);

CREATE TABLE rendez_vous (
    id NUMBER PRIMARY KEY,
    medecin_id NUMBER,
    utilisateur_nom VARCHAR(100),
    date_rdv DATE,
    FOREIGN KEY (medecin_id) REFERENCES medecins(id)
);

CREATE SEQUENCE rendez_vous_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER rendez_vous_bir 
BEFORE INSERT ON rendez_vous 
FOR EACH ROW 
BEGIN 
    SELECT rendez_vous_seq.NEXTVAL INTO :new.id FROM dual; 
END;
/