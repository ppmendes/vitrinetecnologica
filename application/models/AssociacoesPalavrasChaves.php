<?php
class Application_Model_AssociacoesPalavrasChaves{


	public function insert( $idPalavrasChaves, $tabelaAssociativa, $idTabelaAssociativa){	
		
		$ObjetoIdPalavrasChavesSolucao = array('palavras_chaves_id' => $idPalavrasChaves, 'tabela' => $tabelaAssociativa,      'chave_ligacao' => $idTabelaAssociativa );

		//var_dump($ObjetoIdPalavrasChavesSolucao);

		$tableAssociacoesPalavrasChaves = new Application_Model_DbTable_AssociacoesPalavrasChaves;				
		$tableAssociacoesPalavrasChaves->insert($ObjetoIdPalavrasChavesSolucao);
		
	}

}