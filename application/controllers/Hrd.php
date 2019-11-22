<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hrd extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Hrd_model', 'hrd');
    $this->load->model('Member_model', 'member');
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
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "hrd/index";
    $this->load->library('pagination');

    // config
    $this->db->like('fullname', $data['keyword']);
    $this->db->from('user');
    $this->db->where_not_in('role_id', '5');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_data'] = $config['total_rows'];
    $config['per_page'] = 6;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['pegawai'] = $this->hrd->getDataPegawai($config['per_page'], $data['start'], $data['keyword']);

    $this->load->view('templates/header');
    $this->load->view('templates/nav-hrd', $data);
    $this->load->view('a-page/hrd/index', $data);
    $this->load->view('templates/footer');
  }

  public function activate($id)
  {
    $this->db->set('active_staff', '1');
    $this->db->where('id_user', $id);
    $this->db->update('user');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Staff has been activate!</strong></div>');
    redirect('hrd');
  }

  public function deactivate($id)
  {
    $this->db->set('active_staff', '0');
    $this->db->where('id_user', $id);
    $this->db->update('user');

    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Staff has been deactivate!</strong></div>');
    redirect('hrd');
  }

  public function detailPegawai($id)
  {
    $data['user'] = $this->hrd->getDetailPegawai($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota'] = $this->member->getKota($id);
    $this->load->view('templates/header');
    $this->load->view('a-page/hrd/detail_pegawai', $data);
    $this->load->view('templates/footer');
  }

  public function addNewStaff()
  {
    $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[30]|trim');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[30]|trim');
    $this->form_validation->set_rules('postal_code', 'Postal Code', 'required|min_length[5]|max_length[5]|numeric|trim');
    $this->form_validation->set_rules('address', 'Address', 'required|min_length[10]|max_length[100]|trim');
    $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|min_length[12]|max_length[13]|numeric|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
      'matches' => 'Password dont match',
      'min_length' => 'Password too short'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['position']  = $this->hrd->role();
      $data['warehouse'] = $this->hrd->warehouse();

      $this->load->view('templates/header');
      $this->load->view('a-page/hrd/addNewStaff', $data);
      $this->load->view('templates/footer');
    } else {
      $this->hrd->addStaff();
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Staff successfull to added!</strong>
      </div>');
      redirect('hrd');
    }
  }

  public function role()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['role'] = $this->hrd->getRole();

    if ($this->input->post('keyword')) {
      $data['role'] = $this->hrd->search_role();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-hrd', $data);
    $this->load->view('a-page/hrd/role', $data);
    $this->load->view('templates/footer');
  }

  public function deactivate_role($id)
  {
    $this->db->set('status', '0');
    $this->db->where('role_id', $id);
    $this->db->update('role');
    redirect('hrd/role');
  }

  public function activate_role($id)
  {
    $this->db->set('status', '1');
    $this->db->where('role_id', $id);
    $this->db->update('role');
    redirect('hrd/role');
  }
}
