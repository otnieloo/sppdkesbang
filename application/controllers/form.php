<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    
    $this->load->model('CHAIN');
    $this->load->model('CRUD');
  }

  public function index(){
    $data['sppd'] = $this->CRUD->getSppd();
    $this->load->view('coba', $data);

  }
  
  public function listKota(){
    // Ambil data ID Provinsi yang dikirim via ajax post
    $id_sppd = $this->input->post('id_sppd');
    
    $kota = $this->CHAIN->viewByProvinsi($id_sppd);
    
    // Buat variabel untuk menampung tag-tag option nya
    // Set defaultnya dengan tag option Pilih
    $lists = "<option value=''>Pilih</option>";
    
    foreach($kota as $data){
      $lists .= "<option value='".$data->id_sppd."'>".$data->pejabat."</option>"; // Tambahkan tag option ke variabel $lists
    }
    
    $callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }
}