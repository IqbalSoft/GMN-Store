<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model', 'auth');
  }

  public function index()
  {
    // cek apabila sudah login
    if ($this->session->email) {
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
    }

    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('auth/index');
      $this->load->view('templates/footer');
    } else {
      $this->auth->_login();
    }
  }

  public function register()
  {
    // cek apabila sudah login
    if ($this->session->email) {
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
    }

    $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
    $this->form_validation->set_rules('last_name', 'Last name', 'required|trim');
    $this->form_validation->set_rules('province_id', 'Province', 'required|trim');
    $this->form_validation->set_rules('city_id', 'City', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
      'matches' => 'Password dont match',
      'min_length' => 'Password too short'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('auth/register');
      $this->load->view('templates/footer');
    } else {
      $this->auth->register();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Your account has been created!</strong></div>');
      redirect('auth');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('auth');
  }
}
