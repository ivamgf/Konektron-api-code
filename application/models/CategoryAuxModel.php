<?php
/**
 * Model para cadastro dos dados auxiliares da categoria
 *
 * @category   Model
 * @package    Konektron
 * @subpackage CategoryAuxModel
 * @author     Orkney Tech <suporte@orkneytech.com.br>
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
        return $this->db->get('orkney10_konektron_cli.category_aux')->result();
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
            'orkney10_konektron_cli.category_aux',
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
    public function getCategoryAuxService(int $id_service = 0)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.category_aux',
            [
                'id_service' => $id_service
            ]
        )->row();
    }

    /**
     * Insere os dados auxiliares da categoria
     *
     * @param object $id_category_aux Dados auxiliares da categoria
     *
     * @return void
     */
    public function insertCategoryAux(object $id_category_aux)
    {
        $this->db->insert('orkney10_konektron_cli.category_aux', $id_category_aux);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Atualiza os dados auxiliares da categoria
     *
     * @param integer $id_category_aux Id dos dados auxiliares da categoria
     * @param object  $categoryAux     Dados auxiliares da categoria
     *
     * @return void
     */
    public function patchCategoryAux(int $id_category_aux, object $categoryAux)
    {
        $this->db->where('id_category_aux', $id_category_aux);
        $this->db->update('orkney10_konektron_cli.category_aux', $categoryAux);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Deleta os dados auxiliares da categoria
     *
     * @param integer $id_category_aux Id dos dados auxiliares da categoria
     *
     * @return void
     */
    public function delCategoryAux(int $id_category_aux = 0)
    {
        $this->db->where('id_category_aux', $id_category_aux);
        $this->db->delete('orkney10_konektron_cli.category_aux');
        return $this->db->affected_rows() > 0;
    }
}
