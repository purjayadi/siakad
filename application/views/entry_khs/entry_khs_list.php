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
        <h2 style="margin-top:0px">Data Kartu Hasil Studi</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
               <a href="<?php echo site_url('admin/entry_khs/create'); ?>" class="btn btn-success"><i class=" icon-compose" ></i> Entry data KHS</a></li>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('entry_khs/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('entry_khs'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-success" type="submit">Search</button>
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
		<th>Table Mahasiswa Id Mahasiswa</th>
		<th>Table Matakuliah Id Matakuliah</th>
		<th>Table Nilai Id Nilai</th>
		<th>Table Semester Id Semester</th>
		<th>Tahun Ajaran</th>
		<th>Sksn</th>
		<th>Action</th>
            </tr><?php
            foreach ($entry_khs_data as $entry_khs)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $entry_khs->table_mahasiswa_id_mahasiswa ?></td>
			<td><?php echo $entry_khs->table_matakuliah_id_matakuliah ?></td>
			<td><?php echo $entry_khs->table_nilai_id_nilai ?></td>
			<td><?php echo $entry_khs->table_semester_id_semester ?></td>
			<td><?php echo $entry_khs->tahun_ajaran ?></td>
			<td><?php echo $entry_khs->sksn ?></td>
			<td style="text-align:center" width="200px">
                   <ul class="icons-list ">
                        <li><a href="<?php echo site_url() ?>admin/entry_khs/read/<?php echo $entry_khs->identry_khs;?>" class="btn btn-primary btn-xs" data-popup="tooltip" title="Detail" ><i class="icon-search4 text-white"></i></a></li>
                        <li><a href="<?php echo site_url() ?>admin/entry_khs/update/<?php echo $entry_khs->identry_khs;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                        <li><a href="<?php echo site_url() ?>admin/entry_khs/delete/<?php echo $entry_khs->identry_khs;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
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
