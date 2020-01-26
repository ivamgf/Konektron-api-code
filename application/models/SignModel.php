<?php

	class SignModel extends CI_Model {
		
		public function signup($signup) {
			$this->db->insert('orkney10_konektron_cli.users', $signup);
			return $this->db->insert_id();
		}

		public function signupProviders($signupProviders) {
			$this->db->insert('orkney10_konektron_cli.providers', $signupProviders);
			return $this->db->insert_id();
		}

		public function signinUser($us_email, $us_password) {
			$this->db->where("email", $us_email);
			$this->db->where("password", $us_password);
			$user = $this->db->get("user")->row_array();
			return $user;
		}

		public function signinProviders($pr_email, $pr_password) {
			$this->db->where("email", $pr_email);
			$this->db->where("password", $pr_password);
			$provider = $this->db->get("provider")->row_array();
			return $provider;
		}

		public function getAuthUsers($id_auth) {
			return $this->db->get_where('orkney10_konektron_cli.authorization', array('id_auth' => $id_auth))->row();
		}
	}
