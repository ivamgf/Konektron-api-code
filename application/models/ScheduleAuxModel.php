<?php
/**
 * Model para cadastro dos dados auxiliares das tarefas
 *
 * @category   Model
 * @package    Konektron
 * @subpackage ProfileModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class ScheduleAuxModelModel extends CI_Model
{

    /**
     * Recupera os dados auxiliares das tarefas
     *
     * @return void
     */
    public function getScheduleAux()
    {
        return $this->db->get('orkney10_konektron_cli.schedule_aux')->result();
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id
     *
     * @param integer $id_schedule_aux Id dos dados auxiliares
     *
     * @return void
     */
    public function getScheduleAuxId(int $id_schedule_aux)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.schedule_aux',
            [
                'id_schedule_aux' => $id_schedule_aux
            ]
        )->row();
    }

    /**
     * Recuperar os dados auxiliares da tarefa pelo id de outra tarefa
     *
     * @param integer $id_schedule Id da tarefa vinculada
     *
     * @return void
     */
    public function getScheduleAuxIdSch(int $id_schedule)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.schedule_aux',
            [
                'id_schedule' => $id_schedule
            ]
        )->row();
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return void
     */
    public function getScheduleAuxUsers(int $id_users)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.schedule_aux',
            [
                'id_users' => $id_users
            ]
        )->row();
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id do fornecedor
     *
     * @param integer $id_providers Id do fornecedor
     *
     * @return void
     */
    public function getScheduleAuxProviders(int $id_providers)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.schedule_aux',
            [
                'id_providers' => $id_providers
            ]
        )->row();
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id do serviço
     *
     * @param integer $id_service Id do serviço
     *
     * @return void
     */
    public function getScheduleAuxService(int $id_service)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.schedule_aux',
            [
                'id_service' => $id_service
            ]
        )->row();
    }

    /**
     * Insere os dados auxiliares da tarefa
     *
     * @param stdClass $scheduleAuxModel Dados auxiliares da tarefa
     *
     * @return void
     */
    public function insertScheduleAux(stdClass $scheduleAuxModel)
    {
        $this->db->insert(
            'orkney10_konektron_cli.schedule_aux',
            $scheduleAuxModel
        );
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Atualiza os dados auxiliares da tarefa
     *
     * @param integer $id_schedule_aux  Id dos dados auxiliares
     * @param stdClass  $scheduleAuxModel Dados auxiliares da tarefa
     *
     * @return void
     */
    public function patchScheduleAux(int $id_schedule_aux, stdClass $scheduleAuxModel)
    {
        $this->db->where('id_schedule_aux', $id_schedule_aux);
        $this->db->update('orkney10_konektron_cli.schedule_aux', $scheduleAuxModel);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove os dados auxiliares da tarefa
     *
     * @param integer $id_schedule_aux Id dos dados auxiliares
     *
     * @return void
     */
    public function delScheduleAux(int $id_schedule_aux)
    {
        $this->db->where('id_schedule_aux', $id_schedule_aux);
        $this->db->delete('orkney10_konektron_cli.schedule_aux');
        return $this->db->affected_rows() > 0;
    }
}
