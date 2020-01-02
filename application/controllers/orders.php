<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
		
	public function consultOrder()
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$list_orders = $this->ordersModel->getOrders();

		$dataOrders = array(
			"list_orders" => $list_orders
		);
	}

	public function consultOrderId($id_order)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$orders = $this->ordersModel->getOrdersId($id_order);
		$dataOrders = array(
			"orders" => $orders
		);
	}

	public function consultOrderUsers($id_users)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$orders = $this->ordersModel->getOrdersUsers($id_users);
		$dataOrders = array(
			"orders" => $orders
		);
	}

	public function registerOrder()
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$orders = [];
		$this->ordersModel->insert($orders);
	}

	public function updateOrder($id_order)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$orders = array();
		$id = $this->ordersModel->patchOrders($id_order, $orders);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-orders', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-orders', 'Alteração feita com sucesso!');
		}
		$msgOrders = $this->session->set_flashdata('edit-orders');
	}

	public function deleteOrder($id_order)
	{
		$this->load->model('OrdersModel', 'ordersModel', true);
		$this->ordersModel->delOrders($id_order);
	}
}
