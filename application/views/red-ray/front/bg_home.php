<script type="text/javascript">
$(document).ready(function() { 
   $('#slider').s3Slider({ 
      timeOut: 6000 
   });
  });
</script>
	<div id="content-left">
		<div id="small-top-content-left">
			<div id="title-small-top-content-left">KABAR TERKINI</div>
			<div id="ribbon-title-small-top-content-left"></div>
			<div class="cleaner_h0"></div>
			<ul>
				<?php echo $home_terkini; ?>
			</ul>
		</div>
		<div id="big-top-content-left">
			<div id="title-big-top-content-left">
				HEADLINE NEWS
			</div>
			
			<div class="cleaner_h5"></div>
			
			<div id="slider">
			   <?php echo $home_slide_headline; ?>
			</div>
			
			<div id="bottom-headline">
				<?php echo $home_headline; ?>
			</div>
		</div>
		<div class="cleaner_h10"></div>
			<img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/space-iklan-2.png" />
		<div class="cleaner_h10"></div>
		<div id="big-bottom-content-left">
			<div id="title-big-bottom-content-left">KOLOM NEWS</div>
				<div id="ribbon-title-big-bottom-content-left"></div>
				<div id="sub-big-bottom-content-left">
					<?php echo $home_terkini_kolom_news_main; ?>
					<div class="cleaner_h5"></div>
					<ul>
						<?php echo $home_terkini_kolom_news; ?>
					</ul>
				</div>
			<div class="cleaner_h20"></div>
			<div id="title-big-bottom-content-left">KOLOM POLITIK</div>
				<div id="ribbon-title-big-bottom-content-left"></div>
				<div id="sub-big-bottom-content-left">
					<?php echo $home_terkini_kolom_politik_main; ?>
					<div class="cleaner_h5"></div>
					<ul>
						<?php echo $home_terkini_kolom_politik; ?>
					</ul>
				</div>
		</div>
		
		<div id="small-bottom-content-left">
			<div id="title-small-bottom-content-left">KOLOM EKONOMI</div>
			<div class="cleaner_h5"></div>
			<?php echo $home_terkini_kolom_ekonomi_main; ?>
					<div class="cleaner_h5"></div>
					<ul>
						<?php echo $home_terkini_kolom_ekonomi; ?>
					</ul>
		</div>
		
		<div class="cleaner_h10"></div>
			<img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/space-iklan-2.png" />
		<div class="cleaner_h10"></div>
		
		<div id="large-bottom-content-left">
			<div id="title-large-bottom-content-left">KOLOM BERITA FOTO</div>
			<div id="ribbon-title-large-bottom-content-left"></div>
			<div class="cleaner_h0"></div>
				<?php echo $home_terkini_kolom_berita_foto_main; ?>
		</div>
		
		<div class="cleaner_h10"></div>
			<img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/space-iklan-2.png" />
		<div class="cleaner_h10"></div>
		
		<div id="big-bottom-content-left">
			<div id="title-big-bottom-content-left">KOLOM PENDIDIKAN</div>
				<div id="ribbon-title-big-bottom-content-left"></div>
				<div id="sub-big-bottom-content-left">
					<?php echo $home_terkini_kolom_pendidikan_main; ?>
					<div class="cleaner_h5"></div>
					<ul>
						<?php echo $home_terkini_kolom_pendidikan; ?>
					</ul>
				</div>
			<div class="cleaner_h20"></div>
			<div id="title-big-bottom-content-left">KOLOM SOSIAL BUDAYA</div>
				<div id="ribbon-title-big-bottom-content-left"></div>
				<div id="sub-big-bottom-content-left">
					<?php echo $home_terkini_kolom_sosial_main; ?>
					<div class="cleaner_h5"></div>
					<ul>
						<?php echo $home_terkini_kolom_sosial; ?>
					</ul>
				</div>
		</div>
		
		<div id="small-bottom-content-left">
			<div id="title-small-bottom-content-left">KOLOM KESEHATAN</div>
			<div class="cleaner_h5"></div>
					<?php echo $home_terkini_kolom_kesehatan_main; ?>
					<div class="cleaner_h5"></div>
					<ul>
						<?php echo $home_terkini_kolom_kesehatan; ?>
					</ul>
		</div>
		
		<div class="cleaner_h10"></div>
	</div><!-- akhir content left -->