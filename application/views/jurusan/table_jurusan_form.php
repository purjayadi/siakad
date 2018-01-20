<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Table_jurusan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Jurusan <?php echo form_error('nama_jurusan') ?></label>
            <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" placeholder="Nama Jurusan" value="<?php echo $nama_jurusan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenjang <?php echo form_error('jenjang') ?></label>
            <input type="text" class="form-control" name="jenjang" id="jenjang" placeholder="Jenjang" value="<?php echo $jenjang; ?>" />
        </div>
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	    <input type="hidden" name="kode_jurusan" value="<?php echo $kode_jurusan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jurusan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>