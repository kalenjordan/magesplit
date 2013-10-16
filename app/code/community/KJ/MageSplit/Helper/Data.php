<?php

class KJ_MageSplit_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getDataFilePath()
    {
        $dataDir = Mage::getModuleDir('', 'KJ_MageSplit') . '/data';
        $dataDir .= '/order.txt';

        return $dataDir;
    }
}