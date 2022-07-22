UPDATE `general_settings` SET `value` = '2.3' WHERE `general_settings`.`general_settings_id` = 79;
ALTER TABLE `member` ADD `profile_image_status` TINYINT NULL DEFAULT NULL COMMENT '0=pending, 1=approved, 2=rejected' AFTER `profile_image`;
ALTER TABLE `member` ADD `profile_image_update_time` VARCHAR(50) NULL AFTER `profile_image_status`;
INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES (NULL, 'member_profile_pic_approval_by_admin', 'off');
INSERT INTO `permission` (`permission_id`, `name`, `codename`, `parent_status`, `description`) VALUES (NULL, NULL, 'member_profile_pic_approval', '1', NULL);
UPDATE `member` SET `profile_image_status` = 0;
