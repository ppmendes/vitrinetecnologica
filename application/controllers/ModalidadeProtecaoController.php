<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 31/08/12
 * Time: 01:07
 * To change this template use File | Settings | File Templates.
 */

class ModalidadeProtecaoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

        ini_set('display_errors', 'On');
        error_reporting(E_ALL);
    }

    public function indexAction()
    {

    }

    public function insertAction()
    {
	if(!Zend_Auth::getInstance()->hasIdentity()){
		$this->_redirect('/login/');
	}        
	
	$request = $this->getRequest();
        $form    = new Application_Form_ModalidadeProtecao();

        echo "&nbsp;&nbsp;&nbsp;";

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
            {
                $modalidadeProtecaoform = $form->getValues();

                //configurando gravação no banco de dados
                $modalidadeProtecao['nome'] = $modalidadeProtecaoform['modalidadesprotecao'];
                unset($modalidadeProtecaoform['modalidadesprotecao']);

                //salvando as modalidades de protecao
                $modalidadeProtecaoModel = new Application_Model_ModalidadesProtecoes();
                //retorna um array com os últimos ids inseridos
                $modalidadeProtecaoModel->insert($modalidadeProtecao);
            //return $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }
}
