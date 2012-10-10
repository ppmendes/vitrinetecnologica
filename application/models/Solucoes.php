<?php

class Application_Model_Solucoes
{
	/**
	* Busca a Solução e seus respectivos relacionamentos pelo ID da solução
	* Retorna um array com a Solução
	*/
	public function find($id){
		//DB TABLE
		$table = new Application_Model_DbTable_Solucoes;
		$solucao = $table->find($id)->current();

		//Relacionamentos
		$fase_desenvolvimento = $solucao->findParentApplication_Model_DbTable_FasesDesenvolvimentos();

		$depositos = $solucao->findApplication_Model_DbTable_Depositos();

		$modalidades = $solucao->findApplication_Model_DbTable_ModalidadesProtecoesViaApplication_Model_DbTable_SolucoesModalidadesProtecoes();
		$oportunidades = $solucao->findApplication_Model_DbTable_OportunidadesViaApplication_Model_DbTable_SolucoesOportunidades();
		$classificacoes = $solucao->findApplication_Model_DbTable_ClassificacoesViaApplication_Model_DbTable_SolucoesClassificacoes();

		$solucao = array(
			'solucao' => $solucao->toArray(),
			'fase_desenvolvimento' => $fase_desenvolvimento->toArray(),
			'depositos' => $depositos,
			'modalidades' => $modalidades->toArray(),
			'oportunidades' => $oportunidades->toArray(),
			'classificacoes' => $classificacoes->toArray(),
		);

		return $solucao;
	}

	public function insert($solucao){		
		$table = new Application_Model_DbTable_Solucoes;		
		$lastInsertId = $table->insert($solucao);
		return $lastInsertId;
	}

    public function update($solucao,$id){
        $table = new Application_Model_DbTable_Solucoes;
        $where = $table->getAdapter()->quoteInto('id = ?',$id);
        if($id != ''){
            $lastInsertId = $table->update($solucao,$where);
        }
        return $lastInsertId;
    }

    public function delete($id){
        $table = new Application_Model_DbTable_Solucoes;
        $where = $table->getAdapter()->quoteInto('id = ?',$id);
        $where2 = $table->getAdapter()->quoteInto('solucoes_id = ?',$id);
        $where3 = $table->getAdapter()->quoteInto('solucoes_tecnologicas_id = ?',$id);
        try{
            if($id != ''){

                $depositos = new Application_Model_DbTable_Depositos();
                $depositos->delete($where2);

                $modalidades = new Application_Model_DbTable_SolucoesModalidadesProtecoes();
                $modalidades->delete($where3);

                $oportunidades = new Application_Model_DbTable_SolucoesOportunidades();
                $oportunidades->delete($where3);

                $classificacoes = new Application_Model_DbTable_SolucoesClassificacoes();
                $classificacoes->delete($where3);

                $retorno = $table->delete($where);
            }

            return $retorno;
        } catch(Exception $e){
	echo "ERRO";
            echo $e->getMessage(); die;
        }

    }
}

