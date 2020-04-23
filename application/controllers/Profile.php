<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

    public function consultProfile()
    {
        $this->load->model('ProfileModel', 'profileModel', true);
        $list_profile = $this->profileModel->getProfile();

        $this->response(
            [
                "list_profile" => $list_profile
            ],
            200
        );
    }

    public function consultProfileId($id_profile)
    {
        $this->load->model('ProfileModel', 'profileModel', true);
        $profile = $this->profileModel->getProfileId($id_profile);

        $this->response(
            [
                "profile" => $profile
            ],
            200
        );
    }

    public function consultProfileUsers($id_users)
    {
        $this->load->model('ProfileModel', 'profileModel', true);
        $profile = $this->profileModel->getProfileUsers($id_users);

        $this->response(
            [
                "profile" => $profile
            ],
            200
        );
    }

    public function registerProfile()
    {
        $this->load->model('ProfileModel', 'profileModel', true);
        if ($profile = $this->getData()) {
            $profile->pf_created = date('Y-m-d H:i:s');
            $profile->pf_modified = date('Y-m-d H:i:s');
            $id = $this->profileModel->insertProfile($profile);
            $status_code = !empty($id) ? 201 : 400;

            $this->response(
                [
                    "id_profile" => $id
                ],
                $status_code
            );
        }
    }

    public function updateProfile($id_profile)
    {
        $this->load->model('ProfileModel', 'profileModel', true);
        if ($profile = $this->getData()) {
            $profile->pf_modified = date('Y-m-d H:i:s');
            $updated = $this->profileModel->patchProfile($id_profile, $profile);
            $status_code = $updated ? 204 : 400;

            $this->response(
                null,
                $status_code
            );
        }
    }

    public function deleteProfile($id_profile)
    {
        $this->load->model('ProfileModel', 'profileModel', true);
        $deleted = $this->profileModel->delProfile($id_profile);
        $status_code = $deleted ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
}
