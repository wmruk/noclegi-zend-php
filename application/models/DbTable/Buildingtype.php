<?php

class Application_Model_DbTable_Buildingtype extends Zend_Db_Table_Abstract
{

    protected $_name = 'buildingtype';
    
    public function getBuildingType(){
        $createTable = new Application_Model_DbTable_Buildingtype();
        $getType = $createTable->fetchAll();
        
        return $getType;
    }
    

}

