<script type="text/javascript">
$(document).ready(function() { 
   $('#slider').s3Slider({ 
      timeOut: 6000 
   });
  });
</script>
	<div id="content-left">
		<?php echo $this->breadcrumb->output(); ?>
		<div class="cleaner_h10"></div>
		<div id="main-kategori-left">
			<div id="slider">
			  <?php echo $home_slide_headline; ?>
			</div>
		</div>
		<div id="main-kategori-right">
			<?php echo $home_headline; ?>
		</div>
		
		<div class="cleaner_h5"></div>
			<img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/space-iklan-2.png" />
		<div class="cleaner_h10"></div>
		
		<?php echo $list_berita; ?>
	
	</div><!-- akhir content left -->