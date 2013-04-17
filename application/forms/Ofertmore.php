<?php

class Application_Form_Ofertmore extends Zend_Form
{

    public function init()
    {
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
            'required' => true,
                    'multiOptions' => ""
                )
        );
    }


}

