<?php

class Application_Model_Noticias
{
	/**
	* Busca a Solução e seus respectivos relacionamentos pelo ID da solução
	* Retorna um array com a Solução
	*/
	public function find($id){
		//DB TABLE
		$table = new Application_Model_DbTable_Noticias;
		$noticia = $table->find($id)->current()->toArray();

		return $noticia;
	}

	public function resumo($string, $tamanho = 500){
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

