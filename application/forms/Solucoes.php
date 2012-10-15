<?php

class Application_Form_Solucoes extends Zend_Form
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

    public $fileDecorators = array(
        'File',
        'Errors',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array('Label', array('tag' => 'td', 'class' => 'file')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
    );

    public function init()
    {

        $this->setAttrib('enctype', 'multipart/form-data');

        /* Initialize action controller here */

        // Setar metodo
        $this->setMethod('post');


        // Adicionar nome
        $this->addElement('textarea', 'nome', array(
            'label'      => 'Titulo Solucao Tecnologica:',
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

		// Adicionar descricao problema
        $this->addElement('textarea', 'descricao_problema', array(
            'label'      => 'Descricao do Problema:',
            'decorators' => $this->elementDecorators,
            'required'   => true,
        ));

		// Adicionar descricao problema
        $this->addElement('textarea', 'descricao_tecnologia_solucao', array(
            'label'      => 'Descricao da Tecnlogia e Solucao Proposta:',
            'decorators' => $this->elementDecorators,
            'required'   => true,
        ));//

       //oportunidades
        $Oportunidades = new Application_Model_DbTable_Oportunidades();
        $todasOportunidades = $Oportunidades->fetchAll();

        $OportunidadesArray = array();
        foreach ($todasOportunidades AS $row){
            $OportunidadesArray[$row->id] = $row->nome;
        }

        $oportunidadesExistentes = new Zend_Form_Element_MultiCheckbox('oportunidades_id', array(
            'label'      => 'Oportunidades:',
            'multiOptions' => $OportunidadesArray,
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        $this->addElement($oportunidadesExistentes);

		//palavras-chaves
		$this->addElement('text', 'palavras_chaves', array(
            'label'      => 'Palavras-chaves:',
            'decorators' => $this->elementDecorators,
            'required'   => true,
        ));

		//campo de aplicação
        $classificacao = new Application_Model_DbTable_Classificacoes();
        $todasClassificacoes = $classificacao->fetchAll();


        $classificacoesArray = array();
        foreach ($todasClassificacoes AS $row){
            $classificacoesArray[$row->id] = $row->nome;
        }

        $classificacoesExistentes = new Zend_Form_Element_MultiCheckbox('classificacoes', array(
            'label'      => 'Classificacoes:',
            'multiOptions' => $classificacoesArray,
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        $this->addElement($classificacoesExistentes);

        //adicionar fase de desenvolvimento
        $fasesDesenvolvimento = new Application_Model_FasesDesenvolvimentos();
        $todasFasesDesenvolvimento = $fasesDesenvolvimento->fetchAll();

        $fasesDesenvolvimentoArray = array();
        foreach ($todasFasesDesenvolvimento AS $row){
            $fasesDesenvolvimentoArray[$row->id] = $row->nome;
        }

        $this->addElement('select', 'fases_desenvolvimentos_id', array(
            'label'      => 'Fases de Desenvolvimento:',
            'multiOptions'  => $fasesDesenvolvimentoArray,
            'decorators' => $this->elementDecorators,
            'required'   => true

        ));

	    //modalidade de proteção
        $modalidadeProtecao = new Application_Model_DbTable_ModalidadesProtecoes();
        $todasmodalidadesProtecoes = $modalidadeProtecao->fetchAll();


        $modalidadesProtecoesArray = array();
        foreach ($todasmodalidadesProtecoes AS $row){
            $modalidadesProtecoesArray[$row->id] = $row->nome;
        }

        $modalidadesProtecoesExistentes = new Zend_Form_Element_MultiCheckbox('modalidadesProtecoes', array(
            'label'      => 'modalidadesProtecoes:',
            'multiOptions' => $modalidadesProtecoesArray,
            'decorators' => $this->elementDecorators,
            'required'   => true
        ));

        $this->addElement($modalidadesProtecoesExistentes);

        //depositos que ainda não foram associados
        $depositos = new Application_Model_DbTable_Depositos();
        $todosDepositos = $depositos->fetchAll();

        $depositosArray = array();
        foreach ($todosDepositos AS $row){


            if($row->solucoes_id == NULL)
            {
            $depositosArray[$row->id] = "número: ".$row->numero." data: ".$row->data;
            }
        }

        $depositosExistentes = new Zend_Form_Element_MultiCheckbox('depositos', array(
            'label'      => 'Depositos:',
            'multiOptions' => $depositosArray,
            'decorators' => $this->elementDecorators,
            'required'   => false
        ));

        $this->addElement($depositosExistentes);

        //[..]
        /*$id = new Zend_Form_Element_Hidden('name');
        $this->addElement($id);
        $this->fill();*/

        //id que é recebido via parâmetro
        $id = Zend_Controller_Front::getInstance()->getRequest()->getParam( 'id', null );


        //depositos que já foram associados

         $depositosArrayAssociados = array();
        foreach ($todosDepositos AS $row){


            if($row->solucoes_id == $id)
            {
                $depositosArrayAssociados[$row->id] = "número: ".$row->numero." data: ".$row->data;
            }
        }

        $depositosExistentes = new Zend_Form_Element_MultiCheckbox('depositos2', array(
            'label'      => 'Depositos2:',
            'multiOptions' => $depositosArrayAssociados,
            'decorators' => $this->elementDecorators,
            'checked' => 'checked',
            'required'   => false
        ));

        $this->addElement($depositosExistentes);



        // PDF
        $this->addElement('file', 'pdf', array(
            'label'      => 'PDF:',
            'decorators' => $this->fileDecorators
            //'required'   => true
        ));

        // Imagem
        $this->addElement('file', 'imagem', array(
            'label'      => 'Imagem (PNG):',
            'decorators' => $this->fileDecorators
            //'required'   => true
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'decorators' => $this->buttonDecorators,
            'label'    => 'Inserir Solucao',
        ));

        // And finally add some CSRF protection
        //$this->addElement('hash', 'csrf', array(
        //    'ignore' => true,
        //));
    }

    public function loadDefaultDecorators()
    {
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'solucao_table')),
            'Form',
        ));
    }

    public function fill()
    {
        $this->name->setValue( Zend_Controller_Front::getInstance()->getRequest()->getParam( 'id', null ) );
    }
}
