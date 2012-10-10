<?php
class Application_Model_PalavrasChaves{

	public function tags($tabela,$chaveLigacao){
		$palavrasChaves = new Application_Model_DbTable_PalavrasChaves;
		$select = $palavrasChaves->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
		$select->setIntegrityCheck(false);
		$select->join('palavras_chaves_associacoes','palavras_chaves_associacoes.palavras_chaves_id = palavras_chaves.id');
		$select->where('palavras_chaves_associacoes.tabela = ?',$tabela);
		$select->where('palavras_chaves_associacoes.chave_ligacao = ?',$chaveLigacao);
		$resultado = $palavrasChaves->fetchAll($select)->toArray();

		$palavras = array();
		foreach($resultado as $item){
			$palavras[] = $item['nome'];
		}

		return implode(', ', $palavras);
	}

	public function insert( $palavrasChaves){
	
		//inserir palavras chaves de forma incremental
		$tablePalavrasChaves = new Application_Model_DbTable_PalavrasChaves;				

		$palavrasChavesArray = explode(',',$palavrasChaves);
		
		$ultimosIdsInseridos = array();
		$i= 0;
		foreach($palavrasChavesArray as $palavrasChaves)
		{
			$palavrasChavesBanco['nome'] = $palavrasChaves;
			$ultimosIdsInseridos[$i] = $tablePalavrasChaves->insert($palavrasChavesBanco);				
			$i++;
		}
		
		return $ultimosIdsInseridos;
	}

}