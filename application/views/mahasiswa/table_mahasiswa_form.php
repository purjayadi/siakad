<?php
$this->load->view('template/head');
$this->load->view('template/navbar');
$this->load->view('template/secnavbar');
$url = base_url('assets/images/mahasiswa/').$photo;
?>

 <div class="page-container">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
            <div class="panel panel-flat">
            <div class="panel-body">
        <h2 style="margin-top:0px"><?php echo $button ?> Data Mahasiswa</h2>
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
           <div class="col-md-6">
                                    <fieldset>
                                        <br>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">NIM <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM" value="<?php echo $nim; ?>" />
                                                <?php echo form_error('nim'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Nama Mahasiswa <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Nama Mahasiswa" value="<?php echo $nama_mahasiswa; ?>">
                                                <?php echo form_error('nama_mahasiswa'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Tempat Lahir <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>">
                                                <?php echo form_error('tempat_lahir'); ?>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-3 control-label">Tanggal Lahir <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datepicker-menus" placeholder="Pick a date&hellip;" value="<?php echo $tgl_lahir; ?>">
                                                <?php echo form_error('tgl_lahir'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Agama <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                            <select class="select"  name="agama"  placeholder="Pilih.." id="agama">
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
                                            <label class="col-lg-3 control-label">Jenis Kelamin <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                               <label class="radio-inline">
                                                 <input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="styled" value="L" <?php if($jenis_kelamin=='L'){echo 'checked';}?> /> Laki-laki</label>
                                            <label class="radio-inline">
                                                 <input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="styled" value="P" <?php if($jenis_kelamin=='P'){echo 'checked';}?> /> Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Alamat <span class="text-danger"> *</span> :</label>
                                            <div class="col-lg-9">
                                               <textarea rows="5" cols="5" class="form-control" class="form-control" id="alamat" name="alamat" placeholder="Lokasi"><?php echo $alamat; ?></textarea>
                                               <?php echo form_error('alamat'); ?>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <fieldset>
                                       <br>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Angkatan <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="angkatan" id="angkatan" class="form-control" placeholder="Tahun Angkatan" value="<?php echo $angkatan; ?>">
                                                <?php echo form_error('angkatan'); ?>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-3 control-label">Sekolah Asal <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="sekolah_asal" id="sekolah_asal" class="form-control" placeholder="Sekolah Asal" value="<?php echo $sekolah_asal; ?>">
                                                <?php echo form_error('sekolah_asal'); ?>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-3 control-label">No. HP/Telpn. <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="+00-00-0000-0000" value="<?php echo $no_hp; ?>">
                                                <?php echo form_error('no_hp'); ?>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Golongan Darah <span class="text-danger"> *</span></label>
                                            <div class="col-lg-9">
                                            <select class="select" name="gol_darah" id="gol_darah" data-placeholder="Pilih Golongan Darah" >
                                            <option></option>>
                                            <option <?php if( $gol_darah=='A'){echo "selected"; } ?> value="A">A</option>
                                            <option <?php if( $gol_darah=='B'){echo "selected"; } ?> value="B">B</option>
                                            <option <?php if( $gol_darah=='O'){echo "selected"; } ?> value="O">O</option>
                                            <option <?php if( $gol_darah=='AB'){echo "selected"; } ?> value="AB">AB</option>
                                            <option <?php if( $gol_darah=='Lainnya'){echo "selected"; } ?> value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        </div>
                                       <div class="form-group">
                                        <label class="col-lg-3 control-label">Photo</label>
                                        <div class="col-lg-9">
                                            <div class="media no-margin-top">
                                                <div class="media-left">
                                                    <a href="<?=$url?>" target="_blank"><img src="<?=$url?>" style="width: 58px; height: 58px;" class="img-rounded" alt=""></a>
                                                </div>

                                                <div class="media-body">
                                                    <input type="file" class="form-control" name="photo" id="photo">
                                                    <span class="help-block">Accepted formats: gif, png, jpg, bmp. Max file size 2Mb</span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </fieldset>
                            <div class="text-right">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <a href="<?php echo site_url('admin/Mahasiswa') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
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
