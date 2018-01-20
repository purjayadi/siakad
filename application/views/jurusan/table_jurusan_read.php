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
        <h2 style="margin-top:0px">Table_jurusan Read</h2>
        <table class="table">
	    <tr><td>Nama Jurusan</td><td><?php echo $nama_jurusan; ?></td></tr>
	    <tr><td>Jenjang</td><td><?php echo $jenjang; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jurusan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>