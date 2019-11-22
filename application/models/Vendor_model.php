<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
  public function getVendor($limit, $start, $keyword = null)
  {
    if ($keyword) {
      $this->db->like('vendor_name');
      $this->db->or_like('product_type');
    }

    return $this->db->get('vendor', $limit, $start)->result_array();
  }

  public function countVendor()
  {
    return $this->db->get('vendor')->num_rows();
  }

  public function addVendor()
  {
    $data = [
      'vendor_name'  => htmlspecialchars($this->input->post('vendor_name', true)),
      'product_type' => $this->input->post('product_type', true),
      'email'        => $this->input->post('email', true),
      'phone_number' => $this->input->post('phone_number', true),
      'address'      => $this->input->post('address', true),
      'created_at'   => time()
    ];

    $this->db->insert('vendor', $data);
  }

  public function editVendor($id)
  {
    $data = [
      'vendor_name'  => htmlspecialchars($this->input->post('vendor_name', true)),
      'product_type' => $this->input->post('product_type', true),
      'email'        => $this->input->post('email', true),
      'phone_number' => $this->input->post('phone_number', true),
      'address'      => $this->input->post('address', true)
    ];
    $this->db->where('id_vendor', $id);
    $this->db->update('vendor', $data);
  }

  public function search()
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->like('created_at', $keyword);
    $this->db->or_like('vendor_name', $keyword);
    $this->db->or_like('product_type', $keyword);

    return $this->db->get('vendor')->result_array();
  }
}
