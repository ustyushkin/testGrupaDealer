-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Schema Schema
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Schema` DEFAULT CHARACTER SET utf8 ;
USE `Schema` ;

-- -----------------------------------------------------
-- Table `Schema`.`Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schema`.`CATEGORY` (
  `idCategory` INT(11) NOT NULL AUTO_INCREMENT,
  `Description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCategory`),
  UNIQUE INDEX `idCategory_UNIQUE` (`idCategory` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `Schema`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schema`.`PRODUCT` (
  `idProduct` INT(11) NOT NULL AUTO_INCREMENT,
  `Description` VARCHAR(100) NOT NULL,
  `idfCategory` INT(11) NOT NULL,
  PRIMARY KEY (`idProduct`),
  UNIQUE INDEX `idProduct_UNIQUE` (`idProduct` ASC),
  INDEX `idForCategory_idx` (`idfCategory` ASC),
  CONSTRAINT `idForCategory`
    FOREIGN KEY (`idfCategory`)
    REFERENCES `Schema`.`CATEGORY` (`idCategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `Schema`.`AttributeValue`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schema`.`ATTRIBUTEVALUE` (
  `Product_idProduct` INT(11) NOT NULL,
  `Attribute_idAttribute` INT(11) NOT NULL,
  `Value` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`Product_idProduct`,`Attribute_idAttribute`),
  CONSTRAINT `fk_AttributeValue_Product1`
    FOREIGN KEY (`Product_idProduct`)
    REFERENCES `Schema`.`PRODUCT` (`idProduct`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AttributeValue_Attribute1`
    FOREIGN KEY (`Attribute_idAttribute`)
    REFERENCES `Schema`.`ATTRIBUTE` (`idAttribute`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `Schema`.`Attribute`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schema`.`ATTRIBUTE` (
  `idAttribute` INT(11) NOT NULL AUTO_INCREMENT,
  `Description` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`idAttribute`),
  UNIQUE INDEX `idAttribute_UNIQUE` (`idAttribute` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
