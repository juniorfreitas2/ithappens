-- MySQL Script generated by MySQL Workbench
-- qui 23 ago 2018 08:17:54 -05
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ithappens
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ithappens
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ithappens` DEFAULT CHARACTER SET utf8 ;
USE `ithappens` ;

-- -----------------------------------------------------
-- Table `ithappens`.`filial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ithappens`.`filial` (
  `fil_id` INT NOT NULL AUTO_INCREMENT,
  `fil_nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`fil_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ithappens`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ithappens`.`produto` (
  `pro_id` INT NOT NULL AUTO_INCREMENT,
  `pro_fil_id` INT NOT NULL,
  `pro_nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`pro_id`),
  CONSTRAINT `fk_produto_filial`
    FOREIGN KEY (`pro_fil_id`)
    REFERENCES `ithappens`.`filial` (`fil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ithappens`.`estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ithappens`.`estoque` (
  `est_id` INT NOT NULL AUTO_INCREMENT,
  `est_fil_id` INT NOT NULL,
  `est_pro_id` INT NOT NULL,
  `est_disponivel` INT NULL,
  `est_reservado` INT NULL,
  PRIMARY KEY (`est_id`, `est_fil_id`),
  INDEX `fk_estoque_filial1_idx` (`est_fil_id` ASC),
  INDEX `fk_estoque_produto1_idx` (`est_pro_id` ASC),
  CONSTRAINT `fk_estoque_filial1`
    FOREIGN KEY (`est_fil_id`)
    REFERENCES `ithappens`.`filial` (`fil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estoque_produto1`
    FOREIGN KEY (`est_pro_id`)
    REFERENCES `ithappens`.`produto` (`pro_fil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ithappens`.`pedido_estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ithappens`.`pedido_estoque` (
  `ped_id` INT NOT NULL AUTO_INCREMENT,
  `ped_descricao` VARCHAR(255) NULL,
  `ped_user_id` INT NULL,
  PRIMARY KEY (`ped_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ithappens`.`Item_pedido_estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ithappens`.`Item_pedido_estoque` (
  `ipe_id` INT NOT NULL AUTO_INCREMENT,
  `ipe_ped_id` INT NOT NULL,
  `ipe_pro_id` INT NOT NULL,
  PRIMARY KEY (`ipe_id`, `ipe_ped_id`, `ipe_pro_id`),
  INDEX `fk_Item_pedido_estoque_pedido_estoque1_idx` (`ipe_ped_id` ASC),
  INDEX `fk_Item_pedido_estoque_produto1_idx` (`ipe_pro_id` ASC),
  CONSTRAINT `fk_Item_pedido_estoque_pedido_estoque1`
    FOREIGN KEY (`ipe_ped_id`)
    REFERENCES `ithappens`.`pedido_estoque` (`ped_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_pedido_estoque_produto1`
    FOREIGN KEY (`ipe_pro_id`)
    REFERENCES `ithappens`.`produto` (`pro_fil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
