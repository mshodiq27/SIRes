<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Administrator extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','date'));
		$this->load->library(array('pagination'));
		$this->load->model(array('makanan','minuman','meja','akun','pesanan'));
	}
	
	function index()
	{
	   if($this->session->userdata('userlog')){
	   	if($this->session->userdata('userlvl') != 1)redirect(base_url());
       	$this->makanan();
	   }else{redirect(base_url());}
	}
	
	//untuk menu makanan
	function makanan($page=NULL,$id=NULL){
		if($this->session->userdata('userlog')){
	   	if($this->session->userdata('userlvl') != 1)redirect(base_url());		
		$perpage=20;		
		$this->load->view('dashboard_administrator/header');	
		if($page=='edit'){			
			$id=abs($id);
			
			if($this->input->post('proses')=='edit'){
				if($this->input->post('kode') == 'gambar'){
					$config['upload_path'] = "./pictures/makanan/";
					$config['allowed_types'] = 'jpg|png|gif|jpeg';
					$config['max_size'] = '300';
					
					$this->load->library('upload',$config);	
					
					$upload = $this->upload->do_upload();
					$data = $this->upload->data();
					
					$update = array(
						'nama_makanan'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_makanan'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'status_makanan'=>abs($this->input->post('status')),
						'foto_makanan'=>$data['file_name']						
					);					
					
					$cek = $this->makanan->cekMakanan($this->input->post('id'))->num_rows();					
					if($upload){
						if($cek == 1){
							$old = $this->makanan->cekMakanan($this->input->post('id'))->row();
							
							if($this->makanan->updateMakanan($this->input->post('id'),$update)){
								if(file_exists('./pictures/makanan/'.$old->foto_makanan)){
									unlink('./pictures/makanan/'.$old->foto_makanan);
								}
								$this->session->set_flashdata('pesan','Data berhasil diupdate');
								redirect(base_url().'index.php/dashboard_administrator/makanan');
							}else{
								$this->session->set_flashdata('pesan','Data gagal diupdate');
							}
						}
					}												
				}else{
					$update = array(
						'nama_makanan'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_makanan'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'status_makanan'=>abs($this->input->post('status'))									
					);
					
					$cek = $this->makanan->cekMakanan($this->input->post('id'))->num_rows();		
					
					if($cek == 1){						
						if($this->makanan->updateMakanan($this->input->post('id'),$update)){							
							$this->session->set_flashdata('pesan','Data berhasil diupdate');
							redirect(base_url().'index.php/dashboard_administrator/makanan');
						}else{
							$this->session->set_flashdata('pesan','Data gagal diupdate');
						}
					}															
				}
			}
			
			$data['makanan'] = $this->makanan->getInfoDetail($id);			
			$this->load->view('dashboard_administrator/home/makananedit',$data);
		}else if($page=='tambah'){						
			if($this->input->post('proses')=='add'){
				if($this->input->post('kode') == 'gambar'){
					$config['upload_path'] = "./pictures/makanan/";
					$config['allowed_types'] = 'jpg|png|gif|jpeg';
					$config['max_size'] = '300';
					
					$this->load->library('upload',$config);	
					
					$upload = $this->upload->do_upload();
					$data = $this->upload->data();
					
					$simpan = array(
						'nama_makanan'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_makanan'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'status_makanan'=>abs($this->input->post('status')),
						'foto_makanan'=>$data['file_name']						
					);					
					
								
					if($upload){						
						if($this->makanan->simpanMakanan($simpan)){								
							$this->session->set_flashdata('pesan','Data berhasil disimpan');
							redirect(base_url()."index.php/dashboard_administrator/makanan");
						}else{
							$this->session->set_flashdata('pesan','Data gagal disimpan');
							$this->load->view('dashboard_administrator/home/makanantambah');
						}						
					}												
				}else{
					$simpan = array(
						'nama_makanan'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_makanan'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'foto_makanan'=>'kosong.jpg',		
						'status_makanan'=>abs($this->input->post('status'))									
					);							
					
					
					if($this->makanan->simpanMakanan($simpan)){							
						$this->session->set_flashdata('pesan','Data berhasil disimpan');
						redirect(base_url()."index.php/dashboard_administrator/makanan");
					}else{
						$this->session->set_flashdata('pesan','Data gagal disimpan');
						$this->load->view('dashboard_administrator/home/makanantambah');
					}																				
				}
			}else{
				$this->load->view('dashboard_administrator/home/makanantambah');
			}
		}else if($page=='pencarian'){
			$kata = $this->input->post('cari');
			
			$data['daftar']		= $this->makanan->getPencarian('data',$kata);
			$data['halaman'] 	= NULL;
			$data['total'] 		= $this->makanan->getPencarian('jumlah',$kata);
			$data['nomor']		= 1;			
			$this->load->view('dashboard_administrator/home/makanan',$data);
		}else{		
			$page=abs($page);	
			$opsi=array(
				'base_url'=>base_url().'index.php/dashboard_administrator/makanan',
				'total_rows'=>$this->makanan->getAllDaftar(),
				'per_page'=>$perpage,
				'uri_segment'=>3
			);
			
			$this->pagination->initialize($opsi);
			$page=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
			
			$data['daftar']		= $this->makanan->getLimitDaftar($opsi['per_page'],$page);
			$data['halaman'] 	= $this->pagination->create_links();
			$data['total'] 		= $opsi['total_rows'];
			$data['nomor']		= $page+1;			
			$this->load->view('dashboard_administrator/home/makanan',$data);
		}
        $this->load->view('app/footer');
		}else{redirect(base_url());}
	}
	
	//untuk menu minuman
	function minuman($page=NULL,$id=NULL){	
		if($this->session->userdata('userlog')){
	   	if($this->session->userdata('userlvl') != 1)redirect(base_url());	
		$perpage=20;		
		$this->load->view('dashboard_administrator/header');	
		if($page=='edit'){			
			$id=abs($id);
			
			if($this->input->post('proses')=='edit'){
				if($this->input->post('kode') == 'gambar'){
					$config['upload_path'] = "./pictures/minuman/";
					$config['allowed_types'] = 'jpg|png|gif|jpeg';
					$config['max_size'] = '300';
					
					$this->load->library('upload',$config);	
					
					$upload = $this->upload->do_upload();
					$data = $this->upload->data();
					
					$update = array(
						'nama_minuman'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_minuman'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'status_minuman'=>abs($this->input->post('status')),
						'foto_minuman'=>$data['file_name']						
					);					
					
					$cek = $this->minuman->cekMinuman($this->input->post('id'))->num_rows();					
					if($upload){
						if($cek == 1){
							$old = $this->minuman->cekMinuman($this->input->post('id'))->row();
							
							if($this->minuman->updateMinuman($this->input->post('id'),$update)){
								if(file_exists('./pictures/minuman/'.$old->foto_minuman)){
									unlink('./pictures/minuman/'.$old->foto_minuman);
								}
								$this->session->set_flashdata('pesan','Data berhasil diupdate');
								redirect(base_url().'index.php/dashboard_administrator/minuman');
							}else{
								$this->session->set_flashdata('pesan','Data gagal diupdate');
							}
						}
					}else{
						$this->session->set_flashdata('pesan','Data gagal disimpan');						
					}
				}else{
					$update = array(
						'nama_minuman'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_minuman'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'status_minuman'=>abs($this->input->post('status'))									
					);
					
					$cek = $this->minuman->cekMinuman($this->input->post('id'))->num_rows();		
					
					if($cek == 1){						
						if($this->minuman->updateMinuman($this->input->post('id'),$update)){							
							$this->session->set_flashdata('pesan','Data berhasil diupdate');
							redirect(base_url().'index.php/dashboard_administrator/minuman');
						}else{
							$this->session->set_flashdata('pesan','Data gagal diupdate');
						}
					}															
				}
			}
			
			$data['minuman'] = $this->minuman->getInfoDetail($id);			
			$this->load->view('dashboard_administrator/home/minumanedit',$data);
		}else if($page=='tambah'){						
			if($this->input->post('proses')=='add'){
				if($this->input->post('kode') == 'gambar'){
					$config['upload_path'] = "./pictures/minuman/";
					$config['allowed_types'] = 'jpg|png|gif|jpeg';
					$config['max_size'] = '300';
					
					$this->load->library('upload',$config);	
					
					$upload = $this->upload->do_upload();
					$data = $this->upload->data();
					
					$simpan = array(
						'nama_minuman'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_minuman'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'status_minuman'=>abs($this->input->post('status')),
						'foto_minuman'=>$data['file_name']						
					);					
					
								
					if($upload){						
						if($this->minuman->simpanMinuman($simpan)){								
							$this->session->set_flashdata('pesan','Data berhasil disimpan');
							redirect(base_url()."index.php/dashboard_administrator/minuman");
						}else{
							$this->session->set_flashdata('pesan','Data gagal disimpan');
							$this->load->view('dashboard_administrator/home/minumantambah');
						}						
					}else{
						$this->session->set_flashdata('pesan','Data gagal disimpan');
						$this->load->view('dashboard_administrator/home/minumantambah');
					}
				}else{
					$simpan = array(
						'nama_minuman'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_minuman'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'harga'=>abs($this->input->post('harga')),
						'foto_minuman'=>'kosong.jpg',		
						'status_minuman'=>abs($this->input->post('status'))									
					);							
					
					
					if($this->minuman->simpanMinuman($simpan)){							
						$this->session->set_flashdata('pesan','Data berhasil disimpan');
						redirect(base_url()."index.php/dashboard_administrator/minuman");
					}else{
						$this->session->set_flashdata('pesan','Data gagal disimpan');
						$this->load->view('dashboard_administrator/home/minumantambah');
					}																				
				}
			}else{
				$this->load->view('dashboard_administrator/home/minumantambah');
			}
		}else if($page=='pencarian'){
			$kata = $this->input->post('cari');
			
			$data['daftar']		= $this->minuman->getPencarian('data',$kata);
			$data['halaman'] 	= NULL;
			$data['total'] 		= $this->minuman->getPencarian('jumlah',$kata);
			$data['nomor']		= 1;			
			$this->load->view('dashboard_administrator/home/minuman',$data);
		}else{		
			$page=abs($page);	
			$opsi=array(
				'base_url'=>base_url().'index.php/dashboard_administrator/minuman',
				'total_rows'=>$this->minuman->getAllDaftar(),
				'per_page'=>$perpage,
				'uri_segment'=>3
			);
			
			$this->pagination->initialize($opsi);
			$page=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
			
			$data['daftar']		= $this->minuman->getLimitDaftar($opsi['per_page'],$page);
			$data['halaman'] 	= $this->pagination->create_links();
			$data['total'] 		= $opsi['total_rows'];
			$data['nomor']		= $page+1;			
			$this->load->view('dashboard_administrator/home/minuman',$data);
		}
        $this->load->view('app/footer');
		}else{redirect(base_url());}
	}
	
	//untuk daftar meja
	function meja($page=NULL,$id=NULL){	
		if($this->session->userdata('userlog')){
	   	if($this->session->userdata('userlvl') != 1)redirect(base_url());	
		$perpage=20;		
		$this->load->view('dashboard_administrator/header');	
		if($page=='edit'){			
			$id=abs($id);
			
			if($this->input->post('proses')=='edit'){
				if($this->input->post('kode') == 'normal'){
					$update = array(
						'nama_meja'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_meja'=>ucfirst(strtolower($this->input->post('keterangan'))),
						'status_meja'=>abs($this->input->post('status'))									
					);
					
					$cek = $this->meja->cekMeja($this->input->post('id'))->num_rows();		
					
					if($cek == 1){						
						if($this->meja->updateMeja($this->input->post('id'),$update)){							
							$this->session->set_flashdata('pesan','Data berhasil diupdate');
							redirect(base_url().'index.php/dashboard_administrator/meja');
						}else{
							$this->session->set_flashdata('pesan','Data gagal diupdate');
						}
					}															
				}else{redirect(base_url());}
			}
			
			$data['meja'] = $this->meja->getInfoDetail($id);			
			$this->load->view('dashboard_administrator/home/mejaedit',$data);
		}else if($page=='tambah'){						
			if($this->input->post('proses')=='add'){		
				if($this->input->post('kode') == 'normal'){		
					$simpan = array(
						'nama_meja'=>ucwords(strtolower($this->input->post('nama'))),
						'keterangan_meja'=>ucfirst(strtolower($this->input->post('keterangan'))),						
						'status_meja'=>abs($this->input->post('status'))									
					);							
						
						
					if($this->meja->simpanMeja($simpan)){							
						$this->session->set_flashdata('pesan','Data berhasil disimpan');
						redirect(base_url()."index.php/dashboard_administrator/meja");
					}else{
						$this->session->set_flashdata('pesan','Data gagal disimpan');
						$this->load->view('dashboard_administrator/home/mejatambah');
					}																								
				}else{redirect(base_url());}
			}else{
				$this->load->view('dashboard_administrator/home/mejatambah');
			}			
		}else if($page=='pencarian'){
			$kata = $this->input->post('cari');
			
			$data['daftar']		= $this->meja->getPencarian('data',$kata);
			$data['halaman'] 	= NULL;
			$data['total'] 		= $this->meja->getPencarian('jumlah',$kata);
			$data['nomor']		= 1;			
			$this->load->view('dashboard_administrator/home/meja',$data);
		}else{		
			$page=abs($page);	
			$opsi=array(
				'base_url'=>base_url().'index.php/dashboard_administrator/meja',
				'total_rows'=>$this->meja->getAllDaftar(),
				'per_page'=>$perpage,
				'uri_segment'=>3
			);
			
			$this->pagination->initialize($opsi);
			$page=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
			
			$data['daftar']		= $this->meja->getLimitDaftar($opsi['per_page'],$page);
			$data['halaman'] 	= $this->pagination->create_links();
			$data['total'] 		= $opsi['total_rows'];
			$data['nomor']		= $page+1;			
			$this->load->view('dashboard_administrator/home/meja',$data);
		}
        $this->load->view('app/footer');
		}else{redirect(base_url());}
	}
	
	//hapus data
	function hapusdata(){
		if($this->session->userdata('userlog')){
	   	if($this->session->userdata('userlvl') != 1)redirect(base_url());
		if($this->input->get('opt')=='makanan' and $this->input->get('data')=='hapus'){
			$id=abs($this->input->get('id'));			
			$hapus = $this->makanan->hapusData($id);
			if($hapus){ echo "ok";}else{ echo "gagal";}
		}else if($this->input->get('opt')=='minuman' and $this->input->get('data')=='hapus'){
			$id=abs($this->input->get('id'));			
			$hapus = $this->minuman->hapusData($id);
			if($hapus){ echo "ok";}else{ echo "gagal";}
		}else if($this->input->get('opt')=='meja' and $this->input->get('data')=='hapus'){
			$id=abs($this->input->get('id'));			
			$hapus = $this->meja->hapusData($id);
			if($hapus){ echo "ok";}else{ echo "gagal";}
		}else if($this->input->get('opt')=='pengguna' and $this->input->get('data')=='hapus'){
			$id=abs($this->input->get('id'));			
			$hapus = $this->akun->hapusData($id);
			if($hapus){ echo "ok";}else{ echo "gagal";}
		}else if($this->input->get('opt')=='pesanan' and $this->input->get('data')=='hapus'){
			$id=abs($this->input->get('id'));			
			$hapus = $this->pesanan->hapusData($id);
			if($hapus){ echo "ok";}else{ echo "gagal";}
		}else if($this->input->get('opt')=='pesanan' and $this->input->get('data')=='hapus'){
			$id=abs($this->input->get('id'));			
			$hapus = $this->pesanan->hapusData($id);
			if($hapus){ echo "ok";}else{ echo "gagal";}
		}else if($this->input->get('opt')=='pesanandetail' and $this->input->get('data')=='hapus'){
			$id=abs($this->input->get('id'));			
			$hapus = $this->pesanan->hapusDataDetail($id);
			if($hapus){ echo "ok";}else{ echo "gagal";}
		}else{echo "gagal";}		
		}else{redirect(base_url());}
	}
	
	//user
	function pengguna($page=NULL,$id=NULL){
		if($this->session->userdata('userlog')){
	   	if($this->session->userdata('userlvl') != 1)redirect(base_url());
		$perpage=20;				
		$data['group'] = $this->akun->getGroup();	
		if($page=='tambah'){
			$this->load->view('dashboard_administrator/header');			
			if($this->input->post('proses')=='add'){		
				if($this->input->post('kode') == 'normal'){		
					$simpan = array(
						'username'=>$this->input->post('uname'),
						'password'=>md5($this->input->post('pass')),						
						'nama_user'=>ucwords(strtolower($this->input->post('alias'))),
						'id_group_user'=>abs($this->input->post('group'))									
					);							
						
					$cek = $this->akun->cekAkun('baru',$simpan['username']);
					if($cek == 0){
						if($this->akun->simpanAkun($simpan)){							
							$this->session->set_flashdata('pesan','Data berhasil disimpan');
							redirect(base_url()."index.php/dashboard_administrator/pengguna");
						}else{
							$this->session->set_flashdata('pesan','Data gagal disimpan');
							$this->load->view('dashboard_administrator/home/penggunatambah',$data);
						}		
					}else{
						$this->session->set_flashdata('pesan','Akun sudah ada sebelumnya');
						$this->load->view('dashboard_administrator/home/penggunatambah',$data);
					}
				}else{redirect(base_url());}
			}else{
				$this->load->view('dashboard_administrator/home/penggunatambah',$data);
			}
		}else if($page=='edit'){
			$this->load->view('dashboard_administrator/header');			
			$id=abs($id);
			
			if($this->input->post('proses')=='edit'){
				if($this->input->post('kode') == 'normal'){
					$update = array(	
						'username'=>$this->input->post('uname'),					
						'password'=>md5($this->input->post('pass')),						
						'nama_user'=>ucwords(strtolower($this->input->post('alias'))),
						'id_group_user'=>abs($this->input->post('group'))									
					);
					
					$cek = $this->akun->cekAkun('update',$this->input->post('id'));		
					
					if($cek == 1){						
						if($this->akun->updateAkun($this->input->post('id'),$update)){							
							$this->session->set_flashdata('pesan','Data berhasil diupdate');
							redirect(base_url().'index.php/dashboard_administrator/pengguna');
						}else{
							$this->session->set_flashdata('pesan','Data gagal diupdate');
						}
					}else{
						$this->session->set_flashdata('pesan','Akun tidak ditemukan');
					}															
				}else{redirect(base_url());}
			}
			
			$data['akun'] = $this->akun->getInfoDetail($id);			
			$this->load->view('dashboard_administrator/home/penggunaedit',$data);
		}else if($page=='password'){
			if($this->input->post('proses')=='changepass'){
				if($this->input->post('kode') == 'normal'){
					$update = array(							
						'password'=>md5($this->input->post('pass')),						
						'nama_user'=>ucwords(strtolower($this->input->post('alias'))),						
					);
					
					$cek = $this->akun->cekAkun('update',$this->session->userdata('userid'));		
					
					if($cek == 1){						
						if($this->akun->updateAkun($this->session->userdata('userid'),$update)){							
							$this->session->set_flashdata('pesan','Data berhasil diupdate');							
						}else{
							$this->session->set_flashdata('pesan','Data gagal diupdate');
						}
					}else{
						$this->session->set_flashdata('pesan','Akun tidak ditemukan');
					}															
				}else{redirect(base_url());}
			}
			
			$data['akun'] = $this->akun->getInfoDetail($this->session->userdata('userid'));
			if($data['akun']){				
				$akun = $data['akun'];
				$sesi=array(
					'userid'=>$akun->id_user,
					'username'=>$akun->username,
					'useralias'=>$akun->nama_user,
					'userlvl'=>$akun->id_group_user,
					'userlog'=>true
				);
				
				
				$this->session->set_userdata($sesi);
			}
			$this->load->view('dashboard_administrator/header');
			$this->load->view('dashboard_administrator/home/password',$data);
		}else if($page=='pencarian'){
			$this->load->view('dashboard_administrator/header');
			$kata = $this->input->post('cari');
			
			$data['daftar']		= $this->akun->getPencarian('data',$kata);
			$data['halaman'] 	= NULL;
			$data['total'] 		= $this->akun->getPencarian('jumlah',$kata);
			$data['nomor']		= 1;			
			$this->load->view('dashboard_administrator/home/pengguna',$data);
		}else{
			$this->load->view('dashboard_administrator/header');
			$page=abs($page);	
			$opsi=array(
				'base_url'=>base_url().'index.php/dashboard_administrator/pengguna',
				'total_rows'=>$this->akun->getAllDaftar(),
				'per_page'=>$perpage,
				'uri_segment'=>3
			);
			
			$this->pagination->initialize($opsi);
			$page=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
			
			$data['daftar']		= $this->akun->getLimitDaftar($opsi['per_page'],$page);
			$data['halaman'] 	= $this->pagination->create_links();
			$data['total'] 		= $opsi['total_rows'];
			$data['nomor']		= $page+1;			
			$this->load->view('dashboard_administrator/home/pengguna',$data);
		}
		$this->load->view('app/footer');
		}else{redirect(base_url());}
	}
	
	//pesanan
	function pesanan($page=NULL,$id=NULL){
		if($this->session->userdata('userlog')){
	   		if($this->session->userdata('userlvl') != 1)redirect(base_url());
			if($page=='detail'){
				$id=abs($id);
				$data['makanan'] = $this->makanan->getDetailOrder($id);
				$data['minuman'] = $this->minuman->getDetailOrder($id);
				$data['pesanan'] = $this->pesanan->getDetailInfo($id);
				if($data['pesanan']){$idpelayan = $data['pesanan']->id_user;}else{ $idpelayan = 0;}				
				$data['pelayan'] = $this->akun->getInfoDetail($idpelayan);
				
				$this->load->view('dashboard_administrator/header');		
				$this->load->view('dashboard_administrator/home/detailpesanan',$data);	
				$this->load->view('app/footer');
			}else{
				$this->load->view('dashboard_administrator/header');		
				$opsi=array(
					'base_url'=>base_url().'index.php/dashboard_administrator/pesanan',
					'total_rows'=>$this->pesanan->getAllDaftar(),
					'per_page'=>30,
					'uri_segment'=>3
				);
				
				$this->pagination->initialize($opsi);
				$page=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
				
				$data['daftar']		= $this->pesanan->getLimitDaftar($opsi['per_page'],$page);
				$data['halaman'] 	= $this->pagination->create_links();
				$data['total'] 		= $opsi['total_rows'];
				$data['nomor']		= $page+1;			
				$this->load->view('dashboard_administrator/home/pesanan',$data);	
				$this->load->view('app/footer');
			}			
		}
	}
	
	function cetak($page=NULL,$id=NULL){
		if($this->session->userdata('userlog')){
	   		if($this->session->userdata('userlvl') != 1)redirect(base_url());
			$this->load->library('PHPExcel');									
			$this->load->library('PHPExcel/IOFactory');
			if($page=='pesanan'){
				$id=abs($id);
				$obj = new PHPExcel();
				$obj->getProperties()->setTitle("Laporan Pesanan");
			}else if($page=='detail'){
				
			}else{
				redirect(base_url());
			}
		}
	}
}

