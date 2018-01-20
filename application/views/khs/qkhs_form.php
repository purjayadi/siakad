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
        <h2 style="margin-top:0px">Qkhs <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Identry Khs <?php echo form_error('identry_khs') ?></label>
            <input type="text" class="form-control" name="identry_khs" id="identry_khs" placeholder="Identry Khs" value="<?php echo $identry_khs; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nim <?php echo form_error('nim') ?></label>
            <input type="text" class="form-control" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Mahasiswa <?php echo form_error('nama_mahasiswa') ?></label>
            <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Nama Mahasiswa" value="<?php echo $nama_mahasiswa; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kode Matakuliah <?php echo form_error('kode_matakuliah') ?></label>
            <input type="text" class="form-control" name="kode_matakuliah" id="kode_matakuliah" placeholder="Kode Matakuliah" value="<?php echo $kode_matakuliah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Matakuliah <?php echo form_error('nama_matakuliah') ?></label>
            <input type="text" class="form-control" name="nama_matakuliah" id="nama_matakuliah" placeholder="Nama Matakuliah" value="<?php echo $nama_matakuliah; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sks <?php echo form_error('sks') ?></label>
            <input type="text" class="form-control" name="sks" id="sks" placeholder="Sks" value="<?php echo $sks; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nilai <?php echo form_error('nilai') ?></label>
            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Grade <?php echo form_error('grade') ?></label>
            <input type="text" class="form-control" name="grade" id="grade" placeholder="Grade" value="<?php echo $grade; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sksn <?php echo form_error('sksn') ?></label>
            <input type="text" class="form-control" name="sksn" id="sksn" placeholder="Sksn" value="<?php echo $sksn; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Semester <?php echo form_error('nama_semester') ?></label>
            <input type="text" class="form-control" name="nama_semester" id="nama_semester" placeholder="Nama Semester" value="<?php echo $nama_semester; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tahun Ajaran <?php echo form_error('tahun_ajaran') ?></label>
            <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="Tahun Ajaran" value="<?php echo $tahun_ajaran; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('khs') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>