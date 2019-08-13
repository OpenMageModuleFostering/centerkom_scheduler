<?php

class Centerkom_Scheduler_Adminhtml_ConfigController extends Mage_Adminhtml_Controller_Action
{
   
	public function indexAction() {
		$this->loadLayout();
		$this->_setActiveMenu('system');
		
		$block = $this->getLayout()->createBlock('scheduler/adminhtml_config_list');

        $this->_addContent($block);
        
		$this->renderLayout();
	}
}