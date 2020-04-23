<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {
    
    public function consultCategory()
    {
        $this->load->model('CategoryModel', 'categoryModel', true);
        $list_category = $this->categoryModel->getCategory();

        $this->response(
            [
                "list_category" => $list_category
            ],
            200
        );
    }
    public function consultCategoryId($id_category)
    {
        $this->load->model('CategoryModel', 'categoryModel', true);
        $category = $this->categoryModel->getCategoryId($id_category);
        
        $this->response(
            [
                "category" => $category
            ],
            200
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

        $this->response(
            [
                "id_category" => $id
            ],
            $status_code
        );
    }
    public function updateCategory($id_category)
    {
        $this->load->model('CategoryModel', 'categoryModel', true);
        $category = (array)json_decode($this->input->raw_input_stream);
        $category['ct_modified'] = date('Y-m-d H:i:s');
        $updated = $this->categoryModel->patchCategory($id_category, $category);
        $status_code = $updated ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
    public function deleteCategory($id_category)
    {
        $this->load->model('CategoryModel', 'categoryModel', true);
        $deleted = $this->categoryModel->delCategory($id_category);
        $status_code = $deleted ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
}
