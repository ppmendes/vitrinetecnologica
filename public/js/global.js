
/**
 * Funcao que obtem via ajax um select 
 * @param idSelectOrigem	- Select de origem, cujo o evento de change sera aplicado
 * @param strUrlRequest     - Url da requisicao
 * @param idHtmlRender   	- Select de destino cujo os options serao substituidos por novos 
 * @param strIdDivLoad 		- Div que mostrara um gif animado indicando haver um carregamento
 * @return
 */
function obterSelectAjax( idSelectOrigem , strUrlRequest , idHtmlRender ){
	/* Funcoes que obtem as subareas de uma area */
	$( idSelectOrigem ).change(function(){
		$.ajax({
			url: strUrlRequest, 
			dataType: 'html',
			data:{ id : $(this).val() },
			type: 'GET',
			cache: false,
			beforeSend: function ( xmlRequest ){
				$( "#div_loading" ).css( 'display' , 'block' );
			},
			success: function(data, textStatus) {
				$( "#div_loading" ).css( 'display' , 'none' );
				$( idHtmlRender ).html('' + data + '');
			},
			error: function(xhr,er) {
				$( idHtmlRender ).html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
			}		
		});
	});
}