<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
                'title' => 'Admin - Dashboard',
                'payments' => $this->Payment->get_payment('verified', 'status')
            ];
            $total_income = 0;
            if ($data['payments']) {
                for ($i = 0; $i < count($data['payments']); $i++) {
                    $total_income += $data['payments'][$i]['total_price'];
                }
                $data['total_income'] = $total_income;
            } else {
                $data['total_income'] = $total_income;
            }

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/dashboard/index');
            $this->load->view('layout/admin/footer.php');
        }
    }
}
