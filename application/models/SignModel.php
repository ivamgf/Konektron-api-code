<?php

	class SignModel extends CI_Model {
		
		public function signup($signup) {
			$this->db->insert('orkney10_konektron_cli.users', $signup);
		}

		public function signupProviders($signupProviders) {
			$this->db->insert('orkney10_konektron_cli.providers', $signupProviders);
		}

		public function signinUser($us_email, $us_password) {
			$this->db->where("email", $us_email);
			$this->db->where("password", $us_password);
			$user = $this->db->get("user")->row_array();
			return $user;
		}

		public function getAuthUsers($id_auth) {
			return $this->db->get_where('orkney10_konektron_cli.authorization', array('id_auth' => $id_auth))->row();
		}
	}
