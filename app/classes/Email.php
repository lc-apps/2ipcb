<?php

namespace app\classes;
use app\classes\Config;
use PHPMailer\PHPMailer\PHPMailer;

Class Email {
	//https://docs.zendframework.com/zend-mail/intro/
	// senha pE9H3tpu7w
	// email contato@2ipcb.com.br
	// smtp mail.2ipcb.com.br
	// Send the message

	// sem autenticação
	//http://www.ustrem.org/en/articles/send-mail-using-phpmailer-en/

	/**
	 * @param $fields
	 * @param $config
	 */
	public function sendMail($fields) {

		//PHPMailer Object
		$mail = new PHPMailer;

		$config = getConfig();

		      # Define os dados do servidor e tipo de conexão
			    $mail->IsSMTP(); // Define que a mensagem será SMTP
			    $mail->Host = "mail.2ipcb.com.br"; # Endereço do servidor SMTP
			    $mail->Port = 587; // Porta TCP para a conexão
			    $mail->SMTPAutoTLS = false; // Utiliza TLS Automaticamente se disponível
			    $mail->SMTPAuth = true; # Usar autenticação SMTP - Sim

			    $mail->Username = $config->email_contato; # Usuário de e-mail
			    $mail->Password = $config->senha_contato; // # Senha do usuário de e-mail

			    # Define o remetente (você)
			    $mail->From = $config->email_contato; # Seu e-mail
			    $mail->FromName = $fields->name; // Seu nome

			    //$mail->Sender = $fields->email;

			    //$mail->SMTPDebug = 2;

			    # Define os destinatário(s)
			    $mail->AddAddress($config->email_contato); # Os campos podem ser substituidos por variáveis
			    #$mail->AddAddress('webmaster@nomedoseudominio.com'); # Caso queira receber uma copia
			    #$mail->AddCC('ciclano@site.net', 'Ciclano'); # Copia
			    #$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); # Cópia Oculta

			    # Define os dados técnicos da Mensagem
			    $mail->IsHTML(true); # Define que o e-mail será enviado como HTML
			    #$mail->CharSet = 'iso-8859-1'; # Charset da mensagem (opcional)

			    # Define a mensagem (Texto e Assunto)
			    $mail->Subject = 'Formulario de Contato'; # Assunto da mensagem


			    $find = ['#nome#' => $fields->name ,
						 '#email#' => $fields->email,
						 '#texto#' => $fields->comments ];

			    $result = textReplace($config->texto_email_template, $find );

			    $mail->Body =  $result;
			    //$mail->AltBody = "Este é o corpo da mensagem de teste, somente Texto! \r\n :)";

			    # Define os anexos (opcional)
			    #$mail->AddAttachment("c:/temp/documento.pdf", "documento.pdf"); # Insere um anexo

			    # Envia o e-mail
			    $enviado = $mail->Send();

			    # Limpa os destinatários e os anexos
			    $mail->ClearAllRecipients();
			    $mail->ClearAttachments();

			    if (!$enviado) {
			    return $this->notSend();
			    } else {
			    return $this->send();
			    }
	

	}

	private function notSend() {

		$config = Config::load('email');

		flash(['message' => $config->error]);

		back();

		exit();
	}

	private function send() {

		$config = Config::load('email');

		flash(['message' => $config->success]);

		back();

		exit();
	}
}
