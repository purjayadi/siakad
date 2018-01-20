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
          
        
        <h2 style="margin-top:0px">Detail Data <?php echo $nama_dosen; ?> </h2>
       	<div class="panel panel-flat">
        <table class="table table table-xxs">
        <tr class="border-solid">
	    <tr><td>Nidn</td><td><?php echo $nidn; ?></td></tr>
	    <tr><td>Nama Dosen</td><td><?php echo $nama_dosen; ?></td></tr>
	    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
	    <tr><td>Tanggal Lahir</td><td><?php echo $tanggal_lahir; ?></td></tr>
	    <tr><td>Agama</td><td><?php echo $agama; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Bidang Keahlian</td><td><?php echo $bidang_keahlian; ?></td></tr>
	    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Tlpn</td><td><?php echo $tlpn; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
	</div>
	<div class="text-right">
       <a href="<?php echo site_url('admin/dosen') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Kembali</a>
     </div>

	<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>