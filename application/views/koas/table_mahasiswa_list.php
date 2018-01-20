<?php
$this->load->view('template/head');
$this->load->view('template/navbar');
$this->load->view('template/secnavbar');
?>
 <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

        <h2 style="margin-top:0px">Data Koas Fakultas Kedokteran</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
             <a href="<?php echo site_url('admin/koas/create'); ?>" class="btn btn-success"><i class=" icon-compose" ></i> Tambah data</a></li>
            </div>
                    
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('admin/koas'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/koas'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-success" type="submit"><i class="icon-search4" ></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        <div class="panel panel-flat">
        <div class="table-responsive">
         <table class="table table table-xxs">
            <tr class="border-solid">
                <th>No</th>
		<th>Nim</th>
		<th>Nama</th>
		<th>Agama</th>
		<th>Jenis Kelamin</th>
		<th>Alamat</th>
		<th>Angkatan</th>
		<th>No Hp</th>
		<th style="text-align:center" width="200px">Aksi</th>
            </tr><?php
            foreach ($koas_data as $koas)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $koas->nim ?></td>
			<td><?php echo $koas->nama_mahasiswa ?></td>
			<td><?php echo $koas->agama ?></td>
			<td><?php echo $koas->jenis_kelamin ?></td>
			<td><?php echo $koas->alamat ?></td>
			<td><?php echo $koas->angkatan ?></td>
			<td><?php echo $koas->no_hp ?></td>
			<td style="text-align:center" width="200px">
				   <ul class="icons-list ">
                     <li><a href="<?php echo site_url() ?>admin/koas/read/<?php echo $koas->nim;?>" class="btn btn-success btn-xs" data-popup="tooltip" title="Detail" ><i class="icon-search4 text-white"></i></a></li>
                     <li><a href="<?php echo site_url() ?>admin/koas/update/<?php echo $koas->nim;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                     <li><a href="<?php echo site_url() ?>admin/koas/delete/<?php echo $koas->nim;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
                  </ul>
			</td>
		</tr>
                <?php
            }
            ?>

        </table>
 </div>
 </div>
        <div class="row">
         
            <div class="col-md-6">
                <a href="#" class="btn btn-success">Total Record : <?php echo $total_rows ?></a>
                <a href="<?php echo site_url() ?>admin/koas/excel" class="btn btn-success"><i class=" icon-file-excel" ></i> Export ke Excel</a></li>
           </div>
            <div class="col-md-6 text-right" class="btn-success">
                <?php echo $pagination ?>
            </div>
        </div>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>
