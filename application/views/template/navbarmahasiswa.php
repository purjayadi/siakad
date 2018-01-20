	<div class="navbar navbar-inverse bg-success">
	<!-- Second navbar -->
	<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>
		<div class="navbar-boxed">
		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo site_url() ?>mahasiswa/dashboard"><i class="icon-home2 position-left"></i> Dashboard</a></li>
				<li><a href="<?php echo site_url() ?>mahasiswa/dashboard/update/<?php echo $this->session->userdata('username')?>"> <i class="icon-graduation"></i> Profile</a></li>
				
				<li><a href="starters/layout_boxed.html"><i class="icon-archive"></i> Data KHS</a></li>
				<li><a href="starters/layout_boxed.html"><i class="icon-newspaper"></i> Data KRS</a></li>
				<li><a href="<?php echo site_url() ?>admin/qnilai"><i class="icon-certificate"></i> Petikan Nilai</a></li>
			</ul>
			<p class="navbar-text"><span class="label"><?php echo $this->session->userdata('level'); ?></span></p>
			<ul class="nav navbar-nav navbar-right">
					<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo base_url('assets/images/users/users.gif')?>" /> 
						<?php echo $this->session->userdata('username'); ?>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo site_url() ?>auth/change_password"><i class="icon-key"></i> Ganti Password</a></li>
						<li><a href="<?php echo site_url() ?>logout"><i class="icon-exit3"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<!-- /second navbar -->
