ALTER TABLE `questionnaire` DROP `status`;
ALTER TABLE `test`  ADD `status` INT NOT NULL DEFAULT '0'  AFTER `max_value`;
ALTER TABLE `test`  ADD `has_print` INT NOT NULL DEFAULT '0'  AFTER `status`;