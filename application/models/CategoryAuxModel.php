<?php

	class CategoryAuxModel extends CI_Model {
		
		public function getCategoryAux() {
			return $this->db->get('orkney10_konektron_cli.category_aux')->result();
		}

		public function getCategoryAuxId($id_category_aux) {
			return $this->db->get_where('orkney10_konektron_cli.category_aux', array('id_category_aux' => $id_category_aux))->row();
		}

		public function getCategoryAuxService($id_service) {
			return $this->db->get_where('orkney10_konektron_cli.category_aux', array('id_service' => $id_service))->row();
		}

		public function insertCategoryAux($id_category_aux) {
			$this->db->insert('orkney10_konektron_cli.category_aux', $id_category_aux);
		}

		public function patchCategoryAux($id_category_aux, $categoryAux) {
			$this->db->where('id_category_aux', $id_category_aux);
			$this->db->update('orkney10_konektron_cli.category_aux', $categoryAux);

			if($this->db->affected_rows() > 0) {
				return $id_category_aux;
			} 
			return NULL;
		}

		public function delCategoryAux($id_category_aux) {
			$this->db->where('id_category_aux', $id_category_aux);
			$this->db->delete('orkney10_konektron_cli.category_aux');
		}
	}
