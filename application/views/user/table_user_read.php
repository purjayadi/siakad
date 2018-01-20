<?php
$this->load->view('template/head');
$this->load->view('template/navbar');
$this->load->view('template/secnavbar');
$url = base_url('assets/images/users/').$photo;
?>
 <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
          
        
        <h2 style="margin-top:0px">Detail Data User <?php echo $nama_lengkap; ?> </h2>
        <div class="panel panel-flat">
        <div class="panel-body">
        <table class="table table-borderless table-xxs">
        <tr class="border-solid">
        <td width="250px">Username</td><td width="2px">:</td><td><?php echo $username; ?></td></tr>
	   <tr><td>Password</td><td>:</td>
        <td><?php echo $password; ?></td></tr>
	   <tr><td>Nama Lengkap</td><td>:</td>
        <td><?php echo $nama_lengkap; ?></td></tr>
	    <tr><td>Level</td><td>:</td>
        <td><?php echo $level; ?></td></tr>
	    <tr><td>Status</td><td>:</td>
        <td><?php echo $status; ?></td></tr>
	    <tr><td>Photo</td><td>:</td>
        <td><img src="<?=$url?>" style="width:80px; height: 80px; border-radius: 2px;" alt=""></td></tr>
	</table>
    </div>
    </div>
    <div class="text-right">
       <a href="<?php echo site_url('admin/user') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Kembali</a>
     </div>

    <?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>