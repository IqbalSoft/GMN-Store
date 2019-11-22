<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Vendor_model', 'vendor');

    is_logged_in();
  }

  public function index()
  {
    // search
    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $this->session->set_userdata('keyword', '');
      $data['keyword'] = $this->session->userdata('keyword');
    }

    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "vendor/index";
    $config['total_rows'] = $this->vendor->countVendor();
    $config['per_page'] = 7;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['vendor_list'] = $this->vendor->getVendor($config['per_page'], $data['start'], $data['keyword']);
    $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();

    if ($this->input->post('keyword')) {
      $data['vendor_list'] = $this->vendor->search();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPembelian', $data);
    $this->load->view('vendor/index', $data);
    $this->load->view('templates/footer');
  }

  public function addVendor()
  {
    $this->vendor->addVendor();
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Success add new vendor.</strong>
    </div>');
    redirect('vendor');
  }

  public function editVendor($id)
  {
    $data['edit'] = $this->db->get_where('vendor', ['id_vendor' => $id])->row_array();

    $this->form_validation->set_rules('vendor_name', 'Vendor name', 'required|trim|min_length[3]|max_length[60]');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('phone_number', 'Phone number', 'required|trim');
    $this->form_validation->set_rules('address', 'Address', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('vendor/edit_vendor', $data);
      $this->load->view('templates/footer');
    } else {
      $this->vendor->editVendor($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Vendor success edited!
      </div>');
      redirect('vendor');
    }
  }

  public function deleteVendor($id)
  {
    $this->db->delete('vendor', ['id_vendor' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Vendor success delected!
    </div>');
    redirect('vendor');
  }

  public function detailVendor($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['detail'] = $this->db->get_where('vendor', ['id_vendor' => $id])->row_array();
    $this->load->view('templates/header');
    $this->load->view('vendor/detail_vendor', $data);
    $this->load->view('templates/footer');
  }
}
