<?php

class BuscaController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */

	}
	public function indexAction()
	{
		//Inicia sessao
		$busca_session = new Zend_Session_Namespace('Busca');


		if($this->_request->isPost()){
			//pega o valor da busca
			$busca = $this->_getParam('busca');

			//guarda na sessao
			$busca_session->busca =  $busca;

			//passa para a view
			$this->view->busca = $busca;
		} else{
			$busca = $busca_session->busca;
		}

		//divide a busca por espaços

		$busca_array = explode(' ',$busca);

		//busca palavras chaves
		$palavrasChaves = new Application_Model_DbTable_PalavrasChaves;
		$select = $palavrasChaves->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
		$select->setIntegrityCheck(false);

		foreach($busca_array as $busca){
			$select->orWhere("nome LIKE ?", '%'.$busca.'%');
		}

		$select->join('palavras_chaves_associacoes','palavras_chaves_associacoes.palavras_chaves_id = palavras_chaves.id');

		$resultado = $palavrasChaves->fetchAll($select)->toArray();

		foreach($resultado as $item){
			${$item['tabela']}[] = $item['chave_ligacao'];
		}

		if(isset($solucoes_tecnologicas)){
			//titulo nome
			//resumo descricao_problema
			//tags
			//endereço formatado solucoes/view/id/
			$busca_session->solucoes_tecnologicas = $solucoes_tecnologicas;
			$solucoes = new Application_Model_DbTable_Solucoes;
			$select = $solucoes->select()->where('id IN(?)',$solucoes_tecnologicas)->limit(3);
			$solucoes = $solucoes->fetchAll($select)->toArray();

			foreach($solucoes as &$solucao){
				$palavras = new Application_Model_PalavrasChaves;
				$solucao['tags'] = $palavras->tags('solucoes_tecnologicas',$solucao['id']);
			}
			$this->view->solucoes = $solucoes;
		}
		if(isset($servicos_tecnologicos)){
			$busca_session->servicos_tecnologicos = $servicos_tecnologicos;
			$servicos = new Application_Model_DbTable_Servicos;
			$select = $servicos->select()->where('id IN(?)',$servicos_tecnologicos)->limit(3);

			$servicos = $servicos->fetchAll($select)->toArray();

			foreach($servicos as &$servico){
				$palavras = new Application_Model_PalavrasChaves;
				$servico['tags'] = $palavras->tags('servicos_tecnologicos',$servico['id']);
			}

			$this->view->servicos = $servicos;
		}
	}
}

