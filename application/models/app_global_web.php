<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_global_web extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
	 
	 
	public function generate_index_menu($tipe="",$id_kat=0)
	{
		$hasil="";
		$where['tipe'] = $tipe;
		$w = $this->db->get_where("dlmbg_menu",$where);

		if($tipe=="kategori")
		{
			$hasil .= "<ul>";
			foreach($w->result() as $h)
			{
				if($id_kat==$h->id_menu)
				{
					$hasil .= '<li class="aktif">'.$h->menu.'</li>';
				}
				else
				{
					$hasil .= '<li><a href="'.base_url().'web/kategori/index/'.$h->id_menu.'/'.url_title($h->menu,'-',TRUE).'">'.$h->menu.'</a></li>';
				}
			}
			$hasil .= '</ul>';
		}
		else if($tipe=="menu")
		{
			$max = $w->num_rows();
			$i = 1;
			foreach($w->result() as $h)
			{
				$border = " | ";
				if($i>=$max)
				{
					$border = " ";
				}
				$hasil .= '<a href="'.base_url().'web/pages/index/'.$h->id_menu.'/'.url_title($h->menu,'-',TRUE).'">'.$h->menu.'</a>'.$border;
				$i++;
			}
		}
		return $hasil;
	}
	 
	public function generate_berita_slide_headline($kat="",$order="",$limit)
	{
		$hasil="";
		if($kat=="")
		{
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit);
		}
		else
		{
			$where['id_kategori'] = $kat;
			$w = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where,$limit);
		}

		$hasil .= '<ul id="sliderContent">';
			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<li class="sliderImage">
					  <img src="'.base_url().'asset/berita/'.$gambar.'" width="450" height="230" />
					  <span class="bottom">
					  <h6>'.time_to_string($h->tanggal).'</h6>
					  <a href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">
					  <strong>'.$h->judul_berita.'</strong></a>
					  <br />'.substr(strip_tags($h->isi_berita),0,100).'...</span>
				  </li>';
			}
		$hasil .= '<div class="clear sliderImage"></div></ul>';
		return $hasil;
	}
	 
	public function generate_berita_headline($kat="",$order="",$limit,$offset)
	{
		$hasil="";
		if($kat=="")
		{
			$where['headline'] = 1;
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit);
		}
		else
		{
			$where['headline'] = 1;
			$where['id_kategori'] = $kat;
			$w = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where,$limit,$offset);
		}

			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<div id="sub-bottom-headline-left">
				<h6>'.time_to_string($h->tanggal).'</h6>
					<h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,50).'...</a></h1>
					<div class="cleaner_h10"></div>
					<img src="'.base_url().'asset/berita/'.$gambar.'" width="100" height="60" />
					'.substr(strip_tags($h->isi_berita),0,130).'... 
				</div>';
			}

		return $hasil;
	}
	 
	public function generate_berita_headline_kategori($kat="",$order="",$limit,$offset)
	{
		$hasil="";
		if($kat=="")
		{
			$where['headline'] = 1;
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit);
		}
		else
		{
			$where['headline'] = 1;
			$where['id_kategori'] = $kat;
			$w = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where,$limit,$offset);
		}

			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<div id="sub-main-kategori-right">
								<h6>'.time_to_string($h->tanggal).'</h6>
								<h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,50).'...</a></h1>
								<div class="cleaner_h5"></div>
								<img src="'.base_url().'asset/berita/'.$gambar.'" width="80" height="40" />
								'.substr(strip_tags($h->isi_berita),0,75).'... 
							</div>';
			}

		return $hasil;
	}
	 
	public function generate_berita_list_no_thumb($kat="",$key_order="",$order="",$limit,$offset)
	{
		$hasil="";
		if($kat=="")
		{
			$w = $this->db->order_by($key_order,$order)->get("dlmbg_berita",$limit,$offset);
		}
		else
		{
			$where['id_kategori'] = $kat;
			$w = $this->db->order_by($key_order,$order)->get_where("dlmbg_berita",$where,$limit,$offset);
		}

		$hasil .= '<ul>';
			foreach($w->result() as $h)
			{
				$hasil .= '<li><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,40).'...</a></li>';
			}
		$hasil .= '</ul>';
		return $hasil;
	}
	 
	public function generate_berita_list_thumb($kat="",$order="",$limit)
	{
		$hasil="";
		if($kat=="")
		{
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit,$offset);
		}
		else
		{
			$where['id_kategori'] = $kat;
			$w = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where,$limit);
		}

			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<div class="cleaner_h0"></div>
				<h6>'.time_to_string($h->tanggal).'</h6>
					<h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,70).'...</a></h1><img src="'.base_url().'asset/berita/'.$gambar.'" width="120" />
					'.substr(strip_tags($h->isi_berita),0,200).'...  ';
			}
		return $hasil;
	}
	 
	public function generate_berita_list_after_thumb($kat="",$order="",$limit)
	{
		$hasil="";
		if($kat=="")
		{
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit,$offset);
		}
		else
		{
			$where['id_kategori'] = $kat;
			$w = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where,$limit);
		}

			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<h6>'.time_to_string($h->tanggal).'</h6><h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,70).'...</a></h1><img src="'.base_url().'asset/berita/'.$gambar.'" width="205" /><div class="cleaner_h5"></div>
					'.substr(strip_tags($h->isi_berita),0,150).'...  ';
			}
		return $hasil;
	}
	 
	public function generate_berita_foto_list_thumb($kat="",$order="",$limit,$jenis)
	{
		$hasil="";
		if($kat=="")
		{
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit,$offset);
		}
		else
		{
			$where['id_kategori'] = $kat;
			$where['jenis'] = $jenis;
			$w = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where,$limit);
		}

			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '
				<div id="sub-large-bottom-content-left">
				<h6>'.time_to_string($h->tanggal).'</h6>
					<h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,70).'...</a></h1>
					<div class="cleaner_h5"></div>
					<img src="'.base_url().'asset/berita/'.$gambar.'" width="140" height="100" />
					<div class="cleaner_h5"></div>
					'.substr(strip_tags($h->isi_berita),0,100).'...
				</div>';
			}
		return $hasil;
	}
	 
	public function generate_kategori_footer()
	{
		$hasil="";
		$where['tipe'] = "kategori";
		$w = $this->db->get_where("dlmbg_menu",$where);
		$i = 0;
		foreach($w->result() as $h)
		{
			$hasil .= '
			<div id="sub-kategori">
				<h1>Kategori '.$h->menu.'</h1>
				<ul>';
			$hasil .= $this->generate_berita_list_no_thumb($h->id_menu,"id_berita","DESC",$GLOBALS['site_limit_small'],0);
			$hasil .= '</ul>
			</div>';
			$i++;
			if($i>=3)
			{
				$i=0;
				$hasil .= "<div class='cleaner_h10'></div>";
			}
		}
		return $hasil;
	}
	 
	public function generate_tags($id_tags=array())
	{
		$hasil="";
		$w = $this->db->where_in("id_tags",$id_tags)->get("dlmbg_tags");
		$i = 1;
		$max = $w->num_rows();
		foreach($w->result() as $h)
		{
			$koma = ", ";
			if($i==$max)
			{
				$koma = "";
			}
			$hasil .= '<a href="'.base_url().'web/tags/index/'.$h->id_tags.'/'.url_title($h->tags,'-',TRUE).'">'.$h->tags.'</a>'.$koma;
			$i++;
		}
		if(empty($hasil))
		{
			$hasil .= "No Tags";
		}
		return $hasil;
	}
	 
	public function generate_berita_list_thumb_kategori($kat="", $slug="", $offset = 0,$order="",$limit)
	{
		$hasil="";
		if($kat=="")
		{
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit,$offset);
			$tot_hal  = $this->db->order_by("id_berita",$order)->get("dlmbg_berita");
		}
		else
		{
			$where['id_kategori'] = $kat;
			$w = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where,$limit,$offset);
			$tot_hal = $this->db->order_by("id_berita",$order)->get_where("dlmbg_berita",$where);
		}

		$config['base_url'] = base_url() . 'web/kategori/index/'.$kat.'/'.$slug.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 6;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<div id="sub-content-left">
							<h6>'.time_to_string($h->tanggal).'</h6>
							<h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,80).'...</a></h1>
							<div class="cleaner_h10"></div>
							<div class="cleaner_h10"></div>
							<img src="'.base_url().'asset/berita/'.$gambar.'" width="150" height="80" />
							'.substr(strip_tags($h->isi_berita),0,300).'... <div class="cleaner_h0"></div></div>';
			}
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_detail_berita($id_param=0)
	{
		$hasil="";
		$this->db->query("update dlmbg_berita set counter_read=counter_read+1 where id_berita='".$id_param."'");
		$where['id_berita'] = $id_param;
		$w = $this->db->get_where("dlmbg_berita",$where);
		$i = 0;
		foreach($w->result() as $h)
		{
			$gambar = "no-image.jpg";
			if($h->gambar!="")
			{
				$gambar = $h->gambar;
			}

			$arr_id_tags = explode(",", $h->id_tags);
			$arr_tags = array();
			for($j=0;$j<count($arr_id_tags);$j++)
			{
				array_push($arr_tags, $arr_id_tags[$j]);
			}

			$hasil .= '
			<h4>'.$h->judul_berita.'</h4>
		<div class="cleaner_h5"></div>
		<span style="float:left; width:200px; text-align:left;">Posted on : '.time_to_string($h->tanggal).'</span>
		<span style="float:right; width:390px; text-align:right;">Dibaca sebanyak : <strong>'.$h->counter_read.'</strong> kali
		</span>

				<div class="cleaner_h20"></div>
				<img src="'.base_url().'asset/berita/'.$gambar.'" width="250" style="float:right; padding:3px; margin:0px 0px 0px 10px; border:1px solid #CCCCCC;" />
				'.$h->isi_berita.'
			<div id="detail-content-left">
			<div class="cleaner_h20"></div>
			Tags : '.$this->generate_tags($arr_tags).'
			<div class="cleaner_h20"></div>
			<h5>Baca Juga Berita Lainnya</h5>
			<div class="cleaner_h10"></div>
			<ul>
				'.$this->generate_berita_list_no_thumb($h->id_kategori,"id_berita","DESC",$GLOBALS['site_limit_medium'],0).'
			</ul>
			</div>
			<div class="cleaner_h10"></div>';
			$hasil .= '<div class="fb-comments" data-href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'" data-width="650" data-num-posts="10"></div>';
		}
		return $hasil;
	}
	 
	public function generate_berita_list_thumb_tags($tags="", $slug="", $offset = 0,$order="",$limit)
	{
		$hasil="";
		if($tags=="")
		{
			$w = $this->db->order_by("id_berita",$order)->get("dlmbg_berita",$limit,$offset);
			$tot_hal  = $this->db->order_by("id_berita",$order)->get("dlmbg_berita");
		}
		else
		{
			$w = $this->db->like("id_tags",$tags)->order_by("id_berita",$order)->get("dlmbg_berita",$limit,$offset);
			$tot_hal = $this->db->like("id_tags",$tags)->order_by("id_berita",$order)->get("dlmbg_berita");
		}

		$config['base_url'] = base_url() . 'web/tags/index/'.$tags.'/'.$slug.'/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 6;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<div id="sub-content-left">
							<h6>'.time_to_string($h->tanggal).'</h6>
							<h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,80).'...</a></h1>
							<div class="cleaner_h10"></div>
							<div class="cleaner_h10"></div>
							<img src="'.base_url().'asset/berita/'.$gambar.'" width="150" height="80" />
							'.substr(strip_tags($h->isi_berita),0,300).'... <div class="cleaner_h0"></div></div>';
			}
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_cari_berita($key="",$limit,$offset)
	{
		$hasil="";
		$w = $this->db->like("judul_berita",$key)->or_like("isi_berita",$key)->order_by("id_berita","DESC")->get("dlmbg_berita",$limit,$offset);
		$tot_hal = $this->db->like("judul_berita",$key)->or_like("isi_berita",$key)->order_by("id_berita","DESC")->get("dlmbg_berita");

		$config['base_url'] = base_url() . 'news/search/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		$hasil .= "<p>Ditemukan <b>".$tot_hal->num_rows()."</b> berita dengan kata kunci '<b>".$this->session->userdata("pencarian")."'</b></p>";
			foreach($w->result() as $h)
			{
				$gambar = "no-image.jpg";
				if($h->gambar!="")
				{
					$gambar = $h->gambar;
				}
				$hasil .= '<div id="sub-content-left">
							<h6>'.time_to_string($h->tanggal).'</h6>
							<h1><a title="'.$h->judul_berita.'" href="'.base_url().'news/read/index/'.$h->id_kategori.'/'.$h->id_berita.'/'.url_title($h->judul_berita,'-',TRUE).'">'.substr($h->judul_berita,0,80).'...</a></h1>
							<div class="cleaner_h10"></div>
							<div class="cleaner_h10"></div>
							<img src="'.base_url().'asset/berita/'.$gambar.'" width="150" height="80" />
							'.substr(strip_tags($h->isi_berita),0,300).'... <div class="cleaner_h0"></div></div>';
			}
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_detail_content($id_param=0)
	{
		$hasil="";
		$where['id_menu'] = $id_param;
		$w = $this->db->get_where("dlmbg_menu",$where);
		$i = 0;
		foreach($w->result() as $h)
		{

			$hasil .= '
			<h4>'.$h->menu.'</h4>

				<div class="cleaner_h20"></div>
				'.$h->content.'
			<div class="cleaner_h10"></div>';
		}
		return $hasil;
	}
	 
	 

}
