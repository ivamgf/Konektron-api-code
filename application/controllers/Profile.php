<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
		
	public function consultProfile()
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$list_profile = $this->profileModel->getProfile();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_profile" => $list_profile
                    ]
                )
            );
	}

	public function consultProfileId($id_profile)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = $this->profileModel->getProfileId($id_profile);

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"profile" => $profile
                    ]
                )
            );
	}

	public function consultProfileUsers($id_users)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = $this->profileModel->getProfileUsers($id_users);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"profile" => $profile
                    ]
                )
            );
	}

	public function registerProfile()
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = (array)json_decode($this->input->raw_input_stream);
		$profile['pf_created'] = date('Y-m-d H:i:s');
		$profile['pf_modified'] = date('Y-m-d H:i:s');
		$id = $this->profileModel->insertProfile($profile);
		$status_code = !empty($id) ? 201 : 400;
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_profile' => $id ]
                )
            );
	}

	public function updateProfile($id_profile)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$profile = (array)json_decode($this->input->raw_input_stream);
		$profile['pf_modified'] = date('Y-m-d H:i:s');
		$updated = $this->profileModel->patchProfile($id_profile, $profile);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}

	public function deleteProfile($id_profile)
	{
		$this->load->model('ProfileModel', 'profileModel', true);
		$deleted = $this->profileModel->delProfile($id_profile);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
}
