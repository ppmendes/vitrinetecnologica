<?php

class EmailController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */

		//ini_set('display_errors', 'Off');
		//error_reporting(E_ALL);

		$layout = $this->_helper->layout();
        	$layout->setLayout('iframe');
	}

	private function gerarMensagem($id,$titulo,$resumo,$link){
		$mensagem = '<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
			    <tbody><tr>
				<td align="center">
				    <table width="575" cellspacing="0" cellpadding="0" border="0" align="center">
					<tbody><tr>
					    <td height="61" background="" align="left">
						<a title="Vitrine Tecnol&oacute;gica" href="http://www.cdt.unb.br/vitrinetecnologica/" target="_blank">
						    <img border="0" title="G1" alt="Vitrine Tecnol&oacute;gica" src="http://www.cdt.unb.br/vitrinetecnologica/imagem/logo.png">
						</a>
					    </td>
					</tr>
					<tr>
					    <td align="center">
						<table width="550" cellpadding="0" border="0">
						    <tbody>


						    <tr>
						        <td>
						            <br>
						            <font size="5" face="Arial, Helvetica, sans-serif" color="#565656">
						                <strong>'.$titulo.'</strong>
						            <br><br>
						            <font size="4" color="#464646">'.$resumo.'
						            </font>
						        </font></td>
						    </tr>
						    <tr>
						        <td></td>
						    </tr>
						    <tr>
						        <td height="42" bgcolor="#f5f5f5">
						            <font size="2" face="Arial, Helvetica, sans-serif" color="#333333"><strong>LEIA MAIS<br></strong></font>
						            <a title="LEIA MAIS" href="'.$link.$id.'" target="_blank">
						                <font size="2" face="Arial, Helvetica, sans-serif" color="#547D9A">
						                   '.$link.$id.'
						                </font>
						            </a>
						        </td>
						    </tr>
						</tbody></table>
					    </td>
					</tr>
				    </tbody></table>
				</td>
			    </tr>
			</tbody></table>';
		return $mensagem;
	}

	private function enviarEmail($from,$to,$subject,$message){
		try{
	        $mailTransport = new Zend_Mail_Transport_Smtp( "10.10.10.2" );
	        Zend_Mail::setDefaultTransport($mailTransport);

	        $mail = new Zend_Mail();
	        $mail->setBodyHtml($message);
	        $mail->setFrom($from[0], $from[1]);
	        $mail->addTo($to[0], $to[1]);
	        $mail->setSubject($subject);
	        $mail->setReturnPath("vitrinetecnologica@cdt.unb.br");
	        $mail->setReplyTo($from[0],$from[1]);
	        $mail->send();

        }
        catch(Exception $e){
        	Zend_Debug::dump($e);
        }
	}

	public function indexAction()
	{
		$tipo = $this->_getParam('tipo');
		$id = $this->_getParam('id');

		$assunto = utf8_decode('Vitrine Tecnológica');
		if($tipo == 'solucao'){
			//Solução

			$db = new Application_Model_Solucoes;
			$resultado = $db->find($id);
			$titulo = utf8_decode($resultado['solucao']['nome']);
			$resumo = utf8_decode($resultado['solucao']['descricao_problema']);
			$link = 'http://www.cdt.unb.br/vitrinetecnologica/solucoes/view/id/';

		} else if($tipo == 'servico'){
			//Serviço

			$db = new Application_Model_Servicos;
			$resultado = $db->find($id);
			$titulo = utf8_decode($resultado['servico']['nome_laboratorio']);
			$resumo = utf8_decode($resultado['servico']['descricao_laboratorio']);
			$link = 'http://www.cdt.unb.br/vitrinetecnologica/servicos/view/id/';

		}
        else if($tipo == 'noticia'){
			//Noticia

			$db = new Application_Model_Noticias;
			$resultado = $db->find($id);
			$titulo = utf8_decode($resultado['nome']);
			$resumo = utf8_decode($db->resumo($resultado['descricao']));
			$link = 'http://www.cdt.unb.br/vitrinetecnologica/noticias/view/id/';

		}

		$mensagem = $this->gerarMensagem($id,$titulo,$resumo,$link);

		$request = $this->getRequest();
   		$form    = new Application_Form_Email();

   		echo "&nbsp;";
    		if ($this->getRequest()->isPost()) {
        		if ($form->isValid($request->getPost())){
        			$emailForm = $form->getValues();
					$this->enviarEmail(array($emailForm['from'],$emailForm['nome']),array($emailForm['to'],$emailForm['to']),$assunto,$mensagem);
					echo "<script>parent.jQuery.fancybox.close();</script>";
			}
		}
		$this->view->form = $form;
	}
}
