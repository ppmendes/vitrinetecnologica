<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 02/09/12
 * Time: 22:18
 * To change this template use File | Settings | File Templates.
 */


// Um servico tecnologico (laboratorio/professor) pode fornecer mais de um tipo de serviço
// 1 -> N
class Application_Model_ServicosTiposServicos{

    public function insert($idUltimoServicosInserido, $idUltimosTiposServicosInseridos){
        $table = new Application_Model_DbTable_ServicosTiposServicos();
        $objetoServicosTiposServicos = array('servicos_tecnologicos_id' => $idUltimoServicosInserido, 'tipos_servicos_tecnologicos_id' => $idUltimosTiposServicosInseridos );
        $table->insert($objetoServicosTiposServicos);
    }
}