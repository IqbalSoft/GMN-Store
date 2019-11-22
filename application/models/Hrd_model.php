<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hrd_model extends CI_Model
{
  public function getDataPegawai($limit, $start, $keyword = null)
  {
    if ($keyword) {
      $this->db->like('fullname', $keyword);
      $this->db->or_like('id_user', $keyword);
      $this->db->or_like('email', $keyword);
      $this->db->where_not_in('user.role_id', '5');
    }

    $this->db->select('user.*, role.role_id AS role_id, role_name');
    $this->db->join('role', 'user.role_id = role.role_id');
    $this->db->where_not_in('user.role_id', '5');
    $this->db->order_by('id_user DESC');

    return $this->db->get('user', $limit, $start)->result_array();
  }

  public function getDetailPegawai($id)
  {
    return $this->db->query("SELECT * FROM user JOIN role ON user.role_id = role.role_id WHERE user.id_user = $id")->row_array();
  }

  public function role()
  {
    return $this->db->query("SELECT * FROM role WHERE NOT role_id = 5 AND status = 1;")->result_array();
  }

  public function warehouse()
  {
    return $this->db->query("SELECT * FROM gudang JOIN provinsi ON gudang.province_id = provinsi.province_id")->result_array();
  }

  public function addStaff()
  {
    // fungsi upload foto & edit nama file otomatis
    function upload_staff()
    {
      $namaFile   = $_FILES['foto']['name'];
      $ukuranFile = $_FILES['foto']['size'];
      $error      = $_FILES['foto']['error'];
      $tmpName    = $_FILES['foto']['tmp_name'];

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

      if ($ukuranFile > 1240000) {
        echo "<script>
          alert('Size image very big!');
          </script>";
        return false;
      }

      $newname = uniqid();
      $newname .= '.';
      $newname .= $ekstensiFile;
      move_uploaded_file($tmpName, './assets/img/user/' . $newname);
      return $newname;
    }

    $data = [
      'fullname'     => htmlspecialchars($this->input->post('first_name'), true) . ' ' . htmlspecialchars($this->input->post('last_name'), true),
      'province_id'  => $this->input->post('province_id', true),
      'city_id'      => $this->input->post('city_id', true),
      'picture'      => upload_staff(),
      'postal_code'  => htmlspecialchars($this->input->post('postal_code'), true),
      'address'      => htmlspecialchars($this->input->post('address'), true),
      'phone_number' => htmlspecialchars($this->input->post('phone_number'), true),
      'email'        => htmlspecialchars($this->input->post('email'), true),
      'password'     => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      'role_id'      => $this->input->post('role_id', true),
      'id_gudang'    => $this->input->post('warehouse', true),
      'active_staff' => '1',
      'date_created' => time()
    ];

    $this->db->insert('user', $data);
  }

  public function getRole()
  {
    return $this->db->query("SELECT * FROM role ORDER BY role_id DESC")->result_array();
  }

  public function getOneRole($id)
  {
    $this->db->get_where('role', ['role_id' => $id])->row_array();
  }

  public function search_role()
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->like('role_id', $keyword);
    $this->db->or_like('role_name', $keyword);
    return $this->db->get('role')->result_array();
  }
}
