-- JP: Add additional form columns.
ALTER TABLE `form` ADD `report_title_name` varchar(200) DEFAULT NULL AFTER `form_active`;
ALTER TABLE `form` ADD `description_name` varchar(200) DEFAULT NULL AFTER `report_title_name`;
ALTER TABLE `form` ADD `description_active` tinyint(4) DEFAULT '1' AFTER `description_name`;

-- JP: Add additional form_field column.
ALTER TABLE `form_field` ADD `field_description` text DEFAULT '' AFTER `field_name`;

-- JP: Add additional user columns.
ALTER TABLE `users` ADD `report_notifications` tinyint(4) DEFAULT '0' AFTER `needinfo`;
ALTER TABLE `users` ADD `last_reports_view` datetime DEFAULT NULL AFTER `report_notifications`;

-- JP: Insert additional settings.
INSERT INTO settings(`key`, `value`) values('dashboard_redirect', '1');
INSERT INTO settings(`key`, `value`) values('enable_report_notifications', '0');
INSERT INTO settings(`key`, `value`) values('enable_media_filters', '1');
INSERT INTO settings(`key`, `value`) values('enable_chronological_filter', '1');
INSERT INTO settings(`key`, `value`) values('enable_category_filters', '1');
INSERT INTO settings(`key`, `value`) values('enable_category_filters_showhide', '1');
INSERT INTO settings(`key`, `value`) values('show_reporting_options', '1');
INSERT INTO settings(`key`, `value`) values('show_submit_report_tab', '1');
INSERT INTO settings(`key`, `value`) values('enable_filter_search', '0');
