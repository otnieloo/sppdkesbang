<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRUD extends CI_Model {

/*==================TABLE SPPD=============*/
	public function getSppd($id = null){
		if ($id === null) {
			return $this->db->get('sppd')->result_array();
		}else{
			return $this->db->get_where('sppd',array('id_sppd'=>$id))->result_array();
		}
	}

	public function input_sppd($data){
		$this->db->insert('sppd',$data);
		return $this->db->affected_rows();
		// print_r($data);
	}

	//NYOBA NIH YA GUYS TERNYATA BISA GUYS, JANGAN DELETE YA GUYS
	//UNTUK MULTIINSERT KE TABLE SPPD DAN PENGIKUT
	public function multiple_insert_SPPD($input_data_lain, $pengikut){
		$this->db->insert('sppd',$input_data_lain);
		$id_sppd= $this->db->insert_id();
		

		//insert ke tabel pengikut
		//$input_pengikut['id_sppd']= $id_sppd;
		//$this->db->insert('pengikut',$input_pengikut);

		$i=0;
		foreach ($pengikut as $id_pegawai) {
			$datapengikut = array(
				
				'id_sppd'=>$id_sppd,
				'id_pegawai'=> $id_pegawai
			);
			$this->db->insert('pengikut',$datapengikut);
			$i++;
		}

		return $insert_id = $this->db->insert_id();
	}
	//INI AKHIR NYOBA NIH YA GUYS 

	public function mhapus_sppd($id){
		$this->db->where(array('id_sppd' => $id));
		$this->db->delete('sppd');
	}
/*==================END TABLE SPPD=============*/

/*==================TABLE PEGAWAI=============*/
	public function input_pegawai($data){
		$this->db->insert('pegawai',$data);
		return $this->db->affected_rows();
		// print_r($data);
	}

	public function read_pegawai($id = null){
		// print_r($data);
		if ($id === null) {
			return $this->db->get('pegawai')->result_array();
		}else{
			return $this->db->get_where('pegawai',array('id_pegawai'=>$id))->result_array();
		}
	}

	public function update2_pegawai($id,$data){
		$this->db->where(array('id_pegawai' => $id));
		$this->db->update('pegawai',$data);
	}

	public function hapusm_pegawai($id){
		$this->db->where(array('id_pegawai' => $id));
		$this->db->delete('pegawai');
	}
/*================== END TABLE PEGAWAI=============*/



/*==================TABLE SPT=============*/
	public function minput_spt($data){
		$this->db->insert('spt',$data);
		return $this->db->affected_rows();
		// print_r($data);
	}

	public function mread_spt($id = null){
		// print_r($data);
		if ($id === null) {
			return $this->db->get('spt')->result_array();
		}else{
			return $this->db->get_where('spt',array('id_spt'=>$id))->result_array();
		}
	}

	public function mupdate_spt($id,$data){
		$this->db->where(array('id_spt' => $id));
		$this->db->update('spt',$data);
	}

	public function mhapus_spt($id){
		$this->db->where(array('id_spt' => $id));
		$this->db->delete('spt');
	}


/*==================TABLE RINGKASAN=============*/
	public function minput_ringkasan($data){
		$this->db->insert('ringkasan',$data);
		return $this->db->affected_rows();
		// print_r($data);
	}

	public function mread_ringkasan($id = null){
		// print_r($data);
		if ($id === null) {
			return $this->db->get('ringkasan')->result_array();
		}else{
			return $this->db->get_where('ringkasan',array('id_ringkasan'=>$id))->result_array();
		}
	}

	public function mupdate_ringkasan($id,$data){
		$this->db->where(array('id_ringkasan' => $id));
		$this->db->update('ringkasan',$data);
	}

	public function mhapus_ringkasan($id){
		$this->db->where(array('id_ringkasan' => $id));
		$this->db->delete('ringkasan');
	}


	
	/*==================TABLE ANGGARAN=============*/
	public function minput_anggaran($data){
		$this->db->insert('anggaran',$data);
		return $this->db->affected_rows();
		// print_r($data);
	}

	public function mread_anggaran($id = null){
		// print_r($data);
		if ($id === null) {
			return $this->db->get('anggaran')->result_array();
		}else{
			return $this->db->get_where('anggaran',array('id_anggaran'=>$id))->result_array();
		}
	}

	public function mupdate_anggaran($id,$data){
		$this->db->where(array('id_anggaran' => $id));
		$this->db->update('anggaran',$data);
	}

	public function mhapus_anggaran($id){
		$this->db->where(array('id_anggaran' => $id));
		$this->db->delete('anggaran');
	}
	/*==================END TABLE ANGGARAN=============*/


	public function totalpegawai(){
  		$query = $this->db->get('pegawai');
    	if($query->num_rows()>0){
      		return $query->num_rows();
    	}
    		else{
      			return 0;
    	}
 	}

 	public function totalsppd(){
  		$query = $this->db->get('sppd');
    	if($query->num_rows()>0){
      		return $query->num_rows();
    	}
    		else{
      			return 0;
    	}
 	}

 	public function mread_pengikut($id = null){
		// print_r($data);
		if ($id === null) {
			return $this->db->get('pengikut')->result_array();
		}else{
			return $this->db->get_where('pengikut',array('id_pengikut'=>$id))->result_array();
		}
	}

	public function join_sppd_pegawai(){
 		$this->db->select('*');
 		$this->db->from('sppd');
 		$this->db->join('pegawai','sppd.id_pegawai=pegawai.id_pegawai');
 		$query=$this->db->get();
 		return $query->result_array();
 	}

 	



}

/* End of file CRUD.php */
/* Location: ./application/models/CRUD.php */