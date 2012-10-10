<?php

class ClassificacoesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

        ini_set('display_errors', 'On');
        error_reporting(E_ALL);
    }


    public function insertAction()
    {
	if(!Zend_Auth::getInstance()->hasIdentity()){
		$this->_redirect('/login/');
	}        

	$request = $this->getRequest();
        $form    = new Application_Form_Classificacoes();


        echo "&nbsp;&nbsp;&nbsp;";

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
            {
                $classificacoesForm = $form->getValues();

                //salvando as classificacoes relacionadas a solução
                $classificacoesModel = new Application_Model_Classificacoes();
                //retorna um array com os últimos ids inseridos
                $classificacoesModel->insert($classificacoesForm);

                //return $this->_helper->redirector('index');
            }

        }


        $this->view->form = $form;
    }


}
