<?php

class ServicosController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexadminAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('/login/');
        }

        $verificaBusca = $this->_getParam('busca');
        if($verificaBusca){
            $busca_session = new Zend_Session_Namespace('Busca');
            $servicos_tecnologicos = $busca_session->servicos_tecnologicos;
        }else{
            //passa para a view
            $busca_session = new Zend_Session_Namespace('Busca');
            $busca_session->servicos_tecnologicos = array();
            $busca_session->busca = '';
            $this->view->busca = '';
        }

        $db = new Application_Model_DbTable_Servicos;
        if(!empty($servicos_tecnologicos)){
            $adapter = new Zend_Paginator_Adapter_DbSelect($db->select()->where('id IN(?)',$servicos_tecnologicos));
        } else{
            $adapter = new Zend_Paginator_Adapter_DbSelect($db->select());
        }
        $paginator = new Zend_Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        if($this->_getParam('page') != ''){
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }
        $this->view->paginator = $paginator;
    }

    public function indexAction()
    {
		$verificaBusca = $this->_getParam('busca');
    	if($verificaBusca){
	    	$busca_session = new Zend_Session_Namespace('Busca');
	    	$servicos_tecnologicos = $busca_session->servicos_tecnologicos;
    	}else{
    		//passa para a view
    		$busca_session = new Zend_Session_Namespace('Busca');
    		$busca_session->servicos_tecnologicos = array();
    		$busca_session->busca = '';
			$this->view->busca = '';
    	}

		$db = new Application_Model_DbTable_Servicos;
		if(!empty($servicos_tecnologicos)){
			$adapter = new Zend_Paginator_Adapter_DbSelect($db->select()->where('id IN(?)',$servicos_tecnologicos));
		} else{
			$adapter = new Zend_Paginator_Adapter_DbSelect($db->select());
		}
		$paginator = new Zend_Paginator($adapter);
		$paginator->setItemCountPerPage(10);
		if($this->_getParam('page') != ''){
			$paginator->setCurrentPageNumber($this->_getParam('page'));
		}
		$this->view->paginator = $paginator;
    }

    public function viewAction()
    {
        //Serviço
        $servico = new Application_Model_Servicos;
        $this->view->servico = $servico->find($this->_getParam('id'));
    }

    public function insertAction()
    {
	    if(!Zend_Auth::getInstance()->hasIdentity()){
		    $this->_redirect('/login/');
	    }

        $id = $this->_getParam('id');
	    $request = $this->getRequest();
        $form    = new Application_Form_Servicos();

        $servicosModel = new Application_Model_Servicos();
        $tiposServicosModel = new Application_Model_TiposServicos();
        $asssociacoesServicosTiposServiosModel = new Application_Model_ServicosTiposServicos();
        $pessoasModel = new Application_Model_Pessoas();
        $palavrasChavesModel = new Application_Model_PalavrasChaves();
        $associacoesServicosPalavrasChavesModel = new Application_Model_AssociacoesPalavrasChaves();

        echo "&nbsp;";
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
            {
                $servicosform = $form->getValues();

                //nome do tipo do serviço
                $nomeTipoServico = $servicosform['nome_tipo_servico'];
                unset($servicosform['nome_tipo_servico']);

                //descrição do tipo do serviço
                $descricao_tipo_servico = $servicosform['descricao_tipo_servico'];
                unset($servicosform['descricao_tipo_servico']);

                //criando array de objetos para salvar no banco de dados de tipos de serviços
                $tipos_servicos = array('tipo_servico' => $nomeTipoServico, 'tipo_servico_descricao' => $descricao_tipo_servico);

                //nome coordenador
                $nome_coordenador = $servicosform['nome_coordenador'];
                unset($servicosform['nome_coordenador']);

                //palavras-chaves
                $palavrasChaves = $servicosform['palavras_chaves'];
                unset($servicosform['palavras_chaves']);

                if(isset($id)){
                    $servico = $servicosModel->find($id);

                    //atualizando servico
                    $servicosModel->update($servicosform,$id);
                    $tiposServicosModel->update($tipos_servicos,$servico['tipos_servicos'][0]['id']);
                    $pessoasModel->update(array('nome' => $nome_coordenador),$id);


                } else {
                    //salvando dados principais de servicos  (nome_laboratorio e descricao_laboratorio)
                    //retorna o último id inserido
                    $ultimoIdInseridoServicos = $servicosModel->insert($servicosform);

                    //seção de tipos de serviços
                    //retorna o último id inserido
                    $ultimoIdInseridoTiposServicos = $tiposServicosModel->insert($tipos_servicos);

                    //associação de tipos de serviços ao serviço
                    //associar o que já está no banco de dados
                    $asssociacoesServicosTiposServiosModel->insert($ultimoIdInseridoServicos, $ultimoIdInseridoTiposServicos);

                    //seção de pessoas
                    $pessoasModel->insert($nome_coordenador, $ultimoIdInseridoServicos);

                    //seção de palavras-chaves
                    //salvando as palavras-chaves relacionadas a solução
                    //retorna um array com os últimos ids inseridos
                    $ultimoIdsInseridoPalavrasChaves = $palavrasChavesModel->insert($palavrasChaves);

                    //associando as palavras-chaves a serviços
                    foreach($ultimoIdsInseridoPalavrasChaves as  $valorUltimoIdInseridoPalavrasChaves){
                        $associacoesServicosPalavrasChavesModel->insert($valorUltimoIdInseridoPalavrasChaves, 'servicos_tecnologicos', $ultimoIdInseridoServicos);
                    }
                }
            }
        } else if(isset($id)){
            $servico = $servicosModel->find($id);

            $servico['servico']['nome_tipo_servico'] = $servico['tipos_servicos'][0]['tipo_servico'];
            $servico['servico']['descricao_tipo_servico'] = $servico['tipos_servicos'][0]['tipo_servico_descricao'];
            $servico['servico']['nome_coordenador'] = $servico['pessoas'][0]['nome'];
            //popula palavras chaves
            $values = $palavrasChavesModel->tags('servicos_tecnologicos',$id);
            $form->populate(array('palavras_chaves' => $values));
            $form->populate($servico['servico']);
        }

        $this->view->form = $form;
    }

    public function deleteAction(){
        $id = $this->_getParam('id');
        if(isset($id)){
            $servicosModel = new Application_Model_Servicos();
            $servicosModel->delete($id);
        }
        $this->_redirect('/servicos/indexadmin');
    }


}

