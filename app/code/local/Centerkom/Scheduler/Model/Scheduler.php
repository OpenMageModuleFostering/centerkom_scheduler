<?php
class Centerkom_Scheduler_Model_Scheduler extends Mage_Core_Model_Abstract
{
     public function _construct()
     {
         parent::_construct();
         $this->_init('scheduler/scheduler');
     }
     
     
     public function run()
     {
         $collection = $this->getCollection()
                            ->addFieldToFilter('scheduled_at', array("lteq"=> date('Y-m-d H:i:s', Mage::getModel('core/date')->timestamp(time())) ))
                            ->addFieldToFilter('executed_at', array("null"=>true));
                            //echo "ilosc : ".count($collection)." zap : ".$collection->getSelect();
                
         foreach($collection as $key=>$item)
         {
             //var_dump($item->getData());
             $item->setExecutedAt(date('Y-m-d H:i:s', Mage::getModel('core/date')->timestamp(time())));
             $item->setStatus('running');
             $item->save();
             
             try 
             {
                $success=eval( $item->getJobCode() );
                if($success===false)
                {
                    $item->setMessages ('Error: could not run expression.');
                    $item->setStatus('error');
                }
                else
                {
                    $item->setMessages ($success);
                    $item->setStatus('success');
                }
             }
             catch (Exception $e)
             {
                 $item->setMessages($e->getMessage());
                 $item->setStatus('error');                 
             }
             
             $item->setFinishedAt(date('Y-m-d H:i:s', Mage::getModel('core/date')->timestamp(time())));
             $item->save();
         }       
     } 
}