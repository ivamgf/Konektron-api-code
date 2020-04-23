<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {
        
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

    public function consultOrderId($id_order)
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

    public function consultOrderUsers($id_users)
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

    public function registerOrder()
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        $orders = (array)json_decode($this->input->raw_input_stream);
        $orders['or_created'] = date('Y-m-d H:i:s');
        $orders['or_modified'] = date('Y-m-d H:i:s');
        $id = $this->ordersModel->insertOrders($orders);
        $status_code = !empty($id) ? 201 : 400;

        $this->response(
            [
                'id_order' => $id
            ],
            $status_code
        );
    }

    public function updateOrder($id_order)
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        $orders = (array)json_decode($this->input->raw_input_stream);
        $orders['or_modified'] = date('Y-m-d H:i:s');
        $updated = $this->ordersModel->patchOrders($id_order, $orders);
        $status_code = $updated ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }

    public function deleteOrder($id_order)
    {
        $this->load->model('OrdersModel', 'ordersModel', true);
        $deleted = $this->ordersModel->delOrders($id_order);
        $status_code = $deleted ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
}
