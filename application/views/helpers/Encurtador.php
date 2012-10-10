<?php

class Zend_View_Helper_Encurtador extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     */
    public function encurtador($url)
    {
        $urlServidor = "http://migre.me/api.txt?url=".$url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $urlServidor);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $tmp = curl_exec($ch);
        curl_close($ch);
        if ($tmp != false){
            return $tmp;
        }
    }
}