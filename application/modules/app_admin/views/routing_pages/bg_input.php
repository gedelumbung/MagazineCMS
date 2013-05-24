	<section class="container">
	
		<!-- Headings
			================================================== -->
		<section class="row-fluid">
			<h1 class="box-header"><span class="icon-fire"></span> Routing Pages | <?php echo $GLOBALS['site_title']; ?></h1>
			<div class="box">
				<div class="well">
					<?php echo form_open_multipart("app_admin/routing_pages/simpan"); ?>
				
				<label for="menu">Judul Menu</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="menu" name="menu" placeholder="Judul Menu" value="<?php echo $menu; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="url_route">URL Route </label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="url_route" name="url_route" placeholder="URL Route" value="<?php echo $url_route; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="content">Content</label>
				<div class="cleaner_h5"></div>
				<textarea name="content" class="ckeditor" cols="50" rows="6"><?php echo $content; ?></textarea>
				<div class="cleaner_h10"></div>
				
				<label for="content">tipe</label>
				<div class="cleaner_h5"></div>
				<?php
					$a=''; $s='';
					if($tipe=='menu'){$a='selected'; $s='';}
					else if($tipe=='kategori'){$a=''; $s='selected';}
				?>
				<select name="tipe">
					<option value="menu" <?php echo $a; ?>>Menu</option>
					<option value="kategori" <?php echo $s; ?>>Kategori</option>
				</select>
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe_add" value="<?php echo $tipe_add; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SIMPAN" />
				<?php echo form_close(); ?>
				</div>
			</div>
		</section>