<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {
		
	public function consultLogs()
	{
		$this->load->model('LogsModel', 'logsModel', true);
		$list_logs = $this->logsModel->getLogs();

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_logs" => $list_logs
                    ]
                )
            );
	}

	public function consultLogsId($id_log)
	{
		$this->load->model('LogsModel', 'logsModel', true);
		$logs = $this->logsModel->getLogsId($id_log);

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"logs" => $logs
                    ]
                )
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
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_log' => $id ]
                )
            );
	}
}
