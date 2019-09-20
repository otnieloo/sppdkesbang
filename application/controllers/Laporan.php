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
		$this->load->view('lap_kegiatan_keseluruhan');
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
					//rowspan
					$x = sizeof(explode(',',$s['id_pengikut']))+1;
					
					//total per sppd
					$total = array();

					//menghitung total gaji pengikut
					$pengikut = explode(',',$s['id_pengikut']);
					$peng = array();
					foreach($pengikut as $p){
						array_push($peng, $p);
					};	
					foreach($peng as $p) {
						$pegawai = $this->CRUD->read_pegawai($p);
						$abc = array("a","b","c","d");		
						$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
						$golongan = str_replace("/", "", $golongan);
						$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
						$gaji = $this->gaji($wil,$golongan);
						array_push($total,$gaji);
					}
					
					$pegawai = $this->CRUD->read_pegawai($s['id_pegawai']);	

					//Gaj*i
					
					$abc = array("a","b","c","d");
					$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
					$golongan = str_replace("/", "", $golongan);
					$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
					$gaji = $this->gaji($wil,$golongan);
					array_push($total,$gaji);
					
					//Sppd
					$html .= '
							<!-- Per SPPD -->
							<tr>
								<td rowspan="'.$x.'">1</td>
								<td rowspan="'.$x.'">'.$s['no_sppd'].'</td>
								<td>'.$pegawai[0]['nama'].'</td>
								<td rowspan="'.$x.'">tanggal_surat</td>	
								<td rowspan="'.$x.'">'.$s['tgl_berangkat'].'</td>
								<td rowspan="'.$x.'">'.$s['tgl_kembali'].'</td>
								<td rowspan="'.$x.'">no bku</td>
								<td rowspan="'.$x.'">'.$s['tempat_tujuan'].'</td>
								<td rowspan="'.$x.'">transport</td>
								<td> Rp. '.number_format($gaji,2,',','.').'</td>
								<td rowspan="'.$x.'"> Rp. '.number_format(array_sum($total),2,',','.').'	</td>
								<td rowspan="'.$x.'">APBD KOTA TASIKMALAYA</td>
								<td rowspan="'.$x.'">'.$s['keterangan'].'</td>
							</tr>
							';
					//pengikut
					$pengikut = explode(',',$s['id_pengikut']);
					$peng = array();
					foreach($pengikut as $p){
						array_push($peng, $p);
					};					

					//pengikut beserta gajinya
					foreach($peng as $p){
						$abc = array("a","b","c","d");		
						$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
						$golongan = str_replace("/", "", $golongan);
						$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
						$gaji = $this->gaji($wil,$golongan);
						array_push($total,$gaji);
						$pegawai = $this->CRUD->read_pegawai($p);
						$html .= '
							<tr>
								<td>'.$pegawai[0]['nama'].'</td>
								<td>Rp. '.number_format($gaji,2,',','.').'</td>
							</tr>
						';	

					}	
				};//endforeach - per sppd
			
			};//endif
		};//endforeach - per kegiatan

		$html .= '</table>';

		$pdf->writeHTML($html, true, false, false, false, 'C');

		$pdf->Output('output/contoh.pdf','I');
	}

	//method hitung gaji
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

	public function createExcel($id)
		{
			$anggaran = $this->CRUD->mread_anggaran($id);
			$sppd = $this->CRUD->getSppdAnggaran($id);	

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
						
			$sheet->getColumnDimension('B')->setWidth(3.5);
			$sheet->getColumnDimension('C')->setWidth(21.5);
			$sheet->getColumnDimension('D')->setWidth(16.5);
			$sheet->getColumnDimension('E')->setWidth(15);
			$sheet->getColumnDimension('F')->setWidth(13);
			$sheet->getColumnDimension('G')->setWidth(11);
			$sheet->getColumnDimension('H')->setWidth(16);
			$sheet->getColumnDimension('I')->setWidth(18);
			$sheet->getColumnDimension('J')->setWidth(13);
			$sheet->getColumnDimension('K')->setWidth(11);

			$sheet->setCellValue('B3','Daftar Pegawai Penerima Surat Perintah Perjalanan Dinas (SPPD) Dalam Daerah
');
			$uraian = $anggaran[0]['uraian'];
			$kode_anggaran = $anggaran[0]['kode_anggaran'];
			$sheet->setCellValue('B4',"Kegiatan $uraian");
			$sheet->setCellValue('B5','Kantor Kesbang dan Linmas');
			$sheet->setCellValue('B6','Tahun Anggaran 2019');
			$sheet->setCellValue('B8',"$kode_anggaran");

			$sheet->setCellValue('B10','No');
			$sheet->setCellValue('C10','Nama/NIP');
			$sheet->setCellValue('D10','Pangkat/Golongan');
			$sheet->setCellValue('E10','Jabatan');
			$sheet->setCellValue('F10','Besarnya');
			$sheet->setCellValue('G10','Tanggal');
			$sheet->setCellValue('H10','Uraian');
			$sheet->setCellValue('I10','Tujuan');
			$sheet->setCellValue('J10','Tanda Tangan');
			$sheet->setCellValue('K10','Asal Surat');
			$sheet->setCellValue('B11','1');
			$sheet->setCellValue('C11','2');
			$sheet->setCellValue('D11','3');
			$sheet->setCellValue('E11','4');
			$sheet->setCellValue('F11','5');
			$sheet->setCellValue('G11','6');
			$sheet->setCellValue('H11','7');
			$sheet->setCellValue('I11','8');
			$sheet->setCellValue('J11','9');
			$sheet->setCellValue('K11','10');
			
			//Loop
			$x = 13;
			$i = 1;
			foreach($sppd as $s) { 
				$pegawai = $this->CRUD->read_pegawai($s['id_pegawai']);
				$z = $x;
				$total = array();

				$nama = $pegawai[0]['nama'];
				$id_pegawai = $s['id_pegawai'];
				$pangkat = $pegawai[0]['pangkat'];
				$golongan = $pegawai[0]['golongan'];
				$jabatan = $pegawai[0]['jabatan'];
				$tgl_surat = $s['tgl_surat'];
				$maksud = $s['maksud'];
				$tempat_tujuan = $s['tempat_tujuan'];

				$abc = array("a","b","c","d");
				$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
				$golongan = str_replace("/", "", $golongan);
				$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
				$gaji = $this->gaji($wil,$golongan);
				array_push($total, $gaji);

				$sheet->setCellValue("B$x","$i");
				$sheet->setCellValue("C$x","$nama \n $id_pegawai");
				$sheet->setCellValue("D$x","$pangkat / $golongan");
				$sheet->setCellValue("E$x","$jabatan");
				$sheet->setCellValue("F$x","$gaji");
				$sheet->setCellValue("G$x","$tgl_surat");
				$sheet->setCellValue("H$x","$maksud");
				$sheet->setCellValue("I$x","$tempat_tujuan");
				$sheet->setCellValue("J$x",'ttd');
				$sheet->setCellValue("K$x",'asal surat');
				
				$y = 2;
				$id_pengikut = explode(",", $s['id_pengikut']);

				foreach ($id_pengikut as $p) {
					$pengikut = $this->CRUD->read_pegawai($p);
					$nama = $pengikut[0]['nama'];
					$nip = $p;
					$pangkat = $pengikut[0]['pangkat'];
					$golongan = $pengikut[0]['golongan'];
					$jabatan = $pengikut[0]['jabatan'];

					$abc = array("a","b","c","d");
					$golongan = str_replace($abc, "", $pengikut[0]['golongan']);
					$golongan = str_replace("/", "", $golongan);
					$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
					$gaji = $this->gaji($wil,$golongan);
					array_push($total, $gaji);

					$x++;
					$sheet->setCellValue("C$x","$nama \n $id_pegawai");
					$sheet->setCellValue("D$x","$pangkat / $golongan");
					$sheet->setCellValue("E$x","$jabatan");
					$sheet->setCellValue("F$x","$gaji");
				}
				
				$sheet->mergeCells("B$z:B$x");
				$sheet->mergeCells("G$z:G$x");
				$sheet->mergeCells("H$z:H$x");
				$sheet->mergeCells("I$z:I$x");
				$sheet->mergeCells("J$z:J$x");
			
				$sheet->mergeCells("K$z:K$x");

				$sheet->getStyle("B10:K$x")->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
				$sheet->getStyle("B10:K$x")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
				$sheet->getStyle("B10:K$x")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
				$sheet->getStyle("B10:K$x")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
				$sheet->getStyle("B10:K$x")->getBorders()->getInside()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

				$x+=$y;$i++;
			}

			$sheet->getStyle('B10:K1000')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('B10:K1000')->getAlignment()->setVertical('center');
			$sheet->getStyle('B10:K1000')->getAlignment()->setWrapText(true);

			$writer = new Xlsx($spreadsheet);

			$filename = 'contoh';

			// echo base_url();

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		}
	
		public function createExcelAll()
		{
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
						
			$sheet->getColumnDimension('B')->setWidth(3.5);
			$sheet->getColumnDimension('C')->setWidth(21.5);
			$sheet->getColumnDimension('D')->setWidth(16.5);
			$sheet->getColumnDimension('E')->setWidth(15);
			$sheet->getColumnDimension('F')->setWidth(13);
			$sheet->getColumnDimension('G')->setWidth(11);
			$sheet->getColumnDimension('H')->setWidth(16);
			$sheet->getColumnDimension('I')->setWidth(18);
			$sheet->getColumnDimension('J')->setWidth(13);
			$sheet->getColumnDimension('K')->setWidth(11);
			$sheet->getColumnDimension('L')->setWidth(11);
			$sheet->getColumnDimension('M')->setWidth(11);
			$sheet->getColumnDimension('N')->setWidth(11);

			$sheet->setCellValue('B10','No');
			$sheet->setCellValue('C10','No SPPD');
			$sheet->setCellValue('D10','Nama Peserta SPPD');
			$sheet->setCellValue('E10','Tanggal Surat');
			$sheet->setCellValue('F10','Tanggal Berangkat');
			$sheet->setCellValue('G10','Tanggal Kembali');
			$sheet->setCellValue('H10','No BKU');
			$sheet->setCellValue('I10','Tujuan');
			$sheet->setCellValue('J10','Transport');
			$sheet->setCellValue('K10','Lumsum');
			$sheet->setCellValue('L10','Total');
			$sheet->setCellValue('M10','Sumber Kegiatan');
			$sheet->setCellValue('N10','Keterangan');
			$sheet->setCellValue('B11','1');
			$sheet->setCellValue('C11','2');
			$sheet->setCellValue('D11','3');
			$sheet->setCellValue('E11','4');
			$sheet->setCellValue('F11','5');
			$sheet->setCellValue('G11','6');
			$sheet->setCellValue('H11','7');
			$sheet->setCellValue('I11','8');
			$sheet->setCellValue('J11','9');
			$sheet->setCellValue('K11','10');
			$sheet->setCellValue('L11','11');
			$sheet->setCellValue('M11','12');
			$sheet->setCellValue('N11','13');

			//Kegiatan
			$kegiatan = $this->CRUD->mread_anggaran();
			$x = 12;
			$total = array();
			foreach ($kegiatan as $k) {
				$sppd = $this->CRUD->getSppdAnggaran($k['id_anggaran']);
				if (empty($sppd)) {
					continue;
				}else{
					//SPPD
					$sheet->setCellValue("B$x",$k['uraian']);
					$sheet->mergeCells("B$x:F$x");
					$no = 1;
					foreach ($sppd as $s) {

						$x++;
						$z = $x;

						$pegawai = $this->CRUD->read_pegawai($s['id_pegawai']);

						//menghitung total gaji pengikut
						$pengikut = explode(',',$s['id_pengikut']);
						$peng = array();
						foreach($pengikut as $p){
							array_push($peng, $p);
						};	
						foreach($peng as $p) {
							$pegawai = $this->CRUD->read_pegawai($p);
							$abc = array("a","b","c","d");		
							$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
							$golongan = str_replace("/", "", $golongan);
							$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
							$gaji = $this->gaji($wil,$golongan);
							array_push($total,$gaji);
						}

						$abc = array("a","b","c","d");
						$golongan = str_replace($abc, "", $pegawai[0]['golongan']);
						$golongan = str_replace("/", "", $golongan);
						$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
						$gaji = $this->gaji($wil,$golongan);
						array_push($total, $gaji);

						$sheet->setCellValue("B$x","$no");
						$sheet->setCellValue("C$x",$s['no_sppd']);
						$sheet->setCellValue("D$x",$pegawai[0]['nama']);
						$sheet->setCellValue("E$x",$s['tgl_surat']);
						$sheet->setCellValue("F$x",$s['tgl_berangkat']);
						$sheet->setCellValue("G$x",$s['tgl_kembali']);
						$sheet->setCellValue("H$x","NO BKU");
						$sheet->setCellValue("I$x",$s['tempat_tujuan']);
						$sheet->setCellValue("J$x","Transport");
						$sheet->setCellValue("K$x","$gaji");
						$sheet->setCellValue("L$x",array_sum($total));
						$sheet->setCellValue("M$x","APBD KOTA TASIKMALAYA");
						$sheet->setCellValue("N$x",$s['keterangan']);


						$id_pengikut = explode(",", $s['id_pengikut']);
						foreach ($id_pengikut as $p) {
							$pengikut = $this->CRUD->read_pegawai($p);
							$nama = $pengikut[0]['nama'];

							$abc = array("a","b","c","d");
							$golongan = str_replace($abc, "", $pengikut[0]['golongan']);
							$golongan = str_replace("/", "", $golongan);
							$wil = substr($s['tingkat'],0,1).substr($s['tingkat'], -1);
							$gaji = $this->gaji($wil,$golongan);
							// array_push($total, $gaji);

							$x++;
							$sheet->setCellValue("D$x","$nama");
							$sheet->setCellValue("K$x","$gaji");
						}

						$sheet->mergeCells("B$z:B$x");
						$sheet->mergeCells("C$z:C$x");
						$sheet->mergeCells("E$z:E$x");
						$sheet->mergeCells("F$z:F$x");
						$sheet->mergeCells("G$z:G$x");
						$sheet->mergeCells("H$z:H$x");
						$sheet->mergeCells("I$z:I$x");
						$sheet->mergeCells("J$z:J$x");
						$sheet->mergeCells("L$z:L$x");
						$sheet->mergeCells("M$z:M$x");
						$sheet->mergeCells("N$z:N$x");

						$sheet->getStyle("B10:N$x")->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
						$sheet->getStyle("B10:N$x")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
						$sheet->getStyle("B10:N$x")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
						$sheet->getStyle("B10:N$x")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
						$sheet->getStyle("B10:N$x")->getBorders()->getInside()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

						$no++;
						$total = array();
					}

					$x++;
				}
			}

			$sheet->getStyle('B10:N1000')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('B10:N1000')->getAlignment()->setVertical('center');
			$sheet->getStyle('B10:N1000')->getAlignment()->setWrapText(true);

			$writer = new Xlsx($spreadsheet);

			$filename = 'contoh';

			// echo base_url();

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		}
}
?>