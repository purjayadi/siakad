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
            <div class="col-md-6">
                 <a href="<?php echo site_url('admin/nilai/create'); ?>" class="btn btn-success"><i class=" icon-compose" ></i> Entry Data Nilai</a></li>
            </div>
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('admin/qnilai/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/qnilai'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama Mahasiswa</th>
		<th>Kode Matakuliah</th>
		<th>Nama Matakuliah</th>
		<th>Nilai</th>
		<th>Grade</th>
        <th style="text-align:center">Action</th>
            </tr><?php
            foreach ($qnilai_data as $qnilai)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $qnilai->nim ?></td>
			<td><?php echo $qnilai->nama_mahasiswa ?></td>
			<td><?php echo $qnilai->kode_matakuliah ?></td>
			<td><?php echo $qnilai->nama_matakuliah ?></td>
			<td><?php echo $qnilai->nilai ?></td>
			<td><?php echo $qnilai->grade ?></td>
            <td style="text-align:center" width="200px">
                <ul class="icons-list ">
                    <li><a href="<?php echo site_url() ?>admin/nilai/update/<?php echo $qnilai->id_nilai;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                    <li><a href="<?php echo site_url() ?>admin/nilai/delete/<?php echo $qnilai->id_nilai;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
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
                <a href="<?php echo site_url() ?>qnilai/excel" class="btn btn-success"><i class=" icon-file-excel" ></i> Export ke Excel</a></li>
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