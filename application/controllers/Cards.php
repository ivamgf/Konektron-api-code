<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cards extends MY_Controller {
    
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

    public function consultCardsId($id_cards)
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

    public function consultCardsUsers($id_users)
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

    public function registerCards()
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        if ($cards = $this->getData()) {
            $cards->ca_created = date('Y-m-d H:i:s');
            $cards->ca_modified = date('Y-m-d H:i:s');
            $id = $this->cardsModel->insertCards($cards);
            $status_code = !empty($id) ? 201 : 400;
            
            $this->response(
                [
                    "id_cards" => $id
                ],
                $status_code
            );
        }
    }

    public function updateCards($id_cards)
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        if ($cards = $this->getData()) {
            $cards->ca_modified = date('Y-m-d H:i:s');
            $updated = $this->cardsModel->patchCards($id_cards, $cards);
            $status_code = $updated ? 204 : 400;
            
            $this->response(
                null,
                $status_code
            );
        }
    }

    public function deleteCards($id_cards)
    {
        $this->load->model('CardsModel', 'cardsModel', true);
        $deleted = $this->cardsModel->delCards($id_cards);
        $status_code = $deleted ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
}
