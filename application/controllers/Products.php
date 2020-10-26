<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Category_model', 'Category');
        $this->load->model('Product_model', 'Product');
    }

    public function products($id = '')
    {
        // get all user information from the database
        $email = $this->session->userdata('user_email');
        $user = $this->User->get_user($email, 'email');

        $data = [
            'user' => $user,
            'title' => 'Thriftporium - Products',
            'category' => $this->Category->get_all_category(),
            'products' => $this->Product->get_all_product(),
        ];

        if ($id == '') {
            $this->load->view('layout/header', $data);
            $this->load->view('products/index');
            $this->load->view('layout/footer');
        } else {
            $this->_view_product($id, $data);
        }
    }

    private function _view_product($id, $data)
    {
        // get all user information from the database
        $email = $this->session->userdata('user_email');
        $user = $this->User->get_user($email, 'email');

        $data = [
            'user' => $user,
            'title' => 'Thriftporium - Product',
            'category' => $this->Category->get_all_category(),
            'product' => $this->Product->get_product((int) $id),
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('products/view_product');
        $this->load->view('layout/footer');
    }

    public function filter_category_product($category = '')
    {
        // get all user information from the database
        $email = $this->session->userdata('user_email');
        $user = $this->User->get_user($email, 'email');

        if ($category == '') {
            redirect('home');
        } else {
            // filter product
            $products = $this->Product->get_product_by_category($category);
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
                'title' => 'Thriftporium - Products - ' . $category,
                'category' => $this->Category->get_all_category(),
                'products' => $products_filtered,
            ];
            // var_dump($data);
            // die;
            $this->load->view('layout/header', $data);
            $this->load->view('products/index');
            $this->load->view('layout/footer');
        }
    }

    public function latest_products()
    {
        $email = $this->session->userdata('user_email');
        $user = $this->User->get_user($email, 'email');

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
            'title' => 'Thriftporium - Products - latest',
            'category' => $this->Category->get_all_category(),
            'products' => $products_filtered,
        ];
        // var_dump($data);
        // die;
        $this->load->view('layout/header', $data);
        $this->load->view('products/index');
        $this->load->view('layout/footer');
    }

    public function search_products()
    {
        $email = $this->session->userdata('user_email');
        $user = $this->User->get_user($email, 'email');

        // filter product
        $products = $this->Product->get_product($_GET['name'], 'name');
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
            'title' => 'Thriftporium - Products - search',
            'category' => $this->Category->get_all_category(),
            'products' => $products_filtered,
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('products/index');
        $this->load->view('layout/footer');
    }
}
