<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use 


class index extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('CRUD');
		$this->load->helper('url');
		
	}


	public function index()
	{
		$data['t_pegawai'] = $this->CRUD->totalpegawai();
		$data['t_sppd'] = $this->CRUD->totalsppd();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('index',$data);
		$this->load->view('part/footer.php');
	}
	
}

?>