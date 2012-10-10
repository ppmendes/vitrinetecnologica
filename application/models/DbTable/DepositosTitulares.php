<?php

class Application_Model_DbTable_DepositosTitulares extends Zend_Db_Table_Abstract
{

   	protected $_name = 'depositos_has_titular';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_Depositos' => array(
		    'columns'           => 'depositos_id',
		    'refTableClass'     => 'Application_Model_DbTable_Depositos',
		    'refColumns'        => 'id'
		),
		'Application_Model_DbTable_Titulares' => array(
		    'columns'           => 'titular_id',
		    'refTableClass'     => 'Application_Model_DbTable_Titulares',
		    'refColumns'        => 'id'
		),
	);

}

