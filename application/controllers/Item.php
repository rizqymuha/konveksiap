<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'form_validation'));
      $this->load->model('admin');
	}

   public function index()
   {
		$this->cek_login();
		$data['data'] = $this->admin->get_all('t_items');

		$this->template->admin('admin/manage_item', $data);
   }

   public function add_item()
   {
		$this->cek_login();

      if ($this->input->post('submit', TRUE) == 'Submit') {
         //validasi
         $this->form_validation->set_rules('nama', 'Nama Item', 'required|min_length[4]');
			$this->form_validation->set_rules('kategori', 'Kategori', 'required|min_length[4]');
         $this->form_validation->set_rules('harga', 'Harga Item', 'required|numeric');
         $this->form_validation->set_rules('berat', 'Berat Item', 'required|numeric');
         $this->form_validation->set_rules('status', 'Status', 'required|numeric');
         $this->form_validation->set_rules('desk', 'Deskripsi', 'required|min_length[4]');

         if ($this->form_validation->run() == TRUE)
         {
				$config['upload_path'] = './assets/upload/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['file_name'] = 'gambar'.time();

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto'))
				{
					$gbr = $this->upload->data();
					//proses insert data item
		         $items = array (
		            'nama_item' => $this->input->post('nama', TRUE),
		            'harga' => $this->input->post('harga', TRUE),
		            'berat' => $this->input->post('berat', TRUE),
		            'status' => $this->input->post('status', TRUE),
						'gambar' => $gbr['file_name'],
		            'deskripsi' => $this->input->post('desk', TRUE)
		         );

		        	$id_item = $this->admin->insert_last('t_items', $items);
					//akses function kategori
					$this->kategori($id_item, $this->input->post('kategori', TRUE));

					redirect('item');

				} else {
					$this->session->set_flashdata('alert', 'anda belum memilih foto');
				}
         }
      }

		$data['kategori'] = $this->input->post('kategori', TRUE);
		$data['kat'] = $this->admin->get_all('t_kategori');
      $data['nama'] = $this->input->post('nama', TRUE);
      $data['berat'] = $this->input->post('berat', TRUE);
      $data['harga'] = $this->input->post('harga', TRUE);
      $data['status'] = $this->input->post('status', TRUE);
      $data['desk'] = $this->input->post('desk', TRUE);
		$data['rk'] = '';

      $data['header'] = "Add New Item";

      $this->template->admin('admin/item_form', $data);
   }

	public function detail()
	{
		$this->cek_login();
		$id_item = $this->uri->segment(3);
		$item = $this->admin->get_where('t_items', array('id_item' => $id_item));

		foreach ($item->result() as $key) {
			$data['id_item'] = $key->id_item;
			$data['nama_item'] = $key->nama_item;
			$data['harga'] = $key->harga;
			$data['berat'] = $key->berat;
			$data['status'] = $key->status;
			$data['gambar'] = $key->gambar;
			$data['deskripsi'] = $key->deskripsi;
		}

		$table = "t_rkategori rk JOIN t_kategori k ON (rk.id_kategori = k.id_kategori)";
		$data['kategori'] = $this->admin->get_where($table, ['rk.id_item' => $id_item]);

		$this->template->admin('admin/detail_item', $data);
	}

	public function update_item()
   {
		$this->cek_login();
		$id_item = $this->uri->segment(3);

      if ($this->input->post('submit', TRUE) == 'Submit') {
         //validasi
         $this->form_validation->set_rules('nama', 'Nama Item', 'required|min_length[4]');
			$this->form_validation->set_rules('kategori', 'Kategori', 'required|min_length[4]');
         $this->form_validation->set_rules('harga', 'Harga Item', 'required|numeric');
         $this->form_validation->set_rules('berat', 'Berat Item', 'required|numeric');
         $this->form_validation->set_rules('status', 'Status', 'required|numeric');
         $this->form_validation->set_rules('desk', 'Deskripsi', 'required|min_length[4]');

         if ($this->form_validation->run() == TRUE)
         {
				$config['upload_path'] = './assets/upload/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['file_name'] = 'gambar'.time();

				$this->load->library('upload', $config);

				$items = array (
					'nama_item' => $this->input->post('nama', TRUE),
					'harga' => $this->input->post('harga', TRUE),
					'berat' => $this->input->post('berat', TRUE),
					'status' => $this->input->post('status', TRUE),
					'deskripsi' => $this->input->post('desk', TRUE)
				);

				if ($this->upload->do_upload('foto'))
				{
					//fetch data file yang diupload
					$gbr = $this->upload->data();
					//hapus file img dari folder
					unlink('assets/upload/'.$this->input->post('old_pict', TRUE));
					$items['gambar'] = $gbr['file_name'];

		         $this->admin->update('t_items', $items, array('id_item' => $id_item));
				} else {
					$this->admin->update('t_items', $items, array('id_item' => $id_item));
				}

				$this->admin->delete('t_rkategori', ['id_item' => $id_item]);
				$this->kategori($id_item, $this->input->post('kategori', TRUE));

				redirect('item');
         }
      }

		$item = $this->admin->get_where('t_items', array('id_item' => $id_item));

		$table = "t_rkategori rk JOIN t_kategori k ON (rk.id_kategori = k.id_kategori)";
		$rk = $this->admin->get_where($table, ['rk.id_item' => $id_item]);

		$value = '';
		foreach ($rk->result() as $k) {
			$value .= ', '.$k->kategori;
		}

		foreach($item->result() as $key) {
	      $data['nama'] = $key->nama_item;
	      $data['berat'] = $key->berat;
	      $data['harga'] = $key->harga;
	      $data['status'] = $key->status;
	      $data['desk'] = $key->deskripsi;
			$data['gambar'] = $key->gambar;
		}

		$data['kat'] = $this->admin->get_all('t_kategori');
		$data['kategori'] = trim($value, ', ');
		$data['rk'] = $rk;

      $data['header'] = "Update Data Item";

      $this->template->admin('admin/item_form', $data);
   }

	private function kategori($id_item, $kategori)
	{
		$kat = explode(", ", $kategori);
		$len = count($kat);
		$a = array(' ');
		$b = array ('`','~','!','@','#','$','%','^','&','*','(',')','_','+','=','[',']','{','}','\'','"',':',';','/','\\','?','/','<','>');

		for ($i = 0; $i  < $len; $i ++) {
			$url = str_replace($b, '', $kat[$i]);
			$url = str_replace($a, '-', strtolower($url));

			$cek = $this->admin->get_where('t_kategori', ['url' => $url]);

			if ($cek->num_rows() > 0) {

				$get = $cek->row();
				$id = $get->id_kategori;

			} else {

				$data = array(
					'kategori' => ucwords(trim($kat[$i])),
					'url' => $url
				);

				$id = $this->admin->insert_last('t_kategori', $data);
			}

			$cek2 = $this->admin->get_where('t_rkategori', ['id_item' => $id_item, 'id_kategori' => $id]);

			if ($cek2->num_rows() < 1) {
				$this->admin->insert('t_rkategori', ['id_item' => $id_item, 'id_kategori' => $id]);
			}
		}
	}

	public function tag()
	{
		$this->cek_login();
		$data['data'] = $this->admin->get_all('t_kategori');

		$this->template->admin('admin/tag', $data);
	}

	public function del_tag()
	{
		$this->cek_login();
		if(!is_numeric($this->uri->segment(3)))
		{
			redirect('item/tag');
		}

		$this->admin->delete(['t_kategori', 't_rkategori'], ['id_kategori' => $this->uri->segment(3)]);

		redirect('item/tag');
	}

	function cek_login()
	{
		if (!$this->session->userdata('admin'))
		{
			redirect('login');
		}
	}
}
