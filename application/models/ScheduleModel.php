<?php
/**
 * Model para cadastro dos dados auxiliares das tarefas
 *
 * @category   Model
 * @package    Konektron
 * @subpackage ScheduleModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class ScheduleModel extends CI_Model
{

    /**
     * Recupera as tarefas cadastradas
     *
     * @return void
     */
    public function getSchedule()
    {
        return $this->db->get('orkney10_konektron_cli.schedule')->result();
    }

    /**
     * Recupera a tarefa pelo id
     *
     * @param integer $id_schedule Id da tarefa
     *
     * @return void
     */
    public function getScheduleId(int $id_schedule)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.schedule',
            [
                'id_schedule' => $id_schedule
            ]
        )->row();
    }

    /**
     * Recupera a tarefa vinculada ao usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function getScheduleUsers(int $id_users)
    {
        return $this->db
            ->join('schedule_aux', 'schedule_aux.id_schedule = schedule.id_schedule')
            ->get_where(
                'schedule',
                [
                    'schedule_aux.id_users' => $id_users
                ]
            )->row();
    }

    /**
     * Insere uma nova tarefa
     *
     * @param stdClass $schedule Dados da tarefa
     *
     * @return void
     */
    public function insertSchedule(int $schedule)
    {
        $this->db->insert('orkney10_konektron_cli.schedule', $schedule);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Atualizar uma tarefa
     *
     * @param integer $id_schedule Id da tarefa
     * @param object  $schedule    Dados da tarefa
     *
     * @return void
     */
    public function patchSchedule(int $id_schedule, stdClass $schedule)
    {
        $this->db->where('id_schedule', $id_schedule);
        $this->db->update('orkney10_konektron_cli.schedule', $schedule);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove uma tarefa
     *
     * @param int $id_schedule Id da tarefa
     *
     * @return void
     */
    public function delSchedule(int $id_schedule)
    {
        $this->db->where('id_schedule', $id_schedule);
        $this->db->delete('orkney10_konektron_cli.schedule');
        return $this->db->affected_rows() > 0;
    }
}
