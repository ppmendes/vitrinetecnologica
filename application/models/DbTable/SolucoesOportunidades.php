<?php

class Application_Model_DbTable_SolucoesOportunidades extends Zend_Db_Table_Abstract
{

   	protected $_name = 'solucoes_tecnologicas_has_oportunidades';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_Solucoes' => array(
		    'columns'           => 'solucoes_tecnologicas_id',
		    'refTableClass'     => 'Application_Model_DbTable_Solucoes',
		    'refColumns'        => 'id'
		),
		'Application_Model_DbTable_Oportunidades' => array(
		    'columns'           => 'oportunidades_id',
		    'refTableClass'     => 'Application_Model_DbTable_Oportunidades',
		    'refColumns'        => 'id'
		),
	);

}

