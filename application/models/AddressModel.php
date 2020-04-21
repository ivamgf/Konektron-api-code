<?php

	class AddressModel extends CI_Model {
		
		public function getAddress() {
			return $this->db->get('orkney10_konektron_cli.address')->result();
		}

		public function getAddressId($id_address) {
			return $this->db->get_where('orkney10_konektron_cli.address', array('id_address' => $id_address))->row();
		}

		public function getAddressUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.address', array('id_users' => $id_users))->row();
		}

		public function insertAddress($address) {
			$this->db->insert('orkney10_konektron_cli.address', $address);
			return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
		}

		public function patchAddress($id_address, $address) {
			$this->db->where('id_address', $id_address);
			$this->db->update('orkney10_konektron_cli.address', $address);
			return $this->db->affected_rows() > 0;
		}

		public function delAddress($id_address) {
			$this->db->where('id_address', $id_address);
			$this->db->delete('orkney10_konektron_cli.address');
			return $this->db->affected_rows() > 0;
		}
	}
