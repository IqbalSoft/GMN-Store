<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualanan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();

    $this->load->model('Penjualanan_model', 'penjualanan');
    $this->load->model('Member_model', 'member');
    $this->load->model('Pembelian_model', 'po');
  }

  public function index()
  {
    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "penjualanan/index";
    $config['total_rows'] = $this->penjualanan->countData();
    $config['per_page'] = 7;
    $config['num_links'] = 5;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['d_penjualanan'] = $this->penjualanan->getData($config['per_page'], $data['start']);

    // search
    if ($this->input->post('keyword')) {
      $data['d_penjualanan'] = $this->penjualanan->searchTransaksi();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPenjualan', $data);
    $this->load->view('a-page/penjualanan/index');
    $this->load->view('templates/footer');
  }

  public function product()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPenjualan', $data);
    $this->load->view('a-page/penjualanan/product');
    $this->load->view('templates/footer');
  }

  public function central()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['warehouse'] = $this->po->ProductCentral();
    $this->load->view('templates/header');
    $this->load->view('a-page/pembelian/p_central', $data);
    $this->load->view('templates/footer');
  }

  public function branch()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['warehouse'] = $this->po->ProductBranch();
    $this->load->view('templates/header');
    $this->load->view('a-page/pembelian/p_branch', $data);
    $this->load->view('templates/footer');
  }

  public function statistics()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $year = date('Y', time());

    $dateJanuary   = 12 - 11;
    $dateFebruary  = 12 - 10;
    $dateMarch     = 12 - 9;
    $dateApril     = 12 - 8;
    $dateMay       = 12 - 7;
    $dateJune      = 12 - 6;
    $dateJuly      = 12 - 5;
    $dateAugust    = 12 - 4;
    $dateSeptember = 12 - 3;
    $dateOctober   = 12 - 2;
    $dateNovember  = 12 - 1;
    $dateDecember  = 12 - 0;

    $data['january']   = $this->penjualanan->january($dateJanuary, $year);
    $data['february']  = $this->penjualanan->february($dateFebruary, $year);
    $data['march']     = $this->penjualanan->march($dateMarch, $year);
    $data['april']     = $this->penjualanan->april($dateApril, $year);
    $data['may']       = $this->penjualanan->may($dateMay, $year);
    $data['june']      = $this->penjualanan->june($dateJune, $year);
    $data['july']      = $this->penjualanan->july($dateJuly, $year);
    $data['august']    = $this->penjualanan->august($dateAugust, $year);
    $data['september'] = $this->penjualanan->september($dateSeptember, $year);
    $data['october']   = $this->penjualanan->october($dateOctober, $year);
    $data['november']  = $this->penjualanan->november($dateNovember, $year);
    $data['december']  = $this->penjualanan->december($dateDecember, $year);

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPenjualan', $data);
    $this->load->view('a-page/penjualanan/statistics');
    $this->load->view('templates/footer');
  }

  public function bank()
  {
    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "penjualanan/bank";
    $config['total_rows'] = $this->penjualanan->countBank();
    $config['per_page'] = 4;
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
    $data['banks'] = $this->penjualanan->getBank($config['per_page'], $data['start']);
    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPenjualan', $data);
    $this->load->view('a-page/penjualanan/bank', $data);
    $this->load->view('templates/footer');
  }

  public function addBank()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();

    $this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim|max_length[60]');
    $this->form_validation->set_rules('no_rekening', 'Rekening Number', 'required|trim|max_length[16]|min_length[15]|numeric', [
      'min_length' => 'Rekening to short',
      'max_length' => 'Rekening to long',
      'numeric'    => 'your enter not a rekening number format'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('a-page/penjualanan/add_bank', $data);
      $this->load->view('templates/footer');
    } else {
      $this->penjualanan->addBank();
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Bank successfully added!</strong>
      </div>');
      redirect('penjualanan/bank');
    }
  }

  public function editBank($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['edit_bank'] = $this->penjualanan->getOneBank($id);

    $this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim|max_length[60]');
    $this->form_validation->set_rules('no_rekening', 'Rekening Number', 'required|trim|max_length[16]|min_length[15]|numeric', [
      'min_length' => 'Rekening to short',
      'max_length' => 'Rekening to long',
      'numeric'    => 'your enter not a rekening number format'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('a-page/penjualanan/edit_bank', $data);
      $this->load->view('templates/footer');
    } else {
      $this->penjualanan->editBank($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Bank successfully updated!</strong>
      </div>');
      redirect('penjualanan/bank');
    }
  }

  public function deleteBank($id)
  {
    $this->penjualanan->deleteBank($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Bank successfully delected!</strong>
      </div>');
    redirect('penjualanan/bank');
  }

  public function detailTransaksi($id_transaksi)
  {
    $data['user_login'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['detail_order'] = $this->penjualanan->detailTransaksi($id_transaksi);
    $id_bank = $data['detail_order']['payment'];
    $data['bank'] = $this->penjualanan->getBankDTransaksi($id_bank);

    $id = $data['detail_order']['id_pembeli'];
    $data['user']     = $this->member->getOnePerson($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota']     = $this->member->getKota($id);

    $this->load->view('templates/header');
    $this->load->view('a-page/penjualanan/detail_transaksi', $data);
    $this->load->view('templates/footer');
  }

  public function confirm($id)
  {
    $data = [
      'status_confirm' => '1',
      'date_confirm'   => time()
    ];
    $this->db->where('id_transaksi', $id);
    $this->db->update('transaksi', $data);
    redirect('penjualanan');
  }
}
