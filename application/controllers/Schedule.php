<?php
/**
 * This file is part of the Orkney Tech (http://orkneytech.com.br)
 *
 * Copyright (c) 2020  Orkney Tech (http://orkneytech.com.br)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 *
 * PHP Version 7
 *
 * @category Controller
 * @package  Orkney
 * @author   Orkney Tech <suporte@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para controle das tarefas de cron
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Schedule
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Schedule extends MY_Controller
{

    /**
     * Retorna as tarefas de cron cadastradas
     *
     * @return void
     */
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

    /**
     * Retorna uma tarefa de cron pelo Id
     *
     * @param integer $id_schedule Id do cron
     *
     * @return void
     */
    public function consultScheduleId(int $id_schedule)
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

    /**
     * Retorna as tarefas de cron do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function consultScheduleUsers(int $id_users)
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

    /**
     * Registra uma nova tarefa de cron
     *
     * @return void
     */
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

    /**
     * Atualiza uma tarefa de cron
     *
     * @param integer $id_schedule Id da tarefa
     *
     * @return void
     */
    public function updateSchedule(int $id_schedule)
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

    /**
     * Remove uma tarefa de cron
     *
     * @param integer $id_schedule Id da tarefa
     *
     * @return void
     */
    public function deleteSchedule(int $id_schedule)
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
