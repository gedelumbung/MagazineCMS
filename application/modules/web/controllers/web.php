<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class web extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 

	function index()
	{
		$d['menu_atas'] = $this->app_global_web->generate_index_menu("menu");
		$d['menu_bawah'] = $this->app_global_web->generate_index_menu("kategori");
		$d['meta_description'] = $GLOBALS['site_meta'];
		$d['meta_keywords'] = $GLOBALS['site_keywords'];
		$d['meta_author'] = $GLOBALS['site_author'];
		$d['title'] = "";

		$d['home_slide_headline'] = $this->app_global_web->generate_berita_slide_headline("","DESC",$GLOBALS['site_limit_small']);
		$d['home_headline'] = $this->app_global_web->generate_berita_headline("","DESC",2,$GLOBALS['site_limit_small']);
		$d['home_terkini'] = $this->app_global_web->generate_berita_list_no_thumb("","id_berita","DESC",$GLOBALS['site_limit_medium'],0);

		$d['home_terkini_kolom_news_main'] = $this->app_global_web->generate_berita_list_thumb(1,"DESC",1);
		$d['home_terkini_kolom_news'] = $this->app_global_web->generate_berita_list_no_thumb(1,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_politik_main'] = $this->app_global_web->generate_berita_list_thumb(2,"DESC",1);
		$d['home_terkini_kolom_politik'] = $this->app_global_web->generate_berita_list_no_thumb(2,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_ekonomi_main'] = $this->app_global_web->generate_berita_list_after_thumb(3,"DESC",1);
		$d['home_terkini_kolom_ekonomi'] = $this->app_global_web->generate_berita_list_no_thumb(3,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_pendidikan_main'] = $this->app_global_web->generate_berita_list_thumb(4,"DESC",1);
		$d['home_terkini_kolom_pendidikan'] = $this->app_global_web->generate_berita_list_no_thumb(4,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_sosial_main'] = $this->app_global_web->generate_berita_list_thumb(5,"DESC",1);
		$d['home_terkini_kolom_sosial'] = $this->app_global_web->generate_berita_list_no_thumb(5,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_kesehatan_main'] = $this->app_global_web->generate_berita_list_after_thumb(6,"DESC",1);
		$d['home_terkini_kolom_kesehatan'] = $this->app_global_web->generate_berita_list_no_thumb(6,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_opini_main'] = $this->app_global_web->generate_berita_list_thumb(7,"DESC",1);
		$d['home_terkini_kolom_opini'] = $this->app_global_web->generate_berita_list_no_thumb(7,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_sms_main'] = $this->app_global_web->generate_berita_list_thumb(8,"DESC",1);
		$d['home_terkini_kolom_sms'] = $this->app_global_web->generate_berita_list_no_thumb(8,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_tekno_main'] = $this->app_global_web->generate_berita_list_thumb(9,"DESC",1);
		$d['home_terkini_kolom_tekno'] = $this->app_global_web->generate_berita_list_no_thumb(9,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_manca_main'] = $this->app_global_web->generate_berita_list_thumb(10,"DESC",1);
		$d['home_terkini_kolom_manca'] = $this->app_global_web->generate_berita_list_no_thumb(10,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_berita_foto_main'] = $this->app_global_web->generate_berita_foto_list_thumb(14,"DESC",4,"berita_foto");

		$d['home_terpopuler'] = $this->app_global_web->generate_berita_list_no_thumb("","counter_read","DESC",$GLOBALS['site_limit_medium'],0);

		$d['home_terkini_sidebar'] = $this->app_global_web->generate_berita_list_no_thumb("","id_berita","DESC",$GLOBALS['site_limit_medium'],0);

		$d['kategori_footer'] = $this->app_global_web->generate_kategori_footer();

 		$this->load->view($GLOBALS['site_theme']."/front/bg_header",$d);
 		$this->load->view($GLOBALS['site_theme']."/front/bg_home");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_right");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_footer");
	}
 

	function pages($id_param=0)
	{
		$where['id_menu'] = $id_param;
		$get_data = $this->db->get_where("dlmbg_menu",$where);
		if($get_data->num_rows()>0)
		{
			$h = $get_data->row();
			if($h->url_route=="")
			{
				$d['judul'] = $h->menu;
				$d['content'] = $h->content;
				
				$d['menu_atas'] = $this->app_global_web->generate_index_menu("atas");
				$d['menu_bawah'] = $this->app_global_web->generate_index_menu("bawah");
				$this->load->view($GLOBALS['site_theme']."/front/bg_header",$d);
				$this->load->view($GLOBALS['site_theme']."/front/bg_pages");
				$this->load->view($GLOBALS['site_theme']."/front/bg_footer");
			}
      		else
      		{
				redirect($h->url_route);
      		}
		}
		else
		{
			redirect(base_url());
		}
	}
}
