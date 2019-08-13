<?php
class Centerkom_Scheduler_Block_Adminhtml_Config_List_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('scheduler_grid');
       $this->setDefaultSort('scheduled_at');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);   	
   }
   
   
   protected function _prepareCollection()
   {
	    $collection = Mage::getModel('scheduler/crons');
	    $this->setCollection($collection);

        return parent::_prepareCollection();
   }
   
   
	protected function _prepareColumns() {

		$this->addColumn('code', array (
			'header' => 'Code',
			'index' => 'code'
		));	
		$this->addColumn('cron_expr', array (
			'header' => 'Cron Expression',
			'index' => 'cron_expr'
		));
		$this->addColumn('model', array (
			'header' => 'Model',
			'index' => 'model'
		));	
		$this->addColumn('class', array (
			'header' => 'Class',
			'index' => 'class'
		));				

		return parent::_prepareColumns();
	}
}