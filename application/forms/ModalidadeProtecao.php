<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 31/08/12
 * Time: 00:55
 * To change this template use File | Settings | File Templates.
 */

class Application_Form_ModalidadeProtecao extends Zend_Form
{

    public function init()
    {
        // Setar metodo
        $this->setMethod('post');

        // modalidades_protecoes
        $this->addElement('text', 'modalidadesprotecao', array(
            'label'      => 'Modalidade de Proteção:',
            'required'   => true
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Inserir'
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
?>