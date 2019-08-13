<?php
class Centerkom_Scheduler_Block_Adminhtml_Myscheduler_List extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct(){
        $this->_controller = 'adminhtml_myscheduler_list';
        $this->_blockGroup = 'scheduler';
        $this->_headerText = 'User jobs View';
        parent::__construct();
    }
    
	/**
	 * Prepare layout
	 *
	 * @return Centerkom_Scheduler_Block_Adminhtml_Myscheduler_List
	 */
	protected function _prepareLayout() {

		return parent::_prepareLayout();
	}    

}