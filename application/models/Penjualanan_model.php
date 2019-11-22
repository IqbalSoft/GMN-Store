<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualanan_model extends CI_Model
{
  public function getData($limit, $start)
  {
    $this->db->select('id_transaksi, id_barang, total_weight, qty, service, courier, date_order, price, product_name, id_pembeli, fullname');
    $this->db->join('product', 'product.id_product = transaksi.id_barang');
    $this->db->join('user', 'user.id_user = transaksi.id_pembeli');
    $this->db->where('status_confirm', '0');
    $this->db->order_by('id_transaksi DESC');
    return $this->db->get('transaksi', $limit, $start)->result_array();
  }

  public function countData()
  {
    return $this->db->get('transaksi')->num_rows();
  }

  public function getBankDTransaksi($id_bank)
  {
    return $this->db->get_where('banks', ['id_bank' => $id_bank])->row_array();
  }

  public function getBank($limitBank, $startBank)
  {
    return $this->db->get('banks', $limitBank, $startBank)->result_array();
  }

  public function countBank()
  {
    return $this->db->get('banks')->num_rows();
  }

  public function getOneBank($id)
  {
    return $this->db->get_where('banks', ['id_bank' => $id])->row_array();
  }

  public function addBank()
  {
    $data = [
      'bank_name' => htmlspecialchars($this->input->post('bank_name', true)),
      'no_rekening' => htmlspecialchars($this->input->post('no_rekening', true)),
      'id_user' => $this->input->post('id_user', true)
    ];

    $this->db->insert('banks', $data);
  }

  public function editBank($id)
  {
    $data = [
      'bank_name' => htmlspecialchars($this->input->post('bank_name', true)),
      'no_rekening' => htmlspecialchars($this->input->post('no_rekening', true)),
      'id_user' => $this->input->post('id_user', true)
    ];

    $this->db->where('id_bank', $id);
    $this->db->update('banks', $data);
  }

  public function deleteBank($id)
  {
    $this->db->delete('banks', ['id_bank' => $id]);
  }

  public function detailTransaksi($id_transaksi)
  {
    $this->db->select('transaksi.*, product.id_product AS id_barang, product_name, image,id_product, price, weight, product_arrive, warehouse_name, transaksi.id_gudang');
    $this->db->join('product', 'transaksi.id_barang = product.id_product');
    $this->db->join('gudang', 'transaksi.id_gudang = gudang.id_warehouse');
    $this->db->from('transaksi');
    $this->db->where('id_transaksi', $id_transaksi);
    return $this->db->get()->row_array();
  }

  public function searchTransaksi()
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->select('transaksi.*, user.id_user AS id_pembeli, user.fullname, product.id_product AS id_barang, product.product_name,product.price');
    $this->db->join('user', 'transaksi.id_pembeli = user.id_user');
    $this->db->join('product', 'transaksi.id_barang = product.id_product');
    $this->db->from('transaksi');
    $this->db->where('transaksi.status_confirm', '0');

    $this->db->like('fullname', $keyword);
    $this->db->or_like('product_name', $keyword);
    return $this->db->get()->result_array();
  }

  // mengambil data berdasarkan date order & year order
  public function january($dateJanuary, $year)
  {
    $this->db->like('month_chart', $dateJanuary, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function february($dateFebruary, $year)
  {
    $this->db->like('month_chart', $dateFebruary, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function march($dateMarch, $year)
  {
    $this->db->like('month_chart', $dateMarch, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function april($dateApril, $year)
  {
    $this->db->like('month_chart', $dateApril, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function may($dateMay, $year)
  {
    $this->db->like('month_chart', $dateMay, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function june($dateJune, $year)
  {
    $this->db->like('month_chart', $dateJune, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function july($dateJuly, $year)
  {
    $this->db->like('month_chart', $dateJuly, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function august($dateAugust, $year)
  {
    $this->db->like('month_chart', $dateAugust, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function september($dateSeptember, $year)
  {
    $this->db->like('month_chart', $dateSeptember, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function october($dateOctober, $year)
  {
    $this->db->like('month_chart', $dateOctober, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function november($dateNovember, $year)
  {
    $this->db->like('month_chart', $dateNovember, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }

  public function december($dateDecember, $year)
  {
    $this->db->like('month_chart', $dateDecember, 'match');
    $this->db->where('year_chart', $year);
    return $this->db->get('transaksi')->num_rows();
  }
}
