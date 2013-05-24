
	<!-- Main navigation bar
		================================================== -->
	<header class="navbar navbar-fixed-top" id="main-navbar">
		<div class="navbar-inner">
			<div class="container">
				<a class="logo" href="#"><img alt="Af_logo" src="<?php echo base_url().'asset/theme/'; ?>/dashboard/images/af-logo.png"></a>

				<a class="btn nav-button collapsed" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-reorder"></span>
				</a>

				<div class="nav-collapse collapse">
					<ul class="nav">
						<li class="divider-vertical"></li>
						<li class="active"><a href="<?php echo base_url(); ?>"><i class="icon-home"></i> Front Page</a></li>
						<li class="divider-vertical"></li>
						<li><a href="<?php echo base_url(); ?>app_admin/routing_pages"><i class="icon-fire"></i> Routing Pages</a></li>
						<li class="divider-vertical"></li>
						<li><a href="<?php echo base_url(); ?>app_admin/sistem"><i class="icon-wrench"></i> System</a></li>
						<li class="divider-vertical"></li>
						<li><a href="<?php echo base_url(); ?>app_admin/tags"><i class="icon-tags"></i> Tags</a></li>
					</ul>
					<ul class="nav pull-right">
					<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle usermenu" data-toggle="dropdown">
								<i class="icon-user"></i> <?php echo $this->session->userdata("nama_user_login"); ?> <i class=" icon-caret-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo base_url(); ?>global/profil"><i class="icon-user"></i> Ubah Profil</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>global/password"><i class="icon-wrench"></i> Ubah Password</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo base_url(); ?>login/login/logout"><i class="icon-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>
	<!-- / Main navigation bar -->
	
	<!-- Left navigation panel
		================================================== -->
	<nav id="left-panel">
		<div id="left-panel-content">
			<ul>
				<li>
					<a href="<?php echo base_url(); ?>app_route"><span class="icon-dashboard"></span>Dashboard</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>app_admin/data_dokter"><span class="icon-file-alt"></span>Berita</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>app_admin/user"><span class="icon-cog"></span>Data User</a>
				</li>
			</ul>
		</div>
		<div class="icon-caret-down"></div>
		<div class="icon-caret-up"></div>
	</nav>