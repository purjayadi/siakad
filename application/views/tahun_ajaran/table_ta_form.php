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
        <h2 style="margin-top:0px"><?php echo $button ?> Tahun Akademik</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Tahun Ajaran <?php echo form_error('tahun_ajaran') ?></label>
            <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="Tahun Ajaran" value="<?php echo $tahun_ajaran; ?>" />
        </div>
        <div class="form-group">
            <label>Status</label>
              <select data-placeholder="Pilih status..." class="select select-lg"  placeholder="Status" name="status" id="status"/>
                        <option></option>
                        <option  <?php if($action="Update"){if($status=='Aktif'){echo"selected=selected";}}?>value="Aktif">Aktif</option>
                        <option  <?php if($action=="Update"){if($status=='Tidak Aktif'){echo"selected=selected";}}?>value="Tidak Aktif">Tidak Aktif</option>
              </select>
            <span class="help-block"> <?php echo form_error('status'); ?> </span>
        </div>
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	    <input type="hidden" name="idtable_ta" value="<?php echo $idtable_ta; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin/tahun_ajaran') ?>" class="btn btn-default">Cancel</a>
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