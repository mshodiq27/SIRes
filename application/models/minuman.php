<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Minuman extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function getAllDaftar(){
		return $this->db->get('tbl_minuman')->num_rows();
	}
	
	function getLimitDaftar($limit,$mulai){
		$this->db->limit($limit,$mulai);
		$hasil = $this->db->get('tbl_minuman');
		if($hasil->num_rows() > 0 ){return $hasil->result(); }else{ return false;}
	}
	
	function getInfoDetail($id){
		$this->db->where('id_minuman',$id);	
		$data = $this->db->get('tbl_minuman');
		if($data->num_rows() == 1){return $data->row();}else{return false;}
	}
	
	function cekMinuman($id){
		$this->db->where('id_minuman',$id);	
		return $this->db->get('tbl_minuman');
	}
	
	function updateMinuman($id,$update){
		$this->db->where('id_minuman',$id);
		return $this->db->update('tbl_minuman',$update);
	}
	
	function hapusData($id){
		$this->db->where('id_minuman',$id);
		$data = $this->db->get('tbl_minuman');
		if($data->num_rows() == 1){
			$d = $data->row();
			if(file_exists('./pictures/minuman/'.$d->foto_minuman)){
				unlink('./pictures/minuman/'.$d->foto_minuman);
				$this->db->where('id_minuman',$id);
				return $this->db->delete('tbl_minuman');
			}
		}else{
			return false;
		}
	}
	
	function simpanMinuman($simpan){
		return $this->db->insert('tbl_minuman',$simpan);
	}
	
	function getPencarian($kode,$kata){
		$this->db->like('nama_minuman',$kata);
		$this->db->or_like('keterangan_minuman',$kata);
		$this->db->or_like('harga',$kata);
		if($kode=='data'){
			$data = $this->db->get('tbl_minuman');
			if($data->num_rows() > 0){ return $data->result(); }else{ return false; }
		}else if($kode=='jumlah'){
			return $this->db->get('tbl_minuman')->num_rows();
		}
	}
	
	function getDetailOrder($id){
		$this->db->from('tbl_order_hidangan');
		$this->db->join('tbl_minuman','tbl_order_hidangan.menu=tbl_minuman.id_minuman','left');
		$this->db->where('tbl_order_hidangan.kategori_menu','minuman');
		$this->db->where('tbl_order_hidangan.id_order',$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){return $hasil->result();}else{return false;}
	}	
}
?>