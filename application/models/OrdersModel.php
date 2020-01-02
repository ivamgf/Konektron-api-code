<?php

	class OrdersModel extends CI_Model {
		
		public function getOrders() {
			return $this->db->get('orkney10_konektron_cli.orders')->result();
		}

		public function getOrdersId($id_orders) {
			return $this->db->get_where('orkney10_konektron_cli.orders', array('id_orders' => $id_orders))->row();
		}

		public function getOrdersUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.orders', array('id_users' => $id_users))->row();
		}

		public function insertOrders($orders) {
			$this->db->insert('orkney10_konektron_cli.orders', $orders);
		}

		public function patchOrders($id_orders, $orders) {
			$this->db->where('id_orders', $id_orders);
			$this->db->update('orkney10_konektron_cli.orders', $orders);

			if($this->db->affected_rows() > 0) {
				return $id_orders;
			} 
			return NULL;
		}

		public function delOrders($id_orders) {
			$this->db->where('id_orders', $id_orders);
			$this->db->delete('orkney10_konektron_cli.orders');
		}
	}
