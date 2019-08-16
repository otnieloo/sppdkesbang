<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use 


class SuratHasil extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('CRUD');
		$this->load->helper('url');
		$this->load->library('Pdf');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['pegawai'] = $this->CRUD->read_pegawai();
		$data['spt'] = $this->CRUD->mread_spt();
		$data['sppd'] = $this->CRUD->getSppd();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('formLHPD',$data);
		$this->load->view('part/footer.php');
	}

	public function history()
	{
		$data['spt'] = $this->CRUD->mread_spt();
		$data['ringkasan'] = $this->CRUD->mread_ringkasan();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('historyLHPD',$data);
		$this->load->view('part/footer.php');
	}
	

	public function tambahringkasan(){

		//validasi form
		$this->form_validation->set_rules('ringkasan', 'Ringkasan Hasil Kegiatan', 'required');

		$this->form_validation->set_message('required', '%s Masih, Kosong Silahkan Isi');

		if ($this->form_validation->run() == TRUE) {
			$id_laporan = $this->input->post('id_sppd');
			$ringkasan = $this->input->post('ringkasan');
 
			$data = array(
				'id_ringkasan' => '',
				'id_laporan' => $id_laporan,
				'ringkasan' => $ringkasan
				);
			//print_r($data);
			$this->CRUD->minput_ringkasan($data);
			redirect('SuratHasil/index');
		} else {
			echo"gabisa";
			$this->index();
		}
		//validasi form end

		
	}

	public function updateringkasan($id){
		$petugas =  $this->input->post('petugas');
		$tujuan = $this->input->post('tujuan');
		$tgl_berangkat = $this->input->post('tgl_berangkat');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$ringkasan = $this->input->post('ringkasan');
		$pelapor = $this->input->post('pelapor');

		$data = array(
			'petugas' => $petugas,
			'tujuan' => $tujuan,
			'tgl_berangkat' => $tgl_berangkat,
			'tgl_kembali' => $tgl_kembali,
			'ringkasan' => $ringkasan,
			'pelapor' => $pelapor
		);

		$this->CRUD->mupdate_ringkasan($id,$data);
		redirect('SuratHasil/index');
	}

	public function hapus($id){
		$this->CRUD->mhapus_ringkasan($id);
		redirect('SuratHasil/history');
	}	

	public function genLap()
	{
		ob_start();

		$pdf = new Pdf('P','mm','F4',true,'UTF-8',false);

		//preparation
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		//Halaman pertama
		$pdf->AddPage();

		$pdf->setFont('times','U',12); 	
		$pdf->Write(20,'LAPORAN HASIL PERJALANAN DINAS','',false,'C',true);
		$pdf->setFont('times','',12);
		$pdf->Write(10,'Petugas yang melaksanakan perjalanan dinas : ','',false,'L',true);


		for($i=1;$i<=2;$i++){
			$pdf->Cell(5, 0,"",0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,"$i.  ",0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'Nama',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'Emma Hernayati, S.IP',0, 1, '',false,'',0,false,'T','M');

			$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'NIP',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'12312312123',0, 1, '',false,'',0,false,'T','M');

			$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'Jabatan',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'Analisis wawasan kebangsaan',0, 1, '',false,'',0,false,'T','M');

			$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'Unit Kerja',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'Kantor Kesbang dan Linmas Kota Tasikmalaya',0, 1, '',false,'',0,false,'T','M');

			$pdf->Write(5,'','',false,'C',true);
		}

		$pdf->Write(10,'Dengan ini melaporkan hasil perjalanan dinas :','',false,'L',true);

		$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'A. ',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(40, 0,'Tujuan',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,'Ruang Rapat Aula Wiradadaha Lt.2 Bappeda Kab Tasikmalaya',0, 1, '',false,'',0,false,'T','M');

		$pdf->Cell(25, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(40, 0,'Tanggal Berangkat',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,'Senin, 18 Maret 2019',0, 1, '',false,'',0,false,'T','M');

		$pdf->Cell(25, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(40, 0,'Tanggal Kembali',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,'Selasa, 19 Maret 2019',0, 1, '',false,'',0,false,'T','M');

		$pdf->Write(5,'','',false,'L',true);

		$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'B.      Ringkasan Hasil Kegiatan :',0, 1, '',false,'',0,false,'T','M');

		for ($i=1; $i <= 3 ; $i++) { 
			$pdf->Cell(25, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,"$i. ",0, 0, '',false,'',0,false,'T','M');
			$pdf->MultiCell(0, 0, "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit asperiores modi totam velit voluptatibus quod quas, id explicabo tempore impedit!", 0, 'L', false, 1, '', '', true, 0, false, true, 0, 'T', false);
		}

		$pdf->Write(5,'','',false,'L',true);

		$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'C.      Penutup',0, 1, '',false,'',0,false,'T','M');
		$pdf->Cell(25, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->MultiCell(0, 0, "          Demikian laporan perjalanan dinas ini disampaikan agar untuk diketahui. Atas kebijaksanaan Bapak/Ibu diucapkan terima kasih.", 0, 'L', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		$pdf->Write(10,'','',false,'L',true);

		$pdf->Cell(140, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'Pelapor',0, 1, '',false,'',0,false,'T','M');

		$pdf->Write(20,'','',false,'L',true);

		$pdf->setFont('times','U',12);
		$pdf->Cell(120, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'EMMA HERMAYATI, S. IP',0, 1, '',false,'',0,false,'T','M');

		$pdf->setFont('times','',12);
		$pdf->Cell(120, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'NIP 12313121312',0, 1, '',false,'',0,false,'T','M');		

		$pdf->Output('output/contoh.pdf','I');
	}
	
}

?>