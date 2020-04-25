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
 * Controller para as informações do Dashboard
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Dashboard
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Dashboard extends MY_Controller
{

    /**
     * Retorna os admins do sistema
     *
     * @return void
     */
    public function profileAdmin()
    {
        $this->load->model('DashboardModel', 'dashboardModel', true);
        $list_admins = $this->dashboardModel->getAdmins();

        $this->response(
            [
                "list_admins" => $list_admins
            ],
            200
        );
    }

    /**
     * Retorna os clientes do sistema
     *
     * @return void
     */
    public function clients()
    {
        $this->load->model('DashboardModel', 'dashboardModel', true);
        $list_clients = $this->dashboardModel->getClients();

        $this->response(
            [
                "list_clients" => $list_clients
            ],
            200
        );
    }
}
