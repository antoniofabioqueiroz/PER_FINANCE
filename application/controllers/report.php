<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller 
{

    public function __construct() 
    {
        parent::__construct();
        // Carregar o modelo Expense_model
        $this->load->model('expense_model');
    }

    // Método padrão que carrega o formulário e as despesas sem filtro
    public function index() 
    {
        // Buscar todas as categorias para exibir no filtro
        $data['categories'] = $this->expense_model->get_categories();

        // Buscar todas as despesas sem filtro (caso o usuário não forneça nada)
        $data['expenses'] = $this->expense_model->get_expenses();

        // Carregar a view passando os dados
        $this->load->view('home_nav');
        $this->load->view('report/report_view', $data);
        $this->load->view('home_footer');
    }

    // Método responsável por gerar o relatório com base nos filtros
    public function generate_report() 
    {
        // Obter dados do formulário (filtro por datas e categoria)
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $category_id = $this->input->post('category_id');

        // Validar se as datas foram passadas, caso contrário, usar as datas padrão
        if (empty($start_date) || empty($end_date)) 
        {
            // Definindo datas padrão (por exemplo, última semana ou mês)
            $start_date = date('Y-m-d', strtotime('-1 month'));  // 1 mês atrás
            $end_date = date('Y-m-d');  // Data atual
        }

        // Buscar despesas com os filtros
        $data['expenses'] = $this->expense_model->get_expenses($start_date, $end_date, $category_id);

        // Buscar categorias para exibir novamente no filtro
        $data['categories'] = $this->expense_model->get_categories();

        // Carregar a view com os dados filtrados
        $this->load->view('home_nav');
        $this->load->view('report/report_view', $data);
        $this->load->view('home_footer');
    }
}
