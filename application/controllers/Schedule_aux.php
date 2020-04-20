<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleAux extends CI_Controller {
		
	public function consultScheduleAux()
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$list_scheduleAux = $this->scheduleAuxModel->getScheduleAux();

		$dataScheduleAux = array(
			"list_scheduleAux" => $list_scheduleAux
		);
	}

	public function consultScheduleAuxId($id_schedule_aux)
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$scheduleAux = $this->scheduleAuxModel->getScheduleAuxId($id_schedule_aux);
		$dataScheduleAux = array(
			"scheduleAux" => $scheduleAux
		);
	}

	public function consultScheduleAuxIdSch($id_schedule)
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$scheduleAux = $this->scheduleAuxModel->getScheduleAuxIdSch($id_schedule);
		$dataScheduleAux = array(
			"scheduleAux" => $scheduleAux
		);
	}

	public function consultScheduleAuxUsers($id_users)
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$scheduleAux = $this->scheduleAuxModel->getScheduleAuxUsers($id_users);
		$dataScheduleAux = array(
			"scheduleAux" => $scheduleAux
		);
	}

	public function consultScheduleAuxProviders($id_providers)
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$scheduleAux = $this->scheduleAuxModel->getScheduleAuxProviders($id_providers);
		$dataScheduleAux = array(
			"scheduleAux" => $scheduleAux
		);
	}

	public function consultScheduleAuxService($id_service)
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$scheduleAux = $this->scheduleAuxModel->getScheduleAuxService($id_service);
		$dataScheduleAux = array(
			"scheduleAux" => $scheduleAux
		);
	}

	public function registerScheduleAux()
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$scheduleAux = [];
		$this->scheduleAuxModel->insert($scheduleAux);
	}

	public function updateScheduleAux($id_schedule_aux)
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$scheduleAux = array();
		$id = $this->scheduleAuxModel->patchScheduleAux($id_schedule_aux, $scheduleAux);
		if(is_null($id)) {
			$this->session->set_flashdata('edit-scheduleAux', 'Erro ao atualizar dados!');
		}
		else {
			$this->session->set_flashdata('edit-scheduleAux', 'Alteração feita com sucesso!');
		}
		$msgScheduleAux = $this->session->set_flashdata('edit-scheduleAux');
	}

	public function deleteScheduleAux($id_schedule_aux)
	{
		$this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
		$this->scheduleAuxModel->delScheduleAux($id_schedule_aux);
	}
}
