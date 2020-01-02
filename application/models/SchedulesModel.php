<?php

	class SchedulesModel extends CI_Model {
		
		public function getSchedules() {
			return $this->db->get('orkney10_konektron_cli.schedules')->result();
		}

		public function getSchedulesId($id_schedule) {
			return $this->db->get_where('orkney10_konektron_cli.schedules', array('id_schedules' => $id_schedule))->row();
		}

		public function getSchedulesUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.schedules', array('id_users' => $id_users))->row();
		}

		public function insertSchedules($schedules) {
			$this->db->insert('orkney10_konektron_cli.schedules', $schedules);
		}

		public function patchSchedules($id_schedule, $schedules) {
			$this->db->where('id_schedules', $id_schedule);
			$this->db->update('orkney10_konektron_cli.schedules', $schedules);

			if($this->db->affected_rows() > 0) {
				return $id_schedule;
			} 
			return NULL;
		}

		public function delSchedules($id_schedule) {
			$this->db->where('id_schedules', $id_schedule);
			$this->db->delete('orkney10_konektron_cli.schedules');
		}
	}
