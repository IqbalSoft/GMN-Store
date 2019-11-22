<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supervisor_model extends CI_Model
{
  public function getInbox($limit, $start)
  {
    $this->db->order_by('id_message DESC');
    return $this->db->get('message', $limit, $start)->result_array();
  }

  public function countData()
  {
    return $this->db->get('message')->num_rows();
  }

  public function getDInbox($id)
  {
    $data = [
      'status_read' => '1'
    ];
    $this->db->where('id_message', $id);
    $this->db->update('message', $data);
    return $this->db->get_where('message', ['id_message' => $id])->row_array();
  }

  public function deleteInbox($id)
  {
    $this->db->delete('message', ['id_message' => $id]);
  }

  public function searchMessage()
  {
    $keyword = $this->input->post('keyword', true);

    $this->db->like('fullname', $keyword);
    $this->db->or_like('email', $keyword);
    return $this->db->get('message')->result_array();
  }

  public function getUser($batas, $mulai)
  {
    $this->db->select('user .*, role.role_id AS role_id, role_name');
    $this->db->join('role', 'user.role_id = role.role_id');
    $this->db->order_by('id_user DESC');

    return $this->db->get('user', $batas, $mulai)->result_array();
  }

  public function countUser()
  {
    return $this->db->get('user')->num_rows();
  }

  public function detail_user($id)
  {
    $this->db->select('user.*, role.role_id AS role_id, role_name');
    $this->db->join('role', 'user.role_id = role.role_id');
    $this->db->where('id_user', $id);

    return $this->db->get('user')->row_array();
  }

  public function searchUser()
  {
    $keyword = strtolower($this->input->post('keyword', true));

    $this->db->like('fullname', $keyword);
    $this->db->or_like('email', $keyword);
    $this->db->or_like('role_name', $keyword);

    $this->db->select('user.*, role.role_id AS role_id, role_name');
    $this->db->join('role', 'user.role_id = role.role_id');
    return $this->db->get('user')->result_array();
  }
}
