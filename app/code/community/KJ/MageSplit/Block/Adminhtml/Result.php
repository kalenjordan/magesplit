<?php

class KJ_MageSplit_Block_Adminhtml_Result extends Mage_Core_Block_Template
{
    public function getResults()
    {
        $filePath = Mage::helper('magesplit')->getDataFilePath();
        $contents = file_get_contents($filePath);
        echo $contents;
    }
}