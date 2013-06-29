<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Makanan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function getAllDaftar(){
		return $this->db->get('tbl_makanan')->num_rows();
	}
	
	function getLimitDaftar($limit,$mulai){
		$this->db->limit($limit,$mulai);
		$hasil = $this->db->get('tbl_makanan');
		if($hasil->num_rows() > 0 ){return $hasil->result(); }else{ return false;}
	}
	
	function getInfoDetail($id){
		$this->db->where('id_makanan',$id);	
		$data = $this->db->get('tbl_makanan');
		if($data->num_rows() == 1){return $data->row();}else{return false;}
	}
	
	function cekMakanan($id){
		$this->db->where('id_makanan',$id);	
		return $this->db->get('tbl_makanan');
	}
	
	function updateMakanan($id,$update){
		$this->db->where('id_makanan',$id);
		return $this->db->update('tbl_makanan',$update);
	}
	
	function hapusData($id){
		$this->db->where('id_makanan',$id);
		$data = $this->db->get('tbl_makanan');
		if($data->num_rows() == 1){
			$d = $data->row();
			if(file_exists('./pictures/makanan/'.$d->foto_makanan)){
				unlink('./pictures/makanan/'.$d->foto_makanan);
				$this->db->where('id_makanan',$id);
				return $this->db->delete('tbl_makanan');
			}
		}else{
			return false;
		}
	}
	
	function simpanMakanan($simpan){
		return $this->db->insert('tbl_makanan',$simpan);
	}
	
	function getPencarian($kode,$kata){
		$this->db->like('nama_makanan',$kata);
		$this->db->or_like('keterangan_makanan',$kata);
		$this->db->or_like('harga',$kata);
		if($kode=='data'){
			$data = $this->db->get('tbl_makanan');
			if($data->num_rows() > 0){ return $data->result(); }else{ return false; }
		}else if($kode=='jumlah'){
			return $this->db->get('tbl_makanan')->num_rows();
		}
	}
	
	function getDetailOrder($id){
		$this->db->from('tbl_order_hidangan');
		$this->db->join('tbl_makanan','tbl_order_hidangan.menu=tbl_makanan.id_makanan','left');
		$this->db->where('tbl_order_hidangan.kategori_menu','makanan');
		$this->db->where('tbl_order_hidangan.id_order',$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){return $hasil->result();}else{return false;}
	}	
}
?>