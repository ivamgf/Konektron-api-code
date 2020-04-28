<?php
/**
 * Model para cadastro dos pagamentos
 *
 * @category   Model
 * @package    Konektron
 * @subpackage ProfileModel
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class ProfileModel extends CI_Model
{

    /**
     * Recupera o perfil do usuário
     *
     * @return void
     */
    public function getProfile()
    {
        return $this->db->get('orkney10_konektron_cli.profiles')->result();
    }

    /**
     * Recupera o perfil do usuário pelo id
     *
     * @param integer $id_profile Id do perfil
     *
     * @return void
     */
    public function getProfileId(int $id_profile)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.profiles',
            [
                'id_profile' => $id_profile
            ]
        )->row();
    }

    /**
     * Recupera o perfil pelo id do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function getProfileUsers(int $id_users)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.profiles',
            [
                'id_users' => $id_users
            ]
        )->row();
    }

    /**
     * Insere um novo perfil
     *
     * @param object $profile Dados do perfil
     *
     * @return void
     */
    public function insertProfile(object $profile)
    {
        $this->db->insert('orkney10_konektron_cli.profiles', $profile);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Atualiza um perfil pelo id
     *
     * @param integer $id_profile Id do perfil
     * @param object  $profile    Dados do perfil
     *
     * @return void
     */
    public function patchProfile(int $id_profile, objeect $profile)
    {
        $this->db->where('id_profile', $id_profile);
        $this->db->update('orkney10_konektron_cli.profiles', $profile);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove um perfil pelo id
     *
     * @param integer $id_profile Id do perfil
     *
     * @return void
     */
    public function delProfile(int $id_profile)
    {
        $this->db->where('id_profile', $id_profile);
        $this->db->delete('orkney10_konektron_cli.profiles');
        return $this->db->affected_rows() > 0;
    }
}
