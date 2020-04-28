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
 * @author   Orkney Tech <suporte@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

use Opis\JsonSchema\{
    Validator, ValidationResult, ValidationError, Schema
};

/**
 * Controller base para controle das rotas e autenticação
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage MY_Controller
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class MY_Controller extends CI_Controller
{
    public $schema = null;

    public $error = null;

    public $data = [];

    /**
     * Define configurações necessárias
     */
    public function __construct()
    {
        parent::__construct();

        $this->auth();

        $data = json_decode($this->input->raw_input_stream);
        if ($this->validateSchema($data)) {
            $this->data = $data;
        }
    }

    /**
     * Valida o token através do cabeçalho da requisição
     *
     * @return void
     */
    public function auth()
    {
        $x_api_user = $this->input->server('HTTP_X_API_USER');
        $x_api_admin = $this->input->server('HTTP_X_API_ADMIN');
        $x_api_provider = $this->input->server('HTTP_X_API_PROVIDER');

        $tokenValidRecover = false;
        if (!empty($x_api_user)) {
            $this->load->model('SignModel', 'signModel', true);
            $tokenValidRecover = $this->signModel->tokenValidRecover($x_api_user);
        } else if (!empty($x_api_admin)) {
            $this->load->model('SignModel', 'signModel', true);
            $tokenValidRecover = $this->signModel->tokenValidRecoverAdmin($x_api_admin);
        } else if (!empty($x_api_provider)) {
            $this->load->model('SignModel', 'signModel', true);
            $tokenValidRecover = $this->signModel->tokenValidRecoverProviders($x_api_provider);
        }

        if (!$tokenValidRecover) {
            // Display an error response
            $this->response(
                null,
                401
            );
        }
    }

    /**
     * Verifica se existem erros
     *
     * @return void
     */
    public function getData()
    {
        if (!empty($this->error)) {
            $this->response(
                $this->error,
                404
            );
        } else {
            return $this->data;
        }
    }

    /**
     * Faz o tratamento da responsta para o client
     *
     * @param mixed   $data      Dados de retorno
     * @param integer $http_code Status de retorno
     *
     * @return void
     */
    public function response($data = null, $http_code = null)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($http_code);

        if (!empty($data)) {
            $this->output->set_output(
                json_encode(
                    $data,
                    JSON_PRETTY_PRINT
                )
            );
        }
        $this->output->_display();
        exit;
    }

    /**
     * Recupera o json-schema para validação dos dados de entrada
     *
     * @return void
     */
    protected function getValidationSchema()
    {
        $schema = !empty($this->schema)
            ? $this->schema
            : $this->router->fetch_method();

        $ext = '.json';
        $string = '';
        if (!file_exists(APPPATH . 'schemas' . DIRECTORY_SEPARATOR . $schema.$ext)) {
            $this->error['schema'] = 'No such file or directory [schemas' . DIRECTORY_SEPARATOR . $schema.$ext.']';
        } else {
            $json = file_get_contents(
                APPPATH . 'schemas' . DIRECTORY_SEPARATOR . $schema.$ext
            );
            $string = Schema::fromJsonString(
                $json
            );
        }
        return $string;
    }

    /**
     * Valida os dados de entrada conforme o json-schema de cada controller
     *
     * @param string $data Dados de input da requisição
     *
     * @return void
     */
    public function validateSchema($data = null)
    {
        $schema = $this->getValidationSchema();
        $isValid = false;
        if ($schema) {
            $validator = new Validator();

            /**
             * Resultado da validação do json
             *
             * @var ValidationResult $result
             */
            $result = $validator->schemaValidation($data, $schema);

            $isValid = $result->isValid();
            if (!$isValid) {
                /**
                 * Erros na validação do json
                 *
                 * @var ValidationError $error
                 */
                $error = $result->getFirstError();
                $this->error['dataPointer'] = $error->dataPointer();
                $this->error['data'] = $error->data();
                $this->error['keyword'] = $error->keyword();
                $this->error['keywordArgs'] = $error->keywordArgs();
                $this->error['subErrors'] = $error->subErrors();
            }
        }

        return $isValid;
    }

    public static function geraSenha($password)
    {
        $salt = uniqid();
        $str = '6';
        $rounds = '5000';

        $cryptSalt = '$' . $str . '$rounds=' . $rounds . '$' . $salt;
        $hash = crypt($password, $cryptSalt);

        return $hash;
    }
}
