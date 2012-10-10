<?php

class Application_Model_ModalidadesProtecoes
{
    public function insert($modalidadeProtecao){
        $table = new Application_Model_DbTable_ModalidadesProtecoes();
        $table->insert($modalidadeProtecao);
    }
}

