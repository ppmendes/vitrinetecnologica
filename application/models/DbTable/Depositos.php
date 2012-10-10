<?php

class Application_Model_DbTable_Depositos extends Zend_Db_Table_Abstract
{

   	protected $_name = 'depositos';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_Solucoes' => array(
		    'columns'           => 'solucoes_id',
		    'refTableClass'     => 'Application_Model_DbTable_Solucoes',
		    'refColumns'        => 'id'
		),
	);

}

