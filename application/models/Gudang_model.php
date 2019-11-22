<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gudang_model extends CI_Model
{
  // awal gudang
  public function lGudang($limitAG, $startAG, $keyword_gudang = null)
  {
    if ($keyword_gudang) {
      $this->db->like('warehouse_name', $keyword_gudang);
      $this->db->or_like('province_name', $keyword_gudang);
    }

    $this->db->select('gudang.*, provinsi.province_id AS province_id, province_name');
    $this->db->join('provinsi', 'gudang.province_id = provinsi.province_id');
    $this->db->order_by('id_warehouse DESC');

    return $this->db->get('gudang', $limitAG, $startAG)->result_array();
  }

  public function countAllGudang()
  {
    return $this->db->get('gudang')->num_rows();
  }

  public function GudangCentral($limitGC, $startGC, $keyword_PC)
  {
    if ($keyword_PC) {
      $this->db->like('warehouse_name', $keyword_PC);
      $this->db->or_like('province_name', $keyword_PC);
      $this->db->where('warehouse_type', 'ps');
    }

    $this->db->select('gudang.*, provinsi.province_id AS province_id, province_name');
    $this->db->join('provinsi', 'gudang.province_id = provinsi.province_id');
    $this->db->where('warehouse_type', 'ps');
    $this->db->order_by('id_warehouse DESC');

    return $this->db->get('gudang', $limitGC, $startGC)->result_array();
  }

  public function GudangBranch($limitGB, $startGB, $keyword_PB)
  {
    if ($keyword_PB) {
      $this->db->like('warehouse_name', $keyword_PB);
      $this->db->or_like('province_name', $keyword_PB);
      $this->db->where('warehouse_type', 'cb');
    }

    $this->db->select('gudang.*, provinsi.province_id AS province_id, province_name');
    $this->db->join('provinsi', 'gudang.province_id = provinsi.province_id');
    $this->db->where('warehouse_type', 'cb');
    $this->db->order_by('id_warehouse DESC');

    return $this->db->get('gudang', $limitGB, $startGB)->result_array();
  }

  public function addGudang()
  {
    $upload_image = $_FILES['image']['name'];
    if ($upload_image) {
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']      = '2048';
      $config['upload_path']   = './assets/img/gudang/';
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('image')) {
        $this->upload->data('file_name');
      } else {
        echo $this->upload->display_errors();
      }
    }

    $data = [
      'warehouse_name' => $this->input->post('warehouse_name', true),
      'image_gudang'   => $upload_image,
      'warehouse_type' => $this->input->post('warehouse_type', true),
      'province_id'    => $this->input->post('province_id', true),
      'city_id'        => $this->input->post('city_id', true),
      'address'        => htmlspecialchars($this->input->post('address', true)),
      'created_at'     => time()
    ];
    $this->db->insert('gudang', $data);
  }

  public function editGudang($id)
  {
    // my function upload and rename the filename
    function upload_IMG()
    {
      $namaFile   = $_FILES['image_gudang']['name'];
      $ukuranFile = $_FILES['image_gudang']['size'];
      $tmpName    = $_FILES['image_gudang']['tmp_name'];

      $ekstensi = ['gif', 'jpg', 'png', 'jpeg'];
      $ekstensiFile = explode('.', $namaFile);
      $ekstensiFile = strtolower(end($ekstensiFile));

      if (!in_array($ekstensiFile, $ekstensi)) {
        echo "<script>
           alert('Your choose not image format!');
           </script>";
        return false;
      }

      if ($ukuranFile > 1240000) {
        echo "<script>
           alert('Size image very big!');
           </script>";
        return false;
      }

      $newname = uniqid();
      $newname .= '.';
      $newname .= $ekstensiFile;
      move_uploaded_file($tmpName, './assets/img/gudang/' . $newname);
      return $newname;
    }

    // get data gudang
    $query = $this->db->get_where('gudang', ['id_warehouse' => $id])->row_array();

    // cek image apakah baru atau lama
    if ($_FILES['image_gudang']['error'] == 4) {
      $image_gudang = $query['image_gudang'];
    } else {
      // menghaous image di folder
      $foto_gudang  = $query['image_gudang'];
      unlink(FCPATH . './assets/img/gudang/' . $foto_gudang);
      $image_gudang = upload_IMG();
    }

    $data = [
      'image_gudang'   => $image_gudang,
      'warehouse_name' => htmlspecialchars($this->input->post('warehouse_name')),
      'province_id'    => $this->input->post('province_id', true),
      'city_id'        => $this->input->post('city_id', true),
      'warehouse_type' => $this->input->post('warehouse_type', true),
      'address'        => htmlspecialchars($this->input->post('address', true))
    ];

    $this->db->where('id_warehouse', $id);
    $this->db->update('gudang', $data);
  }

  public function detailGudang($id)
  {
    return $this->db->query("SELECT * FROM gudang JOIN provinsi ON gudang.province_id = provinsi.province_id WHERE id_warehouse = $id")->row_array();
  }

  public function getKota($id)
  {
    $queryKota   = $this->db->get_where('gudang', ['id_warehouse' => $id])->row_array();
    $id_provinsi = $queryKota['province_id'];
    $id_kota     = $queryKota['city_id'];
    $kota        = $this->rajaongkir->city($id_provinsi, $id_kota);
    $kota_r      = json_decode($kota, true);
    return $kota_r["rajaongkir"]["results"]["city_name"];
  }

  public function getNameWarehouse($id_gudang)
  {
    return $this->db->get_where('gudang', ['id_warehouse' => $id_gudang])->row_array();
  }

  public function searchGudang()
  {
    $keyword = $this->input->post('keyword_gudang', true);

    $this->db->select('gudang.*, provinsi.province_id AS province_id, provinsi.province_name');
    $this->db->join('provinsi', 'gudang.province_id = provinsi.province_id');
    $this->db->from('gudang');

    $this->db->like('warehouse_name', $keyword);

    return $this->db->get()->result_array();
  }

  public function searchCentralBranch($type)
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->select('gudang.*, provinsi.province_id AS province_id, provinsi.province_name');
    $this->db->join('provinsi', 'gudang.province_id = provinsi.province_id');
    $this->db->from('gudang');
    $this->db->where('warehouse_type', $type);

    $this->db->like('warehouse_name', $keyword);

    return $this->db->get()->result_array();
  }

  // akhir gudang

  // awal produk
  public function getAllProduct($id_gudang, $limitP, $startP)
  {
    $this->db->select('product.*, vendor.id_vendor AS id_vendor, product_type');
    $this->db->join('vendor', 'product.id_vendor = vendor.id_vendor');
    $this->db->where('id_gudang', $id_gudang);
    $this->db->order_by('id_product DESC');

    return $this->db->get('product', $limitP, $startP)->result_array();
  }

  public function countProduct($id_gudang)
  {
    $this->db->where('id_gudang', $id_gudang);
    return $this->db->get('product')->num_rows();
  }

  public function getOneProduct($id)
  {
    return $this->db->query("SELECT * FROM product JOIN vendor ON product.id_vendor = vendor.id_vendor WHERE id_product = $id ORDER BY id_product DESC")->row_array();
  }

  public function getProductWarehouse($id)
  {
    return $this->db->query("SELECT * FROM product INNER JOIN vendor ON product.id_vendor = vendor.id_vendor WHERE id_gudang = $id ORDER BY id_product DESC")->result_array();
  }

  public function addProduct()
  {
    // my function upload and rename the filename
    function upload()
    {
      $namaFile   = $_FILES['gambar']['name'];
      $ukuranFile = $_FILES['gambar']['size'];
      $error      = $_FILES['gambar']['error'];
      $tmpName    = $_FILES['gambar']['tmp_name'];

      if ($error === 4) {
        echo "<script>
          alert('Please choose image!');
          </script>";
        return false;
      }

      $ekstensi = ['gif', 'jpg', 'png', 'jpeg'];
      $ekstensiFile = explode('.', $namaFile);
      $ekstensiFile = strtolower(end($ekstensiFile));

      if (!in_array($ekstensiFile, $ekstensi)) {
        echo "<script>
          alert('Your choose not image format!');
          </script>";
        return false;
      }

      if ($ukuranFile > 2480000) {
        echo "<script>
          alert('Size image very big!');
          </script>";
        return false;
      }

      $newname = uniqid();
      $newname .= '.';
      $newname .= $ekstensiFile;
      move_uploaded_file($tmpName, './assets/img/produk/' . $newname);
      return $newname;
    }

    $data = [
      'image'          => upload(),
      'product_name'   => htmlspecialchars($this->input->post('product_name'), true),
      'price'          => $this->input->post('price', true),
      'weight'         => $this->input->post('weight', true),
      'product_stock'  => $this->input->post('product_stock', true),
      'province_id'    => $this->input->post('province_id', true),
      'city_id'        => $this->input->post('city_id', true),
      'id_user'        => $this->input->post('id_user', true),
      'id_vendor'      => $this->input->post('id_vendor', true),
      'descriptions'   => $this->input->post('descriptions', true),
      'id_gudang'      => $this->input->post('id_gudang', true),
      'product_arrive' => time()
    ];
    $this->db->insert('product', $data);
  }

  public function editProduct($id)
  {
    // my function upload and rename the filename
    function upload_image()
    {
      $namaFile   = $_FILES['image']['name'];
      $ukuranFile = $_FILES['image']['size'];
      $tmpName    = $_FILES['image']['tmp_name'];

      $ekstensi = ['gif', 'jpg', 'png', 'jpeg'];
      $ekstensiFile = explode('.', $namaFile);
      $ekstensiFile = strtolower(end($ekstensiFile));

      if (!in_array($ekstensiFile, $ekstensi)) {
        echo "<script>
           alert('Your choose not image format!');
           </script>";
        return false;
      }

      if ($ukuranFile > 1240000) {
        echo "<script>
           alert('Size image very big!');
           </script>";
        return false;
      }

      $newname = uniqid();
      $newname .= '.';
      $newname .= $ekstensiFile;
      move_uploaded_file($tmpName, './assets/img/produk/' . $newname);
      return $newname;
    }

    $query = $this->db->get_where('gudang', ['id_warehouse' => $id])->row_array();

    $foto_gudang = $query['image_gudang'];
    unlink(FCPATH . './assets/img/gudang/' . $foto_gudang);

    if ($_FILES['image']['error'] == 4) {
      $image = $this->input->post('image', true);
    } else {
      $query = $this->db->get_where('gudang', ['id_warehouse' => $id])->row_array();
      $foto_gudang  = $query['image_gudang'];
      $image = upload_image();
    }
    $data =  [
      'image'         => $image,
      'product_name'  => htmlspecialchars($this->input->post('product_name'), true),
      'price'         => $this->input->post('price', true),
      'weight'        => $this->input->post('weight', true),
      'product_stock' => $this->input->post('product_stock', true),
      'id_vendor'     => $this->input->post('id_vendor', true)
    ];
    $this->db->where('id_product', $id);
    $this->db->update('product', $data);
  }

  public function searchProduk($id_gudang)
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->select('product.*, vendor.id_vendor AS id_vendor, vendor.product_type');
    $this->db->join('vendor', 'product.id_vendor = vendor.id_vendor');
    $this->db->from('product');
    $this->db->where('product.id_gudang', $id_gudang);

    $this->db->like('product_name', $keyword);
    $this->db->or_like('product_stock', $keyword);

    return $this->db->get()->result_array();
  }
  // akhir produk

  // awal bagian transaksi
  public function getTransaksi($id_gudang, $limitG, $startG)
  {
    $this->db->select('transaksi.*, product.id_product AS id_barang, product_name');
    $this->db->join('product', 'transaksi.id_barang = product.id_product');
    $this->db->where('transaksi.id_gudang', $id_gudang);
    $this->db->order_by('id_transaksi DESC');

    return $this->db->get('transaksi', $limitG, $startG)->result_array();
  }

  public function countTransaksi($id_gudang)
  {
    $this->db->where('id_gudang', $id_gudang);
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

  public function addResi($id_resi)
  {
    // my function upload and rename the filename
    function upload_resi()
    {
      $namaFile   = $_FILES['resiFile']['name'];
      $ukuranFile = $_FILES['resiFile']['size'];
      $error      = $_FILES['resiFile']['error'];
      $tmpName    = $_FILES['resiFile']['tmp_name'];

      if ($error === 4) {
        echo "<script>
          alert('Please choose image!');
          </script>";
        return false;
      }

      $ekstensi = ['jpg', 'png', 'jpeg'];
      $ekstensiFile = explode('.', $namaFile);
      $ekstensiFile = strtolower(end($ekstensiFile));

      if (!in_array($ekstensiFile, $ekstensi)) {
        echo "<script>
          alert('Your choose not image format!');
          </script>";
        return false;
      }

      if ($ukuranFile > 2480000) {
        echo "<script>
          alert('Size image very big!');
          </script>";
        return false;
      }

      $newname = uniqid();
      $newname .= '.';
      $newname .= $ekstensiFile;
      move_uploaded_file($tmpName, './assets/resi/' . $newname);
      return $newname;
    }

    $data = [
      'status_confirm' => '2',
      'resi'           => upload_resi()
    ];

    $this->db->where('id_transaksi', $id_resi);
    $this->db->update('transaksi', $data);
  }
  // akhir bagian transaksi
}
