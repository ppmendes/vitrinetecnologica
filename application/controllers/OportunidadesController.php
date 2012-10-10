<?php

class OportunidadesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

        ini_set('display_errors', 'On');
        error_reporting(E_ALL);
    }


    public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Classificacoes();


        echo "&nbsp;&nbsp;&nbsp;";
        /*
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost()))
            {
                $solucoesform = $form->getValues();

                $palavrasChaves = $solucoesform['palavras_chaves'];
                unset($solucoesform['palavras_chaves']);

                //oportunidades
                $idOportunidade = $solucoesform['oportunidades_id'];
                unset($solucoesform['oportunidades_id']);

                //salvando dados principais de soluções
                $solucoesModel = new Application_Model_Solucoes();

                //retorna o último id inserido
                $ultimoIdInseridoSolucoes = $solucoesModel->insert($solucoesform);

                //salvando as palavras-chaves relacionadas a solução
                $palavrasChavesModel = new Application_Model_PalavrasChaves();
                //retorna um array com os últimos ids inseridos
                $ultimoIdsInseridoPalavrasChaves = $palavrasChavesModel->insert($palavrasChaves);

                 //salvando as oportunidades relacionadas a solução
                $oportunidadesModel = new Application_Model_SolucoesOportunidades();
                //retorna um array com os últimos ids inseridos
                $oportunidadesModel->insert($ultimoIdInseridoSolucoes, $idOportunidade);


                //associando as palavras-chaves a solução


                $associacoesSolucaoPalavrasChavesModel = new Application_Model_AssociacoesPalavrasChaves();

                foreach($ultimoIdsInseridoPalavrasChaves as  $valorUltimoIdInseridoPalavrasChaves)
                {

                    $associacoesSolucaoPalavrasChavesModel->insert($valorUltimoIdInseridoPalavrasChaves, 'solucoes_tecnologicas', $ultimoIdInseridoSolucoes);
                }



                //salvando palavras chaves
               /*$model = new Application_Model_DbTable_Login();
               //pass the whole array to the saveUser() correct the data in the model.
               $user = $model->saveUser($formData);
               //$user returns the row object we just saved
               $profile = new Application_Model_DbTable_Profile();
               $profile->saveUserProfile($formData, $user->user_id);*/

                //return $this->_helper->redirector('index');
            //}
        //}


        $this->view->form = $form;
    }


}