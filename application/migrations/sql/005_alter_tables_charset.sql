-- MySQL Workbench Synchronization
-- Generated: 2020-04-24 15:41
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tractor

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `orkney10_konektron_cli`.`address`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`admin`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`authorization`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`category`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`category_aux`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`logs`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`orders`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`payment`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`profiles`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`providers`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `pr_token` `pr_token` VARCHAR(255) NULL DEFAULT NULL ,
CHANGE COLUMN `pr_token_forgot` `pr_token_forgot` VARCHAR(255) NULL DEFAULT NULL ,
CHANGE COLUMN `pr_status` `pr_status` VARCHAR(9) NOT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`schedule`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`schedule_aux`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`services`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`users`
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `us_token_forgot` `us_token_forgot` VARCHAR(255) NULL DEFAULT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`cards`
CHANGE `ca_name` `ca_name` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `id_users`,
CHANGE `ca_validity` `ca_validity` varchar(10) COLLATE 'utf8_general_ci' NOT NULL AFTER `ca_number`,
CHANGE `ca_brand` `ca_brand` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `ca_cod`,
CHANGE `ca_modified` `ca_modified` timestamp NULL AFTER `ca_created`,
COLLATE 'utf8_general_ci';

UPDATE `address` SET `as_modified` = NULL WHERE `id_address` = '1';
UPDATE `address` SET `as_modified` = NULL WHERE `id_address` = '2';
UPDATE `address` SET `as_modified` = NULL WHERE `id_address` = '3';

ALTER TABLE `address`
CHANGE `as_address` `as_address` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `id_users`,
CHANGE `as_block` `as_block` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `as_number`,
CHANGE `as_city` `as_city` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `as_block`,
CHANGE `as_uf` `as_uf` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `as_city`,
CHANGE `as_complement` `as_complement` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `as_uf`,
CHANGE `as_modified` `as_modified` timestamp NULL AFTER `as_created`;

ALTER TABLE `admin`
CHANGE `ad_name` `ad_name` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `id_auth`,
CHANGE `ad_nickname` `ad_nickname` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `ad_name`,
CHANGE `ad_picture` `ad_picture` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `ad_nickname`,
CHANGE `ad_address` `ad_address` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `ad_natId`,
CHANGE `ad_complement` `ad_complement` varchar(100) COLLATE 'utf8_general_ci' NULL AFTER `ad_number`,
CHANGE `ad_email` `ad_email` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `ad_phone`,
CHANGE `ad_password` `ad_password` varchar(8) COLLATE 'utf8_general_ci' NOT NULL AFTER `ad_email`,
CHANGE `ad_token` `ad_token` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `ad_password`,
CHANGE `ad_modified` `ad_modified` timestamp NULL AFTER `ad_created`;

ALTER TABLE `authorization`
CHANGE `au_type` `au_type` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `id_auth`,
CHANGE `au_token_private` `au_token_private` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `au_type`,
CHANGE `au_token_public` `au_token_public` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `au_token_private`;

ALTER TABLE `category`
CHANGE `ct_modified` `ct_modified` timestamp NULL AFTER `ct_created`;

ALTER TABLE `category`
CHANGE `ct_title` `ct_title` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `id_category`,
CHANGE `ct_description` `ct_description` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `ct_title`,
COLLATE 'utf8_general_ci';

ALTER TABLE `category_aux`
CHANGE `cx_modified` `cx_modified` timestamp NULL AFTER `cx_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `logs`
CHANGE `lo_type` `lo_type` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `id_admin`,
CHANGE `lo_description` `lo_description` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `lo_type`,
CHANGE `lo_created` `lo_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `lo_description`,
CHANGE `lo_modified` `lo_modified` timestamp NULL AFTER `lo_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `orders`
CHANGE `or_modified` `or_modified` timestamp NULL AFTER `or_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `payment`
CHANGE `pa_type` `pa_type` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `pa_value`,
CHANGE `pa_modified` `pa_modified` timestamp NULL AFTER `pa_created`,
COLLATE 'utf8_general_ci';

UPDATE `profiles` SET `pf_modified` = NULL WHERE `id_profile` = '1';
UPDATE `profiles` SET `pf_modified` = NULL WHERE `id_profile` = '2';
UPDATE `profiles` SET `pf_modified` = NULL WHERE `id_profile` = '3';

ALTER TABLE `profiles`
CHANGE `pf_birthday` `pf_birthday` date NULL AFTER `pf_phone`;

UPDATE `profiles` SET `pf_birthday` = NULL WHERE `id_profile` = '1';
UPDATE `profiles` SET `pf_birthday` = NULL WHERE `id_profile` = '2';
UPDATE `profiles` SET `pf_birthday` = NULL WHERE `id_profile` = '3';

ALTER TABLE `profiles`
CHANGE `pf_name` `pf_name` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `id_users`,
CHANGE `pf_nickname` `pf_nickname` varchar(100) COLLATE 'utf8_general_ci' NULL AFTER `pf_name`,
CHANGE `pf_picture` `pf_picture` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `pf_nickname`,
CHANGE `pf_gender` `pf_gender` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `pf_picture`,
CHANGE `pf_modified` `pf_modified` timestamp NULL AFTER `pf_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `providers`
CHANGE `pr_name` `pr_name` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `id_auth`,
CHANGE `pr_logo` `pr_logo` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `pr_name`,
CHANGE `pr_address` `pr_address` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `pr_ie`,
CHANGE `pr_block` `pr_block` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_number`,
CHANGE `pr_city` `pr_city` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_block`,
CHANGE `pr_uf` `pr_uf` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_city`,
CHANGE `pr_complement` `pr_complement` varchar(100) COLLATE 'utf8_general_ci' NULL AFTER `pr_uf`,
CHANGE `pr_site` `pr_site` varchar(200) COLLATE 'utf8_general_ci' NULL AFTER `pr_phone`,
CHANGE `pr_email` `pr_email` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_site`,
CHANGE `pr_password` `pr_password` varchar(8) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_email`,
CHANGE `pr_token` `pr_token` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `pr_balance`,
CHANGE `pr_token_forgot` `pr_token_forgot` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `pr_token`,
CHANGE `pr_status` `pr_status` varchar(9) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_token_forgot`,
CHANGE `pr_created` `pr_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `pr_status`,
CHANGE `pr_modified` `pr_modified` timestamp NULL AFTER `pr_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `schedule`
CHANGE `sc_status` `sc_status` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `sc_value`,
CHANGE `sc_modified` `sc_modified` timestamp NULL AFTER `sc_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `schedule_aux`
CHANGE `sa_modified` `sa_modified` timestamp NULL AFTER `sa_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `services`
CHANGE `sv_name` `sv_name` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `id_providers`,
CHANGE `sv_codigo` `sv_codigo` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_name`,
CHANGE `sv_description` `sv_description` varchar(500) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_codigo`,
CHANGE `sv_image` `sv_image` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_description`,
CHANGE `sv_infotec` `sv_infotec` varchar(500) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_discount`,
CHANGE `sv_infocomp` `sv_infocomp` varchar(500) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_infotec`,
CHANGE `sv_ean` `sv_ean` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_infocomp`,
CHANGE `sv_gtin` `sv_gtin` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_ean`,
CHANGE `sv_tag` `sv_tag` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `sv_gtin`,
CHANGE `sv_created` `sv_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `sv_tag`,
CHANGE `sv_modified` `sv_modified` timestamp NULL AFTER `sv_created`,
COLLATE 'utf8_general_ci';

UPDATE `users` SET `us_modified` = NULL WHERE `id_users` = '1';
UPDATE `users` SET `us_modified` = NULL WHERE `id_users` = '2';
UPDATE `users` SET `us_modified` = NULL WHERE `id_users` = '3';

ALTER TABLE `users`
CHANGE `us_email` `us_email` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `id_auth`,
CHANGE `us_password` `us_password` varchar(8) COLLATE 'utf8_general_ci' NOT NULL AFTER `us_email`,
CHANGE `us_status` `us_status` varchar(9) COLLATE 'utf8_general_ci' NOT NULL AFTER `us_password`,
CHANGE `us_token` `us_token` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `us_status`,
CHANGE `us_token_forgot` `us_token_forgot` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `us_token`,
CHANGE `us_modified` `us_modified` timestamp NULL AFTER `us_created`,
COLLATE 'utf8_general_ci';

ALTER TABLE `orkney10_konektron_cli`.`address`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `as_number` `as_number` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `as_uf` `as_uf` VARCHAR(2) NOT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`admin`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `ad_number` `ad_number` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `ad_password` `ad_password` VARCHAR(12) NOT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`authorization`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`cards`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `ca_number` `ca_number` VARCHAR(100) NULL DEFAULT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`category`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`category_aux`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`logs`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`orders`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`payment`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `pa_value` `pa_value` DECIMAL(11,2) NOT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`profiles`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `pf_balance` `pf_balance` DECIMAL(11,2) NULL DEFAULT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`providers`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `pr_number` `pr_number` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `pr_balance` `pr_balance` DECIMAL(11,2) NULL DEFAULT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`schedule`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `sc_value` `sc_value` DECIMAL(11,2) NOT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`schedule_aux`
COLLATE = utf8_general_ci ;

ALTER TABLE `orkney10_konektron_cli`.`services`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `sv_oldprice` `sv_oldprice` DECIMAL(11,2) NOT NULL ,
CHANGE COLUMN `sv_bestprice` `sv_bestprice` DECIMAL(11,2) NOT NULL ,
CHANGE COLUMN `sv_discount` `sv_discount` DECIMAL(11,2) NOT NULL ;

ALTER TABLE `orkney10_konektron_cli`.`users`
COLLATE = utf8_general_ci ,
CHANGE COLUMN `us_password` `us_password` VARCHAR(12) NOT NULL ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
