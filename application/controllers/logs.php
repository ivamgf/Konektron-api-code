<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {
		
	public function consultLogs()
	{
		$this->load->model('LogsModel', 'logsModel', true);
		$list_logs = $this->logsModel->getLogs();

		$dataLogs = array(
			"list_logs" => $list_logs
		);
	}

	public function consultLogsId($id_log)
	{
		$this->load->model('LogsModel', 'logsModel', true);
		$logs = $this->logsModel->getLogsId($id_log);
		$dataLogs = array(
			"logs" => $logs
		);
	}

	public function registerLogs()
	{
		$this->load->model('LogsModel', 'logsModel', true);
		$logs = [];
		$this->logsModel->insert($logs);
	}
}
