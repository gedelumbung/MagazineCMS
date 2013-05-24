<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tags extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in")!="")
		{
			$d['data_retrieve'] = $this->app_global_admin_model->generate_index_tags($GLOBALS['site_limit_small'],$uri);
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("tags/bg_home");
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
			$d['tags'] = "";

			$d['tipe'] = "tambah";
			$d['id_param'] = "";
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("tags/bg_input");
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
			$where['id_tags'] = $id_param;
			$get = $this->db->get_where("dlmbg_tags",$where)->row();
			
			$d['tags'] = $get->tags;
			
			$d['id_param'] = $get->id_tags;
			$d['tipe'] = "edit";
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("tags/bg_input");
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
			$tipe = $this->input->post("tipe");
			$id['id_tags'] = $this->input->post("id_param");
			if($tipe=="tambah")
			{
				$in['tags'] = $this->input->post("tags");
				
				$this->db->insert("dlmbg_tags",$in);
			}
			else if($tipe=="edit")
			{
				$in['tags'] = $this->input->post("tags");

				$this->db->update("dlmbg_tags",$in,$id);
				
			}
			
			redirect("app_admin/tags");
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
			$where['id_tags'] = $id_param;
			$this->db->delete("dlmbg_tags",$where);
			redirect("app_admin/tags");
		}
		else
		{
			redirect(base_url());
		}
   }
}
 
/* End of file superadmin.php */
