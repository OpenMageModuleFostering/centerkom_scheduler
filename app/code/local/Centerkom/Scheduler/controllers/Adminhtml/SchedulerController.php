<?php

class Centerkom_Scheduler_Adminhtml_SchedulerController extends Mage_Adminhtml_Controller_Action
{
   
	public function indexAction() {
		$this->loadLayout();
		$this->_setActiveMenu('system');
		
		$block = $this->getLayout()->createBlock('scheduler/adminhtml_scheduler_list');

        $this->_addContent($block);
        
		$this->renderLayout();
	}
}