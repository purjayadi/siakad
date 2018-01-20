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
        <h2 style="margin-top:0px">Entry data</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label>Status</label>
              <select data-placeholder="Pilih status..." class="select select-lg"  placeholder="-pilih semester-" name="nama_semester_sekarang" id="nama_semester_sekarang"/>
                        <option></option>
                        <option  <?php if($action="Update"){if($status=='Ganjil'){echo"selected=selected";}}?>value="Ganjil">Ganjil</option>
                        <option  <?php if($action=="Update"){if($status=='Genap'){echo"selected=selected";}}?>value="Genap">Genap</option>
              </select>
            <span class="help-block"> <?php echo form_error('status'); ?> </span>
        </div>
         <div class="form-group">
            <label>Status</label>
              <select data-placeholder="Pilih status..." class="select select-lg"  placeholder="-status-" name="status" id="status"/>
                        <option></option>
                        <option  <?php if($action="Update"){if($status=='Aktif'){echo"selected=selected";}}?>value="Aktif">Aktif</option>
                        <option  <?php if($action=="Update"){if($status=='Tidak Aktif'){echo"selected=selected";}}?>value="Tidak Aktif">Tidak Aktif</option>
              </select>
            <span class="help-block"> <?php echo form_error('status'); ?> </span>
        </div>
        <div class="text-right">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	    <input type="hidden" name="id_smstrskrg" value="<?php echo $id_smstrskrg; ?>" /> 
	        <a href="<?php echo site_url('admin/semester_sekarang') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i>  <?php echo $button ?></button> 
        </div>
        </div>
        </div>
    </form>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>