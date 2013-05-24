<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Route extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk routing
	 **/
	 
	public function index()
	{
		if($this->session->userdata("logged_in")=="")
		{
 			$this->load->view($GLOBALS['site_theme']."/login/login");
		}
		else
		{
			redirect("app_admin");
		}
	}
}

/* End of file app_route.php */
/* Location: ./application/controllers/app_route.php */