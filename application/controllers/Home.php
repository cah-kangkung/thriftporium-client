<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Category_model', 'Category');
    }

    public function index()
    {
        // get all user information from the database
        $email = $this->session->userdata('user_email');
        $user = $this->User->get_user($email, 'email');

        $data = [
            'user' => $user,
            'title' => 'Thriftporium - Home',
            'category' => $this->Category->get_all_category(),
        ];

        $this->load->view('home/index', $data);
    }
}
