<?php

class Application_Form_PalavrasChaves extends Zend_Form
{

    public function init()
    {
        // Setar metodo
        $this->setMethod('post');

		//palavras-chaves
		$this->addElement('text', 'nome', array(
            'label'      => 'Palavras-chaves:',
            'required'   => true,            
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Inserir Palavra Chave',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
