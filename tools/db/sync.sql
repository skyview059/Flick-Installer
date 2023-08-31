
/*  Dev Tools | settings/dev-tool */
INSERT IGNORE INTO `acls` (`id`, `module_id`, `permission_name`, `permission_key`, `icon`, `order_id`, `menu_item`) VALUES
(null, 2, 'Dev Tools', 'settings/dev-tool', '', 99, 'No');

INSERT IGNORE INTO `role_permissions` (`role_id`, `acl_id`, `access`) VALUES 
(1, (SELECT id FROM `acls` WHERE `permission_key` = 'settings/dev-tool'), 1);


/*  Site Security | settings/security */
INSERT IGNORE INTO `acls` (`id`, `module_id`, `permission_name`, `permission_key`, `icon`, `order_id`, `menu_item`) VALUES
(null, 2, 'Site Security', 'settings/security', '', 99, 'No');

INSERT IGNORE INTO `role_permissions` (`role_id`, `acl_id`, `access`) VALUES 
(1, (SELECT id FROM `acls` WHERE `permission_key` = 'settings/security'), 1),
(2, (SELECT id FROM `acls` WHERE `permission_key` = 'settings/security'), 1);



/*  'Frontend Editor' | 'cms/frontend_edit' */
INSERT IGNORE INTO `acls` (`id`, `module_id`, `permission_name`, `permission_key`, `icon`, `order_id`, `menu_item`) VALUES
(null, 2, 'Frontend Editor', 'cms/frontend_edit', '', 99, 'No');

INSERT IGNORE INTO `role_permissions` (`role_id`, `acl_id`, `access`) VALUES 
(1, (SELECT id FROM `acls` WHERE `permission_key` = 'cms/frontend_edit'), 1),
(2, (SELECT id FROM `acls` WHERE `permission_key` = 'cms/frontend_edit'), 1);


UPDATE `acls` SET `permission_key` = 'settings/cms' WHERE `permission_key` = 'cms/setting';

DELETE FROM `role_permissions` WHERE `acl_id` NOT IN ( SELECT `id` FROM `acls` );


UPDATE `settings` SET `field_group` = 'security' WHERE `label` = 'AccessIPList';
UPDATE `settings` SET `field_group` = 'security' WHERE `label` = 'SiteAccess';


UPDATE `settings` SET `field_group` = 'security' WHERE `settings`.`label` = 'RecaptchaStatusV3';
UPDATE `settings` SET `field_group` = 'security' WHERE `settings`.`label` = 'RecaptchaSecretKeyV3';
UPDATE `settings` SET `field_group` = 'security' WHERE `settings`.`label` = 'RecaptchaSiteKeyV3';

UPDATE `settings` SET `field_group` = 'client' WHERE `settings`.`label` = 'ClientReferencePrefix';
UPDATE `settings` SET `field_group` = 'client' WHERE `settings`.`label` = 'ClientReferenceNextNumber';
UPDATE `settings` SET `field_group` = 'client' WHERE `settings`.`label` = 'LeadReferencePrefix';
UPDATE `settings` SET `field_group` = 'client' WHERE `settings`.`label` = 'LeadReferenceNextNumber';

/*
ALTER TABLE `settings` 
    CHANGE `field_group` `field_group` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'general';
*/

INSERT INTO `acls` (`module_id`, `permission_name`, `permission_key`, `icon`, `order_id`, `menu_item`) VALUES 
(2, 'Client Settings', 'settings/client', 'fa-user', '1', 'No');



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
TRUNCATE TABLE `client_gdpr`;
INSERT INTO `client_gdpr` (`gdpr_id`, `icon`, `name`, `value`, `status`, `group`) VALUES
(1, '<i class=\"fa fa-envelope-o\"></i>', 'Email', 'email', 'Active', 'Communication'),
(2, '<i class=\"fa fa-phone\"></i>', 'Telephone', 'telephone', 'Active', 'Communication'),
(3, '<i class=\"fa fa-comment-o\"></i>', 'SMS (Text)', 'sms', 'Inactive', 'Communication'),
(4, '<i class=\"fa fa-university\"></i>', 'Post', 'post', 'Active', 'Communication');
COMMIT;


TRUNCATE TABLE `client_gdpr`;
INSERT IGNORE INTO `client_gdpr` (`gdpr_id`, `icon`, `name`, `value`, `status`, `group`) VALUES
(1, '<i class=\"fa fa-envelope-o\"></i>', 'Email', 'email', 'Active', 'Communication'),
(2, '<i class=\"fa fa-phone\"></i>', 'Telephone', 'telephone', 'Active', 'Communication'),
(3, '<i class=\"fa fa-comment-o\"></i>', 'SMS (Text)', 'sms', 'Inactive', 'Communication'),
(4, '<i class=\"fa fa-university\"></i>', 'Post', 'post', 'Active', 'Communication');







