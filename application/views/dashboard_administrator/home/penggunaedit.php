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
		  <a class="brand" href="#">Informasi Akun <?php echo ucwords(strtolower($akun->nama_user)); ?></a>	          
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->      
    <section>
    <script type="text/javascript">
	function cekEditPengguna(){		
		var pass = $('#pass').val();
		var alias = $('#alias').val();		
		var group = $('#group').val();
		
		if(pass.length < 1 || alias.length < 1){
			alert('Maaf, informasi tidak boleh kosong');
		}else{
			if(isNaN(group)){
				alert('Group harus ada');
			}else{				
				if(confirm('Anda yakin ingin memperbaharui data pengguna ini ?')){				
					document.getElementById('formedit').submit();
				}
			}
		}
	}
	</script>
    <?php
	echo form_open_multipart('dashboard_administrator/pengguna/edit/'.$akun->id_user,array('class'=>'form-horizontal','id'=>'formedit','onsubmit'=>'cekEditPengguna();return false;'));
	echo form_hidden(array('id'=>$akun->id_user,'proses'=>'edit','uname'=>$akun->username));
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
	echo "<select name='group' id='group'>";
	if($group){
		echo "<option value='".$akun->id_group_user."'>".$akun->nama_group_user."</option>";
		echo "<option value='kosong'>-----------------</option>";
		foreach($group as $g){
			echo "<option value='".$g->id_group_user."'>".$g->nama_group_user."</option>";
		}
	}else{
		echo "<option value='kosong'>Kosong</option>";
	}
	echo "</select>";
	echo "</div>";
	echo "</div>";	
	echo "<div class='control-group'>";	
	echo "<div class='controls'>";
	echo form_submit(array('name'=>'btnedit','value'=>'Perbaharui','class'=>'btn btn-primary'));	
	echo "&nbsp;&nbsp;<a href='".base_url()."index.php/dashboard_administrator/pengguna'><input class='btn' type='button' value='kembali' /></a>";
	echo "</div>";
	echo "</div>";			
	echo form_close();
	
	?>
    </section>   
    <?php }else{ echo "kosong";} ?>  
  </div>