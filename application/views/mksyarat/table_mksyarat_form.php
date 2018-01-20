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
        <h2 style="margin-top:0px"><?php echo $button ?> Data Matakuliah Prasyarat</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Kode Matakuliah <?php echo form_error('table_matakuliah_id_matakuliah') ?></label>
            <input type="text" class="form-control" name="table_matakuliah_kode_matakuliah" id="table_matakuliah_kode_matakuliah" placeholder="Kode matakuliah" value="<?php echo $table_matakuliah_kode_matakuliah; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">ID Semester <?php echo form_error('table_semester_id_semester') ?></label>
            <input type="text" class="form-control" name="table_semester_id_semester" id="table_semester_id_semester" placeholder="ID Semester" value="<?php echo $table_semester_id_semester; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kode Matakuliah Prasyarat <?php echo form_error('table_matakuliah_id_matakuliah1') ?></label>
            <input type="text" class="form-control" name="table_matakuliah_kode_matakuliah1" id="table_matakuliah_kode_matakuliah1" placeholder="Kode matakuliah Prasyarat" value="<?php echo $table_matakuliah_kode_matakuliah1; ?>" />
        </div>
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	    <input type="hidden" name="id_mksyarat" value="<?php echo $id_mksyarat; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin/mksyarat') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>