<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysisteamtbl_m extends MY_Model {
	
	public $_table = 'ANALYSISTEAMTBL';
	public $primary_key = 'OID';
	
	public function test(){
		$this->db->get('ANALYSISTEAMTBL');
	}
	
}
