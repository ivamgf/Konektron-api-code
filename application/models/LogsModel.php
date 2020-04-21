<?php

	class LogsModel extends CI_Model {
		
		public function getLogs() {
			return $this->db->get('orkney10_konektron_cli.logs')->result();
		}

		public function getLogsId($id_log) {
			return $this->db->get_where('orkney10_konektron_cli.logs', array('id_log' => $id_log))->row();
		}

		public function insertLogs($logs) {
			$this->db->insert('orkney10_konektron_cli.logs', $logs);
			return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
		}
	}
