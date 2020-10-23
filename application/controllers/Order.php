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
        $this->load->model('Cart_model', 'Cart');
        // $this->load->model('Order_model', 'Order');
    }

    public function index()
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
                'title' => 'User - Cart',
                'category' => $this->Category->get_all_category(),
                'cart_products' => $this->Cart->get_cart_products($user['id']),
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('cart/index');
            $this->load->view('layout/footer');
        }
    }

    public function checkout()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $user = $this->User->get_user($email, 'email');
            $cart_items = unserialize(base64_decode($this->input->post('cart_items')));

            $this->form_validation->set_rules('name', 'Category Name', 'required|trim');
            $this->form_validation->set_rules('description', 'Category Description', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'user' => $user,
                    'title' => 'User - Cart',
                    'category' => $this->Category->get_all_category(),
                    'cart_items' => $cart_items,
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('order/checkout');
                $this->load->view('layout/footer');
            } else {
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'description' => htmlspecialchars($this->input->post('description', true)),
                ];

                $response = $this->Category->create_category($data);
                if ($response['code'] != 200) {
                    $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                    redirect('category');
                } else {
                    $this->session->set_flashdata('success_alert', 'Category has been added');
                    redirect('category');
                }
            }
        }
    }
}
