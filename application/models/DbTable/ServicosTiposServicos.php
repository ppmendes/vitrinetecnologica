<?php

class Application_Model_DbTable_ServicosTiposServicos extends Zend_Db_Table_Abstract
{

   	protected $_name = 'servicos_tecnologicos_has_tipos_servicos_tecnologicos';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_Servicos' => array(
		    'columns'           => 'servicos_tecnologicos_id',
		    'refTableClass'     => 'Application_Model_DbTable_Servicos',
		    'refColumns'        => 'id'
		),
		'Application_Model_DbTable_TiposServicos' => array(
		    'columns'           => 'tipos_servicos_tecnologicos_id',
		    'refTableClass'     => 'Application_Model_DbTable_TiposServicos',
		    'refColumns'        => 'id'
		),
	);
}

