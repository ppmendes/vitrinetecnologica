<?php

class Application_Model_Depositos
{

    public function insert($deposito){

        $tableDepositos = new Application_Model_DbTable_Depositos();
        $objetoDeposito = array('data' => $deposito['data'], 'numero' => $deposito['numero'] );
        $ultimoIdDepositos = $tableDepositos->insert($objetoDeposito);
        return $ultimoIdDepositos;
    }

    public function updateSolucoesId($ultimoIdInseridoSolucoes, $idsDepositos) {

        $data = array(
            'solucoes_id' => $ultimoIdInseridoSolucoes
        );
        $where['id IN(?)'] = $idsDepositos;

        $tableDepositos = new Application_Model_DbTable_Depositos();
        $tableDepositos->update($data, $where);

    }
}

