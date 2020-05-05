<?php
/**
 * Model para cadastro dos endereços
 *
 * @category   Model
 * @package    Konektron
 * @subpackage AddressModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class AddressModel extends CI_Model
{

    /**
     * Recupera os endereços
     *
     * @return array
     */
    public function getAddress(): array
    {
        return $this->db->get('address')
            ->result() ?? [];
    }

    /**
     * Recupera os endereços pelo Id
     *
     * @param integer $id_address Id do endereço
     *
     * @return stdClass
     */
    public function getAddressId(int $id_address): stdClass
    {
        return $this->db->get_where(
            'address',
            [
                'id_address' => $id_address
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera os endereços do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return stdClass
     */
    public function getAddressUsers(int $id_users): stdClass
    {
        return $this->db->get_where(
            'address',
            [
                'id_users' => $id_users
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere um novo endereço
     *
     * @param stdClass $address Dados do endereço
     *
     * @return integer
     */
    public function insertAddress(stdClass $address): int
    {
        $this->db->insert('address', $address);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza um endereço
     *
     * @param integer  $id_address Id do endereço
     * @param stdClass $address    Dados do endereço
     *
     * @return boolean
     */
    public function patchAddress(int $id_address, stdClass  $address): bool
    {
        $this->db->where('id_address', $id_address);
        $this->db->update('address', $address);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove um endereço pelo Id
     *
     * @param integer $id_address Id do endereço
     *
     * @return boolean
     */
    public function delAddress(int $id_address): bool
    {
        $this->db->where('id_address', $id_address);
        $this->db->delete('address');
        return $this->db->affected_rows() > 0;
    }
}
