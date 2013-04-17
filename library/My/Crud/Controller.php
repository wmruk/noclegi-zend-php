<?php

class My_Crud_Controller extends Zend_Controller_Action
{

    /*
     * Properties:
     *    $_db_table_class
     *    $_form_class
     * should be set inside init() method.
     */
    protected $_db_table_class = 'Zend_Db_Table';
    protected $_form_class = 'Zend_Form';


    public function indexAction()
    {
        $DbTable = new $this->_db_table_class;
        $this->view->objects = $DbTable->fetchAll();
    }

    public function createformAction()
    {
        $this->view->form = new $this->_form_class;
        $url = $this->view->url(
            array(
                'action' => 'create',
                'controller' => $this->getRequest()->getControllerName(),
                'module' => $this->getRequest()->getModuleName(),
            ),
            'default',
            true
        );
        $this->view->form->setAction($url);
    }

    public function createAction()
    {
        if ($this->getRequest()->isPost()) {
            $form = new $this->_form_class;
            if ($form->isValid($this->getRequest()->getPost())) {
                $data = $form->getValues();
                $DbTable = new $this->_db_table_class;
                $id = $DbTable->createRow($data)->save();
                return $this->_helper->redirector(
                    'edit',
                    $this->getRequest()->getControllerName(),
                    $this->getRequest()->getModuleName(),
                    array('id' => $id)
                );
            }
            $this->view->form = $form;
        } else {
            throw new Zend_Controller_Action_Exception('Błędny adres!', 404);
        }
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        $DbTable = new $this->_db_table_class;
        $obj = $DbTable->find($id)->current();
        if (!$obj) {
            throw new Zend_Controller_Action_Exception('Błędny adres!', 404);
        }
        $obj->delete();
        return $this->_helper->redirector(
            'index',
            $this->getRequest()->getControllerName(),
            $this->getRequest()->getModuleName()
        );
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $DbTable = new $this->_db_table_class;
        $obj = $DbTable->find($id)->current();
        if (!$obj) {
            throw new Zend_Controller_Action_Exception('Błędny adres!', 404);
        }
        $this->view->form = new $this->_form_class;
        $this->view->form->populate($obj->toArray());
        $url = $this->view->url(
            array(
                'action' => 'update',
                'controller' => $this->getRequest()->getControllerName(),
                'module' => $this->getRequest()->getModuleName(),
                'id' => $id
            ),
            'default',
            true
        );
        $this->view->form->setAction($url);
        $this->view->object = $obj;
    }

    public function updateAction()
    {
        $id = $this->getRequest()->getParam('id');
        $DbTable = new $this->_db_table_class;
        $obj = $DbTable->find($id)->current();
        if (!$obj) {
            throw new Zend_Controller_Action_Exception('Błędny adres!', 404);
        }

        if ($this->getRequest()->isPost()) {
            $form = new $this->_form_class;
            if ($form->isValid($this->getRequest()->getPost())) {
                $data = $form->getValues();
                $obj->setFromArray($data);
                $obj->save();
                return $this->_helper->redirector(
                    'edit',
                    $this->getRequest()->getControllerName(),
                    $this->getRequest()->getModuleName(),
                    array('id' => $id)
                );
            }
            $this->view->form = $form;
        } else {
            throw new Zend_Controller_Action_Exception('Błędny adres!', 404);
        }
    }

    public function showAction()
    {
        $id = $this->getRequest()->getParam('id');
        $DbTable = new $this->_db_table_class;
        $obj = $DbTable->find($id)->current();
        if (!$obj) {
            throw new Zend_Controller_Action_Exception('Błędny adres!', 404);
        }
        $this->view->object = $obj;
    }

}
