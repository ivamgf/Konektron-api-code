<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
		
	public function consultPayment()
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$list_payment = $this->paymentModel->getPayment();

		$dataPayment = array(
			"list_payment" => $list_payment
		);
	}

	public function consultPaymentId($id_payment)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = $this->paymentModel->getPaymentId($id_payment);
		$dataPayment = array(
			"payment" => $payment
		);
	}

	public function consultPaymentUsers($id_users)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = $this->paymentModel->getPaymentUsers($id_users);
		$dataPayment = array(
			"payment" => $payment
		);
	}

	public function registerPayment()
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = [];
		$this->paymentModel->insert($payment);
	}

	public function updatePayment($id_payment)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = array();
		$id = $this->paymentModel->patchPayment($id_payment, $payment);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-payment', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-payment', 'Alteração feita com sucesso!');
		}
		$msgPayment = $this->session->set_flashdata('edit-payment');
	}

	public function deletePayment($id_payment)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$this->paymentModel->delPayment($id_payment);
	}	
}
