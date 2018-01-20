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
        <h2 style="margin-top:0px">Entry Nilai Koas</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <?php echo anchor(site_url('admin/stase_besar/create'),'Create', 'class="btn btn-success"'); ?>
            </div>
           
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('admin/stase_besar/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/stase_besar'); ?>" class="btn btn-default">Reset</a>
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
        <th>Nim</th>
		<th>Mini Cex</th>
		<th>Mini Cex2</th>
		<th>Cbd</th>
		<th>Cbd2</th>
		<th>Dops</th>
		<th>Dops2</th>
		<th>Pylhn</th>
		<th>Pylhn2</th>
		<th>J.reading</th>
		<th>J.reading2</th>
		<th>Nform</th>
		<th>Ujian Lisan</th>
		<th>N Lisan</th>
		<th>Ujian Tulis</th>
		<th>N Tulis</th>
		<th>Kondite</th>
		<th>Nilai Angka</th>
		<th>Nilai Huruf</th>
		<th>Action</th>
            </tr><?php
            foreach ($stase_besar_data as $stase_besar)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $stase_besar->table_koas_nim ?></td>
			<td><?php echo $stase_besar->mini_cex ?></td>
			<td><?php echo $stase_besar->mini_cex2 ?></td>
			<td><?php echo $stase_besar->cbd ?></td>
			<td><?php echo $stase_besar->cbd2 ?></td>
			<td><?php echo $stase_besar->dops ?></td>
			<td><?php echo $stase_besar->dops2 ?></td>
			<td><?php echo $stase_besar->pylhn ?></td>
			<td><?php echo $stase_besar->pylhn2 ?></td>
			<td><?php echo $stase_besar->j_reading ?></td>
			<td><?php echo $stase_besar->j_reading2 ?></td>
			<td><?php echo $stase_besar->nform ?></td>
			<td><?php echo $stase_besar->ujian_lisan ?></td>
			<td><?php echo $stase_besar->n_lisan ?></td>
			<td><?php echo $stase_besar->ujian_tulis ?></td>
			<td><?php echo $stase_besar->n_tulis ?></td>
			<td><?php echo $stase_besar->kondite ?></td>
			<td><?php echo $stase_besar->nilai_angka ?></td>
			<td><?php echo $stase_besar->nilai_huruf ?></td>
			<td style="text-align:center" width="200px">
				<ul class="icons-list ">
                     <li><a href="<?php echo site_url() ?>admin/stase_besar/read/<?php echo $stase_besar->idtable_nilai_stase;?>" class="btn btn-success btn-xs" data-popup="tooltip" title="Detail" ><i class="icon-search4 text-white"></i></a></li>
                     <li><a href="<?php echo site_url() ?>admin/stase_besar/update/<?php echo $stase_besar->idtable_nilai_stase;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                     <li><a href="<?php echo site_url() ?>admin/stase_besar/delete/<?php echo $stase_besar->idtable_nilai_stase;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
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
                <a href="<?php echo site_url() ?>admin/stase_besar/excel" class="btn btn-success"><i class=" icon-file-excel" ></i> Export ke Excel</a></li>
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
