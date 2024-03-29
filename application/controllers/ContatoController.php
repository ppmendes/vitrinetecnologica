<?php

class ContatoController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

        $assunto['assunto'] = base64_decode($this->_getParam('assunto'));


		$request = $this->getRequest();
        $form    = new Application_Form_Contato();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
			{

				$contatoForm = $form->getValues();

				$emailRemetente = $contatoForm['email'];
				$nomeRemetente  = $contatoForm['nome_remetente'];
				$assunto = $contatoForm['assunto'];
				$mensagem = $contatoForm['mensagem'];

                try{
                    $mailTransport = new Zend_Mail_Transport_Smtp( "10.10.10.2" );
                    Zend_Mail::setDefaultTransport($mailTransport);
                    $m = new Zend_Mail("utf-8");
                    $m->setFrom($emailRemetente, $nomeRemetente);
                    $m->addTo('act@cdt.unb.br');
                    $m->addTo('disque@cdt.unb.br');
                    $m->setReturnPath("vitrinetecnologica@cdt.unb.br");
                    $m->setReplyTo($emailRemetente, $nomeRemetente);
                    $m->setSubject($assunto);
                    $m->setBodyText($mensagem);
                    $m->send();

                    echo "<script>alert('Email enviado com sucesso.');$('input[type=\"text\"]').val('');$('textarea').html('');</script>";
                }
                catch(Exception $e){
                    Zend_Debug::dump($e);
                }

                //echo "<script>alert('email enviado com sucesso!')</script>";

                //return $this->_helper->redirector('index');
            }
        }
        else{
            $form->populate($assunto);
        }

        $this->view->form = $form;

    }
}

