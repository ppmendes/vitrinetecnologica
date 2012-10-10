<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 04/09/12
 * Time: 23:38
 * To change this template use File | Settings | File Templates.
 */

class RegistrationController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Registration();
        $this->view->form = $form;
    }
}
?>