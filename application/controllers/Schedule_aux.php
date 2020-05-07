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
 * @author   Orkney Tech <contato@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para o vinculo da tarefa com serviço, cliente e fornecedor
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage ScheduleAux
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Schedule_Aux extends MY_Controller
{

    /**
     * Recupera os vinculos das tarefas
     *
     * @return void
     */
    public function consultScheduleAux()
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        $list_scheduleAux = $this->scheduleAuxModel->getScheduleAux();

        $this->response(
            [
                "list_scheduleAux" => $list_scheduleAux
            ],
            200
        );
    }

    /**
     * Recupera o vinculo de uma tarefa
     *
     * @param integer $id_schedule_aux Id do vinculo
     *
     * @return void
     */
    public function consultScheduleAuxId(int $id_schedule_aux)
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        $scheduleAux = $this->scheduleAuxModel->getScheduleAuxId($id_schedule_aux);

        $this->response(
            [
                "scheduleAux" => $scheduleAux
            ],
            200
        );
    }

    /**
     * Recupera o vinculo pelo id da tarefa
     *
     * @param integer $id_schedule Id da tarefa
     *
     * @return void
     */
    public function consultScheduleAuxIdSch(int $id_schedule)
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        $scheduleAux = $this->scheduleAuxModel->getScheduleAuxIdSch($id_schedule);

        $this->response(
            [
                "scheduleAux" => $scheduleAux
            ],
            200
        );
    }

    /**
     * Recupera o vinculo pelo id do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function consultScheduleAuxUsers(int $id_users)
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        $scheduleAux = $this->scheduleAuxModel->getScheduleAuxUsers($id_users);

        $this->response(
            [
                "scheduleAux" => $scheduleAux
            ],
            200
        );
    }

    /**
     * Retorna o vinculo pelo id do fornecedor
     *
     * @param integer $id_providers Id do fornecedor
     *
     * @return void
     */
    public function consultScheduleAuxProviders(int $id_providers)
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        $scheduleAux = $this->scheduleAuxModel->getScheduleAuxProviders($id_providers);

        $this->response(
            [
                "scheduleAux" => $scheduleAux
            ],
            200
        );
    }

    /**
     * Registra um novo vinculo da tarefa
     *
     * @return void
     */
    public function registerScheduleAux()
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        if ($scheduleAux = $this->getData()) {
            $scheduleAux->sa_modified = date('Y-m-d H:i:s');
            $id = $this->scheduleAuxModel->insertScheduleAux($scheduleAux);
            $status_code = !empty($id) ? 201 : 404;

            $this->response(
                [
                    'id_schedule_aux' => $id
                ],
                $status_code
            );
        }
    }

    /**
     * Atualiza um vinculo existente
     *
     * @param integer $id_schedule_aux Id do vinculo
     *
     * @return void
     */
    public function updateScheduleAux(int $id_schedule_aux)
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        if ($scheduleAux = $this->getData()) {
            $scheduleAux->sa_modified = date('Y-m-d H:i:s');
            $updated = $this->scheduleAuxModel->patchScheduleAux($id_schedule_aux, $scheduleAux);
            $output = !empty($updated)
                ? ['updated' => $updated ]
                : ['code' => 404, 'msg' => 'Vinculo da tarefa não encontrada!' ];
            $status_code = $updated ? 204 : 404;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Remove um vinculo existente
     *
     * @param integer $id_schedule_aux Id do vinculo
     *
     * @return void
     */
    public function deleteScheduleAux(int $id_schedule_aux)
    {
        $this->load->model('ScheduleAuxModel', 'scheduleAuxModel', true);
        $deleted = $this->scheduleAuxModel->delScheduleAux($id_schedule_aux);
        $output = !empty($deleted)
                ? ['deleted' => $deleted ]
                : ['code' => 404, 'msg' => 'Vinculo da tarefa não encontrada!' ];
        $status_code = $deleted ? 204 : 404;

        $this->response(
            $output,
            $status_code
        );
    }
}
