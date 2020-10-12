<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            show_404();
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'min_length' => "Password is too short!"
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Thriftporium - Login',
            ];
            $this->load->view('layout/header', $data);
            $this->load->view('auth/login');
            $this->load->view('layout/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        // get login form input ($_POST) 
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // get all user information from the database
        $user = $this->User->get_user($email, 'email');

        // check wether user is existed or not
        if ($user) {
            // check wether user is activated or not
            if ($user['user_status'] == 1) {
                // password check
                if (password_verify($password, $user['user_password'])) {
                    $session = [
                        'user_email' => $user['user_email'],
                        'user_role' => $user['role_id'],
                        'logged_in' => TRUE
                    ];
                    $this->session->set_userdata($session);

                    if ($user['role_id'] == 2001) {
                        redirect('home');
                    }
                    if ($user['role_id'] == 1110) {
                        redirect('admin_dashboard');
                    }
                } else {
                    $this->session->set_flashdata('danger_alert', 'Wrong password!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('danger_alert', 'Email has not been activated');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('danger_alert', 'Email has not been registered');
            redirect('auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            show_404();
        }

        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', 'Repeat Password', 'required|trim|min_length[6]|matches[repeat_password]', [
            'matches' => "Password don't match!",
            'min_length' => "Password is too short!"
        ]);
        $this->form_validation->set_rules('repeat_password', 'Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Thriftporium - Register',
            ];
            $this->load->view('layout/header', $data);
            $this->load->view('auth/register');
            $this->load->view('layout/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'first_name' => htmlspecialchars($this->input->post('first_name', true)),
                'last_name' => htmlspecialchars($this->input->post('last_name', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 2001,
            ];

            $this->User->create_user($data);

            $this->session->set_flashdata('success_alert', 'Your Account has been created. Please check your email for activation');
            redirect('auth');
        }
    }

    // custom validation rules
    public function email_check($str)
    {
        $user = $this->User->get_user($str, 'email');

        if ($user) {
            $this->form_validation->set_message('email_check', 'Email has already been taken');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function logout()
    {
        // Remove token and user data from the session
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('logged_in');

        $this->session->set_flashdata('success_alert', 'Anda telah keluar!');
        redirect('auth');
    }

    public function access_blocked()
    {
        $this->load->view('');
    }
}
