<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign extends CI_Controller {
	
	public function signin($us_email, $us_password)
	{
		$this->load->model('SignModel', 'signModel', true);
		$signin = $this->signModel->signinUser($us_email, $us_password);
		if(is_null($signin)) {
			redirect(base_url(''));
		} else {
			$dataSignin = array(
				"signin" => $signin
			);
	
			$this->load->model('SignModel', 'signModel', true);
			$auth = $this->signModel->getAuthUsers($id_auth);
			$dataAuth = array(
				"auth" => $auth
			);

			$session = array(
				"id" => $signin -> id,
				"user" => $signin -> user,
				"email" => $signin -> email
			);
			$this -> session->set_userdata('usersSession', $session);
		}
	}

	public function signinProviders()
	{
		// $this->load->view('welcome_message');
		echo "SigninProviders";
		exit;
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
	public function forgot()
	{
		// $this->load->view('welcome_message');
		echo "Forgot";
		exit;
	}
	public function contact()
	{
		// $this->load->view('welcome_message');
		echo "Contact";
		exit;
	}
}
