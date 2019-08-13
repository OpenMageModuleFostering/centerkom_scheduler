<?php
 
class Centerkom_Scheduler_Block_Adminhtml_Myscheduler_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        

        if($this->getRequest()->getParam('id'))
        {
            $data = Mage::getModel('scheduler/scheduler')
                ->getCollection()
                ->addFieldToFilter('schedule_id', $this->getRequest()->getParam('id'))
                ->getFirstItem()
                ->getData();
                
            $data['time']=$time[0] = date('H,i,s', strtotime($data['scheduled_at']));
            $data['date'] = date('Y-m-d', strtotime($data['scheduled_at']));
            //var_dump($data);
            
            $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data',
            ));
        }
        else 
        {
            $data = Array();
            
            $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/add'),
                'method' => 'post',
                'enctype' => 'multipart/form-data',
            ));            
        }
        //var_dump($data);
        

 
        $form->setUseContainer(true);
 
        $this->setForm($form);
 
        $fieldset = $form->addFieldset('example_form', array(
             'legend' =>'Job data'
        ));
 
        $fieldset->addField('job_name', 'text', array(
             'label'     => Mage::helper('adminhtml')->__('Name'),
             'class'     => 'required-entry',
             'required'  => true,
             'name'      => 'job_name',
             //'note'     => 'The name of the example.',
        ));
 
        $fieldset->addField('time', 'time', array(
             'label'     => Mage::helper('adminhtml')->__('Start time'),
             'class'     => 'required-entry',
             'required'  => true,
             'name'      => 'time'
        ));
 
        $fieldset->addField('date', 'date', array(
          'label'     => Mage::helper('adminhtml')->__('Start date'),
          'class'     => 'required-entry',
          'image' => $this->getSkinUrl('images/grid-cal.gif'),
          'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
           'name'      => 'date'
        ));
        
        $fieldset->addField('job_code', 'textarea', array(
          'label'     => Mage::helper('adminhtml')->__('Code'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'job_code',
          'style'=>'width:800px;height:500px;',
          'onclick' => "",
          'onchange' => "",
          'disabled' => false,
          'tabindex' => 1
        ));
 
        $form->setValues($data);
 
        return parent::_prepareForm();
    }
}