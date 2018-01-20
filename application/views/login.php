<?php
$this->load->view('template/head');
?>
<div class="navbar navbar-inverse">
    <div class="navbar-header">
      <a class="navbar-brand" ><img src="<?php echo base_url('assets/images/logo_dark.png')?>"  "  ></a>

      <ul class="nav navbar-nav pull-right visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
      </ul>
    </div>


  </div>
    <!-- Page content -->
  <div class="page-container login-container">

    <!-- Page content -->
    <div class="page-content">

      <!-- Main content -->
      <div class="content-wrapper">
 <div class="panel panel-flat">
            <div class="panel-body">
          <!-- Simple login form -->
        <div class="col-md-7">

                            <div class="text-LEFT">
                                <h4 class="no-margin text-semibold">Perhatian ! Harap waspada terhadap pencurian password.</h4>

                            </div>
                            <p class="content-group-sm text-muted">Pastikan bahwa alamat yang anda tuju dan tertulis pada browser adalah <code>https://localhost/siakad</code> :</p>
                            <div class="well">
                                <ul class="list list-circle no-margin-bottom">
                                    <li>Jika anda memiliki permasalahan yang berhubungan dengan pembayaran, silakan menghubungi Bagian Keuangan XXX XXXX</li>
                                    <li>Pengambilan account baru, penggantian password jika lupa/hilang, atau pengaktifan account untuk account yang sudah tidak aktif dapat dilakukan di :

<br>Bagian Asesment
Fakultas XXX XXXX
Senin-Jumat 09.00-16.00
Tel.  (0370) - 6175565
<br>Bagian IT
Fakultas XXXX XXXX
Senin-Jumat 09.00-16.00
Tel.  (0370) - 6175565</li>
<li>Pengisian KRS Online dapat dilakukan dari <code>tanggal 01-15 april</code><br>jika lewat dari waktu yang telah ditentukan, mahasiswa tidak dapat melakukan pengisian KRS</li>

                                </ul>
                            </div>
        </div>

        <div class="col-md-3">
        <?php echo form_open("auth/cek_login"); ?>
              <div class="text-center">
                <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
              </div>
               <?php echo $this->session->flashdata('message'); ?>
              <div class="form-group has-feedback has-feedback-left">
                <input type="text" class="form-control" placeholder="Username" name="identity" autocomplete="off">
                <?php echo form_error('identity'); ?>
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
              </div>

              <div class="form-group has-feedback has-feedback-left">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <?php echo form_error('password'); ?>
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
              </div>
              <div class="form-group login-options">
              <div class="row">
                <div class="col-sm-6">
                  <label class="checkbox-inline">
                    <input type="checkbox" class="styled"  id="remember" name="remember">
                    Remember me
                  </label>
                </div>


              </div>
            </div>
            <div class="form-group">
             <?php echo $widget;?>
            <?php echo $script;?>
           </div>
              <div class="form-group">
                <button type="submit" class="btn bg-success btn-block" >Sign in <i class="icon-arrow-right14"></i></button>
              </div>

           <?php echo form_close(); ?>
           </div>

</div>

          <!-- /simple login form -->
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>
