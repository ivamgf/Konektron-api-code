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

use PHPMailer\PHPMailer\PHPMailer;
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

    const EMAIL_CONTATO = 'contatos@orkneytech.com.br';

    public $controller = null;

    public $method = null;

    public $schema = null;

    public $error = null;

    public $data = [];

    /**
     * Define configurações necessárias
     */
    public function __construct()
    {
        parent::__construct();

        $this->controller = $this->router->fetch_class();

        $this->method = $this->router->fetch_method();

        $this->auth();

        $data = json_decode($this->input->raw_input_stream);
        if ($this->_validateSchema($data)) {
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
        if ($this->_auth_override_check() === false) {
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
    }

    private function _auth_override_check()
    {
        $this->get_local_config('rest');

        $auth_override_class_method = $this->config->item('auth_override_class_method');
        if (!empty($auth_override_class_method)) {
            if (!empty($auth_override_class_method[$this->router->class][$this->router->method])) {
                if ($auth_override_class_method[$this->router->class][$this->router->method] === 'none') {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param $config_file
     */
    private function get_local_config($config_file)
    {
        if (!$this->load->config($config_file, false)) {
            $config = [];
            include __DIR__.'/'.$config_file.'.php';
            foreach ($config as $key => $value) {
                $this->config->set_item($key, $value);
            }
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
    private function _getValidationSchema()
    {
        $schema = !empty($this->schema)
            ? $this->schema
            : $this->controller.DIRECTORY_SEPARATOR.$this->method;

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
    private function _validateSchema($data = null)
    {
        $schema = $this->_getValidationSchema();
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

    /**
     * Configuração do e-mail
     *
     * @return void
     */
    protected function emailConfig()
    {
        // Config E-mail
        // $config['protocol'] = 'sendmail';
        // $config['smtp_host'] = 'ssl://orkneytech.com.br';
        // $config['smtp_port'] = 465;
        // $config['smtp_user'] = 'contatos@orkneytech.com.br';
        // $config['smtp_pass'] = 'Orkneytech10106088';
        // $config['mailpath'] = '/usr/sbin/sendmail';
        // $config['charset'] = 'iso-8859-1';

        $config = [
            'protocol' => 'smtp',
            '_smtp_auth' => true,
            'smtp_host' => 'smtp.zoho.com',
            'smtp_port' => 587,
            'smtp_user' => 'no-reply@rsb.cc',
            'smtp_pass' => '!HGhbxh98pDsXC#',
            'smtp_crypto' => 'tls',
            'smtp_charset' => 'utf-8',
            'smtp_mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => true,
        ];
        return $config;
    }

    /**
     * Envio de e-mail padrão
     *
     * @return CI_Email
     */
    protected function emailCreate(
        $mail = [
            'to' => null,
            'subject' => null,
            'msg' => null
        ]
    ) {
        $config = $this->emailConfig();
        // var_dump($config);die;
        $this->load->library('email', $config);
        // Config E-mail

        // Send E-mail
        $this->email->from($config['smtp_user'], 'Konektron');
        $this->email->to($mail['to']);
        $this->email->subject($mail['subject']);
        $this->email->message($mail['msg']);

        return $this->email;
    }

    /**
     * Envio de e-mail pelo PHPMailer
     *
     * @return PHPMailer
     */
    protected function phpMailer(
        $setting = [
            'to' => null,
            'subject' => null,
            'msg' => null
        ]
    ) {
        $config = $this->emailConfig();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
            )
        );
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 1;
        $mail->Debugoutput = 'html';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $config['smtp_crypto'];
        $mail->Host = $config['smtp_host'];
        $mail->Port = $config['smtp_port'];
        $mail->Username = $config['smtp_user'];
        $mail->Password = $config['smtp_pass'];
        $mail->setFrom($config['smtp_user'], 'Konektron');
        $mail->addAddress($setting['to']);

        $mail->Subject = $setting['subject'];
        $mail->msgHTML($setting['msg']);
        $mail->AltBody = $setting['msg'];

        // var_dump($mail->send());
        // var_dump($mail->ErrorInfo);
        return $mail;
    }
}
