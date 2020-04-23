<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller {

    public function consultSchedule()
    {
        $this->load->model('ScheduleModel', 'scheduleModel', true);
        $list_schedule = $this->scheduleModel->getSchedule();

        $this->response(
            [
                "list_schedule" => $list_schedule
            ],
            200
        );
    }

    public function consultScheduleId($id_schedule)
    {
        $this->load->model('ScheduleModel', 'scheduleModel', true);
        $schedule = $this->scheduleModel->getScheduleId($id_schedule);

        $this->response(
            [
                "schedule" => $schedule
            ],
            200
        );
    }

    public function consultScheduleUsers($id_users)
    {
        $this->load->model('ScheduleModel', 'scheduleModel', true);
        $schedule = $this->scheduleModel->getScheduleUsers($id_users);

        $this->response(
            [
                "schedule" => $schedule
            ],
            200
        );
    }

    public function registerSchedule()
    {
        $this->load->model('ScheduleModel', 'scheduleModel', true);
        if ($schedule = $this->getData()) {
            $schedule->sc_created = date('Y-m-d H:i:s');
            $schedule->sc_modified = date('Y-m-d H:i:s');
            $id = $this->scheduleModel->insertSchedule($schedule);
            $status_code = !empty($id) ? 201 : 400;

            $this->response(
                [
                    'id_schedule' => $id
                ],
                $status_code
            );
        }
    }

    public function updateSchedule($id_schedule)
    {
        $this->load->model('ScheduleModel', 'scheduleModel', true);
        if ($schedule = $this->getData()) {
            $schedule->sc_modified = date('Y-m-d H:i:s');
            $updated = $this->scheduleModel->patchSchedule($id_schedule, $schedule);
            $status_code = $updated ? 204 : 400;

            $this->response(
                null,
                $status_code
            );
        }
    }

    public function deleteSchedule($id_schedule)
    {
        $this->load->model('ScheduleModel', 'scheduleModel', true);
        $deleted = $this->scheduleModel->delSchedule($id_schedule);
        $status_code = $deleted ? 204 : 400;

        $this->response(
            null,
            $status_code
        );
    }
}
