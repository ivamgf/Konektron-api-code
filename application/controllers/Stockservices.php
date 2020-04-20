<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stockservices extends CI_Controller {
		
	public function consultServices()
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$list_stockServices = $this->stockServicesModel->getStockServices();

		$dataStockServices = array(
			"list_stockServices" => $list_stockServices
		);
	}

	public function consultServicesId($id_service)
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$stockServices = $this->stockServicesModel->getStockServicesId($id_service);
		$dataStockServices = array(
			"stockServices" => $stockServices
		);
	}

	public function registerServices()
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$stockServices = [];
		$this->stockServicesModel->insert($stockServices);
	}

	public function updateService($id_service)
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$stockServices = array();
		$id = $this->stockServicesModel->patchStockServices($id_service, $stockServices);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-stockServices', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-stockServices', 'Alteração feita com sucesso!');
		}
		$msgStockServices = $this->session->set_flashdata('edit-stockServices');
	}
		
	public function deleteService($id_service)
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$this->stockServicesModel->delStockServices($id_service);
	}
}
