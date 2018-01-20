<?php
$this->load->view('template/head');
$this->load->view('template/navbar');
$this->load->view('template/navbarmahasiswa');
?>
 <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
            	<div class="row">
            	<div class="col-md-12">
            	<div class="panel panel-flat border-left-xlg border-left-success">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="text-semibold">Selamat Datang <?php echo $this->session->userdata('nama_lengkap'); ?></h3>
							</div>
							<div class="panel-body">
								Cpanel Sistem Informasi Akademik Fakultas XXX XXX
							</div>
						</div>
						</div>
					<div class="col-md-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h6 class="panel-title">Pengumuman</h6>
							<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								Pengisian KRS Online akan di lakukan dari tanggal 12 Juni - 30 Juli 2017
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h6 class="panel-title">Himbauan</h6>
							<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								Demi keamanan data mahasiswa, mohon agar mengganti password default dengan password lain dan rahasiakan password anda dengan baik.
							</div>
						</div>
				</div>
				</div>
				<!-- /panel heading options -->
				</div>

</div>


<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>
