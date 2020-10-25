<?php

use phpDocumentor\Reflection\PseudoTypes\False_;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Order_model', 'Order');
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
                'title' => 'Admin - Order',
                'order_list' => $this->Order->get_all_order(),
            ];

            $this->load->view('layout/admin/header.php', $data);
            $this->load->view('layout/admin/sidebar.php');
            $this->load->view('layout/admin/topbar.php');
            $this->load->view('admin/order/index');
            $this->load->view('layout/admin/footer.php');
        }
    }

    public function upload_resi()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {

            $shipping_id = (int) htmlspecialchars($this->input->post('shipping_id', true));
            $order_id = (int) htmlspecialchars($this->input->post('order_id', true));
            $order = $this->Order->get_order($order_id, 'id');

            // checking if there is a picture to be uploaded
            $check_upload = $_FILES['image']['name'];
            if ($check_upload) {
                // setting config for file uploading
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = 2058;
                $config['encrypt_name']     = TRUE;
                $config['upload_path']      = FCPATH . 'assets/img/resi';
                $config['multi']      = 'all';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $uploaded_image = $this->upload->data();
                    $file_name = $uploaded_image['file_name'];
                    $data['receipt_picture'] = $file_name;

                    // remove old images from server
                    $old_image = $order['shipping_receipt_picture'];

                    if ($old_image != NULL) {
                        unlink(FCPATH . 'assets/img/resi/' . $old_image);
                    }
                } else {
                    $error = $this->upload->display_errors('', '');
                    $this->session->set_flashdata('danger_alert', 'Upload failed: ' . $error);
                    redirect('payment');
                }
            } else {
                $this->session->set_flashdata('danger_alert', 'Upload Failed');
                redirect('admin_order');
            }

            $data['receipt_number'] = $this->input->post('shipping_receipt');

            $response = $this->Order->upload_resi($data, $shipping_id);
            if ($response['code'] != 200) {
                $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                redirect('admin_order');
            } else {
                $this->session->set_flashdata('success_alert', 'Resi has been uploaded');
                redirect('admin_order');
            }
        }
    }

    public function order_finished($shipping_id)
    {
        $response = $this->Order->order_finished($shipping_id);
        if ($response['code'] != 200) {
            $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
            redirect('admin_order');
        } else {
            $this->session->set_flashdata('success_alert', 'Order has been finished');
            redirect('admin_order');
        }
    }
}
