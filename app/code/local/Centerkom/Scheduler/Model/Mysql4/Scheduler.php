<?php
class Centerkom_Scheduler_Model_Mysql4_Scheduler extends Mage_Core_Model_Mysql4_Abstract
{
     public function _construct()
     {
         $this->_init('scheduler/scheduler', 'schedule_id');
     }
}