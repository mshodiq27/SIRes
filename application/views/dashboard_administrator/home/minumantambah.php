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
		  <a class="brand" href="#">Tambah Minuman</a>	          
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->      
    <section>
    <script type="text/javascript">
	function cekAddMinuman(){
		var nama = $('#nama').val();
		var ket = $('#keterangan').val();
		var status = $('#status').val();
		var harga = $('#harga').val();
		var gambar = $('#gambar').val();
		
		if(nama.length < 1 || ket.length < 1 || status.length < 1 || harga.length < 1){
			alert('Maaf, informasi tidak boleh kosong');
		}else{
			if(isNaN(status) || isNaN(harga)){
				alert('Status dan harga harus ada');
			}else{
				if(gambar.length > 0){
					$('#kode').val('gambar');					
				}else{
					$('#kode').val('normal');
				}
				if(confirm('Anda yakin ingin menambahkan data minuman ini ?')){				
					document.getElementById('formadd').submit();
				}
			}
		}
	}
	</script>    
    <?php
	echo form_open_multipart('dashboard_administrator/minuman/tambah',array('class'=>'form-horizontal','id'=>'formadd','onsubmit'=>'cekAddMinuman();return false;'));
	echo form_hidden('proses','add');
	echo "<input type='hidden' name='kode' id='kode' value='normal' />";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Nama Minuman</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'nama','id'=>'nama','class'=>'input-large'));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Keterangan Minuman</label>";
	echo "<div class='controls'>";
	echo form_textarea(array('id'=>'keterangan','name'=>'keterangan','style'=>'width:400px;height:100px'));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Harga Minuman</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'harga','id'=>'harga','class'=>'input-small'));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Status Minuman</label>";
	echo "<div class='controls'>";
	echo form_dropdown('status',array('1'=>'Ada','0'=>'Kosong'),'','id="status" class="input-small"');
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Foto Minuman</label>";
	echo "<div class='controls'>";
	echo form_upload(array('name'=>'userfile','id'=>'gambar'));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";	
	echo "<div class='controls'>";
	echo form_submit(array('name'=>'btnadd','value'=>'Simpan','class'=>'btn btn-primary'));	
	echo "&nbsp;&nbsp;<a href='".base_url()."index.php/dashboard_administrator/minuman'><input class='btn' type='button' value='kembali' /></a>";
	echo "</div>";
	echo "</div>";		
	echo form_close();
	
	?>
    </section>       
  </div>