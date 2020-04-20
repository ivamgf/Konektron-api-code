<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cards extends CI_Controller {
	
	public function consultCards()
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$list_cards = $this->cardsModel->getCards();

		$dataCards = array(
			"list_cards" => $list_cards
		);
	}

	public function consultCardsId($id_cards)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = $this->cardsModel->getCardsId($id_cards);
		$dataCards = array(
			"cards" => $cards
		);
	}

	public function consultCardsUsers($id_users)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = $this->cardsModel->getCardsUsers($id_users);
		$dataCards = array(
			"cards" => $cards
		);
	}

	public function registerCards()
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = [];
		$this->cardsModel->insert($cards);
	}

	public function updateCards($id_cards)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$cards = array();
		$id = $this->cardsModel->patchCards($id_cards, $cards);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-cards', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-cards', 'Alteração feita com sucesso!');
		}
		$msgCards = $this->session->set_flashdata('edit-cards');
	}

	public function deleteCards($id_cards)
	{
		$this->load->model('CardsModel', 'cardsModel', true);
		$this->cardsModel-->delCards($id_cards);
	}
}
