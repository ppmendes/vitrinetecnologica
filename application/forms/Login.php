<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        //nome        
        $this->addElement('text', 'usuario', array(
        		'label'      => 'Usuário:',
        		'required'   => true
        ));
        
        //email
        $this->addElement('password', 'senha', array(
        		'label'      => 'Senha:',
        		'required'   => true,
        ));
        
        //enviar
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Enviar',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
        
        echo '</section>';
    }
}
