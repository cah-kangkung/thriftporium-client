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
        $this->load->model('Paymentmethod_model', 'Method');
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

            $this->form_validation->set_rules('shipping_receiver', "Receveir's Name", 'required|trim');
            $this->form_validation->set_rules('shipping_phone', "Receveir's phone", 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('street', 'Street', 'required|trim');
            $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|trim');
            $this->form_validation->set_rules('account_bank', 'Account Bank', 'required|trim');
            $this->form_validation->set_rules('account_name', 'Account Name', 'required|trim');
            $this->form_validation->set_rules('account_number', 'Account Number', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'user' => $user,
                    'title' => 'Thriftpotium | Checkout',
                    'category' => $this->Category->get_all_category(),
                    'cities' => $this->Address->get_cities(),
                    'cart_items' => $cart_items,
                    'payment_method' => $this->Method->get_all_method()
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('order/checkout');
                $this->load->view('layout/footer');
            } else {

                // cleaning up input
                $city_s = htmlspecialchars($this->input->post('city', true));
                $city_s = explode(', ', $city_s);
                $city = $this->Address->get_city($city_s[1], 'c_name');

                $products = array();
                foreach ($cart_items as $cart_item) {
                    array_push($products, [
                        'product_id' => $cart_item['product_id'],
                        'qty' => $cart_item['qty']
                    ]);
                }

                $s_cour = htmlspecialchars($this->input->post('shipping_courier', true));
                $shipping_courier = $this->Address->get_courier($s_cour, 'name');

                $data = [
                    'user' => $user['id'],
                    'street' => htmlspecialchars($this->input->post('street', true)),
                    'city' => $city['id'],
                    'zipcode' => htmlspecialchars($this->input->post('zipcode', true)),
                    'shipping_receiver' => htmlspecialchars($this->input->post('shipping_receiver', true)),
                    'shipping_phone' => htmlspecialchars($this->input->post('shipping_phone', true)),
                    'shipping_courier' => $shipping_courier['id'],
                    'shipping_price' => (int) htmlspecialchars($this->input->post('shipping_price', true)),
                    'products' => $products,
                    'transfer_to' => (int) htmlspecialchars($this->input->post('transfer_to', true)),
                    'total_price' => (int) htmlspecialchars($this->input->post('total_price', true)),
                    'account_bank' => htmlspecialchars($this->input->post('account_bank', true)),
                    'account_name' => htmlspecialchars($this->input->post('account_name', true)),
                    'account_number' => htmlspecialchars($this->input->post('account_number', true)),
                ];

                $response = $this->Order->create_order($data);
                if ($response['code'] != 200) {
                    // $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                    redirect('payment/payment_list');
                } else {
                    $this->session->set_flashdata('success_alert', 'Order created');
                    redirect('payment/payment_list');
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
