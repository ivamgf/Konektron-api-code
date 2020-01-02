<?php

	class SignModel extends CI_Model {
		
		public function signup($signup) {
			$this->db->insert('orkney10_konektron_cli.users', $signup);
		}

		public function signupProviders($signupProviders) {
			$this->db->insert('orkney10_konektron_cli.providers', $signupProviders);
		}
	}
