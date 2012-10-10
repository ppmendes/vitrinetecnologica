<?php

class PalavrasChavesController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    		
	}

    public function viewAction()
    {	
	//Solução
	$palavrasChaves = new Application_Model_PalavrasChaves;
	$this->view->palavrasChaves = $palavrasChaves->find($this->_getParam('id'));
    }
		
	public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_PalavrasChaves();
 
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) 
			{   			
				$PalavrasChavesform = $form->getValues();
				//salvando as palavras chaves
				$PalavrasChaves = new Application_Model_PalavrasChaves();                
                $PalavrasChaves->insert($PalavrasChavesform);
                //return $this->_helper->redirector('index');
            }
        }
 
        $this->view->form = $form;
    }
}

