<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 02/09/12
 * Time: 22:10
 * To change this template use File | Settings | File Templates.
 */

class Application_Model_TiposServicos
{
    /**
     * Busca o Serviço e seus respectivos relacionamentos pelo ID do Serviço
     * Retorna um array com a Solução
     */
    /*public function find($id){
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
    }*/

    public function insert($tiposServicos){
        $table = new Application_Model_DbTable_TiposServicos();
        $lastInsertId = $table->insert($tiposServicos);
        return $lastInsertId;
    }

    public function update($tiposServicos,$id){
        $table = new Application_Model_DbTable_TiposServicos();
        $where = $table->getAdapter()->quoteInto('id = ?',$id);
        if($id != ''){
            $lastInsertId = $table->update($tiposServicos,$where);
        }
    }
}