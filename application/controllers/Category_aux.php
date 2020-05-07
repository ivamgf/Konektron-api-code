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
 * Controller para vinculo da categoria com o serviço
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Category_Aux
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Category_Aux extends MY_Controller
{

    /**
     * Recupera os vinculos das categorias e serviços
     *
     * @return void
     */
    public function consultCategoryAux()
    {
        $this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
        $list_categoryAux = $this->categoryAuxModel->getCategoryAux();

        $this->response(
            [
                "list_categoryAux" => $list_categoryAux
            ],
            200
        );
    }

    /**
     * Recupera os vinculos da categoria
     *
     * @param integer $id_category_aux Id do vinculo
     *
     * @return void
     */
    public function consultCategoryAuxId(int $id_category_aux)
    {
        $this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
        $categoryAux = $this->categoryAuxModel->getCategoryAuxId($id_category_aux);

        $this->response(
            [
                "categoryAux" => $categoryAux
            ],
            200
        );
    }

    /**
     * Recupera a relação das categorias pelo id do serviço
     *
     * @param integer $id_service Id do serviço
     *
     * @return void
     */
    public function consultCategoryAuxService(int $id_service)
    {
        $this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
        $categoryAux = $this->categoryAuxModel->getCategoryAuxService($id_service);

        $this->response(
            [
                "categoryAux" => $categoryAux
            ],
            200
        );
    }

    /**
     * Registra um novo vinculo da categoria e do serviço
     *
     * @return void
     */
    public function registerCategoryAux()
    {
        $this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
        if ($categoryAux = $this->getData()) {
            $id  = $this->categoryAuxModel->insertCategoryAux($categoryAux);
            $status_code = !empty($id) ? 201 : 404;

            $this->response(
                [
                    "id_category_aux" => $id
                ],
                $status_code
            );
        }
    }

    /**
     * Atualiza um vinculo da categoria e do serviço
     *
     * @param integer $id_category_aux Id do vinculo
     *
     * @return void
     */
    public function updateCategoryAux(int $id_category_aux)
    {
        $this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
        if ($categoryAux = $this->getData()) {
            $categoryAux->cx_modified = date('Y-m-d H:i:s');
            $updated  = $this->categoryAuxModel->patchCategoryAux($id_category_aux, $categoryAux);
            $output = !empty($updated)
                ? ['updated' => $updated ]
                : ['code' => 404, 'msg' => 'Vinculo de categoria não encontrada!' ];
            $status_code = $updated ? 204 : 404;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Remove um vinculo da categoria e do serviço
     *
     * @param integer $id_category_aux Id do vinculo
     *
     * @return void
     */
    public function deleteCategoryAux($id_category_aux)
    {
        $this->load->model('CategoryAuxModel', 'categoryAuxModel', true);
        $deleted = $this->categoryAuxModel->delCategoryAux($id_category_aux);
        $output = !empty($deleted)
                ? ['deleted' => $deleted ]
                : ['code' => 404, 'msg' => 'Vinculo de categoria não encontrada!' ];
        $status_code = $deleted ? 204 : 404;

        $this->response(
            $output,
            $status_code
        );
    }
}
