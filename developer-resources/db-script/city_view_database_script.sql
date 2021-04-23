-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema city_view_database
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema city_view_database
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `city_view_database` DEFAULT CHARACTER SET utf8 ;
USE `city_view_database` ;

-- -----------------------------------------------------
-- Table `city_view_database`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `role_name_UNIQUE` (`role_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email_id` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `area_code` VARCHAR(5) NOT NULL,
  `phone_number` VARCHAR(12) NOT NULL,
  `joining_datetime` DATETIME NOT NULL,
  `roles_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_id_UNIQUE` (`email_id` ASC),
  INDEX `fk_users_roles1_idx` (`roles_id` ASC),
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `city_view_database`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`subdivisions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`subdivisions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `subdivision_name` VARCHAR(45) NOT NULL,
  `has_manager` INT NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `subdivision_name_UNIQUE` (`subdivision_name` ASC),
  INDEX `fk_subdivisions_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_subdivisions_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`buildings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`buildings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `building_name` VARCHAR(45) NOT NULL,
  `occupancy_status` VARCHAR(45) NOT NULL,
  `has_manager` INT NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_buildings_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_buildings_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_buildings_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_buildings_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`apartments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`apartments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `apartment_number` INT NOT NULL,
  `occupancy_status` VARCHAR(45) NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_apartments_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_apartments_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_apartments_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_apartments_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartments_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`utilities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`utilities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `utility_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `utility_name_UNIQUE` (`utility_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`apartment_utility_bills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`apartment_utility_bills` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `bill_amount` DOUBLE NOT NULL,
  `service_provider_type` VARCHAR(45) NOT NULL,
  `utilities_id` INT UNSIGNED NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `service_provider_type_idx` (`service_provider_type` ASC),
  INDEX `fk_apartment_utility_bills_utilities1_idx` (`utilities_id` ASC),
  INDEX `fk_apartment_utility_bills_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_apartment_utility_bills_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_apartment_utility_bills_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_apartment_utility_bills_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_apartment_utility_bills_utilities1`
    FOREIGN KEY (`utilities_id`)
    REFERENCES `city_view_database`.`utilities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_bills_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_bills_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_bills_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_bills_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`maintenance_requests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`maintenance_requests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` VARCHAR(500) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `message_datetime` DATETIME NOT NULL,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `fk_maintenance_requests_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_maintenance_requests_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_maintenance_requests_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_maintenance_requests_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_maintenance_requests_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_maintenance_requests_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_maintenance_requests_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_maintenance_requests_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`complaints`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`complaints` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` VARCHAR(500) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `message_datetime` DATETIME NOT NULL,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `fk_complaints_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_complaints_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_complaints_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_complaints_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_complaints_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complaints_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complaints_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complaints_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`addresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`addresses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `street_address` VARCHAR(45) NOT NULL,
  `street_address_line_2` VARCHAR(45) NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  `zip_code` VARCHAR(45) NOT NULL,
  `country` VARCHAR(45) NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_addresses_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_addresses_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`responsible_contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`responsible_contacts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `zip_code` VARCHAR(10) NULL,
  `country` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(15) NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_responsible_contacts_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_responsible_contacts_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`it_requests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`it_requests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` VARCHAR(500) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `message_datetime` DATETIME NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_it_requests_subdivisions1_idx` (`subdivisions_id` ASC),
  CONSTRAINT `fk_it_requests_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`community_services`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`community_services` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `community_service_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `community_service_name_UNIQUE` (`community_service_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`apartment_community_service_bills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`apartment_community_service_bills` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `bill_amount` DOUBLE NOT NULL,
  `community_services_id` INT UNSIGNED NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `fk_apartment_community_service_bills_community_services1_idx` (`community_services_id` ASC),
  INDEX `fk_apartment_community_service_bills_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_apartment_community_service_bills_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_apartment_community_service_bills_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_apartment_community_service_bills_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_apartment_community_service_bills_community_services1`
    FOREIGN KEY (`community_services_id`)
    REFERENCES `city_view_database`.`community_services` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_community_service_bills_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_community_service_bills_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_community_service_bills_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_community_service_bills_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`apartment_utility_service_provider_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`apartment_utility_service_provider_types` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_provider_type` VARCHAR(45) NOT NULL,
  `utilities_id` INT UNSIGNED NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_apartment_utility_service_provider_types_utilities1_idx` (`utilities_id` ASC),
  INDEX `fk_apartment_utility_service_provider_types_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_apartment_utility_service_provider_types_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_apartment_utility_service_provider_types_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_apartment_utility_service_provider_types_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_apartment_utility_service_provider_types_utilities1`
    FOREIGN KEY (`utilities_id`)
    REFERENCES `city_view_database`.`utilities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_service_provider_types_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_service_provider_types_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_service_provider_types_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apartment_utility_service_provider_types_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`chats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`chats` (
  `sender_user_id` INT UNSIGNED NOT NULL,
  `receiver_user_id` INT UNSIGNED NOT NULL,
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` VARCHAR(500) NOT NULL,
  `message_datetime` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_users_users2_idx` (`receiver_user_id` ASC),
  INDEX `fk_users_has_users_users1_idx` (`sender_user_id` ASC),
  CONSTRAINT `fk_users_chats_users1`
    FOREIGN KEY (`sender_user_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_chats_users2`
    FOREIGN KEY (`receiver_user_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`electricity_bills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`electricity_bills` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `bill_amount` DOUBLE NOT NULL,
  `service_provider_type` VARCHAR(45) NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `service_provider_type_idx` (`service_provider_type` ASC),
  INDEX `fk_electricity_bills_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_electricity_bills_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_electricity_bills_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_electricity_bills_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_electricity_bills_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_electricity_bills_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_electricity_bills_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_electricity_bills_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`gas_bills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`gas_bills` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `bill_amount` DOUBLE NOT NULL,
  `service_provider_type` VARCHAR(45) NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `service_provider_type_idx` (`service_provider_type` ASC),
  INDEX `fk_gas_bills_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_gas_bills_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_gas_bills_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_gas_bills_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_gas_bills_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gas_bills_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gas_bills_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gas_bills_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`water_bills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`water_bills` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `bill_amount` DOUBLE NOT NULL,
  `service_provider_type` VARCHAR(45) NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `service_provider_type_idx` (`service_provider_type` ASC),
  INDEX `fk_water_bills_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_water_bills_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_water_bills_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_water_bills_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_water_bills_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_water_bills_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_water_bills_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_water_bills_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `city_view_database`.`internet_bills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city_view_database`.`internet_bills` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` INT NOT NULL,
  `year` YEAR(4) NOT NULL,
  `bill_amount` DOUBLE NOT NULL,
  `service_provider_type` VARCHAR(45) NOT NULL,
  `apartments_id` INT UNSIGNED NOT NULL,
  `buildings_id` INT UNSIGNED NOT NULL,
  `subdivisions_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `month_year_idx` (`month` ASC, `year` ASC),
  INDEX `service_provider_type_idx` (`service_provider_type` ASC),
  INDEX `fk_internet_bills_apartments1_idx` (`apartments_id` ASC),
  INDEX `fk_internet_bills_buildings1_idx` (`buildings_id` ASC),
  INDEX `fk_internet_bills_subdivisions1_idx` (`subdivisions_id` ASC),
  INDEX `fk_internet_bills_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_internet_bills_apartments1`
    FOREIGN KEY (`apartments_id`)
    REFERENCES `city_view_database`.`apartments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_internet_bills_buildings1`
    FOREIGN KEY (`buildings_id`)
    REFERENCES `city_view_database`.`buildings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_internet_bills_subdivisions1`
    FOREIGN KEY (`subdivisions_id`)
    REFERENCES `city_view_database`.`subdivisions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_internet_bills_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `city_view_database`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
