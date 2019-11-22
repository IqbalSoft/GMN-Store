<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Member_model', 'member');
    is_logged_in();
  }

  public function index()
  {
    // query table user from session;
    $id = $this->session->id_user;
    $data['user']     = $this->member->getOnePerson($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota']     = $this->member->getKota($id);

    $this->load->view('templates/header');
    $this->load->view('m-page/my_profile', $data);
    $this->load->view('templates/footer');
  }

  public function profileAdmin()
  {
    // query table user from session;
    $id = $this->session->id_user;
    $data['user']     = $this->member->getStaff($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota']     = $this->member->getKota($id);

    $this->load->view('templates/header');
    $this->load->view('a-page/my_profile', $data);
    $this->load->view('templates/footer');
  }

  public function edit()
  {
    $id = $this->session->id_user;
    $data['user'] = $this->member->getOnePerson($id);

    $this->form_validation->set_rules('fullname', 'Name', 'required|trim');
    $this->form_validation->set_rules('province_id', 'Province', 'required|trim');
    $this->form_validation->set_rules('city_id', 'City', 'required|trim');
    $this->form_validation->set_rules('post_code', 'Post Code', 'required|trim|numeric');
    $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|numeric');
    $this->form_validation->set_rules('address', 'Address', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('m-page/edit_profile', $data);
      $this->load->view('templates/footer');
    } else {
      $this->member->editUser($id, $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Success edit user !</strong>
      </div>');
      redirect('member');
    }
  }

  public function edit_alamat($id_user)
  {
    $this->member->editAlamat($id_user);
    $id = $this->input->post('id_barang');
    redirect('shop/buy/' . $id);
  }
}
