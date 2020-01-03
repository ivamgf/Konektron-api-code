<?php

	class ScheduleModel extends CI_Model {
		
		public function getSchedule() {
			return $this->db->get('orkney10_konektron_cli.schedule')->result();
		}

		public function getScheduleId($id_schedule) {
			return $this->db->get_where('orkney10_konektron_cli.schedule', array('id_schedule' => $id_schedule))->row();
		}

		public function getScheduleUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.schedule', array('id_users' => $id_users))->row();
		}

		public function insertSchedule($schedule) {
			$this->db->insert('orkney10_konektron_cli.schedule', $schedule);
		}

		public function patchSchedule($id_schedule, $schedule) {
			$this->db->where('id_schedule', $id_schedule);
			$this->db->update('orkney10_konektron_cli.schedule', $schedule);

			if($this->db->affected_rows() > 0) {
				return $id_schedule;
			} 
			return NULL;
		}

		public function delSchedule($id_schedule) {
			$this->db->where('id_schedule', $id_schedule);
			$this->db->delete('orkney10_konektron_cli.schedule');
		}
	}
