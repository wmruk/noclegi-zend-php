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

        $this->addElement(
                'text', 'type', array(
            'label' => 'Typ działalności',
            'required' => true
                )
        );

        $this->addElement(
                'text', 'country', array(
            'label' => 'Kraj',
            'required' => true
                )
        );

        $this->addElement(
                'text', 'region', array(
            'label' => 'Region',
            'required' => true
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

