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
        <h2 style="margin-top:0px">Qkhs Read</h2>
        <table class="table">
	    <tr><td>Identry Khs</td><td><?php echo $identry_khs; ?></td></tr>
	    <tr><td>Nim</td><td><?php echo $nim; ?></td></tr>
	    <tr><td>Nama Mahasiswa</td><td><?php echo $nama_mahasiswa; ?></td></tr>
	    <tr><td>Kode Matakuliah</td><td><?php echo $kode_matakuliah; ?></td></tr>
	    <tr><td>Nama Matakuliah</td><td><?php echo $nama_matakuliah; ?></td></tr>
	    <tr><td>Sks</td><td><?php echo $sks; ?></td></tr>
	    <tr><td>Nilai</td><td><?php echo $nilai; ?></td></tr>
	    <tr><td>Grade</td><td><?php echo $grade; ?></td></tr>
	    <tr><td>Sksn</td><td><?php echo $sksn; ?></td></tr>
	    <tr><td>Nama Semester</td><td><?php echo $nama_semester; ?></td></tr>
	    <tr><td>Tahun Ajaran</td><td><?php echo $tahun_ajaran; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('khs') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>