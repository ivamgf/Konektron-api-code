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
     * @return array
     */
    public function getLogs(): array
    {
        return $this->db->get('logs')
            ->result() ?? [];
    }

    /**
     * Retorna um log pelo Id
     *
     * @param integer $id_log Id do log
     *
     * @return stdClass
     */
    public function getLogsId(int $id_log)
    {
        return $this->db->get_where(
            'logs',
            [
                'id_log' => $id_log
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere um novo log no sistema
     *
     * @param stdClass $logs Dados do log
     *
     * @return integer
     */
    public function insertLogs(stdClass $logs): int
    {
        $this->db->insert('logs', $logs);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }
}
