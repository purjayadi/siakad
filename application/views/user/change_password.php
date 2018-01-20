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
        <h2 style="margin-top:0px"> Change Password</h2>
        <?php echo form_open("auth/change_password");?>
         <div class="form-group">
            <label for="varchar">Old Password <?php echo form_error('old_password') ?></label>
            <input type="password" class="form-control" name="old" id="old" placeholder="Insert your old Password" <?php echo form_input($old_password);?> 
        </div>
         <div class="form-group">
            <label for="varchar">New Password <?php echo form_error('new_password') ?></label>
            <input type="password" class="form-control" name="new" id="new" placeholder="insert password" <?php echo form_input($new_password);?> 
        </div>

	   
         <div class="form-group">
            <label for="varchar">Confirm Password <?php echo form_error('new_password_confirm') ?></label>
            <input type="password" class="form-control" name="new_confirm" id="new_confirm" placeholder="Confirm Password" <?php echo form_input($new_password_confirm);?> 
        </div>
       
       
         <div class="text-right">
        <?php echo form_input($user_id);?>
                <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
	     <a href="<?php echo site_url('admin/mahasiswa') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i> Ubah</button> 
        </div>
        </div>
        </div>
	<?php echo form_close(); ?>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>