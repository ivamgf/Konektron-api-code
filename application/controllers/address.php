<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {
	
	public function consultAddress()
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$list_address = $this->addressModel->getAddress();

		$dataAddress = array(
			"list_address" => $list_address
		);
	}

	public function consultAddressId($id_address)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$address = $this->addressModel->getAddressId($id_address);
		$dataAddress = array(
			"address" => $address
		);
	}

	public function consultAddressUsers($id_users)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$address = $this->addressModel->getAddressUsers($id_users);
		$dataAddress = array(
			"address" => $address
		);
	}

	public function registerAddress()
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$address = [];
		$this->addressModel->insert($address);
	}

	public function updateAddress($id_address)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$address = array();
		$id = $this->addressModel->patchAddress($id_address, $address);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-address', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-address', 'Alteração feita com sucesso!');
		}
		$msgAddress = $this->session->set_flashdata('edit-address');
	}

	public function deleteAddress($id_address)
	{
		$this->load->model('AddressModel', 'addressModel', true);
		$this->addressModel->delAddress($id_address);
		// redirect(base_url(''));
	}
}
