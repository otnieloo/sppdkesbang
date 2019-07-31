<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use 


class DataAnggaran extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('CRUD');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['anggaran']=$this->CRUD->mread_anggaran();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('dataAnggaran',$data);
		$this->load->view('part/footer.php');
	}
	
	public function tambahanggaran()
	{
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('tambahanggaran');
		$this->load->view('part/footer.php');
	}


	public function tambah(){
		$kode_anggaran = $this->input->post('kode_anggaran');
		$uraian = $this->input->post('uraian');
		//$lokasi = $this->input->post('lokasi');
		//$target_kinerja = $this->input->post('target_kinerja');
		//$sumber_dana = $this->input->post('sumber_dana');
		
 
		$data = array(
			'id_anggaran' => '',
			'kode_anggaran' => $kode_anggaran,
			'uraian' => $uraian,
			//'lokasi' => $lokasi,
			//'target_kinerja' => $target_kinerja,
			//'sumber_dana' => $sumber_dana
			);
		//print_r($data);
		$this->CRUD->minput_anggaran($data);
		redirect('DataAnggaran/index');
	}

	public function update($id){
		$kode_anggaran =  $this->input->post('kode_anggaran');
		$uraian = $this->input->post('uraian');
		//$lokasi = $this->input->post('lokasi');
		//$target_kinerja = $this->input->post('target_kinerja');
		//$sumber_dana = $this->input->post('sumber_dana');

		$data = array(
			'kode_anggaran' => $kode_anggaran,
			'uraian' => $uraian
			//'lokasi' => $lokasi,
			//'target_kinerja' => $target_kinerja,
			//'sumber_dana' => $sumber_dana
		);

		$this->CRUD->mupdate_anggaran($id,$data);
		redirect('DataAnggaran/index');
	}

	public function hapus($id){
		$this->CRUD->mhapus_anggaran($id);
		redirect('DataAnggaran/index');
	}	
	
}

?>