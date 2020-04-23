<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Opis\JsonSchema\{
    Validator, ValidationResult, ValidationError, Schema
};


class MY_Controller extends CI_Controller
{
    public $schema = null;

    public $error = null;

    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $data = json_decode($this->input->raw_input_stream);
        if ($this->validateSchema($data)) {
            $this->data = $data;
        }
    }

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

    public function response($data = null, $http_code = null, $continue = false)
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
    }

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

    public function validateSchema($data = null)
    {
        $schema = $this->getValidationSchema();
        $isValid = false;
        if ($schema) {
            $validator = new Validator();

            /**
             * @var ValidationResult $result
             */
            $result = $validator->schemaValidation($data, $schema);

            $isValid = $result->isValid();
            if (!$isValid) {
                /**
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
}
