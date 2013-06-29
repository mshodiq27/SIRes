<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('akun');
	}
	
	function index()
	{
		if($this->input->post('login')=='ya'){
			$user = $this->input->post('username');
			$pass = md5($this->input->post('password'));
			
			$akun = $this->akun->getAkun($user,$pass);
			if($akun->num_rows() == 1){
				$data = $akun->row();
				$sesi=array(
					'userid'=>$data->id_user,
					'username'=>$data->username,
					'useralias'=>$data->nama_user,
					'userlvl'=>$data->id_group_user,
					'userlog'=>true
				);
				
				$this->session->set_userdata($sesi);
				redirect(base_url().'index.php/dashboard_administrator');
			}else{
				$this->session->set_flashdata('result_login','Akun tidak ditemukan');
				$this->load->view('app/login');
			}
		}else{
			$this->load->view('app/login');
		}
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

