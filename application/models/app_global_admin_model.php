<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_global_admin_model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 **/
	 
	public function generate_index_user($limit,$offset,$filter=array())
	{
		$hasil="";
		$tot_hal = $this->db->get("dlmbg_user");

		$config['base_url'] = base_url() . 'app_admin/user/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		$w = $this->db->get("dlmbg_user",$limit,$offset);
		
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Superadmin Name</th>
					<th>Username</th>
					<th width='160'><a href='".base_url()."app_admin/user/tambah' class='btn btn-small btn-success'><i class='icon-plus-sign'></i> Tambah Data</a></th>
					</tr>
					</thead>";
		$i = $offset+1;
		foreach($w->result() as $h)
		{
			$hasil .= "<tr>
					<td>".$i."</td>
					<td>".$h->nama_user."</td>
					<td>".$h->username."</td>
					<td>";
			$hasil .= "<a href='".base_url()."app_admin/user/edit/".$h->kode_user."' class='btn btn-small btn-inverse'><i class='icon-edit'></i> Edit</a> ";
			$hasil .= "<a href='".base_url()."app_admin/user/hapus/".$h->kode_user."' onClick=\"return confirm('Are you sure?');\" class='btn btn-small btn-danger'><i class='icon-trash'></i> Hapus</a></td>
					</tr>";
			$i++;
		}
		$hasil .= '</table>';
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_index_kunjungan($cari,$id_tunjangan,$limit,$offset)
	{
		$hasil="";
		$tot_hal = $this->db->query("select a.id_pasien, a.nama_pasien, a.tgl_masuk, b.nama_ruang, c.nama_dokter from dlmbg_pasien a left join dlmbg_ruang b on 
		a.id_ruang=b.id_ruang left join dlmbg_dokter c on a.id_dokter=c.id_dokter where 
		INSTR(CONCAT(' ', a.tgl_masuk,' '), '".$cari."') and id_tunjangan='".$id_tunjangan."'");

		$config['base_url'] = base_url() . 'app_admin/data_pasien/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		$w = $this->db->query("select a.id_pasien, a.nama_pasien, a.tgl_masuk, a.biaya, b.nama_ruang, c.nama_dokter from dlmbg_pasien a left join dlmbg_ruang b on 
		a.id_ruang=b.id_ruang left join dlmbg_dokter c on a.id_dokter=c.id_dokter where 
		INSTR(CONCAT(' ', a.tgl_masuk,' '), '".$cari."') and id_tunjangan='".$id_tunjangan."' LIMIT ".$offset.",".$limit."");
		
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Nama Pasien</th>
					<th>Tgl. Masuk</th>
					<th>Ruang</th>
					<th>Dokter</th>
					<th>Biaya</th>
					</tr>
					</thead>";
		$i = $offset+1;
		foreach($w->result() as $h)
		{
			$hasil .= "<tr>
					<td>".$i."</td>
					<td>".$h->nama_pasien."</td>
					<td>".$h->tgl_masuk."</td>
					<td>".$h->nama_ruang."</td>
					<td>".$h->nama_dokter."</td>
					<td>Rp. ".number_format($h->biaya,2,",",".")."</td>
					</tr>";
			$i++;
		}
		$tot_biaya = $this->db->query("select sum(biaya) as jum from dlmbg_pasien a where 
		INSTR(CONCAT(' ', a.tgl_masuk,' '), '".$cari."') and id_tunjangan='".$id_tunjangan."'")->row();
			$hasil .= "<tr>
					<td colspan=5>Total : </td>
					<td>Rp. ".number_format($tot_biaya->jum,2,",",".")."</td>
					</tr>";
		$hasil .= '</table>';
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_index_sistem($limit,$offset)
	{
		$hasil="";
		$tot_hal = $this->db->get("dlmbg_setting");

		$config['base_url'] = base_url() . 'app_admin/sistem/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		$w = $this->db->get("dlmbg_setting",$limit,$offset);
		
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Setting System</th>
					<th>Type</th>
					<th></th>
					</tr>
					</thead>";
		$i = $offset+1;
		foreach($w->result() as $h)
		{
			$hasil .= "<tr>
					<td>".$i."</td>
					<td>".$h->title."</td>
					<td>".$h->tipe."</td>
					<td>";
			$hasil .= "<a href='".base_url()."app_admin/sistem/edit/".$h->id_setting."' class='btn btn-small btn-inverse'><i class='icon-edit'></i> Edit</a></td>
					</tr>";
			$i++;
		}
		$hasil .= '</table>';
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_index_ruang($limit,$offset,$cari)
	{
		$hasil="";
		$search['nama_ruang'] = $cari;
		$tot_hal = $this->db->like($search)->get("dlmbg_ruang");

		$config['base_url'] = base_url() . 'app_admin/ruang/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		$w = $this->db->query("select a.nama_ruang, b.kategori_ruang, a.status_ruangan, a.id_ruang from dlmbg_ruang a 
		left join dlmbg_kategori_ruang b on a.id_kategori_ruang=b.id_kategori_ruang where nama_ruang like '%".$search['nama_ruang']."%' LIMIT ".$offset.",".$limit."");
		
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Nama Ruang</th>
					<th>Kategori Ruang</th>
					<th>Status Ruangan</th>
					<th width='150'><a href='".base_url()."app_admin/ruang/tambah' class='btn btn-success btn-small'><i class='icon-plus-sign'></i> Tambah Data</a></th>
					</tr>
					</thead>";
		$i = $offset+1;
		foreach($w->result() as $h)
		{
			$hasil .= "<tr>
					<td>".$i."</td>
					<td>".$h->nama_ruang."</td>
					<td>".$h->kategori_ruang."</td>
					<td>".$h->status_ruangan."</td>
					<td>";
			$hasil .= "<a href='".base_url()."app_admin/ruang/edit/".$h->id_ruang."' class='btn btn-small btn-inverse'><i class='icon-edit'></i> Edit</a> ";
			$hasil .= "<a href='".base_url()."app_admin/ruang/hapus/".$h->id_ruang."' onClick=\"return confirm('Are you sure?');\" class='btn btn-small btn-danger'><i class='icon-trash'></i> Hapus</a></td>
					</tr>";
			$i++;
		}
		$hasil .= '</table>';
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}

	public function generate_menu($limit,$offset)
	{
		$i = $offset+1;
		$tot_hal = $this->db->get("dlmbg_menu");

		$config['base_url'] = base_url() . 'app_admin/routing_pages/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->get("dlmbg_menu",$limit,$offset);
		
		$hasil = "";
		$hasil .= "<table class='table table-striped table-condensed'>
				<thead>
				<tr class='warning'>
				<td width='30'><b>No.</b></td>
				<td><b>Menu</b></td>
				<td><b>URL Route</b></td>
				<td><b>Tipe</b></td>
				<td width='150'><a href='".base_url()."app_admin/routing_pages/tambah' class='btn btn-success btn-small'><i class='icon-plus-sign'></i> Tambah Data</a></td>
				</tr>
				</thead>";
				
		foreach($w->result() as $h)
		{
			$hasil .= "<tr><td>".$i." </td><td>".$h->menu." </td><td>".$h->url_route." </td><td>".$h->tipe." </td>
			<td><a href='".base_url()."app_admin/routing_pages/edit/".$h->id_menu."' class='btn btn-inverse btn-small'>
			<i class='icon-edit'></i> Edit</a>
			<a href='".base_url()."app_admin/routing_pages/hapus/".$h->id_menu."' class='btn btn-danger btn-small' onClick=\"return confirm('Are you sure?');\" >
			<i class='icon-trash'></i> Hapus</a>";
			
			$hasil .= "</td></tr>";
			$i++;
		}
		
		$hasil .= "</table>";
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}

	public function generate_index_tags($limit,$offset)
	{
		$i = $offset+1;
		$tot_hal = $this->db->get("dlmbg_tags");

		$config['base_url'] = base_url() . 'app_admin/tags/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);
		
		$w = $this->db->get("dlmbg_tags",$limit,$offset);
		
		$hasil = "";
		$hasil .= "<table class='table table-striped table-condensed'>
				<thead>
				<tr>
				<th width='30'>No.</th>
				<th>Tags</th>
				<th width='150'><a href='".base_url()."app_admin/tags/tambah' class='btn btn-success btn-small'><i class='icon-plus-sign'></i> Tambah Data</a></th>
				</tr>
				</thead>";
				
		foreach($w->result() as $h)
		{
			$hasil .= "<tr><td>".$i." </td><td>".$h->tags." </td>
			<td><a href='".base_url()."app_admin/tags/edit/".$h->id_tags."' class='btn btn-inverse btn-small'>
			<i class='icon-edit'></i> Edit</a>
			<a href='".base_url()."app_admin/tags/hapus/".$h->id_tags."' class='btn btn-danger btn-small' onClick=\"return confirm('Are you sure?');\" >
			<i class='icon-trash'></i> Hapus</a>";
			
			$hasil .= "</td></tr>";
			$i++;
		}
		
		$hasil .= "</table>";
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
	public function generate_index_berita($limit,$offset,$filter=array())
	{
		$hasil="";
		$query_add = "";
		if(!empty($filter))
		{
			if($filter['judul']=="")
			{
				$query_add = "";
			}
			else
			{
				$where['judul_berita'] = $filter['judul_berita']; 
				$query_add = "where a.judul_berita like '%".$where['judul_berita']."%'";
			}
		}

		$tot_hal = $this->db->query("select a.judul_berita, a.tanggal, a.jenis, a.headline, b.menu, a.headline from dlmbg_berita a left join dlmbg_menu b on a.id_kategori=b.id_menu
		 ".$query_add." order by a.id_berita DESC");

		$config['base_url'] = base_url() . 'app_admin/berita/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		$w = $this->db->query("select a.judul_berita, a.id_berita, a.tanggal, a.jenis, a.gambar, a.headline, b.menu, a.headline from dlmbg_berita a left join dlmbg_menu b
		 on a.id_kategori=b.id_menu ".$query_add." order by a.id_berita DESC LIMIT ".$offset.",".$limit."");
		
		$hasil .= "<table class='table table-striped table-condensed'>
					<thead>
					<tr>
					<th>No.</th>
					<th>Judul</th>
					<th>Tanggal</th>
					<th>Tipe</th>
					<th>Headline</th>
					<th width='150'><a href='".base_url()."app_admin/berita/tambah' class='btn btn-success btn-small'><i class='icon-plus'></i> Tambah</a></th>
					</tr>
					</thead>";
		$i = $offset+1;
		foreach($w->result() as $h)
		{
			$st="<span class='label label-important'>No</span>";
			if($h->headline==1){$st="<span class='label label-success'>Yes</span>";}
			$hasil .= "<tr>
					<td>".$i."</td>
					<td>".$h->judul_berita."</td>
					<td>".time_to_string(gmdate('d/m/Y-H:i:s',$h->tanggal))." WIB</td>
					<td>".$h->jenis."</td>
					<td>".$st."</td>
					<td>";
					$hasil .= "";
			$hasil .= "<a href='".base_url()."app_admin/berita/edit/".$h->id_berita."' class='btn btn-inverse btn-small'><i class='icon-edit'></i> Edit</a>";
			$hasil .= " <a href='".base_url()."app_admin/berita/hapus/".$h->id_berita."/".$h->gambar."' onClick=\"return confirm('Anda yakin?');\" 
			class='btn btn-danger btn-small'><i class='icon-trash'></i> Hapus</a></td>
					</tr>";
			$i++;
		}
		$hasil .= '</table>';
		$hasil .= '<div class="cleaner_h20"></div>';
		$hasil .= $this->pagination->create_links();
		return $hasil;
	}
	 
}
