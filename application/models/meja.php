<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Meja extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function getAllDaftar(){
		return $this->db->get('tbl_meja')->num_rows();
	}
	
	function getLimitDaftar($limit,$mulai){
		$this->db->limit($limit,$mulai);
		$hasil = $this->db->get('tbl_meja');
		if($hasil->num_rows() > 0 ){return $hasil->result(); }else{ return false;}
	}
	
	function getInfoDetail($id){
		$this->db->where('id_meja',$id);	
		$data = $this->db->get('tbl_meja');
		if($data->num_rows() == 1){return $data->row();}else{return false;}
	}
	
	function cekMeja($id){
		$this->db->where('id_meja',$id);	
		return $this->db->get('tbl_meja');
	}
	
	function updateMeja($id,$update){
		$this->db->where('id_meja',$id);
		return $this->db->update('tbl_meja',$update);
	}
	
	function hapusData($id){
		$this->db->where('id_meja',$id);
		return $this->db->delete('tbl_meja');		
	}
	
	function simpanMeja($simpan){
		return $this->db->insert('tbl_meja',$simpan);
	}
	
	function getPencarian($kode,$kata){
		$this->db->like('nama_meja',$kata);
		$this->db->or_like('keterangan_meja',$kata);
		if($kode=='data'){
			$data = $this->db->get('tbl_meja');
			if($data->num_rows() > 0){ return $data->result(); }else{ return false; }
		}else if($kode=='jumlah'){
			return $this->db->get('tbl_meja')->num_rows();
		}
	}
}
?>