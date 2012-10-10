<?php

class Application_Model_DbTable_SolucoesModalidadesProtecoes extends Zend_Db_Table_Abstract
{

   	protected $_name = 'modalidades_protecoes_has_solucoes_tecnologicas';

 	protected $_referenceMap    = array(
		'Application_Model_DbTable_Solucoes' => array(
		    'columns'           => 'solucoes_tecnologicas_id',
		    'refTableClass'     => 'Application_Model_DbTable_Solucoes',
		    'refColumns'        => 'id'
		),
		'Application_Model_DbTable_ModalidadesProtecoes' => array(
		    'columns'           => 'modalidades_protecoes_id',
		    'refTableClass'     => 'Application_Model_DbTable_ModalidadesProtecoes',
		    'refColumns'        => 'id'
		),
	);

}

