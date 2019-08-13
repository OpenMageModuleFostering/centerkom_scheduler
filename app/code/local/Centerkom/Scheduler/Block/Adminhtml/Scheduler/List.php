<?php
class Centerkom_Scheduler_Block_Adminhtml_Scheduler_List extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct(){
        $this->_controller = 'adminhtml_scheduler_list';
        $this->_blockGroup = 'scheduler';
        $this->_headerText = 'System jobs View';
        parent::__construct();
    }
    
	/**
	 * Prepare layout
	 *
	 * @return Centerkom_Scheduler_Block_Adminhtml_Scheduler_List
	 */
	protected function _prepareLayout() {
		$this->removeButton('add');

		return parent::_prepareLayout();
	}    

}