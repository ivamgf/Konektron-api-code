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
 * Controller dos serviços
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Stock_Services
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Stock_Services extends MY_Controller
{

    /**
     * Recupera os serviços cadastrados
     *
     * @return void
     */
    public function consultServices()
    {
        $this->load->model('StockServicesModel', 'stockServicesModel', true);
        $list_stockServices = $this->stockServicesModel->getStockServices();

        $this->response(
            [
                "list_stockServices" => $list_stockServices
            ],
            200
        );
    }

    /**
     * Recupera o serviço pelo Id
     *
     * @param integer $id_service Id do serviço
     *
     * @return void
     */
    public function consultServicesId(int $id_service)
    {
        $this->load->model('StockServicesModel', 'stockServicesModel', true);
        $stockServices = $this->stockServicesModel->getStockServicesId($id_service);

        $this->response(
            [
                "stockServices" => $stockServices
            ],
            200
        );
    }

    /**
     * Registra um novo serviço
     *
     * @return void
     */
    public function registerServices()
    {
        $this->load->model('StockServicesModel', 'stockServicesModel', true);
        if ($stockServices = $this->getData()) {
            $stockServices->sv_tag = implode(',', $stockServices->sv_tag);
            $id = $this->stockServicesModel->insertStockServices($stockServices);
            $status_code = !empty($id) ? 201 : 404;

            $this->response(
                [
                    'id_service' => $id
                ],
                $status_code
            );
        }
    }

    /**
     * Atualiza um serviço pelo id
     *
     * @param integer $id_service Id do serviço
     *
     * @return void
     */
    public function updateService(int $id_service)
    {
        $this->load->model('StockServicesModel', 'stockServicesModel', true);
        if ($stockServices = $this->getData()) {
            $stockServices->sv_tag = implode(',', $stockServices->sv_tag);
            $updated = $this->stockServicesModel->patchStockServices($id_service, $stockServices);
            $output = !empty($updated)
                ? ['updated' => $updated ]
                : ['code' => 404, 'msg' => 'Serviço não encontrado!' ];
            $status_code = $updated ? 204 : 404;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Remover um serviço
     *
     * @param integer $id_service Id do serviço
     *
     * @return void
     */
    public function deleteService(int $id_service)
    {
        $this->load->model('StockServicesModel', 'stockServicesModel', true);
        $deleted = $this->stockServicesModel->delStockServices($id_service);
        $output = !empty($deleted)
                ? ['deleted' => $deleted ]
                : ['code' => 404, 'msg' => 'Serviço não encontrado!' ];
        $status_code = $deleted ? 204 : 404;

        $this->response(
            $output,
            $status_code
        );
    }
}
