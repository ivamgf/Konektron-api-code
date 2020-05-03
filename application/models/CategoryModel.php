<?php
/**
 * Model para cadastro das categorias
 *
 * @category   Model
 * @package    Konektron
 * @subpackage CategoryModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class CategoryModel extends CI_Model
{
    /**
     * Recupera as categorias cadastradas
     *
     * @return array
     */
    public function getCategory(): array
    {
        return $this->db->get('orkney10_konektron_cli.category')
            ->result() ?? [];
    }

    /**
     * Recupera um categoria pelo Id
     *
     * @param integer $id_category Id da categoria
     *
     * @return stdClass
     */
    public function getCategoryId(int $id_category): stdClass
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.category',
            [
                'id_category' => $id_category
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Insere uma nova categoria
     *
     * @param stdClass $category Dados da nova categoria
     *
     * @return integer
     */
    public function insertCategory(stdClass $category): int
    {
        $this->db->insert('orkney10_konektron_cli.category', $category);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Atualiza uma categoria pelo Id
     *
     * @param integer  $id_category Id da categoria
     * @param stdClass $category    Dados da categoria
     *
     * @return boolean
     */
    public function patchCategory(int $id_category, stdClass $category): bool
    {
        $this->db->where('id_category', $id_category);
        $this->db->update('orkney10_konektron_cli.category', $category);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Remove uma categoria pelo Id
     *
     * @param integer $id_category Id da categoria
     *
     * @return boolean
     */
    public function delCategory(int $id_category): bool
    {
        $this->db->where('id_category', $id_category);
        $this->db->delete('orkney10_konektron_cli.category');
        return $this->db->affected_rows() > 0;
    }
}
