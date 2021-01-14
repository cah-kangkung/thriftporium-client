<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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

            // get all verified payment list
            $payment_list = $this->Payment->get_payment('verified', 'status');

            $payment_dates = array();
            $payment_prices = array();
            foreach ($payment_list as $p) {
                array_push($payment_dates, $this->date_to_month(explode(" ", $p['payment_created'])[0]));
                array_push($payment_prices, $p['total_price']);
            }

            $payment_methods = [0, 0];
            foreach ($payment_list as $p) {
                if ($p['payment_accounttype'] == 'TRANSFER') {
                    $payment_methods[0]++;
                } elseif ($p['payment_accounttype'] == 'FINTECH') {
                    $payment_methods[1]++;
                }
            }

            $data = [
                'admin' => $admin,
                'title' => 'Admin - Dashboard',
                'payment_dates' => array_reverse($payment_dates),
                'payment_prices' => array_reverse($payment_prices),
                'payment_methods' => $payment_methods,
                'total_payments' => count($payment_list)
            ];

            $total_income = 0;
            if ($payment_list) {
                for ($i = 0; $i < count($payment_list); $i++) {
                    $total_income += $payment_list[$i]['total_price'];
                }
                $data['total_income'] = $total_income;
            } else {
                $data['total_income'] = $total_income;
            }

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/dashboard/index');
            $this->load->view('layout/admin/footer.php');
            $this->load->view('admin/dashboard/plugins');
        }
    }

    public function date_to_month($date)
    {
        $month = explode("-", $date)[1];
        $day = explode("-", $date)[2];
        $result = '';
        if ($month == '01') {
            $result = $day . ' January';
        } elseif ($month == '02') {
            $result = $day . ' February';
        } elseif ($month == '03') {
            $result = $day . ' March';
        } elseif ($month == '04') {
            $result = $day . ' April';
        } elseif ($month == '05') {
            $result = $day . ' May';
        } elseif ($month == '06') {
            $result = $day . ' June';
        } elseif ($month == '07') {
            $result = $day . ' July';
        } elseif ($month == '08') {
            $result = $day . ' August';
        } elseif ($month == '09') {
            $result = $day . ' September';
        } elseif ($month == '10') {
            $result = $day . ' October';
        } elseif ($month == '11') {
            $result = $day . ' November';
        } elseif ($month == '12') {
            $result = $day . ' December';
        }
        return $result;
    }
}
