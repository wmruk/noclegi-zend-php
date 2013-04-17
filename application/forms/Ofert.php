<?php

class Application_Form_Ofert extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'ofert', 'action' => 'index'
                ));
        $this->setAction($url);


        $auth = Zend_Auth::getInstance();

        $this->addElement(
                'text', 'buildingName', array(
            'label' => 'Nazwa obiektu:',
            'required' => true
                )
        );

        $tableBuildingType = new Application_Model_DbTable_Buildingtype();
        $typeList = array();
        foreach ($tableBuildingType->getBuildingType() as $value) {
            $typeList += array($value['buildingType_id'] => $value['type']);
        }

        $this->addElement(
                'select', 'type', array(
            'label' => 'Typ działalności',
            'required' => true,
            'multiOptions' => $typeList
                )
        );

        $this->addElement(
                'text', 'country', array(
            'label' => 'Kraj',
            'required' => true
                )
        );

        $tableRegionList = new Application_Model_DbTable_Regionlist();
        $regionList = array();
        foreach ($tableRegionList->getRegionList() as $value) {
            $regionList += array($value['regionList_id'] => $value['name']);
        }

        $this->addElement(
                'select', 'region', array(
            'label' => 'Region',
            'required' => true,
            'multiOptions' => $regionList
                )
        );

        $provinceList = array(
            'dolnośląskie' => 'dolnośląskie',
            'kujawsko-pomorskie' => 'kujawsko-pomorskie',
            'lubelskie' => 'lubelskie',
            'lubuskie' => 'lubuskie',
            'łódzkie' => 'łódzkie',
            'małopolskie' => 'małopolskie',
            'mazowieckie' => 'mazowieckie',
            'opolskie' => 'opolskie',
            'podkarpackie' => 'podkarpackie',
            'podlaskie' => 'podlaskie',
            'pomorskie' => 'pomorskie',
            'śląskie' => 'śląskie',
            'świętokrzyskie' => 'świętokrzyskie',
            'warmińsko-mazurskie' => 'warmińsko-mazurskie',
            'wielkopolskie' => 'wielkopolskie',
            'zachodniopomorskie' => 'zachodniopomorskie'
        );


        $this->addElement(
                'select', 'province', array(
            'label' => 'Województwo',
            'required' => true,
            'multiOptions' => $provinceList
                )
        );

        $this->addElement(
                'text', 'city', array(
            'label' => 'Miasto',
            'required' => true
                )
        );
    }

}

