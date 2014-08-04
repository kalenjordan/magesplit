<?php

/**
 * @method getCreatedAt()
 * @method KJ_MageSplit_Model_Order setCreatedAt($value)
 * @method KJ_MageSplit_Model_Order setData($key, $value = null)
 */
class KJ_MageSplit_Model_Order extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('magesplit/order');
    }
}