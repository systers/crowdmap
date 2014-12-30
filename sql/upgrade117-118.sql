-- UPDATE incidents
ALTER TABLE `incident` ADD incident_status tinyint(4);

-- Update DB Version --
UPDATE `settings` SET `value` = '118' WHERE `key` = 'db_version';
