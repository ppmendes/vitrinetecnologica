<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 31/08/12
 * Time: 01:45
 * To change this template use File | Settings | File Templates.
 */

class Application_Form_Titular extends Zend_Form
{

    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array('Label', array('tag' => 'td')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    );

    public function init()
    {
        //inserindo uma classe
        $this->setAttrib('class', 'formulario_titular');

        // Setar metodo
        $this->setMethod('post');

        //palavras-chaves
        $this->addElement('text', 'titular', array(
            'label'      => 'Titular:',
            'decorators' => $this->elementDecorators,
            'required'   => true,
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'decorators' => $this->buttonDecorators,
            'label'    => 'Inserir',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }

    public function loadDefaultDecorators()
    {
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'titular_table')),
            'Form',
        ));
    }
}
