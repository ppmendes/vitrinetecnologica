<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ppmendes
 * Date: 24/09/12
 * Time: 16:21
 * To change this template use File | Settings | File Templates.
 */

class Zend_View_Helper_Resumo extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     */

    public function resumo($string, $tamanho){
        $string = strip_tags($string);
        $tamanho_string = strlen($string);

        if($tamanho_string <= $tamanho){
            return $string;
        } else{
            $string_cortada = substr($string,0,$tamanho);

            $posicao_ultimo_espaco = strrpos($string_cortada, ' ');

            $resumo = substr($string_cortada,0,$posicao_ultimo_espaco);

            return $resumo;
        }
    }
}

