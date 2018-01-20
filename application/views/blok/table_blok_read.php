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
          
        
        <h2 style="margin-top:0px">Detail Blok</h2>
        <div class="panel panel-flat">
        <table class="table table table-xxs">
        <tr class="border-solid">
	    <tr><td>Kode Blok</td><td><?php echo $kode_blok; ?></td></tr>
	    <tr><td>Nama Blok</td><td><?php echo $nama_blok; ?></td></tr>
	</table>
    </div>
    <div class="text-right">
       <a href="<?php echo site_url('blok') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Kembali</a>
     </div>

    <?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>