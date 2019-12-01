<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
      $this->load->model('admin');
	}

   public function index()
   {
		$this->cek_login();

      $select = ['id_order', 'tgl_pesan', 'bts_bayar', 'fullname', 'o.status AS status'];
      $table = "t_order o JOIN t_users u ON (o.id_user = u.id_user)";

		$data['data'] = $this->admin->select_all($select, $table);

		$this->template->admin('admin/transaksi', $data);
   }

   public function konfirmasi()
   {
      $this->cek_login();

      if (!is_numeric($this->uri->segment(3)))
      {
         redirect('transaksi');
      }

      $this->admin->update('t_order', ['status' => 'proses'], ['id_order' => $this->uri->segment(3)]);

      redirect('transaksi');
   }

   public function delete()
   {
      $this->cek_login();

      if (!is_numeric($this->uri->segment(3)))
      {
         redirect('transaksi');
      }

      $this->admin->delete(['t_order', 't_detail_order'], ['id_order' => $this->uri->segment(3)]);

      redirect('transaksi');
   }

   public function detail()
   {
      $this->cek_login();

      if (!is_numeric($this->uri->segment(3)))
      {
         redirect('transaksi');
      }

      $select = ['o.id_order AS id_order', 'tgl_pesan', 'bts_bayar', 'fullname', 'o.status AS status', 'pos', 'service', 'kota', 'tujuan', 'total', 'biaya', 'kurir', 'nama_item', 'qty'];

      $table = "t_order o JOIN t_detail_order do ON (o.id_order = do.id_order) JOIN t_users u ON (o.id_user = u.id_user) JOIN t_items i ON (do.id_item = i.id_item)";

      $data['data'] = $this->admin->select_where($select, $table, ['o.id_order' => $this->uri->segment(3)]);

      $this->template->admin('admin/detail_transaksi', $data);
   }

	public function report()
	{
		$this->load->library('form_validation');
		$this->cek_login();

		if ($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('bln', 'Bulan', 'required|numeric');
			$this->form_validation->set_rules('thn', 'Tahun', 'required|numeric');

			if ($this->form_validation->run() == TRUE)
			{
				$bln = $this->input->post('bln', TRUE);
				$thn = $this->input->post('thn', TRUE);
			}

		} else {
			$bln = date('m');
			$thn = date('Y');
		}
		//YYYY-mm-dd
		//2017-04-31
		$awal = $thn.'-'.$bln.'-01';
		$akhir = $thn.'-'.$bln.'-31';

		$where = ['tgl_pesan >=' => $awal, 'tgl_pesan <=' => $akhir, 'o.status' => 'proses'];

		$data['data'] = $this->admin->report($where);
		$data['bln'] = $bln;
		$data['thn'] = $thn;

		$this->template->admin('admin/laporan', $data);
	}

	public function cetak()
	{
		$this->cek_login();
		if (!is_numeric($this->uri->segment(3)) || !is_numeric($this->uri->segment(4)) )
		{
			redirect('transaksi');
		}

		$bln = $this->uri->segment(3);
		$thn = $this->uri->segment(4);
		$awal = $thn.'-'.$bln.'-01';
		$akhir = $thn.'-'.$bln.'-31';

		$where = ['tgl_pesan >=' => $awal, 'tgl_pesan <=' => $akhir, 'o.status' => 'proses'];

		$data['data'] = $this->admin->report($where);
		$data['bln'] = $bln;
		$data['thn'] = $thn;

		$this->load->view('admin/cetak', $data);
	}

	function cek_login()
	{
		if (!$this->session->userdata('admin'))
		{
			redirect('login');
		}
	}
}
