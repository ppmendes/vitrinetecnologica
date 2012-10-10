<?php

class Application_Form_Oportunidades extends Zend_Form
{

    public function init()
    {
        // Setar metodo
        $this->setMethod('post');



        //palavras-chaves
        $this->addElement('text', 'oportunidades', array(
            'label'      => 'Oportunidade:',
            'required'   => true,
        ));



        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Inserir Oportunidade',
        ));



        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
