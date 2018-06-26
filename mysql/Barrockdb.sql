-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema Barrockdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Barrockdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Barrockdb` DEFAULT CHARACTER SET utf8 ;
USE `Barrockdb` ;

-- -----------------------------------------------------
-- Table `Barrockdb`.`marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Barrockdb`.`marca` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Samsung` VARCHAR(45) NULL DEFAULT NULL,
  `LG` VARCHAR(45) NULL DEFAULT NULL,
  `Philco` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Barrockdb`.`operacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Barrockdb`.`operacion` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Barrockdb`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Barrockdb`.`productos` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Precio` FLOAT NULL DEFAULT NULL,
  `Stock` INT(11) NULL DEFAULT NULL,
  `Marca_Id` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  INDEX `fk_Productos_Marca1_idx` (`Marca_Id` ASC),
  CONSTRAINT `fk_Productos_Marca1`
    FOREIGN KEY (`Marca_Id`)
    REFERENCES `Barrockdb`.`marca` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Barrockdb`.`operacion_has_productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Barrockdb`.`operacion_has_productos` (
  `Numero_Operacion` INT(11) NOT NULL AUTO_INCREMENT,
  `Operacion_ID` INT(11) NOT NULL,
  `Productos_ID` INT(11) NOT NULL,
  `Cantidad` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Numero_Operacion`),
  INDEX `fk_Operacion_has_Productos_Productos1_idx` (`Productos_ID` ASC),
  INDEX `fk_Operacion_has_Productos_Operacion1_idx` (`Operacion_ID` ASC),
  CONSTRAINT `fk_Operacion_has_Productos_Operacion1`
    FOREIGN KEY (`Operacion_ID`)
    REFERENCES `Barrockdb`.`operacion` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Operacion_has_Productos_Productos1`
    FOREIGN KEY (`Productos_ID`)
    REFERENCES `Barrockdb`.`productos` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Barrockdb`.`tipo_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Barrockdb`.`tipo_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  `Operacion_ID` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_Tipo_Usuario_Operacion1_idx` (`Operacion_ID` ASC),
  CONSTRAINT `fk_Tipo_Usuario_Operacion1`
    FOREIGN KEY (`Operacion_ID`)
    REFERENCES `Barrockdb`.`operacion` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Barrockdb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Barrockdb`.`usuarios` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreApellido` VARCHAR(60) NOT NULL,
  `Email` VARCHAR(30) NOT NULL,
  `Contrasenia` VARCHAR(90) NOT NULL,
  `Telefono` VARCHAR(15) NULL DEFAULT NULL,
  `Avatar` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  INDEX `fk_Usuarios_Tipo_Usuario_idx` (`Avatar` ASC),
  CONSTRAINT `fk_Usuarios_Tipo_Usuario`
    FOREIGN KEY (`Avatar`)
    REFERENCES `Barrockdb`.`tipo_usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
