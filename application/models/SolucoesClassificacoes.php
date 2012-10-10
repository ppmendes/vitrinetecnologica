<?php

class Application_Model_SolucoesClassificacoes
{

    public function insert($ultimoIdInseridoSolucoes, $IdsClassificacoes){

        $tableSolucoesClassificacoes = new Application_Model_DbTable_SolucoesClassificacoes();
        foreach($IdsClassificacoes as $idClassificacao)
        {
            $objetoSolucoesClassificacoes = array( 'classificacoes_id' => $idClassificacao, 'solucoes_tecnologicas_id' => $ultimoIdInseridoSolucoes);
            $tableSolucoesClassificacoes->insert($objetoSolucoesClassificacoes);
        }

    }

    public function update($ultimoIdInseridoSolucoes, $IdsClassificacoes){

        $tableSolucoesClassificacoes = new Application_Model_DbTable_SolucoesClassificacoes();
        $where = $tableSolucoesClassificacoes->getAdapter()->quoteInto('solucoes_tecnologicas_id = ?',$ultimoIdInseridoSolucoes);
        $tableSolucoesClassificacoes->delete($where);
        foreach($IdsClassificacoes as $idClassificacao)
        {
            $objetoSolucoesClassificacoes = array( 'classificacoes_id' => $idClassificacao, 'solucoes_tecnologicas_id' => $ultimoIdInseridoSolucoes);
            $tableSolucoesClassificacoes->insert($objetoSolucoesClassificacoes);
        }

    }

}

