  <?php if($this->session->flashdata('pesan')) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>	  	
		<?php echo $this->session->flashdata('pesan'); ?>
	</div>
  <?php } ?>
  <div class="well">
  <?php if($makanan){ ?>
	<div class="navbar navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">                
		  <a class="brand" href="#">Informasi Makanan <?php echo ucwords(strtolower($makanan->nama_makanan)); ?></a>	          
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->      
    <section>
    <script type="text/javascript">
	function cekEditMakanan(){
		var nama = $('#nama').val();
		var ket = $('#keterangan').val();
		var status = $('#status').val();
		var harga = $('#harga').val();
		var gambar = $('#gambar').val();
		
		if(nama.length < 1 || ket.length < 1 || status.length < 1 || harga.length < 1){
			alert('Maaf, informasi tidak boleh kosong');
		}else{
			if(isNaN(status) || isNaN(harga)){
				alert('Status dan Harga harus ada');
			}else{
				if(gambar.length > 0){
					$('#kode').val('gambar');					
				}else{
					$('#kode').val('normal');
				}
				if(confirm('Anda yakin ingin memperbaharui makanan ini ?')){				
					document.getElementById('formedit').submit();
				}
			}
		}
	}
	</script>
    <?php
	echo form_open_multipart('dashboard_administrator/makanan/edit/'.$makanan->id_makanan,array('class'=>'form-horizontal','id'=>'formedit','onsubmit'=>'cekEditMakanan();return false;'));
	echo form_hidden(array('id'=>$makanan->id_makanan,'proses'=>'edit'));
	echo "<input type='hidden' name='kode' id='kode' value='normal' />";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Nama Makanan</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'nama','id'=>'nama','class'=>'input-large','value'=>$makanan->nama_makanan));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Keterangan Makanan</label>";
	echo "<div class='controls'>";
	echo form_textarea(array('id'=>'keterangan','name'=>'keterangan','style'=>'width:400px;height:100px','value'=>$makanan->keterangan_makanan));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Harga Makanan</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'harga','id'=>'harga','class'=>'input-small','value'=>$makanan->harga));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Status Makanan</label>";
	echo "<div class='controls'>";	
	echo form_dropdown('status',array('1'=>'Ada','0'=>'Kosong'),'','id="status" class="input-small"');
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Foto Makanan</label>";
	echo "<div class='controls'>";
	echo form_upload(array('name'=>'userfile','id'=>'gambar'));
	echo "</div>";
	echo "<div class='controls'>";
	echo "<img src='".base_url()."pictures/makanan/".$makanan->foto_makanan."' width='300px' height='300px' class='img-polaroid' alt='foto_makanan' />";
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";	
	echo "<div class='controls'>";
	echo form_submit(array('name'=>'btnedit','value'=>'Perbaharui','class'=>'btn btn-primary'));	
	echo "&nbsp;&nbsp;<a href='".base_url()."index.php/dashboard_administrator/makanan'><input class='btn' type='button' value='kembali' /></a>";
	echo "</div>";
	echo "</div>";		
	echo form_close();
	
	?>
    </section>   
    <?php }else{ echo "kosong";} ?>  
  </div>