<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

   function insert($table = '', $data = '')
   {
      $this->db->insert($table, $data);
   }

	function insert_last($table = '', $data = '')
   {
      $this->db->insert($table, $data);

		return $this->db->insert_id();
   }

	function get_all($table)
	{
		$this->db->from($table);

		return $this->db->get();
	}

	function get_where($table = null, $where = null)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}

	function select_all($select, $table)
	{
		$this->db->select($select);
		$this->db->from($table);

		return $this->db->get();
	}

	function select_where($select, $table, $where)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}

	function update($table = null, $data = null, $where = null)
	{
		$this->db->update($table, $data, $where);
	}

	function delete($table = null, $where = null)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	function report($where = '')
	{
		$this->db->select(array('o.id_order AS id_order', 'fullname', 'kota', 'total', 'SUM(biaya) AS biaya'));

		$this->db->from('t_order o JOIN t_detail_order do ON (o.id_order = do.id_order) JOIN t_users u ON (o.id_user = u.id_user)');
		$this->db->where($where);
		$this->db->group_by('o.id_order');

		return $this->db->get();
	}

	function count($table='')
	{
		return $this->db->count_all($table);
	}

	function count_where($table='', $where = '')
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->count_all_results();
	}

	function last($table, $limit, $order)
	{
		$this->db->from($table);
		$this->db->limit($limit);
		$this->db->order_by($order, 'DESC');

		return $this->db->get();
	}
}
