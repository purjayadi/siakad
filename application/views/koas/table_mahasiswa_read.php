<?php
$this->load->view('template/head');
$this->load->view('template/navbar');
$this->load->view('template/secnavbar');
$url = base_url('assets/images/mahasiswa/').$photo;
?>
 <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
          
        
        <h2 style="margin-top:0px">Detail Data Koas <?php echo $nama_mahasiswa; ?> </h2>
       	<div class="panel panel-flat">
       	<div class="panel-body">
        <table class="table table-borderless table-xxs">
        <tr class="border-solid">
        <td width="250px">Nim</td><td width="4px">:</td>
		<td><?php echo $nim; ?></td></tr>
			    <tr><td>Nama Mahasiswa</td><td>:</td>
		<td><?php echo $nama_mahasiswa; ?></td></tr>
			    <tr><td>Tempat Lahir</td><td>:</td>
		<td><?php echo $tempat_lahir; ?></td></tr>
			    <tr><td>Tgl Lahir</td><td>:</td>
		<td><?php echo $tgl_lahir; ?></td></tr>
			    <tr><td>Agama</td><td>:</td>
		<td><?php echo $agama; ?></td></tr>
			    <tr><td>Jenis Kelamin</td><td>:</td>
		<td><?php echo $jenis_kelamin; ?></td></tr>
			    <tr><td>Alamat Lengkap</td><td>:</td>
		<td><?php echo $alamat; ?></td></tr>
			    <tr><td>Angkatan</td><td>:</td>
		<td><?php echo $angkatan; ?></td></tr>
			    <tr><td>Sekolah Asal</td><td>:</td>
		<td><?php echo $sekolah_asal; ?></td></tr>
			    <tr><td>No Hp</td><td>:</td>
		<td><?php echo $no_hp; ?></td></tr>
			    <tr><td>Gol Darah</td><td>:</td>
		<td><?php echo $gol_darah; ?></td></tr>
	    <tr><td>Photo</td><td>:</td>
		<td><a href="<?=$url?>" target="_blank"><img src="<?=$url?>" style="width: 100px; height: 120px;" class="img-rounded" alt=""></a></td></tr> 
	</table>
	</div>
	</div>
	<div class="text-right">
       <a href="<?php echo site_url('admin/koas') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Kembali</a>
     </div>

	<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>