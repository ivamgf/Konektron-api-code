<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	public function consultCategory()
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$list_category = $this->categoryModel->getCategory();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_category" => $list_category
                    ]
                )
            );
	}
	public function consultCategoryId($id_category)
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$category = $this->categoryModel->getCategoryId($id_category);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"category" => $category
                    ]
                )
            );
	}
	public function registerCategory()
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$category = (array)json_decode($this->input->raw_input_stream);
		$category['ct_created'] = date('Y-m-d H:i:s');
		$category['ct_modified'] = date('Y-m-d H:i:s');
		$id = $this->categoryModel->insertCategory($category);
		$status_code = !empty($id) ? 201 : 400;
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_category' => $id ]
                )
            );
	}
	public function updateCategory($id_category)
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$category = (array)json_decode($this->input->raw_input_stream);
		$category['ct_modified'] = date('Y-m-d H:i:s');
		$updated = $this->categoryModel->patchCategory($id_category, $category);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
	public function deleteCategory($id_category)
	{
		$this->load->model('CategoryModel', 'categoryModel', true);
		$deleted = $this->categoryModel->delCategory($id_category);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
}
