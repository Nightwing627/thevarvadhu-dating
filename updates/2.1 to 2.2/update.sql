UPDATE `general_settings` SET `value` = '2.2' WHERE `general_settings`.`general_settings_id` = 79;

INSERT INTO `third_party_settings` (`third_party_settings_id`, `type`, `value`) VALUES (NULL, 'facebook_chat_set', 'no');
INSERT INTO `third_party_settings` (`third_party_settings_id`, `type`, `value`) VALUES (NULL, 'facebook_chat_page_id', '');
INSERT INTO `third_party_settings` (`third_party_settings_id`, `type`, `value`) VALUES (NULL, 'facebook_chat_logged_in_greeting', '');
INSERT INTO `third_party_settings` (`third_party_settings_id`, `type`, `value`) VALUES (NULL, 'facebook_chat_logged_out_greeting', '');
INSERT INTO `third_party_settings` (`third_party_settings_id`, `type`, `value`) VALUES (NULL, 'facebook_chat_theme_color', '');

INSERT INTO `permission` (`permission_id`, `name`, `codename`, `parent_status`, `description`) VALUES (NULL, NULL, 'facebook_chat_settings', '8', NULL);

 INSERT INTO `business_settings` (`business_settings_id`, `type`, `value`) VALUES
 (NULL, 'custom_payment_method_1_set','no'),
 (NULL, 'custom_payment_method_1_name', NULL),
 (NULL, 'custom_payment_method_1_number', NULL),
 (NULL, 'custom_payment_method_1_instruction', NULL);

 INSERT INTO `business_settings` (`business_settings_id`, `type`, `value`) VALUES
 (NULL, 'custom_payment_method_2_set', 'no'),
 (NULL, 'custom_payment_method_2_name', NULL),
 (NULL, 'custom_payment_method_2_number', NULL),
 (NULL, 'custom_payment_method_2_instruction', NULL);

 INSERT INTO `business_settings` (`business_settings_id`, `type`, `value`) VALUES
 (NULL, 'custom_payment_method_3_set', 'no'),
 (NULL, 'custom_payment_method_3_name', NULL),
 (NULL, 'custom_payment_method_3_number', NULL),
 (NULL, 'custom_payment_method_3_instruction', NULL);

 INSERT INTO `business_settings` (`business_settings_id`, `type`, `value`) VALUES
 (NULL, 'custom_payment_method_4_set', 'no'),
 (NULL, 'custom_payment_method_4_name', NULL),
 (NULL, 'custom_payment_method_4_number', NULL),
 (NULL, 'custom_payment_method_4_instruction', NULL);

 ALTER TABLE `package_payment`
 ADD `custom_payment_method_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `payment_code`,
 ADD `custom_payment_method_transaction_id` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `custom_payment_method_name`,
 ADD `custom_payment_method_comment` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `custom_payment_method_transaction_id`,
 ADD `custom_payment_method_bill_copy` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `custom_payment_method_comment`;
