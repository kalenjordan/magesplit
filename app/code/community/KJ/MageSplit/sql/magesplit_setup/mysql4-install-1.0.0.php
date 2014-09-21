<?php

/** @var this KJ_MageSplit_Model_Mysql4_Setup */
$this->startSetup();

$this->run("
CREATE TABLE `{$this->getTable('magesplit/order')}` (
	`magesplit_order_id` INT(11) UNSIGNED NOT NULL auto_increment,
	`entity_id` INT,
	`increment_id` VARCHAR(255),
	`split_test_name` VARCHAR(255),
	`split_test_cookie_value` DECIMAL(4, 4),
	`cookies_csv` TEXT,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`magesplit_order_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$this->endSetup();
