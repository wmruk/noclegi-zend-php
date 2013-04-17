<?php

class Application_Form_Deletelistregion extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'admin', 'action' => 'deleteregion'
                ));

        $this->setAction($url);

        $tableRegionList = new Application_Model_DbTable_Regionlist();

        $regionList = array();
        foreach ($tableRegionList->getRegionList() as $value) {
            $regionList += array($value['regionList_id'] => $value['name']);
        }

        $this->addElement(
                'select', 'region_id', array(
            'label' => 'Regiony:',
            'required' => true,
            'multiOptions' => $regionList
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

