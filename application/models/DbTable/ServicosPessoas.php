<?php

class Application_Model_DbTable_ServicosTiposServicos extends Zend_Db_Table_Abstract
{

   	protected $_name = 'pessoas';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_Servicos' => array(
		    'columns'           => 'servicos_tecnologicos_id',
		    'refTableClass'     => 'Application_Model_DbTable_Servicos',
		    'refColumns'        => 'id'
		),
		'Application_Model_DbTable_Servicos' => array(
		    'columns'           => 'servicos_tecnologicos_id',
		    'refTableClass'     => 'Application_Model_DbTable_Servicos',
		    'refColumns'        => 'id'
		),
	);
}

