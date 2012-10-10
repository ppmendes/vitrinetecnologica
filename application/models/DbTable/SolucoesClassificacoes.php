<?php

class Application_Model_DbTable_SolucoesClassificacoes extends Zend_Db_Table_Abstract
{

   	protected $_name = 'classificacoes_has_solucoes_tecnologicas';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_Solucoes' => array(
		    'columns'           => 'solucoes_tecnologicas_id',
		    'refTableClass'     => 'Application_Model_DbTable_Solucoes',
		    'refColumns'        => 'id'
		),
		'Application_Model_DbTable_Classificacoes' => array(
		    'columns'           => 'classificacoes_id',
		    'refTableClass'     => 'Application_Model_DbTable_Classificacoes',
		    'refColumns'        => 'id'
		),
	);

}

