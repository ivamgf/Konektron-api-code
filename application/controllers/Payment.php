<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

    public function consultPayment()
    {
        $this->load->model('PaymentModel', 'paymentModel', true);
        $list_payment = $this->paymentModel->getPayment();

        $this->response(
            [
                "list_payment" => $list_payment
            ],
            200
        );
    }

    public function consultPaymentId($id_payment)
    {
        $this->load->model('PaymentModel', 'paymentModel', true);
        $payment = $this->paymentModel->getPaymentId($id_payment);

        $this->response(
            [
                "payment" => $payment
            ],
            200
        );
    }

    public function consultPaymentUsers($id_users)
    {
        $this->load->model('PaymentModel', 'paymentModel', true);
        $payment = $this->paymentModel->getPaymentUsers($id_users);

        $this->response(
            [
                "payment" => $payment
            ],
            200
        );
    }

    public function registerPayment()
    {
        $this->load->model('PaymentModel', 'paymentModel', true);
        if ($payment = $this->getData()) {
            $payment->pa_created = date('Y-m-d H:i:s');
            $payment->pa_modified = date('Y-m-d H:i:s');
            $id = $this->paymentModel->insertPayment($payment);
            $status_code = !empty($id) ? 201 : 400;

            $this->response(
                [
                    'id_payment' => $id
                ],
                $status_code
            );
        }
    }

    public function updatePayment($id_payment)
    {
        $this->load->model('PaymentModel', 'paymentModel', true);
        if ($payment = $this->getData()) {
            $payment->pa_modified = date('Y-m-d H:i:s');
            $updated = $this->paymentModel->patchPayment($id_payment, $payment);
            $status_code = $updated ? 204 : 400;

            $this->response(
                null,
                $status_code
            );
        }
    }

    public function deletePayment($id_payment)
    {
        $this->load->model('PaymentModel', 'paymentModel', true);
        $deleted = $this->paymentModel->delPayment($id_payment);
        $status_code = $deleted ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
}
