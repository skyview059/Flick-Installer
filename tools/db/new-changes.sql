/**
 * Author:  Khairul Azam
 * Created: 26th Jul, 2023
 */


--- ALTER TABLE `cms` ADD `seo_score` DECIMAL(3,2) NULL DEFAULT NULL AFTER `page_order`; 

/* 
--- Imported into v314.sql File ---

INSERT INTO `acls` (`id`, `module_id`, `permission_name`, `permission_key`, `icon`, `order_id`, `menu_item`) VALUES
(null, 2, 'settings/dev-tool', 'settings/dev-tool', '', 99, 'No');


INSERT IGNORE INTO `settings` (`id`, `field_group`, `label`, `value`, `order`) VALUES
(null, 'cms', 'underMaintenance', 'No', 8);


UPDATE `settings` SET `field_group` = 'security' WHERE `settings`.`label` = 'AccessIPList';
UPDATE `settings` SET `field_group` = 'security' WHERE `settings`.`label` = 'SiteAccess';

ALTER TABLE `settings` CHANGE `field_group` `field_group` VARCHAR(15) DEFAULT NULL;
ALTER TABLE `settings` ADD INDEX(`field_group`);
*/