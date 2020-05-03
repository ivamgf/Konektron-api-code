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
     * @return array
     */
    public function getCards(): array
    {
        return $this->db->get('orkney10_konektron_cli.cards')
            ->result() ?? [];
    }

    /**
     * Recupera um cardo pelo Id
     *
     * @param integer $id_cards Id do card
     *
     * @return stdClass
     */
    public function getCardsId(int $id_cards): stdClass
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.cards',
            [
                'id_cards' => $id_cards
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera os cards do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return stdClass
     */
    public function getCardsUsers(int $id_users): stdClass
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.cards',
            [
                'id_users' => $id_users
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere um novo card
     *
     * @param stdClass $cards Dados do novo card
     *
     * @return integer
     */
    public function insertCards(stdClass $cards): int
    {
        $this->db->insert('orkney10_konektron_cli.cards', $cards);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza um card
     *
     * @param integer  $id_cards Id do card
     * @param stdClass $cards    Dados do card
     *
     * @return boolean
     */
    public function patchCards(int $id_cards, stdClass $cards): bool
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
     * @return boolean
     */
    public function delCards(int $id_cards): bool
    {
        $this->db->where('id_cards', $id_cards);
        $this->db->delete('orkney10_konektron_cli.cards');
        return $this->db->affected_rows() > 0;
    }
}
