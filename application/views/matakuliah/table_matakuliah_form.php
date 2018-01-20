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
        <h2 style="margin-top:0px"><?php echo $button ?> Data Matakuliah</h2>
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
        <fieldset>
        <br>
	    <div class="form-group">
        <label class="col-lg-3 control-label">Kode Matakuliah</label>
            <div class="col-lg-9">
            <input type="text" class="form-control" name="kode_matakuliah" id="kode_matakuliah" placeholder="Kode Matakuliah" value="<?php echo $kode_matakuliah; ?>" />
        </div>
        </div>
	   <div class="form-group">
        <label class="col-lg-3 control-label">Nama Matakuliah</label>
            <div class="col-lg-9">
            <input type="text" class="form-control" name="nama_matakuliah" id="nama_matakuliah" placeholder="Nama Matakuliah" value="<?php echo $nama_matakuliah; ?>" />
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-3 control-label">SKS</label>
            <div class="col-lg-9">
            <input type="text" class="form-control" name="sks" id="sks" placeholder="Jumlah SKS" value="<?php echo $sks; ?>" />
        </div>
        </div>
	   <div class="form-group">
        <label class="col-lg-3 control-label">ID Dosen</label>
            <div class="col-lg-9">
            <select name="table_dosen_id_dosen" id="table_dosen_id_dosen" class="select-search"  />
            <option>Pilih Dosen Pengampu</option>
            <?php 
            $Matakuliah=$this->db->query("select * from table_dosen");
            foreach($Matakuliah->result() as $value){
              $selected= '';
              if($id_dosen == $value->id_dosen){
                $selected = 'selected';
              }

            ?>
              <option  value="<?php echo $value->id_dosen; ?>"  echo ' selected="selected"'; >
                <?php echo $value->nama_dosen; ?>
              </option>
           <?php }?>

          </select>
        </div>
        </div>
	    <div class="form-group">
        <label class="col-lg-3 control-label">ID Blok</label>
            <div class="col-lg-9">
            <select name="table_blok_id_blok" id="table_blok_id_blok" class="select-search"   />
            <option>Pilih Blok</option>
            <?php 
            $Matakuliah=$this->db->query("select * from table_blok");

            foreach($Matakuliah->result() as $value){
              $selected= '';
              if($id_blok == $value->id_blok){
                $selected = 'selected';
              }

            ?>
              <option  value="<?php echo $value->id_blok; ?>"  echo ' selected="selected"'; >
                <?php echo $value->nama_blok; ?>
              </option>
           <?php }?>

          </select>
        </div>
        </div>
	    <div class="form-group">
        <label class="col-lg-3 control-label">ID Semester</label>
            <div class="col-lg-9">
            <select name="table_semester_id_semester" id="table_semester_id_semester" class="select-search"   />
            <option>Pilih Semester</option>
            <?php 
            $Matakuliah=$this->db->query("select * from table_semester");

            foreach($Matakuliah->result() as $value){
              $selected= '';
              if($id_semester == $value->id_semester){
                $selected = 'selected';
              }

            ?>
              <option  value="<?php echo $value->id_semester; ?>"  echo ' selected="selected"'; >
                <?php echo $value->nama_semester; ?>
              </option>
           <?php }?>

          </select>
        </div>
        </div>
	     <div class="text-right">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
             <a href="<?php echo site_url('admin/Matakuliah') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-primary"><i class="icon-floppy-disk"></i>  <?php echo $button ?></button> 
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