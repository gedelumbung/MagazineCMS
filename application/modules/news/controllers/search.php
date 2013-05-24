<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 

	function index($uri=0)
	{
		//menu
		$d['menu_atas'] = $this->app_global_web->generate_index_menu("menu");
		$d['menu_bawah'] = $this->app_global_web->generate_index_menu("kategori");

		$d['meta_description'] = $GLOBALS['site_meta'];
		$d['meta_keywords'] = $GLOBALS['site_keywords'];
		$d['meta_author'] = $GLOBALS['site_author'];
		$d['title'] = 'Hasil Pencarian - ';

		//breadcrumb
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb("Pencarian", base_url().'web/bidang');

		//content
		$cari = $this->session->userdata("pencarian");
		$d['detail_berita'] = $this->app_global_web->generate_cari_berita($cari,$GLOBALS['site_limit_medium'],$uri);

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
 		$this->load->view($GLOBALS['site_theme']."/front/berita/bg_home");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_right");
 		$this->load->view($GLOBALS['site_theme']."/front/bg_footer");
	}
 

	function set()
	{
		$set['pencarian'] = $_POST['cari'];
		$this->session->set_userdata($set);
		redirect("news/search");
	}
}
