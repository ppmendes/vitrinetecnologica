<?php

class Application_Model_Oportunidades
{
    public function insert( $oportunidades){

        $tableOportunidades = new Application_Model_DbTable_Oportunidades();
        $tableOportunidades->insert($oportunidades);

    }
}

