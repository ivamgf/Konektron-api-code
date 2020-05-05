<?php
/**
 * Model para os dados do Dashboard
 *
 * @category   Model
 * @package    Konektron
 * @subpackage DashboardModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class DashboardModel extends CI_Model
{

    /**
     * Retorna os administradores do sistema
     *
     * @return array
     */
    public function getAdmins(): array
    {
        return $this->db->get('admin')
            ->result() ?? [];
    }

    /**
     * Retorna os clientes do sistema
     *
     * @return array
     */
    public function getClients(): array
    {
        return $this->db->get('users')
            ->result() ?? [];
    }
}
