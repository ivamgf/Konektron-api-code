<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign extends CI_Controller {
	
	public function signin($us_email, $us_password)
	{
		$this->load->model('SignModel', 'signModel', true);
		$signin = $this->signModel->signinUser($us_email, $us_password);
		if($signin) {
			$this -> session->set_userdata('usersSession', $signin);
			$message = 'Login realizado com sucesso!';
		} else {
			$message = 'Falha ao realizar o login!';
		}
		// redirect(base_url(''));
	}

	public function signinProviders()
	{
		$this->load->model('SignModel', 'signModel', true);
		$signinProviders = $this->signModel->signinProviders($pr_email, $pr_password);
		if($signinProviders) {
			$this -> session->set_userdata('providerSession', $signinProviders);
			$message = 'Login realizado com sucesso!';
		} else {
			$message = 'Falha ao realizar o login!';
		}
		// redirect(base_url(''));
	}

	public function signup()
	{
		$this->load->model('SignModel', 'signModel', true);
		$signup = [];
		$this->signModel->insert($signup);
	}

	public function signupProviders()
	{
		$this->load->model('SignModel', 'signModel', true);
		$signupProviders = [];
		$this->signModel->insert($signupProviders);
	}

	public function verify($us_email)
	{
		// Config E-mail
		$config['protocol'] = 'sendmail';
		$config['smtp_host'] = 'ssl://orkneytech.com.br';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'contatos@orkneytech.com.br';
		$config['smtp_pass'] = 'Orkneytech10106088';
		$config['smtp_charset'] = 'utf-8';
		$config['smtp_mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		// Config E-mail

		// Message E-mail
		$verify = 'verify';
		$URL = '';
		$Title = 'Ativação de conta';
		$Paragraph_1 = 'Ative sua conta para começar a usar o sistema, <br>';
		$Paragraph_2 = 'Se não foi você que se registrou, entre em contato conosco, <br>';
		$paragraph_3 = 'pelo e-mail contatos@orkneytech.com.br <br>';
		$paragraph_4 = 'Se você se registrou em nosso sistema recentemente, clique no link abaixo. <br>';
		$link_1 = "<a href='" . base_url("'".$URL."/{".$verify."}'") . "' target='_blank'>". base_url("'".$URL."/{".$verify."}'") ."</a>";
		$Msg = $Title . $Paragraph_1 . $Paragraph_2 . $paragraph_3 . $paragraph_4 . $link_1;
		// Message E-mail

		// Send E-mail
		$this->email->from($config['smtp_user'], 'Konektron');
		$this->email->to($us_email);
		$this->email->subject('Recuperação de Senha');
		$this->email->message($Msg);
		$this->email->send();			
		// echo $this->email->print_debugger();
		// Send E-mail
		
		// Message App
		$message = 'Enviamos um e-mail para você poder redefinir a senha!';
	}

	public function verifyProviders($us_email)
	{
		// Config E-mail
		$config['protocol'] = 'sendmail';
		$config['smtp_host'] = 'ssl://orkneytech.com.br';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'contatos@orkneytech.com.br';
		$config['smtp_pass'] = 'Orkneytech10106088';
		$config['smtp_charset'] = 'utf-8';
		$config['smtp_mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		// Config E-mail

		// Message E-mail
		$verify = 'verify';
		$URL = '';
		$Title = 'Ativação de conta';
		$Paragraph_1 = 'Ative sua conta para começar a usar o sistema, <br>';
		$Paragraph_2 = 'Se não foi você que se registrou, entre em contato conosco, <br>';
		$paragraph_3 = 'pelo e-mail contatos@orkneytech.com.br <br>';
		$paragraph_4 = 'Se você se registrou em nosso sistema recentemente, clique no link abaixo. <br>';
		$link_1 = "<a href='" . base_url("'".$URL."/{".$verify."}'") . "' target='_blank'>". base_url("'".$URL."/{".$verify."}'") ."</a>";
		$Msg = $Title . $Paragraph_1 . $Paragraph_2 . $paragraph_3 . $paragraph_4 . $link_1;
		// Message E-mail

		// Send E-mail
		$this->email->from($config['smtp_user'], 'Konektron');
		$this->email->to($us_email);
		$this->email->subject('Recuperação de Senha');
		$this->email->message($Msg);
		$this->email->send();			
		// echo $this->email->print_debugger();
		// Send E-mail
		
		// Message App
		$message = 'Enviamos um e-mail para você poder redefinir a senha!';
	}

	public function ativation()
	{
		// Update for ativation
		$this->load->model('SignModel', 'signModel', true);
		$ativation = $this->signModel->ativationModel();
		$status = $this->input->post('status');
		$activationStatus = $this->usersSession->ativationModel($id_users);
	}

	public function ativationProviders()
	{
		// Update for ativation
		$this->load->model('SignModel', 'signModel', true);
		$ativationProviders = $this->signModel->ativationProvidersModel();
		$status = $this->input->post('status');
		$activationProvidersStatus = $this->providerSession->ativationProvidersModel($id_providers);
	}

	public function recoverToken($token)
	{
		$tokenValidRecover = $this->usersSession->tokenValidRecover($token);

		$data = array(
			'token' => $token,
			'tokenValidRecover' => $tokenValidRecover
		);
	}

	public function recover($token)
	{
		$password = sha1($this->input->post('password'));
		$newPassword = $this->usersSession->updatePassword($token, $password);
		if ($newPassword)
		{
			$message = 'Senha alterada com sucesso!';
			redirect(base_url('sign/signin'));
		}
		else
		{
			$message = 'Erro, não foi possível alterar a senha!';
			redirect(base_url('sign/recover/{$token}'));
		}
	}

	public function forgot($us_email)
	{
		// $this->load->library('email');
				
		$token = md5(date('YmdHis'), $us_email);
		$tokenValid = $this->usersSession->tokenValidForgot($us_email, $token);
		if($tokenValid)
		{			
			// Config E-mail
			$config['protocol'] = 'sendmail';
			$config['smtp_host'] = 'ssl://orkneytech.com.br';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = 'contatos@orkneytech.com.br';
			$config['smtp_pass'] = 'Orkneytech10106088';
			$config['smtp_charset'] = 'utf-8';
			$config['smtp_mailtype'] = 'html';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);
			// Config E-mail

			// Message E-mail
			$URL = '';
			$Title = 'Redefinição de senha';
			$Paragraph_1 = 'Recentemente recebemos uma solicitação sua para redefinição de senha, <br>';
			$Paragraph_2 = 'Se não foi você que solicitou, entre em contato conosco, <br>';
			$paragraph_3 = 'pelo e-mail contatos@orkneytech.com.br <br>';
			$paragraph_4 = 'Se foi você que solicitou a redefinição de senha, clique no link abaixo. <br>';
			$link_1 = "<a href='" . base_url("'".$URL."/{".$token."}'") . "' target='_blank'>". base_url("'".$URL."/{".$token."}'") ."</a>";
			$Msg = $Title . $Paragraph_1 . $Paragraph_2 . $paragraph_3 . $paragraph_4 . $link_1;
			// Message E-mail

			// Send E-mail
			$this->email->from($config['smtp_user'], 'Konektron');
			$this->email->to($us_email);
			$this->email->subject('Recuperação de Senha');
			$this->email->message($Msg);
			$this->email->send();			
			// echo $this->email->print_debugger();
			// Send E-mail
			
			// Message App
			$message = 'Enviamos um e-mail para você poder redefinir a senha!';
		} 
		else 
		{
			$message = 'Não existe um usuário cadastrado com este E-mail!';
		}
		
	}

	public function recoverTokenProviders($token)
	{
		$tokenValidRecoverproviders = $this->providerSession->tokenValidRecoverProviders($token);

		$data = array(
			'token' => $token,
			'tokenValidRecoverProviders' => $tokenValidRecoverProviders
		);
	}

	public function recoverProviders($token)
	{
		$password = sha1($this->input->post('password'));
		$newPassword = $this->providerSession->updatePassword($token, $password);
		if ($newPassword)
		{
			$message = 'Senha alterada com sucesso!';
			redirect(base_url('sign/signupProviders'));
		}
		else
		{
			$message = 'Erro, não foi possível alterar a senha!';
			redirect(base_url('sign/recoverProviders/{$token}'));
		}
	}

	public function forgotProviders($us_email)
	{
		// $this->load->library('email');
				
		$token = md5(date('YmdHis'), $us_email);
		$tokenValid = $this->providerSession->tokenValidForgotProviders($pr_email, $token);
		if($tokenValid)
		{			
			// Config E-mail
			$config['protocol'] = 'sendmail';
			$config['smtp_host'] = 'ssl://orkneytech.com.br';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = 'contatos@orkneytech.com.br';
			$config['smtp_pass'] = 'Orkneytech10106088';
			$config['smtp_charset'] = 'utf-8';
			$config['smtp_mailtype'] = 'html';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);
			// Config E-mail

			// Message E-mail
			$URL = '';
			$Title = 'Redefinição de senha';
			$Paragraph_1 = 'Recentemente recebemos uma solicitação sua para redefinição de senha, <br>';
			$Paragraph_2 = 'Se não foi você que solicitou, entre em contato conosco, <br>';
			$paragraph_3 = 'pelo e-mail contatos@orkneytech.com.br <br>';
			$paragraph_4 = 'Se foi você que solicitou a redefinição de senha, clique no link abaixo. <br>';
			$link_1 = "<a href='" . base_url("'".$URL."/{".$token."}'") . "' target='_blank'>". base_url("'".$URL."/{".$token."}'") ."</a>";
			$Msg = $Title . $Paragraph_1 . $Paragraph_2 . $paragraph_3 . $paragraph_4 . $link_1;
			// Message E-mail

			// Send E-mail
			$this->email->from($config['smtp_user'], 'Konektron');
			$this->email->to($us_email);
			$this->email->subject('Recuperação de Senha');
			$this->email->message($Msg);
			$this->email->send();			
			// echo $this->email->print_debugger();
			// Send E-mail
			
			// Message App
			$message = 'Enviamos um e-mail para você poder redefinir a senha!';
		} 
		else 
		{
			$message = 'Não existe um usuário cadastrado com este E-mail!';
		}
		
	}

	public function contact($Message)
	{
		// Config E-mail
		$config['protocol'] = 'sendmail';
		$config['smtp_host'] = 'ssl://orkneytech.com.br';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'contatos@orkneytech.com.br';
		$config['smtp_pass'] = 'Orkneytech10106088';
		$config['smtp_charset'] = 'utf-8';
		$config['smtp_mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		// Config E-mail

		// Message E-mail
		$URL = '';
		$Title = 'Mensagem de cliente';
		$Msg = $Title . $Message;
		// Message E-mail

		// Send E-mail
		$this->email->from($config['smtp_user'], 'Konektron');
		$this->email->to('contatos@orkneytech.com.br');
		$this->email->subject('Mensagem de cliente');
		$this->email->message($Msg);
		$this->email->send();			
		// echo $this->email->print_debugger();
		// Send E-mail
		
		// Message App
		$message = 'Enviamos um e-mail para você poder redefinir a senha!';
	}

	public function logoutUser()
	{
		$this->session->unset_userdata('usersSession');
	}

	public function logoutProviders()
	{
		$this->session->unset_userdata('providerSession');
	}
}
