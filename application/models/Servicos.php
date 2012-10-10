<?php

class Application_Model_Servicos
{
	/**
	* Busca o Serviço e seus respectivos relacionamentos pelo ID do Serviço
	* Retorna um array com a Solução
	*/
	public function find($id){
		//DB TABLE	
		$table = new Application_Model_DbTable_Servicos;
		$servicos = $table->find($id)->current();

		$pessoas = $servicos->findApplication_Model_DbTable_Pessoas();		

		//relacionamento N para N		
		$tipos_servicos = $servicos->findApplication_Model_DbTable_TiposServicosViaApplication_Model_DbTable_ServicosTiposServicos();

		$servicos = array(
			'servico' => $servicos->toArray(),
			'pessoas' => $pessoas->toArray(),
			'tipos_servicos' => $tipos_servicos->toArray(),
		);
		
		return $servicos;
	}

    public function insert($servicos){
        $table = new Application_Model_DbTable_Servicos();
        $lastInsertId = $table->insert($servicos);
        return $lastInsertId;
    }

    public function update($servicos,$id){
        $table = new Application_Model_DbTable_Servicos();
        $where = $table->getAdapter()->quoteInto('id = ?',$id);
        if($id != ''){
            $lastInsertId = $table->update($servicos,$where);
        }
        return $lastInsertId;
    }

    public function delete($id){
        $table = new Application_Model_DbTable_Servicos();
        $where = $table->getAdapter()->quoteInto('id = ?',$id);
        $where2 = $table->getAdapter()->quoteInto('servicos_tecnologicos_id = ?',$id);
        try{
            if($id != ''){

                $tipos = new Application_Model_DbTable_ServicosTiposServicos();
                $tipos->delete($where2);

                $table->delete($where);
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

