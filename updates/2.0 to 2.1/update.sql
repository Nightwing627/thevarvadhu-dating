INSERT INTO `permission` (`permission_id`, `name`, `codename`, `parent_status`, `description`) VALUES (NULL, NULL, 'bulk_member_add', '1', NULL);
INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES ('89', 'meta_title', 'Active Matrimonial CMS');
INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES ('90', 'seo_image_facebook', 'seo_image_facebook_1580622300.png');
INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES ('91', 'seo_image_twitter', 'seo_image_twitter_1580622324.png');
UPDATE general_settings SET value = '2.1' WHERE general_settings.`type` = 'version';
Drop TABLE `table 35`;
