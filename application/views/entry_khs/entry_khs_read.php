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
        <h2 style="margin-top:0px">Entry_khs Read</h2>
        <table class="table">
	    <tr><td>Table Mahasiswa Id Mahasiswa</td><td><?php echo $table_mahasiswa_id_mahasiswa; ?></td></tr>
	    <tr><td>Table Matakuliah Id Matakuliah</td><td><?php echo $table_matakuliah_id_matakuliah; ?></td></tr>
	    <tr><td>Table Nilai Id Nilai</td><td><?php echo $table_nilai_id_nilai; ?></td></tr>
	    <tr><td>Table Semester Id Semester</td><td><?php echo $table_semester_id_semester; ?></td></tr>
	    <tr><td>Tahun Ajaran</td><td><?php echo $tahun_ajaran; ?></td></tr>
	    <tr><td>Sksn</td><td><?php echo $sksn; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('entry_khs') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>