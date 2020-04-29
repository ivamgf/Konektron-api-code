<?php
/**
 * Model para cadastro dos endereços
 *
 * @category   Model
 * @package    Konektron
 * @subpackage AddressModel
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class AddressModel extends CI_Model
{

    /**
     * Recupera os endereços
     *
     * @return void
     */
    public function getAddress()
    {
        return $this->db->get('orkney10_konektron_cli.address')
            ->result();
    }

    /**
     * Recupera os endereços pelo Id
     *
     * @param integer $id_address Id do endereço
     *
     * @return void
     */
    public function getAddressId(int $id_address)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.address',
            [
                'id_address' => $id_address
            ]
        )->row();
    }

    /**
     * Recupera os endereços do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function getAddressUsers(int $id_users)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.address',
            [
                'id_users' => $id_users
            ]
        )->row();
    }

    /**
     * Insere um novo endereço
     *
     * @param stdClass $address Dados do endereço
     *
     * @return void
     */
    public function insertAddress(stdClass $address)
    {
        $this->db->insert('orkney10_konektron_cli.address', $address);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza um endereço
     *
     * @param integer $id_address Id do endereço
     * @param stdClass  $address    Dados do endereço
     *
     * @return void
     */
    public function patchAddress(int $id_address, stdClass  $address)
    {
        $this->db->where('id_address', $id_address);
        $this->db->update('orkney10_konektron_cli.address', $address);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove um endereço pelo Id
     *
     * @param integer $id_address Id do endereço
     *
     * @return void
     */
    public function delAddress(int $id_address)
    {
        $this->db->where('id_address', $id_address);
        $this->db->delete('orkney10_konektron_cli.address');
        return $this->db->affected_rows() > 0;
    }
}
