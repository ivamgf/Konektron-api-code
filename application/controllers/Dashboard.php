<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function profileAdmin()
	{
		$this->load->model('DashboardModel', 'dashboardModel', true);
		$list_admins = $this->dashboardModel->getAdmins();
	
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_admins" => $list_admins
                    ]
                )
            );
	}
	public function clients()
	{
		$this->load->model('DashboardModel', 'dashboardModel', true);
		$list_clients = $this->dashboardModel->getClients();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_clients" => $list_clients
                    ]
                )
            );
	}	
}
