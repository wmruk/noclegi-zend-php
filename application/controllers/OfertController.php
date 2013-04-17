<?php

class OfertController extends Zend_Controller_Action {

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
        $this->view->identity = $auth->getIdentity();

        $user = new Application_Model_DbTable_User();
        $select = $user->select()->where('username = ?', $auth->getIdentity());
        $u = $user->fetchRow($select);
        
        $this->view->userID = $u->users_id;
        
        $ofertForm = new Application_Form_Ofert();
        $this->view->ofertForm = $ofertForm;
        
        
    }

}

