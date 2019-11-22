<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends CI_Controller{
  public function index(){
    $this->load->view('templates/header');
    $this->load->view('m-page/ongkir');
    $this->load->view('templates/footer');
  }

  public function get_provinsi(){
    $provinces = $this->rajaongkir->province();
    $this->output->set_content_type('application/json')->set_output($provinces);
  }

  public function get_kota($id_provinsi){
    $kota = $this->rajaongkir->city($id_provinsi);
    $this->output->set_content_type('application/json')->set_output($kota);
  }

  public function get_biaya($asal, $tujuan, $berat, $kurir){
    $ongkir = $this->rajaongkir->cost($asal, $tujuan, $berat, $kurir);
    $this->output->set_content_type('application/json')->set_output($ongkir);
  }
}