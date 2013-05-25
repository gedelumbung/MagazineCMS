	<section class="container">
	
		<!-- Headings
			================================================== -->
		<section class="row-fluid">
			<h1 class="box-header"><span class="icon-file-alt"></span> Berita | <?php echo $GLOBALS['site_title']; ?></h1>
			<div class="box">
				<div class="well">
					<?php echo form_open_multipart("app_admin/berita/simpan"); ?>
					<?php echo validation_errors(); ?>
				<label for="judul_berita">Judul Berita</label>
				<div class="cleaner_h5"></div>
				<input type="search" style="width:90%;" id="judul_berita" name="judul_berita" placeholder="Judul Berita" value="<?php echo $judul_berita; ?>" />
				<div class="cleaner_h10"></div>
				
				<label for="tipe">Kategori</label>
				<div class="cleaner_h5"></div>
				<select name="id_kategori">
					<?php
						foreach($kategori->result() as $kat)
						{
							if($kat->id_menu==$id_kategori)
							{
					?>
						<option value="<?php echo $kat->id_menu; ?>" selected="selected"><?php echo $kat->menu; ?></option>
					<?php	
							}
							else
							{
					?>
						<option value="<?php echo $kat->id_menu; ?>"><?php echo $kat->menu; ?></option>
					<?php
							}
						}
					?>
					<?php
						foreach($kategori_menu->result_array() as $kat)
						{
							if($kat['id_menu']==$id_kategori)
							{
					?>
						<option value="<?php echo $kat['id_menu']; ?>" selected="selected"><?php echo $kat['menu']; ?></option>
					<?php	
							}
							else
							{
					?>
						<option value="<?php echo $kat['id_menu']; ?>"><?php echo $kat['menu']; ?></option>
					<?php
							}
						}
					?>
				</select>
				<div class="cleaner_h10"></div>
				
				<label for="isi_berita">Content of Setting</label>
				<div class="cleaner_h5"></div>
				<textarea name="isi_berita" class="ckeditor"><?php echo $isi_berita; ?></textarea>
				<div class="cleaner_h10"></div>
				
				<label for="isi_berita">Headline</label>
				<div class="cleaner_h5"></div>
				<?php
					$y = 'selected';$n = 'selected';
					if($headline==1){$y = 'selected';$n = '';}
					else if($headline==0){$y = '';$n = 'selected';}
				?>
				<select name="headline">
					<option value="0" <?php echo $n; ?>>No</option>
					<option value="1" <?php echo $y; ?>>Yes</option>
				</select>
				<div class="cleaner_h10"></div>
				
				<label for="isi_berita">Jenis</label>
				<div class="cleaner_h5"></div>
				<?php
					$b = '';$bf = '';
					if($jenis=="berita"){$b = 'selected';$bf = '';}
					else if($jenis=="berita_foto"){$b = '';$bf = 'selected';}
				?>
				<select name="jenis">
					<option value="berita" <?php echo $b; ?>>Berita</option>
					<option value="berita_foto" <?php echo $bf; ?>>Berita Foto</option>
				</select>
				<div class="cleaner_h10"></div>
				
				<label for="isi_berita">Gambar Thumbnail</label>
				<div class="cleaner_h5"></div>
				<?php
					$gbr = "no-image.jpg";
					if($gambar!="")
					{
						$gbr = $gambar;
					}
					if($tipe=="edit")
					{
						echo '<img src="'.base_url().'asset/berita/'.$gbr.'" width="300" height="200" />';
					}
				?><p></p>
				<input type="file" name="userfile" />
				<div class="cleaner_h10"></div>
				
				<label for="isi_berita">Tags</label>
				<div class="cleaner_h5"></div>
				<?php
					if($tipe=="edit")
					{
						foreach($tags_in->result_array() as $t)
						{
					?>
							<label class="checkbox">
							  <input type="checkbox" name="id_tags[]" value="<?php echo $t['id_tags']; ?>" checked="checked"> <?php echo $t['tags']; ?>
							</label>
					<?php
						}
					}
				?>
				<?php
					foreach($tags->result_array() as $t)
					{
				?>
						<label class="checkbox">
						  <input type="checkbox" name="id_tags[]" value="<?php echo $t['id_tags']; ?>"> <?php echo $t['tags']; ?>
						</label>
				<?php
					}
				?>
				<div class="cleaner_h10"></div>
				
				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>" />
				<input type="hidden" name="tipe" value="<?php echo $tipe; ?>" />
				<input type="hidden" name="gambar" value="<?php echo $gambar; ?>" />
				<div class="cleaner_h10"></div>
				<input type="submit" class="btn btn-info" value="SIMPAN" />
				<?php echo form_close(); ?>
				</div>
			</div>
		</section>