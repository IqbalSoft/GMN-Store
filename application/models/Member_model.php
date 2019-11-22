<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_model extends CI_Model
{
  public function getOnePerson($id)
  {
    return $this->db->get_where('user', ['id_user' => $id])->row_array();
  }

  public function getStaff($id)
  {
    $this->db->select('user.*, role.role_id AS role_id, role.role_name');
    $this->db->join('role', 'user.role_id = role.role_id');
    $this->db->from('user');
    $this->db->where('id_user', $id);

    return $this->db->get()->row_array();
  }

  public function editUser($id, $data)
  {
    // my function upload and rename the filename
    function upload()
    {
      $namaFile   = $_FILES['picture']['name'];
      $ukuranFile = $_FILES['picture']['size'];
      $tmpName    = $_FILES['picture']['tmp_name'];

      $ekstensi = ['gif', 'jpg', 'png', 'jpeg'];
      $ekstensiFile = explode('.', $namaFile);
      $ekstensiFile = strtolower(end($ekstensiFile));

      if (!in_array($ekstensiFile, $ekstensi)) {
        echo "<script>
          alert('Your choose not image format!');
          </script>";
        return false;
      }

      if ($ukuranFile > 124000) {
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

    $query = $this->db->get_where('user', ['id_user' => $id])->row_array();
    $foto  = $query['picture'];

    if (!$foto == 'no-photo.jpg') {
      unlink(FCPATH . './assets/img/user/' . $foto);
    } else {
      if ($_FILES['picture']['error'] == 4) {
        $picture = $this->input->post('picture', true);
      } else {
        $picture = upload();
      }
    }

    $data = [
      'fullname'   => htmlspecialchars($this->input->post('fullname', true)),
      'province_id'  => $this->input->post('province_id', true),
      'city_id'      => $this->input->post('city_id', true),
      'phone_number' => htmlspecialchars($this->input->post('phone_number'), true),
      'picture'      => $picture,
      'postal_code'    => htmlspecialchars($this->input->post('post_code', true)),
      'address'      => htmlspecialchars($this->input->post('address', true)),
      'email'        => htmlspecialchars($this->input->post('email', true))
    ];

    $this->db->where('id_user', $id);
    $this->db->update('user', $data);
  }

  public function editAlamat($id_user)
  {
    $alamat = htmlspecialchars($this->input->post(address, true));
    $this->db->set('address', $alamat);
    $this->db->where('id_user', $id_user);
    $this->db->update('user');
  }

  public function getKota($id)
  {
    $user        = $this->db->get_where('user', ['id_user' => $id])->row_array();
    $id_provinsi = $user['province_id'];
    $id_kota     = $user['city_id'];
    $kota        = $this->rajaongkir->city($id_provinsi, $id_kota);
    $kota_r      = json_decode($kota, true);
    return $kota_r["rajaongkir"]["results"]["city_name"];
  }

  public function getProvinsi($id)
  {
    $user        = $this->db->get_where('user', ['id_user' => $id])->row_array();
    $id_provinsi = $user['province_id'];
    $provinsi    = $this->rajaongkir->province($id_provinsi);
    $provinsi_r  = json_decode($provinsi, true);
    return $provinsi_r["rajaongkir"]["results"]["province"];
  }

  public function message()
  {
    $data = [
      'fullname'    => htmlspecialchars(strtolower($this->input->post('name', true))),
      'email'       => htmlspecialchars($this->input->post('email', true)),
      'message'     => htmlspecialchars($this->input->post('message', true)),
      'status_read' => '0',
      'created_at'  => time()
    ];

    $this->db->insert('message', $data);
  }
}
