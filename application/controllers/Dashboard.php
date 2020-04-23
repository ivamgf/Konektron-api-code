<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    
    public function profileAdmin()
    {
        $this->load->model('DashboardModel', 'dashboardModel', true);
        $list_admins = $this->dashboardModel->getAdmins();
    
        $this->response(
            [
                "list_admins" => $list_admins
            ],
            200
        );
    }
    public function clients()
    {
        $this->load->model('DashboardModel', 'dashboardModel', true);
        $list_clients = $this->dashboardModel->getClients();

        $this->response(
            [
                "list_clients" => $list_clients
            ],
            200
        );
    }	
}
