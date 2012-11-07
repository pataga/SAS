ALTER TABLE `sas_main_menu`
DROP COLUMN `get`,
DROP COLUMN `inc_path`,
CHANGE COLUMN `getValue` `page`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL AFTER `name`;

