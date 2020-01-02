<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends CI_Controller {
		
	public function consultSchedule()
	{
		$this->load->model('SchedulesModel', 'schedulesModel', true);
		$list_schedules = $this->schedulesModel->getSchedules();

		$dataSchedules = array(
			"list_schedules" => $list_schedules
		);
	}

	public function consultScheduleId($id_schedule)
	{
		$this->load->model('SchedulesModel', 'schedulesModel', true);
		$schedules = $this->schedulesModel->getSchedulesId($id_schedule);
		$dataSchedules = array(
			"schedules" => $schedules
		);
	}

	public function consultScheduleUsers($id_users)
	{
		$this->load->model('SchedulesModel', 'schedulesModel', true);
		$schedules = $this->schedulesModel->getSchedulesUsers($id_users);
		$dataSchedules = array(
			"schedules" => $schedules
		);
	}

	public function registerSchedule()
	{
		$this->load->model('SchedulesModel', 'schedulesModel', true);
		$schedules = [];
		$this->schedulesModel->insert($schedules);
	}

	public function updateSchedule($id_schedule)
	{
		$this->load->model('SchedulesModel', 'schedulesModel', true);
		$schedules = array();
		$id = $this->schedulesModel->patchSchedules($id_schedule, $schedules);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-schedules', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-schedules', 'Alteração feita com sucesso!');
		}
		$msgSchedules = $this->session->set_flashdata('edit-schedules');
	}

	public function deleteSchedule($id_schedule)
	{
		$this->load->model('SchedulesModel', 'schedulesModel', true);
		$this->schedulesModel->delSchedules($id_schedule);
	}
}
