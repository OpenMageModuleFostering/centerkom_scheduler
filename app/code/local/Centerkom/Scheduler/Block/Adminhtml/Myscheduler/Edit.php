<?php 
class Centerkom_Scheduler_Block_Adminhtml_Myscheduler_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        
        $this->_objectId = 'id';
        $this->_blockGroup = 'scheduler';
        $this->_controller = 'adminhtml_myscheduler_list';
        $this->_mode = 'edit';
 
        $this->_updateButton('save', 'label', 'Save');
    }
    
    public function getHeaderText()
    {
        if ($this->getRequest()->getParam('id'))
        {
            return 'Edit job id : '.$this->getRequest()->getParam('id');
        } else {
            return 'New Example';
        }
    }    
    
    protected function _prepareLayout()
    {
        if ($this->_blockGroup && $this->_controller && $this->_mode) {
            $this->setChild('form', $this->getLayout()->createBlock('scheduler/adminhtml_myscheduler_edit_form'));
        }
        return parent::_prepareLayout();
    }    
 
}