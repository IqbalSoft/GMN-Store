<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gudang extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Member_model', 'member');
    $this->load->model('Gudang_model', 'warehouse');
    $this->load->model('Penjualanan_model', 'sell');
    is_logged_in();
  }

  public function index()
  {
    $data['user']        = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();
    $id_gudang           = $data['user']['id_gudang'];

    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "gudang/index";
    $config['total_rows'] = $this->warehouse->countTransaksi($id_gudang);
    $config['per_page'] = 5;
    $config['num_links'] = 5;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['d_transaksi'] = $this->warehouse->getTransaksi($id_gudang, $config['per_page'], $data['start']);

    if ($this->input->post('keyword')) {
      $data['d_transaksi'] = $this->warehouse->searchInvoice();
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminGudang', $data);
    $this->load->view('a-page/gudang/index', $data);
    $this->load->view('templates/footer');
  }

  public function lGudang()
  {
    // search
    if ($this->input->post('submit')) {
      $data['keyword_gudang'] = $this->input->post('keyword_gudang');
      $this->session->set_userdata('keyword', $data['keyword_gudang']);
    } else {
      $this->session->set_userdata('keyword', '');
      $data['keyword_gudang'] = $this->session->userdata('keyword');
    }

    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "gudang/lGudang";
    $config['total_rows'] = $this->warehouse->countAllGudang();
    $config['per_page'] = 8;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $id = $this->session->id_user;
    $data['user']     = $this->member->getOnePerson($id);
    $data['l_Gudang'] = $this->warehouse->lGudang($config['per_page'], $data['start'], $data['keyword_gudang']);

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminPembelian', $data);
    $this->load->view('a-page/gudang/l_gudang', $data);
    $this->load->view('templates/footer');
  }

  public function addGudang()
  {
    $this->form_validation->set_rules('address', 'Warehouse address', 'required|trim|max_length[200]|min_length[30]');
    $this->form_validation->set_rules('warehouse_name', 'Warehouse name', 'required|trim|max_length[30]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('a-page/gudang/add_gudang');
      $this->load->view('templates/footer');
    } else {
      $this->warehouse->addGudang();
      $this->session->set_flashdata('message', '.<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button><strong>Success add new warehouse</strong></div>');
      redirect('gudang/lGudang');
    }
  }

  public function deleteGudang($id)
  {
    $query = $this->db->get_where('gudang', ['id_warehouse' => $id])->row_array();
    $foto_gudang  = $query['image_gudang'];
    unlink(FCPATH . './assets/img/gudang/' . $foto_gudang);
    $this->db->delete('gudang', ['id_warehouse' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button><strong>Success delete warehouse</strong></div>');
    redirect('gudang/lGudang');
  }

  public function editGudang($id)
  {
    $data['dGudang'] = $this->db->get_where('gudang', ['id_warehouse' => $id])->row_array();
    $data['warehouse_type'] = ['ps', 'cb'];

    $this->form_validation->set_rules('address', 'Address', 'required|trim|min_length[3]|max_length[150]');
    $this->form_validation->set_rules('warehouse_name', 'Warehouse Name', 'required|trim|max_length[50]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('a-page/gudang/edit_gudang', $data);
      $this->load->view('templates/footer');
    } else {
      $this->warehouse->editGudang($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Success edit warehouse .</strong>
      </div>');
      redirect('gudang/lGudang');
    }
  }

  public function detailGudang($id)
  {
    $data['detail'] = $this->warehouse->detailGudang($id);
    $data['kota']   = $this->warehouse->getKota($id);

    $this->load->view('templates/header');
    $this->load->view('a-page/gudang/detail_gudang', $data);
    $this->load->view('templates/footer');
  }

  public function detailTransaksi($id_transaksi)
  {
    $data['user_login'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    $data['detail_order'] = $this->sell->detailTransaksi($id_transaksi);
    $id_bank = $data['detail_order']['payment'];
    $data['bank'] = $this->sell->getBankDTransaksi($id_bank);
    $id = $data['detail_order']['id_pembeli'];
    $data['user']     = $this->member->getOnePerson($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota']     = $this->member->getKota($id);

    $this->load->view('templates/header');
    $this->load->view('a-page/penjualanan/detail_transaksi', $data);
    $this->load->view('templates/footer');
  }

  public function faktur($id_faktur)
  {
    $id_kasir = $this->session->id_user;

    $this->db->set('id_kasir', $id_kasir);
    $this->db->where('id_transaksi', $id_faktur);
    $this->db->update('transaksi');

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
    $id_kasir = $this->session->id_user;

    $this->db->set('id_kasir', $id_kasir);
    $this->db->where('id_transaksi', $id_faktur);
    $this->db->update('transaksi');

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

  public function resi($id_resi)
  {
    $data['id_transaksi'] = $id_resi;

    $this->load->view('templates/header');
    $this->load->view('a-page/gudang/resi', $data);
    $this->load->view('templates/footer');
  }

  public function AddResi($id_resi)
  {
    $this->warehouse->addResi($id_resi);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Resi berhasil diupload</strong>
    </div>');
    redirect('gudang');
  }

  public function showResi($id_resi)
  {
    $data['showResi'] = $this->db->get_where('transaksi', ['id_transaksi' => $id_resi])->row_array();

    $this->load->view('templates/header');
    $this->load->view('a-page/gudang/show_resi', $data);
    $this->load->view('templates/footer');
  }

  public function deleteResi($id_resi)
  {
    $data['query'] = $this->db->get_where('transaksi', ['id_transaksi' => $id_resi])->row_array();

    $namaFile = $data['query']['resi'];

    unlink(FCPATH . 'assets/resi/' . $namaFile);
    $data = [
      'resi' => '',
      'status_confirm' => '1'
    ];

    $this->db->where('id_transaksi', $id_resi);
    $this->db->update('transaksi', $data);

    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
      <strong>Berhasil dihapus!</strong>
    </div>');
    redirect('gudang');
  }
}
