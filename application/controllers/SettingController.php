<?php

class SettingController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            return $this->_helper->redirector(
                            'index', 'auth', 'default'
            );
        }
        $this->view->form = new Application_Form_Changepassword();
        $this->view->userData = new Application_Form_UserData();
        $this->view->identity = $auth->getIdentity();


        $User = new Application_Model_DbTable_User();
        $select = $User->select()->where('username = ?', $auth->getIdentity());
        $u = $User->fetchRow($select);
        $this->view->admin = $u->status;
    }

    public function updateuserdataAction() {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            return $this->_helper->redirector(
                            'index', 'auth', 'default'
            );
        }

        $tableUser = new Application_Model_DbTable_User();
        $select = $tableUser->select()->where('username = ?', $auth->getIdentity());
        $u = $tableUser->fetchRow($select);

        $form = new Application_Form_UserData();
        $form->isValid($this->getRequest()->getPost());

        if ($form->getValue('email') != "" && $form->getValue('name') != ""
                && $form->getValue('surname') != "" && $form->getValue('place') != "") {
            $u->email = $form->getValue('email');
            $u->name = $form->getValue('name');
            $u->surname = $form->getValue('surname');
            $u->place = $form->getValue('place');
            $u->save();
        }
        return $this->_helper->redirector(
                        'index', 'setting', 'default'
        );
    }

    public function changepasswordAction() {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            return $this->_helper->redirector(
                            'index', 'auth', 'default'
            );
        }
        $User = new Application_Model_DbTable_User();
        $select = $User->select()->where('username = ?', $auth->getIdentity());
        $u = $User->fetchRow($select);
        $form = new Application_Form_Changepassword();

        if ($u && $form->isValid($this->getRequest()->getPost())) {

            $password = $form->getValue('password');
            $salt = My_Salt::getSalt();

            $u->salt = $salt;
            $u->password = md5($password . $salt);
            $u->save();

            //$mail = new My_Mail_Gmail();
            //$mail->mailNewPassword($u->email, $password);

            return $this->_helper->redirector(
                            'index', 'setting', 'default'
            );
        }
        $this->view->form = $form;
    }

}