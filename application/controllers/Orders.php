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
 * @author   Orkney Tech <contato@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para controle das Ordens
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Orders
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Orders extends MY_Controller
{

    /**
     * Retorna as ordens cadastradas
     *
     * @return void
     */
    public function consultOrder()
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        $list_orders = $this->ordersModel->getOrders();

        $this->response(
            [
                "list_orders" => $list_orders
            ],
            200
        );
    }

    /**
     * Retorna uma ordem pelo Id
     *
     * @param integer $id_order Id da ordem
     *
     * @return void
     */
    public function consultOrderId(int $id_order = 0)
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        $orders = $this->ordersModel->getOrdersId($id_order);

        $this->response(
            [
                "orders" => $orders
            ],
            200
        );
    }

    /**
     * Retorna as ordens do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function consultOrderUsers(int $id_users = 0)
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        $orders = $this->ordersModel->getOrdersUsers($id_users);

        $this->response(
            [
                "orders" => $orders
            ],
            200
        );
    }

    /**
     * Registra uma nova ordem no sistema
     *
     * @return void
     */
    public function registerOrder()
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        if ($orders = $this->getData()) {
            $orders->or_created = date('Y-m-d H:i:s');
            $orders->or_modified = date('Y-m-d H:i:s');
            $id = $this->ordersModel->insertOrders($orders);
            $status_code = !empty($id) ? 201 : 404;

            $this->response(
                [
                    'id_order' => $id
                ],
                $status_code
            );
        }
    }

    /**
     * Atualiza uma ordem pelo Id
     *
     * @param integer $id_order Id da ordem
     *
     * @return void
     */
    public function updateOrder(int $id_order = 0)
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        if ($orders = $this->getData()) {
            $orders->or_modified = date('Y-m-d H:i:s');
            $updated = $this->ordersModel->patchOrders($id_order, $orders);
            $output = !empty($updated)
                ? ['updated' => $updated ]
                : ['code' => 404, 'msg' => 'Ordem não encontrada!' ];
            $status_code = $updated ? 204 : 404;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Remove uma ordem do sistema
     *
     * @param integer $id_order Id da ordem
     *
     * @return void
     */
    public function deleteOrder(int $id_order = 0)
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        $deleted = $this->ordersModel->delOrders($id_order);
        $output = !empty($deleted)
                ? ['deleted' => $deleted ]
                : ['code' => 404, 'msg' => 'Ordem não encontrada!' ];
        $status_code = $deleted ? 204 : 404;

        $this->response(
            $output,
            $status_code
        );
    }
}
