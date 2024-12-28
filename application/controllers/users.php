<?php
class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['users'] = $this->User_model->get_users();
        $this->load->view('home_nav');
        $this->load->view('users/user_view', $data);
        $this->load->view('home_footer');
    }

    public function create() {
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => md5($this->input->post('senha'))
        );
        $this->User_model->set_user($data);
        redirect('users');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => md5($this->input->post('senha'))
        );
        $this->User_model->update_user($id, $data);
        redirect('users');
    }

    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('users');
    }
}
?>
