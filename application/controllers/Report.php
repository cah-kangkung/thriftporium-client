<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Order_model', 'Order');
        $this->load->model('Payment_model', 'Payment');
    }

    public function invoice($id)
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            // get user data
            $email = $this->session->userdata('user_email');

            $data = [
                "title" => "Thriftporium - Invoice",
                "payment" => $this->Payment->get_payment($id)[0],
                "user" => $this->User->get_user($email, 'email')
            ];

            $payment_created = new DateTime($data["payment"]["payment_created"]);
            $payment_expired = new DateTime($data["payment"]["payment_expired"]);

            $data["payment"]["payment_created"] = $payment_created->format('H:i:s d-m-Y');
            $data["payment"]["payment_expired"] = $payment_expired->format('H:i:s d-m-Y');
            $data["order"] = $this->Order->get_order($data['payment']['order_id'])[0];
            $data["products"] = $data["order"]["products"];
            $data["courier"] = $this->Courier->get_courier($data["order"]['shipping_courier']);
            // var_dump($data);
            // die;

            $options = new Options();
            $options->set('isRemoteEnabled', TRUE);

            $dompdf = new Dompdf($options);

            $html = $this->load->view('order/invoice_pdf', $data, TRUE);

            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'potrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream('output', array("Attachment" => false));
        }
    }

    public function shippment_information($order_id)
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            // get user data
            $email = $this->session->userdata('user_email');

            $data = [
                "title" => "Thriftporium - Shippment Information",
                "payment" => $this->Order->get_order($order_id)[0],
                "user" => $this->User->get_user($email, 'email')
            ];

            $payment_created = new DateTime($data["payment"]["payment_created"]);
            $payment_expired = new DateTime($data["payment"]["payment_expired"]);

            $data["payment"]["payment_created"] = $payment_created->format('H:i:s d-m-Y');
            $data["payment"]["payment_expired"] = $payment_expired->format('H:i:s d-m-Y');
            $data["order"] = $this->Order->get_order($data['payment']['order_id'])[0];
            $data["products"] = $data["order"]["products"];
            $data["courier"] = $this->Courier->get_courier($data["order"]['shipping_courier']);
            // var_dump($data);
            // die;

            $options = new Options();
            $options->set('isRemoteEnabled', TRUE);

            $dompdf = new Dompdf($options);

            $html = $this->load->view('order/invoice_pdf', $data, TRUE);

            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'potrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream('output', array("Attachment" => false));
        }
    }
}
