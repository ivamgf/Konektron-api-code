<?php
/**
 * Model para cadastro dos logs
 *
 * @category   Model
 * @package    Konektron
 * @subpackage LogsModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class LogsModel extends CI_Model
{

    /**
     * Retorna os logs do sistema
     *
     * @return void
     */
    public function getLogs()
    {
        return $this->db->get('orkney10_konektron_cli.logs')->result();
    }

    /**
     * Retorna um log pelo Id
     *
     * @param integer $id_log Id do log
     *
     * @return void
     */
    public function getLogsId(int $id_log)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.logs',
            [
                'id_log' => $id_log
            ]
        )->row();
    }

    /**
     * Insere um novo log no sistema
     *
     * @param stdClass $logs Dados do log
     *
     * @return void
     */
    public function insertLogs(stdClass $logs)
    {
        $this->db->insert('orkney10_konektron_cli.logs', $logs);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }
}
