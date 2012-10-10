<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 02/09/12
 * Time: 22:50
 * To change this template use File | Settings | File Templates.
 */

class Application_Model_Pessoas {
    public function insert($nome_coordenador, $ultimoIdInseridoServicos){
        $objetoPessoasServicos = array('nome' => $nome_coordenador, 'servicos_tecnologicos_id' => $ultimoIdInseridoServicos);
        $table = new Application_Model_DbTable_Pessoas();
        $table->insert($objetoPessoasServicos);
    }

    public function update($pessoa,$id){
        $table = new Application_Model_DbTable_Pessoas();
        $where = $table->getAdapter()->quoteInto('id = ?',$id);
        if($id != ''){
            $lastInsertId = $table->update($pessoa,$where);
        }
    }
}