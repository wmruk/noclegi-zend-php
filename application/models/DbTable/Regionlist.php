<?php

class Application_Model_DbTable_Regionlist extends Zend_Db_Table_Abstract
{

    protected $_name = 'regionlist';

    public function getRegionList(){
        $createTable = new Application_Model_DbTable_Regionlist();
        $getRegions = $createTable->fetchAll();
        
        return $getRegions;
    }
    
}

