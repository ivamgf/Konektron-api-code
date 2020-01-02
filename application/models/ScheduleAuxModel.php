<?php

	class ScheduleAuxModelModel extends CI_Model {
		
		public function getScheduleAuxModel() {
			return $this->db->get('orkney10_konektron_cli.schedule_aux')->result();
		}

		public function getScheduleAuxModelId($id_schedule_aux) {
			return $this->db->get_where('orkney10_konektron_cli.schedule_aux', array('id_schedule_aux' => $id_schedule_aux))->row();
		}

		public function getScheduleAuxModelUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.schedule_aux', array('id_users' => $id_users))->row();
		}

		public function insertScheduleAuxModel($scheduleAuxModel) {
			$this->db->insert('orkney10_konektron_cli.schedule_aux', $scheduleAuxModel);
		}

		public function patchScheduleAuxModel($id_schedule_aux, $scheduleAuxModel) {
			$this->db->where('id_schedule_aux', $id_schedule_aux);
			$this->db->update('orkney10_konektron_cli.schedule_aux', $scheduleAuxModel);

			if($this->db->affected_rows() > 0) {
				return $id_schedule_aux;
			} 
			return NULL;
		}

		public function delScheduleAuxModel($id_schedule_aux) {
			$this->db->where('id_schedule_aux', $id_schedule_aux);
			$this->db->delete('orkney10_konektron_cli.schedule_aux');
		}
	}
