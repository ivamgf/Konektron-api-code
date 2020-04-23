<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends MY_Controller {
        
    public function consultLogs()
    {
        $this->load->model('LogsModel', 'logsModel', true);
        $list_logs = $this->logsModel->getLogs();

        $this->response(
            [
                "list_logs" => $list_logs
            ],
            200
        );
    }

    public function consultLogsId($id_log)
    {
        $this->load->model('LogsModel', 'logsModel', true);
        $logs = $this->logsModel->getLogsId($id_log);

        $this->response(
            [
                "logs" => $logs
            ],
            200
        );
    }

    public function registerLogs()
    {
        $this->load->model('LogsModel', 'logsModel', true);
        $logs = (array)json_decode($this->input->raw_input_stream);
        $logs['lo_created'] = date('Y-m-d H:i:s');
        $logs['lo_modified'] = date('Y-m-d H:i:s');
        $id = $this->logsModel->insertLogs($logs);
        $status_code = !empty($id) ? 201 : 400;

        $this->response(
            [
                "id_log" => $id
            ],
            $status_code
        );
    }
}
