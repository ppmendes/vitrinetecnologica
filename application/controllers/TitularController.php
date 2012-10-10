<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 31/08/12
 * Time: 01:51
 * To change this template use File | Settings | File Templates.
 */

class TitularController extends Zend_Controller_Action
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
        $form    = new Application_Form_Titular();

        echo "&nbsp;&nbsp;&nbsp;";

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
            {
                $titularForm = $form->getValues();

                //configurando gravação no banco de dados
                $titular['nome'] = $titularForm['titular'];
                unset($titularForm['titular']);

                //salvando as modalidades de protecao
                $titularModel = new Application_Model_Titulares();
                //retorna um array com os últimos ids inseridos
                $titularModel->insert($titular);
                //return $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }
}
