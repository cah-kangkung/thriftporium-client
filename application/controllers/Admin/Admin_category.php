<?php

use phpDocumentor\Reflection\PseudoTypes\False_;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_category extends CI_Controller
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
                'title' => 'Admin - Category',
                'category_list' => $this->Category->get_all_category(),
            ];

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/category/index');
            $this->load->view('layout/admin/footer.php');
        }
    }

    public function add_category()
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

            $this->form_validation->set_rules('name', 'Category Name', 'required|trim');
            $this->form_validation->set_rules('description', 'Category Description', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'admin' => $admin,
                    'title' => 'Admin - Add Category',
                ];

                $this->load->view('layout/admin/header.php', $data);
                $this->load->view('layout/admin/sidebar.php');
                $this->load->view('layout/admin/topbar.php');
                $this->load->view('admin/category/add_category');
                $this->load->view('layout/admin/footer.php');
            } else {
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'description' => htmlspecialchars($this->input->post('description', true)),
                ];

                $response = $this->Category->create_category($data);
                if ($response['code'] != 200) {
                    $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message']);
                    redirect('category');
                } else {
                    $this->session->set_flashdata('success_alert', 'Category has been added');
                    redirect('category');
                }
            }
        }
    }

    public function edit_category($id)
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

            $this->form_validation->set_rules('name', 'Category Name', 'required|trim');
            $this->form_validation->set_rules('description', 'Category Description', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'admin' => $admin,
                    'title' => 'Admin - Edit Category',
                    'category' => $this->Category->get_category($id),
                ];

                $this->load->view('layout/admin/header.php', $data);
                $this->load->view('layout/admin/sidebar.php');
                $this->load->view('layout/admin/topbar.php');
                $this->load->view('admin/category/edit_category');
                $this->load->view('layout/admin/footer.php');
            } else {
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'description' => htmlspecialchars($this->input->post('description', true)),
                ];

                $response = $this->Category->edit_category($data, $id);
                if ($response['code'] != 200) {
                    $this->session->set_flashdata('danger_alert', 'Upadate failed: ' . $response['code'] . " " . $response['message']);
                    redirect('category/edit_category/' . $id);
                } else {
                    $this->session->set_flashdata('success_alert', 'Category has been updated');
                    redirect('category/edit_category/' . $id);
                }
            }
        }
    }

    public function delete_category($id)
    {
        $response = $this->Category->delete_category($id);
        if ($response['code'] != 200) {
            $this->session->set_flashdata('danger_alert', 'Delete failed: ' . $response['message'] . '->' . $response['error_detail']);
            redirect('category');
        } else {
            $this->session->set_flashdata('success_alert', 'Category has been deleted');
            redirect('category');
        }
    }
}
