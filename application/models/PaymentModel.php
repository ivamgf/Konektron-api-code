<?php

	class PaymentModel extends CI_Model {
		
		public function getPayment() {
			return $this->db->get('orkney10_konektron_cli.payment')->result();
		}

		public function getPaymentId($id_payment) {
			return $this->db->get_where('orkney10_konektron_cli.payment', array('id_payment' => $id_payment))->row();
		}

		public function getPaymentUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.payment', array('id_users' => $id_users))->row();
		}

		public function insertPayment($payment) {
			$this->db->insert('orkney10_konektron_cli.payment', $payment);
		}

		public function patchPayment($id_payment, $payment) {
			$this->db->where('id_payment', $id_payment);
			$this->db->update('orkney10_konektron_cli.payment', $payment);

			if($this->db->affected_rows() > 0) {
				return $id_payment;
			} 
			return NULL;
		}

		public function delPayment($id_payment) {
			$this->db->where('id_payment', $id_payment);
			$this->db->delete('orkney10_konektron_cli.payment');
		}
	}
