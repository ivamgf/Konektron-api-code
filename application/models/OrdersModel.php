<?php
/**
 * Model para cadastro das ordens
 *
 * @category   Model
 * @package    Konektron
 * @subpackage OrdersModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class OrdersModel extends CI_Model
{

    /**
     * Retorna as ordens
     *
     * @return array
     */
    public function getOrders()
    {
        return $this->db->get('orkney10_konektron_cli.orders')
            ->result() ?? [];
    }

    /**
     * Retorna um ordem pelo Id
     *
     * @param integer $id_order Id da ordem
     *
     * @return stdClass
     */
    public function getOrdersId(int $id_order): stdClass
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.orders',
            [
                'id_order' => $id_order
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera as ordens do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return stdClass
     */
    public function getOrdersUsers(int $id_users): stdClass
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.orders',
            [
                'id_users' => $id_users
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere uma nova ordem no sistema
     *
     * @param stdClass $orders Dados da ordem
     *
     * @return integer
     */
    public function insertOrders(stdClass $orders): int
    {
        $this->db->insert('orkney10_konektron_cli.orders', $orders);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza uma ordem
     *
     * @param integer  $id_order Id da ordem
     * @param stdClass $orders   Dados da ordem
     *
     * @return boolean
     */
    public function patchOrders(int $id_order, stdClass $orders): bool
    {
        $this->db->where('id_order', $id_order);
        $this->db->update('orkney10_konektron_cli.orders', $orders);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove uma ordem cadastrada
     *
     * @param integer $id_order Id da ordem
     *
     * @return boolean
     */
    public function delOrders(int $id_order): bool
    {
        $this->db->where('id_order', $id_order);
        $this->db->delete('orkney10_konektron_cli.orders');
        return $this->db->affected_rows() > 0;
    }
}
