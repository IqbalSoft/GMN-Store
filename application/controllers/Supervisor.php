<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supervisor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Supervisor_model', 'sm');
    $this->load->model('Member_model', 'member');
    is_logged_in();
  }

  public function index()
  {
    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "supervisor/index";
    $config['total_rows'] = $this->sm->countData();
    $config['per_page'] = 9;
    $config['num_links'] = 5;

    // costum style
    $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm mt-3">';
    $config['close_tag_open'] = '</ul></nav>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = ['class' => 'page-link'];

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['message'] = $this->sm->getInbox($config['per_page'], $data['start']);

    // keyword
    if ($this->input->post('keyword')) {
      $data['message'] = $this->sm->searchMessage();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-supervisor', $data);
    $this->load->view('a-page/supervisor/index', $data);
    $this->load->view('templates/footer');
  }

  public function readMessage($id)
  {
    $data['detailMessage'] = $this->sm->getDInbox($id);

    $this->load->view('templates/header');
    $this->load->view('a-page/supervisor/detail_message', $data);
    $this->load->view('templates/footer');
  }

  public function deleteMessage($id)
  {
    $this->sm->deleteInbox($id);
    redirect('supervisor');
  }

  public function user()
  {
    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "supervisor/user";
    $config['total_rows'] = $this->sm->countUser();
    $config['per_page'] = 7;
    $config['num_links'] = 5;

    // costum style
    $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm mt-3">';
    $config['close_tag_open'] = '</ul></nav>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = ['class' => 'page-link'];

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['d_user'] = $this->sm->getUser($config['per_page'], $data['start']);

    if ($this->input->post('keyword')) {
      $data['d_user'] = $this->sm->searchUser();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-supervisor', $data);
    $this->load->view('a-page/supervisor/user', $data);
    $this->load->view('templates/footer');
  }

  public function detailUser($id)
  {
    $data['d_user'] = $this->sm->detail_user($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota'] = $this->member->getKota($id);

    $this->load->view('templates/header');
    $this->load->view('a-page/supervisor/detail_user', $data);
    $this->load->view('templates/footer');
  }
}
