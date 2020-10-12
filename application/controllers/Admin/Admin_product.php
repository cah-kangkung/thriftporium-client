<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Product_model', 'Product');
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
                'title' => 'Admin - Product'
            ];

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/product/index');
            $this->load->view('layout/admin/footer.php');
        }
    }

    public function add_product()
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

            $this->form_validation->set_rules('name', 'Product Name', 'required|trim');
            $this->form_validation->set_rules('description', 'Product Description', 'required|trim');
            $this->form_validation->set_rules('price', 'Price', 'required|trim|integer');
            $this->form_validation->set_rules('stock', 'Stock', 'required|trim|integer');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'admin' => $admin,
                    'title' => 'Admin - Add Product',
                    'category' => $this->Product->get_all_category()
                ];

                $this->load->view('layout/admin/header.php', $data);
                $this->load->view('layout/admin/sidebar.php');
                $this->load->view('layout/admin/topbar.php');
                $this->load->view('admin/product/add_product');
                $this->load->view('layout/admin/footer.php');
            } else {
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'description' => htmlspecialchars($this->input->post('description', true)),
                    'stock' => (int) htmlspecialchars($this->input->post('stock', true)),
                    'category_id' => (int) htmlspecialchars($this->input->post('category_id', true)),
                    'price' => (int) htmlspecialchars($this->input->post('price', true)),
                ];

                // setting config for file uploading
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = 2058;
                $config['encrypt_name']     = true;
                $config['upload_path']      = FCPATH . 'assets/img/product/';

                $this->load->library('upload', $config);

                $product_pictures = array(); // for inserting to db
                $total_image = count($_FILES['pictures']['name']);
                for ($i = 0; $i <= $total_image; $i++) {

                    if (!empty($_FILES['pictures']['name'][$i])) {

                        $_FILES['file']['name'] = $_FILES['pictures']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['pictures']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['pictures']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['pictures']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['pictures']['size'][$i];

                        if ($this->upload->do_upload('file'))
                            array_push($product_pictures, $_FILES['file']['name']);
                        else {
                            $this->upload->display_errors();
                        }
                    }
                }

                if ($product_pictures == "") {
                    $product_pictures = 'default-picture.jpg';
                }
                $data['pictures'] = $product_pictures;

                $result = $this->Product->create_product($data);
                if ($result['code'] != 200) {
                    var_dump($result);
                    die;
                }

                $this->session->set_flashdata('success_alert', 'Product has been added');
                redirect('admin_product');
            }
        }
    }
}
