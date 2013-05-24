<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class routing_pages extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in")!="")
		{
			$d['data_retrieve'] = $this->app_global_admin_model->generate_menu($GLOBALS['site_limit_small'],$uri);
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("routing_pages/bg_home");
 			$this->load->view("bg_footer");
		}
		else
		{
			redirect(base_url());
		}
   }
 
   public function tambah()
   {
		if($this->session->userdata("logged_in")!="")
		{
			$d['menu'] = "";
			$d['url_route'] = "";
			$d['content'] = "";
			$d['tipe'] = "";
			
			$d['id_param'] = "";
			$d['tipe_add'] = "tambah";
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("routing_pages/bg_input");
 			$this->load->view("bg_footer");
		}
		else
		{
			redirect(base_url());
		}
   }
 
   public function edit($id_param)
   {
		if($this->session->userdata("logged_in")!="")
		{
			$where['id_menu'] = $id_param;
			$get = $this->db->get_where("dlmbg_menu",$where)->row();
			
			$d['menu'] = $get->menu;
			$d['url_route'] = $get->url_route;
			$d['content'] = $get->content;
			$d['tipe'] = $get->tipe;
			
			$d['id_param'] = $get->id_menu;
			$d['tipe_add'] = "edit";
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("routing_pages/bg_input");
 			$this->load->view("bg_footer");
		}
		else
		{
			redirect(base_url());
		}
   }
 
   public function simpan()
   {
		if($this->session->userdata("logged_in")!="")
		{
			$tipe_add = $this->input->post("tipe_add");
			$id['id_menu'] = $this->input->post("id_param");
			if($tipe_add=="tambah")
			{
				$in['menu'] = $this->input->post("menu");
				$in['url_route'] = $this->input->post("url_route");
				$in['content'] = $this->input->post("content");
				$in['tipe'] = $this->input->post("tipe");
				
				$this->db->insert("dlmbg_menu",$in);
			}
			else if($tipe_add=="edit")
			{
				$in['menu'] = $this->input->post("menu");
				$in['url_route'] = $this->input->post("url_route");
				$in['content'] = $this->input->post("content");
				$in['tipe'] = $this->input->post("tipe");
				
				$this->db->update("dlmbg_menu",$in,$id);
			}
			
			redirect("app_admin/routing_pages");
		}
		else
		{
			redirect(base_url());
		}
   }
 
	public function hapus($id_param)
	{
		if($this->session->userdata("logged_in")!="")
		{
			$where['id_menu'] = $id_param;
			$this->db->delete("dlmbg_menu",$where);
			redirect("app_admin/routing_pages");
		}
		else
		{
			redirect(base_url());
		}
   }
}
 
/* End of file superadmin.php */
