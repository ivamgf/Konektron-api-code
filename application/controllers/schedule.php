<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {
		
	public function consultSchedule()
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$list_schedule = $this->scheduleModel->getSchedule();

		$dataSchedule = array(
			"list_schedule" => $list_schedule
		);
	}

	public function consultScheduleId($id_schedule)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = $this->scheduleModel->getScheduleId($id_schedule);
		$dataSchedule = array(
			"schedule" => $schedule
		);
	}

	public function consultScheduleUsers($id_users)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = $this->scheduleModel->getScheduleUsers($id_users);
		$dataSchedule = array(
			"schedule" => $schedule
		);
	}

	public function registerSchedule()
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = [];
		$this->scheduleModel->insert($schedule);
	}

	public function updateSchedule($id_schedule)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = array();
		$id = $this->scheduleModel->patchSchedule($id_schedule, $schedule);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-schedule', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-schedule', 'Alteração feita com sucesso!');
		}
		$msgSchedule = $this->session->set_flashdata('edit-schedule');
	}

	public function deleteSchedule($id_schedule)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$this->scheduleModel->delSchedule($id_schedule);
	}
}
