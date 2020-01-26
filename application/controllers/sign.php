<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign extends CI_Controller {
	
	public function signin($us_email, $us_password)
	{
		$this->load->model('SignModel', 'signModel', true);
		$signin = $this->signModel->signinUser($us_email, $us_password);
		if($signin) {
			$this -> session->set_userdata('usersSession', $signin);
			// msg success
		} else {
			// msg danger
		}
		// redirect(base_url(''));
	}

	public function signinProviders()
	{
		$this->load->model('SignModel', 'signModel', true);
		$signinProviders = $this->signModel->signinProviders($pr_email, $pr_password);
		if($signinProviders) {
			$this -> session->set_userdata('providerSession', $signinProviders);
			// msg success
		} else {
			// msg danger
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
	public function logoutUser()
	{
		$this->session->unset_userdata('usersSession');
	}
	public function logoutProviders()
	{
		$this->session->unset_userdata('providerSession');
	}
}
