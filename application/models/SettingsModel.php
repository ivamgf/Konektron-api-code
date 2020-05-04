<?php
/**
 * Model para recuperação das configurações
 *
 * @category   Model
 * @package    Konektron
 * @subpackage SettingsModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class SettingsModel extends CI_Model
{

    /**
     * Retorna as configurações do sistema
     *
     * @return array
     */
    public function getSettings(): array
    {
        return $this->db->get('settings')
            ->result() ?? [];
    }

    /**
     * Retorna a configuração pelo Id
     *
     * @param integer $id_setting Id do log
     *
     * @return stdClass
     */
    public function getSettingsId(int $id_setting): stdClass
    {
        return $this->db->get_where(
            'settings',
            [
                'id_setting' => $id_setting
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Retorna a configuração pelo nome do parâmetro
     *
     * @param string $st_param Nome do parâmetro
     *
     * @return stdClass
     */
    public function getSettingsParam(string $st_param): stdClass
    {
        $this->db->cache_on();
        return $this->db->get_where(
            'settings',
            [
                'st_param' => $st_param
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Retorna as configurções do grupo
     *
     * @param string $st_group Nome do grupo de configurções
     *
     * @return array
     */
    public function getSettingsGroup(string $st_group): array
    {
        $this->db->cache_on();
        return $this->db->get_where(
            'settings',
            [
                'st_group' => $st_group
            ]
        )->result() ?? [];
    }
}
