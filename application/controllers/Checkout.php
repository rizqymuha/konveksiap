<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'cart'));
		$this->load->model('app');
	}

	public function index()
	{
		if (!$this->session->userdata('user_id') || !$this->cart->contents()) {
			redirect('home/login');
		}

		if ($this->input->post('submit', TRUE) == 'Submit') {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('prov', 'Provinsi', 'required');
			$this->form_validation->set_rules('kota', 'Kota / Kabupaten', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('kd_pos', 'Kode Pos', 'required|numeric|min_length[5]');
			$this->form_validation->set_rules('kurir', 'Kurir', 'required');
			$this->form_validation->set_rules('layanan', 'Layanan', 'required');
			$this->form_validation->set_rules('ongkir', 'Ongkir', 'required|numeric');
			$this->form_validation->set_rules('total', 'Total', 'required|numeric');

			if ($this->form_validation->run() == TRUE) {
				$get = $this->app->get_where('t_users', ['id_user' => $this->session->userdata('user_id')]);

				if ($get->num_rows() > 0) {
					//proses
					$this->load->library('email');

					$config['charset'] = 'utf-8';
					$config['useragent'] = 'Olshopku';
					$config['protocol'] = 'smtp';
					$config['mailtype'] = 'html';
					$config['smtp_host'] = 'ssl://smtp.gmail.com';
					$config['smtp_port'] = '465';
					$config['smtp_timeout'] = '5';
					$config['smtp_user'] = 'email@example'; //isi dengan email gmail
					$config['smtp_pass'] = ''; //isi dengan password
					$config['crlf'] = "\r\n";
					$config['newline'] = "\r\n";
					$config['wordwrap'] = TRUE;

					$this->email->initialize($config);

					$user = $get->row();

					$id_order = time();
					$kota = explode(",", $this->input->post('kota', TRUE));
					$alamat = $this->input->post('alamat', TRUE);
					$pos = $this->input->post('kd_pos', TRUE);
					$kurir = $this->input->post('kurir', TRUE);
					$layanan = explode(",", $this->input->post('layanan', TRUE));
					$ongkir = $this->input->post('ongkir', TRUE);
					$total = $this->input->post('total', TRUE);
					$tgl_pesan = date("Y-m-d");
					$bts = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 3, date("Y")));

					$table = '';
					$no = 1;
					foreach ($this->cart->contents() as $carts) {
						$table .= '<tr><td>' . $no++ . '</td><td>' . $carts['name'] . '</td><td>' . $carts['qty'] . '</td><td style="text-align:right">' . number_format($carts['subtotal'], 0, ',', '.') . '</td></tr>';
					}

					$this->email->from('email@example', "Olshopku");
					$this->email->to($user->email);
					$this->email->subject('Pembayaran');
					$this->email->message(
						'Terima Kasih telah melakukan pemesanan di toko kami, selanjutnya silahkan anda mentransfer uang senilai <b>Rp. ' . number_format($total, 0, ',', '.') . ',-</b> ke no. rekening <b>90xxxx</b> paling lambat ' . $bts . ' agar pesanan anda bisa kami proses. Detail pembayaran sebagai berikut :<br/><br/>
						<table border="1" style="width: 80%">
						<tr><th>#</th><th>Nama Barang</th><th>Jumlah</th><th>Harga</th></tr>
						' . $table . '
						<tr><td colspan="3">Ongkos Kirim</td><td style="text-align:right">' . number_format($ongkir, 0, ',', '.') . '</td></tr>
						<tr><td colspan="3">Total</td><td style="text-align:right">' . number_format($total, 0, ',', '.') . '</td></tr>
						</table>
						'
					);

					if ($this->email->send()) {
						$data = array(
							'id_order' => $id_order,
							'id_user' => $user->id_user,
							'total' => $total,
							'tujuan' => $alamat,
							'pos' => $pos,
							'kota' => $kota[1],
							'kurir' => $kurir,
							'service' => $layanan[1],
							'tgl_pesan' => $tgl_pesan,
							'bts_bayar' => $bts,
							'status' => 'belum'
						);

						if ($this->app->insert('t_order', $data)) {

							foreach ($this->cart->contents() as $key) {
								$detail = [
									'id_order' => $id_order,
									'id_item' => $key['id'],
									'qty' => $key['qty'],
									'biaya' => $key['subtotal']
								];

								$this->app->insert('t_detail_order', $detail);
							}

							$this->cart->destroy();

							echo '<script type="text/javascript">alert("Silahkan cek email anda untuk detail pembayaran...");window.location.replace("' . base_url() . '")</script>';
						}
					} else {
						echo '<script type="text/javascript">alert("Email gagal terkirim")</script>';
					}
				} else {
					//pesan
					echo '<script type="text/javascript">alert("User tidak dikenali")</script>';
				}
			}
		}

		$this->template->olshop('checkout');
	}

	public function city()
	{
		$prov = $this->input->post('prov', TRUE);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$prov",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: a8f639f90619bf6b64c98cc9c1fb0bb4"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, TRUE);

			echo '<option value="" selected disabled>Kota / Kabupaten</option>';

			for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
				echo '<option value="' . $data['rajaongkir']['results'][$i]['city_id'] . ',' . $data['rajaongkir']['results'][$i]['city_name'] . '">' . $data['rajaongkir']['results'][$i]['city_name'] . '</option>';
			}
		}
	}

	public function getcost()
	{
		$asal = 22;
		$dest = $this->input->post('dest', TRUE);
		$kurir = $this->input->post('kurir', TRUE);
		$berat = 0;

		foreach ($this->cart->contents() as $key) {
			$berat += ($key['weight'] * $key['qty']);
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=$asal&destination=$dest&weight=$berat&courier=$kurir",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: a8f639f90619bf6b64c98cc9c1fb0bb4"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, TRUE);

			echo '<option value="" selected disabled>Layanan yang tersedia</option>';

			for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {

				for ($l = 0; $l < count($data['rajaongkir']['results'][$i]['costs']); $l++) {

					echo '<option value="' . $data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'] . ',' . $data['rajaongkir']['results'][$i]['costs'][$l]['service'] . '(' . $data['rajaongkir']['results'][$i]['costs'][$l]['description'] . ')">';
					echo $data['rajaongkir']['results'][$i]['costs'][$l]['service'] . '(' . $data['rajaongkir']['results'][$i]['costs'][$l]['description'] . ')</option>';
				}
			}
		}
	}

	public function cost()
	{
		$biaya = explode(',', $this->input->post('layanan', TRUE));
		$total = $this->cart->total() + $biaya[0];

		echo $biaya[0] . ',' . $total;
	}
}
