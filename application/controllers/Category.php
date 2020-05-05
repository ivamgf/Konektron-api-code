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
 * Controller para cadastro das categorias
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Category
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Category extends MY_Controller
{
    /**
     * Retorna as categorias cadastradas
     *
     * @return void
     */
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

    /**
     * Retorna uma categoria pelo Id
     *
     * @param integer $id_category Id da categoria
     *
     * @return void
     */
    public function consultCategoryId(int $id_category = 0)
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

    /**
     * Registra uma nova categoria
     *
     * @return void
     */
    public function registerCategory()
    {
        $this->load->model('CategoryModel', 'categoryModel', true);
        if ($category = $this->getData()) {
            $category->ct_created = date('Y-m-d H:i:s');
            $category->ct_modified = date('Y-m-d H:i:s');
            $id = $this->categoryModel->insertCategory($category);
            $status_code = !empty($id) ? 201 : 404;

            $this->response(
                [
                    "id_category" => $id
                ],
                $status_code
            );
        }
    }

    /**
     * Atualiza uma categoria
     *
     * @param integer $id_category Id da categoria
     *
     * @return void
     */
    public function updateCategory(int $id_category = 0)
    {
        $this->load->model('CategoryModel', 'categoryModel', true);
        if ($category = $this->getData()) {
            $category->ct_modified = date('Y-m-d H:i:s');
            $updated = $this->categoryModel->patchCategory($id_category, $category);
            $output = !empty($updated)
                ? ['updated' => $updated ]
                : ['code' => 404, 'msg' => 'Categoria não encontrada!' ];
            $status_code = $updated ? 204 : 404;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Remove uma categoria
     *
     * @param integer $id_category Id da categoria
     *
     * @return void
     */
    public function deleteCategory(int $id_category = 0)
    {
        $this->load->model('CategoryModel', 'categoryModel', true);
        $deleted = $this->categoryModel->delCategory($id_category);
        $output = !empty($deleted)
                ? ['deleted' => $deleted ]
                : ['code' => 404, 'msg' => 'Categoria não encontrada!' ];
        $status_code = $deleted ? 204 : 404;

        $this->response(
            $output,
            $status_code
        );
    }
}
