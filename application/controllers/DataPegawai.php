<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use 


class DataPegawai extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('CRUD');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$data['pegawai']=$this->CRUD->read_pegawai();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('dataPegawai',$data);
		$this->load->view('part/footer.php');
	}

	public function tambahpegawai()
	{
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('formPegawai');
		$this->load->view('part/footer.php');
	}

	

	function tambah(){
		$nama = $this->input->post('nama');
		$id_pegawai = $this->input->post('id_pegawai');
		$pangkat = $this->input->post('pangkat');
		$golongan = $this->input->post('golongan');
		$jabatan = $this->input->post('jabatan');
		$unit_kerja = $this->input->post('unit_kerja');
		
 
		$data = array(
			'nama' => $nama,
			'id_pegawai' => $id_pegawai,
			'pangkat' => $pangkat,
			'golongan' => $golongan,
			'jabatan' => $jabatan,
			'unit_kerja' => $unit_kerja		
			);
		//print_r($data);
		$this->CRUD->input_pegawai($data);
		redirect('DataPegawai/index');
	}

	public function update($id){
	$nama = $this->input->post('nama');
	$id_pegawai = $this->input->post('id_pegawai');
	$pangkat = $this->input->post('pangkat');
	$golongan = $this->input->post('golongan');
	$jabatan = $this->input->post('jabatan');
	$unit_kerja = $this->input->post('unit_kerja');

	$data = array(
		'nama' => $nama,
		'id_pegawai' => $id_pegawai,
		'pangkat' => $pangkat,
		'golongan' => $golongan,
		'jabatan' => $jabatan,
			'unit_kerja' => $unit_kerja
	);

	$this->CRUD->update2_pegawai($id,$data);
	redirect('DataPegawai/index');
}

	public function hapus($id){
		$this->CRUD->hapusm_pegawai($id);
		redirect('DataPegawai/index');
	}	


	
}

?>