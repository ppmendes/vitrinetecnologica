<?php

class LoginController extends Zend_Controller_Action
{
	private $auth;    
	public function init()
    {
       $this->auth = Zend_Auth::getInstance();
    }

    public function indexAction()
    {	
	$request = $this->getRequest();
        $form    = new Application_Form_Login();
 
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) 
			{
				
				$loginForm = $form->getValues();
				
				$username = $loginForm['usuario'];
				$password  = $loginForm['senha'];				
				
				/* Resgata o adaptador do banco de dados utilizado */	
				$dbAdapter = Zend_Db_Table::getDefaultAdapter();

				$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter,'usuarios','usuario','senha','sha1(?)');

				$authAdapter->setIdentity($username)->setCredential($password);

				/* Variável que guarda o resultado da tentativa de autenticação */
				$result = $this->auth->authenticate($authAdapter);

				if (!$result->isValid()) {
					echo "Falha na autenticação\n";
				} else{
					$this->_redirect('/login/listar');
				}
				  
				
            }
		
        }
        $this->view->form = $form;
	
    }

	public function listarAction(){
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('/login/');
		}	
	}

	public function sairAction(){
		$this->auth->clearIdentity();
		$this->_redirect("/");
	}
}

