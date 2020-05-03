<?php
/**
 * Model para cadastro dos pagamentos
 *
 * @category   Model
 * @package    Konektron
 * @subpackage PaymentModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class PaymentModel extends CI_Model
{

    /**
     * Retorna os pagamentos cadastrados
     *
     * @return array
     */
    public function getPayment()
    {
        return $this->db->get('orkney10_konektron_cli.payment')
            ->result() ?? [];
    }

    /**
     * Retorna o pagamento pelo id
     *
     * @param integer $id_payment Id do pagamento
     *
     * @return stdClass
     */
    public function getPaymentId(int $id_payment): stdClass
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.payment',
            [
                'id_payment' => $id_payment
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera os pagamentos do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return stdClass
     */
    public function getPaymentUsers(int $id_users): stdClass
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.payment',
            [
                'id_users' => $id_users
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere um novo pagamento
     *
     * @param stdClass $payment Dados do pagamento
     *
     * @return integer
     */
    public function insertPayment(stdClass $payment): int
    {
        $this->db->insert('orkney10_konektron_cli.payment', $payment);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza um pagamento
     *
     * @param integer  $id_payment Id do pagamento
     * @param stdClass $payment    Dados do pagamento
     *
     * @return boolean
     */
    public function patchPayment(int $id_payment, stdClass $payment): bool
    {
        $this->db->where('id_payment', $id_payment);
        $this->db->update('orkney10_konektron_cli.payment', $payment);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove o pagamento pelo id
     *
     * @param integer $id_payment Id do pagamento
     *
     * @return boolean
     */
    public function delPayment($id_payment): bool
    {
        $this->db->where('id_payment', $id_payment);
        $this->db->delete('orkney10_konektron_cli.payment');
        return $this->db->affected_rows() > 0;
    }
}
