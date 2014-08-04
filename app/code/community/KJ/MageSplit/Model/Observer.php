<?php

class KJ_MageSplit_Model_Observer
{
    /**
     * @param $observer Varien_Event_Observer
     */
    public function salesOrderPlaceAfter($observer)
    {
        /** @var Mage_Sales_Model_Order $order */
        $order = $observer->getData('order');

        $mageSplitCookies = $this->_getMageSplitCookies();
        $mageSplitCookiesCsv = $this->_getMageSplitCookiesCsv();
        $mageSplitOrder = Mage::getModel('magesplit/order')
            ->setData('entity_id', $order->getId())
            ->setData('increment_id', $order->getIncrementId())
            ->setData('cookies_csv', $mageSplitCookiesCsv);

        $currentTest = Mage::helper('magesplit')->getCurrentTest();
        if (isset($mageSplitCookies[$currentTest])) {
            $mageSplitOrder->setData('split_test_name', $currentTest);
            $mageSplitOrder->setData('split_test_cookie_value', $mageSplitCookies[$currentTest]);
        }

        $mageSplitOrder->save();
    }

    protected function _getMageSplitCookies()
    {
        $mageSplitCookies = array();
        foreach ($_COOKIE as $key => $val) {
            if (strpos($key, 'magesplit_') !== false) {
                $mageSplitCookies[$key] = $val;
            }
        }

        return $mageSplitCookies;
    }

    protected function _getMageSplitCookiesCsv()
    {
        $mageSplitCookies = $this->_getMageSplitCookies();
        $mageSplitCookiesCsv = "";

        $i = 0;
        foreach ($mageSplitCookies as $key => $val) {
            if ($i > 0) {
                $mageSplitCookiesCsv .= ", ";
            }

            $mageSplitCookiesCsv .= "$key: $val";
            $i++;
        }

        return $mageSplitCookiesCsv;
    }
}