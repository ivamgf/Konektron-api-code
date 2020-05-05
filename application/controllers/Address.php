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
 * Controller para cadastro de endereços
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Address
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Address extends MY_Controller
{

    /**
     * Retorna os endereços do usuário
     *
     * @return void
     */
    public function consultAddress()
    {
        $this->load->model('AddressModel', 'addressModel', true);
        $list_address = $this->addressModel->getAddress();

        $this->response(
            [
                "list_address" => $list_address
            ],
            200
        );
    }

    /**
     * Consulta o endereço do usuário pelo Id
     *
     * @param integer $id_address Id do endereço
     *
     * @return void
     */
    public function consultAddressId(int $id_address = 0)
    {
        $this->load->model('AddressModel', 'addressModel', true);
        $address = $this->addressModel->getAddressId($id_address);

        $this->response(
            [
                "address" => $address
            ],
            200
        );
    }

    /**
     * Consulta os endereços vinculados ao usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function consultAddressUsers(int $id_users = 0)
    {
        $this->load->model('AddressModel', 'addressModel', true);
        $address = $this->addressModel->getAddressUsers($id_users);

        $this->response(
            [
                "address" => $address
            ],
            200
        );
    }

    /**
     * Registra um novo endereço
     *
     * @return void
     */
    public function registerAddress()
    {
        $this->load->model('AddressModel', 'addressModel', true);
        if ($address = $this->getData()) {
            $address->as_created = date('Y-m-d H:i:s');
            $address->as_modified = date('Y-m-d H:i:s');
            $id = $this->addressModel->insertAddress($address);
            $status_code = !empty($id) ? 201 : 404;

            $this->response(
                [ 'id_address' => $id ],
                $status_code
            );
        }
    }

    /**
     * Atualiza um endereç
     *
     * @param integer $id_address Id o endereço a ser atualizado
     *
     * @return void
     */
    public function updateAddress(int $id_address = 0)
    {
        $this->load->model('AddressModel', 'addressModel', true);
        if ($address = $this->getData()) {
            $address->as_modified = date('Y-m-d H:i:s');
            $updated = $this->addressModel->patchAddress($id_address, $address);
            $output = !empty($updated)
                ? ['updated' => $updated ]
                : ['code' => 404, 'msg' => 'Endereço não encontrado!' ];
            $status_code = $updated ? 204 : 404;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Deleta um endereço pelo Id
     *
     * @param integer $id_address Id do endereço
     *
     * @return void
     */
    public function deleteAddress(int $id_address = 0)
    {
        $this->load->model('AddressModel', 'addressModel', true);
        $deleted = $this->addressModel->delAddress($id_address);
        $output = !empty($deleted)
            ? ['deleted' => $deleted ]
            : ['code' => 404, 'msg' => 'Endereço não encontrado!' ];
        $status_code = $deleted ? 204 : 404;

        $this->response(
            $output,
            $status_code
        );
    }
}
