<?php

class Application_Form_Userdata extends Zend_Form {

    public function init() {


        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'setting', 'action' => 'updateuserdata'
                ));
        $this->setAction($url);


        $auth = Zend_Auth::getInstance();

        $tableUser = new Application_Model_DbTable_User();
        $select = $tableUser->select()->where('username = ?', $auth->getIdentity());
        $u = $tableUser->fetchRow($select);



        $this->addElement(
                'text', 'username', array(
            'label' => 'Login:',
            'validators' => array(
            ),
            'value' => $auth->getIdentity(),
            'attribs' => array('disabled' => 'disabled')
                )
        );


        $this->addElement(
                'text', 'email', array(
            'label' => 'Adres e-mail:',
            'required' => true,
            'filters' => array('StringTrim'),
            'value' => $u->email
                )
        );

        $this->addElement(
                'text', 'name', array(
            'label' => 'Imię: ',
            'required' => true,
            'filters' => array('StringTrim'),
            'value' => $u->name
        ));

        $this->addElement(
                'text', 'surname', array(
            'label' => 'Nazwisko: ',
            'required' => true,
            'filters' => array('StringTrim'),
            'value' => $u->surname
        ));

        $this->addElement(
                'text', 'place', array(
            'label' => 'Miejscowosc: ',
            'required' => true,
            'filters' => array('StringTrim'),
            'value' => $u->place
        ));


        $this->addElement(
                'submit', 'submit', array(
            'ignore' => true,
            'label' => 'Zapisz zmiany',
                )
        );
    }

}

