<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller 
{
	public function consultAddress()
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$list_address = $this->addressModel->getAddress();
	
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_address" => $list_address
                    ]
                )
            );
	}

	public function consultAddressId($id_address)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$address = $this->addressModel->getAddressId($id_address);

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"address" => $address
                    ]
                )
            );
	}

	public function consultAddressUsers($id_users)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$address = $this->addressModel->getAddressUsers($id_users);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"address" => $address
                    ]
                )
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
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_address' => $id ]
                )
            );
	}

	public function updateAddress($id_address)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$address = (array)json_decode($this->input->raw_input_stream);
		$address['as_modified'] = date('Y-m-d H:i:s');
		$updated = $this->addressModel->patchAddress($id_address, $address);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}

	public function deleteAddress($id_address)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$deleted = $this->addressModel->delAddress($id_address);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
}
