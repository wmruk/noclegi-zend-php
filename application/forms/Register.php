<?php

class Application_Form_Register extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'auth', 'action' => 'register'
                ));
        $this->setAction($url);


        $this->addElement(
                'text', 'username', array(
            'label' => 'Login:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                array(
                    'Db_NoRecordExists',
                    true,
                    array('table' => 'user', 'field' => 'username')
                ),
            )
                )
        );


        $this->addElement(
                'text', 'email', array(
            'label' => 'Adres e-mail:',
            'required' => true,
            'filters' => array('StringTrim'),
                )
        );

        $this->addElement(
                'password', 'password', array(
            'label' => 'Hasło:',
            'required' => true,
                )
        );

        $this->addElement(
                'password', 'password2', array(
            'label' => 'Powtórz hasło:',
            'required' => true,
                )
        );
        $this->password2->addValidator(new My_Validate_Password());

        $this->addElement(
                'text', 'name', array(
            'label' => 'Imię: ',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement(
                'text', 'surname', array(
            'label' => 'Nazwisko: ',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $value = array(1 => "Mezczyzna", 2 => "Kobieta");

        $this->addElement(
                'select', 'sex', array(
            'label' => 'Płeć: ',
            'required' => true,
            'filters' => array('StringTrim'),
            'multiOptions' => $value
        ));

        $this->addElement(
                'text', 'place', array(
            'label' => 'Miejscowosc: ',
            'required' => true,
            'filters' => array('StringTrim')
        ));


        $this->addElement(
                'submit', 'submit', array(
            'ignore' => true,
            'label' => 'Zarejestruj',
                )
        );
    }

}