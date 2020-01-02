<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
		
	public function consultProfile()
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$list_profile = $this->profileModel->getProfile();

		$dataProfile = array(
			"list_profile" => $list_profile
		);
	}

	public function consultProfileId($id_profile)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = $this->profileModel->getProfileId($id_profile);
		$dataProfile = array(
			"profile" => $profile
		);
	}

	public function consultProfileUsers($id_users)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = $this->profileModel->getProfileUsers($id_users);
		$dataProfile = array(
			"profile" => $profile
		);
	}

	public function registerProfile()
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = [];
		$this->profileModel->insert($profile);
	}

	public function updateProfile($id_profile)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = array();
		$id = $this->profileModel->patchProfile($id_profile, $profile);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-profile', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-profile', 'Alteração feita com sucesso!');
		}
		$msgProfile = $this->session->set_flashdata('edit-profile');
	}

	public function deleteProfile($id_profile)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$this->profileModel->delProfile($id_profile);
	}
}
