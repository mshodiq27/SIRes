<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Akun extends CI_Model{
	function getAkun($user,$pass){
		$this->db->where('status_user',1);
		$this->db->where('username',$user);
		$this->db->where('password',$pass);
		return $this->db->get('tbl_user');
	}
	
	function getAllDaftar(){
		return $this->db->get('tbl_user')->num_rows();
	}
	
	function getLimitDaftar($limit,$mulai){
		$this->db->from('tbl_user');
		$this->db->join('tbl_group_user','tbl_user.id_group_user=tbl_group_user.id_group_user','left');		
		$this->db->limit($limit,$mulai);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0 ){return $hasil->result(); }else{ return false;}
	}
	
	function getGroup(){
		$hasil = $this->db->get('tbl_group_user');
		if($hasil->num_rows() > 0 ){return $hasil->result(); }else{ return false;}
	}
	
	function cekAkun($kode,$id){
		if($kode=='baru'){
			$this->db->where('username',$id);	
			return $this->db->get('tbl_user')->num_rows();
		}else{
			$this->db->where('id_user',$id);	
			return $this->db->get('tbl_user')->num_rows();
		}		
	}
	
	function updateAkun($id,$update){
		$this->db->where('id_user',$id);
		return $this->db->update('tbl_user',$update);
	}
	
	function simpanAkun($simpan){
		return $this->db->insert('tbl_user',$simpan);
	}
	
	function hapusData($id){
		$this->db->where('id_user',$id);
		return $this->db->delete('tbl_user');		
	}
	
	function getPencarian($kode,$kata){
		$this->db->from('tbl_user');
		$this->db->join('tbl_group_user','tbl_user.id_group_user=tbl_group_user.id_group_user','left');	
		$this->db->like('tbl_user.nama_user',$kata);
		$this->db->or_like('tbl_user.username',$kata);
		$this->db->or_like('tbl_group_user.nama_group_user',$kata);
		if($kode=='data'){
			$data = $this->db->get();
			if($data->num_rows() > 0){ return $data->result(); }else{ return false; }
		}else if($kode=='jumlah'){
			return $this->db->get()->num_rows();
		}
	}
	
	function getInfoDetail($id){
		$this->db->from('tbl_user');
		$this->db->join('tbl_group_user','tbl_user.id_group_user=tbl_group_user.id_group_user','left');	
		$this->db->where('tbl_user.id_user',$id);	
		$data = $this->db->get();
		if($data->num_rows() == 1){return $data->row();}else{return false;}
	}
}
?>