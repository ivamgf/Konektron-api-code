<?php
/**
 * Model para cadastro dos dados auxiliares das tarefas
 *
 * @category   Model
 * @package    Konektron
 * @subpackage StockServicesModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class StockServicesModel extends CI_Model
{

    /**
     * Recupera os serviços cadastrados
     *
     * @return void
     */
    public function getStockServices(): array
    {
        return $this->db->get('services')
            ->result() ?? [];
    }

    /**
     * Recupera um serviço pelo Id
     *
     * @param integer $id_service Id do serviço
     *
     * @return stdClass
     */
    public function getStockServicesId(int $id_service): stdClass
    {
        return $this->db->get_where(
            'services',
            [
                'id_service' => $id_service
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Registra um novo serviç
     *
     * @param stdClass $stockServices Novo serviço
     *
     * @return integer
     */
    public function insertStockServices(stdClass $stockServices): int
    {
        $this->db->insert('services', $stockServices);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza um serviço pelo id
     *
     * @param integer $id_service Id do serviço
     * @param stdClass $stockServices Dados do serviço
     *
     * @return boolean
     */
    public function patchStockServices(
        int $id_service,
        stdClass $stockServices
    ): bool {
        $this->db->where('id_service', $id_service);
        $this->db->update('services', $stockServices);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove um serviço pelo id
     *
     * @param integer $id_service Id do serviço
     *
     * @return boolean
     */
    public function delStockServices(int $id_service): bool
    {
        $this->db->where('id_service', $id_service);
        $this->db->delete('services');
        return $this->db->affected_rows() > 0;
    }
}
