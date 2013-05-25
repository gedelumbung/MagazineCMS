<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class berita extends MX_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
 
   public function index($uri=0)
   {
		if($this->session->userdata("logged_in")!="")
		{
			$this->breadcrumb->append_crumb('Dashboard', base_url().'superadmin');
			$this->breadcrumb->append_crumb("Berita", '/');
			
			$d['aktif_artikel_sekolah'] = "";
			$d['aktif_galeri_sekolah'] = "";
			$d['aktif_pengumuman'] = "";
			$d['aktif_agenda'] = "";
			$d['aktif_berita'] = "active";
			$d['aktif_buku_tamu'] = "";
			$d['aktif_list_download'] = "";
			
			$filter['judul'] = $this->session->userdata("by_judul");
			$d['data_retrieve'] = $this->app_global_admin_model->generate_index_berita($GLOBALS['site_limit_small'],$uri,$filter);
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("berita/bg_home");
 			$this->load->view("bg_footer");
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function tambah()
   {
		if($this->session->userdata("logged_in")!="")
		{
			$d['kategori'] = $this->db->get_where("dlmbg_menu",array("tipe" => "kategori"));
			$d['kategori_menu'] = $this->db->get_where("dlmbg_menu",array("id_menu" => "14"));
			$d['tags'] = $this->db->get("dlmbg_tags");
			
			$d['judul_berita'] = "";
			$d['isi_berita'] = "";
			$d['gambar'] = "";
			$d['headline'] = "";
			$d['jenis'] = "";
			$d['id_kategori'] = "";
			$d['id_tags'] = "";
			
			$d['id_param'] = "";
			$d['tipe'] = "tambah";
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("berita/bg_input");
 			$this->load->view("bg_footer");
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function edit($id_param)
   {
		if($this->session->userdata("logged_in")!="")
		{
			$d['kategori'] = $this->db->get_where("dlmbg_menu",array("tipe" => "kategori"));
			$d['kategori_menu'] = $this->db->get_where("dlmbg_menu",array("id_menu" => "14"));
			
			$where['id_berita'] = $id_param;
			$get = $this->db->get_where("dlmbg_berita",$where)->row();
			
			$d['judul_berita'] = $get->judul_berita;
			$d['isi_berita'] = $get->isi_berita;
			$d['gambar'] = $get->gambar;
			$d['headline'] = $get->headline;
			$d['jenis'] = $get->jenis;
			$d['id_kategori'] = $get->id_kategori;
			$d['id_tags'] = $get->id_tags;
			
			$arr_tags_in = array();
			$tg = explode(",",$get->id_tags);
			for($i=0;$i<count($tg);$i++)
			{
				array_push($arr_tags_in,$tg[$i]);
			}
			$d['tags_in'] = $this->db->where_in("id_tags",$arr_tags_in)->get("dlmbg_tags");
			$d['tags'] = $this->db->where_not_in("id_tags",$arr_tags_in)->get("dlmbg_tags");
			
			$d['id_param'] = $get->id_berita;
			$d['tipe'] = "edit";
			
 			$this->load->view("bg_header",$d);
 			$this->load->view("bg_menu");
 			$this->load->view("berita/bg_input");
 			$this->load->view("bg_footer");
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
   public function simpan()
   {
		if($this->session->userdata("logged_in")!="")
		{
			$tipe = $this->input->post("tipe");
			$id['id_berita'] = $this->input->post("id_param");
			if($tipe=="tambah")
			{
				$this->form_validation->set_rules('judul_berita', 'Judul', 'trim|required');
				$this->form_validation->set_rules('isi_berita', 'Isi', 'trim|required');
				$this->form_validation->set_rules('id_kategori', 'Kategori', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->tambah();
				}
				else
				{
					if($_FILES['userfile']['name']=="")
					{	
						if(!empty($_POST['id_tags']))
						{
							$tags = $_POST['id_tags'];
							$ic = 0;
							$tg = "";
							for($ic;$ic<count($tags);$ic++)
							{
								$tg .= $tags[$ic].',';
							}
							$in_data['id_tags'] = $tg;
						}
						$in_data['judul_berita'] = $this->input->post("judul_berita");
						$in_data['isi_berita'] = $this->input->post("isi_berita");
						$in_data['id_kategori'] = $this->input->post("id_kategori");
						$in_data['tanggal'] = time()+3600*7;
						$in_data['headline'] = $this->input->post("headline");
						$in_data['jenis'] = $this->input->post("jenis");
						$this->db->insert("dlmbg_berita",$in_data);
						
						redirect("app_admin/berita");
					}
					else
					{
						$config['upload_path'] = './asset/berita/thumb/';
						$config['allowed_types']= 'gif|jpg|png|jpeg';
						$config['encrypt_name']	= TRUE;
						$config['remove_spaces']	= TRUE;	
						$config['max_size']     = '3000';
						$config['max_width']  	= '3000';
						$config['max_height']  	= '3000';
				 
						$this->load->library('upload', $config);
		 
						if ($this->upload->do_upload("userfile")) {
							$data	 	= $this->upload->data();
				 
							/* PATH */
							$source             = "./asset/berita/thumb/".$data['file_name'] ;
							$destination_thumb	= "./asset/berita/" ;		 
							// Permission Configuration
							chmod($source, 0777) ;
				 
							/* Resizing Processing */
							// Configuration Of Image Manipulation :: Static
							$this->load->library('image_lib') ;
							$img['image_library'] = 'GD2';
							$img['create_thumb']  = TRUE;
							$img['maintain_ratio']= TRUE;
				 
							/// Limit Width Resize
							$limit_thumb    = 640 ;
				 
							// Size Image Limit was using (LIMIT TOP)
							$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
				 
							// Percentase Resize
							if ($limit_use > $limit_thumb) {
								$percent_thumb  = $limit_thumb/$limit_use ;
							}
				 
							//// Making THUMBNAIL ///////
							$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
							$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
				 
							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%' ;
							$img['source_image'] = $source ;
							$img['new_image']    = $destination_thumb ;
				 
							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear() ;
							
							if(!empty($_POST['id_tags']))
							{
								$tags = $_POST['id_tags'];
								$ic = 0;
								$tg = "";
								for($ic;$ic<count($tags);$ic++)
								{
									$tg .= $tags[$ic].',';
								}
								$in_data['id_tags'] = $tg;
							}
							
							$in_data['gambar'] = $data['file_name'];
							$in_data['judul_berita'] = $this->input->post("judul_berita");
							$in_data['isi_berita'] = $this->input->post("isi_berita");
							$in_data['id_kategori'] = $this->input->post("id_kategori");
							$in_data['tanggal'] = time()+3600*7;
							$in_data['headline'] = $this->input->post("headline");
							$in_data['jenis'] = $this->input->post("jenis");
							$this->db->insert("dlmbg_berita",$in_data);
							unlink($source);
							redirect("app_admin/berita");
						}
						else 
						{
							echo $this->upload->display_errors('<p>','</p>');
						}
					}
				}
			}
			else if($tipe=="edit")
			{
				if(empty($_FILES['userfile']['name']))
				{
					if(!empty($_POST['id_tags']))
					{
						$tags = $_POST['id_tags'];
						$ic = 0;
						$tg = "";
						for($ic;$ic<count($tags);$ic++)
						{
							$tg .= $tags[$ic].',';
						}
						$in_data['id_tags'] = $tg;
					}
					$in_data['judul_berita'] = $this->input->post("judul_berita");
					$in_data['isi_berita'] = $this->input->post("isi_berita");
					$in_data['id_kategori'] = $this->input->post("id_kategori");
					$in_data['headline'] = $this->input->post("headline");
					$in_data['jenis'] = $this->input->post("jenis");
					$this->db->update("dlmbg_berita",$in_data,$id);
					redirect("app_admin/berita");
				}
				else
				{
					$config['upload_path'] = './asset/berita/thumb/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./asset/berita/thumb/".$data['file_name'] ;
						$destination_thumb	= "./asset/berita/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_thumb    = 640 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						if(!empty($_POST['id_tags']))
						{
							$tags = $_POST['id_tags'];
							$ic = 0;
							$tg = "";
							for($ic;$ic<count($tags);$ic++)
							{
								$tg .= $tags[$ic].',';
							}
							$in_data['id_tags'] = $tg;
						}
						$in_data['gambar'] = $data['file_name'];
						$in_data['judul_berita'] = $this->input->post("judul_berita");
						$in_data['isi_berita'] = $this->input->post("isi_berita");
						$in_data['id_kategori'] = $this->input->post("id_kategori");
						$in_data['headline'] = $this->input->post("headline");
						$in_data['jenis'] = $this->input->post("jenis");
						$this->db->update("dlmbg_berita",$in_data,$id);
				
						$old_thumb	= "./asset/berita/".$this->input->post("gambar")."" ;
						unlink($source);
						unlink($old_thumb);
						
						redirect("app_admin/berita");
						
					}
					else 
					{
						echo $this->upload->display_errors('<p>','</p>');
					}
				}
			}
		}
		else
		{
			redirect("auth/user_login");
		}
   }
 
	public function set()
	{
		if($this->session->userdata("logged_in")!="")
		{
			$sess['by_judul'] = $this->input->post("by_judul");
			$this->session->set_userdata($sess);
			redirect("superadmin/berita");
		}
		else
		{
			redirect("web");
		}
   }
 
	public function hapus($id_param,$file)
	{
		if($this->session->userdata("logged_in")!="")
		{
			$path = "./asset/berita/".$file."";
			unlink($path);
			$where['id_berita'] = $id_param;
			$this->db->delete("dlmbg_berita",$where);
			redirect("app_admin/berita");
		}
		else
		{
			redirect("web");
		}
	}
}
 
/* End of file superadmin.php */
