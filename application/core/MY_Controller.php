<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    public function response($data = null, $http_code = null, $continue = false)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($http_code);
            
        if (!empty($data)) {
            $this->output->set_output(
                json_encode(
                    $data
                )
            );
        }
    }
}
