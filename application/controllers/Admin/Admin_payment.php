<?php

use phpDocumentor\Reflection\PseudoTypes\False_;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Payment_model', 'Payment');
    }

    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('user_role') == 2001) {
                redirect('home');
            }

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $admin = $this->User->get_user($email, 'email');

            $data = [
                'admin' => $admin,
                'title' => 'Admin - Payment',
                'payment_list' => $this->Payment->get_all_payment(),
            ];

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/payment/index');
            $this->load->view('layout/admin/footer.php');
        }
    }
}