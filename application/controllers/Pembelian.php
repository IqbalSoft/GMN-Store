<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pembelian_model', 'po');
    $this->load->model('Gudang_model', 'warehouse');
    $this->load->model('Member_model', 'member');
    $this->load->model('Penjualanan_model', 'sell');
    is_logged_in();
  }

  public function index()
  {
    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "pembelian/index";
    $config['total_rows'] = $this->po->countPO();
    $config['per_page'] = 8;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['po'] = $this->po->getAllPO($config['per_page'], $data['start']);

    if ($this->input->post('keyword')) {
      $data['po'] = $this->po->searchPO();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPembelian', $data);
    $this->load->view('a-page/pembelian/index', $data);
    $this->load->view('templates/footer');
  }

  public function product()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPembelian', $data);
    $this->load->view('a-page/pembelian/product');
    $this->load->view('templates/footer');
  }

  public function central()
  {
    // search
    if ($this->input->post('submit')) {
      $data['keyword_PC'] = $this->input->post('keyword_PC');
      $this->session->set_userdata('keyword', $data['keyword_PC']);
    } else {
      $this->session->set_userdata('keyword', '');
      $data['keyword_PC'] = $this->session->userdata('keyword');
    }

    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "pembelian/central";
    $this->db->like('warehouse_name', $data['keyword_PC']);
    $this->db->from('gudang');
    $this->db->where('warehouse_type', 'ps');
    $config['total_rows'] = $this->db->count_all_results();
    $config['per_page'] = 9;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['warehouse'] = $this->po->ProductCentral($config['per_page'], $data['start'], $data['keyword_PC']);
    $this->load->view('templates/header');
    $this->load->view('a-page/pembelian/p_central', $data);
    $this->load->view('templates/footer');
  }

  public function branch()
  {
    // search
    if ($this->input->post('submit')) {
      $data['keyword_PB'] = $this->input->post('keyword_PB');
      $this->session->set_userdata('keyword', $data['keyword_PB']);
    } else {
      $this->session->set_userdata('keyword', '');
      $data['keyword_PB'] = $this->session->userdata('keyword');
    }

    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "pembelian/branch";
    $this->db->like('warehouse_name', $data['keyword_PB']);
    $this->db->from('gudang');
    $this->db->where('warehouse_type', 'cb');
    $config['total_rows'] = $this->db->count_all_results();
    $config['per_page'] = 9;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['warehouse'] = $this->po->ProductBranch($config['per_page'], $data['start'], $data['keyword_PB']);
    $this->load->view('templates/header');
    $this->load->view('a-page/pembelian/p_branch', $data);
    $this->load->view('templates/footer');
  }

  public function readFile($file_name)
  {
    $ekstensi = pathinfo($file_name, PATHINFO_EXTENSION);

    if ($ekstensi == 'pdf') {
      header('Content-type: application/pdf');
      header('Content-Disposition: inline; filename="' . $file_name . '"');
      header('Content-Transfer-Encoding: binary');
      header('Accept-Ranges: bytes');
      $result = read_file('./assets/po/' . $file_name);
      echo $result;
    } else if ($ekstensi == 'docx') {
      header('Content-type: application/docx');
      header('Content-Disposition: inline; filename="' . $file_name . '"');
      header('Content-Transfer-Encoding: binary');
      header('Accept-Ranges: bytes');
    } else if ($ekstensi == 'xlsx') {
      header('Content-type: application/xlsx');
      header('Content-Disposition: inline; filename="' . $file_name . '"');
      header('Content-Transfer-Encoding: binary');
      header('Accept-Ranges: bytes');
    }
  }

  public function download($file_name)
  {
    header('Content-type: application/pdf');
    header('Content-Disposition: download; filename="' . $file_name . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    $result = read_file('./assets/po/' . $file_name);
    echo $result;
  }

  public function add()
  {
    $this->po->addPO();
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>New Purchase Order successfull add!</strong>
      </div>');
    redirect('pembelian');
  }

  public function delete($id)
  {
    $PO = $this->po->getOnePO($id);
    $po_name = $PO['file_name'];
    unlink(FCPATH . './assets/po/' . $po_name);

    $this->db->delete('pembelian', ['id_pembelian' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Purchase Order Success delected!</strong>
    </div>');
    redirect('pembelian');
  }

  public function transaksi()
  {
    $data['user']        = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "pembelian/transaksi";
    $config['total_rows'] = $this->po->countTransaksi();
    $config['per_page']   = 7;

    // pagination
    $this->load->library('pagination');

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['d_transaksi'] = $this->po->getTransaksiPembelian($config['per_page'], $data['start']);

    if ($this->input->post('keyword')) {
      $data['d_transaksi'] = $this->po->searchInvoice();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPembelian', $data);
    $this->load->view('a-page/pembelian/transaksi', $data);
    $this->load->view('templates/footer');
  }

  public function faktur($id_faktur)
  {
    $data['detail_order'] = $this->sell->detailTransaksi($id_faktur);
    $id_gudang            = $data['detail_order']['id_gudang'];
    $id                   = $data['detail_order']['id_pembeli'];
    $id_bank              = $data['detail_order']['payment'];
    $id_admin             = $data['detail_order']['id_kasir'];
    $data['bank']         = $this->sell->getBankDTransaksi($id_bank);
    $data['user']         = $this->member->getOnePerson($id);
    $data['admin']        = $this->member->getOnePerson($id_admin);
    $data['gudangName']   = $this->warehouse->getNameWarehouse($id_gudang);
    $this->load->view('a-page/gudang/faktur', $data);

    $mpdf = new \Mpdf\Mpdf();
    $dta = $this->load->view('a-page/gudang/faktur', [], TRUE);
    $mpdf->WriteHTML($dta);
    $mpdf->Output();
  }

  public function suratJalan($id_faktur)
  {
    $data['detail_order'] = $this->sell->detailTransaksi($id_faktur);
    $id_gudang            = $data['detail_order']['id_gudang'];
    $id                   = $data['detail_order']['id_pembeli'];
    $id_bank              = $data['detail_order']['payment'];
    $id_admin             = $data['detail_order']['id_kasir'];
    $data['bank']         = $this->sell->getBankDTransaksi($id_bank);
    $data['user']         = $this->member->getOnePerson($id);
    $data['admin']        = $this->member->getOnePerson($id_admin);
    $data['gudangName']   = $this->warehouse->getNameWarehouse($id_gudang);
    $this->load->view('a-page/gudang/surat_jalan', $data);

    $mpdf = new \Mpdf\Mpdf();
    $dta = $this->load->view('a-page/gudang/surat_jalan', [], TRUE);
    $mpdf->WriteHTML($dta);
    $mpdf->Output();
  }

  public function stock()
  {
    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "pembelian/stock";
    $config['total_rows'] = $this->db->count_all_results('remaining_stock');
    $config['per_page'] = 8;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['user']            = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['gudang']          = $this->db->get('gudang')->result_array();
    $data['produk']          = $this->db->get('product')->result_array();
    $data['stock_remaining'] = $this->po->getRemainingStock($config['per_page'], $data['start']);

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPembelian', $data);
    $this->load->view('a-page/pembelian/remaining_stock');
    $this->load->view('templates/footer');
  }

  public function remainingStock()
  {
    $this->po->addRemainingStock();
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Successfull added!</strong>
    </div>');
    redirect('pembelian/stock');
  }

  public function deleteRs($id)
  {
    $this->db->delete('remaining_stock', ['id_remaining' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Successfull delete!</strong>
    </div>');
    redirect('pembelian/stock');
  }

  public function editRS($id)
  {
    $data['detail_RS'] = $this->po->getOneStock($id);
    $data['gudang'] = $this->db->get('gudang')->result_array();
    $data['produk'] = $this->db->get('product')->result_array();

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('a-page/pembelian/editRemainingStock', $data);
      $this->load->view('templates/footer');
    } else {
      $this->po->editRS($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Successfull updated!</strong></div>');
      redirect('pembelian/stock');
    }
  }
}
