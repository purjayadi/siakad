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
        <h2 style="margin-top:0px">Entry Data</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Stase <?php echo form_error('stase') ?></label>
            <input type="text" class="form-control" name="stase" id="stase" placeholder="Stase" value="<?php echo $stase; ?>" />
        </div>
	    <div class="form-group">
           <label for="enum">Status <?php echo form_error('status') ?></label>
            <select data-placeholder="Pilih..." class="select select-lg"  placeholder="Pilih..." name="status" id="status"/>
                        <option></option>
                        <option  <?php if($action="Update"){if($status=='besar'){echo"selected=selected";}}?> value="besar"> Besar</option>
                        <option  <?php if($action=="Update"){if($status=='kecil'){echo"selected=selected";}}?> value="kecil"> kecil</option>
              </select>
        </div>
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	    <input type="hidden" name="idtable_stase" value="<?php echo $idtable_stase; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('stase') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>