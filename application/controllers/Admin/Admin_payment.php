<?php

use phpDocumentor\Reflection\PseudoTypes\False_;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Payment_model', 'Payment');
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
                'title' => 'Admin - Payment',
                'payment_list' => $this->Payment->get_all_payment(),
            ];

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/payment/index');
            $this->load->view('layout/admin/footer.php');
        }
    }

    public function verify_payment()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            $payment_id = (int) htmlspecialchars($this->input->post('payment_id'), true);

            $response = $this->Payment->verify_payment($payment_id);
            if ($response['code'] != 200) {
                $this->session->set_flashdata('danger_alert', 'Upadate failed: ' . $response['code'] . " " . $response['message'] . $response['error_detail']);
                redirect('admin_payment');
            } else {
                $this->session->set_flashdata('success_alert', 'Payment verified!');
                redirect('admin_payment');
            }
        }
    }

    public function reject_receipt()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            $payment_id = (int) htmlspecialchars($this->input->post('payment_id'), true);
            $data['method'] = "REJECT";
            $old_image = $this->Payment->get_payment($payment_id)[0]['payment_receipt'];
            // var_dump($old_image);
            // die;

            if ($old_image !== NULL or $old_image !== '') {
                unlink(FCPATH . 'assets/img/payment-receipt/' . $old_image);
            }
            $response = $this->Payment->reject_receipt($data, $payment_id);
            // var_dump($response);
            // die;

            if ($response['code'] != 200) {
                $this->session->set_flashdata('danger_alert', 'Upadate failed: ' . $response['code'] . " " . $response['message'] . $response['error_detail']);
                redirect('admin_payment');
            } else {
                // remove old images from server
                // $old_image = $order['shipping_receipt_picture'];
                $this->session->set_flashdata('success_alert', 'Receipt Rejected');
                redirect('admin_payment');
            }
        }
    }

    public function cancel_payment()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            $payment_id = (int) htmlspecialchars($this->input->post('payment_id'), true);
            $response = $this->Payment->cancel_payment($payment_id);
            if ($response['code'] != 200) {
                $this->session->set_flashdata('danger_alert', 'Upadate failed: ' . $response['code'] . " " . $response['message'] . $response['error_detail']);
                redirect('admin_payment');
            } else {
                $this->session->set_flashdata('success_alert', 'Paymnet Canceled');
                redirect('admin_payment');
            }
        }
    }
}
