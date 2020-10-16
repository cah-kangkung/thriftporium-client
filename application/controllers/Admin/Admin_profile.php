<?php

use phpDocumentor\Reflection\PseudoTypes\False_;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
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
                'title' => 'Admin - Profile',
            ];

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/profile/index');
            $this->load->view('layout/admin/footer.php');
        }
    }

    public function change_password($id)
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

            $this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[6]|matches[repeat_password]', [
                'matches' => "Password don't match!",
                'min_length' => "Password is too short!"
            ]);
            $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|matches[new_password]');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'admin' => $admin,
                    'title' => 'Admin - Profile',
                ];

                $this->load->view('layout/admin/header.php', $data);
                $this->load->view('layout/admin/sidebar.php');
                $this->load->view('layout/admin/topbar.php');
                $this->load->view('admin/profile/index');
                $this->load->view('layout/admin/footer.php');
            } else {
                $old_password = $this->input->post('old_password');
                $new_password = $this->input->post('new_password');

                if (!password_verify($old_password, $admin['user_password'])) {
                    $this->session->set_flashdata('danger_alert', 'Wrong Old Password');
                    redirect('admin_profile');
                } else {
                    if ($old_password == $new_password) {
                        $this->session->set_flashdata('danger_alert', "New Password can't be the same as the old ones");
                        redirect('admin_profile');
                    } else {
                        // password sudah mantab
                        $data = [
                            'old_password' => $admin['user_password'],
                            'new_password' => password_hash($new_password, PASSWORD_DEFAULT),
                        ];

                        $response = $this->User->change_password($data, $id);
                        if ($response['code'] != 200) {
                            $this->session->set_flashdata('danger_alert', 'Change failed: ' . ' status code ' . $response['code'] . $response['message'] . " -> " . $response['error_detail']);
                            redirect('admin_profile');
                        } else {
                            $this->session->set_flashdata('success_alert', 'Pasword has been changed');
                            redirect('admin_profile');
                        }
                    }
                }
            }
        }
    }
}
