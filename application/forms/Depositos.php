<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 31/08/12
 * Time: 01:57
 * To change this template use File | Settings | File Templates.
 */

class Application_Form_Depositos extends Zend_Form
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
        $this->setAttrib('class', 'formulario_depositos');

        // Setar metodo
        $this->setMethod('post');

        //numero deposito
        $this->addElement('text', 'numero', array(
            'label'      => 'Número do Depósito:',
            'decorators' => $this->elementDecorators,
            'required'   => true,
        ));

        //data do deposito
        $this->addElement('text', 'data', array(
            'required'   => false,
            'validators'  => array (
                array('date', false, array('yyyy-MM-dd'))
            ),
            'label'      => 'Data de Depósito(aaaa-MM-dd):',
            'decorators' => $this->elementDecorators,
            'class'      => 'data'
        ));

        //titulares
        $titularesDbTable= new Application_Model_DbTable_Titulares();
        $todasTitulares = $titularesDbTable->fetchAll();


        $titularesArray = array();
        foreach ($todasTitulares AS $row){
            $titularesArray[$row->id] = $row->nome;
        }

        $titularesExistentes = new Zend_Form_Element_MultiCheckbox('titulares', array(
            'label'      => 'Titulares:',
            'multiOptions' => $titularesArray,
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        $this->addElement($titularesExistentes);

        /*$data = array(
            'projected-start' => '12/03/2011'
        );
        var_dump( $this->isValid( $data ) );
        var_dump( $this->getErrors() );*/


        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Inserir Depósito',
            'decorators' => $this->buttonDecorators
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
            array('HtmlTag', array('tag' => 'table', 'class' => 'depositos_table')),
            'Form',
        ));
    }
}
