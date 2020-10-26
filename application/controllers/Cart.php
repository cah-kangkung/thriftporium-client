<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Category_model', 'Category');
        $this->load->model('Product_model', 'Product');
        $this->load->model('Cart_model', 'Cart');
    }

    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success_alert', 'You must login before!');
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

    public function add_to_cart()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            $user_id = htmlspecialchars($this->input->post('user_id', true));

            $product_status = (int) htmlspecialchars($this->input->post('product_status', true));
            if ($$product_status != 1) {
                $this->session->set_flashdata('danger_alert', 'Item is not published!');
                redirect('cart');
            }

            $qty = (int) htmlspecialchars($this->input->post('quantity', true));
            if ($qty < 1) {
                $this->session->set_flashdata('danger_alert', 'Item out of stock!');
                redirect('cart');
            }

            $data = [
                'product' => (int) htmlspecialchars($this->input->post('product_id', true)),
                'qty' => $qty,
            ];

            $response = $this->Cart->add_to_cart($data, $user_id);
            if ($response['code'] != 200) {
                // echo 'failed' . $response['message'];
                $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . ' ' . $response['error_detail']);
                redirect('cart');
            } else {
                // echo 'success';
                $this->session->set_flashdata('success_alert', 'Item has been added to cart');
                redirect('cart');
            }
        }
    }

    public function delete_cart_item($user_id, $product_id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            $response = $this->Cart->delete_cart_item($user_id, $product_id);
            if ($response['code'] != 200) {
                // echo 'failed' . $response['message'];
                $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                redirect('cart');
            } else {
                // echo 'success';
                $this->session->set_flashdata('success_alert', 'Item has been deleted');
                redirect('cart');
            }
        }
    }

    public function edit_cart_item($user_id, $product_id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            $qty = $this->input->post('quantity');
            $data = [
                'product' => (int) $product_id,
                'qty' => (int) $qty,
            ];
            $response = $this->Cart->edit_cart_item($data, $user_id);
            if ($response['code'] != 200) {
                // echo 'failed' . $response['message'];
                $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                redirect('cart');
            } else {
                // echo 'success';
                $this->session->set_flashdata('success_alert', 'Item has been edited');
                redirect('cart');
            }
        }
    }
}
