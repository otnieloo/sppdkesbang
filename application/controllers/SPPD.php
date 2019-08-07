<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use 


class SPPD extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('CRUD');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['pegawai'] = $this->CRUD->read_pegawai();
		$data['anggaran'] = $this->CRUD->mread_anggaran();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('formSPPD',$data);
		$this->load->view('part/footer.php');
	}

	public function history()
	{
		$data['sppd'] = $this->CRUD->getSppd();
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('historySPPD',$data);
		$this->load->view('part/footer.php');
	}

	public function createExcel()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1','Hello World!');

		$writer = new Xlsx($spreadsheet);

		$filename = 'contoh';

		// echo base_url();

		// header('Content-Type: application/vnd.ms-excel');
		// header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		// header('Cache-Control: max-age=0');

		$writer->save('output/'.$filename.'.xlsx');
	}

	public function editExcel()
	{	
		$path = FCPATH.'output/kesbang.xlsx';
		$file = PhpOffice\PhpSpreadsheet\IOFactory::load($path);
		$sheet = $file->getActiveSheet();

		// $sheet->getFont()->setName('calibri');
		// $sheet->getFont()->setSize(11);

		$sheet->setCellValue('A9',"TES TES TES");
		$start = 'A'.$sheet->getHighestRow()+1;
		$sheet->setCellValue($start,"KANTOR KESATUAN BANGSA DAN LINMAS ");
		// $sheet->setCellValue('A5',"TAHUN 2018");

		$writer = new Xlsx($file);
		$writer->save('output/kesbang.xlsx');
	}

	public function createPdf($kode_sppd,$no_sppd,$pejabat,$nama_pegawai,$pg_pangkat,$pg_jabatan,$pg_golongan,$tingkat,$maksud,$alat_angkut,$tempat_berangkat,$tempat_tujuan,$lama_dinas,$tgl_berangkat,$tgl_kembali,$id_pengikut,$beban_anggaran,$instansi,$id_anggaran,$keterangan)
	{
		$this->load->library('Pdf');

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
		
		$text1 = <<<EOD
		<table>
			<tr>
				<td>Lembar Ke</td>
				<td>:</td>
				<td></td> 
			</tr>
			<tr>
				<td>Kode No</td>
 				<td>:</td>
				<td>$kode_sppd</td>
			</tr>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>$no_sppd</td>
			</tr>
		</table>

EOD;

		$pdf->Image($image_file, 20, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
		$tagvs = array('p' => array(0 => array('h' => 0, 'n' => 2), 1 => array('h' => 1.3, 'n' => 10)));

		$pdf->setHtmlVSpace($tagvs);
		$pdf->writeHTMLCell(0, 0, 45, 10, $header, 0, 1, 0, true, 'C', true);
		$pdf->Line(15,37.5,190,37.5,array(
			'width' => 1.2
		));

		$pdf->setFont('times','',11);
		$pdf->writeHTMLCell(0, 0, 120, 45, $text1, 0, 1, 0, true, '', true);//print variabel

		//Judul Utama
		$pdf->setFont('times','B',14);
		$pdf->Write(10,'SURAT PERINTAH PERJALANAN DINAS','',false,'C',true);
		$pdf->Line(57,67.5,153,67.5,array(
			'width' => 0.7
		));
		$pdf->Write(0,'(SPPD)','',false,'C',true);
		$pdf->Write(5,'','',false,'C',true);

		$pdf->setFont('times','',11);

		$pdf->Line(10,82,190,82,array(
			'width' => 0.2
		));

		//
		$pdf->Cell(95, 0,'1.    Pejabat berwenang yang memberi perintah',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$pejabat,0, 1, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"KABUPATEN TASIKMALAYA",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,91.5,190,91.5,array(
			'width' => 0.2
		));

		//Pegawai yang diperintah
		$pdf->Cell(95, 0,'2.    Nama pegawai yang diperintah',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$nama_pegawai,0, 1, 'L',false,'',0,false,'T','C');//Nama pegawai
		$pdf->Cell(95, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');//NIP

		$pdf->Line(10,101.5,190,101.5,array(
			'width' => 0.2
		));

		//Pangkat dan golongan
		$pdf->Cell(95, 0,'3.    a.   Pangkat dan Golongan menurut PP no 11',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0, $pg_pangkat,",",$pg_golongan ,0, 1, 'L',false,'',0,false,'T','C');//Pangkat 
		$pdf->Cell(95, 0,"             Tahun 2011",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,111,190,111,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'       b.   Jabatan/Instansi',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$pg_jabatan,0, 1, 'L',false,'',0,false,'T','C');//Jabatan
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,120.5,190,120.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'       c.   Tingkat menurut peraturan perjalanan',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$tingkat,0, 1, 'L',false,'',0,false,'T','C');//
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,130.5,190,130.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'4.   Maksud Perjalanan Dinas',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$maksud,0, 1, 'L',false,'',0,false,'T','C');//Maksud perjalanan dinas (MultiCell)
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"Tasikmalaya di Pendopo Baru",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,140.5,190,140.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'5.   Alat angkut yang dipergunakan',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$alat_angkut,0, 1, 'L',false,'',0,false,'T','C');//Alat angkut
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(100,154.5,190,154.5,array(
			'width' => 0.2
		));
		$pdf->Line(10,150,190,150,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'6.     a.    Tempat Berangkat',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$tempat_berangkat,0, 1, 'L',false,'',0,false,'T','C');//Tempat berangkat
		$pdf->Cell(95, 0,"        b.    Tempat Tujuan",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$tempat_tujuan,0, 1, 'L',false,'',0,false,'T','C');//Tujuan

		$pdf->Line(100,164.5,190,164.5,array(
			'width' => 0.2
		));
		$pdf->Line(100,169.5,190,169.5,array(
			'width' => 0.2
		));
		$pdf->Line(10,160,190,160,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'7.     a.    Lamanya Perjalanan Dinas',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$lama_dinas,0, 1, 'L',false,'',0,false,'T','C');//Lama perjalanan
		$pdf->Cell(95, 0,"        b.    Tanggal berangkat",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$tgl_berangkat,0, 1, 'L',false,'',0,false,'T','C');//Tanggal berangkat
		$pdf->Cell(95, 0,"        c.    Tanggal harus kembali",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$tgl_kembali,0, 1, 'L',false,'',0,false,'T','C');//Tanggal kembali

		$pdf->Line(10,174.5,190,174.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'8.   Pengikut',0, 0, '',false,'',0,false,'T','M');
		foreach ($id_pengikut as $key => $p) {
			$pdf->Cell(95, 0, $p,0, 1, 'L',false,'',0,false,'T','C');//Pengikut
			$pdf->Cell(95, 0,"NIP.",0,	 0, 'L',false,'',0,false,'T','C'); 
		}
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(100,193.5,190,193.5,array(
			'width' => 0.2
		));
		$pdf->Line(10,184,190,184,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'9.   Pembebanan Anggaran',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"      a.   Instansi",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$instansi,0, 1, 'L',false,'',0,false,'T','C');//Instansi pembebanan anggaran
		$pdf->Cell(95, 0,"      b.   Mata Anggaran",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$id_anggaran,0, 1, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"1.19.1.19.01. 15.05.5.2.2.15.01",0, 1, 'L',false,'',0,false,'T','C');//Mata anggaran

		$pdf->Line(10,203,190,203,array(
			'width' => 0.2
		));
		$pdf->Line(10,210,190,210,array(
			'width' => 0.2
		));

		$pdf->Cell(95, 0,'10.  Keterangan Lain-lain',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$keterangan,0, 1, 'L',false,'',0,false,'T','C');//Keterangan
		$pdf->Cell(95, 0,"",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(100,82,100,210,array(
			'width' => 0.2
		));

		$pdf->Write(5,'','',false,'C',true);

		$pdf->Cell(105, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"Dikeluarkan di : ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"Tasikmalaya",0, 1, 'L',false,'',0,false,'T','C');//Di keluarkan dimana	

		$pdf->Cell(105, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"Pada tanggal    : ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"28 Mei 2016",0, 1, 'L',false,'',0,false,'T','C');	//Pada tanggal
		
		$pdf->Write(5,'','',false,'C',true);		
		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(100, 0, "KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN TASIKMALAYA", 0, 'C', false, 1, '', '', true, 0, false, true, 0, 'T', false);


		$image_file = base_url("assets/img/ttd.jpg");
		$pdf->Image($image_file, 120, 245, 45, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$pdf->setFont('times','U',12);
		$pdf->Write(12,'','',false,'C',true);
		$pdf->Cell(115, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Iwan Ridwan, S.IP",0, 1, 'L',false,'',0,false,'T','C');//Nama kepala kantor

		$pdf->setFont('times','',12);
			$pdf->Cell(118, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Pembina Tk. 1",0, 1, 'L',false,'',0,false,'T','C');//Pangkat kepala kantor

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"NIP.19641201 198603 1 013",0, 1, 'L',false,'',0,false,'T','C');//Nip kepala kantor

		$pdf->AddPage('P',array(210,330));

		$pdf->setFont('times','',11);
		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"SPPD No",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"1200",0, 1, 'L',false,'',0,false,'T','C');//Nomor SPPD	

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"Berangkat dari",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"Tasikmalaya",0, 1, 'L',false,'',0,false,'T','C');//Berangkat dari

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"(Tempat Kedudukan)",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"Kantor Kesbang dan Linmas",0, 1, 'L',false,'',0,false,'T','C');//Tempat kedudukan

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"Pada tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"28 Mei 2016",0, 1, 'L',false,'',0,false,'T','C');//Tanggal berangkat

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"Ke",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"Kec. Singaparna",0, 1, 'L',false,'',0,false,'T','C');//Tujuan berangkat

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"Pejabat Pelaksana Teknis Kegiatan,",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Write(17,'','',false,'C',true);

		$pdf->setFont('times','U',11);
		$pdf->Cell(123, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"SUPARTO, S.IP",0, 1, 'L',false,'',0,false,'T','C');//Pejabat pelaksana

		$pdf->setFont('times','',11);
		$pdf->Cell(115, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"NIP. 196107081985031009",0, 1, 'L',false,'',0,false,'T','C');//Nip pelaksana

		$pdf->Write(5,'','',false,'C',true);

		$pdf->Line(10,65,200,65,array(
			'width' => 0.2
		));

		$pdf->Cell(40, 0,"II.     Tiba di",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Berangkat dari   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"         Pada Tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Ke             ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"                   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"                                    ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Pada tanggal              ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Write(20,'','',false,'C',true);
		$pdf->setFont('times','U',11);
		$pdf->Cell(8, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"(............................................................................)",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"(............................................................................)",0, 1, 'L',false,'',0,false,'T','C');
		$pdf->setFont('times','',11);
		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"NIP. ",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"NIP. ",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,105,200,105,array(
			'width' => 0.2
		));

		$pdf->setFont('times','',11);

		$pdf->Cell(40, 0,"III.     Tiba di",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Berangkat dari   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"         Pada Tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Ke             ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"                   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"                                    ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Pada tanggal              ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->setFont('times','U',11);

		$pdf->Write(20,'','',false,'C',true);
		
		$pdf->Cell(8, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"(............................................................................)",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"(............................................................................)",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->setFont('times','',11);
		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"NIP. ",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"NIP. ",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,145,200,145,array(
			'width' => 0.2
		));

		$pdf->setFont('times','',11);

		$pdf->Cell(40, 0,"IV.     Tiba di",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Berangkat dari   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"         Pada Tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Ke             ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"                   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"                                    ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Pada tanggal              ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Write(20,'','',false,'C',true);
		$pdf->setFont('times','U',11);
		$pdf->Cell(8, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"(............................................................................)",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"(............................................................................)",0, 1, 'L',false,'',0,false,'T','C');
		$pdf->setFont('times','',11);
		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"NIP. ",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"NIP. ",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Write(5,'','',false,'C',true);

		$pdf->Line(10,188.5,200,188.5,array(
			'width' => 0.2
		));

		$pdf->Cell(90, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(10, 0,"V.",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(40, 0,"Tiba kembali di (tempat kedudukan) : Tasikmalaya",0, 1, 'L',false,'',0,false,'T','C');//Tiba kembali di

		$pdf->Cell(100, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(40, 0,"Pada tanggal :   28 Mei 2016",0, 1, 'L',false,'',0,false,'T','C');// Tanggal kembali
		
		$pdf->Write(5,'','',false,'C',true);
		$pdf->Cell(100, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(80, 0, "Telah diperiksa, dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata – mata untuk kepentingan Jabatan dalam waktu sesingkat – singkatnya", 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'T', false);
		$pdf->Write(5,'','',false,'C',true);

		$pdf->Cell(90, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(100, 0, "KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN TASIKMALAYA", 0, 'C', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		$image_file = base_url("assets/img/ttd.jpg");//Tanda tangan
		$pdf->Image($image_file, 125, 240, 45, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$pdf->setFont('times','U',12);
		$pdf->Write(12,'','',false,'C',true);
		$pdf->Cell(120, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Iwan Ridwan, S.IP",0, 1, 'L',false,'',0,false,'T','C');//Kepala kantor

		$pdf->setFont('times','',12);
		$pdf->Cell(125, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Pembina Tk. 1",0, 1, 'L',false,'',0,false,'T','C');//Pangkat kepala

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"NIP.19641201 198603 1 013",0, 1, 'L',false,'',0,false,'T','C');//Nip kepala

		$pdf->Line(10,268,200,268,array(
			'width' => 0.2
		));

		$pdf->Cell(10, 0,"VI.",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"CATATAN LAIN-LAIN",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,273,200,273,array(
			'width' => 0.2
		));

		$pdf->Cell(10, 0,"VII.",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"PERHATIAN",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(180, 0, "Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggungjawab berdasarkan peraturan – peraturan  Keuangan Negara apabila Negara mendapat rugi akibat kesalahan, kealpaannya.", 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		//output
		$pdf->Output('output/contoh.pdf','I');
	}

	public function cetakPdf($id)
	{
		$data = $this->CRUD->getSppd($id);
		$pejabat = $data[0]['pejabat'];
		$id_pegawai = $data[0]['id_pegawai'];
		$maksud = $data[0]['maksud'];
		$alat_angkut = $data[0]['alat_angkut'];
		$tempat_berangkat = $data[0]['tempat_berangkat'];
		$tempat_tujuan = $data[0]['tempat_tujuan'];
		$lama_dinas = $data[0]['lama_dinas'];
		$tgl_berangkat = $data[0]['tgl_berangkat'];
		$tgl_kembali = $data[0]['tgl_kembali'];
		$id_pengikut = $data[0]['id_pengikut'];
		$instansi = $data[0]['instansi'];
		$id_anggaran = $data[0]['id_anggaran'];
		$keterangan = $data[0]['keterangan'];
		$no_sppd = $data[0]['no_sppd'];
		$kode_sppd = $data[0]['kode_sppd'];
		$tingkat = $data[0]['tingkat'];

		$data2 = $this->CRUD->mread_anggaran($id_anggaran);
		$data3 = $this->CRUD->read_pegawai($id_pegawai);
		$pangkat = $data3[0]['pangkat'];
		$golongan = $data3[0]['golongan'];
		$jabatan = $data3[0]['jabatan'];
		$nama_pegawai = $data3[0]['nama'];
		$id_pengikut = explode(',', $id_pengikut);
		foreach ($id_pengikut as $key => $pengikut) {
			echo "$p$key => $pengikut";
			# code...
		}
		$kode_anggaran = $data2[0]['kode_anggaran'];

		$this->load->library('Pdf');

		ob_start();

		$pdf = new Pdf('P','mm','F4',true,'UTF-8',false);

		//preparation
		$image_file = base_url("assets/images/logo-kesbang.jpg");
		

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
		
		$text1 = <<<EOD
		<table>
			<tr>
				<td>Lembar Ke</td>
				<td>:</td>
				<td></td> 
			</tr>
			<tr>
				<td>Kode No</td>
 				<td>:</td>
				<td>$kode_sppd</td>
			</tr>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>$no_sppd</td>
			</tr>
		</table>

EOD;

		$pdf->Image($image_file, 20, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
		$tagvs = array('p' => array(0 => array('h' => 0, 'n' => 2), 1 => array('h' => 1.3, 'n' => 10)));

		$pdf->setHtmlVSpace($tagvs);
		$pdf->writeHTMLCell(0, 0, 45, 10, $header, 0, 1, 0, true, 'C', true);
		$pdf->Line(15,37.5,190,37.5,array(
			'width' => 1.2
		));

		$pdf->setFont('times','',11);
		$pdf->writeHTMLCell(0, 0, 120, 45, $text1, 0, 1, 0, true, '', true);//print variabel

		//Judul Utama
		$pdf->setFont('times','B',14);
		$pdf->Write(10,'SURAT PERINTAH PERJALANAN DINAS','',false,'C',true);
		$pdf->Line(57,67.5,153,67.5,array(
			'width' => 0.7
		));
		$pdf->Write(0,'(SPPD)','',false,'C',true);
		$pdf->Write(5,'','',false,'C',true);

		$pdf->setFont('times','',11);

		$pdf->Line(10,82,190,82,array(
			'width' => 0.2
		));

		//
		$pdf->Cell(95, 0,'1.    Pejabat berwenang yang memberi perintah',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$pejabat,0, 1, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"KABUPATEN TASIKMALAYA",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,91.5,190,91.5,array(
			'width' => 0.2
		));

		//Pegawai yang diperintah
		$pdf->Cell(95, 0,'2.    Nama pegawai yang diperintah',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$nama_pegawai,0, 1, 'L',false,'',0,false,'T','C');//Nama pegawai
		$pdf->Cell(95, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');//NIP

		$pdf->Line(10,101.5,190,101.5,array(
			'width' => 0.2
		));

		//Pangkat dan golongan
		$pdf->Cell(95, 0,'3.    a.   Pangkat dan Golongan menurut PP no 11',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$pangkat,0, 1, 'L',false,'',0,false,'T','C');//Pangkat
		$pdf->Cell(95, 0,"             Tahun 2011",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,111,190,111,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'       b.   Jabatan/Instansi',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$jabatan,0, 1, 'L',false,'',0,false,'T','C');//Jabatan
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,120.5,190,120.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'       c.   Tingkat menurut peraturan perjalanan',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$tingkat,0, 1, 'L',false,'',0,false,'T','C');//
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,130.5,190,130.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'4.   Maksud Perjalanan Dinas',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$maksud,0, 1, 'L',false,'',0,false,'T','C');//Maksud perjalanan dinas (MultiCell)
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"Tasikmalaya di Pendopo Baru",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,140.5,190,140.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'5.   Alat angkut yang dipergunakan',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$alat_angkut,0, 1, 'L',false,'',0,false,'T','C');//Alat angkut
		$pdf->Cell(95, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(100,154.5,190,154.5,array(
			'width' => 0.2
		));
		$pdf->Line(10,150,190,150,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'6.     a.    Tempat Berangkat',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$tempat_berangkat,0, 1, 'L',false,'',0,false,'T','C');//Tempat berangkat
		$pdf->Cell(95, 0,"        b.    Tempat Tujuan",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$tempat_tujuan,0, 1, 'L',false,'',0,false,'T','C');//Tujuan

		$pdf->Line(100,164.5,190,164.5,array(
			'width' => 0.2
		));
		$pdf->Line(100,169.5,190,169.5,array(
			'width' => 0.2
		));
		$pdf->Line(10,160,190,160,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'7.     a.    Lamanya Perjalanan Dinas',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$lama_dinas,0, 1, 'L',false,'',0,false,'T','C');//Lama perjalanan
		$pdf->Cell(95, 0,"        b.    Tanggal berangkat",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$tgl_berangkat,0, 1, 'L',false,'',0,false,'T','C');//Tanggal berangkat
		$pdf->Cell(95, 0,"        c.    Tanggal harus kembali",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$tgl_kembali,0, 1, 'L',false,'',0,false,'T','C');//Tanggal kembali

		$pdf->Line(10,174.5,190,174.5,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'8.   Pengikut',0, 0, '',false,'',0,false,'T','M');
	
			$pdf->Cell(95, 0,$pengikut,0, 1, 'L',false,'',0,false,'T','C');//Pengikut
		$pdf->Cell(95, 0,"NIP",0,	 0, 'L',false,'',0,false,'T','C');
		
		
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(100,193.5,190,193.5,array(
			'width' => 0.2
		));
		$pdf->Line(10,184,190,184,array(
			'width' => 0.2
		));
		$pdf->Cell(95, 0,'9.   Pembebanan Anggaran',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"      a.   Instansi",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$instansi,0, 1, 'L',false,'',0,false,'T','C');//Instansi pembebanan anggaran
		$pdf->Cell(95, 0,"      b.   Mata Anggaran",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,$kode_anggaran,0, 1, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"1.19.1.19.01. 15.05.5.2.2.15.01",0, 1, 'L',false,'',0,false,'T','C');//Mata anggaran

		$pdf->Line(10,203,190,203,array(
			'width' => 0.2
		));
		$pdf->Line(10,210,190,210,array(
			'width' => 0.2
		));

		$pdf->Cell(95, 0,'10.  Keterangan Lain-lain',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(95, 0,$keterangan,0, 1, 'L',false,'',0,false,'T','C');//Keterangan
		$pdf->Cell(95, 0,"",0,	 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(95, 0,"",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(100,82,100,210,array(
			'width' => 0.2
		));

		$pdf->Write(5,'','',false,'C',true);

		$pdf->Cell(105, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"Dikeluarkan di : ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"Tasikmalaya",0, 1, 'L',false,'',0,false,'T','C');//Di keluarkan dimana	

		$pdf->Cell(105, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"Pada tanggal    : ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(35, 0,"28 Mei 2016",0, 1, 'L',false,'',0,false,'T','C');	//Pada tanggal
		
		$pdf->Write(5,'','',false,'C',true);		
		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(100, 0, "KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN TASIKMALAYA", 0, 'C', false, 1, '', '', true, 0, false, true, 0, 'T', false);


		$image_file = base_url("assets/img/ttd.jpg");
		$pdf->Image($image_file, 120, 245, 45, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$pdf->setFont('times','U',12);
		$pdf->Write(12,'','',false,'C',true);
		$pdf->Cell(115, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Iwan Ridwan, S.IP",0, 1, 'L',false,'',0,false,'T','C');//Nama kepala kantor

		$pdf->setFont('times','',12);
			$pdf->Cell(118, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Pembina Tk. 1",0, 1, 'L',false,'',0,false,'T','C');//Pangkat kepala kantor

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"NIP.19641201 198603 1 013",0, 1, 'L',false,'',0,false,'T','C');//Nip kepala kantor

		$pdf->AddPage('P',array(210,330));

		$pdf->setFont('times','',11);
		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"SPPD No",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"1200",0, 1, 'L',false,'',0,false,'T','C');//Nomor SPPD	

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"Berangkat dari",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"Tasikmalaya",0, 1, 'L',false,'',0,false,'T','C');//Berangkat dari

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"(Tempat Kedudukan)",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"Kantor Kesbang dan Linmas",0, 1, 'L',false,'',0,false,'T','C');//Tempat kedudukan

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"Pada tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"28 Mei 2016",0, 1, 'L',false,'',0,false,'T','C');//Tanggal berangkat

		$pdf->Cell(85, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(45, 0,"Ke",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,"Kec. Singaparna",0, 1, 'L',false,'',0,false,'T','C');//Tujuan berangkat

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"Pejabat Pelaksana Teknis Kegiatan,",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Write(17,'','',false,'C',true);

		$pdf->setFont('times','U',11);
		$pdf->Cell(123, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"SUPARTO, S.IP",0, 1, 'L',false,'',0,false,'T','C');//Pejabat pelaksana

		$pdf->setFont('times','',11);
		$pdf->Cell(115, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"NIP. 196107081985031009",0, 1, 'L',false,'',0,false,'T','C');//Nip pelaksana

		$pdf->Write(5,'','',false,'C',true);

		$pdf->Line(10,65,200,65,array(
			'width' => 0.2
		));

		$pdf->Cell(40, 0,"II.     Tiba di",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Berangkat dari   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"         Pada Tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Ke             ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"                   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"                                    ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Pada tanggal              ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Write(20,'','',false,'C',true);
		$pdf->setFont('times','U',11);
		$pdf->Cell(8, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"(............................................................................)",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"(............................................................................)",0, 1, 'L',false,'',0,false,'T','C');
		$pdf->setFont('times','',11);
		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"NIP. ",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"NIP. ",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,105,200,105,array(
			'width' => 0.2
		));

		$pdf->setFont('times','',11);

		$pdf->Cell(40, 0,"III.     Tiba di",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Berangkat dari   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"         Pada Tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Ke             ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"                   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"                                    ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Pada tanggal              ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->setFont('times','U',11);

		$pdf->Write(20,'','',false,'C',true);
		
		$pdf->Cell(8, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"(............................................................................)",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"(............................................................................)",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->setFont('times','',11);
		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"NIP. ",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"NIP. ",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,145,200,145,array(
			'width' => 0.2
		));

		$pdf->setFont('times','',11);

		$pdf->Cell(40, 0,"IV.     Tiba di",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Berangkat dari   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"         Pada Tanggal",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Ke             ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"                   ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0," ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(50, 0,"                                    ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Cell(40, 0,"Pada tanggal              ",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,":",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(30, 0,".........................................",0, 0, 'L',false,'',0,false,'T','C');

		$pdf->Write(20,'','',false,'C',true);
		$pdf->setFont('times','U',11);
		$pdf->Cell(8, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"(............................................................................)",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"(............................................................................)",0, 1, 'L',false,'',0,false,'T','C');
		$pdf->setFont('times','',11);
		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(92, 0,"NIP. ",0, 0, 'L',false,'',0,false,'T','C');
		
		$pdf->Cell(40, 0,"NIP. ",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Write(5,'','',false,'C',true);

		$pdf->Line(10,188.5,200,188.5,array(
			'width' => 0.2
		));

		$pdf->Cell(90, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(10, 0,"V.",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(40, 0,"Tiba kembali di (tempat kedudukan) : Tasikmalaya",0, 1, 'L',false,'',0,false,'T','C');//Tiba kembali di

		$pdf->Cell(100, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(40, 0,"Pada tanggal :   28 Mei 2016",0, 1, 'L',false,'',0,false,'T','C');// Tanggal kembali
		
		$pdf->Write(5,'','',false,'C',true);
		$pdf->Cell(100, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(80, 0, "Telah diperiksa, dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata – mata untuk kepentingan Jabatan dalam waktu sesingkat – singkatnya", 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'T', false);
		$pdf->Write(5,'','',false,'C',true);

		$pdf->Cell(90, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(100, 0, "KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN TASIKMALAYA", 0, 'C', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		$image_file = base_url("assets/img/ttd.jpg");//Tanda tangan
		$pdf->Image($image_file, 125, 240, 45, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$pdf->setFont('times','U',12);
		$pdf->Write(12,'','',false,'C',true);
		$pdf->Cell(120, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Iwan Ridwan, S.IP",0, 1, 'L',false,'',0,false,'T','C');//Kepala kantor

		$pdf->setFont('times','',12);
		$pdf->Cell(125, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"Pembina Tk. 1",0, 1, 'L',false,'',0,false,'T','C');//Pangkat kepala

		$pdf->Cell(110, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(65, 0,"NIP.19641201 198603 1 013",0, 1, 'L',false,'',0,false,'T','C');//Nip kepala

		$pdf->Line(10,268,200,268,array(
			'width' => 0.2
		));

		$pdf->Cell(10, 0,"VI.",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"CATATAN LAIN-LAIN",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Line(10,273,200,273,array(
			'width' => 0.2
		));

		$pdf->Cell(10, 0,"VII.",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->Cell(5, 0,"PERHATIAN",0, 1, 'L',false,'',0,false,'T','C');

		$pdf->Cell(10, 0,"",0, 0, 'L',false,'',0,false,'T','C');
		$pdf->MultiCell(180, 0, "Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggungjawab berdasarkan peraturan – peraturan  Keuangan Negara apabila Negara mendapat rugi akibat kesalahan, kealpaannya.", 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		//output
		$pdf->Output('output/contoh.pdf','I');
	}

	public function post()
	{
		$nama = $this->input->post('nama');
		$tujuan = $this->input->post('tujuan');
		$biaya = $this->input->post('biaya');

		$this->createPdf($nama,$tujuan,$biaya);
		$this->editExcel($nama,$tujuan,$biaya);
	}

	public function readSPPD(){
		$result=$this->CRUD->getSppd()->fetch_assoc();
		echo $result['nama'];
	}


	public function tambahSPPD(){
		
		$pejabat = $this->input->post('pejabat');
		$id_pegawai = $this->input->post('id_pegawai');
		$maksud = $this->input->post('maksud');
		$alat_angkut = $this->input->post('alat_angkut');
		$tempat_berangkat = $this->input->post('tempat_berangkat');
		$tempat_tujuan = $this->input->post('tempat_tujuan');
		$lama_dinas = $this->input->post('lama_dinas');
		$tgl_berangkat = $this->input->post('tgl_berangkat');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$id_pengikut = $this->input->post('id_pengikut');
		$beban_anggaran = $this->input->post('beban_anggaran');
		$instansi = $this->input->post('instansi');
		$id_anggaran = $this->input->post('id_anggaran');
		$keterangan = $this->input->post('keterangan');
		$no_sppd = $this->input->post('no_sppd');
		$kode_sppd = $this->input->post('kode_sppd');
		$tingkat = $this->input->post('tingkat');

		$pegawai2 = $this->CRUD->read_pegawai($id_pegawai);
		$nama_pegawai = $pegawai2[0]["nama"];
		$pg_pangkat = $pegawai2[0]["pangkat"];
		$pg_jabatan = $pegawai2[0]["jabatan"];
		$pg_golongan = $pegawai2[0]["golongan"];

		$data = array(
			'id_sppd' => '',
			'pejabat' => $pejabat,
			'id_pegawai' => $id_pegawai,
			'maksud' => $maksud,
			'alat_angkut' => $alat_angkut,
			'tempat_berangkat' => $tempat_berangkat,
			'tempat_tujuan' => $tempat_tujuan,
			'lama_dinas' => $lama_dinas,
			'tgl_berangkat' => $tgl_berangkat,
			'tgl_kembali'	 => $tgl_kembali,
			'id_pengikut' => $id_pengikut,
			'instansi' => $instansi,
			'id_anggaran' => $id_anggaran,
			'keterangan' => $keterangan,
			'no_sppd' => $no_sppd,
			'kode_sppd' => $kode_sppd,
			'tingkat' => $tingkat
		);
		
		print_r($data);
		$this->CRUD->input_sppd($data);
		$this->createPdf($kode_sppd,$no_sppd,$pejabat,$nama_pegawai,$pg_pangkat,$pg_jabatan,$pg_golongan,$tingkat,$maksud,$alat_angkut,$tempat_berangkat,$tempat_tujuan,$lama_dinas,$tgl_berangkat,$tgl_kembali,$id_pengikut,$beban_anggaran,$instansi,$id_anggaran,$keterangan);

		// redirect('Excel/buatsurat');
	}	

	public function hapus($id){
		$this->CRUD->mhapus_sppd($id);
		redirect('SPPD/history');
	}	
	
}

?>