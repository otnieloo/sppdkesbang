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

	public function index($id = null)
	{
		$data['pegawai'] = $this->CRUD->read_pegawai();
		$data['spt'] = $this->CRUD->mread_spt();
		$data['sppd'] = $this->CRUD->getSppd();
		if($id === null){
			$this->load->view('part/head');
			$this->load->view('part/sidebar');
			$this->load->view('formLHPD',$data);
			$this->load->view('part/footer.php');	
		}else{
			$data['id_sppd'] = $id;
			$this->load->view('part/head');
			$this->load->view('part/sidebar');
			$this->load->view('formLHPD',$data);
			$this->load->view('part/footer.php');
		}
	}

	public function history()
	{
		$data['laporan'] = $this->CRUD->mread_laporan();
		$data['m_sppd'] = $this->CRUD;
		// print_r($data);
		// die;
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('historyLHPD',$data);
		$this->load->view('part/footer.php');
	}
	

	public function tambahLaporan(){
			$sppd = $this->input->post('id_sppd');
			$hasil = $this->input->post('ringkasan');
 			
 			$hasil = implode(",", $hasil);
			$data = array(
				'id_laporan' => null,
				'id_sppd' => $sppd,
				'hasil' => $hasil
				);
			//print_r($data);
			// $this->CRUD->minput_laporan($data);
			$this->genLap($sppd,$hasil);
			// redirect('SuratHasil/index');
	}

	public function hapus($id){
		$this->CRUD->mhapus_laporan($id);
		redirect('SuratHasil/history');
	}

	public function genLap($sppd,$hasil)
	{
		$sppd = $this->CRUD->getSppd($sppd);
		$id_pegawai = array($sppd[0]['id_pegawai']);
		$id_pengikut = $sppd[0]['id_pengikut'];
		$id_pengikut2 = explode(",",$id_pengikut);
		foreach($id_pengikut2 as $peng){
			array_push($id_pegawai,$peng);
		}
		// print_r($id_pegawai);
		// die;
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

		$pdf->setFont('times','',10);
		$html = '
			<style>
				table,tr,td{
					border : 1px solid black;
					text-align: center;
					vertical-align: center;
				}
			</style>
			<table>
				<tr>
					<td width="5%">No</td>
					<td width="32%">Nama</td>
					<td width="28%">NIP</td>
					<td>Pangkat</td>
					<td width="11%">Golongan</td>
				</tr>
			';
		$i=1;
		foreach($id_pegawai as $peg){
			$pegawai = $this->CRUD->read_pegawai($peg);	
			$html .= '
				<tr>
					<td>'.$i.'</td>
					<td>'.$pegawai[0]['nama'].'</td>
					<td>'.$peg.'</td>
					<td>'.$pegawai[0]['pangkat'].'</td>
					<td>'.$pegawai[0]['golongan'].'</td>
				</tr>	
			';	
			$i++;
		}
		
		$html .= '</table>';
		$pdf->writeHTML($html, true, false, false, false, 'C');

		$pdf->Write(5,'','',false,'C',true);
		$pdf->Write(10,'Dengan ini melaporkan hasil perjalanan dinas :','',false,'L',true);

		$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'A. ',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(40, 0,'Tujuan',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,$sppd[0]['tempat_tujuan'],0, 1, '',false,'',0,false,'T','M');

		$pdf->Cell(25, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(40, 0,'Tanggal Berangkat',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,$sppd[0]['tgl_berangkat'],0, 1, '',false,'',0,false,'T','M');

		$pdf->Cell(25, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(40, 0,'Tanggal Kembali',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,':',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(5, 0,$sppd[0]['tgl_kembali'],0, 1, '',false,'',0,false,'T','M');

		$pdf->Write(5,'','',false,'L',true);

		$pdf->Cell(15, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,'B.      Ringkasan Hasil Kegiatan :',0, 1, '',false,'',0,false,'T','M');

		

		//ringkasam
		$hasil = explode(",",$hasil);
		$i = 1;
		foreach ($hasil as $h) {
			$pdf->Cell(25, 0,'',0, 0, '',false,'',0,false,'T','M');
			$pdf->Cell(5, 0,"$i. ",0, 0, '',false,'',0,false,'T','M');
			$pdf->MultiCell(0, 0, $h, 0, 'L', false, 1, '', '', true, 0, false, true, 0, 'T', false);
			$i++;
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
		$pdf->Cell(135, 0,'',0, 0, '',false,'',0,false,'T','M');
		
		$pelapor = $this->CRUD->read_pegawai($id_pegawai[0]);
		
		$pdf->Cell(10, 0,$pelapor[0]['nama'],0, 1, '',false,'',0,false,'T','M');

		$pdf->setFont('times','',12);
		$pdf->Cell(125, 0,'',0, 0, '',false,'',0,false,'T','M');
		$pdf->Cell(10, 0,"NIP ".$pelapor[0]['id_pegawai'],0, 1, '',false,'',0,false,'T','M');		

		$pdf->Output('output/contoh.pdf','I');
	}
	
}

?>