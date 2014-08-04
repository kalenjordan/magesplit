<?php

class KJ_MageSplit_Model_Mysql4_Order extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('magesplit/order', 'magesplit_order_id');
    }
}