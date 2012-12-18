ALTER TABLE `sas_side_nav`
DROP COLUMN `get`,
DROP COLUMN `sub_get`,
DROP COLUMN `inc_path`,
CHANGE COLUMN `getValue` `page`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL AFTER `name`,
CHANGE COLUMN `sub_getValue` `spage`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL AFTER `page`;
