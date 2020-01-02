<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function profileAdmin($id_admin)
	{
		$this->load->model('DashboardModel', 'dashboardModel', true);
		$dashboard = $this->dashboardModel->getDashboardId($id_admin);
		$dataDashboard = array(
			"dashboard" => $dashboard
		);
	}
	public function clients()
	{
		$this->load->model('DashboardModel', 'dashboardModel', true);
		$list_clients = $this->dashboardModel->getClients();

		$dataClients = array(
			"list_clients" => $list_clients
		);
	}	
}
