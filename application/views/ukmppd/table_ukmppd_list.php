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
        <h2 style="margin-top:0px">Table_ukmppd List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('ukmppd/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('ukmppd/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('ukmppd'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Table Koas Nim</th>
		<th>Yudisium</th>
		<th>Buku</th>
		<th>Administrasi</th>
		<th>Ktp</th>
		<th>Akta Kelahiran</th>
		<th>Ktm</th>
		<th>Ijasah Sked</th>
		<th>Ijasah Sma</th>
		<th>Photo</th>
		<th>Action</th>
            </tr><?php
            foreach ($ukmppd_data as $ukmppd)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $ukmppd->table_koas_nim ?></td>
			<td><?php echo $ukmppd->yudisium ?></td>
			<td><?php echo $ukmppd->buku ?></td>
			<td><?php echo $ukmppd->administrasi ?></td>
			<td><?php echo $ukmppd->ktp ?></td>
			<td><?php echo $ukmppd->akta_kelahiran ?></td>
			<td><?php echo $ukmppd->ktm ?></td>
			<td><?php echo $ukmppd->ijasah_sked ?></td>
			<td><?php echo $ukmppd->ijasah_sma ?></td>
			<td><?php echo $ukmppd->photo ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('ukmppd/read/'.$ukmppd->idtable_ukmppd),'Read'); 
				echo ' | '; 
				echo anchor(site_url('ukmppd/update/'.$ukmppd->idtable_ukmppd),'Update'); 
				echo ' | '; 
				echo anchor(site_url('ukmppd/delete/'.$ukmppd->idtable_ukmppd),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('ukmppd/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>