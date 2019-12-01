<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'cart'));
		$this->load->model('app');
	}

	public function index()
	{
		$data['data'] = $this->app->get_where('t_items', ['status' => 1]);
		$this->template->olshop('home', $data);
	}

	public function kategori()
	{
		if (!$this->uri->segment(3)) {
			redirect('home');
		}
		$url = strtolower(str_replace([' ', '%20', '_'], '-', $this->uri->segment(3)));

		$table = 't_kategori k JOIN t_rkategori rk ON (k.id_kategori = rk.id_kategori) JOIN t_items i ON (rk.id_item = i.id_item)';

		$data['data'] = $this->app->get_where($table, ['i.status' => 1, 'k.url' => $url]);
		$data['url'] = ucwords(str_replace(['-', '%20', '_'], ' ', $this->uri->segment(3)));

		$this->template->olshop('home', $data);
	}

	public function detail()
	{
		if (is_numeric($this->uri->segment(3))) {
			$id = $this->uri->segment(3);

			$table = "t_rkategori rk JOIN t_kategori k ON (k.id_kategori = rk.id_kategori)";
			$data['kat'] = $this->app->get_where($table, array('rk.id_item' => $id));

			$data['data'] = $this->app->get_where('t_items', array('id_item' => $id));

			$this->template->olshop('item_detail', $data);
		} else {
			redirect('home');
		}
	}

	public function registrasi()
	{
		if ($this->input->post('submit', TRUE) == 'Submit') {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('nama1', 'Nama Depan', "required|min_length[3]|regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('nama2', 'Nama Belakang', "regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('user', 'Username', "required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]");
			$this->form_validation->set_rules('email', 'Email', "required|valid_email");
			$this->form_validation->set_rules('pass1', 'Password', "required|min_length[5]");
			$this->form_validation->set_rules('pass2', 'Ketik Ulang Password', "required|matches[pass1]");
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', "required");
			$this->form_validation->set_rules('telp', 'Telp', "required|min_length[8]|numeric");
			$this->form_validation->set_rules('alamat', 'Alamat', "required|min_length[10]");

			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'username' => $this->input->post('user', TRUE),
					'fullname' => $this->input->post('nama1', TRUE) . ' ' . $this->input->post('nama2', TRUE),
					'email' => $this->input->post('email', TRUE),
					'password' => password_hash($this->input->post('pass1', TRUE), PASSWORD_DEFAULT, ['cost' => 10]),
					'jk' => $this->input->post('jk', TRUE),
					'telp' => $this->input->post('telp', TRUE),
					'alamat' => $this->input->post('alamat', TRUE),
					'status' => 1
				);

				if ($this->app->insert('t_users', $data)) {

					$halaman = 'reg_success';
				} else {

					echo '<script type="text/javascript">alert("Username / Email tidak tersedia");</script>';

					$halaman = 'register';
				}
			} else {

				$halaman = 'register';
			}
		} else {

			$halaman = 'register';
		}

		if ($this->session->userdata('user_login') == TRUE) {
			redirect('home');
		}

		$data = array(
			'user' => $this->input->post('user', TRUE),
			'nama1' => $this->input->post('nama1', TRUE),
			'nama2' => $this->input->post('nama2', TRUE),
			'email' => $this->input->post('email', TRUE),
			'jk' => $this->input->post('jk', TRUE),
			'telp' => $this->input->post('telp', TRUE),
			'alamat' => $this->input->post('alamat', TRUE),
		);

		$this->template->olshop($halaman, $data);
	}

	public function login()
	{
		if ($this->input->post('submit') == 'Submit') {
			$user = $this->input->post('username', TRUE);
			$pass = $this->input->post('password', TRUE);

			$cek = $this->app->get_where('t_users', "username = '$user' && status = 1 || email = '$user' && status = 1");

			if ($cek->num_rows() > 0) {
				$data = $cek->row();

				if (password_verify($pass, $data->password)) {
					$datauser = array(
						'user_id' => $data->id_user,
						'name' => $data->fullname,
						'user_login' => TRUE
					);

					$this->session->set_userdata($datauser);

					redirect('home');
				} else {

					echo '<script type="text/javascript">alert("Password ditolak");</script>';
				}
			} else {
				echo '<script type="text/javascript">alert("Username tidak dikenali");</script>';
			}
		}

		if ($this->session->userdata('user_login') == TRUE) {
			redirect('home');
		}

		$this->load->view('login');
	}

	public function profil()
	{
		if (!$this->session->userdata('user_login')) {
			redirect('home/login');
		}

		$get = $this->app->get_where('t_users', array('id_user' => $this->session->userdata('user_id')))->row();

		if ($this->input->post('submit', TRUE) == 'Submit') {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('nama1', 'Nama Depan', "required|min_length[3]|regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('nama2', 'Nama Belakang', "regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('user', 'Username', "required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]");
			$this->form_validation->set_rules('pass', 'Masukkan Password Anda', "required|min_length[5]");
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', "required");
			$this->form_validation->set_rules('telp', 'Telp', "required|min_length[8]|numeric");
			$this->form_validation->set_rules('alamat', 'Alamat', "required|min_length[10]");

			if ($this->form_validation->run() == TRUE) {
				if (password_verify($this->input->post('pass', TRUE), $get->password)) {
					$data = array(
						'username' => $this->input->post('user', TRUE),
						'fullname' => $this->input->post('nama1', TRUE) . ' ' . $this->input->post('nama2', TRUE),
						'jk' => $this->input->post('jk', TRUE),
						'telp' => $this->input->post('telp', TRUE),
						'alamat' => $this->input->post('alamat', TRUE)
					);

					if ($this->app->update('t_users', $data, array('id_user' => $this->session->userdata('user_id')))) {
						$this->session->set_userdata(array('name' => $this->input->post('nama1', TRUE) . ' ' . $this->input->post('nama2', TRUE)));

						redirect('home');
					} else {

						echo '<script type="text/javascript">alert("Username / Email tidak tersedia");</script>';
					}
				} else {

					echo '<script type="text/javascript">alert("Password Salah...");window.location.replace("' . base_url() . '/home/logout")</script>';
				}
			}
		}

		$name = explode(' ', $get->fullname);
		$data['nama1'] = $name[0];
		$data['nama2'] = $name[1];
		$data['user'] = $get->username;
		$data['email'] = $get->email;
		$data['jk'] = $get->jk;
		$data['telp'] = $get->telp;
		$data['alamat'] = $get->alamat;

		$this->template->olshop('user_profil', $data);
	}

	public function password()
	{
		if (!$this->session->userdata('user_login')) {
			redirect('home/login');
		}

		if ($this->input->post('submit', TRUE) == 'Submit') {
			$this->load->library('form_validation');
			//validasi form

			$this->form_validation->set_rules('pass1', 'Password Baru', 'required|min_length[5]');
			$this->form_validation->set_rules('pass2', 'Ketik Ulang Password Baru', 'required|matches[pass1]');
			$this->form_validation->set_rules('pass3', 'Password Lama', 'required');

			if ($this->form_validation->run() == TRUE) {
				$get_data = $this->app->get_where('t_users', array('id_user' => $this->session->userdata('user_id')))->row();

				if (!password_verify($this->input->post('pass3', TRUE), $get_data->password)) {
					echo '<script type="text/javascript">alert("Password lama yang anda masukkan salah");window.location.replace("' . base_url() . 'home/logout")</script>';
				} else {

					$pass = $this->input->post('pass1', TRUE);
					$data['password'] = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
					$cond = array('id_user' => $this->session->userdata('user_id'));

					$this->app->update('t_users', $data, $cond);

					redirect('home/logout');
				}
			}
		}

		$this->template->olshop('pass');
	}

	public function transaksi()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('home');
		}

		$data['get'] = $this->app->get_where('t_order', ['id_user' => $this->session->userdata('user_id')]);

		$this->template->olshop('transaksi', $data);
	}

	public function detail_transaksi()
	{
		if (!is_numeric($this->uri->segment(3))) {
			redirect('home');
		}

		$table = "t_order o JOIN t_detail_order do ON (o.id_order = do.id_order) JOIN t_items i ON (do.id_item = i.id_item)";

		$data['get'] = $this->app->get_where($table, ['o.id_order' => $this->uri->segment(3)]);

		$this->template->olshop('detail_transaksi', $data);
	}

	public function hapus_transaksi()
	{
		if (!is_numeric($this->uri->segment(3))) {
			redirect('home');
		}

		$table = array('t_order', 't_detail_order');

		$this->app->delete($table, ['id_order' => $this->uri->segment(3)]);

		redirect('home/transaksi');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
}
