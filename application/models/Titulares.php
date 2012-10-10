<?php

class Application_Model_Titulares
{
    public function insert($titular){
        $table = new Application_Model_DbTable_Titulares();
        $table->insert($titular);
    }
}

