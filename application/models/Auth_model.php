<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function register()
  {
    $data = [
      'fullname'   => htmlspecialchars($this->input->post('first_name', true) . ' ' . $this->input->post('last_name', true)),
      'province_id'  => $this->input->post('province_id', true),
      'city_id'      => $this->input->post('city_id', true),
      'picture'      => 'no-photo.jpg',
      'email'        => htmlspecialchars($this->input->post('email', true)),
      'password'     => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      'role_id'      => '4',
      'id_gudang'    => '',
      'active_staff' => '1',
      'date_created' => time()
    ];
    $this->db->insert('user', $data);
  }

  public function _login()
  {
    $email = $this->input->post('email');
    $pass  = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      if ($user['active_staff'] == 1) {
        if (password_verify($pass, $user['password'])) {
          $data = [
            'email'   => $user['email'],
            'role_id' => $user['role_id'],
            'id_user' => $user['id_user']
          ];
          $this->session->set_userdata($data);

          $role_id = $this->session->userdata('role_id');
          if ($role_id == '1') {
            redirect('gudang');
          } else if ($role_id == '2') {
            redirect('pembelian');
          } else if ($role_id == '3') {
            redirect('penjualanan');
          } else if ($role_id == '5') {
            redirect('hrd');
          } else if ($role_id == '6') {
            redirect('supervisor');
          } else if ($role_id == '4') {
            redirect('shop');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Wrong password!</strong></div>');
          redirect('/auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Im sorry your account has been deactivate!</strong></div>');
        redirect('/auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Your account not registered!</strong></div>');
      redirect('/auth');
    }
  }
}
