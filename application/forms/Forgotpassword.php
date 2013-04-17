<?php

class Application_Form_Forgotpassword extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'auth', 'action' => 'forgotpassword'
                ));

        $this->setAction($url);
        $this->addElement(
                'text', 'username', array(
            'label' => 'Użytkownik:',
            'required' => true,
            'filters' => array('StringTrim'),
                )
        );

        $this->addElement(
                'text', 'email', array(
            'label' => 'E-mail:',
            'required' => true,
            'filters' => array('StringTrim'),
                )
        );
        $this->email->addValidator(new My_Validate_User());

        $this->addElement(
                'submit', 'submit', array(
            'ignore' => true,
            'label' => 'Zresetuj hasło',
                )
        );
    }

}

