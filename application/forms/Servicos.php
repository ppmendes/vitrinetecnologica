<?php

class Application_Form_Servicos extends Zend_Form
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
        /* Initialize action controller here */

        //inserindo uma classe
        $this->setAttrib('class', 'formulario_servicos');

        // Setar metodo
        $this->setMethod('post');

        //nome do laboratório / professor (mesma tabela)
        // Adicionar nome
        $this->addElement('text', 'nome_laboratorio', array(
            'label'      => 'Nome do Laboratório ou do Professor:',
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        //Descrição do laboratório / Descrição do Professor
        $this->addElement('textarea', 'descricao_laboratorio', array(
            'label'      => 'Descrição do Laboratório ou do Professor:',
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        //seção de contatos (NÃO SERÁ IMPLEMENTADO AGORA)
        //-email
        //-telefone
        //-endereço
        //tabela (servicos_tecnologicos)
        //id_tabela

        //seção tipos de serviços
        //-nome do tipo do serviço
        //-descrição do tipo do seviço
        //--fazer associacao entre tipos de serviços e serviços
        $this->addElement('text', 'nome_tipo_servico', array(
            'label'      => 'Nome do Tipo do Serviço:',
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        $this->addElement('textarea', 'descricao_tipo_servico', array(
            'label'      => 'Descrição do Tipo do Serviço:',
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        //seção coordenadores
        //- nome do coordenador
        $this->addElement('text', 'nome_coordenador', array(
            'label'      => 'Nome do Coordenador:',
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        //palavras-chaves
        $this->addElement('text', 'palavras_chaves', array(
            'label'      => 'Palavras-chaves:',
            'decorators' => $this->elementDecorators,
            'required'   => true,
        ));

        // Adicionar o botão submit
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'decorators' => $this->buttonDecorators,
            'label'    => 'Inserir Serviço',
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
            array('HtmlTag', array('tag' => 'table', 'class' => 'servico_table')),
            'Form',
        ));
    }
}
