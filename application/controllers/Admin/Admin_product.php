<?php

use phpDocumentor\Reflection\PseudoTypes\False_;

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
                'title' => 'Admin - Product',
                'products' => $this->Product->get_all_product(),
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

            $this->form_validation->set_rules('images[]', 'Product Images', 'callback_validate_images');
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
                $config['encrypt_name']     = TRUE;
                $config['upload_path']      = FCPATH . 'upload/product-images';
                $config['multi']      = 'all';

                $this->load->library('upload', $config);

                // $product_images = array(); // for inserting to db
                // $total_images = ($_FILES['images']['name'][0] == "") ? 0 : count($_FILES['images']['name']);
                // for ($i = 0; $i < $total_images; $i++) {

                //     if (!empty($_FILES['images']['name'][$i])) {

                //         $_FILES['file']['name'] = $_FILES['images']['name'][$i];
                //         $_FILES['file']['type'] = $_FILES['images']['type'][$i];
                //         $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                //         $_FILES['file']['error'] = $_FILES['images']['error'][$i];
                //         $_FILES['file']['size'] = $_FILES['images']['size'][$i];

                //         if ($this->upload->do_upload('file')) {
                //             $file_name = $this->upload->data('file_name');
                //             array_push($product_images, $file_name);
                //         } else {
                //             $this->session->set_flashdata('danger_alert', 'Upload failed: ' . $this->upload->display_errors());
                //             redirect('admin_product');
                //         }
                //     }
                // }

                $product_images = array(); // for inserting to db
                if ($this->upload->do_upload('images')) {
                    $uploaded_products = $this->upload->data();
                    $total_file = count($uploaded_products);
                    for ($i = 0; $i < $total_file; $i++) {
                        $file_name = $uploaded_products[$i]['file_name'];
                        array_push($product_images, $file_name);
                    }
                } else {
                    $error = $this->upload->display_errors('', '');
                    $this->session->set_flashdata('danger_alert', 'Upload failed: ' . $error);
                    redirect('admin_product');
                }

                $data['pictures'] = $product_images;

                $response = $this->Product->create_product($data);
                if ($response['code'] != 200) {
                    $this->session->set_flashdata('danger_alert', 'Upload failed: ' . $response['message']);
                    redirect('admin_product');
                } else {
                    $this->session->set_flashdata('success_alert', 'Product has been added');
                    redirect('admin_product');
                }
            }
        }
    }

    public function validate_images()
    {
        $total_images = ($_FILES['images']['name'][0] == "") ? 0 : count($_FILES['images']['name']);

        if ($total_images < 2) {
            $this->form_validation->set_message('validate_images', 'You must upload atleast 2 image');
            return FALSE;
        } elseif ($total_images > 5) {
            $this->form_validation->set_message('validate_images', 'You can only upload up to 5 images.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_product($id)
    {
        $response = $this->Product->delete_product($id);
        if ($response['code'] != 200) {
            $this->session->set_flashdata('danger_alert', 'Delete failed: ' . $response['message']);
            redirect('admin_product');
        } else {
            $this->session->set_flashdata('success_alert', 'Product has been deleted');
            redirect('admin_product');
        }
    }
}
