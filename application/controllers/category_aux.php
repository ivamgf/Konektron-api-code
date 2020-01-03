<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryAux extends CI_Controller {
	
	public function consultCategoryAux()
	{
		$this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
		$list_categoryAux = $this->categoryAuxModel->getCategoryAux();

		$dataCategoryAux = array(
			"list_categoryAux" => $list_categoryAux
		);
	}

	public function consultCategoryAuxId($id_category_aux)
	{
		$this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
		$categoryAux = $this->categoryAuxModel->getCategoryAuxId($id_category_aux);
		$dataCategoryAux = array(
			"categoryAux" => $categoryAux
		);
	}

	public function consultCategoryAuxService($id_service)
	{
		$this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
		$categoryAux = $this->categoryAuxModel->getCategoryAuxService($id_service);
		$dataCategoryAux = array(
			"categoryAux" => $categoryAux
		);
	}

	public function registerCategoryAux()
	{
		$this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
		$categoryAux = [];
		$this->categoryAuxModel->insert($categoryAux);
	}

	public function updateCategoryAux($id_category_aux)
	{
		$this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
		$categoryAux = array();
		$id = $this->categoryAuxModel->patchCategoryAux($id_category_aux, $categoryAux);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-categoryAux', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-categoryAux', 'Alteração feita com sucesso!');
		}
		$msgCategoryAux = $this->session->set_flashdata('edit-categoryAux');
	}

	public function deleteCategoryAux($id_category_aux)
	{
		$this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
		$this->categoryAuxModel->delCategoryAux($id_category_aux);
	}
}
