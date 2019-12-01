<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
      $this->load->model('admin');
	}

   public function index()
   {
		$this->cek_login();
		$data['data'] = $this->admin->get_all('t_users');

		$this->template->admin('admin/manage_user', $data);
   }

   public function status()
   {
      $this->cek_login();

      if (!is_numeric($this->uri->segment(3)) || !is_numeric($this->uri->segment(4)))
      {
         redirect('user');
      }

      $this->admin->update('t_users', ['status' => $this->uri->segment(3)], ['id_user' => $this->uri->segment(4)]);

      redirect('user');
   }

   public function detail()
   {
      $this->cek_login();

      if (!is_numeric($this->uri->segment(3)))
      {
         redirect('user');
      }

      $data['data'] = $this->admin->get_where('t_users',['id_user' => $this->uri->segment(3)]);

      $this->template->admin('admin/detail_user', $data);
   }

	function cek_login()
	{
		if (!$this->session->userdata('admin'))
		{
			redirect('login');
		}
	}
}
