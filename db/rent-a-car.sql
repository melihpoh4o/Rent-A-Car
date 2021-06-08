-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema rent-a-car
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `rent-a-car` ;

-- -----------------------------------------------------
-- Schema rent-a-car
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rent-a-car` DEFAULT CHARACTER SET utf8 ;
USE `rent-a-car` ;

-- -----------------------------------------------------
-- Table `rent-a-car`.`medewerker`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rent-a-car`.`medewerker` ;

CREATE TABLE IF NOT EXISTS `rent-a-car`.`medewerker` (
  `id_medewerker` INT NOT NULL AUTO_INCREMENT,
  `medewerker_voornaam` VARCHAR(45) NOT NULL,
  `medewerker_tussenvoegsel` VARCHAR(45) NULL,
  `medewerker_achternaam` VARCHAR(45) NOT NULL,
  `medewerker_straat` VARCHAR(45) NOT NULL,
  `medewerker_huisnummer` VARCHAR(45) NOT NULL,
  `medewerker_postcode` VARCHAR(45) NOT NULL,
  `medewerker_plaats` VARCHAR(45) NOT NULL,
  `medewerker_email` VARCHAR(45) NOT NULL,
  `medewerker_wachtwoord` VARCHAR(100) NOT NULL,
  `medewerker_tel` INT NULL,
  PRIMARY KEY (`id_medewerker`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rent-a-car`.`klant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rent-a-car`.`klant` ;

CREATE TABLE IF NOT EXISTS `rent-a-car`.`klant` (
  `id_klant` INT NOT NULL AUTO_INCREMENT,
  `klant_voornaam` VARCHAR(45) NOT NULL,
  `klant_tussenvoegsel` VARCHAR(45) NULL,
  `klant_achternaam` VARCHAR(45) NOT NULL,
  `klant_straat` VARCHAR(45) NOT NULL,
  `klant_huisnummer` VARCHAR(45) NOT NULL,
  `klant_postcode` VARCHAR(45) NOT NULL,
  `klant_plaats` VARCHAR(45) NOT NULL,
  `klant_email` VARCHAR(45) NOT NULL,
  `klant_wachtwoord` VARCHAR(100) NOT NULL,
  `klant_tel` INT NULL,
  PRIMARY KEY (`id_klant`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rent-a-car`.`auto_model`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rent-a-car`.`auto_model` ;

CREATE TABLE IF NOT EXISTS `rent-a-car`.`auto_model` (
  `id_auto_model` INT NOT NULL AUTO_INCREMENT,
  `auto_model_merk` VARCHAR(45) NOT NULL,
  `auto_model_model` VARCHAR(45) NULL,
  `auto_model_bouwjaar` INT NULL,
  `auto_model_kilometerstand` INT NULL,
  `auto_model_prijs_per_dag` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id_auto_model`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rent-a-car`.`auto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rent-a-car`.`auto` ;

CREATE TABLE IF NOT EXISTS `rent-a-car`.`auto` (
  `id_auto` INT NOT NULL AUTO_INCREMENT,
  `id_auto_model` INT NOT NULL,
  `auto_kenteken` VARCHAR(10) NOT NULL,
  `auto_soort` TINYINT NOT NULL,
  `auto_status` TINYINT NOT NULL,
  `auto_info` TEXT NULL,
  `auto_img` VARCHAR(245) NULL,
  `auto_status_reservering` TINYINT NULL,
  PRIMARY KEY (`id_auto`),
  INDEX `fk_auto_auto_model_idx` (`id_auto_model` ASC) VISIBLE,
  CONSTRAINT `fk_auto_auto_model`
    FOREIGN KEY (`id_auto_model`)
    REFERENCES `rent-a-car`.`auto_model` (`id_auto_model`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rent-a-car`.`factuur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rent-a-car`.`factuur` ;

CREATE TABLE IF NOT EXISTS `rent-a-car`.`factuur` (
  `id_factuur` INT NOT NULL AUTO_INCREMENT,
  `id_klant` INT NOT NULL,
  `id_medewerker` INT NULL,
  `factuur_datum` DATE NOT NULL,
  `factuur_status` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id_factuur`),
  INDEX `fk_factuur_medewerker1_idx` (`id_medewerker` ASC) VISIBLE,
  INDEX `fk_factuur_klant1_idx` (`id_klant` ASC) VISIBLE,
  CONSTRAINT `fk_factuur_medewerker1`
    FOREIGN KEY (`id_medewerker`)
    REFERENCES `rent-a-car`.`medewerker` (`id_medewerker`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_factuur_klant1`
    FOREIGN KEY (`id_klant`)
    REFERENCES `rent-a-car`.`klant` (`id_klant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rent-a-car`.`reservering`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rent-a-car`.`reservering` ;

CREATE TABLE IF NOT EXISTS `rent-a-car`.`reservering` (
  `id_reservering` INT NOT NULL AUTO_INCREMENT,
  `id_auto` INT NOT NULL,
  `reservering_betaald` TINYINT NOT NULL,
  `reservering_start_datum` DATE NULL,
  `reserveringe_eind_datum` DATE NULL,
  `id_factuur` INT NULL,
  PRIMARY KEY (`id_reservering`),
  INDEX `fk_reservering_auto1_idx` (`id_auto` ASC) VISIBLE,
  INDEX `fk_reservering_factuur1_idx` (`id_factuur` ASC) VISIBLE,
  CONSTRAINT `fk_reservering_auto1`
    FOREIGN KEY (`id_auto`)
    REFERENCES `rent-a-car`.`auto` (`id_auto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservering_factuur1`
    FOREIGN KEY (`id_factuur`)
    REFERENCES `rent-a-car`.`factuur` (`id_factuur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `rent-a-car`.`medewerker`
-- -----------------------------------------------------
START TRANSACTION;
USE `rent-a-car`;
INSERT INTO `rent-a-car`.`medewerker` (`id_medewerker`, `medewerker_voornaam`, `medewerker_tussenvoegsel`, `medewerker_achternaam`, `medewerker_straat`, `medewerker_huisnummer`, `medewerker_postcode`, `medewerker_plaats`, `medewerker_email`, `medewerker_wachtwoord`, `medewerker_tel`) VALUES (1, 'Melih', NULL, 'Redzhebov', 'Karveel', '15', '8223AF', 'Lelystad', 'melih@gmail.com', 'melih123', NULL);
INSERT INTO `rent-a-car`.`medewerker` (`id_medewerker`, `medewerker_voornaam`, `medewerker_tussenvoegsel`, `medewerker_achternaam`, `medewerker_straat`, `medewerker_huisnummer`, `medewerker_postcode`, `medewerker_plaats`, `medewerker_email`, `medewerker_wachtwoord`, `medewerker_tel`) VALUES (2, 'Alphonsus', '', 'Hoving', 'Abraham Kuyperlaan', '129', '3038 PD', 'Rotterdam', 'alphonsus@gmail.com', 'alphonsus123', 628528030);

COMMIT;


-- -----------------------------------------------------
-- Data for table `rent-a-car`.`klant`
-- -----------------------------------------------------
START TRANSACTION;
USE `rent-a-car`;
INSERT INTO `rent-a-car`.`klant` (`id_klant`, `klant_voornaam`, `klant_tussenvoegsel`, `klant_achternaam`, `klant_straat`, `klant_huisnummer`, `klant_postcode`, `klant_plaats`, `klant_email`, `klant_wachtwoord`, `klant_tel`) VALUES (1, 'Brendan', '', 'Hellendoorn', 'Bachstraat', '118', '3335 CK', 'Zwijndrecht', 'brendan@gmail.com', 'brendan123', 645429802);
INSERT INTO `rent-a-car`.`klant` (`id_klant`, `klant_voornaam`, `klant_tussenvoegsel`, `klant_achternaam`, `klant_straat`, `klant_huisnummer`, `klant_postcode`, `klant_plaats`, `klant_email`, `klant_wachtwoord`, `klant_tel`) VALUES (3, 'Edwin', '', 'Collignon', 'Koraalstraat', '7', '4301 EN', 'Zierikzee', 'edwin@gmail.com', 'edwin123', 675012983);

COMMIT;


-- -----------------------------------------------------
-- Data for table `rent-a-car`.`auto_model`
-- -----------------------------------------------------
START TRANSACTION;
USE `rent-a-car`;
INSERT INTO `rent-a-car`.`auto_model` (`id_auto_model`, `auto_model_merk`, `auto_model_model`, `auto_model_bouwjaar`, `auto_model_kilometerstand`, `auto_model_prijs_per_dag`) VALUES (1, 'Audi', 'A3', 2020, 10000, 230.00);
INSERT INTO `rent-a-car`.`auto_model` (`id_auto_model`, `auto_model_merk`, `auto_model_model`, `auto_model_bouwjaar`, `auto_model_kilometerstand`, `auto_model_prijs_per_dag`) VALUES (2, 'BMW', 'X3', 2018, 100000, 215.00);
INSERT INTO `rent-a-car`.`auto_model` (`id_auto_model`, `auto_model_merk`, `auto_model_model`, `auto_model_bouwjaar`, `auto_model_kilometerstand`, `auto_model_prijs_per_dag`) VALUES (3, 'Mercedes-Benz', 'Sprinter', 2020, 10000, 220.00);
INSERT INTO `rent-a-car`.`auto_model` (`id_auto_model`, `auto_model_merk`, `auto_model_model`, `auto_model_bouwjaar`, `auto_model_kilometerstand`, `auto_model_prijs_per_dag`) VALUES (4, 'Toyota', 'PROACE', 2020, 25000, 190.00);

COMMIT;


-- -----------------------------------------------------
-- Data for table `rent-a-car`.`auto`
-- -----------------------------------------------------
START TRANSACTION;
USE `rent-a-car`;
INSERT INTO `rent-a-car`.`auto` (`id_auto`, `id_auto_model`, `auto_kenteken`, `auto_soort`, `auto_status`, `auto_info`, `auto_img`, `auto_status_reservering`) VALUES (1, 1, 'F-854-LT', 0, 0, 'Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies ligula sed magna dictum porta. Donec rutrum congue leo eget malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Pellentesque in ipsum id orci porta dapibus.', 'audi a3.jpg', NULL);
INSERT INTO `rent-a-car`.`auto` (`id_auto`, `id_auto_model`, `auto_kenteken`, `auto_soort`, `auto_status`, `auto_info`, `auto_img`, `auto_status_reservering`) VALUES (2, 2, 'DBB-87-P', 0, 0, 'Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Proin eget tortor risus. Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Cras ultricies ligula sed magna dictum porta. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada.', '2018-bmw-x3.jpg', NULL);
INSERT INTO `rent-a-car`.`auto` (`id_auto`, `id_auto_model`, `auto_kenteken`, `auto_soort`, `auto_status`, `auto_info`, `auto_img`, `auto_status_reservering`) VALUES (3, 3, 'D-355-RF', 1, 0, 'Nulla quis lorem ut libero malesuada feugiat. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat.', 'mercedes-benz-sprinter-black.jpg', NULL);
INSERT INTO `rent-a-car`.`auto` (`id_auto`, `id_auto_model`, `auto_kenteken`, `auto_soort`, `auto_status`, `auto_info`, `auto_img`, `auto_status_reservering`) VALUES (4, 4, 'VV-143-L', 1, 0, 'Vivamus suscipit tortor eget felis porttitor volutpat. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Nulla quis lorem ut libero malesuada feugiat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Cras ultricies ligula sed magna dictum porta. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Curabitur aliquet quam id dui posuere blandit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.', 'toyota-proace.jpg', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `rent-a-car`.`factuur`
-- -----------------------------------------------------
START TRANSACTION;
USE `rent-a-car`;
INSERT INTO `rent-a-car`.`factuur` (`id_factuur`, `id_klant`, `id_medewerker`, `factuur_datum`, `factuur_status`) VALUES (1, 1, 2, '2021-06-03', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `rent-a-car`.`reservering`
-- -----------------------------------------------------
START TRANSACTION;
USE `rent-a-car`;
INSERT INTO `rent-a-car`.`reservering` (`id_reservering`, `id_auto`, `reservering_betaald`, `reservering_start_datum`, `reserveringe_eind_datum`, `id_factuur`) VALUES (1, 1, 0, '2021-06-03', '2021-06-06', 1);

COMMIT;

