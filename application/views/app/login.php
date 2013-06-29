
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->config->item('judul_lengkap').' - '.$this->config->item('nama_perusahaan'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
	
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/application.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo base_url(); ?>"><?php echo $this->config->item('judul_pendek'); ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="<?php echo base_url(); ?>"><i class="icon-home icon-white"></i> Beranda</a></li>
			  <li class="dropdown">
			  	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Panduan <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><i class="icon-fire"></i> Administrator</a></li>
                  <li><a href="#"><i class="icon-asterisk"></i> Pelayan</a></li>
                  <li><a href="#"><i class="icon-leaf"></i> Kitchen</a></li>
                </ul>
              </li>
            </ul>
            <?php if($this->session->userdata('userlog')){ ?>
            <div class="btn-group pull-right">
			  <a href="<?php echo base_url(); ?>index.php/dashboard_administrator"><button class="btn btn-primary">Dashboard</button></a>
			  <a href="<?php echo base_url(); ?>index.php/app/logout" ><button class="btn btn-primary"><i class="icon-user icon-white"></i> Logout</button></a>
			</div>
            <?php }else{ ?>
			<?php echo form_open('app/index','class="navbar-form pull-right"'); echo form_hidden('login','ya'); ?>
            	
              <input class="span2" type="text" name="username" placeholder="Username..." value="<?php echo set_value('username'); ?>">
              <input class="span2" type="password" name="password" placeholder="Password...">
              <button type="submit" class="btn btn-primary "><i class="icon-share icon-white"></i> Log in</button>
           <?php echo form_close(); ?>
           <?php } ?>           
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
	
	<?php if(validation_errors()) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  	<h4>Terjadi Kesalahan!</h4>
		<?php echo validation_errors(); ?>
	</div>
	<?php } ?>
	
	<?php if($this->session->flashdata('result_login')) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  	<h4>Terjadi Kesalahan!</h4>
		<?php echo $this->session->flashdata('result_login'); ?>
	</div>
	<?php } ?>
      <div class="hero-unit">
        <h2>Selamat Datang di <?php echo $this->config->item('judul_lengkap').' '.$this->config->item('instansi'); ?></h2>
        <p><?php echo $this->config->item('judul_lengkap').' '.$this->config->item('instansi'); ?> merupakan sebuah aplikasi untuk melakukan manajemen pesanan dan POS restoran di <?php $this->config->item('instansi');?>. Silahkan masukkan username dan password anda untuk mulai melakukan manajemen atau pengolahan data sesuai dengan hak akses yang anda miliki.</p>
        <p><a href="http://fb.me/khaer.ansori.nad/" class="btn btn-primary btn-large">Meet the Creator <i class="icon-circle-arrow-right icon-white"></i> </a></p>
      </div>


      <footer class="well">
        <p><?php echo $this->config->item('credit'); ?></p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
