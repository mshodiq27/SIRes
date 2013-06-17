  <div class="well">
	<div class="navbar navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">
		  <a class="brand" href="#">Lorem Ipsum</a>
		  <div class="nav-collapse">
			<ul class="nav">
			  <li><a href="#" class="medium-box"><i class="icon-plus-sign icon-white"></i> Tambah Data</a></li>
			</ul>
		  </div>
		<div class="span6 pull-right">
		<?php echo form_open("dashboard_administrator/cari", 'class="navbar-form pull-right"'); ?>
		  <input type="text" class="span3" name="cari" placeholder="Masukkan kata kunci pencarian">
		  <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>
		<?php echo form_close(); ?>
		</div>
		</div>
	  </div><!-- /navbar-inner -->
	</div><!-- /navbar -->
  
	  <section>
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>No.</th>
        <th>Value Data 1</th>
		<th>Value Data 2</th>
		<th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1.</td>
        <td>Value 1</td>
        <td>Value 2</td>
		<td>
	        <div class="btn-group">
	          <a class="btn btn-small" href="#"><i class="icon-ok-circle"></i> Lihat Detail</a>
	          <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#"><i class="icon-pencil"></i> Edit Data</a></li>
	            <li><a href="#" onClick="return confirm('Anda yakin..???');"><i class="icon-trash"></i> Hapus Data</a></li>
	          </ul>
	        </div><!-- /btn-group -->
		</td>
      </tr>
    </tbody>
  </table>
	<div class="pagination pagination-centered">
		<ul>
		</ul>
	</div>
</section>
  </div>