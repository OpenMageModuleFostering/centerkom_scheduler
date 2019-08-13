<?php

class Centerkom_Scheduler_Adminhtml_MyschedulerController extends Mage_Adminhtml_Controller_Action
{
   
	public function indexAction() {

		$this->loadLayout();
		$this->_setActiveMenu('system');
		
		$block = $this->getLayout()->createBlock('scheduler/adminhtml_myscheduler_list');

        $this->_addContent($block);
        
		$this->renderLayout();
	}
	
	public function editAction() {
		$this->loadLayout();
		$this->_setActiveMenu('system');
		
		$block = $this->getLayout()->createBlock('scheduler/adminhtml_myscheduler_edit');

        $this->_addContent($block);
        
		$this->renderLayout();
	}
	
	public function newAction() {
		$this->loadLayout();
		$this->_setActiveMenu('system');
		
		$block = $this->getLayout()->createBlock('scheduler/adminhtml_myscheduler_edit');

        $this->_addContent($block);
        
		$this->renderLayout();
	}

	public function addAction() {
	    
    	if ($data = $this->getRequest()->getPost()) {
    	     $data['scheduled_at'] = $data['date']." ".$data['time'][0].":".$data['time'][1].":".$data['time'][2];
    	     //var_dump($data);
    	     $model = Mage::getModel('scheduler/scheduler');
             $model->addData($data);
             $model->save(); 
             
             $session = Mage::getSingleton('adminhtml/session');
             $session->addSuccess(Mage::helper('adminhtml')->__('Added new job.'));
    	}
    	$this->_redirect('*/*/', array('_current' => array('section', 'website', 'store')));
	}
	
	public function saveAction() {
	    
    	if ($data = $this->getRequest()->getPost()) {
    	    $data['scheduled_at'] = $data['date']." ".$data['time'][0].":".$data['time'][1].":".$data['time'][2];
    	    $data['schedule_id'] = $this->getRequest()->getParam('id');
    	     //var_dump($data);
    	     $model = Mage::getModel('scheduler/scheduler')
                ->getCollection()
                ->addFieldToFilter('schedule_id', $this->getRequest()->getParam('id'))
                ->getFirstItem();
                
             $model->setData($data);
             $model->save(); 
             
             $session = Mage::getSingleton('adminhtml/session');
             $session->addSuccess(Mage::helper('adminhtml')->__('Added new job.'));
    	}
    	$this->_redirect('*/*/', array('_current' => array('section', 'website', 'store')));
	}
}