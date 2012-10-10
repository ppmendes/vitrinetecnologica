<?php

class Application_Model_DepositosTitulares
{
    public function insert($titulares, $ultimoIdDeposito){
        $tableDepositosTitulares = new Application_Model_DbTable_DepositosTitulares();
        foreach($titulares as $titular)
        {
            $objetoDepositosTitulares = array('depositos_id' => $ultimoIdDeposito, 'titular_id' => $titular );
            $tableDepositosTitulares->insert($objetoDepositosTitulares);
        }
    }
}

