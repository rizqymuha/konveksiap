<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'cart'));
		$this->load->model('app');
	}

	public function index()
	{
      $this->template->olshop('cart');
	}

	public function add()
	{
		if (is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
			$get = $this->app->get_where('t_items', array('id_item' => $id))->row();

         $data = array(
            'id' => $get->id_item,
            'name' => $get->nama_item,
            'price' => $get->harga,
            'weight' => $get->berat,
            'qty' => 1
         );

         $this->cart->insert($data);

         echo '<script type="text/javascript">window.history.go(-1);</script>';

		} else {
			redirect('home');
		}
	}

   public function update()
   {
      if ($this->uri->segment(3))
      {
         $this->load->library('form_validation');

         $this->form_validation->set_rules('qty', 'Jumlah Pesanan', 'required|numeric');

         if ($this->form_validation->run() == TRUE)
         {
            $data = array(
               'qty' => $this->input->post('qty', TRUE),
               'rowid' => $this->uri->segment(3)
            );

            $this->cart->update($data);

            redirect('cart');
         } else {
            $this->template->olshop('cart');
         }

      } else {
         redirect('cart');
      }
   }

   public function delete()
   {
      if ($this->uri->segment(3))
      {

         $rowid = $this->uri->segment(3);

         $this->cart->remove($rowid);

         redirect('cart');
      } else {
         redirect('cart');
      }
   }
}
