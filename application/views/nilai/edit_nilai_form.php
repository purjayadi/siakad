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
        <h2 style="margin-top:0px"><?php echo $button ?> Nilai Mahasiswa</h2>
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
           <div class="col-md-6">
        <fieldset>
        <br>
        <div class="form-group">
        <label class="col-lg-3 control-label">NIM Mahasiswa</label>
            <div class="col-lg-9">
           <select name="table_mahasiswa_nim" id="table_mahasiswa_nim" class="select-search" placeholder="Masukkan NIM Mahasiswa"  />
            <option>Masukkan NIM Mahasiswa</option>
            <?php 
            $mahasiswa=$this->db->query("select * from table_mahasiswa where nim='$table_mahasiswa_nim'");

            foreach($mahasiswa->result() as $value){
              $selected= '';
              if($table_mahasiswa_nim == $value->table_mahasiswa_nim){
                $selected = 'selected';
              }
            ?>
              <option  value="<?php echo $value->nim; ?>"  echo ' selected="selected"'; >
                <?php echo $value->nim; ?> <?php echo $value->nama_mahasiswa; ?>
              </option>
           <?php }?>

          </select>
            </div>
        </div>
         <div class="form-group">
           <label class="col-lg-3 control-label">Pilih Matakuliah</label>
            <div class="col-lg-9">
           <select name="table_matakuliah_kode_matakuliah" id="table_matakuliah_kode_matakuliah" class="select-search"   />
            <option>Pilih Matakuliah</option>
            <?php 
            $mahasiswa=$this->db->query("select * from table_matakuliah where kode_matakuliah='$table_matakuliah_kode_matakuliah'");

            foreach($mahasiswa->result() as $value){
              $selected= '';
              if($table_matakuliah_kode_matakuliah == $value->table_matakuliah_kode_matakuliah){
                $selected = 'selected';
              }

            ?>
              <option  value="<?php echo $value->kode_matakuliah; ?>"  echo ' selected="selected"'; >
                <?php echo $value->kode_matakuliah; ?> <?php echo $value->nama_matakuliah; ?>
              </option>
           <?php }?>

          </select>
            </div>
        </div>
	   
        </fieldset>
        </div>
        <div class="col-md-6">
        <fieldset>
        <br>
	    <div class="form-group">
        <label class="col-lg-3 control-label">Nilai</label>
            <div class="col-lg-9">
            <input type="text"  class="form-control"  onchange="konversi();" onkeyup="konversi();" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" />
            </div>
        </div>
        <div class="form-group">
        <label class="col-lg-3 control-label">Grade</label>
            <div class="col-lg-9">
            <input type="text" class="form-control" readonly="readonly" name="grade" id="grade" placeholder="Grade" value="<?php echo $grade; ?>" />
            </div>
        </div>
        </fieldset>
        <div class="text-right">
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
             <input type="hidden" name="id_nilai" value="<?php echo $id_nilai; ?>" /> 
              <a href="<?php echo site_url('admin/qnilai') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-primary"><i class="icon-floppy-disk"></i>  <?php echo $button ?></button> 
        </div>
        </div>
        </div>
        </form>
<script>
      function konversi(){
      var nilai_a = Number(document.getElementById("nilai").value);
      var nilai_huruf;
      var nilai_sksn;
      if((nilai_a>=80)&&(nilai_a<=100))
      nilai_huruf = 'A';
      else if((nilai_a>=66)&&(nilai_a<=79))
      nilai_huruf = 'B';
      else if((nilai_a>=56)&&(nilai_a<=65))
      nilai_huruf = 'C';
      else if((nilai_a>=46)&&(nilai_a<=55))
      nilai_huruf = 'D';
      else
      nilai_huruf = 'E';
      document.getElementById("grade").value = nilai_huruf;
      }
</script>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>