	<div id="content-right">
		<?php echo form_open("news/search/set", 'class="searchform"'); ?>
			<input class="searchfield" name="cari" type="text" placeholder="Pencarian....."/>
			<input class="searchbutton" type="submit" value="Cari" />
		<?php echo form_close(); ?>
		<div class="cleaner_h0"></div>
		<div id="ribbon-content-right"></div>
		<div class="cleaner_h0"></div>
		<img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/space-iklan-3.png" />
		<div class="cleaner_h10"></div>
		
	
		<div class="tabbed_box">
			<div class="tabbed_area">
				<ul class="tabs">
					<li><a href="javascript:void(0);" title="content_1" class="tab active">Terpopuler</a></li>
					<li><a href="javascript:void(0);" title="content_2" class="tab">Terbaru</a></li>
				</ul>
				<div id="content_1" class="content">
					<ul>
						<?php echo $home_terpopuler; ?>
					</ul>
				</div>
				<div id="content_2" class="content">
					<ul>
						<?php echo $home_terkini_sidebar; ?>
					</ul>
				</div>
			</div>
		</div>
		
		<div id="title-content-right">KOLOM OPINI</div>
		<div class="cleaner_h0"></div>
		<div id="ribbon-content-right"></div>
		<div id="sub-content-right">
		<div id="sub-big-bottom-content-left">
		<div class="cleaner_h10"></div>
			<?php echo $home_terkini_kolom_opini_main; ?>
			<div class="cleaner_h5"></div>
			<ul>
				<?php echo $home_terkini_kolom_opini; ?>
			</ul>
		</div>
		</div>
		
		<div class="cleaner_h20"></div>
		
		<div id="title-content-right">KOLOM SMS WARGA</div>
		<div class="cleaner_h0"></div>
		<div id="ribbon-content-right"></div>
		<div id="sub-content-right">
		<div id="sub-big-bottom-content-left">
		<div class="cleaner_h10"></div>
			<?php echo $home_terkini_kolom_sms_main; ?>
			<div class="cleaner_h5"></div>
			<ul>
				<?php echo $home_terkini_kolom_sms; ?>
			</ul>
		</div>
		</div>
		
		<div class="cleaner_h20"></div>
		
		<div id="title-content-right">KOLOM TEKNOLOGI</div>
		<div class="cleaner_h0"></div>
		<div id="ribbon-content-right"></div>
		<div id="sub-content-right">
		<div id="sub-big-bottom-content-left">
		<div class="cleaner_h10"></div>
			<?php echo $home_terkini_kolom_tekno_main; ?>
			<div class="cleaner_h5"></div>
			<ul>
				<?php echo $home_terkini_kolom_tekno; ?>
			</ul>
		</div>
		</div>
		
		<div class="cleaner_h20"></div>
		
		<div id="title-content-right">KOLOM MANCANEGARA</div>
		<div class="cleaner_h0"></div>
		<div id="ribbon-content-right"></div>
		<div id="sub-content-right">
		<div id="sub-big-bottom-content-left">
		<div class="cleaner_h10"></div>
			<?php echo $home_terkini_kolom_manca_main; ?>
			<div class="cleaner_h5"></div>
			<ul>
				<?php echo $home_terkini_kolom_manca; ?>
			</ul>
		</div>
		</div>
		
	</div><!-- akhir content right -->