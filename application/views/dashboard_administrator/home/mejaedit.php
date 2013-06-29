  <?php if($this->session->flashdata('pesan')) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>	  	
		<?php echo $this->session->flashdata('pesan'); ?>
	</div>
  <?php } ?>
  <div class="well">
  <?php if($meja){ ?>
	<div class="navbar navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">                
		  <a class="brand" href="#">Informasi Meja <?php echo ucwords(strtolower($meja->nama_meja)); ?></a>	          
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->      
    <section>
    <script type="text/javascript">
	function cekEditMeja(){
		var nama = $('#nama').val();
		var ket = $('#keterangan').val();
		var status = $('#status').val();		
		
		if(nama.length < 1 || ket.length < 1 || status.length < 1){
			alert('Maaf, informasi tidak boleh kosong');
		}else{
			if(isNaN(status)){
				alert('status harus ada');
			}else{				
				if(confirm('Anda yakin ingin memperbaharui meja ini ?')){				
					document.getElementById('formedit').submit();
				}
			}
		}
	}
	</script>
    <?php
	echo form_open_multipart('dashboard_administrator/meja/edit/'.$meja->id_meja,array('class'=>'form-horizontal','id'=>'formedit','onsubmit'=>'cekEditMeja();return false;'));
	echo form_hidden(array('id'=>$meja->id_meja,'proses'=>'edit'));
	echo "<input type='hidden' name='kode' id='kode' value='normal' />";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Nama Meja</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'nama','id'=>'nama','class'=>'input-large','value'=>$meja->nama_meja));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Keterangan Meja</label>";
	echo "<div class='controls'>";
	echo form_textarea(array('id'=>'keterangan','name'=>'keterangan','style'=>'width:400px;height:100px','value'=>$meja->keterangan_meja));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Status Meja</label>";
	echo "<div class='controls'>";
	echo form_dropdown('status',array('1'=>'Ada','0'=>'Kosong'),'','id="status" class="input-small"');
	echo "</div>";
	echo "</div>";	
	echo "<div class='control-group'>";	
	echo "<div class='controls'>";
	echo form_submit(array('name'=>'btnedit','value'=>'Perbaharui','class'=>'btn btn-primary'));	
	echo "&nbsp;&nbsp;<a href='".base_url()."index.php/dashboard_administrator/meja'><input class='btn' type='button' value='kembali' /></a>";
	echo "</div>";
	echo "</div>";		
	echo form_close();
	
	?>
    </section>   
    <?php }else{ echo "kosong";} ?>  
  </div>