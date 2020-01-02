<?php

	class DashboardModel extends CI_Model {
		
		public function getAdmin($id_admin) {
			return $this->db->get('orkney10_konektron_cli.admin')->result();
		}

		public function getClients() {
			return $this->db->get('orkney10_konektron_cli.users')->result();
		}
	}
