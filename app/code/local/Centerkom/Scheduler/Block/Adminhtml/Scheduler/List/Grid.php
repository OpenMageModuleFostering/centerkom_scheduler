<?php
class Centerkom_Scheduler_Block_Adminhtml_Scheduler_List_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
	    $collection = Mage::getModel('cron/schedule')->getCollection();
	    $this->setCollection($collection);

        return parent::_prepareCollection();
   }
   
   /*
    * TO DO
    */
	//protected function _prepareMassaction() {
	//	$this->setMassactionIdField('job_code');
	//	$this->getMassactionBlock()->setFormFieldName('job_code');
	//	$this->getMassactionBlock()->addItem('delete', array(
	//		'label' => 'Delete',
	//		'url' => $this->getUrl('*/*/delete'),
	//	));
	//	return $this;
	//}
   
   
   
	protected function _prepareColumns() {

		$this->addColumn('job_code', array (
			'header' => 'Code',
			'index' => 'job_code',
			'frame_callback' => array($this, 'decorateCode')
		));
		$this->addColumn('created_at', array (
			'header' => 'Created',
			'index' => 'created_at'
		));
		$this->addColumn('scheduled_at', array (
			'header' => 'Scheduled',
			'index' => 'scheduled_at'
		));
		$this->addColumn('executed_at', array (
			'header' => 'Executed',
			'index' => 'executed_at'
		));
		$this->addColumn('finished_at', array (
			'header' => 'Finished',
			'index' => 'finished_at'
		));	
		$this->addColumn('messages', array (
			'header' =>'Messages',
			'index' => 'messages'
		));	
		$this->addColumn('status', array (
			'header' => 'Status',
			'index' => 'status',
			'frame_callback' => array($this, 'decorateStatus')
		));		
		

		return parent::_prepareColumns();
	}
    
	
	/**
	 * Dodaje do kolumny z nazwa zadania
	 * nazwe wywoluwanej metody
	 */
	public function decorateCode($value) {
		$return = '';
		if (!empty($value)) {
			$return .= '<b>'.$value.'</b>';
			$return .= '<br />';
			//pobiera dane o codzie z konfiga
			$tmp = Mage::getModel('scheduler/crons')->getDataFromConfig($value);
			$return .= $tmp[2];
			$return .= "<br />";
			$return .= $tmp[3];
		}
		return $return;
	}
	
	
	/**
	 * Decorate status values
	 *
	 * @return string
	 */
	public function decorateStatus($status) {
		switch ($status) {
			case 'success':
				$result = '<span class="bar-green"><span>'.$status.'</span></span>';
				break;
			case 'pending':
				$result = '<span class="bar-lightgray"><span>'.$status.'</span></span>';
				break;
			case 'running':
				$result = '<span class="bar-yellow"><span>'.$status.'</span></span>';
				break;
			case 'missed':
				$result = '<span class="bar-orange"><span>'.$status.'</span></span>';
				break;
			case 'error':
				$result = '<span class="bar-red"><span>'.$status.'</span></span>';
				break;
			default:
				$result = $status;
				break;
		}
		return $result;
	}
    
    
}