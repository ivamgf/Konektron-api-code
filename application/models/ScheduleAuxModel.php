<?php

	class ScheduleAuxModelModel extends CI_Model {
		
		public function getScheduleAux() {
			return $this->db->get('orkney10_konektron_cli.schedule_aux')->result();
		}

		public function getScheduleAuxId($id_schedule_aux) {
			return $this->db->get_where('orkney10_konektron_cli.schedule_aux', array('id_schedule_aux' => $id_schedule_aux))->row();
		}

		public function getScheduleAuxIdSch($id_schedule) {
			return $this->db->get_where('orkney10_konektron_cli.schedule_aux', array('id_schedule' => $id_schedule))->row();
		}

		public function getScheduleAuxUsers($id_users) {
			return $this->db->get_where('orkney10_konektron_cli.schedule_aux', array('id_users' => $id_users))->row();
		}		

		public function getScheduleAuxProviders($id_providers) {
			return $this->db->get_where('orkney10_konektron_cli.schedule_aux', array('id_providers' => $id_providers))->row();
		}

		public function getScheduleAuxService($id_service) {
			return $this->db->get_where('orkney10_konektron_cli.schedule_aux', array('id_service' => $id_service))->row();
		}

		public function insertScheduleAux($scheduleAuxModel) {
			$this->db->insert('orkney10_konektron_cli.schedule_aux', $scheduleAuxModel);
		}

		public function patchScheduleAux($id_schedule_aux, $scheduleAuxModel) {
			$this->db->where('id_schedule_aux', $id_schedule_aux);
			$this->db->update('orkney10_konektron_cli.schedule_aux', $scheduleAuxModel);

			if($this->db->affected_rows() > 0) {
				return $id_schedule_aux;
			} 
			return NULL;
		}

		public function delScheduleAux($id_schedule_aux) {
			$this->db->where('id_schedule_aux', $id_schedule_aux);
			$this->db->delete('orkney10_konektron_cli.schedule_aux');
		}
	}
