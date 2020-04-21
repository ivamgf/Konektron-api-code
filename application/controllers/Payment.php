<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
		
	public function consultPayment()
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$list_payment = $this->paymentModel->getPayment();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_payment" => $list_payment
                    ]
                )
            );
	}

	public function consultPaymentId($id_payment)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = $this->paymentModel->getPaymentId($id_payment);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"payment" => $payment
                    ]
                )
            );
	}

	public function consultPaymentUsers($id_users)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = $this->paymentModel->getPaymentUsers($id_users);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"payment" => $payment
                    ]
                )
            );
	}

	public function registerPayment()
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = (array)json_decode($this->input->raw_input_stream);
		$payment['pa_created'] = date('Y-m-d H:i:s');
		$payment['pa_modified'] = date('Y-m-d H:i:s');
		$id = $this->paymentModel->insertPayment($payment);
		$status_code = !empty($id) ? 201 : 400;
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_payment' => $id ]
                )
            );
	}

	public function updatePayment($id_payment)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$payment = (array)json_decode($this->input->raw_input_stream);
		$payment['pa_modified'] = date('Y-m-d H:i:s');
		$updated = $this->paymentModel->patchPayment($id_payment, $payment);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}

	public function deletePayment($id_payment)
	{
		$this->load->model('PaymentModel', 'paymentModel', true);
		$deleted = $this->paymentModel->delPayment($id_payment);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}	
}
