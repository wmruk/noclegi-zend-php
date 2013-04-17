<?php

class IndexController extends Zend_Controller_Action {

    public function adminAction() {
        
    }

    public function userAction() {
        
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            return $this->_helper->redirector(
                            'index', 'auth', 'default'
            );
        }
        $this->view->identity = $auth->getIdentity();

   
        $User = new Application_Model_DbTable_User();
        $select = $User->select()->where('username = ?', $auth->getIdentity());
        $u = $User->fetchRow($select);
        $this->view->admin = $u->status;
    }

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

}

