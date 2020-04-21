<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
		
	public function consultOrder()
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$list_orders = $this->ordersModel->getOrders();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_orders" => $list_orders
                    ]
                )
            );
	}

	public function consultOrderId($id_order)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$orders = $this->ordersModel->getOrdersId($id_order);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"orders" => $orders
                    ]
                )
            );
	}

	public function consultOrderUsers($id_users)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$orders = $this->ordersModel->getOrdersUsers($id_users);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"orders" => $orders
                    ]
                )
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
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_order' => $id ]
                )
            );
	}

	public function updateOrder($id_order)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$orders = (array)json_decode($this->input->raw_input_stream);
		$orders['or_modified'] = date('Y-m-d H:i:s');
		$updated = $this->ordersModel->patchOrders($id_order, $orders);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}

	public function deleteOrder($id_order)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$deleted = $this->ordersModel->delOrders($id_order);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
}
