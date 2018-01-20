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
        <h2 style="margin-top:0px">Table_ukmppd <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Table Koas Nim <?php echo form_error('table_koas_nim') ?></label>
            <input type="text" class="form-control" name="table_koas_nim" id="table_koas_nim" placeholder="Table Koas Nim" value="<?php echo $table_koas_nim; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Yudisium <?php echo form_error('yudisium') ?></label>
            <input type="text" class="form-control" name="yudisium" id="yudisium" placeholder="Yudisium" value="<?php echo $yudisium; ?>" />
        </div>
	    <div class="form-group">
            <label for="buku">Buku <?php echo form_error('buku') ?></label>
            <textarea class="form-control" rows="3" name="buku" id="buku" placeholder="Buku"><?php echo $buku; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="enum">Administrasi <?php echo form_error('administrasi') ?></label>
            <input type="text" class="form-control" name="administrasi" id="administrasi" placeholder="Administrasi" value="<?php echo $administrasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="ktp">Ktp <?php echo form_error('ktp') ?></label>
            <input type="file" class="form-control" name="userfiles[]" id="ktp" placeholder="Administrasi" value="<?php echo $ktp; ?>" />
        </div>
	    <div class="form-group">
            <label for="akta_kelahiran">Akta Kelahiran <?php echo form_error('akta_kelahiran') ?></label>
            <input type="file" class="form-control" name="userfiles[]" id="akta_kelahiran" placeholder="Administrasi" value="<?php echo $akta_kelahiran; ?>" />
        </div>
	    <div class="form-group">
            <label for="ktm">Ktm <?php echo form_error('ktm') ?></label>
            <input type="file" class="form-control" name="userfiles[]" id="ktm" placeholder="Administrasi" value="<?php echo $ktm; ?>" />
        </div>
	    <div class="form-group">
            <label for="ijasah_sked">Ijasah Sked <?php echo form_error('ijasah_sked') ?></label>
           <input type="file" class="form-control" name="userfiles[]" id="ijasah_sked" placeholder="Administrasi" value="<?php echo $ijasah_sked; ?>" />
        </div>
	    <div class="form-group">
            <label for="ijasah_sma">Ijasah Sma <?php echo form_error('ijasah_sma') ?></label>
           <input type="file" class="form-control" name="userfiles[]" id="ijasah_sma" placeholder="Administrasi" value="<?php echo $ijasah_sma; ?>" />
        </div>
	    <div class="form-group">
            <label for="photo">Photo <?php echo form_error('photo') ?></label>
            <input type="file" class="form-control" name="userfiles[]" id="photo" placeholder="Administrasi" value="<?php echo $photo; ?>" />
        </div>
	    <input type="hidden" name="idtable_ukmppd" value="<?php echo $idtable_ukmppd; ?>" />
         <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ukmppd') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>