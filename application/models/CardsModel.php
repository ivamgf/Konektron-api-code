<?php

	class CardsModel extends CI_Model {
		
		public function getCards() {
			return $this->db->get('orkney10_konektron_cli.cards')->result();
		}

		public function getCardsId($id_cards) {
			return $this->db->get_where('orkney10_konektron_cli.cards', array('id_cards' => $id_cards))->row();
		}

		public function getCardsUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.cards', array('id_users' => $id_users))->row();
		}

		public function insertCards($cards) {
			$this->db->insert('orkney10_konektron_cli.cards', $cards);
		}

		public function patchCards($id_cards, $cards) {
			$this->db->where('id_cards', $id_cards);
			$this->db->update('orkney10_konektron_cli.cards', $cards);

			if($this->db->affected_rows() > 0) {
				return $id_cards;
			} 
			return NULL;
		}

		public function delCards($id_cards) {
			$this->db->where('id_cards', $id_cards);
			$this->db->delete('orkney10_konektron_cli.cards');
		}
	}
