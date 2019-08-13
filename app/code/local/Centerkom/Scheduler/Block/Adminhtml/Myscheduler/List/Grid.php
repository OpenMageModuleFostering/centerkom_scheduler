<?php
class Centerkom_Scheduler_Block_Adminhtml_Myscheduler_List_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
	    $collection = Mage::getModel('scheduler/scheduler')->getCollection();
	    $this->setCollection($collection);

        return parent::_prepareCollection();
   }
   
   
	protected function _prepareColumns() {
 
		$this->addColumn('schedule_id', array (
			'header' => 'Id',
			'index' => 'schedule_id'
		));
		$this->addColumn('job_name', array (
			'header' => 'Name',
			'index' => 'job_name'
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
			'index' => 'messages',
			'frame_callback' => array($this, 'decorateMessages')		
		));	
		$this->addColumn('status', array (
			'header' => 'Status',
			'index' => 'status',
			'frame_callback' => array($this, 'decorateStatus')
		));		
		

		return parent::_prepareColumns();
	}
	
	
	public function decorateMessages($messages) {
	    return htmlspecialchars_decode($messages);
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
	
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'store'=>$this->getRequest()->getParam('store'),
            'id'=>$row->getSchedule_id ())
        );
    }	
    
}