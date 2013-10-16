<?php

class KJ_MageSplit_Block_Adminhtml_Result extends Mage_Core_Block_Template
{
    public function getResults()
    {
        $splitTestCounts = $this->_getSplitTestCounts();
        return $splitTestCounts;
    }

    protected function _getSplitTestCounts()
    {
        $splitTestCounts = array();

        $orderList = $this->_getOrderList();
        foreach ($orderList as $orderId => $orderData) {
            foreach ($orderData as $testName => $testRandomNumber) {
                $onOrOff = ($testRandomNumber > 0.5) ? 'on' : 'off';
                if (!isset($splitTestCounts[$testName][$onOrOff])) {
                    $splitTestCounts[$testName][$onOrOff] = 0;
                }

                $splitTestCounts[$testName][$onOrOff]++;
            }
        }

        return $splitTestCounts;
    }

    protected function _getOrderList()
    {
        $orderList = array();

        $orderLines = $this->_getOrderLines();
        foreach ($orderLines as $orderLine) {
            list($orderId, $orderData) = $this->_parseOrderLine($orderLine);
            if ($orderData) {
                $orderList[$orderId] = $orderData;
            }
        }

        return $orderList;
    }

    /**
     * Takes in something like
     *
     *   100078658 - test1_name: 0.6 - test2_name: 0.2
     *
     * And returns
     *
     *   array(
     *     100078658,
     *     array(
     *       test1_name => 0.6
     *       test2_name => 0.2
     *     )
     *   )
     * 
     * @param $orderLine
     * @return array|null
     */
    protected function _parseOrderLine($orderLine)
    {
        $parts = explode(' - ', $orderLine);
        if (! isset($parts[0])) {
            return array(null, null);
        }
        $orderId = $parts[0];

        array_shift($parts);
        if (!isset($parts[0])) {
            return array(null, null);
        }

        $orderData = array();
        foreach ($parts as $part) {
            $partParts = explode(':', $part);
            $orderData[trim($partParts[0])] = trim($partParts[1]);
        }

        return array($orderId, $orderData);
    }

    protected function _getOrderLines()
    {
        $filePath = Mage::helper('magesplit')->getDataFilePath();
        $contents = file_get_contents($filePath);

        $lines = explode("\n", $contents);
        return $lines;
    }
}