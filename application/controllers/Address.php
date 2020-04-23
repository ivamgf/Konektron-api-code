<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends MY_Controller 
{
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

    public function consultAddressId($id_address)
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

    public function consultAddressUsers($id_users)
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

    public function registerAddress()
    {
        $this->load->model('AddressModel', 'addressModel', true);
        $address = (array)json_decode($this->input->raw_input_stream);
        $address['as_created'] = date('Y-m-d H:i:s');
        $address['as_modified'] = date('Y-m-d H:i:s');
        $id = $this->addressModel->insertAddress($address);
        $status_code = !empty($id) ? 201 : 400;
        
        $this->response(
            [ 'id_address' => $id ],
            $status_code
        );
    }

    public function updateAddress($id_address)
    {
        $this->load->model('AddressModel', 'addressModel', true);
        $address = (array)json_decode($this->input->raw_input_stream);
        $address['as_modified'] = date('Y-m-d H:i:s');
        $updated = $this->addressModel->patchAddress($id_address, $address);
        $status_code = $updated ? 204 : 400;
        
        $this->response(
            null,
            $status_code
        );
    }

    public function deleteAddress($id_address)
    {
        $this->load->model('AddressModel', 'addressModel', true);
        $deleted = $this->addressModel->delAddress($id_address);
        $status_code = $deleted ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
}
