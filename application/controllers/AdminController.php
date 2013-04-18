<?php

class AdminController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function editusersAction() {

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            return $this->_helper->redirector(
                            'index', 'auth', 'default'
            );
        }
        $this->view->identity = $auth->getIdentity();
        $users = new Application_Model_DbTable_User();
        $getUsers = $users->fetchAll();
        $select = $users->select()->where('username = ?', $auth->getIdentity());
        $u = $users->fetchRow($select);
        $this->view->admin = $u->status;


        $this->view->getUsers = $getUsers;
    }

    public function deleteuserAction() {
        $user = new Application_Model_DbTable_User();
        $users_id = $_GET['user_id'];
        $user->delete(array('users_id = ?' => $users_id));

        return $this->_helper->redirector(
                        'editusers', 'admin', 'default'
        );
    }

    public function setadminAction() {
        $user = new Application_Model_DbTable_User();
        $users_id = $_GET['user_id'];
        $user->update(array('status' => '1'), array('users_id = ?' => $users_id));

        return $this->_helper->redirector(
                        'editusers', 'admin', 'default'
        );
    }

    public function setuserAction() {
        $user = new Application_Model_DbTable_User();
        $users_id = $_GET['user_id'];
        $user->update(array('status' => '0'), array('users_id = ?' => $users_id));

        return $this->_helper->redirector(
                        'editusers', 'admin', 'default'
        );
    }

    public function typelistAction() {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            return $this->_helper->redirector(
                            'index', 'auth', 'default'
            );
        }
        $this->view->identity = $auth->getIdentity();
        $users = new Application_Model_DbTable_User();
        $select = $users->select()->where('username = ?', $auth->getIdentity());
        $u = $users->fetchRow($select);
        $this->view->admin = $u->status;

        $regionsListTable = new Application_Model_DbTable_Regionlist();
        $buildingTypeTable = new Application_Model_DbTable_Buildingtype();

        $this->view->regionsList = $regionsListTable->fetchAll();
        $this->view->buildingType = $buildingTypeTable->fetchAll();
        $this->view->addRegion = new Application_Form_Addlistregion();
        $this->view->regionList = new Application_Form_Deletelistregion();
        $this->view->addActivityType = new Application_Form_Addactivitylist();
        $this->view->activityTypeList = new Application_Form_Deleteactivitylist();
    }

    public function addregionAction() {
        $form = new Application_Form_Addlistregion();
        if ($form->isValid($this->getRequest()->getPost())) {
            $regionTable = new Application_Model_DbTable_Regionlist();
            $insertData = array(
                'name' => $form->getValue('newRegion')
            );
            $regionTable->insert($insertData);

            return $this->_helper->redirector(
                            'typelist', 'admin', 'default'
            );
        }
    }

    public function deleteregionAction() {
        $form = new Application_Form_Deletelistregion();
        if ($form->isValid($this->getRequest()->getPost())) {
            $regionTable = new Application_Model_DbTable_Regionlist();
            $regionTable->delete(array('regionList_id = ?' => $form->getValue('region_id')));
        }

        return $this->_helper->redirector(
                        'typelist', 'admin', 'default'
        );
    }

    public function addactivitytypeAction() {
        $form = new Application_Form_Addactivitylist();
        if ($form->isValid($this->getRequest()->getPost())) {
            $buildingTable = new Application_Model_DbTable_Buildingtype();
            $insertData = array(
                'type' => $form->getValue('newActivity')
            );
            $buildingTable->insert($insertData);

            return $this->_helper->redirector(
                            'typelist', 'admin', 'default'
            );
        }
    }

    public function deletetypeAction() {
        $form = new Application_Form_Deleteactivitylist();
        if ($form->isValid($this->getRequest()->getPost())) {
            $activityTypeTable = new Application_Model_DbTable_Buildingtype();
            $activityTypeTable->delete(array('buildingType_id = ?' => $form->getValue('activity_id')));
        }

        return $this->_helper->redirector(
                        'typelist', 'admin', 'default'
        );
    }

}