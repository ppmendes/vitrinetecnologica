<?php

class Application_Form_Login extends Zend_Form
{

    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array('Label', array('tag' => 'td')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    );

    public function loadDefaultDecorators()
    {
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'login_table')),
            'Form',
        ));
    }

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        //nome        
        $this->addElement('text', 'usuario', array(
        		'label'      => 'Usuário:',
        		'required'   => true,
                'decorators' => $this->elementDecorators
        ));
        
        //senha
        $this->addElement('password', 'senha', array(
        		'label'      => 'Senha:',
        		'required'   => true,
                'decorators' => $this->elementDecorators
        ));
        
        //enviar
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Enviar',
            'decorators' => $this->buttonDecorators
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

    }
}
