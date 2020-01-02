<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign extends CI_Controller {
	
	public function signin()
	{
		// $this->load->view('welcome_message');
		echo "Signin";
		exit;
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
