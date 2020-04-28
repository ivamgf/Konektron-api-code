<?php
/**
 * Model para os dados do Dashboard
 *
 * @category   Model
 * @package    Konektron
 * @subpackage DashboardModel
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class DashboardModel extends CI_Model
{

    /**
     * Retorna os administradores do sistema
     *
     * @return void
     */
    public function getAdmins()
    {
        return $this->db->get('orkney10_konektron_cli.admin')->result();
    }

    /**
     * Retorna os clientes do sistema
     *
     * @return void
     */
    public function getClients()
    {
        return $this->db->get('orkney10_konektron_cli.users')->result();
    }
}
