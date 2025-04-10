DROP DATABASE IF EXISTS CompuTek;

CREATE DATABASE IF NOT EXISTS CompuTek;
USE CompuTek;
# -----------------------------------------------------------------------------
#       TABLE : CATEGORIE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORIE
 (
   ID INTEGER(2) NOT NULL AUTO_INCREMENT ,
   LIBELLE VARCHAR(30) NOT NULL  ,
   IMAGE VARCHAR(128) NOT NULL  
   , PRIMARY KEY (ID) 
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# -----------------------------------------------------------------------------
#       TABLE : PRODUITS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PRODUITS
 (
   ID INTEGER(2) NOT NULL AUTO_INCREMENT ,
   ID_CATEGORIE INTEGER(2) NOT NULL  ,
   MARQUE VARCHAR(50) NOT NULL  ,
   MODEL VARCHAR(150) NOT NULL  ,
   DESCRIPTION VARCHAR(400) NOT NULL  ,
   IMAGE VARCHAR(150) NOT NULL  ,
   PRIX DECIMAL(10,2) NOT NULL  
   , PRIMARY KEY (ID) 
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PRODUITS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PRODUITS_CATEGORIE
     ON PRODUITS (ID_CATEGORIE ASC);

# -----------------------------------------------------------------------------
#       TABLE : UTILISATEURS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEURS
 (
   ID INTEGER(2) NOT NULL AUTO_INCREMENT ,
   NOM VARCHAR(30) NOT NULL  ,
   PRENOM CHAR(30) NOT NULL  ,
   EMAIL VARCHAR(50) NOT NULL  ,
   PASSWORD VARCHAR(256) NOT NULL ,
   ADMIN TINYINT(1) NOT NULL DEFAULT 0
   , PRIMARY KEY (ID),
   UNIQUE KEY `EMAIL` (`EMAIL`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE PRODUITS 
  ADD FOREIGN KEY FK_PRODUITS_CATEGORIE (ID_CATEGORIE)
      REFERENCES CATEGORIE (ID) ;

