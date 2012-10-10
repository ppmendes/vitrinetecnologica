<?php

class Application_Form_Contato extends Zend_Form
{

    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data' => 'HtmlTag'), array('class' => 'element_contato')),
        array('Label', array('class' => 'label_contato')),
        array(array('row' => 'HtmlTag'), array('tag' => 'section', 'class' => 'section_contato'))
    );

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        //nome
        
        $this->addElement('text', 'nome_remetente', array(
        		'label'      => 'Nome:',
        		'required'   => true,
                'decorators' => $this->elementDecorators
        ));
        
        //email
        $this->addElement('text', 'email', array(
        		'label'      => 'Email:',
        		'required'   => true,
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				'EmailAddress',
        		),
                'decorators' => $this->elementDecorators,
        ));
        
        //combobox: solução ou serviço
        /*$servicos_solucoes = array('serviços','soluções','outro');
        $this->addElement('select', 'tipo', array(
        		'label'      => 'Tipo:',
        		'multiOptions'  => $servicos_solucoes,
        		'required'   => true,
                'decorators' => $this->elementDecorators,
        ));*/
        
        //assunto
        $this->addElement('text', 'assunto', array(
        		'label'      => 'Assunto:',
        		'required'   => true,
                'decorators' => $this->elementDecorators
        		));        
        
        //mensagem
        $this->addElement('textarea', 'mensagem', array(
        		'label'      => 'Mensagem:',
        		'required'   => true,
                'decorators' => $this->elementDecorators
        ));
        
        //enviar
        $this->addElement('submit', 'submit',
            array(
            'ignore'   => true,
            'label'    => 'Enviar',
            'id'       => 'submit-email',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

    }
}
