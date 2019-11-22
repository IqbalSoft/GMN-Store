<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shop_model', 'shop');
    $this->load->model('Member_model', 'member');
  }

  public function index()
  {
    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "shop/index";
    $config['total_rows'] = $this->shop->countProduct();
    $config['per_page'] = 8;
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

    $data['produk'] = $this->shop->getProduct($config['per_page'], $data['start']);
    $email          = $this->session->email;
    $data['user']   = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($this->input->post('keyword')) {
      $data['produk'] = $this->shop->searchProduk();
    }

    $this->load->view('templates/header');
    if (!$this->session->userdata('email')) {
      $this->load->view('templates/nav-bl');
    } else {
      $this->load->view('templates/nav-sl', $data);
    }
    $this->load->view('m-page/product', $data);
    $this->load->view('templates/footer');
  }

  public function detail_product($id)
  {
    $data['dProduk'] = $this->shop->getOneProduct($id);
    $this->load->view('templates/header');
    $this->load->view('m-page/detail_product', $data);
    $this->load->view('templates/footer');
  }

  public function buy($id_product)
  {
    // query product,user & check login
    is_logged_in();

    $email = $this->session->email;
    $data['user']   = $this->db->get_where('user',    ['email' => $email])->row_array();
    $data['banks'] = $this->shop->getBanks();
    $data['produk'] = $this->db->query("SELECT * FROM product JOIN gudang ON product.id_gudang = gudang.id_warehouse WHERE id_product = $id_product")->row_array();
    $id = $data['user']['id_user'];
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota']     = $this->member->getKota($id);

    $this->load->view('templates/header');
    $this->load->view('m-page/buy', $data);
    $this->load->view('templates/footer');
  }

  public function order($id_product)
  {
    $this->shop->payment($id_product);
    $id = $this->session->id_user;
    redirect('shop/invoice/' . $id);
  }

  public function invoice($id)
  {
    // get data user
    $data['user']     = $this->member->getOnePerson($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota']     = $this->member->getKota($id);

    // get data barang and transaksi
    $data['invoice']  = $this->shop->invoice($id);
    $id_gudang = $data['invoice']['id_gudang'];
    $id_bank = $data['invoice']['payment'];
    $data['bank']  = $this->shop->getOneBankInvoice($id_bank);
    $data['gudang'] = $this->shop->getGudang($id_gudang);
    $this->load->view('templates/header');
    $this->load->view('m-page/invoice', $data);
    $this->load->view('templates/footer');
  }

  public function history_order()
  {
    $id = $this->session->id_user;
    $data['h_order'] = $this->shop->getOrder($id);
    $this->load->view('templates/header');
    $this->load->view('m-page/h_order', $data);
    $this->load->view('templates/footer');
  }

  public function detail_hOrder($id_transaksi)
  {
    // get data user
    $id = $this->session->id_user;
    $data['user']     = $this->member->getOnePerson($id);
    $data['provinsi'] = $this->member->getProvinsi($id);
    $data['kota']     = $this->member->getKota($id);

    $data['h_order']  = $this->shop->h_order($id_transaksi);
    $this->load->view('templates/header');
    $this->load->view('m-page/detail_historyorder', $data);
    $this->load->view('templates/footer');
  }
}
