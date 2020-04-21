<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cards extends CI_Controller {
	
	public function consultCards()
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$list_cards = $this->cardsModel->getCards();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_address" => $list_cards
                    ]
                )
            );
	}

	public function consultCardsId($id_cards)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = $this->cardsModel->getCardsId($id_cards);

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"cards" => $cards
                    ]
                )
            );
	}

	public function consultCardsUsers($id_users)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = $this->cardsModel->getCardsUsers($id_users);

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"cards" => $cards
                    ]
                )
            );
	}

	public function registerCards()
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = (array)json_decode($this->input->raw_input_stream);
		$cards['ca_created'] = date('Y-m-d H:i:s');
		$cards['ca_modified'] = date('Y-m-d H:i:s');
		$id = $this->cardsModel->insertCards($cards);
		$status_code = !empty($id) ? 201 : 400;
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_cards' => $id ]
                )
            );
	}

	public function updateCards($id_cards)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = (array)json_decode($this->input->raw_input_stream);
		$cards['ca_modified'] = date('Y-m-d H:i:s');
		$updated = $this->cardsModel->patchCards($id_cards, $cards);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}

	public function deleteCards($id_cards)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$deleted = $this->cardsModel->delCards($id_cards);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
}
