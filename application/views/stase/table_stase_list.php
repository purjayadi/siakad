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
        <h2 style="margin-top:0px">Data Stase</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <?php echo anchor(site_url('admin/stase/create'),'Create', 'class="btn btn-success"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('admin/stase/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/stase'); ?>" class="btn btn-default">Reset</a>
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
		<th>Stase</th>
		<th>Status</th>
		<th>Action</th>
            </tr><?php
            foreach ($stase_data as $stase)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $stase->stase ?></td>
			<td><?php echo $stase->status ?></td>
			<td style="text-align:center" width="200px">
				<ul class="icons-list ">
                    <li><a href="<?php echo site_url() ?>admin/stase/update/<?php echo $stase->idtable_stase;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                    <li><a href="<?php echo site_url() ?>admin/stase/delete/<?php echo $stase->idtable_stase;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
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
		<?php echo anchor(site_url('admin/stase/excel'), 'Excel', 'class="btn btn-success"'); ?>
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