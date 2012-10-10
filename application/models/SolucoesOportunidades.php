<?php

class Application_Model_SolucoesOportunidades extends Zend_Db_Table_Abstract
{
	public function insert( $idSolucao, $idsOportunidades){

        $tableSolucoesOportunidades = new Application_Model_DbTable_SolucoesOportunidades;
        foreach($idsOportunidades as $idOportunidade)
        {
            $objetoSolucaoOportunidade = array('solucoes_tecnologicas_id' => $idSolucao, 'oportunidades_id' => $idOportunidade);
            $tableSolucoesOportunidades->insert($objetoSolucaoOportunidade);
        }

	}

    public function update( $idSolucao, $idsOportunidades){

        $tableSolucoesOportunidades = new Application_Model_DbTable_SolucoesOportunidades;
        $where = $tableSolucoesOportunidades->getAdapter()->quoteInto('solucoes_tecnologicas_id = ?',$idSolucao);
        $tableSolucoesOportunidades->delete($where);

        foreach($idsOportunidades as $idOportunidade)
        {
            $objetoSolucaoOportunidade = array('solucoes_tecnologicas_id' => $idSolucao, 'oportunidades_id' => $idOportunidade);
            $tableSolucoesOportunidades->insert($objetoSolucaoOportunidade);
        }

    }

}

