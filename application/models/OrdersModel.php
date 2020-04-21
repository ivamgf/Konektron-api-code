<?php

	class OrdersModel extends CI_Model {
		
		public function getOrders() {
			return $this->db->get('orkney10_konektron_cli.orders')->result();
		}

		public function getOrdersId($id_order) {
			return $this->db->get_where('orkney10_konektron_cli.orders', array('id_order' => $id_order))->row();
		}

		public function getOrdersUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.orders', array('id_users' => $id_users))->row();
		}

		public function insertOrders($orders) {
			$this->db->insert('orkney10_konektron_cli.orders', $orders);
			return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
		}

		public function patchOrders($id_order, $orders) {
			$this->db->where('id_order', $id_order);
			$this->db->update('orkney10_konektron_cli.orders', $orders);
			return $this->db->affected_rows() > 0;
		}

		public function delOrders($id_order) {
			$this->db->where('id_order', $id_order);
			$this->db->delete('orkney10_konektron_cli.orders');
			return $this->db->affected_rows() > 0;
		}
	}
