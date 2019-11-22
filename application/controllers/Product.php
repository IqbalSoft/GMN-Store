<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Gudang_model', 'warehouse');

    is_logged_in();
  }

  public function index()
  {
    $data['title'] = "My Product";
    $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();

    $id_gudang = $data['user']['id_gudang'];

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "product/index";
    $config['total_rows'] = $this->warehouse->countProduct($id_gudang);
    $config['per_page']   = 7;

    // pagination
    $this->load->library('pagination');

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['produk'] = $this->warehouse->getAllProduct($id_gudang, $config['per_page'], $data['start']);

    if ($this->input->post('keyword')) {
      $data['produk'] = $this->warehouse->searchProduk($id_gudang);
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminGudang', $data);
    $this->load->view('a-page/produk/produk_list', $data);
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

    $data['title'] = "Central Product";
    $data['user']  = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();

    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "product/central";
    $this->db->like('warehouse_name', $data['keyword_PC']);
    $this->db->from('gudang');
    $this->db->where('warehouse_type', 'ps');
    $config['total_rows'] = $this->db->count_all_results();
    $config['per_page'] = 9;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['LGudang'] = $this->warehouse->GudangCentral($config['per_page'], $data['start'], $data['keyword_PC']);

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminGudang', $data);
    $this->load->view('a-page/produk/p_central', $data);
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

    $data['title'] = "Branch Product";
    $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();

    // pagination
    $this->load->library('pagination');

    // config
    $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . "product/central";
    $this->db->like('warehouse_name', $data['keyword_PB']);
    $this->db->from('gudang');
    $this->db->where('warehouse_type', 'cb');
    $config['total_rows'] = $this->db->count_all_results();
    $config['per_page'] = 9;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['LGudang'] = $this->warehouse->GudangBranch($config['per_page'], $data['start'], $data['keyword_PB']);

    $this->load->view('templates/header');
    $this->load->view('templates/nav-adminGudang', $data);
    $this->load->view('a-page/produk/p_branch', $data);
    $this->load->view('templates/footer');
  }

  public function pDW($id)
  {
    $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();
    $data['LProduk'] = $this->warehouse->getProductWarehouse($id);
    $this->load->view('templates/header');
    $this->load->view('a-page/produk/produkDetailGudang', $data);
    $this->load->view('templates/footer');
  }

  public function addProduct()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();
    // query table vendor
    $data['vendor'] = $this->db->get('vendor')->result_array();

    $this->form_validation->set_rules('product_name', 'Product name', 'required|trim|min_length[10]|max_length[30]');
    $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');
    $this->form_validation->set_rules('product_stock', 'Stock', 'required|trim|min_length[1]');
    $this->form_validation->set_rules('weight', 'Weight', 'required|trim|min_length[1]');
    $this->form_validation->set_rules('descriptions', 'Description', 'required|trim|min_length[10]|max_length[100]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('a-page/produk/add_product', $data);
      $this->load->view('templates/footer');
    } else {
      $this->warehouse->addProduct();
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Product success added!</strong></div>');
      redirect('product');
    }
  }

  public function dP($id)
  {
    $produk = $this->warehouse->getOneProduct($id);
    $product_name = $produk['image'];

    unlink(FCPATH . './assets/img/produk/' . $product_name);

    $this->db->delete('product', ['id_product' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      <span class="sr-only">Close</span>
    </button><strong>Success delete product</strong></div>');
    redirect('product');
  }

  public function dtP($id)
  {
    $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->id_user])->row_array();
    $data['produk'] = $this->warehouse->getOneProduct($id);

    $this->load->view('templates/header');
    $this->load->view('a-page/produk/detailProduk', $data);
    $this->load->view('templates/footer');
  }

  public function eP($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->email])->row_array();

    // query table vendor
    $data['vendor'] = $this->db->get('vendor')->result_array();
    $data['produk'] = $this->warehouse->getOneProduct($id);

    $this->form_validation->set_rules('product_name', 'Product name', 'required|trim|min_length[10]|max_length[30]');
    $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');
    $this->form_validation->set_rules('product_stock', 'Stock', 'required|trim|min_length[1]');
    $this->form_validation->set_rules('weight', 'Weight', 'required|trim|min_length[1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('a-page/produk/edit_product', $data);
      $this->load->view('templates/footer');
    } else {
      $this->warehouse->editProduct($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Product success edited!</strong></div>');
      redirect('product');
    }
  }
}
