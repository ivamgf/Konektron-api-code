<?php
/**
 * This file is part of the Orkney Tech (http://orkneytech.com.br)
 *
 * Copyright (c) 2020  Orkney Tech (http://orkneytech.com.br)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 *
 * PHP Version 7
 *
 * @category Controller
 * @package  Orkney
 * @author   Orkney Tech <suporte@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para controle dos perfis dos usuários
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Profile
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Profile extends MY_Controller
{

    /**
     * Retorna os perfis dos usuários
     *
     * @return void
     */
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

    /**
     * Retorna um perfil do usuário pelo Id
     *
     * @param integer $id_profile Id do perfil
     *
     * @return void
     */
    public function consultProfileId(int $id_profile = 0)
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

    /**
     * Retorna os perfis do usuário pelo Id
     *
     * @param intetger $id_users Id do usuário
     *
     * @return void
     */
    public function consultProfileUsers(int $id_users = 0)
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

    /**
     * Registra um novo perfil
     *
     * @return void
     */
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

    /**
     * Atualiza um perfil
     *
     * @param integer $id_profile Id do perfil
     *
     * @return void
     */
    public function updateProfile(int $id_profile = 0)
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

    /**
     * Deleta um perfil
     *
     * @param integer $id_profile Id do perfil
     *
     * @return void
     */
    public function deleteProfile(int $id_profile = 0)
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
