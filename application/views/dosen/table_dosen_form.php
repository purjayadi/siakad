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
        <h2 style="margin-top:0px"><?php echo $button ?> Data Dosen & Staf </h2>
       <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
       <div class="col-md-6">
        <fieldset>
        <br>
	    <div class="form-group">
            <label class="col-lg-3 control-label">NIDN <?php echo form_error('nidn') ?></label>
                <div class="col-lg-9">
                <input type="text" class="form-control" name="nidn" id="nidn" placeholder="NIDN" value="<?php echo $nidn; ?>" />
                </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Nama <?php echo form_error('nama_dosen') ?></label>
                <div class="col-lg-9">
                <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" placeholder="Nama" value="<?php echo $nama_dosen; ?>">
                </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
                <div class="col-lg-9">
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>">
                </div>
        </div>
	    <div class="form-group">
            <label class="col-lg-3 control-label">Tanggal Lahir <?php echo form_error('tempat_lahir') ?></label>
                <div class="col-lg-9">
                <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control datepicker-menus" placeholder="Pick a date&hellip;" value="<?php echo $tanggal_lahir; ?>">
                </div>
        </div>
	    <div class="form-group">
            <label class="col-lg-3 control-label">Agama <?php echo form_error('agama') ?></label>
              <div class="col-lg-9">
              <select class="select" class="select select-lg" name="agama"  placeholder="Pilih.." id="agama">
               <option></option>>
               <option <?php if( $agama=='Islam'){echo "selected"; } ?> value='Islam'>Islam</option>

               <option <?php if( $agama=='Kristen'){echo "selected"; } ?> value='Kristen'>Kristen</option>

               <option <?php if( $agama=='Katolik'){echo "selected"; } ?> value='Katolik'>Katolik</option>

               <option <?php if( $agama=='Hindu'){echo "selected"; } ?> value='Hindu'>Hindu</option>

               <option <?php if( $agama=='Budha'){echo "selected"; } ?> value='Budha'>Budha</option>
               </select>
               </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
            <div class="col-lg-9">
            <label class="radio-inline">
            <input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="styled" value="L" <?php if($jenis_kelamin=='L'){echo 'checked';}?> /> Laki-laki</label>
            <label class="radio-inline">
            <input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="styled" value="P" <?php if($jenis_kelamin=='P'){echo 'checked';}?> /> Perempuan</label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Alamat : <?php echo form_error('alamat') ?></label>
            <div class="col-lg-9">
            <textarea rows="5" cols="5" class="form-control" class="form-control" id="alamat" name="alamat" placeholder="Lokasi"><?php echo $alamat; ?></textarea>
            </div>
        </div> 
                                                                                
        </fieldset>
        </div>
        <div class="col-md-6">
        <fieldset>
        <br>
	    <div class="form-group">
            <label class="col-lg-3 control-label">Bidang Keahlian : <?php echo form_error('bidang_keahlian') ?></label>
            <div class="col-lg-9">
            <input type="text" class="form-control" name="bidang_keahlian" id="bidang_keahlian" placeholder="Bidang Keahlian" value="<?php echo $bidang_keahlian; ?>" />
            </div>
        </div>
	    <div class="form-group">
            <label class="col-lg-3 control-label">Jabatan : <?php echo form_error('jabatan') ?></label>
            <div class="col-lg-9">
            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
            </div>
        </div>
	    <div class="form-group">
            <label class="col-lg-3 control-label">No telp. : <?php echo form_error('tlpn') ?></label>
            <div class="col-lg-9">
            <input type="text" class="form-control" name="tlpn" id="tlpn" placeholder="Tlpn" value="<?php echo $tlpn; ?>" />
            </div>
        </div>
	    <div class="form-group">
            <label class="col-lg-3 control-label">Status <?php echo form_error('status') ?></label>
            <div class="col-lg-9">
            <select class="select" class="select select-lg" name="status"  placeholder="Pilih.." id="status">
            <option></option>>
            <option  <?php if($action="Update"){if($status=='Tetap'){echo"selected=selected";}}?> value="Tetap"> Tetap</option>
            <option  <?php if($action=="Update"){if($status=='Tidak Tetap'){echo"selected=selected";}}?> value="Tidak Tetap">Tidak Tetap</option>
            </select>
            </div>
            </div>
	    </fieldset>
                <div class="text-right">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="hidden" name="id_dosen" value="<?php echo $id_dosen; ?>" /> 
                                <a href="<?php echo site_url('admin/dosen') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
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