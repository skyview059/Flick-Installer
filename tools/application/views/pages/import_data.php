          
<h3>
    DB Information
    <small>
        <a href="<?= site_url(); ?>" class="pull-right"> 
            <i class="fa fa-long-arrow-left"></i> 
            Back to Main Page
        </a>
    </small>
</h3>


<div class="row">
    <div class="col-md-12"> 
        <h3>DB Name: <?= $db_name; ?></h3>
        <h3>DB Name: <?= $site_env; ?></h3>
        <div class="sync_box">
            <pre>                        
INSERT INTO `settings` (`field_group`, `label`, `value`, `order`)
SELECT `field_group`,`label`,`value`,`order` FROM `_tmp_settings` WHERE label NOT IN ( SELECT `label` FROM `settings` );
            </pre>
            <p class="text-right">
                <span class="btn btn-success sync_tbl">
                    Sync Missing Rows
                    <i class="fa fa-refresh"></i>
                </span>
            </p>
        </div>   


        <div class="sync_box">
            <pre>                        
INSERT INTO `email_templates` (category,title,template,receiver_email,slug,status,remark,created,modified)
SELECT category,title,template,receiver_email,slug,status,remark,created,modified FROM `_tmp_email_templates`
WHERE slug NOT IN ( SELECT `slug` FROM `email_templates` ) AND `slug` IS NOT NULL;
            </pre>
            <p class="text-right"><span class="btn btn-success sync_tbl">
                    Sync Missing Rows
                    <i class="fa fa-refresh"></i>
                </span>
            </p>
        </div>
        
        <div class="sync_box">
            <pre>                        
INSERT IGNORE INTO `acls` (`id`, `module_id`, `permission_name`, `permission_key`, `icon`, `order_id`, `menu_item`) VALUES
(null, 2, 'Dev Tools', 'settings/dev-tool', '', 99, 'No'),
(null, 2, 'Site Security', 'settings/security', '', 99, 'No');


INSERT IGNORE INTO `role_permissions` (`role_id`, `acl_id`, `access`) VALUES 
(1, (SELECT id FROM `acls` WHERE `permission_key` = 'settings/dev-tool'), 1);

INSERT IGNORE INTO `role_permissions` (`role_id`, `acl_id`, `access`) VALUES 
(1, (SELECT id FROM `acls` WHERE `permission_key` = 'settings/security'), 1);


UPDATE `acls` SET `permission_key` = 'settings/cms' WHERE `permission_key` = 'cms/setting';

DELETE FROM `role_permissions` WHERE `acl_id` NOT IN ( SELECT `id` FROM `acls` );

            </pre>
            <p class="text-right"><span class="btn btn-success sync_tbl">
                    Sync Missing Rows
                    <i class="fa fa-refresh"></i>
                </span>
            </p>
        </div>
        
        
        <div class="sync_box">
            <pre>                        
TRUNCATE TABLE `client_gdpr`;
INSERT IGNORE INTO `client_gdpr` (`gdpr_id`, `icon`, `name`, `value`, `status`, `group`) VALUES
(1, '<i class=\"fa fa-envelope-o\"></i>', 'Email', 'email', 'Active', 'Communication'),
(2, '<i class=\"fa fa-phone\"></i>', 'Telephone', 'telephone', 'Active', 'Communication'),
(3, '<i class=\"fa fa-comment-o\"></i>', 'SMS (Text)', 'sms', 'Inactive', 'Communication'),
(4, '<i class=\"fa fa-university\"></i>', 'Post', 'post', 'Active', 'Communication');
            </pre>
            <p class="text-right"><span class="btn btn-success sync_tbl">
                    Sync Missing Rows
                    <i class="fa fa-refresh"></i>
                </span>
            </p>
        </div>



    </div>

</div>