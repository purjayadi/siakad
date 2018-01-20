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
        <h2 style="margin-top:0px"><?php echo $button ?> Data Semester</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Semester <?php echo form_error('nama_semester') ?></label>
            <input type="text" class="form-control" name="nama_semester" id="nama_semester" placeholder="Nama Semester" value="<?php echo $nama_semester; ?>" />
        </div>
         <div class="text-right">
         <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	    <input type="hidden" name="id_semester" value="<?php echo $id_semester; ?>" /> 

         <a href="<?php echo site_url('admin/semester') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-primary"><i class="icon-floppy-disk"></i>  <?php echo $button ?></button> 
        </div>
        </div>
        </div>
    </form>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>