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
        <div class="panel panel-flat">
        <div class="panel-body">
        <h2 style="margin-top:0px"><?php echo $button ?> Data Kurikulum</h2>
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Tahun <?php echo form_error('tahun') ?></label>
            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ket <?php echo form_error('ket') ?></label>
            <input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>" />
        </div>
	   
                            <div class="text-right">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="hidden" name="id_kurikulum" value="<?php echo $id_kurikulum; ?>" /> 
                                <a href="<?php echo site_url('admin/Kurikulum') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
                                <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i>  <?php echo $button ?></button> 
        </div>
        </div>
	</form>
    </body>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>