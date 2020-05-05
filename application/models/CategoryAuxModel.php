<?php
/**
 * Model para cadastro dos dados auxiliares da categoria
 *
 * @category   Model
 * @package    Konektron
 * @subpackage CategoryAuxModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class CategoryAuxModel extends CI_Model
{

    /**
     * Recupera os dados auxiliares da categoria
     *
     * @return void
     */
    public function getCategoryAux()
    {
        return $this->db->get('category_aux')->result();
    }

    /**
     * Recupera os dados auxiliares da categoria pelo Id
     *
     * @param integer $id_category_aux Id dos dados auxiliares
     *
     * @return void
     */
    public function getCategoryAuxId(int $id_category_aux)
    {
        return $this->db->get_where(
            'category_aux',
            [
                'id_category_aux' => $id_category_aux
            ]
        )->row();
    }

    /**
     * Recupera os dados auxiliares da categoria do serviço
     *
     * @param integer $id_service Id do serviço
     *
     * @return void
     */
    public function getCategoryAuxService(int $id_service)
    {
        return $this->db->get_where(
            'category_aux',
            [
                'id_service' => $id_service
            ]
        )->row();
    }

    /**
     * Insere os dados auxiliares da categoria
     *
     * @param stdClass $id_category_aux Dados auxiliares da categoria
     *
     * @return void
     */
    public function insertCategoryAux(stdClass $id_category_aux)
    {
        $this->db->insert('category_aux', $id_category_aux);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Atualiza os dados auxiliares da categoria
     *
     * @param integer $id_category_aux Id dos dados auxiliares da categoria
     * @param stdClass  $categoryAux     Dados auxiliares da categoria
     *
     * @return void
     */
    public function patchCategoryAux(int $id_category_aux, stdClass $categoryAux)
    {
        $this->db->where('id_category_aux', $id_category_aux);
        $this->db->update('category_aux', $categoryAux);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Deleta os dados auxiliares da categoria
     *
     * @param integer $id_category_aux Id dos dados auxiliares da categoria
     *
     * @return void
     */
    public function delCategoryAux(int $id_category_aux)
    {
        $this->db->where('id_category_aux', $id_category_aux);
        $this->db->delete('category_aux');
        return $this->db->affected_rows() > 0;
    }
}
