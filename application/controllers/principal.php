<?php
class Principal extends CI_Controller
{
    public function index()
    {
        $this->load->view('home_nav');
        $this->load->view('home_content');
        $this->load->view('home_footer');
    }
}
?>