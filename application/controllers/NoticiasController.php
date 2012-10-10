<?php

class NoticiasController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
    	//passa para a view
    	$busca_session = new Zend_Session_Namespace('Busca');
    	$busca_session->busca = '';
		$this->view->busca = '';

		$db = new Application_Model_DbTable_Noticias;

		$adapter = new Zend_Paginator_Adapter_DbSelect($db->select());

		$paginator = new Zend_Paginator($adapter);
		$paginator->setItemCountPerPage(5);

		if($this->_getParam('page') != ''){
			$paginator->setCurrentPageNumber($this->_getParam('page'));
		}

		$this->view->paginator = $paginator;

	}

	public function viewAction()
	{
		$noticia = new Application_Model_Noticias;
		$this->view->noticia = $noticia->find($this->_getParam('id'));
	}


}

