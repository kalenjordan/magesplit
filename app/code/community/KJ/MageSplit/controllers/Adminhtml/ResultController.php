<?php

class KJ_MageSplit_Adminhtml_ResultController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->_title($this->__('MageSplit'));

        $this->loadLayout()
            ->_setActiveMenu('sales/magesplit')
            ->_addBreadcrumb(Mage::helper('core')->__('MageSplit Results'), Mage::helper('core')->__('MageSplit Results'));

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('magesplit/adminhtml_result'));
        $this->renderLayout();

        return $this;
    }
}