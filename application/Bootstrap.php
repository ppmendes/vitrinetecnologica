<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
	$view->headMeta()->setHttpEquiv('Content-Type', 'text/html;charset=utf-8');
	set_include_path('../library/'.get_include_path());
	
	$view->getHelper('BaseUrl')->setBaseUrl('http://actgitt.redessociaisonline.com/');

	require_once 'Zend/Loader/Autoloader.php';

	$loader = Zend_Loader_Autoloader::getInstance();

	$loader->registerNamespace('Application_');
    }

}

