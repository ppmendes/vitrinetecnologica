<?php

class SolucoesController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */

		ini_set('display_errors', 'On');
		error_reporting(E_ALL);
	}

    public function indexadminAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('/login/');
        }
        $verificaBusca = $this->_getParam('busca');
        if($verificaBusca){
            $busca_session = new Zend_Session_Namespace('Busca');
            $solucoes_tecnologicas = $busca_session->solucoes_tecnologicas;
        }else{
            //passa para a view
            $busca_session = new Zend_Session_Namespace('Busca');
            $busca_session->solucoes_tecnologicas = array();
            $busca_session->busca = '';
            $this->view->busca = '';
        }

        $db = new Application_Model_DbTable_Solucoes;
        if(!empty($solucoes_tecnologicas)){
            $adapter = new Zend_Paginator_Adapter_DbSelect($db->select()->where('id IN(?)',$solucoes_tecnologicas));
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
			$solucoes_tecnologicas = $busca_session->solucoes_tecnologicas;
    	}else{
    		//passa para a view
    		$busca_session = new Zend_Session_Namespace('Busca');
    		$busca_session->solucoes_tecnologicas = array();
    		$busca_session->busca = '';
			$this->view->busca = '';
    	}

		$db = new Application_Model_DbTable_Solucoes;
		if(!empty($solucoes_tecnologicas)){
			$adapter = new Zend_Paginator_Adapter_DbSelect($db->select()->where('id IN(?)',$solucoes_tecnologicas));
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
		//Solução
		$solucao = new Application_Model_Solucoes;
		$this->view->solucao = $solucao->find($this->_getParam('id'));
	}

    public function insertAction() {

        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('/login/');
        }

        $id = $this->_getParam('id');
        $request = $this->getRequest();
        $form    = new Application_Form_Solucoes();

        $solucoesModel = new Application_Model_Solucoes();
        $oportunidadesModel = new Application_Model_SolucoesOportunidades();
        $palavrasChavesModel = new Application_Model_PalavrasChaves();
        $solucoesClassificacoesModel = new Application_Model_SolucoesClassificacoes();
        $modalidadesProtecoesModel = new Application_Model_SolucoesModalidadesProtecoes();
        $associacoesSolucaoPalavrasChavesModel = new Application_Model_AssociacoesPalavrasChaves();
        $depositosModel = new Application_Model_Depositos();

        echo "&nbsp;";
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
            {

                /* Uploading Document File on Server */
                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename', 'files/');

                try {
                    // upload received file(s)
                    $upload->receive();
                } catch (Zend_File_Transfer_Exception $e) {
                    $e->getMessage();
                }

                if(isset($id))
                {
                    $idFiles = $id;
                    echo "nome do arquivo ".$idFiles;
                }
                else
                {
                    $Solucoes_Model = new Application_Model_Solucoes();
                    $lastId= $Solucoes_Model->getLastInsertedId();
                    $idFiles = $lastId;
                    echo "nome do arquivo ".$idFiles;
                }

                $solucoesform = $form->getValues();

                if($solucoesform['pdf'] !=  null )
                {
                $filePdf = $upload->getFileName('pdf');
                //pdf
                $fullFilePathPdf = 'files/solucoes/'.$idFiles.'.pdf';
                $filterFileRename = new Zend_Filter_File_Rename(array('target' => $fullFilePathPdf, 'overwrite' => true));
                $filterFileRename -> filter($filePdf);

                }

                if($solucoesform['imagem'] !=  null )
                {
                    $fileImage = $upload->getFileName('imagem');
                    //image
                    $fullFilePathImage = 'files/solucoes_imagens/'.$idFiles.'.png';
                    $filterFileRename = new Zend_Filter_File_Rename(array('target' => $fullFilePathImage, 'overwrite' => true));
                    $filterFileRename -> filter($fileImage);
                }

                //tirando os campos file que vem junto pra evitar conflito na hora de gravar
                $idsDepositos = $solucoesform['depositos'];
                $idsDepositos2 = $solucoesform['depositos2'];

                if($idsDepositos != null){
                    $idsDepositos = array_merge($idsDepositos, $idsDepositos2);
                }
                else if($idsDepositos == null){
                    $idsDepositos = $idsDepositos2;
                }


                //arquivos
                unset($solucoesform['pdf']);
                unset($solucoesform['imagem']);

                //depositos associados e ainda não
                unset($solucoesform['depositos2']);
                unset($solucoesform['depositos']);

                $palavrasChaves = $solucoesform['palavras_chaves'];
                unset($solucoesform['palavras_chaves']);

                //oportunidades
                $idsOportunidades = $solucoesform['oportunidades_id'];
                unset($solucoesform['oportunidades_id']);

                $IdsClassificacoes = $solucoesform['classificacoes'];
                unset($solucoesform['classificacoes']);

                $modalidadesProtecoes = $solucoesform['modalidadesProtecoes'];
                unset($solucoesform['modalidadesProtecoes']);

                Zend_Debug::dump($solucoesform, 'Form Data:');

                if(isset($id)){

                    $solucoesModel->update($solucoesform,$id);

                    $oportunidadesModel->update($id, $idsOportunidades);

                    //salvando os ids marcados no forumlario de classificacao
                    $solucoesClassificacoesModel->update($id, $IdsClassificacoes);

                    //salvando Modalidades Protecao
                    $modalidadesProtecoesModel->update($id, $modalidadesProtecoes);

                    //salvando Depositos
                    //$depositosModel->updateSolucoesId($id, $idsDepositos);

                } else{

                    //retorna o último id inserido
                    $ultimoIdInseridoSolucoes = $solucoesModel->insert($solucoesform);

                    //salvando as palavras-chaves relacionadas a solução
                    //retorna um array com os últimos ids inseridos
                    $ultimoIdsInseridoPalavrasChaves = $palavrasChavesModel->insert($palavrasChaves);

                    //salvando as oportunidades relacionadas a solução

                    //retorna um array com os últimos ids inseridos
                    $oportunidadesModel->insert($ultimoIdInseridoSolucoes, $idsOportunidades);

                    //salvando os ids marcados no forumlario de classificacao
                    $solucoesClassificacoesModel->insert($ultimoIdInseridoSolucoes, $IdsClassificacoes);

                    //salvando Modalidades Protecao
                    $modalidadesProtecoesModel->insert($ultimoIdInseridoSolucoes, $modalidadesProtecoes);

                    //salvando Depositos
                    $depositosModel->updateSolucoesId($ultimoIdInseridoSolucoes, $idsDepositos);

                    //associando as palavras-chaves a solução
                    foreach($ultimoIdsInseridoPalavrasChaves as  $valorUltimoIdInseridoPalavrasChaves)
                    {
                        $associacoesSolucaoPalavrasChavesModel->insert($valorUltimoIdInseridoPalavrasChaves, 'solucoes_tecnologicas', $ultimoIdInseridoSolucoes);
                    }
                }

                $this->_redirect('/solucoes/indexadmin');
            } else{
                //print_r($form->getErrors());
            }
        } else if(isset($id)){
            $solucao = $solucoesModel->find($id);
            $form->populate($solucao['solucao']);

            //popula oportunidades
            $values = array();
            foreach($solucao['oportunidades'] as $item){
                $values[] = $item['id'];
            }

            $values = array('oportunidades_id' => $values);
            $form->populate($values);

            //popula classificacoes
            $values = array();
            foreach($solucao['classificacoes'] as $item){
                $values[] = $item['id'];
            }

            $values = array('classificacoes' => $values);
            $form->populate($values);

            //popula modalidades
            $values = array();
            foreach($solucao['modalidades'] as $item){
                $values[] = $item['id'];
            }

            $values = array('modalidadesProtecoes' => $values);
            $form->populate($values);

            //popula palavras chaves
            $values = $palavrasChavesModel->tags('solucoes_tecnologicas',$id);

            $form->populate(array('palavras_chaves' => $values));

            //popula depositos
            $depositos = $solucao['depositos']->toArray();
            $values = array();
            foreach($depositos as $item){
                $values[] = $item['id'];
            }

            $values = array('depositos' => $values);
            $form->populate($values);

        }

        $this->view->form = $form;
    }

    public function deleteAction(){
        $id = $this->_getParam('id');
        if(isset($id)){
            @unlink('files/solucoes/'.$id.'.pdf');
            @unlink('files/solucoes_imagens/'.$id.'.png');

            $solucoesModel = new Application_Model_Solucoes();
            $solucoesModel->delete($id);
        }
        $this->_redirect('/solucoes/indexadmin');
    }
}