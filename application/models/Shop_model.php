<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{
  public function getProduct($limit, $start)
  {

    $this->db->select('id_product,price,image,product_stock,product_name,province_name');
    $this->db->join('provinsi', 'provinsi.province_id = product.province_id');
    $this->db->order_by('id_product DESC');
    return $this->db->get('product', $limit, $start)->result_array();
  }

  public function countProduct()
  {
    return $this->db->get('product')->num_rows();
  }

  public function getBanks()
  {
    return $this->db->get('banks')->result_array();
  }

  public function getOneBankInvoice($id_bank)
  {
    return $this->db->get_where('banks', ['id_bank' => $id_bank])->row_array();
  }

  public function getOrder($id)
  {
    return $this->db->query("SELECT * FROM transaksi WHERE id_pembeli = $id ORDER BY id_transaksi DESC")->result_array();
  }

  public function getOneProduct($id)
  {
    return $this->db->query("SELECT * FROM product WHERE id_product = $id")->row_array();
  }

  public function getGudang($id_gudang)
  {
    return $this->db->get_where('gudang', ['id_warehouse' => $id_gudang])->row_array();
  }

  public function payment($id_product)
  {
    $month_chart = date('m', time());
    $year_chart = date('Y', time());

    $data = [
      'id_barang'      => $id_product,
      'id_pembeli'     => $this->input->post('id_user', true),
      'id_gudang'      => $this->input->post('id_gudang', true),
      'qty'            => $qty = $this->input->post('qty', true),
      'total_weight'   => $qty * $this->input->post('weight', true),
      'courier'        => $this->input->post('kurir', true),
      'service'        => $this->input->post('service', true),
      'payment'        => $this->input->post('payment', true),
      'status_confirm' => '',
      'date_order'     => time(),
      'date_confirm'   => '',
      'month_chart'    => $month_chart,
      'year_chart'     => $year_chart
    ];
    $this->db->insert('transaksi', $data);

    $query = $this->db->get_where('product', ['id_product' => $id_product])->row_array();
    $stok = $query['product_stock'] - $this->input->post('qty', true);

    $this->db->set('product_stock', $stok);
    $this->db->where('id_product', $id_product);
    $this->db->update('product');
  }

  public function invoice($id)
  {
    return $this->db->query("SELECT * FROM transaksi INNER JOIN product ON transaksi.id_barang = product.id_product ORDER BY id_transaksi DESC")->row_array();
  }

  public function h_order($id_transaksi)
  {
    return $this->db->query("SELECT * FROM transaksi INNER JOIN product ON transaksi.id_barang = product.id_product WHERE id_transaksi = $id_transaksi ORDER BY id_transaksi DESC")->row_array();
  }

  public function searchProduk()
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->select('product.*, provinsi.province_id AS province_id, provinsi.province_name');
    $this->db->join('provinsi', 'product.province_id = provinsi.province_id');
    $this->db->from('product');

    $this->db->like('product_name', $keyword);
    $this->db->or_like('province_name', $keyword);

    return $this->db->get()->result_array();
  }
}
