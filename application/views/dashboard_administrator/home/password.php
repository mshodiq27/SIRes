  <?php if($this->session->flashdata('pesan')) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>	  	
		<?php echo $this->session->flashdata('pesan'); ?>
	</div>
  <?php } ?>
  <div class="well">
  <?php if($akun){ ?>
	<div class="navbar navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">                
		  <a class="brand" href="#">Informasi Akun Pribadi</a>	          
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->      
    <section>
    <script type="text/javascript">
	function cekEditPengguna(){		
		var pass = $('#pass').val();
		var alias = $('#alias').val();				
		
		if(pass.length < 1 || alias.length < 1){
			alert('Maaf, informasi tidak boleh kosong');
		}else{
			if(confirm('Anda yakin ingin memperbaharui data pengguna ini ?')){				
				document.getElementById('formedit').submit();
			}			
		}
	}
	</script>
    <?php
	echo form_open_multipart('dashboard_administrator/pengguna/password',array('class'=>'form-horizontal','id'=>'formedit','onsubmit'=>'cekEditPengguna();return false;'));
	echo form_hidden(array('proses'=>'changepass'));
	echo "<input type='hidden' name='kode' id='kode' value='normal' />";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Username</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'uname','id'=>'uname','class'=>'input-large','value'=>$akun->username,'disabled'=>'disabled'));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Password</label>";
	echo "<div class='controls'>";
	echo form_password(array('name'=>'pass','id'=>'pass','class'=>'input-large'));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Nama Pengguna</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'alias','id'=>'alias','class'=>'input-large','value'=>$akun->nama_user));
	echo "</div>";
	echo "</div>";
	echo "<div class='control-group'>";
	echo "<label class='control-label'>Group</label>";
	echo "<div class='controls'>";
	echo form_input(array('name'=>'group','id'=>'group','class'=>'input-large','value'=>$akun->nama_group_user,'disabled'=>'disabled'));
	echo "</div>";
	echo "</div>";		
	echo "<div class='control-group'>";	
	echo "<div class='controls'>";
	echo form_submit(array('name'=>'btnedit','value'=>'Perbaharui','class'=>'btn btn-primary'));		
	echo "</div>";
	echo "</div>";			
	echo form_close();
	
	?>
    </section>   
    <?php }else{ echo "kosong";} ?>  
  </div>