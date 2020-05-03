<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('welcome_message');
    }
    public function ok() {
        $this->response(
            [
                'msg' => 'ok!',
            ],
            200
        );
    }

    public function key()
    {
        var_dump(password_hash('123456', PASSWORD_BCRYPT));
        var_dump(password_verify('123456', '$2y$10$ykij4cNUoYASIOau2F2md.YkLwM5LpEBTDGus93eXs1gBKVPG68ju'));
        die;
    }
}
