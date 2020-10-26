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
        $this->load->model('Product_model', 'Product');
    }

    public function index()
    {
        // get all user information from the database
        $email = $this->session->userdata('user_email');
        $user = $this->User->get_user($email, 'email');
        if ($user['role_id'] !== 2001) {
            redirect('admin_dashboard');
        }

        // filter product
        $products = $this->Product->get_product_by_time();
        $products_filtered = array();
        if ($products) {
            foreach ($products as $product) {
                if ($product['product_status'] == 1) {
                    array_push($products_filtered, $product);
                }
            }
        } else {
            $products_filtered = $products;
        }

        $data = [
            'user' => $user,
            'title' => 'Thriftporium - Home',
            'category' => $this->Category->get_all_category(),
            'products' => $products_filtered,
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }
}
