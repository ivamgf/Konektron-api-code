<?php
/**
 * This file is part of the Orkney Tech (http://orkneytech.com.br)
 *
 * Copyright (c) 2020  Orkney Tech (http://orkneytech.com.br)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 *
 * PHP Version 7
 *
 * @category Controller
 * @package  Orkney
 * @author   Orkney Tech <contato@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para controle dos pagamentos
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Payment
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Payment extends MY_Controller
{

    /**
     * Retorna os pagamentos
     *
     * @return void
     */
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

    /**
     * Retorna um pagamento pelo Id
     *
     * @param integer $id_payment Id do pagamento
     *
     * @return void
     */
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

    /**
     * Retorna os pagamentos do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function consultPaymentUsers(int $id_users = 0)
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

    /**
     * Registra um novo pagamento
     *
     * @return void
     */
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

    /**
     * Atualiza um pagamento
     *
     * @param integer $id_payment Id do pagamento
     *
     * @return void
     */
    public function updatePayment(int $id_payment = 0)
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

    /**
     * Remove um pagamento pelo Id
     *
     * @param integer $id_payment Id do pagamento
     *
     * @return void
     */
    public function deletePayment(int $id_payment = 0)
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
