<?php

class Application_Model_Classificacoes {

   	public function insert( $classificacoesparam){



        $classificacoesArray = explode(',',$classificacoesparam['classificacoes']);


        //inserir palavras chaves de forma incremental
        $tableclassificacoes = new Application_Model_DbTable_Classificacoes;

        foreach($classificacoesArray as $classificacoes)
        {
            $classificacoesBanco['nome'] = $classificacoes;
            $tableclassificacoes->insert($classificacoesBanco);

        }


    }

}

