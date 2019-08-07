<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use 


class SuratPerintah extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('CRUD');
		$this->load->helper('url');
		$this->load->library('Pdf');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('CHAIN');
	}

	public function index()
	{
		$data['pegawai'] = $this->CRUD->read_pegawai();
		$data['sppd'] = $this->CRUD->getSppd();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('formSP',$data);
		$this->load->view('part/footer.php');
	}

	public function history()
	{
		$data['spt'] = $this->CRUD->mread_spt();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('historySP',$data);
		$this->load->view('part/footer.php');
	}
	



	public function tambahSP(){
		$id_sppd = $this->input->post('id_sppd');
		$no_spt = $this->input->post('no_spt');
		$dasar = $this->input->post('dasar');
		$tanggal_surat =  $this->input->post('tanggal_surat');
		$untuk = $this->input->post('untuk');
		
		
 
		$data = array(
			'id_spt' => '',
			'id_sppd' => $id_sppd,
			'no_spt' => $no_spt,
			'dasar' => $dasar,
			'untuk' => $untuk,
			'tanggal_surat' => $tanggal_surat		
			);
		//print_r($data);
		// $this->CRUD->minput_spt($data);
		$this->genSPT($id_sppd,$no_spt,$dasar,$untuk,$tanggal_surat);
		//redirect('Suratspt/index');
	}


	public function hapus($id){
		$this->CRUD->mhapus_spt($id);
		redirect('SuratPerintah/history');
	}

	public function genSPT() {
		ob_start();

		$pdf = new Pdf('P','mm','F4',true,'UTF-8',false);

		//preparation
		$image_file = base_url("assets/img/logo-kesbang.jpg");
		

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		//Halaman pertama
		$pdf->AddPage();

		$pdf->setFont('times','B',14);

		//Header
		$header = <<<EOD
      <p><span>PEMERINTAH KABUPATEN TASIKMALAYA</span>
      	<br><span style="font-size: 16sp;">KANTOR KESATUAN BANGSA DAN LINMAS</span>
      	<br><span style="font-size: 11sp;">Jalan Pemuda No. 1 Tasikmalaya, Kode Pos 46113</span>
      	<br><span style="font-size: 11sp;">Telp.  (0265) 336438 Fax (0265) 336436</span>
      </p>
EOD;

		$header = <<<EOD
      <table>
		<tr>
			<th>Nama</th>
			<th>NIP</th>
			<th>Pangkat/Gol</th>
			<th>Jabatan</th>
		</tr>
      </table>
EOD;

		//logo
		$pdf->Image($image_file, 20, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
		$tagvs = array('p' => array(0 => array('h' => 0, 'n' => 2), 1 => array('h' => 1.3, 'n' => 10)));

		$pdf->writeHTMLCell(0, 0, 45, 10, $header, 0, 1, 0, true, 'C', true);
		$pdf->Line(15,37.5,190,37.5,array(
			'width' => 1.2
		));

		$pdf->Write(10,'','',false,'C',true);

		//judul surat
		$pdf->setFont('times','B',14);
		$pdf->Write(0,'SURAT PERINTAH TUGAS','',false,'C',true);
		$pdf->Line(73,51.5,136,51.5,array(
			'width' => 0.5
		));

		//nomor surat
		$pdf->setFont('times','',12);
		$pdf->Write(0,'NOMOR    800      /III/KBL/2019','',false,'C',true);

		$pdf->Write(15,'','',false,'C',true);

		//dasar surat
		$pdf->setFont('times','B',12);
		$pdf->Cell(10, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(25, 0,'Dasar',0, 0, '',false,'',0,false,'T','M');
		$pdf->setFont('times','',12);
		$pdf->Cell(10, 0,':',0, 0, '',false,'',0,false,'T','M');
		$pdf->MultiCell(0, 0, "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas non quaerat iste modi architecto hic, impedit assumenda recusandae voluptatum provident nulla facilis molestiae voluptate placeat praesentium, accusamus libero nesciunt. Dolores.", 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		$pdf->setFont('times','B',12);
		$pdf->Write(20,'MEMERINTAHKAN','',false,'C',true);
		
		//pengikut
		$pdf->setFont('times','B',12);
		$pdf->Cell(10, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(25, 0,'Kepada',0, 0, '',false,'',0,false,'T','M');
		$pdf->setFont('times','',12);
		$pdf->Cell(10, 0,':',0, 0, '',false,'',0,false,'T','M');
		
		for($i=1;$i<=4;$i++){
			if ($i!=1) {
				$pdf->Cell(45, 0,'',0, 0, '',false,'',0,false,'T','M');
			}

			$pdf->Cell(5, 0,"$i.  ",0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'Nama',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'Emma Hernayati, S.IP',0, 1, '',false,'',0,false,'T','M');

			$pdf->Cell(50, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'NIP',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'12312312123',0, 1, '',false,'',0,false,'T','M');

			$pdf->Cell(50, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'Pangkat/Gol',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'Penata Tk. I, III/d',0, 1, '',false,'',0,false,'T','M');

			$pdf->Cell(50, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(25, 0,'Jabatan',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(10, 0,'Analisis wawasan kebangsaan',0, 1, '',false,'',0,false,'T','M');

			$pdf->Write(5,'','',false,'C',true);
		}

		//untuk
		$pdf->setFont('times','B',12);
		$pdf->Cell(10, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(25, 0,'Untuk',0, 0, '',false,'',0,false,'T','M');
		$pdf->setFont('times','',12);
		$pdf->Cell(10, 0,':',0, 0, '',false,'',0,false,'T','M');
			
		$pdf->Cell(5, 0,'1.  ',0, 0, '',false,'',0,false,'T','M');
		$pdf->MultiCell(0, 0, "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas non quaerat iste modi architecto hic, impedit assumenda recusandae voluptatum provident nulla facilis molestiae voluptate placeat praesentium, accusamus libero nesciunt. Dolores.", 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'T', false);	

		$pdf->Cell(45, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,'2.  ',0, 0, '',false,'',0,false,'T','M');
		$pdf->MultiCell(0, 0, "Demikian Surat Perintah ini agar dilaksanakan dengan penuh rasa tanggungjawab serta melaporkan hasilnya kepada pemberi tugas", 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		$pdf->Write(10,'','',false,'C',true);

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(40, 0,"Ditetapkan di    : Tasikmalaya",0, 1, 'L',false,'',0,false,'T','C');//Tiba kembali di

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(40, 0,"Pada tanggal     : 28 Mei 2016",0, 1, 'L',false,'',0,false,'T','C');// Tanggal kembali
		$pdf->Write(10,'','',false,'C',true);

		$pdf->Cell(90, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(100, 0, "KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN TASIKMALAYA", 0, 'C', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		$pdf->setFont('times','U',12);
		$pdf->Write(12,'','',false,'C',true);
		$pdf->Cell(120, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Iwan Ridwan, S.IP",0, 1, 'L',false,'',0,false,'T','C');//Kepala kantor

		$pdf->setFont('times','',12);
		$pdf->Cell(125, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Pembina Tk. 1",0, 1, 'L',false,'',0,false,'T','C');//Pangkat kepala

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"NIP.19641201 198603 1 013",0, 1, 'L',false,'',0,false,'T','C');//Nip kepala

		$pdf->Output('output/contoh.pdf','I');
	}
	
}

?>