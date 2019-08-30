<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use 

class Laporan extends CI_Controller {
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
		$sppd = $this->CRUD->getSppd();
		
		$data['anggaran'] = $this->CRUD->mread_anggaran();

		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('lap_kegiatan',$data);
		$this->load->view('part/footer.php');	

	}

	public function keseluruhan()
	{
		$this->load->view('part/head');
		$this->load->view('part/sidebar');
		$this->load->view('lap_keseluruhan');
		$this->load->view('part/footer.php');
	}

	public function genLaporan($id) {
		$anggaran = $this->CRUD->mread_anggaran($id);
		$sppd = $this->CRUD->getSppdAnggaran($id);

		ob_start();

		$pdf = new Pdf('L','mm','F4',true,'UTF-8',false);

		//preparation
		
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		//Halaman pertama
		$pdf->AddPage('L');

		$pdf->setFont('times','',9);
		$html = '
		<style>
		table,tr,td{
			border : 1px solid black;
			text-align: center;
			vertical-align: center;
		}
		</style>
		<table width="100%">
				<tr>
					<td width="5%">No</td>
					<td width="15%">Nama/NIP</td>
					<td>Pangkat/Golongan</td>
					<td>Jabatan</td>	
					<td>Besarnya</td>
					<td>Tanggal</td>
					<td>Uraian</td>
					<td>Tujuan</td>
					<td>Tanda Tangan</td>
					<td>Asal Surat</td>
				</tr>
				<tr>
					<td width="5%">1</td>
					<td width="15%">2</td>
					<td>3</td>
					<td>4</td>	
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="15%"></td>
					<td></td>
					<td></td>	
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
		';
		
		
		$y = 1;
		$total = array();
		foreach($sppd as $s){ 
			$x = sizeof(explode(',',$s['id_pengikut']));
			$x = $x+1;
			$pegawai = $this->CRUD->read_pegawai($s['id_pegawai']);
			$html .= '<tr>';
			$html .= '<td rowspan="'.$x.'">'.$y.'</td>';
			$html .= '<td>'.$pegawai[0]['nama'].'<br>NIP. '.$pegawai[0]['id_pegawai'].'</td>';
			$html .=  '<td>'.$pegawai[0]['pangkat'].'/'.$pegawai[0]['golongan'].'</td>';
			$html .=  '<td>'.$pegawai[0]['jabatan'].'</td>';
			
			$abc = array("a","b","c","d");
			$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
			$golongan = str_replace("/", "", $golongan);
			$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
			$gaji = $this->gaji($wil,$golongan);
			array_push($total, $gaji);
			$html .=  '<td> Rp. '.number_format($gaji,2,',','.').'</td>';
			
			$html .=  '<td rowspan="'.$x.'">'.$s['tgl_berangkat'].'</td>';
			$html .=  '<td rowspan="'.$x.'">'.$s['maksud'].'</td>';
			$html .=  '<td rowspan="'.$x.'">'.$s['tempat_tujuan'].'</td>';
		
			$html .=  '<td rowspan="'.$x.'"></td>';
			$html .=  '<td rowspan="'.$x.'">abcabc</td>';
			$html .= '</tr>';

			$pengikut = $s['id_pengikut'];
			$pengikut2 = explode(',',$pengikut);
			foreach($pengikut2 as $p) {
				$peng = $this->CRUD->read_pegawai($p);
				$html .= '<tr>';
				$html .= '';
				$html .= '<td>'.$peng[0]['nama'].'<br>NIP. '.$peng[0]['id_pegawai'].'</td>';
				$html .=  '<td>'.$peng[0]['pangkat'].'/'.$peng[0]['golongan'].'</td>';
				$html .=  '<td>'.$peng[0]['jabatan'].'</td>';

				//gaji
				$abc = array("a","b","c","d");
				$golongan = str_replace($abc, "", $peng[0]['golongan']);
				$golongan = str_replace("/", "", $golongan);
				$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
				$gaji = $this->gaji($wil,$golongan);
				array_push($total, $gaji);
				$html .=  '<td> Rp. '.number_format($gaji,2,',','.').'</td>';
				$html .= '</tr>';
		};
			$y++;
		};

		$html .= '</table>';

		$pdf->Cell(50, 0, 'Daftar Pegawai Penerima Surat Perintah Perjalanan Dinas (SPPD) Dalam Daerah', 0, 1, 'L', false , '', 0, false,'T', 'M');
		$pdf->Cell(50, 0,'Kegiatan '.$anggaran[0]['uraian'], 0, 1, 'L', false , '', 0, false,'T', 'M');
		$pdf->Cell(50, 0, 'Kantor Kesbang dan Linmas', 0, 1, 'L', false , '', 0, false,'T', 'M');
		$pdf->Cell(50, 0, 'Tahun Anggaran 2019', 0, 1, 'L', false , '', 0, false,'T', 'M');

		$pdf->Write(5,'','',false,'C',true);
		$pdf->Cell(50, 0, $anggaran[0]['kode_anggaran'].'.5.2.2.15.01', 0, 1, 'L', false , '', 0, false,'T', 'M');
		$pdf->Write(5,'','',false,'C',true);

		$pdf->writeHTML($html, true, false, false, false, 'C');

		$pdf->setFont('times','B',11);
		$pdf->Write(5,'Total Biaya: Rp. '.number_format(array_sum($total),2,',','.'),'',false,'C',true);
		$pdf->Output('output/contoh.pdf','I');
	}

	//Keseluruhan
	public function genLaporanKel(){
		ob_start();

		$pdf = new Pdf('L','mm','F4',true,'UTF-8',false);

		//preparation
		
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		//Halaman pertama
		$pdf->AddPage('L');

		$pdf->setFont('times','',9);
		
		//Table header
		$html = '
		<style>
			table,tr,td{
				border : 1px solid black;
				text-align: center;
				vertical-align: center;
			}
		</style>
		<table width="100%">
				<tr>
					<td width="5%">No</td>
					<td width="10%">No SPPD</td>
					<td width="10%">Nama Peserta SPPD</td>
					<td>Tanggal Surat Surat</td>	
					<td>Tanggal Berangkat</td>
					<td>Tanggal Kembali</td>
					<td>No BKU</td>
					<td>Tujuan</td>
					<td>Transport</td>
					<td>Lumsum</td>
					<td>Total</td>
					<td>Sumber Kegiatan</td>
					<td>Keterangan</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>	
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>11</td>
					<td>12</td>
					<td>13</td>
				</tr>
				';

		//Per kegiatan
		$kegiatan = $this->CRUD->mread_anggaran();
		foreach($kegiatan as $k){
			$sppd = $this->CRUD->getSppdAnggaran($k['id_anggaran']);
			// print_r($sppd);
			if(empty($sppd)){
				continue;
			}else{
				$html .= '
					<!-- Per Kegiatan -->
					<tr>
						<td colspan="6" style="text-align: left;">Gu Bulan   ->  '.$k['uraian'].'</td>	
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					';
				//Per SPPD
				foreach($sppd as $s){
					$x = sizeof(explode(',',$s['id_pengikut']))+1;
					
					$pegawai = $this->CRUD->read_pegawai($s['id_pegawai']);	

					$abc = array("a","b","c","d");
					$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
					$golongan = str_replace("/", "", $golongan);
					$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
					$gaji = $this->gaji($wil,$golongan);
					
					$html .= '
							<!-- Per SPPD -->
							<tr>
								<td rowspan="6">1</td>
								<td rowspan="6">'.$s['no_sppd'].'</td>
								<td>'.$pegawai[0]['nama'].'</td>
								<td rowspan="6">tanggal_surat</td>	
								<td rowspan="6">'.$s['tgl_berangkat'].'</td>
								<td rowspan="6">'.$s['tgl_kembali'].'</td>
								<td rowspan="6">no bku</td>
								<td rowspan="6">'.$s['tempat_tujuan'].'</td>
								<td rowspan="6">transport</td>
								<td> Rp. '.number_format(20000,2,',','.').'</td>
								<td rowspan="6">total</td>
								<td rowspan="6">APBD KOTA TASIKMALAYA</td>
								<td rowspan="6">'.$s['keterangan'].'</td>
							</tr>
							';
					//pengikut
					$pengikut = explode(',',$s['id_pengikut']);
					$peng = array();
					foreach($pengikut as $p){
						array_push($peng, $p);
					};					

					$html .= '
							<tr>
								<td>abc</td>
								<td>200</td>
							</tr>
						';
					$html .= '
							<tr>
								<td>abc</td>
								<td>200</td>
							</tr>
						';
					$html .= '
							<tr>
								<td>abc</td>
								<td>200</td>
							</tr>
						';
					$html .= '
							<tr>
								<td>abc</td>
								<td>200</td>
							</tr>
						';
					$html .= '
							<tr>
								<td>abc</td>
								<td>200</td>
							</tr>
						';

					foreach($peng as $p){
						// $html .= '
						// 	<tr>
						// 		<td>abc</td>
						// 		<td>200</td>
						// 	</tr>
						// ';	
					}	
				};//endforeach - per sppd
			
			};//endif
		};//endforeach - per kegiatan

		$html .= '</table>';

		$pdf->writeHTML($html, true, false, false, false, 'C');

		$pdf->Output('output/contoh.pdf','I');
	}


	public function gaji($wilayah,$golongan){
		//kurang penginapan dan luar dki
		if($wilayah == "DI"){
			switch ($golongan) {
				case 'IV':
					return 100000;
					break;
				case 'III':
					return 85000;
					break;
				case 'II':
					return 75000;
					break;
				case 'I':
					return 65000;
					break;
				case 'non':
					return 65000;
					break;
			}
		}else if($wilayah == "DII"){
			switch ($golongan) {
				case 'IV':
					return 125000;
					break;
				case 'III':
					return 110000;
					break;
				case 'II':
					return 100000;
					break;
				case 'I':
					return 75000;
					break;
				case 'non':
					return 75000;
					break;
			}
		}else if($wilayah == "DIII"){
			switch ($golongan) {
				case 'IV':
					return 150000;
					break;
				case 'III':
					return 125000;
					break;
				case 'II':
					return 110000;
					break;
				case 'I':
					return 90000;
					break;
				case 'non':
					return 90000;
					break;
			}
		}else if($wilayah == "LI"){
			switch ($golongan) {
				case 'EIII':
					return 600000;
					break;
				case 'EIV':
					return 425000;
					break;
				case 'pns':
					return 400000;
					break;
				case 'non':
					return 270000;
					break;
			}
		}else if($wilayah == "LII"){
			switch ($golongan) {
				case 'EIII':
					return 600000;
					break;
				case 'EIV':
					return 550000;
					break;
				case 'pns':
					return 525000;
					break;
				case 'non':
					return 350000;
					break;
			}
		}else if($wilayah == "LIII"){
			switch ($golongan) {
				case 'EIII':
					return 680000;
					break;
				case 'EIV':
					return 600000;
					break;
				case 'pns':
					return 550000;
					break;
				case 'non':
					return 400000;
					break;
			}
		}else if($wilayah == "LIV"){
			switch ($golongan) {
				case 'EIII':
					return 760000;
					break;
				case 'EIV':
					return 660000;
					break;
				case 'pns':
					return 600000;
					break;
				case 'non':
					return 450000;
					break;
			}
		}
	}

	
}
?>