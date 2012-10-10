<?php

class Application_Model_DbTable_Solucoes extends Zend_Db_Table_Abstract
{

   	protected $_name = 'solucoes_tecnologicas';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_FasesDesenvolvimentos' => array(
		    'columns'           => 'fases_desenvolvimentos_id',
		    'refTableClass'     => 'Application_Model_DbTable_FasesDesenvolvimentos',
		    'refColumns'        => 'id'
		),
	);
}

