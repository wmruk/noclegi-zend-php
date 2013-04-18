<?php

class Application_Form_Deleteactivitylist extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'admin', 'action' => 'deletetype'
                ));

        $this->setAction($url);

        $tableActivityList = new Application_Model_DbTable_Buildingtype();
        

        $activityList = array();
        foreach ($tableActivityList->getBuildingType() as $value) {
            $activityList += array($value['buildingType_id'] => $value['type']);
        }

        $this->addElement(
                'select', 'activity_id', array(
            'label' => 'Typy działalności:',
            'required' => true,
            'multiOptions' => $activityList
                )
        );

        $this->addElement(
                'submit', 'submit', array(
            'ignore' => true,
            'label' => 'Usuń',
                )
        );
    }

}

