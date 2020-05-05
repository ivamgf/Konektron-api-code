<?php
/**
 * Model para cadastro dos pagamentos
 *
 * @category   Model
 * @package    Konektron
 * @subpackage ProfileModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class ProfileModel extends CI_Model
{

    /**
     * Recupera o perfil do usuário
     *
     * @return array
     */
    public function getProfile(): array
    {
        return $this->db->get('profiles')
            ->result() ?? [];
    }

    /**
     * Recupera o perfil do usuário pelo id
     *
     * @param integer $id_profile Id do perfil
     *
     * @return stdClass
     */
    public function getProfileId(int $id_profile): stdClass
    {
        return $this->db->get_where(
            'profiles',
            [
                'id_profile' => $id_profile
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera o perfil pelo id do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return stdClass
     */
    public function getProfileUsers(int $id_users): stdClass
    {
        return $this->db->get_where(
            'profiles',
            [
                'id_users' => $id_users
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere um novo perfil
     *
     * @param stdClass $profile Dados do perfil
     *
     * @return integer
     */
    public function insertProfile(stdClass $profile): int
    {
        $this->db->insert('profiles', $profile);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza um perfil pelo id
     *
     * @param integer  $id_profile Id do perfil
     * @param stdClass $profile    Dados do perfil
     *
     * @return boolean
     */
    public function patchProfile(int $id_profile, stdClass $profile): bool
    {
        $this->db->where('id_profile', $id_profile);
        $this->db->update('profiles', $profile);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove um perfil pelo id
     *
     * @param integer $id_profile Id do perfil
     *
     * @return boolean
     */
    public function delProfile(int $id_profile): bool
    {
        $this->db->where('id_profile', $id_profile);
        $this->db->delete('profiles');
        return $this->db->affected_rows() > 0;
    }
}
