<?php
class Application_Model_Contatos
{
	public function contato($tabela,$chaveLigacao){
		$contatos = new Application_Model_DbTable_Contatos;
		$select = $contatos->select();
		$select->where('tabela = ?',$tabela);
		$select->where('chave_ligacao = ?',$chaveLigacao);

		return $contatos->fetchAll($select)->current()->toArray();
	}
}