<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pesanan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function getAllDaftar(){
		return $this->db->get('tbl_order')->num_rows();
	}
	
	function getLimitDaftar($limit,$mulai){
		$this->db->from('tbl_order');
		$this->db->join('tbl_meja','tbl_order.id_meja=tbl_meja.id_meja','left');
		$this->db->join('tbl_user','tbl_order.id_user=tbl_user.id_user','left');		
		$this->db->limit($limit,$mulai);
		$this->db->order_by('tbl_order.waktu_pesan','desc');
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0 ){return $hasil->result(); }else{ return false;}
	}
	
	function getDetailInfo($id){
		$this->db->from('tbl_order');
		$this->db->join('tbl_meja','tbl_order.id_meja=tbl_meja.id_meja','left');
		$this->db->where('tbl_order.id_order',$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() == 1){return $hasil->row();}else{return false;}
	}
	
	function hapusData($id){
		$this->db->where('id_order',$id);
		$this->db->delete('tbl_order_hidangan');		
		
		$this->db->where('id_order',$id);
		return $this->db->delete('tbl_order');
	}
	
	function hapusDataDetail($id){
		$this->db->where('no',$id);
		return $this->db->delete('tbl_order_hidangan');		
	}
}
?>