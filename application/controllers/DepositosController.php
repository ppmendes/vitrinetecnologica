<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 31/08/12
 * Time: 02:38
 * To change this template use File | Settings | File Templates.
 */

class DepositosController extends Zend_Controller_Action
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
        $form    = new Application_Form_Depositos();


        echo "&nbsp;&nbsp;&nbsp;";

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
            {
                $depositosForm = $form->getValues();

                //gravando titulares e excluindo-o do objeto do formulario
                $titulares = $depositosForm['titulares'];
                unset($depositosForm['titulares']);

                //salvando os depositos relacionados a solução
                $depositosModel = new Application_Model_Depositos();
                //retorna um array com os últimos ids inseridos
                $ultimoIdDeposito = $depositosModel->insert($depositosForm);

                $depositosTitularesModel = new Application_Model_DepositosTitulares();
                $depositosTitularesModel->insert($titulares, $ultimoIdDeposito);

                //return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }
}
