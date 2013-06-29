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
		  <a class="brand" href="<?php echo base_url(); ?>index.php/dashboard_administrator/pesanan">Daftar Pesanan</a>
		  <div class="nav-collapse">
			<ul class="nav">
			  <li><a href="#" class="medium-box"><i class="icon-plus-sign icon-white"></i> Cetak Excel</a></li>
			</ul>
		  </div>		
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->
  
  <script type="text/javascript"> 
  function hapusPesanan(id){
	  if(confirm('Apakah Anda yakin ingin menghapus data ini ?')){
		  $.ajax({
		  	url:'<?php echo base_url(); ?>index.php/dashboard_administrator/hapusdata?opt=pesanandetail&id='+id+'&data=hapus',
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
  <strong>
  <table border="0" cellspacing="20px" width="100%">
  <tr>
  	<td width="10%">Meja Makan</td>
    <td>:&nbsp;&nbsp;<?php if($pesanan){echo $pesanan->nama_meja;}else{echo "Kosong";} ?></td>
  </tr>
  <tr>
  	<td width="10%">Pelayan</td>
    <td>:&nbsp;&nbsp;<?php if($pelayan){echo $pelayan->nama_user;}else{echo "Kosong";} ?></td>
  </tr>
   <tr>
  	<td width="10%">Waktu Pesan</td>
    <td>:&nbsp;&nbsp;<?php if($pesanan){$waktu = mysql_to_unix($pesanan->waktu_pesan); echo mdate('%d-%m-%Y %h:%i:%s',$waktu);}else{echo "Kosong";} ?></td>
  </tr>
  </table>
  </strong>  
  <div style="padding:10px;"></div>
  </section>
  
  <!--Makanan-->
  <section>
  <table class="table table-hover table-condensed" width="100%">
    <thead>
      <tr>
        <th width="5%">No.</th>
        <th width="20%">Nama Makanan</th>
        <th width="30%">Keterangan</th>		
        <th width="30%">Harga</th>
		<th width="20">Aksi</th>
      </tr>
    </thead>
    <tbody>
    	<?php
		$total = 0;
		if($makanan){
			$nomor = 1;			
			foreach($makanan as $m){
				echo "<tr>";
				echo "<td>".$nomor.".</td>";
				echo "<td>".$m->nama_makanan."</td>";
				echo "<td>".$m->keterangan_makanan."</td>";				
				echo "<td>Rp. ".number_format($m->harga,2,',','.')."</td>";				
				echo "<td>";
				echo "<div class='btn-group'>
	          			<a class='btn btn-small' href='#' onclick=\"hapusPesanan(".$m->no.");return false;\"><i class='icon-trash'></i> Hapus</a>	          			
					</div>";
				echo "</td></tr>";
				$nomor++;
				$total += $m->harga;				
			}
		}else{
			echo "<tr><td colspan='5' align='center'>Kosong</td></tr>";
		}
		?>              
    </tbody>
  </table>	
</section>

<!--Minuman-->
  <section>
  <table class="table table-hover table-condensed" width="100%">
    <thead>
      <tr>
        <th width="5%">No.</th>
        <th width="20%">Nama Minuman</th>
        <th width="30%">Keterangan</th>		
        <th width="30%">Harga</th>
		<th width="20">Aksi</th>
      </tr>
    </thead>
    <tbody>
    	<?php
		if($minuman){
			$nomor = 1;
			foreach($minuman as $m){
				echo "<tr>";
				echo "<td>".$nomor.".</td>";
				echo "<td>".$m->nama_minuman."</td>";
				echo "<td>".$m->keterangan_minuman."</td>";				
				echo "<td>Rp. ".number_format($m->harga,2,',','.')."</td>";				
				echo "<td>";
				echo "<div class='btn-group'>
	          			<a class='btn btn-small' href='#' onclick=\"hapusPesanan(".$m->no.");return false;\"><i class='icon-trash'></i> Hapus</a>	          			
					</div>";
				echo "</td></tr>";
				$nomor++;
				$total += $m->harga;
			}
		}else{
			echo "<tr><td colspan='5' align='center'>Kosong</td></tr>";
		}
		?>      
    </tbody>
  </table>	
</section>

<section>
<strong style="color:red;">
  <table border="0" cellspacing="20px" width="100%">
  <tr>
  	<td width="10%">Total</td>
    <td>:&nbsp;&nbsp;Rp. <?php echo number_format($total,2,',','.'); ?></td>
  </tr>  
  </table>
  </strong>
</section>
  </div>