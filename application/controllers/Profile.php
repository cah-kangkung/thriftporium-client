<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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

    public function edit_profile($id)
    {

        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('success', 'You must login before!');
            redirect('auth');
        } else {
            // get all user information from the database
            $user = $this->User->get_user($id);
            $cities = $this->Address->get_cities();

            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
            $this->form_validation->set_rules('address', 'Address', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'user' => $user,
                    'title' => 'Thriftporium - Edit Profile',
                    'category' => $this->Category->get_all_category(),
                    'cart_products' => $this->Cart->get_cart_products($user['id']),
                    'cities' => $cities,
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('profile/edit_profile');
                $this->load->view('layout/footer');
            } else {
                $city = htmlspecialchars($this->input->post('city', true));
                $city = explode(', ', $city);

                $city_id = 0;
                for ($i = 0; $i < count($cities); $i++) {
                    if ($cities[$i]['city_name'] == $city[1]) {
                        $city_id = $cities[$i]['id'];
                    }
                }

                $data = [
                    'first_name' => htmlspecialchars($this->input->post('first_name', true)),
                    'last_name' => htmlspecialchars($this->input->post('last_name', true)),
                    'gender' => htmlspecialchars($this->input->post('gender', true)),
                    'phone' => htmlspecialchars($this->input->post('phone', true)),
                    'address' => htmlspecialchars($this->input->post('address', true)),
                    'city' => $city_id,
                    'zipcode' => htmlspecialchars($this->input->post('zipcode', true)),
                ];

                // checking if there is a picture to be uploaded
                $check_upload = $_FILES['image']['name'];
                if ($check_upload) {
                    // setting config for file uploading
                    $config['allowed_types']    = 'jpg|png|jpeg';
                    $config['max_size']         = 2058;
                    $config['encrypt_name']     = TRUE;
                    $config['upload_path']      = FCPATH . 'assets/img/profile-pictures';
                    $config['multi']      = 'all';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $uploaded_image = $this->upload->data();
                        $file_name = $uploaded_image['file_name'];
                        $data['image'] = $file_name;

                        // remove old images from server
                        $old_image = $user['user_image'];
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile-pictures/' . $old_image);
                        }
                    } else {
                        $error = $this->upload->display_errors('', '');
                        $this->session->set_flashdata('danger_alert', 'Upload failed: ' . $error);
                        redirect('profile/edit/' . $user['id']);
                    }
                } else {
                    $data['image'] = $user['user_image'];
                }

                $response = $this->User->update_user($data, $id);
                if ($response['code'] != 200) {
                    $this->session->set_flashdata('danger_alert', 'Operation failed: ' . $response['message'] . $response['error_detail']);
                    redirect('profile/edit/' . $id);
                } else {
                    $this->session->set_flashdata('success_alert', 'User has been updated');
                    redirect('profile/edit/' . $id);
                }
            }
        }
    }
}
