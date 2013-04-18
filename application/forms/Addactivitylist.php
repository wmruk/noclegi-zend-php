<?php

class Application_Form_Addactivitylist extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'admin', 'action' => 'addactivitytype'
                ));
        $this->setAction($url);

        $this->addElement(
                'text', 'newActivity', array(
            'label' => 'Nazwa:',
            'required' => true,
            'filters' => array('StringTrim'),
                )
        );

        $this->addElement(
                'submit', 'submit', array(
            'ignore' => true,
            'label' => 'Dodaj',
                )
        );
    }

}

