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
        <h2 style="margin-top:0px">Detail nilai <?php echo $table_mahasiswa_id_mahasiswa; ?></h2>
            <div class="panel panel-flat">
        <table class="table table table-xs">
        <tr class="border-solid">
	    <tr><td>Nilai</td><td><?php echo $nilai; ?></td></tr>
	    <tr><td>Grade</td><td><?php echo $grade; ?></td></tr>
	    <tr><td>Table Mahasiswa Id Mahasiswa</td><td><?php echo $table_mahasiswa_id_mahasiswa; ?></td></tr>
	    <tr><td>Table Matakuliah Id Matakuliah</td><td><?php echo $table_matakuliah_id_matakuliah; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('admin/nilai') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
    </div>
    <div class="text-right">
       <a href="<?php echo site_url('admin/nilai') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Kembali</a>
     </div>

    <?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>