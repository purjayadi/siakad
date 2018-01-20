<<?php
$this->load->view('template/head');
$this->load->view('template/navbar');
$this->load->view('template/secnavbar');
?>
  <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
          
        
        <h2 style="margin-top:0px">Detail Data nilai nim : <?php echo $table_koas_nim; ?></h2>
       	<div class="panel panel-flat">
       	<div class="panel-body">
        <table class="table table-borderless table-xxs">
        <tr class="border-solid">
        <td width="250px">stase</td><td width="4px">:</td>
	    <tr><td>Mini Cex</td><td> : <?php echo $mini_cex; ?></td></tr>
	    <tr><td>Cbd</td><td> : <?php echo $cbd; ?></td></tr>
	    <tr><td>Dops</td><td> : <?php echo $dops; ?></td></tr>
	    <tr><td>Penyuluhan</td><td> : <?php echo $pylhn; ?></td></tr>
	    <tr><td>Jurnal Reading</td><td> : <?php echo $j_reading; ?></td></tr>
	    <tr><td>N form %</td><td> : <?php echo $nform; ?></td></tr>
	    <tr><td>Ujian Lisan</td><td> : <?php echo $ujian_lisan; ?></td></tr>
	    <tr><td>Nilai %</td><td> : <?php echo $n_lisan; ?></td></tr>
	    <tr><td>Ujian Tulis</td><td> : <?php echo $ujian_tulis; ?></td></tr>
	    <tr><td>Nilai %</td><td> : <?php echo $n_tulis; ?></td></tr>
	    <tr><td>Kondite</td><td> : <?php echo $kondite; ?></td></tr>
	    <tr><td>Nilai Angka</td><td> : <?php echo $nilai_angka; ?></td></tr>
	    <tr><td>Nilai Grade</td><td> : <?php echo $nilai_huruf; ?></td></tr>
	    </tr>
	</table>
	</div>
	</div>
	<div class="text-right">
       <a href="<?php echo site_url('admin/stase_kecil') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Kembali</a>
     </div>
	
	<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>