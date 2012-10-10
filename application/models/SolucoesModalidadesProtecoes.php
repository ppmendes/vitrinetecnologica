<?php

class Application_Model_SolucoesModalidadesProtecoes
{

    public function insert($idUltimaSolucao, $modalidadesProtecoes){

        $table = new Application_Model_DbTable_SolucoesModalidadesProtecoes();
        foreach($modalidadesProtecoes as $modalidadeProtecao )
        {
            $objetoSolucoesModalidadesProtecoes = array('modalidades_protecoes_id' => $modalidadeProtecao, 'solucoes_tecnologicas_id' => $idUltimaSolucao);
            $table->insert($objetoSolucoesModalidadesProtecoes);
        }
    }

    public function update($idUltimaSolucao, $modalidadesProtecoes){

        $table = new Application_Model_DbTable_SolucoesModalidadesProtecoes();

        $where = $table->getAdapter()->quoteInto('solucoes_tecnologicas_id = ?',$idUltimaSolucao);
        $table->delete($where);
        foreach($modalidadesProtecoes as $modalidadeProtecao )
        {
            $objetoSolucoesModalidadesProtecoes = array('modalidades_protecoes_id' => $modalidadeProtecao, 'solucoes_tecnologicas_id' => $idUltimaSolucao);
            $table->insert($objetoSolucoesModalidadesProtecoes);
        }
    }
}

