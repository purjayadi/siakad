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
        <h2 style="margin-top:0px">Data Nilai Mahasiswa</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                 <a href="<?php echo site_url('admin/nilai/create'); ?>" class="btn btn-primary"><i class=" icon-compose" ></i> Entry Data Nilai</a></li>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/nilai/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/nilai'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-flat">
        <div class="table-responsive">
        <table class="table table table-xxs">
        <tr class="border-solid">
        <th>No</th>
		<th>Nilai</th>
		<th>Grade</th>
		<th>Table Mahasiswa Id Mahasiswa</th>
		<th>Table Matakuliah Id Matakuliah</th>
		<th style="text-align:center">Action</th>
            </tr><?php
            foreach ($nilai_data as $nilai)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $nilai->nilai ?></td>
			<td><?php echo $nilai->grade ?></td>
			<td><?php echo $nilai->table_mahasiswa_id_mahasiswa ?></td>
			<td><?php echo $nilai->table_matakuliah_id_matakuliah ?></td>
			<td style="text-align:center" width="200px">
				<ul class="icons-list ">
                    <li><a href="<?php echo site_url() ?>admin/nilai/read/<?php echo $nilai->id_nilai;?>" class="btn btn-primary btn-xs" data-popup="tooltip" title="Detail" ><i class="icon-search4 text-white"></i></a></li>
                    <li><a href="<?php echo site_url() ?>admin/nilai/update/<?php echo $nilai->id_nilai;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                    <li><a href="<?php echo site_url() ?>admin/nilai/delete/<?php echo $nilai->id_nilai;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
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
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                <a href="<?php echo site_url() ?>admin/nilai/excel" class="btn btn-primary"><i class=" icon-file-excel" ></i> Export ke Excel</a></li>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>