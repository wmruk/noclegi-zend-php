<?php

class Application_Form_Changepassword extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'setting', 'action' => 'changepassword'
                ));

        $this->setAction($url);

        $this->addElement(
                'password', 'password', array(
            'label' => 'Nowe hasło:',
            'required' => true,
                )
        );

        $this->addElement(
                'password', 'password2', array(
            'label' => 'Powtórz nowe hasło:',
            'required' => true,
                )
        );

        $this->password2->addValidator(new My_Validate_Password());

        $this->addElement(
                'submit', 'submit', array(
            'ignore' => true,
            'label' => 'Zmień hasło',
                )
        );
    }

}

