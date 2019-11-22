<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Member_model', 'member');
  }

  public function index()
  {
    $email = $this->session->email;
    $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

    $this->load->view('templates/header');
    if (!$this->session->userdata('email')) {
      $this->load->view('templates/nav-bl');
    } else {
      $this->load->view('templates/nav-sl', $data);
    }
    $this->load->view('index');
    $this->load->view('templates/content-footer.php');
    $this->load->view('templates/footer');
  }

  public function about()
  {
    $email = $this->session->email;
    $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

    $this->load->view('templates/header');
    if (!$this->session->userdata('email')) {
      $this->load->view('templates/nav-bl');
    } else {
      $this->load->view('templates/nav-sl', $data);
    }

    $this->load->view('templates/header');
    $this->load->view('m-page/about');
    $this->load->view('templates/footer');
  }

  public function contact()
  {
    $email = $this->session->email;
    $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

    $this->load->view('templates/header');
    if (!$this->session->userdata('email')) {
      $this->load->view('templates/nav-bl');
    } else {
      $this->load->view('templates/nav-sl', $data);
    }

    $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[10]|max_length[40]');
    $this->form_validation->set_rules('email', 'Email', 'required|trim');
    $this->form_validation->set_rules('message', 'Message', 'required|trim|max_length[100]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('m-page/contact', $data);
      $this->load->view('templates/footer');
    } else {
      $this->member->message();
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Message successfull to send!</strong>
      </div>');
      redirect('content/contact');
    }
  }
}
