<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CHAIN extends CI_Model {

/*==================TABLE SPPD=============*/
	public function viewBySPPD($id_sppd){
    $this->db->get_where('id_sppd', $id_sppd);
    $result = $this->db->get('sppd')->result(); // Tampilkan semua data kota berdasarkan id sppd
    
    return $result; 
  }

  public function getSppd($id = null){
		if ($id === null) {
			return $this->db->get('sppd')->result_array();
		}else{
			return $this->db->get_where('sppd',array('id_sppd'=>$id))->result_array();
		}
	}

	public function view(){
    return $this->db->get('sppd')->result(); // Tampilkan semua data yang ada di tabel sppd
  }

  public function viewByProvinsi($id_sppd){
    $this->db->where('id_sppd', $id_sppd);
    $result = $this->db->get('sppd')->result(); // Tampilkan semua data kota berdasarkan id provinsi
    
    return $result; 
  }
/*==================END TABLE SPPD=============*/




}

/* End of file CRUD.php */
/* Location: ./application/models/CRUD.php */