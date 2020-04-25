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
 * Controller para controle dos logs
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Logs
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Logs extends MY_Controller
{

    /**
     * Retorna os logs do sistema
     *
     * @return void
     */
    public function consultLogs()
    {
        $this->load->model('LogsModel', 'logsModel', true);
        $list_logs = $this->logsModel->getLogs();

        $this->response(
            [
                "list_logs" => $list_logs
            ],
            200
        );
    }

    /**
     * Retorna o log pelo Id
     *
     * @param integer $id_log Id do log
     *
     * @return void
     */
    public function consultLogsId(int $id_log = 0)
    {
        $this->load->model('LogsModel', 'logsModel', true);
        $logs = $this->logsModel->getLogsId($id_log);

        $this->response(
            [
                "logs" => $logs
            ],
            200
        );
    }

    /**
     * Registra um novo log no sistema
     *
     * @return void
     */
    public function registerLogs()
    {
        $this->load->model('LogsModel', 'logsModel', true);
        if ($logs = $this->getData()) {
            $logs->lo_created = date('Y-m-d H:i:s');
            $logs->lo_modified = date('Y-m-d H:i:s');
            $id = $this->logsModel->insertLogs($logs);
            $status_code = !empty($id) ? 201 : 400;

            $this->response(
                [
                    "id_log" => $id
                ],
                $status_code
            );
        }
    }
}
