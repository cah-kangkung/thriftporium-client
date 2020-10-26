<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Category_model', 'Category');
        $this->load->model('Product_model', 'Product');
        $this->load->model('Payment_model', 'Payment');
        $this->load->model('Cart_model', 'Cart');
        $this->load->model('Address_model', 'Address');
        $this->load->model('Paymentmethod_model', 'Method');
    }

    public function payment_list()
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
                'title' => 'Thriftporium - Payment',
                'category' => $this->Category->get_all_category(),
                'cart_products' => $this->Cart->get_cart_products($user['id']),
                'payment_list' => $this->Payment->get_payment($user['id'], 'user'),
                'payment_method' => $this->Method->get_all_method()
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('payment/index');
            $this->load->view('layout/footer');
        }
    }

    public function change_bank_info()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            $this->form_validation->set_rules('account_bank', 'Bank Name', 'required|trim');
            $this->form_validation->set_rules('account_name', 'Account Name', 'required|trim');
            $this->form_validation->set_rules('account_number', 'Account Number', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                // get all user information from the database
                $email = $this->session->userdata('user_email');
                $user = $this->User->get_user($email, 'email');

                $data = [
                    'user' => $user,
                    'title' => 'Thriftporium - Payment',
                    'category' => $this->Category->get_all_category(),
                    'cart_products' => $this->Cart->get_cart_products($user['id']),
                    'payment_list' => $this->Payment->get_payment($user['id'], 'user')
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('payment/index');
                $this->load->view('layout/footer');
            } else {
                $data = [
                    'account_bank' => htmlspecialchars($this->input->post('account_bank', true)),
                    'account_name' => htmlspecialchars($this->input->post('account_name', true)),
                    'account_number' => htmlspecialchars($this->input->post('account_number', true)),
                ];

                $payment_id = (int) htmlspecialchars($this->input->post('payment_id', true));

                $response = $this->Payment->edit_bank_info($data, $payment_id);
                if ($response['code'] != 200) {
                    $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                    redirect('payment');
                } else {
                    $this->session->set_flashdata('success_alert', 'Bank Info has been updated');
                    redirect('payment');
                }
            }
        }
    }

    public function upload_proof()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {

            $payment_id = (int) htmlspecialchars($this->input->post('payment_id', true));
            $payment = $this->Payment->get_payment($payment_id, 'id')[0];

            // checking if there is a picture to be uploaded
            $check_upload = $_FILES['image']['name'];
            if ($check_upload) {
                // setting config for file uploading
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = 2058;
                $config['encrypt_name']     = TRUE;
                $config['upload_path']      = FCPATH . 'assets/img/payment-receipt';
                $config['multi']      = 'all';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $uploaded_image = $this->upload->data();
                    $file_name = $uploaded_image['file_name'];
                    $data['receipt'] = $file_name;

                    // remove old images from server
                    $old_image = $payment['payment_receipt'];

                    if ($old_image != NULL) {
                        unlink(FCPATH . 'assets/img/payment-receipt/' . $old_image);
                    }
                } else {
                    $error = $this->upload->display_errors('', '');
                    $this->session->set_flashdata('danger_alert', 'Upload failed: ' . $error);
                    redirect('payment');
                }
            } else {
                redirect('payment');
            }

            $data['method'] = 'UPLOAD';

            $response = $this->Payment->upload_proof($data, $payment_id);
            if ($response['code'] != 200) {
                $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                redirect('payment');
            } else {
                $this->session->set_flashdata('success_alert', 'Payment proof has been uploaded');
                redirect('payment');
            }
        }
    }

    public function canceled($payment_id)
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            // var_dump($payment_id);
            // die;
            $response = $this->Payment->cancel_payment($payment_id);
            if ($response['code'] != 200) {
                $this->session->set_flashdata('danger_alert', 'Upadate failed: ' . $response['code'] . " " . $response['message'] . $response['error_detail']);
                redirect('payment');
            } else {
                $this->session->set_flashdata('success_alert', 'Payment Canceled!');
                redirect('payment');
            }
        }
    }

    public function change_transferto()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            $data = [
                'payment_id' => (int) htmlspecialchars($this->input->post('payment_id'), true),
                'transfer_to' => (int)htmlspecialchars($this->input->post('transfer_to'), true)
            ];
            // var_dump($data);
            // die;
            $response = $this->Payment->change_transferto($data);
            // var_dump($response);
            // die;
            if ($response['code'] != 200) {
                $response_message = '';
                if ($response['message'] == null && $response['error_detail'] == null) {
                    $response_message = 'Data not changed';
                } else {
                    $response_message = 'Upadate failed: ' . $response['code'] . ' ' . $response['message'] . $response['error_detail'];
                }
                $this->session->set_flashdata('danger_alert', $response_message);
                redirect('payment');
            } else {
                $this->session->set_flashdata('success_alert', 'Payment method changed');
                redirect('payment');
            }
        }
    }
}
