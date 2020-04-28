<?php
/**
 * Model para cadastro dos pagamentos
 *
 * @category   Model
 * @package    Konektron
 * @subpackage PaymentModel
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class PaymentModel extends CI_Model
{

    /**
     * Retorna os pagamentos cadastrados
     *
     * @return void
     */
    public function getPayment()
    {
        return $this->db->get('orkney10_konektron_cli.payment')->result();
    }

    /**
     * Retorna o pagamento pelo id
     *
     * @param integer $id_payment Id do pagamento
     *
     * @return void
     */
    public function getPaymentId(int $id_payment)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.payment',
            [
                'id_payment' => $id_payment
            ]
        )->row();
    }

    /**
     * Recupera os pagamentos do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function getPaymentUsers(int $id_users)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.payment',
            [
                'id_users' => $id_users
            ]
        )->row();
    }

    /**
     * Insere um novo pagamento
     *
     * @param object $payment Dados do pagamento
     *
     * @return void
     */
    public function insertPayment(object $payment)
    {
        $this->db->insert('orkney10_konektron_cli.payment', $payment);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Atualiza um pagamento
     *
     * @param integer $id_payment Id do pagamento
     * @param object  $payment    Dados do pagamento
     *
     * @return void
     */
    public function patchPayment(int $id_payment, object $payment)
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
     * @return void
     */
    public function delPayment($id_payment)
    {
        $this->db->where('id_payment', $id_payment);
        $this->db->delete('orkney10_konektron_cli.payment');
        return $this->db->affected_rows() > 0;
    }
}
