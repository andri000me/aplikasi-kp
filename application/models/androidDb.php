<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_labkom extends CI_Model{
	function __construct(){

	}

	function daftar_perangkat($type){
		$query = $this->db->query("select from wares where w_kind = '$type'");
		return $query;
	}

}