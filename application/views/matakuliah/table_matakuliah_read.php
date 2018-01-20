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
        <h2 style="margin-top:0px">Detail Matakuliah <?php echo $nama_matakuliah; ?></h2>
            <div class="panel panel-flat">
        <table class="table table table-xxs">
        <tr class="border-solid">
	    <tr><td>Kode Matakuliah</td><td><?php echo $kode_matakuliah; ?></td></tr>
	    <tr><td>Nama Matakuliah</td><td><?php echo $nama_matakuliah; ?></td></tr>
	    <tr><td>Table Dosen Id Dosen</td><td><?php echo $table_dosen_id_dosen; ?></td></tr>
	    <tr><td>Table Blok Id Blok</td><td><?php echo $table_blok_id_blok; ?></td></tr>
	    <tr><td>Table Semester Id Semester</td><td><?php echo $table_semester_id_semester; ?></td></tr>
	</table>
    </div>
    <div class="text-right">
       <a href="<?php echo site_url('admin/Matakuliah') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Kembali</a>
     </div>

    <?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>