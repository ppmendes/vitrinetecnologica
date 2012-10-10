<?php

class Application_Form_Email extends Zend_Form
{

    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data' => 'HtmlTag'), array('class' => 'element_email')),
        array('Label', array('class' => 'label_email')),
        array(array('row' => 'HtmlTag'), array('tag' => 'section', 'class' => 'section_email'))
    );

    public $buttonDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data' => 'HtmlTag'), array('class' => 'element_email')),
        array('Label', array('class' => 'label_submit')),
        array(array('row' => 'HtmlTag'), array('tag' => 'section', 'class' => 'section_email'))
    );


    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        //nome
        
        $this->addElement('text', 'nome', array(
        		'label'      => 'Seu Nome:',
            'decorators' => $this->elementDecorators,
        		'required'   => true
        ));
        
        //email
        $this->addElement('text', 'from', array(
        		'label'      => 'Seu e-mail:',
        		'required'   => true,
            'decorators' => $this->elementDecorators,
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				'EmailAddress',
        		)
        ));

	//nome
		        

        //email
        $this->addElement('text', 'to', array(
        		'label'      => 'Enviar para:',
        		'required'   => true,
        		'filters'    => array('StringTrim'),
            'decorators' => $this->elementDecorators,
        		'validators' => array(
        				'EmailAddress',
        		)
        ));
        
        //enviar
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Enviar',
            'decorators' => $this->buttonDecorators
        ));

        // And finally add some CSRF protection
        //$this->addElement('hash', 'csrf', array(
        //    'ignore' => true,
        //));
        
        echo '</section>';
    }
}
