<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pages extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 

	function index($id_param=0)
	{
		//menu
		$d['menu_atas'] = $this->app_global_web->generate_index_menu("menu");
		$d['menu_bawah'] = $this->app_global_web->generate_index_menu("kategori");

		//breadcrumb
		$get_menu = $this->db->get_where("dlmbg_menu",array("id_menu"=>$id_param))->row();
		if($get_menu->url_route!="")
		{
			redirect($get_menu->url_route);
		}
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb($get_menu->menu, base_url().'web/bidang');

		$d['meta_description'] = $GLOBALS['site_meta'];
		$d['meta_keywords'] = $GLOBALS['site_keywords'];
		$d['meta_author'] = $GLOBALS['site_author'];
		$d['title'] = $get_menu->menu.' - ';

		$d['home_slide_headline'] = $this->app_global_web->generate_berita_slide_headline($id_param,"DESC",$GLOBALS['site_limit_small']);
		$d['home_headline'] = $this->app_global_web->generate_berita_headline_kategori($id_param,"DESC",2,$GLOBALS['site_limit_small']);

		//content
		$d['detail_content'] = $this->app_global_web->generate_detail_content($id_param);

		//sidebar
		$d['home_terkini_kolom_opini_main'] = $this->app_global_web->generate_berita_list_thumb(7,"DESC",1);
		$d['home_terkini_kolom_opini'] = $this->app_global_web->generate_berita_list_no_thumb(7,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_sms_main'] = $this->app_global_web->generate_berita_list_thumb(8,"DESC",1);
		$d['home_terkini_kolom_sms'] = $this->app_global_web->generate_berita_list_no_thumb(8,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_tekno_main'] = $this->app_global_web->generate_berita_list_thumb(9,"DESC",1);
		$d['home_terkini_kolom_tekno'] = $this->app_global_web->generate_berita_list_no_thumb(9,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terkini_kolom_manca_main'] = $this->app_global_web->generate_berita_list_thumb(10,"DESC",1);
		$d['home_terkini_kolom_manca'] = $this->app_global_web->generate_berita_list_no_thumb(10,"id_berita","DESC",$GLOBALS['site_limit_tiny'],1);

		$d['home_terpopuler'] = $this->app_global_web->generate_berita_list_no_thumb("","counter_read","DESC",$GLOBALS['site_limit_medium'],0);

		$d['home_terkini_sidebar'] = $this->app_global_web->generate_berita_list_no_thumb("","id_berita","DESC",$GLOBALS['site_limit_medium'],0);

		$d['kategori_footer'] = $this->app_global_web->generate_kategori_footer();

 		$this->load->view($GLOBALS['site_theme']."/front/bg_header",$d);
 		$this->load->view($GLOBALS['site_theme']."/front/content/bg_home");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_right");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_footer");
	}
}
