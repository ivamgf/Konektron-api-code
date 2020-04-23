<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_services extends CI_Controller {
		
	public function consultServices()
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$list_stockServices = $this->stockServicesModel->getStockServices();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_stockServices" => $list_stockServices
                    ]
                )
            );
	}

	public function consultServicesId($id_service)
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$stockServices = $this->stockServicesModel->getStockServicesId($id_service);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"stockServices" => $stockServices
                    ]
                )
            );
	}

	public function registerServices()
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$stockServices = (array)json_decode($this->input->raw_input_stream);
		$stockServices['sv_created'] = date('Y-m-d H:i:s');
		$stockServices['sv_modified'] = date('Y-m-d H:i:s');
		$id = $this->stockServicesModel->insertStockServices($stockServices);
		$status_code = !empty($id) ? 201 : 400;
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_service' => $id ]
                )
            );
	}

	public function updateService($id_service)
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$stockServices = (array)json_decode($this->input->raw_input_stream);
		$stockServices['sv_modified'] = date('Y-m-d H:i:s');
		$updated = $this->stockServicesModel->patchStockServices($id_service, $stockServices);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
		
	public function deleteService($id_service)
	{
		$this->load->model('StockServicesModel', 'stockServicesModel', true);
		$deleted = $this->stockServicesModel->delStockServices($id_service);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
}
