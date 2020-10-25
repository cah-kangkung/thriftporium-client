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
        $this->load->model('Address_model', 'Address');
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

            for ($i = 0; $i < count($cart_items); $i++) {
                if ($cart_items[$i]['product_availability'] == 0) {
                    $this->session->set_flashdata('danger_alert', $cart_items[$i]['product_name'] . ' is out of stock!');
                    redirect('cart');
                }
            }

            $this->form_validation->set_rules('transfer_to', 'Transfer Destinatio', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'user' => $user,
                    'title' => 'Thriftpotium | Checkout',
                    'category' => $this->Category->get_all_category(),
                    'cities' => $this->Address->get_cities(),
                    'cart_items' => $cart_items,
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('order/checkout');
                $this->load->view('layout/footer');
            } else {

                var_dump($this->input->post());
                die;

                $response = $this->Category->create_category($data);
                if ($response['code'] != 200) {
                    $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                    redirect('cart');
                } else {
                    $this->session->set_flashdata('success_alert', 'Category has been added');
                    redirect('cart');
                }
            }
        }
    }

    public function get_shipping_cost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 20f8af10d260b3769767e26665282c8d"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
