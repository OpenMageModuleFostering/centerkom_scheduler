<?php
class Centerkom_Scheduler_Model_Crons extends Varien_Data_Collection {
    
    
    
	public function loadData($printQuery = false, $logQuery = false) {
		if ($this->_dataLoaded) {
			return $this;
		}

		foreach ($this->getDataFromConfig() as $val)
		{
		    $this->addItem(new Varien_Object(array('code' => $val[0],
                                          'cron_expr' => $val[1],
                                          'model' => $val[2],
		                                  'class' => $val[3])));
		}

		$this->_dataLoaded = true;
		return $this;
	}
	
	
	
	/**
	 * 
	 * Pobiera dane z konfigu zwraca w postaci tablicy
	 */
	public function getDataFromConfig($code = null)
	{
	   $data = Array();

       $config = Mage::getConfig()->getNode('crontab/jobs');
       if ($config instanceof Mage_Core_Model_Config_Element) {
			foreach ($config->children() as $key => $val) {
				if (!isset($data[$key])) {
					$data[$key][0] = $key;
					$data[$key][1] = $val->schedule->cron_expr;
					$data[$key][2] = $val->run->model;
					$tmp = explode("::", $val->run->model);
					$data[$key][3] = get_class(Mage::getConfig()->getModelInstance($tmp[0]));
				};
			}
    	}
    	
       $config = Mage::getConfig()->getNode('default/crontab/jobs');
       if ($config instanceof Mage_Core_Model_Config_Element) {
			foreach ($config->children() as $key => $val) {
				if (!isset($data[$key])) {
					$data[$key][0] = $key;
					$data[$key][1] = $val->schedule->cron_expr;
					$data[$key][2] = $val->run->model;
					$data[$key][3] = get_class(Mage::getConfig()->getModelInstance($key));
					$tmp = explode("::", $val->run->model);
					$data[$key][3] = get_class(Mage::getConfig()->getModelInstance($tmp[0]));
				};
			}
    	}
        if($code==null)
    	    return $data;
    	else
    	{
    	    return $data[$code];
    	}
	}
    
}