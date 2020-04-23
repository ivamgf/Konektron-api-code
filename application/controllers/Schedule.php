<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {
		
	public function consultSchedule()
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$list_schedule = $this->scheduleModel->getSchedule();
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"list_schedule" => $list_schedule
                    ]
                )
            );
	}

	public function consultScheduleId($id_schedule)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = $this->scheduleModel->getScheduleId($id_schedule);
	
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"schedule" => $schedule
                    ]
                )
            );
	}

	public function consultScheduleUsers($id_users)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = $this->scheduleModel->getScheduleUsers($id_users);
		
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(
                json_encode(
                    [
						"schedule" => $schedule
                    ]
                )
            );
	}

	public function registerSchedule()
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = (array)json_decode($this->input->raw_input_stream);
		$schedule['sc_created'] = date('Y-m-d H:i:s');
		$schedule['sc_modified'] = date('Y-m-d H:i:s');
		$id = $this->scheduleModel->insertSchedule($schedule);
		$status_code = !empty($id) ? 201 : 400;
		return $this->output
            ->set_content_type('application/json')
			->set_status_header($status_code)
			->set_output(
                json_encode(
                    [ 'id_schedule' => $id ]
                )
            );
	}

	public function updateSchedule($id_schedule)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$schedule = (array)json_decode($this->input->raw_input_stream);
		$schedule['sc_modified'] = date('Y-m-d H:i:s');
		$updated = $this->scheduleModel->patchSchedule($id_schedule, $schedule);
		$status_code = $updated ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}

	public function deleteSchedule($id_schedule)
	{
		$this->load->model('ScheduleModel', 'scheduleModel', true);
		$deleted = $this->scheduleModel->delSchedule($id_schedule);
		$status_code = $deleted ? 204 : 400;
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
	}
}
