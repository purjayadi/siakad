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
        <h2 style="margin-top:0px"><?php echo $button ?> KHS mahasiswa</h2>
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
           <div class="col-md-6">
             <fieldset>
               <br>
               <div class="form-group">
                <label class="col-lg-3 control-label">NIM <span class="text-danger"> *</span></label>
                <div class="col-lg-9">
                 
                    <?php
                    $style_provinsi='class="select-search"" id="table_mahasiswa_nim"  onChange="tampilKabupaten()"';
                    echo form_dropdown('table_mahasiswa_nim',$provinsi,'',$style_provinsi);
                    ?>

                <?php echo form_error('table_mahasiswa_nim'); ?>
                </div>
              </div>
             <div class="form-group">
                <label class="col-lg-3 control-label">Pilih Matakuliah <span class="text-danger"> *</span></label>
                <div class="col-lg-9">
             <?php
                  $style_kabupaten='class="select" id="table_matakuliah_kode_matakuliah" onChange="tampilKecamatan()" onkeyup="tampilKecamatan"';
                   echo form_dropdown("table_matakuliah_kode_matakuliah",array('Pilih matakuliah'=>'- Pilih matakuliah -'),'',$style_kabupaten);
                  ?>
              <?php echo form_error('table_matakuliah_kode_matakuliah'); ?>
              </div>
              </div>
	         <div class="form-group">
                <label class="col-lg-3 control-label">Nilai <span class="text-danger"> *</span></label>
                 <div class="col-lg-9">
               <?php
                $style_kecamatan='class="form-control" id="table_nilai_id_nilai" onChange="tampilKelurahan()"';
                echo form_dropdown("table_nilai_id_nilai",array('Pilih nilai'=>'- Pilih nilai -'),'',$style_kecamatan);
                ?>
        </div>
        </div>
        <div class="form-group">
                <label class="col-lg-3 control-label">SKSN <span class="text-danger"> *</span></label>
                 <div class="col-lg-9">
            <input type="text" class="form-control" name="sksn" id="sksn" placeholder="Sksn" value="<?php echo $sksn; ?>" />
            <?php echo form_error('sksn'); ?>
        </div>
        </div>
         </fieldset>
         </div>

         <div class="col-md-6">
         <fieldset>
           <br>
	   <div class="form-group">
                <label class="col-lg-3 control-label">Pilih Semester <span class="text-danger"> *</span></label>
                  <div class="col-lg-9">
                   <select name="table_semester_id_semester" id="table_semester_id_semester" class="select" placeholder="Pilih..."  />
                    <option></option>
                     <?php
                            foreach ($semester as $kot) {
                                ?>
                                <option <?php echo $semester_selected == $kot->id_semester ? 'selected="selected"' : '' ?> 
                                    class="<?php echo $kot->id_semester ?>" value="<?php echo $kot->id_semester ?>"><?php echo $kot->nama_semester ?></option>
                                <?php
                            }
                            ?>

                  </select>
                    </div>
                    <?php echo form_error('table_semester_id_semester'); ?>
        </div>
	    <div class="form-group">
                <label class="col-lg-3 control-label">Tahun Ajaran <span class="text-danger"> *</span></label>
                 <div class="col-lg-9">
                 <select name="tahun_ajaran" id="tahun_ajaran" class="select-search" placeholder="Pilih..."  />
                  <option></option>
                          <?php
                            foreach ($tahun_ajaran as $kot) {
                                ?>
                                <option <?php echo $tahun_ajaran_selected == $kot->idtable_ta ? 'selected="selected"' : '' ?> 
                                    class="<?php echo $kot->idtable_ta ?>" value="<?php echo $kot->idtable_ta ?>"><?php echo $kot->tahun_ajaran ?></option>
                                <?php
                            }
                            ?>
                  </select>
        </div>
        <?php echo form_error('tahun_ajaran'); ?>
        </div>
        </fieldset>
        <div class="text-right">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	    <input type="hidden" name="identry_khs" value="<?php echo $identry_khs; ?>" /> 
              <a href="<?php echo site_url('admin/entry_khs') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i>  <?php echo $button ?></button> 
         </div>
        </div>
        </div>
	</form>
<script>
function tampilKabupaten()
 {
   kdprop = document.getElementById("table_mahasiswa_nim").value;
   $.ajax({
     url:"<?php echo base_url();?>admin/entry_khs/pilih_kabupaten/"+kdprop+"",
     success: function(response){
     $("#table_matakuliah_kode_matakuliah").html(response);
     },
     dataType:"html"
   });
   return false;
 }
 
 function tampilKecamatan()
 {
   kdkab = document.getElementById("table_matakuliah_kode_matakuliah").value;
   $.ajax({
     url:"<?php echo  base_url();?>admin/entry_khs/pilih_kecamatan/"+kdkab+"",
     success: function(response){
     $("#table_nilai_id_nilai").html(response);
     },
     dataType:"html"
   });
   return false;
 }
 

</script>

<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>