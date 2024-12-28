<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Função para buscar todas as despesas ou despesas filtradas por data e categoria
    public function get_expenses($start_date = NULL, $end_date = NULL, $category_id = NULL) {
        $this->db->select('desp.data, cat.cat_nome, desp.descricao, desp.valor');
        $this->db->from('Tb_despesas as desp');
        $this->db->join('Tb_categorias as cat', 'cat.id = desp.id_cat');
        $this->db->join('Tb_usuarios as usu', 'usu.id = desp.id_usu');

        // Se as datas de início e fim forem fornecidas, aplicar o filtro de data
        if ($start_date && $end_date) {
            $this->db->where('desp.data >=', $start_date);
            $this->db->where('desp.data <=', $end_date);
        }

        // Se a categoria for fornecida, aplicar o filtro de categoria
        if ($category_id) {
            $this->db->where('desp.id_cat', $category_id);
        }

        $query = $this->db->get();
        return $query->result_array();  // Retorna um array de resultados
    }

    // Função para buscar todas as categorias
    public function get_categories() {
        $this->db->select('id, cat_nome');
        $this->db->from('Tb_categorias');
        $query = $this->db->get();
        return $query->result_array();  // Retorna um array de categorias
    }
}
