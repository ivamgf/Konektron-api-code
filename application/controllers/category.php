<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	public function consultCategory()
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$list_category = $this->categoryModel->getCategory();

		$dataCategory = array(
			"list_category" => $list_category
		);
	}
	public function consultCategoryId($id_category)
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$category = $this->categoryModel->getCategoryId($id_category);
		$dataCategory = array(
			"category" => $category
		);
	}
	public function registerCategory()
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$category = [];
		$this->categoryModel->insert($category);
	}
	public function updateCategory($id_category)
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$category = array();
		$id = $this->categoryModel->patchCategory($id_category, $category);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-category', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-category', 'Alteração feita com sucesso!');
		}
		$msgCategory = $this->session->set_flashdata('edit-category');
	}
	public function deleteCategory($id_category)
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$this->categoryModel->delCategory($id_category);
	}
}
