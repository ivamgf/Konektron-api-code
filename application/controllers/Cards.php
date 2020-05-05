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
 * Controller para cadastro de Cards
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Cards
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Cards extends MY_Controller
{

    /**
     * Retorna os Cards
     *
     * @return void
     */
    public function consultCards()
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        $list_cards = $this->cardsModel->getCards();

        $this->response(
            [
                "list_cards" => $list_cards
            ],
            200
        );
    }

    /**
     * Retorna um card pelo Id
     *
     * @param integer $id_cards Id do card
     *
     * @return void
     */
    public function consultCardsId(int $id_cards = 0)
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        $cards = $this->cardsModel->getCardsId($id_cards);

        $this->response(
            [
                "cards" => $cards
            ],
            200
        );
    }

    /**
     * Retorna os cards pelo Id do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function consultCardsUsers(int $id_users = 0)
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        $cards = $this->cardsModel->getCardsUsers($id_users);

        $this->response(
            [
                "cards" => $cards
            ],
            200
        );
    }

    /**
     * Registra um novo card
     *
     * @return void
     */
    public function registerCards()
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        if ($cards = $this->getData()) {
            $cards->ca_created = date('Y-m-d H:i:s');
            $cards->ca_modified = date('Y-m-d H:i:s');
            $id = $this->cardsModel->insertCards($cards);
            $status_code = !empty($id) ? 201 : 404;

            $this->response(
                [
                    "id_cards" => $id
                ],
                $status_code
            );
        }
    }

    /**
     * Atualiza um card pelo Id
     *
     * @param integer $id_cards Id do card a ser atualizado
     *
     * @return void
     */
    public function updateCards(int $id_cards = 0)
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        if ($cards = $this->getData()) {
            $cards->ca_modified = date('Y-m-d H:i:s');
            $updated = $this->cardsModel->patchCards($id_cards, $cards);
            $output = !empty($updated)
                ? ['updated' => $updated ]
                : ['code' => 404, 'msg' => 'Cartão não encontrado!' ];
            $status_code = $updated ? 204 : 404;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Remove um card pelo Id
     *
     * @param integer $id_cards Id do card
     *
     * @return void
     */
    public function deleteCards(int $id_cards = 0)
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        $deleted = $this->cardsModel->delCards($id_cards);
        $output = !empty($deleted)
                ? ['deleted' => $deleted ]
                : ['code' => 404, 'msg' => 'Cartão não encontrado!' ];
        $status_code = $deleted ? 204 : 404;

        $this->response(
            $output,
            $status_code
        );
    }
}
