<?php
/**
 * Model para cadastro dos cards
 *
 * @category   Model
 * @package    Konektron
 * @subpackage CardsModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class CardsModel extends CI_Model
{

    /**
     * Recupera os cardas cadastrados
     *
     * @return void
     */
    public function getCards()
    {
        return $this->db->get('orkney10_konektron_cli.cards')->result();
    }

    /**
     * Recupera um cardo pelo Id
     *
     * @param integer $id_cards Id do card
     *
     * @return void
     */
    public function getCardsId(int $id_cards)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.cards',
            [
                'id_cards' => $id_cards
            ]
        )->row();
    }

    /**
     * Recupera os cards do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function getCardsUsers(int $id_users)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.cards',
            [
                'id_users' => $id_users
            ]
        )->row();
    }

    /**
     * Insere um novo card
     *
     * @param stdClass $cards Dados do novo card
     *
     * @return void
     */
    public function insertCards(stdClass $cards)
    {
        $this->db->insert('orkney10_konektron_cli.cards', $cards);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Atualiza um card
     *
     * @param integer $id_cards Id do card
     * @param stdClass  $cards    Dados do card
     *
     * @return void
     */
    public function patchCards(int $id_cards, stdClass $cards)
    {
        $this->db->where('id_cards', $id_cards);
        $this->db->update('orkney10_konektron_cli.cards', $cards);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove um card pelo id
     *
     * @param integer $id_cards Id do card
     *
     * @return void
     */
    public function delCards(int $id_cards)
    {
        $this->db->where('id_cards', $id_cards);
        $this->db->delete('orkney10_konektron_cli.cards');
        return $this->db->affected_rows() > 0;
    }
}
