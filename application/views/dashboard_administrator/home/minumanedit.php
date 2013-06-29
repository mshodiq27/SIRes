  <?php if($this->session->flashdata('pesan')) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>	  	
		<?php echo $this->session->flashdata('pesan'); ?>
	</div>
  <?php } ?>
  <div class="well">
  <?php if($minuman){ ?>
	<div class="navbar navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">                
		  <a class="brand" href="#">Informasi Minuman <?php echo ucwords(strtolower($minuman->nama_minuman)); ?></a>	          
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->      
    <section>
    <script type="text/javascript">
	function cekEditMinuman(){
		var nama = $('#nama').val();
		var ket = $('#keterangan').val();
		var status = $('#status').val();
		var harga = $('#harga').val();
		var gambar = $('#gambar').val();
		
		if(nama.length < 1 || ket.length < 1 || status.length < 1 || harga.length < 1){
			alert('Maaf, informasi tidak boleh kosong');
		}else{
			if(isNaN(status) || isNaN(harga)){
				alert('status dan harga harus ada');
			}else{
				if(gambar.length > 0){
					$('#kode').val('gambar');					
				}else{
					$('#kode').val('normal');
				}
				if(confirm('Anda yakin ingin memperbaharui minuman ini ?')){				
					document.getElementById('formedit').submit();
				}
			}
		}
	}
	</script>
    <?php
	echo form_open_multipart('dashboard_administrator/minuman/edit/'.$minuman->id_minuman,array('class'=>'form-horizontal','id'=>'formedit','onsubmit'=>'cekEditMinuman();return false;'));
	echo form_hidden(array('id'=>$minuman->id_minuman,'proses'=>'edit'));
	echo "<input type='hidden' name='kode' id='kode' value='normal' />";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Nama Minuman</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'nama','id'=>'nama','class'=>'input-large','value'=>$minuman->nama_minuman));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Keterangan Minuman</label>";
	echo "<div class='controls'>";
	echo form_textarea(array('id'=>'keterangan','name'=>'keterangan','style'=>'width:400px;height:100px','value'=>$minuman->keterangan_minuman));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Harga Minuman</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'harga','id'=>'harga','class'=>'input-small','value'=>$minuman->harga));
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
	echo "<div class='controls'>";
	echo "<img src='".base_url()."pictures/minuman/".$minuman->foto_minuman."' width='300px' height='300px' class='img-polaroid' alt='foto_minuman' />";
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";	
	echo "<div class='controls'>";
	echo form_submit(array('name'=>'btnedit','value'=>'Perbaharui','class'=>'btn btn-primary'));	
	echo "&nbsp;&nbsp;<a href='".base_url()."index.php/dashboard_administrator/minuman'><input class='btn' type='button' value='kembali' /></a>";
	echo "</div>";
	echo "</div>";		
	echo form_close();
	
	?>
    </section>   
    <?php }else{ echo "kosong";} ?>  
  </div>