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
        <h2 style="margin-top:0px">Table_ukmppd Read</h2>
        <table class="table">
	    <tr><td>Table Koas Nim</td><td><?php echo $table_koas_nim; ?></td></tr>
	    <tr><td>Yudisium</td><td><?php echo $yudisium; ?></td></tr>
	    <tr><td>Buku</td><td><?php echo $buku; ?></td></tr>
	    <tr><td>Administrasi</td><td><?php echo $administrasi; ?></td></tr>
	    <tr><td>Ktp</td><td><?php echo $ktp; ?></td></tr>
	    <tr><td>Akta Kelahiran</td><td><?php echo $akta_kelahiran; ?></td></tr>
	    <tr><td>Ktm</td><td><?php echo $ktm; ?></td></tr>
	    <tr><td>Ijasah Sked</td><td><?php echo $ijasah_sked; ?></td></tr>
	    <tr><td>Ijasah Sma</td><td><?php echo $ijasah_sma; ?></td></tr>
	    <tr><td>Photo</td><td><?php echo $photo; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ukmppd') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>