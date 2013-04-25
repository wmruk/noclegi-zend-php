<?php

class AuthController extends Zend_Controller_Action {

    public function indexAction() {
        $this->view->form = new Application_Form_Login();
    }

    public function isAdmin($username) {
        $User = new Application_Model_DbTable_User();
        $select = $User->select()->where('username = ?', $username);
        $u = $User->fetchRow($select);
        if ($u->status == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function loginAction() {
        $this->_helper->viewRenderer('index');
        $form = new Application_Form_Login();
        if ($form->isValid($this->getRequest()->getPost())) {

            $adapter = new Zend_Auth_Adapter_DbTable(
                            null,
                            'user',
                            'username',
                            'password',
                            'MD5(CONCAT(?, salt))'
            );

            $adapter->setIdentity($form->getValue('username'));
            $adapter->setCredential($form->getValue('password'));
            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);

            if ($result->isValid()) {
                return $this->_helper->redirector(
                                'index', 'index', 'default'
                );
            }
            $form->password->addError('Błędna próba logowania!');
        }
        $this->view->form = $form;
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->_helper->redirector(
                        'index', 'index', 'default'
        );
    }

    public function registerformAction() {
        $this->view->form = new Application_Form_Register();
    }

    public function registerAction() {
        $this->_helper->viewRenderer('registerform');
        $form = new Application_Form_Register();

        if ($form->isValid($this->getRequest()->getPost())) {
            $User = new Application_Model_DbTable_User();
            $salt = My_Salt::getSalt();
            $dane = array(
                'username' => $form->getValue('username'),
                'password' => md5($form->getValue('password') . $salt),
                'salt' => $salt,
                'email' => $form->getValue('email'),
                'name' => $form->getValue('name'),
                'surname' => $form->getValue('surname'),
                'sex' => $form->getValue('sex'),
                'place' => $form->getValue('place'),
                'status' => '0'
            );

            $User->createRow($dane)->save();

            return $this->_helper->redirector(
                            'index', 'index', 'default'
            );
        }
        $this->view->form = $form;
    }

    public function forgotpasswordformAction() {
        $this->view->form = new Application_Form_Forgotpassword();
    }

    public function forgotpasswordAction() {
        $this->_helper->viewRenderer('forgotpasswordform');
        $form = new Application_Form_Forgotpassword();

        if ($form->isValid($this->getRequest()->getPost())) {

            $User = new Application_Model_DbTable_User();
            $select = $User->select()->where('username = ?', $form->getValue('username'));
            $u = $User->fetchRow($select);

            $password = My_Salt::randomPassword();
            $salt = My_Salt::getSalt();

            $u->salt = $salt;
            $u->password = $password . $salt;
            $u->save();

            $mail = new My_Mail_Gmail();
            $mail->mailNewPassword($u->email, $password);

            return $this->_helper->redirector(
                            'index', 'auth-true', 'default'
            );
        }
        $this->view->form = $form;
    }

}
