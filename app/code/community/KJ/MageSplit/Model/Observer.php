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

        $magesplitCookies = array();
        foreach ($_COOKIE as $key => $val) {
            if (strpos($key, 'magesplit_') !== false) {
                $magesplitCookies[$key] = $val;
            }
        }

        $line = $order->getIncrementId();
        foreach ($magesplitCookies as $key => $val) {
            $line .= " - $key: $val";
        }

        $this->_writeLineToFile($line);
    }

    protected function _writeLineToFile($line)
    {
        $dataDir = Mage::getModuleDir('', 'KJ_MageSplit') . '/data';
        $filePath = $dataDir . '/order.txt';

        file_put_contents($filePath, $line . "\n", FILE_APPEND);

        return $this;
    }
}