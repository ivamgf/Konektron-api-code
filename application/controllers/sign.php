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

	public function verify()
	{
		// $this->load->view('welcome_message');
		echo "verify";
		exit;
	}
	public function forgot($us_email)
	{

		/*
		$this->load->library('email');	
		$this->email->from($us_email, 'User');	
		$this->email->subject('Recuperar Senha');
		$this->email->message('');			
		$this->email->send();			
		echo $this->email->print_debugger();
		*/			
		
	}
	public function tokenPassword($us_email)
	{
		$token = md5(date('YmdHis'), $us_email);
		$tokenValid = $this->usersSession->tokenValidForgot($us_email, $token);
		if($tokenValid)
		{			
			$message = 'Enviamos um e-mail para você poder redefinir a senha!';
		} 
		else 
		{
			$message = 'Não existe um usuário cadastrado com este E-mail!';
		}
	}
	public function contact()
	{
		// $this->load->view('welcome_message');
		echo "Contact";
		exit;
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
