<?php

/** @var $this Clean_Util_Model_Mysql4_Setup */
$this->startSetup();

$this->createTable($this->getTable('magesplit/order'),
    array('magesplit_order_id' => 'INT(11) UNSIGNED NOT NULL auto_increment'),
    array(
        'entity_id'                 => 'INT',
        'increment_id'              => 'VARCHAR(255)',
        'split_test_name'           => 'VARCHAR(255)',
        'split_test_cookie_value'   => 'DECIMAL(4, 4)',
        'cookies_csv'               => 'TEXT',
        'created_at'                => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    )
);

$this->endSetup();