<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Category_model', 'Category');
        $this->load->model('Product_model', 'Product');
        $this->load->model('Order_model', 'Order');
        $this->load->model('Cart_model', 'Cart');
        $this->load->model('Address_model', 'Address');
    }

    public function order_list()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $user = $this->User->get_user($email, 'email');

            $data = [
                'user' => $user,
                'title' => 'Thriftporium - Order',
                'category' => $this->Category->get_all_category(),
                'cart_products' => $this->Cart->get_cart_products($user['id']),
                'orders' => $this->Order->get_order($user['id'], 'user'),
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('order/index');
            $this->load->view('layout/footer');
        }
    }

}
