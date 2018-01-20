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
        <h2 style="margin-top:0px">Data Nilai Koas</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <?php echo anchor(site_url('admin/stase_kecil/create'),'Create', 'class="btn btn-success"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('admin/stase_kecil/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/stase_kecil'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-success" type="submit">Search</button>
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
		<th>Ujian Lisan</th>
		<th>Nilai %</th>
		<th>Ujian Tulis</th>
		<th>Nilai %</th>
		<th>Kondite</th>
		<th>Nilai Angka</th>
		<th>Nilai Grade</th>
		<th>Action</th>
            </tr><?php
            foreach ($stase_kecil_data as $stase_kecil)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $stase_kecil->ujian_lisan ?></td>
			<td><?php echo $stase_kecil->n_lisan ?></td>
			<td><?php echo $stase_kecil->ujian_tulis ?></td>
			<td><?php echo $stase_kecil->n_tulis ?></td>
			<td><?php echo $stase_kecil->kondite ?></td>
			<td><?php echo $stase_kecil->nilai_angka ?></td>
			<td><?php echo $stase_kecil->nilai_huruf ?></td>
			<td style="text-align:center" width="200px">
				  <ul class="icons-list ">
                     <li><a href="<?php echo site_url() ?>admin/stase_kecil/read/<?php echo $stase_kecil->idtable_nilai_stase;?>" class="btn btn-success btn-xs" data-popup="tooltip" title="Detail" ><i class="icon-search4 text-white"></i></a></li>
                     <li><a href="<?php echo site_url() ?>admin/stase_kecil/update/<?php echo $stase_kecil->idtable_nilai_stase;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                     <li><a href="<?php echo site_url() ?>admin/stase_kecil/delete/<?php echo $stase_kecil->idtable_nilai_stase;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
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
                <a href="<?php echo site_url() ?>admin/stase_kecil/excel" class="btn btn-success"><i class=" icon-file-excel" ></i> Export ke Excel</a></li>
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
