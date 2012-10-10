<?php

class Application_Form_Classificacoes extends Zend_Form
{

    public function init()
    {
        // Setar metodo
        $this->setMethod('post');



        //palavras-chaves
        $this->addElement('text', 'classificacoes', array(
            'label'      => 'Classificações:',
            'required'   => true,
        ));



        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Inserir Classificações',
        ));



        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
