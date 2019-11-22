<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{
  public function getAllPO($limit, $start)
  {
    return $this->db->get('pembelian', $limit, $start)->result_array();
  }

  public function countPO()
  {
    return $this->db->get('pembelian')->num_rows();
  }

  public function getOnePO($id)
  {
    return $this->db->get_where('pembelian', ['id_pembelian' => $id])->row_array();
  }

  public function ReadFile($file_name)
  {
    return $this->db->get_where('pembelian', ['file_name' => $file_name])->row_array();
  }

  public function addPO()
  {
    // fungsi upload sekaligus ganti nama file
    function upload()
    {
      $namaFile   = $_FILES['dokumen']['name'];
      $ukuranFile = $_FILES['dokumen']['size'];
      $error      = $_FILES['dokumen']['error'];
      $tmpName    = $_FILES['dokumen']['tmp_name'];

      if ($error === 4) {
        echo "<script>
          alert('Please choose file!');
          </script>";
        return false;
      }

      $getEkstensiUploadFile = pathinfo($namaFile, PATHINFO_EXTENSION);

      $ekstensi = ['pdf', 'docx', 'xlsx'];
      $ekstensiFile = explode('.', $namaFile);
      $ekstensiFile = strtolower(end($ekstensiFile));

      if ($getEkstensiUploadFile == $ekstensi) {
        echo "<script>
          alert('Your choose not file format!');
          </script>";
        return false;
      }

      if ($ukuranFile > 9480000) {
        echo "<script>
          alert('Size very big!');
          </script>";
        return false;
      }

      $newname = uniqid();
      $newname .= '.';
      $newname .= $ekstensiFile;
      move_uploaded_file($tmpName, './assets/po/' . $newname);
      return $newname;
    }

    $data = [
      'id_user'    => $this->input->post('id_user', true),
      'file_name'  => upload(),
      'created_at' => time()
    ];
    $this->db->insert('pembelian', $data);
  }

  public function ProductCentral($limitPC, $startPC, $keyword_PC = null)
  {
    if ($keyword_PC) {
      $this->db->like('warehouse_name', $keyword_PC);
      $this->db->or_like('province_name', $keyword_PC);
      $this->db->where('warehouse_type', 'ps');
    }

    $this->db->select('gudang.*, provinsi.province_id AS province_id, province_name');
    $this->db->join('provinsi', 'gudang.province_id = provinsi.province_id');
    $this->db->where('warehouse_type', 'ps');

    return $this->db->get('gudang', $limitPC, $startPC)->result_array();
  }

  public function ProductBranch($limitPB, $startPB, $keyword_PB = null)
  {
    if ($keyword_PB) {
      $this->db->like('warehouse_name', $keyword_PB);
      $this->db->or_like('province_name', $keyword_PB);
      $this->db->where('warehouse_type', 'cb');
    }

    $this->db->select('gudang.*, provinsi.province_id AS province_id, province_name');
    $this->db->join('provinsi', 'gudang.province_id = provinsi.province_id');
    $this->db->where('warehouse_type', 'cb');

    return $this->db->get('gudang', $limitPB, $startPB)->result_array();
  }

  public function searchPO()
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->like('created_at', $keyword);
    $this->db->or_like('id_pembelian', $keyword);

    return $this->db->get('pembelian')->result_array();
  }

  // awal bagian transaksi
  public function getTransaksiPembelian($limitG, $startG)
  {
    $this->db->select('transaksi.*, product.id_product AS id_barang, product_name');
    $this->db->join('product', 'transaksi.id_barang = product.id_product');
    $this->db->join('user', 'transaksi.id_kasir = user.id_user');
    $this->db->where_not_in('status_confirm', '0');
    $this->db->order_by('id_transaksi DESC');

    return $this->db->get('transaksi', $limitG, $startG)->result_array();
  }

  public function countTransaksi()
  {
    $this->db->where_not_in('status_confirm', '0');
    return $this->db->get('transaksi')->num_rows();
  }

  public function searchInvoice()
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->select('transaksi.*, product.id_product AS id_barang, product.product_name,product.price');
    $this->db->join('product', 'transaksi.id_barang = product.id_product');
    $this->db->from('transaksi');
    $this->db->where('transaksi.status_confirm', '1');

    $this->db->like('date_order', $keyword);
    $this->db->or_like('product_name', $keyword);
    return $this->db->get()->result_array();
  }
  // akhir bagian transaksi

  // remaining stock
  public function getRemainingStock($batas, $start)
  {
    $this->db->select('remaining_stock.*, gudang.id_warehouse AS id_gudang, warehouse_name, fullname, product_name, product_stock');
    $this->db->join('gudang', 'gudang.id_warehouse = remaining_stock.id_gudang');
    $this->db->join('product', 'product.id_product = remaining_stock.id_produk');
    $this->db->join('user', 'user.id_user = remaining_stock.id_user');

    return $this->db->get('remaining_stock', $batas, $start)->result_array();
  }

  public function getOneStock($id)
  {
    $this->db->select('remaining_stock.*, gudang.id_warehouse AS id_gudang, warehouse_name, fullname, product_name');
    $this->db->join('gudang', 'gudang.id_warehouse = remaining_stock.id_gudang');
    $this->db->join('product', 'product.id_product = remaining_stock.id_produk');
    $this->db->join('user', 'user.id_user = remaining_stock.id_user');
    $this->db->where('id_remaining', $id);
    return $this->db->get('remaining_stock')->row_array();
  }

  public function addRemainingStock()
  {
    $data = [
      'id_gudang' => $this->input->post('id_gudang'),
      'id_produk' => $this->input->post('id_produk'),
      'id_user'   => $this->input->post('id_user'),
      'stock'     => htmlspecialchars($this->input->post('stok')),
      'created_at' => time()
    ];

    $this->db->insert('remaining_stock', $data);
  }

  public function editRS($id)
  {
    $data = [
      'id_gudang' => $this->input->post('id_gudang'),
      'id_produk' => $this->input->post('id_produk'),
      'id_user'   => $this->input->post('id_user'),
      'stock'     => htmlspecialchars($this->input->post('stok'))
    ];

    $this->db->where('id_remaining', $id);
    $this->db->update('remaining_stock', $data);
  }
  // akhir remaining stock
}
