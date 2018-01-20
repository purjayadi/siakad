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
        <h2 style="margin-top:0px"> Data User</h2>
         <?php echo form_open("auth/create_user"); ?>
         <div class="form-group">
            <label for="varchar">First name <?php echo form_error('first_name') ?></label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" />
        </div>
         <div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('last_name') ?></label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" />
        </div>

	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username"  />
        </div>

         <div class="form-group">
            <label for="varchar">identity <?php echo form_error('identity') ?></label>
            <input type="text" class="form-control" name="identity" id="identity" placeholder="identity"  />
        </div>
         <div class="form-group">
            <label for="varchar">Company <?php echo form_error('company') ?></label>
            <input type="text" class="form-control" name="company" id="company" placeholder="company" />
        </div>
        <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="email" />
        </div>
        <div class="form-group">
            <label for="varchar">Phone <?php echo form_error('phone') ?></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="phone"  />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"  />
        </div>
         <div class="form-group">
            <label for="varchar">Password Confirm <?php echo form_error('password_confirm') ?></label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="password_confirm"  />
        </div>
         <div class="text-right">
                <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
         <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	     <a href="<?php echo site_url('admin/user') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i> Tambah</button> 
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