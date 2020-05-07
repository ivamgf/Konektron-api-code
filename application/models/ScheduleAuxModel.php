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
class ScheduleAuxModel extends CI_Model
{

    /**
     * Recupera os dados auxiliares das tarefas
     *
     * @return array
     */
    public function getScheduleAux(): array
    {
        return $this->db->get('schedule_aux')
            ->result() ?? [];
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id
     *
     * @param integer $id_schedule_aux Id dos dados auxiliares
     *
     * @return stdClass
     */
    public function getScheduleAuxId(int $id_schedule_aux): stdClass
    {
        return $this->db->get_where(
            'schedule_aux',
            [
                'id_schedule_aux' => $id_schedule_aux
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recuperar os dados auxiliares da tarefa pelo id de outra tarefa
     *
     * @param integer $id_schedule Id da tarefa vinculada
     *
     * @return stdClass
     */
    public function getScheduleAuxIdSch(int $id_schedule): stdClass
    {
        return $this->db->get_where(
            'schedule_aux',
            [
                'id_schedule' => $id_schedule
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id do usuário
     *
     * @param integer $id_users Id do usuário
     *
     * @return stdClass
     */
    public function getScheduleAuxUsers(int $id_users): stdClass
    {
        return $this->db->get_where(
            'schedule_aux',
            [
                'id_users' => $id_users
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id do fornecedor
     *
     * @param integer $id_providers Id do fornecedor
     *
     * @return stdClass
     */
    public function getScheduleAuxProviders(int $id_providers): stdClass
    {
        return $this->db->get_where(
            'schedule_aux',
            [
                'id_providers' => $id_providers
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Recupera os dados auxiliares da tarefa pelo id do serviço
     *
     * @param integer $id_service Id do serviço
     *
     * @return stdClass
     */
    public function getScheduleAuxService(int $id_service): stdClass
    {
        return $this->db->get_where(
            'schedule_aux',
            [
                'id_service' => $id_service
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere os dados auxiliares da tarefa
     *
     * @param stdClass $scheduleAuxModel Dados auxiliares da tarefa
     *
     * @return integer
     */
    public function insertScheduleAux(stdClass $scheduleAuxModel): int
    {
        $this->db->insert(
            'schedule_aux',
            $scheduleAuxModel
        );
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza os dados auxiliares da tarefa
     *
     * @param integer  $id_schedule_aux  Id dos dados auxiliares
     * @param stdClass $scheduleAuxModel Dados auxiliares da tarefa
     *
     * @return boolean
     */
    public function patchScheduleAux(
        int $id_schedule_aux,
        stdClass $scheduleAuxModel
    ): bool {
        $this->db->where('id_schedule_aux', $id_schedule_aux);
        $this->db->update(
            'schedule_aux', $scheduleAuxModel
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove os dados auxiliares da tarefa
     *
     * @param integer $id_schedule_aux Id dos dados auxiliares
     *
     * @return boolean
     */
    public function delScheduleAux(int $id_schedule_aux): bool
    {
        $this->db->where('id_schedule_aux', $id_schedule_aux);
        $this->db->delete('schedule_aux');
        return $this->db->affected_rows() > 0;
    }
}
