<?php if($this->session->flashdata('pesan')) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>	  	
		<?php echo $this->session->flashdata('pesan'); ?>
	</div>
  <?php } ?>    
  <div class="well">
	<div class="navbar navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">        
		  <a class="brand" href="#">Daftar Pesanan (<?php if(isset($total)){echo $total;} ?>)</a>
		  <div class="nav-collapse">
			<ul class="nav">
			  <li><a href="#" class="medium-box"><i class="icon-plus-sign icon-white"></i> Cetak Excel</a></li>
			</ul>
		  </div>
		<div class="span6 pull-right">
		<?php echo form_open("dashboard_administrator/pesanan/pencarian", array('class'=>'navbar-form pull-right','id'=>'formpencarian','onsubmit'=>'pencarian();return false;')); ?>
		  Dari&nbsp;<input type="text" class="input-small" id="tglawal" name="tglawal" placeholder="Tanggal Mulai">
          &nbsp;Sampai&nbsp;<input type="text" class="input-small" id="tglakhir" name="tglakhir" placeholder="Tanggal Akhir">
		  <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>
		<?php echo form_close(); ?>
		</div>
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->
  
  <script type="text/javascript">
  function pencarian(){
	  var cari = $('#cari').val();
	  
	  if(cari.length < 1){
		  alert('masukkan kata kunci pencarian');
	  }else{
		  $('#formpencarian').submit();
	  }
  }
  
  function hapusPesanan(id){
	  if(confirm('Apakah Anda yakin ingin menghapus data ini ?')){
		  $.ajax({
		  	url:'<?php echo base_url(); ?>index.php/dashboard_administrator/hapusdata?opt=pesanan&id='+id+'&data=hapus',
			cache:false,
			success:function(msg){
				if(msg=='ok'){
					window.location.reload();
				}else{
					alert('Penghapusan gagal');
				}
			}
		  });
	  }
  }
  </script>
  <section>
  <table class="table table-hover table-condensed" width="100%">
    <thead>
      <tr>
        <th width="5%">No.</th>
        <th width="20%">Meja</th>
        <th width="30%">Waktu Pesan</th>		
        <th width="30%">Pelayan</th>
		<th width="20">Aksi</th>
      </tr>
    </thead>
    <tbody>
    	<?php
		if($daftar){
			foreach($daftar as $d){
				echo "<tr>";
				echo "<td>".$nomor.".</td>";
				echo "<td>".$d->nama_meja."</td>";
				echo "<td>";
				$waktu = mysql_to_unix($d->waktu_pesan);
				echo mdate('%d-%m-%Y %h:%i:%s',$waktu);
				echo "</td>";				
				echo "<td>".$d->nama_user."</td>";				
				echo "<td>";
				echo "<div class='btn-group'>
	          			<a class='btn btn-small' href='".base_url()."index.php/dashboard_administrator/pesanan/detail/".$d->id_order."'><i class='icon-ok-circle'></i> Lihat Pesanan</a>
	          			<a class='btn btn-small dropdown-toggle' data-toggle='dropdown' href='#'><span class='caret'></span></a>
					  	<ul class='dropdown-menu'>							
							<li><a href='#' onClick=\"hapusPesanan(".$d->id_order.");return false;\"><i class='icon-trash'></i> Hapus Data</a></li>
					  	</ul>
					</div>";
				echo "</td></tr>";
				$nomor++;
			}
		}else{
			echo "<tr><td colspan='5' align='center'>Kosong</td></tr>";
		}
		?>      
    </tbody>
  </table>
	<div class="pagination pagination-centered">
		<?php echo $halaman; ?>
	</div>
</section>
  </div>