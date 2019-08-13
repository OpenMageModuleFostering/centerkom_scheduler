<?php
class Centerkom_Scheduler_Block_Adminhtml_Config_List extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct(){
        $this->_controller = 'adminhtml_config_list';
        $this->_blockGroup = 'scheduler';
        $this->_headerText = 'System cron list';
        parent::__construct();
    }
    
	/**
	 * Prepare layout
	 *
	 * @return Centerkom_Scheduler_Block_Adminhtml_Config_List
	 */
	protected function _prepareLayout() {
		$this->removeButton('add');

		return parent::_prepareLayout();
	}    

}